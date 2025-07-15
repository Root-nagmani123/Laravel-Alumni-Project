<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

use App\Models\Story;

class StoryController extends Controller
{

	public function store(Request $request)
    {
        $request->validate([
            'story_file' => 'required|file|mimes:jpg,jpeg,png,webp,gif,svg,mp4,mov,avi|max:10240', // 10MB

             //'story_file' => 'required|file|mimes:jpg,jpeg,png|max:10240', // 10MB max
        ]);

        $path = $request->file('story_file')->store('stories', 'public');
//dd($request);
        Story::create([
            'member_id' => Auth::guard('user')->id(),
            'story_image' => $path,
        ]);

        return redirect()->back();
        //return redirect()->route('/feed')->with('success', 'Story added!');
    }

    public function destroy($id)
    {
        $story = Story::findOrFail($id);

       // if ($story->user_id !== auth('user')->id()) {
       if ($story->member_id !== Auth::guard('user')->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Optional: Delete file from storage
       if ($story->story_image && \Storage::disk('public')->exists($story->story_image)) {
                \Storage::disk('public')->delete($story->story_image);
            }

        $story->delete();

        return response()->json(['success' => true]);
    }
}
