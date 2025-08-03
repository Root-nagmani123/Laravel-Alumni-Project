<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Forum;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ForumTopic;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\NotificationService;

class ForumController extends Controller
{

    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
        {
            // $forums = Forum::all();
            $forums = Forum::orderBy('id', 'desc')->get(); // newest first
            return view('admin.forums.index', compact('forums'));
        }

    public function create()
        {
            return view('admin.forums.create');
        }

    public function store(Request $request)
        {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'end_date' => 'required|date|after_or_equal:today',
        'images' => 'nullable|image|mimes:jpeg,png,jpg|max:1028', 
        'status' => 'required|in:1,0',

      ]);
    // Check if validation fails
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/images/forums_img', 'public');
        }
    
        $forum = Forum::create([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'created_by' => session('LoginID'),
            'end_date' => $request->input('end_date'),
            'images' => $imagePath ? basename($imagePath) : null,
            'notified_at' => 0,
        ]);

        if ($forum->status == 1 && $forum->notified_at == 0) {
            $notification = $this->notificationService->notifyAllMembers(
                'forum_admin',
                $forum->name . ' forum has been added.',
                $forum->id,
                'forum'
            );
            if ($notification) {
                Member::query()->update(['is_notification' => 0]);
                $forum->notified_at = 1;
                $forum->save();
            }
        }
        
    // Redirect to the forum page
    return redirect()->route('forums.index')->with('success', 'Forum added successfully.');
    }

    public function forumedit(Forum $forum)
        {
            return view('admin.forums.edit_forum', compact('forum'));
        }
  public function update(Request $request, Forum $forum)
{
    
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'cat_id' => 'nullable|integer',
        'status' => 'required|integer',
        'forum_image' => 'nullable|forum_image|mimes:jpeg,png,jpg|max:1048', // Optional image validation
        'end_date' => 'required|date|after_or_equal:today',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    if ($request->hasFile('forum_image')) {
            $imagePath = $request->file('forum_image')->store('uploads/images/forums_img', 'public');
            $data['images'] = basename($imagePath);
        }

    $forum->name = $request->name;
    $forum->cat_id = $request->cat_id;
    $forum->status = $request->status;
    $forum->end_date = $request->end_date;
    // Update image if provided
    if (isset($data['images'])) {
        // Delete old image if exists
        if ($forum->images) {
            Storage::disk('public')->delete('uploads/images/forums_img/' . $forum->images);
        }
        $forum->images = $data['images'];
    }

    // Optional: Only update created_by if sent
    if ($request->has('created_by')) {
        $forum->created_by = $request->created_by;
    }
    

    $forum->save();

    return redirect()->route('forums.index')->with('success', 'Forum updated successfully.');
}

    public function destroy(Forum $forum)
        {
            $forum->delete();
            return redirect()->route('forums.index')->with('success', 'Forum deleted successfully.');
        }
   public function add_member($id)
        {
        $forum = Forum::findOrFail($id);
    // echo '<pre>';print_r($forum);die;
        // Get all users
        $userData = Member::all();
        // Get assigned user_ids for this forum
        $assignedUsers = DB::table('forums_member')
                            ->where('forums_id', $id)
                            ->pluck('user_id')
                            ->toArray();
        return view('admin.forums.add_member', [
        'forumName' => $forum->name,
        'forumId' => $forum->id,
        'userData' => $userData,
        'assignedUsers' => $assignedUsers
        ]);
        }

    public function storeMembers(Request $request)
        {
        $request->validate([
        'forum_id' => 'required|exists:forums,id',
        'user_id' => 'required|array|min:1',
        'user_id.*' => 'exists:members,id',

        ]);

    $forumId = $request->input('forum_id');
    $userIds = $request->input('user_id', []);

    // Remove existing and insert new members
    DB::table('forums_member')->where('forums_id', $forumId)->delete();
    $insertData = [];
    foreach ($userIds as $userId) {
        $insertData[] = [
            'forums_id' => $forumId,
            'user_id' => $userId,
            'status'  => 1,
            'created_at' => now(),
        ];
    }
    if (!empty($insertData)) {
        DB::table('forums_member')->insert($insertData);
    }

    if (!empty($userIds)) {
        $message = 'New members added to forum.';
        $this->notificationService->notifyMemberAdded($userIds, 'forum', $message, $forumId, 'forum');
    }

    return redirect()->route('forums.index')->with('success', 'Member created successfully.');
    }

    public function view_member($id)
        {
        $forum = Forum::findOrFail($id);
        $users = DB::table('forums_member')
        ->join('members', 'forums_member.user_id', '=', 'members.id')
        ->where('forums_member.forums_id', $id)
        ->select('members.name', 'forums_member.status', 'forums_member.user_id', 'forums_member.id','forums_member.forums_id') // Include forums_member.id for toggling status
        ->get();
        return view('admin.forums.member_list', [
        'forumName' => $forum->name,
        'forumId' => $forum->id,
        'users' => $users,
    ]);
    }

    public function add_topic($id)
    {
    $forum = Forum::findOrFail($id);
    // Get all users
    $userData = User::all();
    // Get assigned user_ids for this forum
    return view('admin.forums.add_topic', [
        'forumName' => $forum->name,
        'forumId' => $forum->id,
        'userData' => $userData,
    ]);
    }
    public function save_topic(Request $request)
    {
    $request->validate([
        // 'title' => 'required',
        'description' => 'required',
        'status' => 'required',
    ]);
    $data = [
        // 'title' => $request->input('title'),
        'description' => $request->input('description'),
        // 'images' => $request->input('topic_image'),
        // 'image_caption' => $request->input('image_caption'),
        // 'video_link' => $request->input('video_link'),
        // 'video_caption' => $request->input('video_caption'),
        'status' => $request->input('status'),
        'forum_id' => $request->input('forum_id'),
        //'created_by' => Auth::id(),
         'created_by' => session('LoginID'),
        'created_date' => now(),
    ];

    // Handle file uploads (images, documents)
        // if ($request->hasFile('topic_image')) {
        //     $imagePath = $request->file('topic_image')->store('uploads/images', 'public');
        //     $data['images'] = basename($imagePath);
        // }

        if ($request->hasFile('doc')) {
            $docPath = $request->file('doc')->store('uploads/docs', 'public');
            $data['files'] = basename($docPath);
        }

        // DB::table('forum_topics')->insert($data);

        $topicId = DB::table('forum_topics')->insertGetId($data);

    // 6. (Optional) Notify all forum members
    $memberIds = DB::table('forums_member')
                    ->where('forums_id', $request->forum_id)
                    ->pluck('user_id')
                    ->toArray();

        return redirect()->route('forums.index')->with('success', 'Topic saved successfully!');
    }

    public function view_forum_topics($id)
    {
        $forum = Forum::findOrFail($id);
    /*    $topics = ForumTopic::where('forum_id', $id)->where('created_by', Auth::guard('admin')->id())
        //->with('creator')
        ->get();*/

       $topics = ForumTopic::where('forum_id', $id)
    
    ->orderBy('id', 'desc')
    ->with('creator')
    ->get();

        return view('admin.forums.topics_list', compact('forum', 'topics'));
    }

    public function update_topic(Request $request, $id)
    {
    $topic = ForumTopic::findOrFail($id);

    $request->validate([
        // 'title' => 'required|string|max:255',
        'description' => 'required|string',
        // 'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // 'doc' => 'nullable|mimes:pdf|max:10000',
        // 'video_link' => 'nullable|url',
        // 'image_caption' => 'nullable|string|max:255',
        // 'video_caption' => 'nullable|string|max:255',
        'status' => 'required|in:0,1',
    ]);

    // Image upload
    // if ($request->hasFile('images')) {
    //     if ($topic->images) {
    //         Storage::disk('public')->delete($topic->images); // if path includes folders
    //     }

    //     $image = $request->file('images');
    //     $imageUrl = $image->store('uploads/topics', 'public');
    //     $topic->images = $imageUrl;
    // }

    // // PDF upload
    // if ($request->hasFile('doc')) {
    //     if ($topic->files) {
    //         Storage::disk('public')->delete($topic->files);
    //     }

    //     $doc = $request->file('doc');
    //     $docUrl = $doc->store('uploads/topics', 'public');
    //     $topic->files = $docUrl;
    // }

        // Assign other fields
        $topic->title = $request->input('title');
        $topic->description = $request->input('description');
        // $topic->image_caption = $request->input('image_caption');
        // $topic->video_caption = $request->input('video_caption');
        // $topic->video_link = $request->input('video_link');
        $topic->status = $request->input('status');
        $topic->save();

        return back()->with('success', 'Topic updated successfully.');
    }


    public function deleteTopic($id)
    {
    // Find the topic by ID
    $topic = ForumTopic::findOrFail($id);
      // Check if the topic is active (status == 1)
    if ($topic->status == 1) {
        return redirect()->to('/admin/forums/forums/' . $topic->forum_id . '/topics')
                        ->with('error', 'Cannot delete an active topic. Please deactivate it first.');
    }

    // Delete associated files from storage (if they exist)
    if ($topic->images) {
        Storage::delete('public/uploads/images/' . $topic->images);
    }
    if ($topic->files) {
        Storage::delete('public/uploads/docs/' . $topic->files);
    }
    if ($topic->video) {
        Storage::delete('public/uploads/videos/' . $topic->video);
    }

    // Delete the topic record
    $topic->delete();

    // ✅ Redirect back to the same forum’s topic list
    return redirect()->to('/admin/forums/forums/' . $topic->forum_id . '/topics')
                     ->with('success', 'Topic and associated files deleted successfully.');
    }

    public function update_forum(Request $request, Forum $forum)
    {
    $request->validate([
        'forumname' => 'required|string|max:255',
        'forumstatus' => 'required|in:0,1',
        'end_date' => 'required|date|after_or_equal:today', // Ensure end date is valid
        'forum_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Optional image validation

    ]);
    // Handle image upload if provided
    if ($request->hasFile('forum_image')) {
        $imagePath = $request->file('forum_image')->store('uploads/images/forums_img', 'public');
        $data['images'] = basename($imagePath);
        // Delete old image if exists
        if ($forum->images) {
            Storage::disk('public')->delete('uploads/images/forums_img/' . $forum->images);
        }
        $forum->images = $data['images'];
    }
    $forum->update([
        'name' => $request->forumname,
        'status' => $request->forumstatus,
        'end_date' => $request->end_date, // Update end date
        'images' => $forum->images ?? null, // Keep existing image if not updated
    ]);
    return redirect()->route('forums.index')->with('success', 'Forum updated successfully!');
}
public function destroyforum(Forum $forum)
{
     if ($forum->status == 1) {
            return redirect()->route('forums.index')
                            ->with('error', 'Cannot delete an active forum. Please deactivate it first.');
        }
    // Delete related members
    \DB::table('forums_member')->where('forums_id', $forum->id)->delete();
    // Delete related topics and their files
    $topics = \App\Models\ForumTopic::where('forum_id', $forum->id)->get();
    foreach ($topics as $topic) {
        // If file path column exists, e.g., $topic->file
        if ($topic->file && \Storage::exists($topic->file)) {
            \Storage::delete($topic->file);
        }
        $topic->delete();
    }
    // Finally delete the forum
    $forum->delete();
    return redirect()->route('forums.index')->with('success', 'Forum and all associated data deleted successfully.');
}

