<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Models\Comment;

class CommentController extends Controller
{
    protected $notificationService;
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
             'comment' => [
            'required',
            'string',
            'max:1000',
            function ($attribute, $value, $fail) {
                if ($value !== strip_tags($value)) {
                    $fail('HTML and JavaScript are not allowed in comments.');
                }
            },
        ],
    ]);

    $comment = Comment::create([
        'post_id' => $request->post_id,
        'member_id' => auth()->guard('user')->id(),
        'comment' => strip_tags($request->comment),
    ]);

    $group_id = $comment->post->group_id;

    if($comment){
        $this->notificationService->notifyPostOwner($comment->post->member_id, auth()->guard('user')->id(), 'comment', "{$comment->member->name} commented on your post", $group_id, 'group');
    }

    if ($request->ajax()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Comment added successfully!',
            'comment' => $comment
        ]);
    }

    return back();
   // return back()->with('success', 'Commentss added successfully!');
    }

   public function update(Request $request, $id)
    {
    $request->validate([
       'comment' => [
            'required',
            'string',
            'max:1000',
            function ($attribute, $value, $fail) {
                if ($value !== strip_tags($value)) {
                    $fail('HTML and JavaScript are not allowed in comments.');
                }
            },
        ],
    ]);

    $comment = Comment::findOrFail($id);

    // Ensure user owns the comment
    if ($comment->member_id !== auth()->guard('user')->id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $comment->comment = strip_tags($request->comment);
    $comment->save();

    return response()->json(['success' => true, 'message' => 'Comment updated']);
    }

 public function destroy($id)
    {
    $comment = Comment::findOrFail($id);

    if ($comment->member_id !== auth()->guard('user')->id()) {
        return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
    }

    $comment->delete();

    return response()->json(['success' => true, 'message' => 'Comment deleted.']);
    }

public function loadComments_old_22_08_2025($postId)
    {
        $offset = request('offset', 0);
        $limit = 5; // or any number you want

        $comments = Comment::with('member')
            ->where('post_id', $postId)
            ->latest()
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json(['comments' => $comments]);

        /*return response()->json([
    'comments' => $comments->map(function ($comment) {
        return [
            'id' => $comment->id,
            'comment' => e($comment->comment),
            'member_id' => $comment->member_id,
            'created_at_human' => $comment->created_at->diffForHumans(),
            'member' => $comment->member ? [
                'name' => $comment->member->name,
                'profile_pic' => $comment->member->profile_pic,
            ] : null,
        ];
    }),
    'authUserId' => auth()->guard('user')->id(),
]);
*/
    }

    public function loadComments($postId)
{
    $offset = request('offset', 0);
    $limit = 5; // or any number you want

    $comments = Comment::with('member')
        ->where('post_id', $postId)
        ->latest()
        ->skip($offset)
        ->take($limit)
        ->get();

    // Parse mentions in each comment text
    $comments->transform(function ($comment) {
        $commentText = $comment->comment;

        $commentText = preg_replace_callback(
            '/@([a-zA-Z0-9_.]+)/',
            function ($matches) {
                $username = $matches[1];
                $user = \App\Models\Member::where('username', $username)->first();

                if ($user) {
                    $url = route('user.profile.data', ['id' => Crypt::encrypt($user->id)]);
                    return "<a href='{$url}' 
                        class='mention-badge text-primary fw-semibold text-decoration-none' 
                        data-bs-toggle='tooltip' 
                        data-bs-placement='top' 
                        title='{$user->name} | {$user->designation}'>
                        @{$username}
                    </a>";
                }

                return $matches[0]; // if user not found, return plain text
            },
            $commentText
        );

        $comment->parsed_comment = $commentText;
        return $comment;
    });

    return response()->json(['comments' => $comments]);
}


}


