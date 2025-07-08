<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Comment;

class CommentController extends Controller
{
    public function store_8072025(Request $request)
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

    if ($request->ajax()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Comment added successfully!',
            'comment' => $comment
        ]);
    }

    return back()->with('success', 'Comment added successfully!');
}


//     public function update(Request $request, $id)
// {
//     $request->validate([
//         'comment' => 'required|string|max:1000',
//     ]);

//     $comment = Comment::findOrFail($id);

//     // Ensure user owns the comment
//     if ($comment->member_id !== auth()->guard('user')->id()) {
//         return response()->json(['message' => 'Unauthorized'], 403);
//     }

//     $comment->comment = strip_tags($request->comment);
//     $comment->save();

//     return response()->json(['success' => true, 'message' => 'Comment updated']);
//  }

//   public function destroy($id)
// {
//     $comment = Comment::findOrFail($id);

//     if ($comment->member_id !== auth()->guard('user')->id()) {
//         return response()->json(['error' => 'Unauthorized'], 403);
//     }

//     $comment->delete();

//     return response()->json(['success' => true]);
// }
public function update_222(Request $request, Comment $comment)
{
    $this->validate($request, [
        'comment' => 'required|string|max:1000',
    ]);

    if ($comment->member_id !== auth('user')->id()) {
        abort(403);
    }

    $comment->update([
        'comment' => $request->comment
    ]);

    return redirect()->back()->with('success', 'Comment updated successfully.');
}

public function destroy_old(Comment $comment)
{
    if ($comment->member_id !== auth('user')->id()) {
        abort(403);
    }

    $comment->delete();

    return response()->json(['success' => true]);
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

  public function destroy_222($id)
{
    $comment = Comment::findOrFail($id);

    if ($comment->member_id !== auth()->guard('user')->id()) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $comment->delete();

    return response()->json(['success' => true]);
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

    return response()->json(['comments' => $comments]);
}

}


