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
            'story_file' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048',

              ]);

        $file = $request->file('story_file');
        
        // Server-side MIME validation (reads actual file content, not headers)
        if (!$file || !$file->isValid()) {
            return redirect()->back()
                ->withErrors(['story_file' => 'Invalid file upload. Please try again.'])
                ->withInput();
        }
        
        $mimeType = getSecureMimeType($file);
        $allowedMimes = ['image/jpeg', 'image/png', 'image/gif'];
        
        // Explicitly reject HTML/text files
        if ($mimeType && (
            strpos($mimeType, 'text/html') !== false ||
            strpos($mimeType, 'text/plain') !== false ||
            strpos($mimeType, 'application/xhtml') !== false ||
            strpos($mimeType, 'text/xml') !== false
        )) {
            return redirect()->back()
                ->withErrors(['story_file' => 'HTML and text files are not allowed. Only JPEG, PNG, and GIF images are allowed.'])
                ->withInput();
        }
        
        if (!$mimeType || !in_array($mimeType, $allowedMimes)) {
            return redirect()->back()
                ->withErrors(['story_file' => 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.'])
                ->withInput();
        }
        
        // Map MIME type to extension (security: don't trust filename extension)
        $extensionMap = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif'
        ];
        $extension = $extensionMap[$mimeType];
        $filename = uniqid() . '.' . time() . '.' . $extension;

    // store with custom name
    $path = $file->storeAs('stories', $filename, 'private');


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
       if ($story->story_image && \Storage::disk('private')->exists($story->story_image)) {
                \Storage::disk('private')->delete($story->story_image);
            }

        $story->delete();

        return response()->json(['success' => true]);
    }
}
