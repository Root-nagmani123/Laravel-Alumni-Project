<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Story;
use App\Models\Topic;
use App\Models\Broadcast;
use App\Models\Member;
use App\Services\NotificationService;

use App\Models\Group;


class FeedController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index_old()
    {
        $user = auth()->guard('user')->user();
        $userId = $user->id;
	    $posts = Post::with(['member', 'media', 'likes', 'comments.member'])
        ->orderBy('created_at', 'desc')
        ->get();


           //dd($posts);
          // dd($user);
           $broadcast = DB::table('broadcasts')
                ->where('status',1)
            ->orderBy('broadcasts.id', 'desc')
            ->get();
          $events = DB::table('events')
        ->where('status', 1)
        ->where('end_datetime', '>', now())
        ->orderBy('id', 'desc')
        ->get();
// print_r($events);die;

    // RSVP Events by status
    $accept_events = DB::table('events')
        ->join('event_rsvp', 'events.id', '=', 'event_rsvp.event_id')
        ->where('event_rsvp.user_id', $userId)
        ->where('event_rsvp.status', 'accept')
        ->where('events.status', 1)
        ->where('events.end_datetime', '>', now())
        ->select('events.*')
        ->orderBy('events.id', 'desc')
        ->get();

    $maybe_events = DB::table('events')
        ->join('event_rsvp', 'events.id', '=', 'event_rsvp.event_id')
        ->where('event_rsvp.user_id', $userId)
        ->where('event_rsvp.status', 'maybe')
        ->where('events.status', 1)
        ->where('events.end_datetime', '>', now())
        ->select('events.*')
        ->orderBy('events.id', 'desc')
        ->get();

    $decline_events = DB::table('events')
        ->join('event_rsvp', 'events.id', '=', 'event_rsvp.event_id')
        ->where('event_rsvp.user_id', $userId)
        ->where('event_rsvp.status', 'decline')
        ->where('events.status', 1)
        ->where('events.end_datetime', '>', now())
        ->select('events.*')
        ->orderBy('events.id', 'desc')
        ->get();

        $forums = DB::table('forums as f')
            ->join('forum_topics as ft', 'ft.forum_id', '=', 'f.id')
            ->join('forums_member as fm', 'fm.forums_id', '=', 'f.id')
            ->select('f.id', 'f.name','ft.id as topic_id', 'ft.title as topic_name', 'ft.description','ft.images','ft.created_date')
            ->where('fm.user_id', $userId)
            ->get();
        // print_r($forums);die;


    return view('user.feed', compact(
        'posts',
        'user',
        'broadcast',
        'events',
        'accept_events',
        'maybe_events',
        'decline_events',
        'forums'
    ));

   return view('user.feed', compact('posts','user'));
    }

   public function index()
    {
        $user = auth()->guard('user')->user();
        
        $userId = $user->id;
        // Fetch posts with related models
        $stories = Story::where('created_at', '>=', now()->subDay())
                     ->with('user')
                     ->get();

         $storiesByMember = $stories->groupBy('member_id');
         $broadcast = DB::table('broadcasts')
                ->where('status',1)
            ->orderBy('broadcasts.id', 'desc')
            ->get();

          $events = DB::table('events')
        ->where('status', 1)
        ->where('end_datetime', '>', now())
        ->orderBy('id', 'desc')
        ->get();

    $forums = DB::table('forums as f')
    ->join('forums_member as fm', 'fm.forums_id', '=', 'f.id')
    ->select(
        'f.id', 
        'f.name',
        'f.images',
        'f.created_at',
        'f.end_date', // Assuming you have an end_date column
    )
    ->where('fm.user_id', $userId)
    ->where('f.status', 1)
    ->where(function($query) {
        $query->whereNull('f.end_date')
              ->orWhere('f.end_date', '>=', now());
    })
      ->orderBy('f.id', 'desc') 
    ->get();


    $groupIds = DB::table('group_member')
    ->where('status', 1)
    ->where(function ($query) use ($userId) {
        $query->where('mentor', $userId)
              ->orWhereRaw("JSON_CONTAINS(mentiee, '\"$userId\"')");
    })
    ->pluck('group_id');

  $groupNames = DB::table('groups as g')
    ->join('group_member as gm', 'g.id', '=', 'gm.group_id')
    ->whereIn('g.id', $groupIds)
    ->where('g.status', 1)
    ->where(function($query) {
        $query->whereNull('g.end_date')
              ->orWhere('g.end_date', '>=', now());
    })
   ->select(
        'g.id',
        'g.name',
        'g.image',
        'g.end_date'
    )
    ->orderBy('g.id', 'desc') // or 'end_date', 'desc' if you prefer
    ->distinct()
    ->get();
    // print_r($groupNames);die;


    $members = Member::all();

    $posts = Post::with(['member', 'media', 'likes', 'comments.member', 'group'])
    ->where(function ($query) use ($groupIds) {
        $query->whereNull('group_id') // normal post bhi chahiye
              ->orWhereIn('group_id', $groupIds); // ya phir allowed group_id
    })
    ->orderBy('created_at', 'desc')
    ->get()
    ->map(function ($post) {
        return (object)[
            'id' => $post->id,
            'content' => $post->content,
            'created_at' => $post->created_at,
            'type' => $post->group_id ? 'group_post' : 'post',
            'group_loaded' => $post->relationLoaded('group') ? 'yes' : 'no',
            'group_name' => $post->group->name ?? 'No Group',
            'member' => $post->member,
            'media' => $post->media,
            'likes' => $post->likes,
            'comments' => $post->comments,
            'video_link' => $post->video_link,
            'shares' => $post->shares,
            'group_image' => '',
            'group_id' => $post->group_id,
        ];
    });

    return view('user.feed', compact('posts', 'user', 'storiesByMember', 'broadcast','events', 'forums', 'groupNames', 'members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'nullable|string|max:1000',
            'media.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:30720', // 30MB
        ]);

        $images = 0;
        $videos = 0;

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $mime = $file->getMimeType();
                if (str_starts_with($mime, 'video')) $videos++;
                elseif (str_starts_with($mime, 'image')) $images++;
            }

            if ($images > 12) {
                return response()->json(['errors' => ['media' => ['Maximum 12 images allowed.']]], 422);
            }
            if ($videos > 5) {
                return response()->json(['errors' => ['media' => ['Maximum 5 videos allowed.']]], 422);
            }
        }

        $post = Post::create([
            'member_id' => Auth::guard('user')->id(),
            'content' => $request->content,
        ]);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('public/posts');
                PostMedia::create([
                    'post_id' => $post->id,
                    'media_type' => str_starts_with($file->getMimeType(), 'video') ? 'video' : 'image',
                    'media_url' => Storage::url($path),
                ]);
            }
        }

         return response()->json([
        'success' => true,
        'message' => 'Post added successfully.',
           ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $results = Post::where('content', 'like', "%$keyword%")
            ->with('member')
            ->limit(10)
            ->get();

        if ($results->isEmpty()) {
            return '<ul class="crowd_search_list"></ul>';
        }

        $html = '<ul class="crowd_search_list">';
        foreach ($results as $result) {
            $html .= '<li>' . e($result->content) . '</li>';
        }
        $html .= '</ul>';

        return $html;
    }
    public function toggleLike(Post $post)
{
    $user = auth('user')->user();
    $liked = $post->likes()->where('member_id', $user->id)->exists();

    if ($liked) {
        $post->likes()->where('member_id', $user->id)->delete();
    } else {
        $post->likes()->create(['member_id' => $user->id]);
    }

    $likeUsersTooltip = $post->likes()->with('member')->get()->pluck('member.name')->implode('<br>');

    return response()->json([
        'like_count' => $post->likes()->count(),
        'tooltip_html' => $likeUsersTooltip ?: 'No likes yet',
    ]);
}
    public function storePostComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $post = Post::findOrFail($id);
        $userId = auth('user')->id();

        $comment = $post->comments()->create([
            'member_id' => $userId,
            'content' => $request->comment,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully.',
            'comment' => $comment,
        ]);
    }

 public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $post = Post::findOrFail($id);
        $userId = auth('user')->id();

        $comment = $post->comments()->create([
            'member_id' => $userId,
            'content' => $request->comment,
        ]);

        // Notify the post owner (if not commenting on own post)
        if ($post->member_id != $userId) {
            $this->notificationService->notifyPostOwner(
                $post->member_id,           // post owner
                $userId,                // who commented
                'comment',                // type
                auth('user')->user()->name . ' commented on your post.', // message
                $post->id,                // source_id
                'post'                    // source_type
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully.',
            'comment' => $comment,
        ]);
    }
    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $userId = auth('user')->id();

        if ($comment->member_id !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['success' => true, 'message' => 'Comment deleted successfully.']);
    }
    public function replyToComment(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);
        $comment = Comment::findOrFail($id);
        $userId = auth('user')->id();
        $reply = $comment->replies()->create([
            'member_id' => $userId,
            'content' => $request->reply,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Reply added successfully.',
            'reply' => $reply,
        ]);
    }

    public function broadcastDetails($id)
    {
        $broadcast = Broadcast::findOrFail($id);

        return view('user.broadcast_details', compact('broadcast'));
    }

     public function groupPostDetails($id)
    {
        $grouppost_detail = Post::findOrFail($id);

        return view('user.grouppost_details', compact('grouppost_detail'));
    }

    public function getPostByGroup_2872025($group_id)
    {
        // $posts = Post::with('member')
         $posts = Post::with(['member', 'media'])
                    ->where('group_id', $group_id)
                    ->latest()
                    ->get();
                    // print_r($posts);die;
                  $group = Group::where('id', $group_id)->select('name')->firstOrFail();
                //   print_r($group);die;

        return view('user.grouppost_details', compact('posts', 'group'));
    }

    public function getPostByGroup($group_id)
    {
       $userId = auth()->guard('user')->id();
        $posts = Post::with(['member', 'media'])
            ->where('group_id', $group_id)
            ->latest()
            ->get();


        $group = Group::find($group_id); // Fetch the group by ID
         $groupMember = DB::table('group_member')
        ->where('group_id', $group_id)
        ->first();

    // Determine if user is a mentee
    $isMentee = 0;
    if ($groupMember && $groupMember->mentiee) {
        $mentiees = json_decode($groupMember->mentiee, true);
        $isMentee = in_array($userId, $mentiees) ? 1 : 0;
    }
// echo ($isMentee);die;
        return view('user.grouppost_details', compact('posts', 'group','isMentee'));
    }
    public function leaveGroup(Request $request)
{
    $request->validate([
        'group_id' => 'required|integer|exists:group_member,group_id',
    ]);
    $groupId = $request->input('group_id');
     $userId = auth()->guard('user')->id();// ya session('LoginID')

    // Step 1: Get the existing mentiee array
    $groupMember = DB::table('group_member')
        ->where('group_id', $groupId)
        ->first();

    if (!$groupMember) {
        return back()->with('error', 'Group not found.');
    }

    $mentiees = json_decode($groupMember->mentiee, true);

    // Step 2: Remove user ID from the array
    $updatedMentiees = array_filter($mentiees, function ($id) use ($userId) {
        return $id != $userId;
    });

    // Re-index the array to maintain proper JSON structure
    $updatedMentiees = array_values($updatedMentiees);
// print_r($updatedMentiees);die;
    // Step 3: Update the record
    DB::table('group_member')
        ->where('group_id', $groupId)
        ->update([
            'mentiee' => json_encode($updatedMentiees),
        ]);

   return redirect()->route('user.feed')->with('success', 'You have left the group.');

}
function submitGrievance(Request $request)
{
    $user = auth()->guard('user')->user();
    $name = $user->name;
    $email = $user->email;

    $grievanceType = request('typeSelect');
    $grievanceMessage = request('userMessage');

    // Validate the input
    $validatedData = request()->validate([
        'typeSelect' => 'required|string|max:255',
        'userMessage' => 'required|string|max:1000',
    ]);

    // Store the grievance in the database
    DB::table('grievances')->insert([
        'name' => $name,
        'email' => $email,
        'type' => $grievanceType,
        'message' => $grievanceMessage,
        'created_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Grievance submitted successfully.');
    
}



}

