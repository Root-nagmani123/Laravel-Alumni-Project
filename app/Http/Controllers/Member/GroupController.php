<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;
use App\Services\GroupService;
use Illuminate\Http\RedirectResponse;
use App\Models\Group;
use App\Models\Post;

use Illuminate\Support\Facades\DB;
use App\Models\GroupMember;
use App\Models\Notification;
use App\Models\Member;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;



class GroupController extends Controller
{
    protected $groupService;
    protected $notificationService;
 

    public function __construct(GroupService $groupService ,NotificationService $notificationService)
    {
        $this->groupService = $groupService;
        $this->notificationService = $notificationService;

    }

    public function index()
    {
        $user = auth()->guard('user')->user();
        
        $userId = $user->id;
        $groupIds = DB::table('group_member')
    ->where('status', 1)
    ->where(function ($query) use ($userId) {
        $query->where('mentor', $userId)
              ->orWhereRaw("JSON_CONTAINS(mentiee, '\"$userId\"')");
    })
    ->pluck('group_id');

  $groupNames = DB::table('groups as g')
    ->join('group_member as gm', 'g.id', '=', 'gm.group_id')
    ->leftJoin('posts as p', 'g.id', '=', 'p.group_id')
    ->whereIn('g.id', $groupIds)
    ->where('g.status', 1)
    ->where(function($query) use ($userId) {
        $query->where(function($q) {
            $q->whereNull('g.end_date')
              ->orWhere('g.end_date', '>', now());
        })
        ->orWhere(function($q) use ($userId) {
            $q->where('g.member_type', '2')
              ->where('g.created_by', $userId);
        });
    })
    ->select(
        'g.id',
        'g.name',
        'g.image',
        'g.end_date',
        'g.created_by',
        'g.member_type',
        DB::raw('1 + JSON_LENGTH(gm.mentiee) as member_count'), // 1 mentor + mentee count
         DB::raw('COUNT(p.id) as total_posts') 
    )
    ->groupBy(
        'g.id',
        'g.name',
        'g.image',
        'g.end_date',
        'g.created_by',
        'g.member_type',
        'gm.mentiee'
    )
    ->orderBy('g.id', 'desc')
    ->get()
   ->map(function ($item) {
        $item->enc_id =  ($item->id); // yaha id encrypt ho rahi hai
        return $item;
    });

    
        // Fetch group names and other details
        // $groupNames = $this->groupService->getGroupNamesByUserId($userId);
        
        // dd($groupNames);
    // print_r($groupNames);die;

    

        return view('user.groups', compact('groupNames'));
    }

function activateGroup(Request $request) : RedirectResponse {
   // Validate the request
    $request->validate([
        'group_id' => 'required|exists:groups,id',
        'end_date' => 'required|date|after_or_equal:today',
    ]);
    $groupId = $request->input('group_id');
    $group = Group::find($groupId);

    if (!$group) {
        return redirect()->back()->with('error', 'Group not found.');
    }

    // Activate the group
    $group->end_date = $request->input('end_date');
    $group->save();

    return redirect()->back()->with('success', 'Group activated successfully.');
}


    public function create()
    {
        $members = $this->groupService->index();
        return view('partials.right-sidebar', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            'mentees' => 'required|array',
            'end_date' => 'required|date',
            'grp_image' => 'required|image|mimes:jpeg,png,jpg|max:1048', // Validate image file
        ]);

        if ($request->hasFile('grp_image')) {
            $imagePath = $request->file('grp_image')->store('uploads/images/grp_img', 'public');
            $data['images'] = basename($imagePath);
        }
        $data_id = DB::table('groups')->insertGetId([
            'name' => $validated['group_name'],
            'image' => $data['images'] ?? null, // Use the image path if it exists
            'end_date' => $validated['end_date'],
            'created_by' => auth('user')->id(),
            'status' => 1, // Assuming status is always 1 for active groups
            'member_type' => 2, // Assuming member_type is always 'member'
            'created_at' => now(),
            'updated_at' => now(),
        ]);

      $group = GroupMember::create([
        'group_id' => $data_id,
        'member_id' => auth('user')->id(),
        'mentor' => auth('user')->id(),
        'mentiee' => json_encode($request->input('mentees')),
        'status' => 1
    ]);


     // Notify new members: "New member add in group"
     $userIds = $validated['mentees'];
     if ($group) {
         $memberMessage = $validated['group_name'] . ' group has been added as mentiee';
         $notificationMentiee=$this->notificationService->notifyMemberAdded(
             $userIds,
             'group_member',
             $memberMessage,
             $data_id,
             'group',
             Auth::id()
         );
     }
     
        return redirect()->back()->with('success', 'Group created successfully.');
    }

    public function edit(Group $group)
    {
        return view('member.group.edit', compact('group'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $this->groupService->update($group, $request->validated());
        return redirect()->route('member.groups.index')->with('success', 'Group updated successfully.');
    }

   public function destroy(Group $group)
{
    
    try { 
        $this->notificationService->notifyGroupPost($group->id, auth('user')->id(), $group->name . ' group has been deleted.', 0, 'group_delete');
        $this->groupService->delete($group);
        return redirect()->route('user.group.index')->with('success', 'Group deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->route('user.group.index')->with('error', $e->getMessage());
    }
}
function post_destroy(Request $request, $id) : RedirectResponse {
    $post = Post::find($id);
    if (!$post) {
        return redirect()->back()->with('error', 'Post not found.');
    }
    $post->delete();
    return redirect()->back()->with('success', 'Post deleted successfully.');
}

function updateGroupName(Request $request) {
    $request->validate([
        'group_id' => 'required|exists:groups,id',
        'name' => 'required|string|max:255',
    ]);

    $group = Group::find($request->input('group_id'));
    $group->name = $request->input('name');
    $group->save();

    return redirect()->back()->with('success', 'Group name updated successfully.');
}
}
