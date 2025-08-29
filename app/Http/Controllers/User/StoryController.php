<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

use App\Models\Story;
use App\Services\RecentActivityService;

class StoryController extends Controller
{
    protected $recentActivityService;

    function __construct(RecentActivityService $recentActivityService) {
        $this->recentActivityService = $recentActivityService;
    }
	public function store(Request $request)
    {
        $request->validate([
            'story_file' => 'required|file|mimes:jpg,jpeg,png,webp,gif,svg,mp4,mov,avi|max:10240', // 10MB

              ]);

        // $path = $request->file('story_file')->store('stories', 'public');
          // get original extension (jpg, png, mp4, etc.)
    $extension = $request->file('story_file')->getClientOriginalExtension();

    // create dynamic filename -> e.g. memberID_timestamp.extension
    $filename = 'story_' . Auth::guard('user')->id() . '_' . time() . '.' . $extension;

    // store with custom name
    $path = $request->file('story_file')->storeAs('stories', $filename, 'public');


        $story = Story::create([
            'member_id' => Auth::guard('user')->id(),
            'story_image' => $path,
        ]);

        $this->recentActivityService->logActivity(
            'Story Added',
            'Stories',
            auth()->guard('user')->id(),
            'New Story Added',
            2,
            $story->id
        );
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
