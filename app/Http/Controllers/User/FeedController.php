<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class FeedController extends Controller
{
    public function index()
    {
        $user = auth()->guard('user')->user();
        $userId = $user->id;
		//$posts = Post::with(['media', 'user'])->latest()->get();
        //$posts = Post::with(['member', 'media', 'likes', 'comments'])->get();
        $posts = Post::with(['member', 'media', 'likes', 'comments'])
             ->orderBy('created_at', 'desc')
             ->where('member_id', $userId)
             ->get();

            // echo '<pre>';print_r($posts); die;

        return view('user.feed', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'nullable|string|max:1000',
            'media.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:30720', // 30MB
        ]);

        $images = 0;
        $videos = 0;

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $mime = $file->getMimeType();
                if (str_starts_with($mime, 'video')) $videos++;
                elseif (str_starts_with($mime, 'image')) $images++;
            }

            if ($images > 12) {
                return response()->json(['errors' => ['media' => ['Maximum 12 images allowed.']]], 422);
            }
            if ($videos > 5) {
                return response()->json(['errors' => ['media' => ['Maximum 5 videos allowed.']]], 422);
            }
        }

        $post = Post::create([
            'member_id' => Auth::guard('user')->id(),
            'content' => $request->content,
        ]);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('public/posts');
                PostMedia::create([
                    'post_id' => $post->id,
                    'media_type' => str_starts_with($file->getMimeType(), 'video') ? 'video' : 'image',
                    'media_url' => Storage::url($path),
                ]);
            }
        }

         return response()->json([
        'success' => true,
        'message' => 'Post added successfully.',
        // 'html' => view('member.dashboard.partials.post', compact('post'))->render(),
        ]);
        // return redirect()->route('user.feed1')->with('success', 'Post added successfully.');
    }
}
