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
            //'story_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            // 'story_file' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,pdf|max:10240', // 10MB max
             'story_file' => 'required|file|mimes:jpg,jpeg,png|max:10240', // 10MB max
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
}