public function toggleStatus(Request $request)
{
    $forum = Forum::findOrFail($request->id);
    $oldStatus = $forum->status;
    $forum->status = $request->status;
    $forum->save();
    
   // Notify only when activated and not yet notified
   if ($oldStatus == 0 && $forum->status == 1 && $forum->notified_at == 0) {
    $notification = $this->notificationService->notifyAllMembers(
        'forum_admin',
        $forum->name . ' forum has been activated.',
        $forum->id,
        'forum'
    );
    if ($notification) {
        Member::query()->update(['is_notification' => 0]);
        $forum->notified_at = 1;
        $forum->save();
    }
}

    return response()->json(['message' => 'Forum status updated successfully.']);
}
public function TopictoggleStatus(Request $request)
{
    $topic = ForumTopic::findOrFail($request->id);
    $topic->status = $request->status;
    $topic->save();
    return response()->json(['message' => 'Topic status updated successfully.']);
}
function member_delete_forum(Request $request)
{
    $forumId = $request->input('forum_id');
    $userId = $request->input('user_id');
    $id = $request->input('id');
    // Check if the forum exists
    $forum = Forum::find($forumId);
    if (!$forum) {
        return redirect()->back()->with('error', 'Forum not found.');
    }
    // Delete the member from the forum
DB::table('forums_member')
        ->where('forums_id', $forumId)
        ->where('user_id', $userId)
        ->where('id', $id)
        ->delete();
    return redirect()->back()->with('success', 'Member removed from forum successfully.');
}
public function membertoggleStatus(Request $request)
{
    $id = $request->input('id'); // Assuming you are sending 'id' of forums_member row
    $member = DB::table('forums_member')->where('id', $id)->first();
    if (!$member) {
        return response()->json(['message' => 'Member not found.'], 404);
    }
    $newStatus = $member->status == 1 ? 0 : 1;
    DB::table('forums_member')
        ->where('id', $id)
        ->update(['status' => $newStatus]);
    return response()->json([
        'message' => 'Member status updated successfully.',
        'new_status' => $newStatus
    ]);
}
}
