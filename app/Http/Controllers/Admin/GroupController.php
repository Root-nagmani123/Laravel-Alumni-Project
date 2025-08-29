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
use App\Services\{NotificationService, RecentActivityService};
use App\Models\Notification;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Support\Facades\Crypt;
class GroupController extends Controller
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
            'name'        => 'required|string|max:255',
            'status'      => 'nullable|integer|in:0,1',
            'end_date'    => 'nullable|date|after_or_equal:today',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,avif|max:2048',
        ]);
        
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/images/grp_img', 'public');
        }
    
        $group = Group::create([
            'name'        => $request->input('name'),
            'status'      => $request->input('status', 0),
            'created_by'  => auth()->guard('admin')->id(),
            'member_type' => 1,
            'end_date'    => $request->input('end_date'),
            'image'       => $imagePath ? basename($imagePath) : null,
    
        ]);
    
        // Create the group member
        // GroupMember::create([
        //     'group_id' => $group->id,
        //     'member_id' => $request->input('mentor_id'),
        //     'mentor' => $request->input('mentor_id'),
        //     'mentiee' => json_encode($request->input('user_id')),
        //     'status' => $request->input('status', 0),
        // ]);
    
        // Notify only if status is active and not yet notified
        if ($group->status == 1 && $group->notified_at == 0) {
            $mentorId = $request->input('mentor_id');
            $userIds = $request->input('user_id', []);
    
            $notificationsSent = false;
    
            if ($mentorId) {

                $mentorMessage = $group->name . ' group has been added as mentor';
    
                    $mentorNotification = $this->notificationService->notifyMemberAdded(
                        $mentorId,
                        'group_member',
                        $mentorMessage,
                        $group->id,
                        'group',
                        auth()->id()
                    );
                
            }

            if (!empty($userIds)) {
                $mentieeMessage = $group->name . ' group has been added as mentiee';
                    $mentieeNotification = $this->notificationService->notifyMemberAdded(
                        $userIds,
                        'group_member',
                        $mentieeMessage,
                        $group->id,
                        'group',
                        auth()->id()
                );

            }

        }

        $this->recentActivityService->logActivity(
            'New Group Created',
            'Group',
            auth()->guard('admin')->id(),
            'Added new member: ' . $group->name,
            1,
            $group->id
        );
        return redirect()->route('group.index')->with('success', 'Group created successfully.');
    }
    
    public function edit_bkp(Group $group)
    {
        $users = Member::all();
        $group->load('groupMember');
        return view('admin.group.edit', compact('group', 'users'));
    }
    public function edit($id)
{
    try {
        $decryptedId = decrypt($id); // 👈 encrypted id ko decrypt kiya
        $group = Group::findOrFail($decryptedId);

        $users = Member::all();
        $group->load('groupMember');

        return view('admin.group.edit', compact('group', 'users'));
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        abort(404); // agar id galat ho to 404
    }
}

