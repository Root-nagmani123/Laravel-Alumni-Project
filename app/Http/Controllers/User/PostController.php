<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\PostMedia;

class PostController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'modalContent' => 'nullable|string|max:5000',
        'media.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,webm,mov|max:20480'
    ]);

    $hasMedia = $request->hasFile('media');

    // Create the post
    $post = new Post();
    $post->member_id = auth()->id(); // or however your user is linked
    $post->content = $request->modalContent;
    $post->media_type = $hasMedia ? 'photo_video' : 'none';
    $post->save();

    // Process uploaded media
    if ($hasMedia) {
        foreach ($request->file('media') as $file) {
            $path = $file->store('posts/media', 'public');
            $mime = $file->getMimeType();

            $fileType = str_starts_with($mime, 'video') ? 'video' : 'image';

            PostMedia::create([
                'post_id' => $post->id,
                'file_path' => $path,
                'file_type' => $fileType,
            ]);
        }
    }

    return response()->json([
        'success' => true,
        'message' => 'Post created successfully.',
        'post_id' => $post->id,
    ]);
}
}
