<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
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
            //'member_id' => auth()->id(), // Ensure user is logged in
            'member_id' => auth()->id(),
            'comment' =>  strip_tags($request->comment),
        ]);

        return back()->with('success', 'Comment added successfully!');

    }
}


