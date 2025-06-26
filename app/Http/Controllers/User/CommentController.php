<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Comment;

class CommentController extends Controller
{
    public function store_26062025(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string|max:1000',
        ]);

       /*   if (!auth()->check()) {
        return back()->with('error', 'User not logged in');
    }*/


        Comment::create([
            'post_id' => $request->post_id,
            'member_id' => auth()->guard('user')->id(),
            'comment' =>  strip_tags($request->comment),
        ]);

        return back()->with('success', 'Comment added successfully!');

    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'member_id' => auth()->guard('user')->id(),
            'comment' => strip_tags($request->comment),
        ]);

        $member = $comment->member;

        return response()->json([
            'comment' => $comment->comment,
            'created_at' => $comment->created_at->diffForHumans(),
            'member_name' => $member->name ?? 'Anonymous',
            'member_pic' => $member && $member->profile_pic
                ? asset('storage/' . $member->profile_pic)
                : asset('feed_assets/images/avatar-1.png'),
        ]);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'comment' => 'required|string|max:1000',
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
}


