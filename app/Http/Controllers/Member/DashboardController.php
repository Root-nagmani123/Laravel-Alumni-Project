<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Story;
class DashboardController extends Controller
{
public function index()
{
    $posts = Post::latest()->take(10)->get();
    $stories = Story::latest()->take(5)->get();

    return view('member.dashboard', compact('posts', 'stories'));
}

public function like(Request $request)
{
    $post = Post::findOrFail($request->id);
    $post->likes += 1;
    $post->save();
    return response()->json(['success' => true]);
}

public function comment(Request $request)
{
    $request->validate(['comm_text' => 'required|string']);
    $post = Post::findOrFail($request->id);
    $post->comments()->create([
        'user_id' => auth()->id(),
        'body' => $request->comm_text,
    ]);
    return response()->json(['success' => true]);
}

public function updateRSVP(Request $request)
{
    $request->validate(['event_id' => 'required', 'status' => 'required|in:yes,maybe,no']);
    auth()->user()->rsvps()->updateOrCreate(
        ['event_id' => $request->event_id],
        ['status' => $request->status]
    );
    return response()->json(['success' => true]);
}
}