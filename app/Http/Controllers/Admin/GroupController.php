<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\User;
use App\Models\Topic;
use App\Models\Admin\Admin;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\PostMedia;
class GroupController extends Controller
{
    public function index()
    {
        // $groups = Group::all();
        $groups = Group::orderBy('id', 'desc')->get(); // newest first
        return view('admin.group.index', compact('groups'));
    }

    public function create()
    {
        $admins = Admin::select('*')->get();
        $members = Member::select('*')->get();
        $mentors = $admins->merge($members);
        $users = Member::all();
        return view('admin.group.create', compact('mentors','users'));
    }
    
    public function store_1012025(Request $request)
    {
        //Array ( [name] => Dhananjay [mentor_id] => 1 [user_id] => Array ( [0] => 4 [1] => 5 ) [status] => 1 )
         $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'nullable|integer',
            'status' => 'nullable|integer',
            'created_by' => 'nullable|integer',
            'member_type' => 'nullable|integer',
        ]);
       Group::create($request->all());
        return redirect()->route('group.index')->with('success', 'Group created successfully.');
    }
    public function store(Request $request)
    {
     $request->validate([
        'name' => 'required|string|max:255',
        'mentor_id' => 'required|integer',
        'user_id' => 'required|array',
        'status' => 'nullable|integer',
    ]);
    // Create the group
    $group = Group::create([
        'name' => $request->input('name'),
        'state_id' => $request->input('state_id'),
        'status' => $request->input('status'),
        'created_by' => $request->input('created_by'),
        'member_type' => $request->input('member_type'),
        'end_date' => $request->input('end_date'), 
    ]);
    // Create the group member
    GroupMember::create([
        'group_id' => $group->id,
        'member_id' => $request->input('mentor_id'),
        'mentor' => $request->input('mentor_id'),
        'mentiee' => json_encode($request->input('user_id')),
        'status' => $request->input('status'),
    ]);
    return redirect()->route('group.index')->with('success', 'Group created successfully.');
    }
    public function edit(Group $group)
    {
        $users = Member::all();
        $group->load('groupMember');
        return view('admin.group.edit', compact('group', 'users'));
    }
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mentor_id' => 'required|integer',
            'user_id' => 'required|array',
            'status' => 'nullable|integer',
        ]);
        
        // Update the group
        $group->update([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ]);
        
        // Update or create the group member
        $groupMember = $group->groupMember;
        if (!$groupMember) {
            $groupMember = new GroupMember();
            $groupMember->group_id = $group->id;
        }
        
        $groupMember->mentor = $request->input('mentor_id');
        $groupMember->mentiee = json_encode($request->input('user_id'));
        $groupMember->status = $request->input('status');
        $groupMember->save();
        
        return redirect()->route('group.index')->with('success', 'Group updated successfully.');
    }

      public function destroy(Group $group)
        {
            if ($group->status == 1) {
                return redirect()->route('group.index')
                                ->with('error', 'Cannot delete an active Group. Please deactivate it first.');
            }
            $group->delete();
            return redirect()->route('group.index')
                            ->with('success', 'Group deleted successfully.');
        }

     public function toggleStatus(Request $request)
    {
        $group = Group::findOrFail($request->id);
        $group->status = $request->status;
        $group->save();
        return response()->json(['message' => 'Status updated successfully.']);
    }

    public function add_topic($id)
    {
        $group = Group::find($id);
        if (!$group) {
            abort(404, 'Group not found');
        }
        return view('admin.group.add_topic', compact('group', 'id'));
    }
    public function save_topic_bkp(Request $request, $id)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'video_link' => 'nullable|url',
                'video_caption' => 'nullable|string',
                'status' => 'required|integer',
                'doc' => 'nullable|file|mimes:pdf,jpg,png,gif',
                'topic_image' => 'nullable|file|mimes:jpg,png,gif',
            ]);
          /*  $docFile = $request->hasFile('doc') ? $request->file('doc')->store('uploads', 'public') : null;
            $imageFile = $request->hasFile('topic_image') ? $request->file('topic_image')->store('uploads', 'public') : null;
            $videoFile = $request->hasFile('video') ? $request->file('video')->store('uploads', 'public') : null;*/
            $docFile = $request->hasFile('doc')
            ? $request->file('doc')->store('uploads/doc', 'public')
            : null;
            $imageFile = $request->hasFile('topic_image')
            ? $request->file('topic_image')->store('uploads/topics', 'public')
            : null;
             $videoFile = $request->hasFile('video')
            ? $request->file('video')->store('uploads/video', 'public')
            : null;
            $embedLink = '';
            if ($request->video_link) {
                parse_str(parse_url($request->video_link, PHP_URL_QUERY), $query);
                $embedLink = isset($query['v']) ? "https://www.youtube.com/embed/" . $query['v'] : '';
            }
            Topic::create([
                'title' => $request->title,
                'description' => $request->description,
                'images' => $imageFile,
                'files' => $docFile,
                'video' => $videoFile,
                'video_link' => $embedLink,
                'live_video' => $request->live_video,
                'video_caption' => $request->video_caption,
                'status' => $request->status,
                'group_id' => $id,
                'created_by' => Auth::id(),
                'created_date' => now(),
            ]);
        // return redirect()->route('admin.group.topics_list', ['id' => $id])
            //  ->with('success', 'Topic added successfully.');
            return redirect()->route('group.index')
                                ->with('success', 'Topic added successfully.');
        }
        public function save_topic(Request $request, $group_id)
{
    $request->validate([
         'description' => 'nullable|string',
        'video_link' => 'nullable|url',
        'video_caption' => 'nullable|string',
        'status' => 'required|integer',
        'doc' => 'nullable|file|mimes:pdf,jpg,png,gif',
        'topic_image' => 'nullable|file|mimes:jpg,png,gif',
        'video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:102400'
    ]);
    $imageFile = $request->hasFile('topic_image')
        ? $request->file('topic_image')->store('uploads/topics', 'public')
        : null;
    // Youtube embed link generate
    $embedLink = '';
    if ($request->video_link) {
        parse_str(parse_url($request->video_link, PHP_URL_QUERY), $query);
        $embedLink = isset($query['v']) ? "https://www.youtube.com/embed/" . $query['v'] : $request->video_link;
    }
    $media_type = null;
    if ($imageFile && $embedLink) {
        $media_type = 'photo_video';
    } elseif ($imageFile) {
        $media_type = 'photo_video';
    } elseif ($embedLink) {
        $media_type = 'photo_video';
    }
    // ✅ Save post (in posts table)
    $post = Post::create([
        'group_id'    => $group_id,
        'member_id'   => Auth::id(), // Or auth('user')->id() depending on your guard
        'content'     => $request->description,
        'media_type'  => $media_type,
        'video_link'  => $embedLink,
    ]);
    // ✅ Save image as PostMedia if exists
    if ($imageFile) {
        PostMedia::create([
            'post_id'   => $post->id,
            'file_path' => $imageFile,
            'file_type' => 'image',
        ]);
    }
    return redirect()->route('group.index')->with('success', 'Group post (topic) added successfully.');
}
    public function view_topic($id)
        {
            $pageName = 'Group';
            $group = Group::findOrFail($id);
            $topics = Post::where('group_id', $id)->with('member', 'media')->get();
            // print_r($topics);die;
            return view('admin.group.topics_list', compact('group', 'topics','pageName'));
        }
   public function updateTopic(Request $request, $id) {
        $topic = Post::findOrFail($id);
        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->status = $request->status;
         if ($request->hasFile('images')) {
        // Delete old image if exists
        if ($topic->image && File::exists(public_path('uploads/topics/' . $topic->images))) {
            File::delete(public_path('uploads/topics/' . $topic->images));
        }
        $images = $request->file('images');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $images->move(public_path('uploads/topics'), $imageName);
        $topic->images = $imageName;
    }
       $topic->save();
        return back()->with('success', 'Topic added successfully.');
    //return redirect()->route('group.topics_list')->with('success', 'Topic added successfully.');
    }
    public function deleteTopic($id) {
        // print_r($id);die;
    // post::destroy($id);
    // return back()->with('success', 'Topic deleted.');
     $post = DB::table('posts')->where('id', $id)->first();
    if (!$post) {
        return response()->json(['message' => 'Post not found'], 404);
    }
    // Step 2: Delete media files (optional: physical file also)
    $mediaItems = DB::table('post_media')->where('post_id', $id)->get();
    foreach ($mediaItems as $media) {
        $path = storage_path('app/public/' . $media->file_path);
        if (file_exists($path)) {
            unlink($path); // delete physical file
        }
    }
    // Step 3: Delete media from table
    DB::table('post_media')->where('post_id', $id)->delete();
    // Step 4: Delete post
    DB::table('posts')->where('id', $id)->delete();
     return back()->with('success', 'Group Post deleted successfully.');
 }
  public function topicToggleStatus(Request $request)
    {
        $topic = Topic::findOrFail($request->id);
        $topic->status = $request->status;
        $topic->save();
        return response()->json(['message' => 'Status updated successfully.']);
    }


}
