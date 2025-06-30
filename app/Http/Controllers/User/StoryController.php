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
            'story_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $path = $request->file('story_image')->store('stories', 'public');

        Story::create([
            'member_id' => Auth::guard('user')->id(),
            'story_image' => $path,
        ]);

        return redirect()->back()->with('success', 'Story added!');
    }
}
