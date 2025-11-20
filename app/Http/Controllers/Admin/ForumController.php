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
use App\Services\RecentActivityService;
use App\Rules\NoHtmlOrScript;

class ForumController extends Controller
{

    protected $notificationService;
    protected $recentActivityService;

    public function __construct(NotificationService $notificationService, RecentActivityService $recentActivityService)
    {
        $this->notificationService = $notificationService;
        $this->recentActivityService = $recentActivityService;
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
        'name' => ['required', 'string', 'max:255', new NoHtmlOrScript()],
        'forumdescription' => ['required', 'string', 'max:1000', new NoHtmlOrScript()],
        'end_date' => 'required|date|after_or_equal:today',
        'images' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048', 
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
            $file = $request->file('image');
            
            // Server-side MIME validation (reads actual file content, not headers)
            $mimeType = getSecureMimeType($file);
            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!$mimeType || !in_array($mimeType, $allowedMimes)) {
                return redirect()->back()
                    ->withErrors(['images' => 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.'])
                    ->withInput();
            }
            
            // Map MIME type to extension (security: don't trust filename extension)
            $extensionMap = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif'
            ];
            $extension = $extensionMap[$mimeType];
            $filename = uniqid() . '.' . time() . '.' . $extension;
            $imagePath = $file->storeAs('uploads/images/forums_img', $filename, 'private');
        }
    
        $forum = Forum::create([
            'name' => $request->input('name'),
            'description' => $request->input('forumdescription'),
            'status' => $request->input('status'),
            'created_by' => session('LoginID'),
            'end_date' => $request->input('end_date'),
            'images' => $imagePath, // Store full path for secure route
            'notified_at' => 0,
        ]);

        if ($forum->status == 1 ) {
            $notification = $this->notificationService->notifyAllMembers(
                'forum_admin',
                $forum->name . ' forum has been added.',
                $forum->id,
                'forum',
                auth()->id()
            );
           
        }
        $this->recentActivityService->logActivity(
            'New Forum Created',
            'Forum',
            auth()->guard('admin')->id(),
            'Created new forum: ' . $forum->name,
            1,
            $forum->id
        );
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
        'name' => ['required', 'string', 'max:255', new NoHtmlOrScript()],
        'forumdescription' => ['required', 'string', 'max:1000', new NoHtmlOrScript()],
        'cat_id' => 'nullable|integer',
        'status' => 'required|integer',
        'forum_image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048', // Optional image validation
        'end_date' => 'required|date|after_or_equal:today',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    if ($request->hasFile('forum_image')) {
            $file = $request->file('forum_image');
            
            // Server-side MIME validation (reads actual file content, not headers)
            $mimeType = getSecureMimeType($file);
            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!$mimeType || !in_array($mimeType, $allowedMimes)) {
                return redirect()->back()
                    ->withErrors(['forum_image' => 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.'])
                    ->withInput();
            }
            
            // Map MIME type to extension (security: don't trust filename extension)
            $extensionMap = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif'
            ];
            $extension = $extensionMap[$mimeType];
            $filename = uniqid() . '.' . time() . '.' . $extension;
            $imagePath = $file->storeAs('uploads/images/forums_img', $filename, 'private');
            $data['images'] = $imagePath; // Store full path for secure route
        }

    $forum->name = $request->name;
    $forum->cat_id = $request->cat_id;
    $forum->status = $request->status;
    $forum->end_date = $request->end_date;
    // Update image if provided
    if (isset($data['images'])) {
        // Delete old image if exists
        if ($forum->images) {
            // Try private first, then public for backward compatibility
            if (Storage::disk('private')->exists($forum->images)) {
                Storage::disk('private')->delete($forum->images);
            } elseif (Storage::disk('public')->exists('uploads/images/forums_img/' . basename($forum->images))) {
                Storage::disk('public')->delete('uploads/images/forums_img/' . basename($forum->images));
            }
        }
        $forum->images = $data['images'];
    }

    // Optional: Only update created_by if sent
    if ($request->has('created_by')) {
        $forum->created_by = $request->created_by;
    }

