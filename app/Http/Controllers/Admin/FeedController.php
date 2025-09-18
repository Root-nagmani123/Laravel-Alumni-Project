<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Member, Post};
class FeedController extends Controller
{
    public function index()
    {
        $posts = Post::latest('id')->paginate(10);
        return view('admin.feeds.index', compact('posts'));
    }

    function approve(Request $request)
    {
        $post = Post::findOrFail($request->_post_id);
        $post->approved_by_moderator = 1;
        $post->save();

        return redirect()->route('admin.feeds.index')->with('success', 'Post approved successfully.');
    }

    function decline(Request $request)
    {
        $post = Post::findOrFail($request->_post_id);
        $post->approved_by_moderator = 2;
        $post->save();

        return redirect()->route('admin.feeds.index')->with('success', 'Post declined successfully.');
    }

    function view(Request $request)
    {
        $post = Post::with(['member', 'likes', 'comments'])->findOrFail($request->post_id);
        $html = view('partials.post-field-details', compact('post'))->render();
        return response()->json(['html' => $html]);
    }
}
