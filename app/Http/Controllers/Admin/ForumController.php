<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Member; // defining Member model
use App\Models\Forum; // defining Forum model
use App\Models\User;

use Illuminate\Support\Facades\Storage;
use App\Models\ForumTopic;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::all(); // Corrected to use Forum model (not Forums)
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

       // 'cat_id' => 'nullable|integer',
       // 'user_id' => 'required|array',
        //'user_id.*' => 'integer|exists:users,id', // Validate each user_id
    ]);
    // Check if validation fails
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }
    // Prepare data to insert into the forums table
    $input = [
        'name' => $request->input('name'),
       // 'cat_id' => $request->input('cat_id'),
        'status' => 1, // Default status
        'created_by' => auth()->user()->id,
    ];
    // Insert into forums table
    $last_id = Forum::create($input)->id; // Create forum and get the last inserted ID
    //  insert into forums_member and notification
    //foreach ($request->input('user_id') as $userId) {
        // Insert into forums_member
        DB::table('forums_member')->insert([
            //'user_id' => $userId,
            'forums_id' => $last_id,
            'status' => 1,
        ]);
        // Insert into notification
       DB::table('notification')->insert([
           // 'show' => $userId,
            'group_id' => $last_id,
            'status' => 1,
            'type' => 'forum',
            'created_at' => now(), // Current timestamp
            'message' => "<a href='" . url('home/profile/' . auth()->user()->id) . "'>" . auth()->user()->name . "</a> added you in Forum: <a href='" . url('home/forum/' . $last_id) . "'>" . $request->input('name') . "</a>",
        ]);
   // }
    // Redirect to the forum page

    //return redirect()->route('forums.index', $last_id)->with('success', 'Forum created successfully.');
    return redirect()->route('forums.index')->with('success', 'Forum added successfully.');


}
    public function forumedit(Forum $forum)
    {
        return view('admin.forums.edit_forum', compact('forum'));
    }
    public function update(Request $request, Forum $forum)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'cat_id' => 'nullable|integer',
            'status' => 'required|integer',
            'created_by' => 'required|integer',

        ]);
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // Update forum details
        $forum->name = $request->name;
        $forum->cat_id = $request->cat_id;
        $forum->status = $request->status;
        $forum->created_by = $request->created_by;

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
        'user_id.*' => 'exists:users,id',

    ]);

    //print_r($request);die;
    $forumId = $request->input('forum_id');
    $userIds = $request->input('user_id', []); // defaults to empty array if nothing selected

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

    //return redirect()->route('forums.index')->with('success', 'Members updated.');
    return redirect()->route('forums.index')->with('success', 'Member created successfully.');
}
public function view_member($id)
{
    $forum = Forum::findOrFail($id);

    // Get all users related to the forum, along with their status
    $users = DB::table('forums_member')
        ->join('users', 'forums_member.user_id', '=', 'users.id')
        ->where('forums_member.forums_id', $id)
        ->select('users.name', 'forums_member.status', 'forums_member.user_id', 'forums_member.id') // Include forums_member.id for toggling status
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
        'title' => 'required',
        'description' => 'required',
        'status' => 'required',

    ]);
    $data = [
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'images' => $request->input('topic_image'),
        'image_caption' => $request->input('image_caption'),
        'video_link' => $request->input('video_link'),
        'video_caption' => $request->input('video_caption'),
        'status' => $request->input('status'),
        'forum_id' => $request->input('forum_id'), //pull from form
        'created_by' => Auth::id(), // Use Laravel's Auth to get user ID
        'created_date' => now(),
    ];

    // Handle file uploads (images, documents)
    if ($request->hasFile('topic_image')) {
        $imagePath = $request->file('topic_image')->store('uploads/images', 'public');
        $data['images'] = basename($imagePath);
    }

    if ($request->hasFile('doc')) {
        $docPath = $request->file('doc')->store('uploads/docs', 'public');
        $data['files'] = basename($docPath);
    }

    // Save to DB
     DB::table('forum_topics')->insert($data);

    // Redirect or respond
    return redirect()->route('forums.index')->with('success', 'Topic saved successfully!');
}


public function view_forum_topics($id)
{
    $forum = Forum::findOrFail($id);
    $topics = ForumTopic::where('forum_id', $id)->with('creator')->get();

    return view('admin.forums.topics_list', compact('forum', 'topics'));
}
public function update_topic_2952025(Request $request, $id)
{
    $topic = ForumTopic::findOrFail($id);

    $topic->update([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'video_caption' => $request->input('video_caption'),
        'status' => $request->input('status'),
    ]);

    return back()->with('success', 'Topic updated successfully.');
}

public function updateTopic(Request $request, $id)
{
    $topic = ForumTopic::findOrFail($id);

    $topic->update([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'video_caption' => $request->input('video_caption'),
        'status' => $request->input('status'),
    ]);

    return back()->with('success', 'Topic updated successfully.');
}


public function deleteTopic($id)
{
    // Find the topic by ID
    $topic = ForumTopic::findOrFail($id);

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

    // Redirect or return a response
    return redirect()->route('forums.index')->with('success', 'Topic and associated files deleted successfully');
}
public function update_forum(Request $request, Forum $forum)
{
    $request->validate([
        'forumname' => 'required|string|max:255',
        'forumstatus' => 'required|in:0,1',
    ]);

    $forum->update([
        'name' => $request->forumname,
        'status' => $request->forumstatus,
    ]);

    return redirect()->route('forums.index')->with('success', 'Forum updated successfully!');
}
public function destroyforum(Forum $forum)
{
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
    $forum->status = $request->status;
    $forum->save();

    return response()->json(['message' => 'Forum status updated successfully.']);
}
public function TopictoggleStatus(Request $request)
{
    $topic = ForumTopic::findOrFail($request->id);
    $topic->status = $request->status;
    $topic->save();

    return response()->json(['message' => 'Topic status updated successfully.']);
}




}