    $result = $forum->save();
    if ($result && $forum->status == 1) {
        $notification = $this->notificationService->notifyAllMembers('forum_admin', $forum->name . ' forum has been updated.', $forum->id, 'forum', auth()->id());
    }
    return redirect()->route('forums.index')->with('success', 'Forum updated successfully.');
}


    public function destroy(Forum $forum)
        {
            $forumName = $forum->name;
            $forumId = $forum->id;
           $data = $forum->delete();

           if ($data) {
               // Notify all members about forum deletion
               $this->notificationService->notifyAllMembers(
                   'forum_admin',
                   $forumName . ' forum has been deleted.',
                   $forumId,
                   'forum_delete',
                   auth()->id()
               );
           }
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
        'description' => ['required', 'string', new NoHtmlOrScript()],
        'status'      => 'required|in:0,1',
        'forum_id'    => 'required|exists:forums,id',
    ]);

    $data = [
        'description'   => $request->input('description'),
        'status'        => $request->input('status'),
        'forum_id'      => $request->input('forum_id'),
        'created_by'    => session('LoginID'),
        'created_date'  => now(),
        'notified_at'   => 0,
    ];

    $topicId = DB::table('forum_topics')->insertGetId($data);

    // Send notification if active
    if ($request->input('status') == 1) {
        $forum = Forum::find($request->input('forum_id'));
        $message = $forum->name . ' - New topic added: ' . $request->input('description');
        $notification = $this->notificationService->notifyAllMembers(
            'forum_topic',
            $message,
            $forum->id,
            'forum'
        );

        if ($notification) {
            // Update notified_at
            DB::table('forum_topics')->where('id', $topicId)->update(['notified_at' => 1]);
            Member::query()->update(['is_notification' => 0]);
        }
    }

    return redirect()->route('forums.index')->with('success', 'Topic saved successfully!');
}





//old code
    // public function save_topic(Request $request)
    // {
    // $request->validate([
    //     // 'title' => 'required',
    //     'description' => 'required',
    //     'status' => 'required',
    // ]);
    // $data = [
    //     // 'title' => $request->input('title'),
    //     'description' => $request->input('description'),
    //     // 'images' => $request->input('topic_image'),
    //     // 'image_caption' => $request->input('image_caption'),
    //     // 'video_link' => $request->input('video_link'),
    //     // 'video_caption' => $request->input('video_caption'),
    //     'status' => $request->input('status'),
    //     'forum_id' => $request->input('forum_id'),
    //     //'created_by' => Auth::id(),
    //      'created_by' => session('LoginID'),
    //     'created_date' => now(),
    // ];

    // // Handle file uploads (images, documents)
    //     // if ($request->hasFile('topic_image')) {
    //     //     $imagePath = $request->file('topic_image')->store('uploads/images', 'public');
    //     //     $data['images'] = basename($imagePath);
    //     // }

    //     if ($request->hasFile('doc')) {
    //         $docPath = $request->file('doc')->store('uploads/docs', 'public');
    //         $data['files'] = basename($docPath);
    //     }
    //     // DB::table('forum_topics')->insert($data);
    //     $topicId = DB::table('forum_topics')->insertGetId($data);

    // // 6. (Optional) Notify all forum members
    // $memberIds = DB::table('forums_member')
    //                 ->where('forums_id', $request->forum_id)
    //                 ->pluck('user_id')
    //                 ->toArray();

    //     return redirect()->route('forums.index')->with('success', 'Topic saved successfully!');
    // }




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
        'description' => ['required', 'string', new NoHtmlOrScript()],
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
       $result = $topic->save();

        if ($result && $topic->status == 1) {
            $forumName = Forum::find($topic->forum_id)->name;
            // Notify all members about the topic update
            $notification = $this->notificationService->notifyAllMembers(
                'forum_topic',
                'A topic has been updated in the forum: ' . $forumName,
                $topic->forum_id,
                'forum'
            );
            if ($notification) {
                Member::query()->update(['is_notification' => 0]);
                $topic->notified_at = 1;
                $topic->save();
            }
        }

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
     $result = $topic->delete();

    if($result){
        // Notify all members about the topic deletion
        $this->notificationService->notifyAllMembers(
            'forum_topic',
            'A topic has been deleted from the forum: ' . $topic->description,
            $topic->forum_id,
            'forum_deleted'
        );
    }

    // ✅ Redirect back to the same forum’s topic list
    return redirect()->to('/admin/forums/forums/' . $topic->forum_id . '/topics')
                     ->with('success', 'Topic and associated files deleted successfully.');
    }

    public function update_forum(Request $request, Forum $forum)
    {
    $request->validate([
        'forumname' => ['required', 'string', 'max:255', new NoHtmlOrScript()],
        'forumdescription' => ['required', 'string', 'max:1000', new NoHtmlOrScript()],
        'forumstatus' => 'required|in:0,1',
        'end_date' => 'required|date|after_or_equal:today', // Ensure end date is valid
        'forum_image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048', // Optional image validation

    ]);
    // Handle image upload if provided
    if ($request->hasFile('forum_image')) {
        $file = $request->file('forum_image');
        
        // Server-side MIME validation (reads actual file content, not headers)
        $mimeType = getSecureMimeType($file);
        $allowedMimes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!$mimeType || !in_array($mimeType, $allowedMimes)) {
            return redirect()->back()
                ->withErrors(['forum_image' => 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.'])
                ->withInput();
        }
        
        // Map MIME type to extension (security: don't trust filename extension)
        $extensionMap = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif'
        ];
        $extension = $extensionMap[$mimeType];
        $filename = uniqid() . '.' . time() . '.' . $extension;
        $imagePath = $file->storeAs('uploads/images/forums_img', $filename, 'private');
        $data['images'] = $imagePath; // Store full path for secure route
        // Delete old image if exists
        if ($forum->images) {
            // Try private first, then public for backward compatibility
            if (Storage::disk('private')->exists($forum->images)) {
                Storage::disk('private')->delete($forum->images);
            } elseif (Storage::disk('public')->exists('uploads/images/forums_img/' . basename($forum->images))) {
                Storage::disk('public')->delete('uploads/images/forums_img/' . basename($forum->images));
            }
        }
        $forum->images = $data['images'];
    }
    $result = $forum->update([
        'name' => $request->forumname,
        'status' => $request->forumstatus,
        'description' => $request->forumdescription,
        'end_date' => $request->end_date, // Update end date
        'images' => $forum->images ?? null, // Keep existing image if not updated
    ]);

     if ($result && $forum->status == 1) {  
        $notification = $this->notificationService->notifyAllMembers('forum_admin', $forum->name . ' forum has been updated.', $forum->id, 'forum', auth()->id());
    }

    $this->recentActivityService->logActivity(
        'Forum Updated',
        'Forum',
        auth()->guard('admin')->id(),
        'Updated forum: ' . $forum->name,
        1,
        $forum->id
    );
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
    $forumName = $forum->name;
    $forumId = $forum->id;
    $forum->delete();
    // Notify all members about forum deletion
    $this->notificationService->notifyAllMembers(
        'forum_admin',
        $forumName . ' forum has been deleted.',
        $forumId,
        'forum_deleted',
        auth()->id()
    );

    $this->recentActivityService->logActivity(
        'Forum Deleted',
        'Forum',
        auth()->guard('admin')->id(),
        'Deleted Forum: ' . $forum->name,
        1,
        $forum->id
    );
    return redirect()->route('forums.index')->with('success', 'Forum and all associated data deleted successfully.');
}

