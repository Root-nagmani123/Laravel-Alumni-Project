<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

use App\Models\PostMedia;
use Illuminate\Support\Str; // added on 16-6-2025


class PostController extends Controller
{

public function store(Request $request)
    {

        $request->validate([
            'modalContent' => 'nullable|string|max:5000',
           // 'media.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,webm,mov|max:20480'
           'media.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,webm,mov|max:51200'
        ]);


 //dd($request->all(), $request->file('media'));

        $mediaFiles = $request->file('media');

        $post = new Post();
        $post->member_id = auth()->guard('user')->id();
        $post->content = $request->modalContent;
        $post->media_type = $mediaFiles ? 'photo_video' : 'none';
        $post->save();

        if ($mediaFiles) {
            foreach ($mediaFiles as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName(); // avoid conflicts
                $path = $file->storeAs('posts/media', $filename, 'public');

                $mime = $file->getMimeType();
                $fileType = str_starts_with($mime, 'video') ? 'video' : 'image';

                PostMedia::create([
                    'post_id' => $post->id,
                    'file_path' => $path,
                    'file_type' => $fileType,
                ]);
            }
        }

       return redirect('/user/feed1')->with('success', 'Post created successfully.');
    }





}