public function update(Request $request, Group $group)
{
    $request->validate([
        'name' => 'required|string|max:255',
        // 'mentor_id' => 'required|integer',
        // 'user_id' => 'required|array',
        'status' => 'nullable|integer',
        'end_date' => 'nullable|date|after_or_equal:today',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads/images/grp_img', 'public');
        if ($group->image) {
            Storage::disk('public')->delete('uploads/images/grp_img/' . $group->image);
        }
        $group->image = basename($imagePath);
    }

    // Track if data has changed
    $dataChanged = $group->isDirty(['name', 'status', 'end_date', 'image']);

    // Update the group
    $group->update([
        'name' => $request->input('name'),
        'status' => $request->input('status'),
        'end_date' => $request->input('end_date'),
        'image' => $group->image,
    ]);

    // Update or create the group member
    $groupMember = $group->groupMember ?? new GroupMember(['group_id' => $group->id]);

    $previousMentor = $groupMember->mentor;
    $previousMentees = json_decode($groupMember->mentiee ?? '[]', true);

    // $newMentor = $request->input('mentor_id');
    // $newMentees = $request->input('user_id');

    // $groupMember->mentor = $newMentor;
    // $groupMember->mentiee = json_encode($newMentees);
    $groupMember->status = $request->input('status');
    $groupMember->save();

    // --- Notifications ---

    // Mentor removed
    // if ($previousMentor && $previousMentor != $newMentor) {
    //     $this->notificationService->notifyMemberAdded(
    //         [$previousMentor],
    //         'mentor_removed',
    //         'You have been removed as mentor from ' . $group->name,
    //         $group->id,
    //         'group_remove',
    //         Auth::id()
    //     );
    // }

    // // Mentor added
    // if ($previousMentor != $newMentor) {
    //     $this->notificationService->notifyMemberAdded(
    //         [$newMentor],
    //         'mentor_added',
    //         'You have been added as mentor to ' . $group->name,
    //         $group->id,
    //         'group',
    //         Auth::id()
    //     );
    // }

    // // Mentees removed
    // $removedMentees = array_diff($previousMentees, $newMentees);
    // if (!empty($removedMentees)) {
    //     $this->notificationService->notifyMemberAdded(
    //         $removedMentees,
    //         'mentiee_removed',
    //         'You have been removed as mentee from ' . $group->name,
    //         $group->id,
    //         'group_remove',
    //         Auth::id()
    //     );
    // }

    // // Mentees added
    // $addedMentees = array_diff($newMentees, $previousMentees);
    // if (!empty($addedMentees)) {
    //     $this->notificationService->notifyMemberAdded(
    //         $addedMentees,
    //         'mentiee_added',
    //         'You have been added as mentee to ' . $group->name,
    //         $group->id,
    //         'group',
    //         Auth::id()
    //     );
    // }

    // // Notify all current members if any changes happened (mentor/mentee or data)
    // if ($dataChanged || $previousMentor != $newMentor || !empty($addedMentees) || !empty($removedMentees)) {
    //     $allCurrentMembers = array_merge([$newMentor], $newMentees);
    //     $this->notificationService->notifyMemberAdded(
    //         $allCurrentMembers,
    //         'group_updated',
    //         'Group details have been updated: ' . $group->name,
    //         $group->id,
    //         'group',
    //         Auth::id()
    //     );
    // }

    $this->recentActivityService->logActivity(
        'Group Updated',
        'Group',
        auth()->guard('admin')->id(),
        'Edit Group: ' . $group->name,
        1,
        $group->id
    );

    return redirect()->route('group.index')->with('success', 'Group updated successfully.');
}



      public function destroy(Group $group)
        {
            if ($group->status == 1) {
                return redirect()->route('group.index')
                                ->with('error', 'Cannot delete an active Group. Please deactivate it first.');
            }
            $data = $group->delete();
            if($data) {
                // Notify all members about group deletion
                $this->notificationService->notifyAllMembers(
                    'group_admin',
                    $group->name . 'group has been deleted.',
                    $group->id,
                    'group_delete',
                    auth()->id()
                );
            }

            $this->recentActivityService->logActivity(
                'Group Deleted',
                'Group',
                auth()->guard('admin')->id(),
                'Deleted group: ' . $group->name,
                1, // Assuming 1 represents admin
                $group->id
            );

            return redirect()->route('group.index')
                            ->with('success', 'Group deleted successfully.');
        }

public function toggleStatus(Request $request)
{
    $group = Group::findOrFail($request->id);

    $oldStatus = $group->status;
    $group->status = $request->status;
    $group->save();
    if ($oldStatus != $group->status) {

        $statusMessage = $group->status ? 'activated' : 'deactivated';
        $SourceType = $group->status ? 'group' : 'group_deactivated';

        $groupMembers = GroupMember::where('group_id', $group->id)->get();

        foreach ($groupMembers as $member) {

            $mentorId = $member->mentor;

            $mentiees = json_decode($member->mentiee, true);

            // Step 6a: Notify mentor if exists
            if ($mentorId) {
                $this->notificationService->notifyMemberAdded(
                    [$mentorId],                     // member IDs as array
                    'group_member',                  // notification type
                    $group->name . " group has been $statusMessage as mentor", // message
                    $group->id,                      // source ID
                    $SourceType,                      // source type
                    auth()->id()                     // who triggered this
                );
            }

            // Step 6b: Notify mentiees if exists
            if (!empty($mentiees)) {
                $this->notificationService->notifyMemberAdded(
                    $mentiees,                       // mentiee IDs
                    'group_member',                  // notification type
                    $group->name . " group has been $statusMessage as mentiee",
                    $group->id,
                    $SourceType,
                    auth()->id()
                );
            }
        }
    }

    $this->recentActivityService->logActivity(
        'Group Status Toggled',
        'Group',
        auth()->guard('admin')->id(),
        'Toggled status for group: ' . $group->name . ' to ' . ($group->status ? 'Active' : 'Inactive'),
        1, // Assuming 1 represents admin
        $group->id
    );
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


//         public function save_topic(Request $request, $group_id)
// {
//     $request->validate([
//          'description' => 'nullable|string',
//         'video_link' => 'nullable|url',
//         'video_caption' => 'nullable|string',
//         'status' => 'required|integer',
//         'doc' => 'nullable|file|mimes:pdf,jpg,png,gif',
//         'topic_image' => 'nullable|file|mimes:jpg,png,gif',
//         'video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:102400'
//     ]);
//     $imageFile = $request->hasFile('topic_image')
//         ? $request->file('topic_image')->store('uploads/topics', 'public')
//         : null;
//     // Youtube embed link generate
//     $embedLink = '';
//     if ($request->video_link) {
//         parse_str(parse_url($request->video_link, PHP_URL_QUERY), $query);
//         $embedLink = isset($query['v']) ? "https://www.youtube.com/embed/" . $query['v'] : $request->video_link;
//     }
//     $media_type = null;
//     if ($imageFile && $embedLink) {
//         $media_type = 'photo_video';
//     } elseif ($imageFile) {
//         $media_type = 'photo_video';
//     } elseif ($embedLink) {
//         $media_type = 'photo_video';
//     }
//     // ✅ Save post (in posts table)
//     $post = Post::create([
//         'group_id'    => $group_id,
//         'member_id'   => Auth::id(), // Or auth('user')->id() depending on your guard
//         'content'     => $request->description,
//         'media_type'  => $media_type,
//         'video_link'  => $embedLink,
//     ]);
//     // ✅ Save image as PostMedia if exists
//     if ($imageFile) {
//         PostMedia::create([
//             'post_id'   => $post->id,
//             'file_path' => $imageFile,
//             'file_type' => 'image',
//         ]);
//     }

//     $memberIds = DB::table('group_member')
//                     ->where('group_id', $group_id)
//                     ->pluck('member_id')
//                     ->toArray();

//     if (!empty($memberIds)) {
//         $groupName = DB::table('groups')->where('id', $group_id)->value('name');

//          $message = $groupName . ' new topic has been posted: ' . Str::limit($request->description, 50);

//         // Assuming you have notification service
//        $notification = $this->notificationService->notifyMemberAdded(
//             $memberIds,
//             'admin_group_topic',
//             $message,
//             $group_id,
//             'group_topic',
//             Auth::id()
//         );

//     }

//     return redirect()->route('group.index')->with('success', 'Group post (topic) added successfully.');
// }

public function save_topic(Request $request, $group_id)
{
    // 1️⃣ Validation
    $request->validate([
        'description' => 'nullable|string',
        'video_link' => 'nullable|url',
        'video_caption' => 'nullable|string',
        'status' => 'required|integer',
        'doc' => 'nullable|file|mimes:pdf,jpg,png,gif',
        'topic_image' => 'nullable|file|mimes:jpg,png,gif',
        'video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:102400'
    ]);

    // 2️⃣ Handle topic image
    $imageFile = $request->hasFile('topic_image')
        ? $request->file('topic_image')->store('uploads/topics', 'public')
        : null;

    // 3️⃣ Handle YouTube embed link
    $embedLink = '';
    if ($request->video_link) {
        parse_str(parse_url($request->video_link, PHP_URL_QUERY), $query);
        $embedLink = isset($query['v']) ? "https://www.youtube.com/embed/" . $query['v'] : $request->video_link;
    }

    // 4️⃣ Determine media type
    $media_type = null;
    if ($imageFile && $embedLink) {
        $media_type = 'photo_video';
    } elseif ($imageFile) {
        $media_type = 'photo';
    } elseif ($embedLink) {
        $media_type = 'video';
    }

    // 5️⃣ Save post
    $post = Post::create([
        'group_id'    => $group_id,
        'member_id'   => Auth::id(),
        'content'     => $request->description,
        'media_type'  => $media_type,
        'video_link'  => $embedLink,
        'status'      => $request->status
    ]);

    // 6️⃣ Save topic image as PostMedia
    if ($imageFile) {
        PostMedia::create([
            'post_id'   => $post->id,
            'file_path' => $imageFile,
            'file_type' => 'image',
        ]);
    }

    // 7️⃣ Get group members (mentor + mentees)
    $groupMember = DB::table('group_member')->where('group_id', $group_id)->first();

    $memberIds = [];

    if ($groupMember) {
        // Add mentor
        if ($groupMember->mentor) {
            $memberIds[] = $groupMember->mentor;
        }

        // Add mentees
        if ($groupMember->mentiee) {
            $mentees = json_decode($groupMember->mentiee, true);
            if (!empty($mentees)) {
                $memberIds = array_merge($memberIds, $mentees);
            }
        }
    }

    // 8️⃣ Send notifications to all members
    if (!empty($memberIds)) {
        $groupName = DB::table('groups')->where('id', $group_id)->value('name');

        $message = $groupName . ' new topic has been posted: ' . Str::limit($request->description, 50);

        $this->notificationService->notifyMemberAdded(
            $memberIds,
            'admin_group_topic',
            $message,
            $group_id,
            'group_topic',
            Auth::id()
        );
    }

    // 9️⃣ Redirect with success
    return redirect()->route('group.index')->with('success', 'Group topic added successfully.');
}

    public function view_topic($id)
        {
            $groupId = Crypt::decryptString($id); 
            $pageName = 'Group';
            $group = Group::findOrFail($groupId);
            $topics = Post::where('group_id', $groupId)->with('member', 'media')->get();
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


//     public function deleteTopic($id) {
//     // post::destroy($id);
//     // return back()->with('success', 'Topic deleted.');
//      $post = DB::table('posts')->where('id', $id)->first();
//     if (!$post) {
//         return response()->json(['message' => 'Post not found'], 404);
//     }
//     // Step 2: Delete media files (optional: physical file also)
//     $mediaItems = DB::table('post_media')->where('post_id', $id)->get();
//     foreach ($mediaItems as $media) {
//         $path = storage_path('app/public/' . $media->file_path);
//         if (file_exists($path)) {
//             unlink($path); // delete physical file
//         }
//     }
//     // Step 3: Delete media from table
//     DB::table('post_media')->where('post_id', $id)->delete();
//     // Step 4: Delete post
//     DB::table('posts')->where('id', $id)->delete();
//      return back()->with('success', 'Group Post deleted successfully.');
//  }


public function deleteTopic($id)
{
    // 1️⃣ Get post
    $post = DB::table('posts')->where('id', $id)->first();
    if (!$post) {
        return response()->json(['message' => 'Post not found'], 404);
    }

    $group_id = $post->group_id;

    // 2️⃣ Delete media files (including physical files)
    $mediaItems = DB::table('post_media')->where('post_id', $id)->get();
    foreach ($mediaItems as $media) {
        $path = storage_path('app/public/' . $media->file_path);
        if (file_exists($path)) {
            unlink($path);
        }
    }

    // 3️⃣ Delete media + post
    DB::table('post_media')->where('post_id', $id)->delete();
    DB::table('posts')->where('id', $id)->delete();

    // 4️⃣ Prepare group members for notification
    $groupMember = DB::table('group_member')->where('group_id', $group_id)->first();
    $memberIds = [];

    if ($groupMember) {
        // Add mentor
        if ($groupMember->mentor) {
            $memberIds[] = $groupMember->mentor;
        }
        // Add mentees
        if ($groupMember->mentiee) {
            $mentees = json_decode($groupMember->mentiee, true);
            if (!empty($mentees)) {
                $memberIds = array_merge($memberIds, $mentees);
            }
        }
    }

    // 5️⃣ Send notification to members
    if (!empty($memberIds)) {
        $groupName = DB::table('groups')->where('id', $group_id)->value('name');

        $message = $groupName . ' topic has been deleted: ' . Str::limit($post->content, 50);

        $this->notificationService->notifyMemberAdded(
            $memberIds,
            'admin_group_topic_deleted',
            $message,
            $group_id,
            'group_topic',
            Auth::id()
        );
    }

    // 6️⃣ Return response
    return back()->with('success', 'Group Post deleted successfully.');
}

  public function topicToggleStatus(Request $request)
    {
        $topic = Topic::findOrFail($request->id);
        $oldStatus = $topic->status;
        $topic->status = $request->status;
        $topic->save();

        if ($oldStatus == 0 && $topic->status == 1) {
            $groupMembers = GroupMember::where('group_id', $topic->group_id)->first();
            if ($groupMembers) {
                $mentorId = $groupMembers->mentor;
                $mentiees = json_decode($groupMembers->mentiee, true);

                $notificationsSent = false;

                if ($mentorId) {
                    $groupName = DB::table('groups')->where('id', $topic->group_id)->value('name');
                    $mentorMessage = $groupName . ' topic has been activated as mentor: ' . $topic->title;
                    $mentorNotification = $this->notificationService->notifyMemberAdded(
                        [$mentorId],
                        'group',
                        $mentorMessage,
                        $topic->group_id,
                        'group_topic'
                    );

                    if ($mentorNotification) {
                        Member::query()->whereIn('id', [$mentorId])->update(['is_notification' => 0]);
                        $notificationsSent = true;
                    }
                }

                if (!empty($mentiees)) {
                    $mentieeMessage = $topic->title . ' topic has been activated as mentiee';
                    $mentieeNotification = $this->notificationService->notifyMemberAdded(
                        $mentiees,
                        'group',
                        $mentieeMessage,
                        $topic->group_id,
                        'group_topic'
                    );

                }

                if ($notificationsSent) {
                    // Optionally update a notified_at field or similar
                }
            }
        }


        return response()->json(['message' => 'Status updated successfully.']);
    }

    function store_ajax(Request $request)
    {
        

        if($request->group_id) {
            // Update existing group
            $group = GroupMember::where('group_id', $request->group_id)->first();

            if ($group) {
                
                // $existingMentees = json_decode($group->mentiee, true) ?? [];
                // $newMentees = $request->input('mentees', []);
                // $updatedMentees = array_unique(array_merge($existingMentees, $newMentees));

                // $group->update([
                //     'mentiee' => json_encode(array_values($updatedMentees)),
                // ]);

                $existingMentees = json_decode($group->mentiee, true) ?? [];
                $newMentees = $request->input('mentees', []);
                $removed = array_diff($existingMentees, $newMentees);
                $added = array_diff($newMentees, $existingMentees);
                $updatedMentees = $newMentees;

                $group->update([
                    'mentiee' => json_encode(array_values($updatedMentees)),
                ]);
            }
            $message = 'Group updated successfully!';
        }
        else {
            // Create new group

            $request->validate([
                'group_name'  => 'required|string|max:255',
                // 'service'     => 'required|string|max:255',
                'mentees'     => 'required|array',
                'grp_image'   => 'required|image|mimes:jpeg,png,jpg,avif|max:2048',
                'end_date'    => 'required|date|after_or_equal:today',
            ]);

            // Image Upload
            $imagePath = null;
            if ($request->hasFile('grp_image')) {
                $imagePath = $request->file('grp_image')->store('uploads/images/grp_img', 'public');
            }

            // Create Group
            $group = Group::create([
                'name'       => $request->input('group_name'),
                'end_date'   => $request->input('end_date'),
                'status'     => 1,
                'created_by' => auth()->guard('user')->id(),
                'image'      => $imagePath ? basename($imagePath) : null,
                'member_type' => 2 // this is created by user so thats why here 2
            ]);

            GroupMember::create([
                'group_id' => $group->id,
                'member_id' => auth()->guard('user')->id(),
                'mentor' => auth()->guard('user')->id(),
                'mentiee' => json_encode($request->input('mentees')),
                'status' => 1,
            ]);

            $message = 'Group created successfully!';
        }
    
        // Notify only if status is active and not yet notified
        if ($group->status == 1 && $group->notified_at == 0) {
            $mentorId = $request->input('mentor_id');
            $userIds = $request->input('user_id', []);
    
            $notificationsSent = false;
    
            if ($mentorId) {

                $mentorMessage = $group->name . ' group has been added as mentor';
    
                    $mentorNotification = $this->notificationService->notifyMemberAdded(
                        $mentorId,
                        'group_member',
                        $mentorMessage,
                        $group->id,
                        'group',
                        auth()->id()
                    );
                
            }

            if (!empty($userIds)) {
                $mentieeMessage = $group->name . ' group has been added as mentiee';
                    $mentieeNotification = $this->notificationService->notifyMemberAdded(
                        $userIds,
                        'group_member',
                        $mentieeMessage,
                        $group->id,
                        'group',
                        auth()->id()
                );

            }

        }

        $this->recentActivityService->logActivity(
            'New Group Created',
            'Group',
            auth()->guard('user')->id(),
            'Added new member: ' . $group->name,
            2, // 2 means user
            $group->id
        );
        // Return JSON for AJAX
        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function getMembers(Request $request)
    {
        $search = $request->get('search');
        $service = $request->get('service');
        $year = $request->get('year');
        $cadre = $request->get('cadre');

        $query = Member::where('status',1);
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        if ($service) {
            $query->where('service', $service);
        }
        if ($year) {
            $query->whereIn('batch', (array)$year);
        }
        if ($cadre) {
            $query->whereIn('cader', (array)$cadre);
        }
        $members = $query->limit(50)->get(['id','name']); // limit for performance
        return response()->json($members);
    }

    function getGroupMembers() {
        $groupId = request()->get('group_id');
        $group = Group::where('id', $groupId)->with('members')->first();
        $members = DB::table('members')
                ->select('Service', DB::raw('COUNT(*) as count'))
                ->groupBy('Service')
                ->get();
        $html = view('layouts.group-modal-admin', compact('group', 'members'))->render();
        return response()->json($html);
    }

    function store_ajax_admin_side(Request $request) {

        $request->validate([
            'group_id'    => 'required|integer|exists:groups,id',
            'mentees'     => 'required|array',
        ]);

        if(isset($request->group_id)) {
            $group = Group::find($request->group_id);

            GroupMember::updateOrCreate([
                'group_id' => $group->id,
            ], [
                'mentiee' => json_encode($request->input('mentees')),
                'status' => 1,
            ]);
        }

        $this->recentActivityService->logActivity(
            'Group Members Updated',
            'Group',
            auth()->guard('admin')->id(),
            'Updated members for group: ' . $group->name,
            1, // Assuming 1 represents admin
            $group->id
        );

        // Return JSON for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Group updated successfully!',
        ]);
    }

    function getExistingMembers(Request $request)
    {
        $groupId = $request->get('group_id');
        $members = GroupMember::where('group_id', $groupId)->first();

        $memberIds = [];
        if ($members) {
            if (!empty($members->mentor)) {
                $memberIds[] = $members->mentor;
            }

            if (!empty($members->mentiee)) {
                $mentieeIds = json_decode($members->mentiee, true);
                if (is_array($mentieeIds)) {
                    $memberIds = array_merge($memberIds, $mentieeIds);
                }
            }
        }

        $members = Member::whereIn('id', $memberIds)->get(['id', 'name']);
        // $members->map(function ($member) {
        //     $member->id = $member->id;
        //     $member->name = $member->name;
        // });
        // dd($members);
        return response()->json($members);
    }
}