public function toggleStatus(Request $request)
{
    $forum = Forum::findOrFail($request->id);
    $oldStatus = $forum->status;
    $forum->status = $request->status;
    $forum->save();
    
   // Notify only when activated and not yet notified
   if ($oldStatus == 0 && $forum->status == 1 && now()->lt($forum->end_date)) {

    $notification = $this->notificationService->notifyAllMembers(
        'forum_admin',
        $forum->name . 'forum has been activated.',
        $forum->id,
        'forum',
        auth()->id()
    );
   
}

 if ($oldStatus == 1 && $forum->status == 0 && now()->lt($forum->end_date)) {
        $notification = $this->notificationService->notifyAllMembers(
            'forum_admin',
            $forum->name . ' forum has been deactivated before the scheduled end date.',
            $forum->id,
            'forum_deactivated',
            auth()->id()
        );
    }

    $this->recentActivityService->logActivity(
        'Forum Status Toggled',
        'Forum',
        auth()->guard('admin')->id(),
        'Toggled status for forum: ' . $forum->name .' to ' . ($forum->status == 1 ? 'active' : 'inactive'),
        1,
        $forum->id
    );

    return response()->json(['message' => 'Forum status updated successfully.']);
}
public function TopictoggleStatus(Request $request)
{
    $topic = ForumTopic::findOrFail($request->id);
    $oldStatus = $topic->status;
    $topic->status = $request->status;
    $topic->save();

    // Notify only when activated and not yet notified
    if ($oldStatus == 0 && $topic->status == 1 ) {
        $forum = Forum::find($topic->forum_id);
        $message = $forum->name . ' - New topic activated: ' . $topic->description;

        $notification = $this->notificationService->notifyAllMembers(
            'forum_topic',
            $message,
            $forum->id,
            'forum'
        );

        if ($notification) {
            Member::query()->update(['is_notification' => 0]);
            $topic->notified_at = 1;
            $topic->save();
        }
    }

      // Deactivation before end date: send cancellation notification
            $forum = Forum::find($topic->forum_id);
    if ($oldStatus == 1 && $topic->status == 0 && now()->lt($forum->end_date)) {
        $message = $forum->name . ' - Topic deactivated: ' . $topic->description;

        $notification = $this->notificationService->notifyAllMembers(
            'forum_topic',
            $message,
            $forum->id,
            'forum'
        );

        if ($notification) {
            Member::query()->update(['is_notification' => 0]);
        }
    }

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
