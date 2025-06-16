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
        'media.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,webm,mov|max:20480'
    ]);

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



    public function store16062025(Request $request)
		{
			$request->validate([
				'modalContent' => 'nullable|string|max:5000',
				'media.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,webm,mov|max:20480'
			]);

			//$hasMedia = $request->hasFile('media');
			$hasMedia = $request->file('media'); //added on 16-6-2025


			// Create the post
			$post = new Post();
		   // $post->member_id = auth()->id(); // or however your user is linked
			$post->member_id = auth()->guard('user')->id(); // added on 16-6-2025

			$post->content = $request->modalContent;
			$post->media_type = $hasMedia ? 'photo_video' : 'none';
			$post->save();

			// Process uploaded media
			if ($hasMedia) {
				foreach ($request->file('media') as $file) {
					$path = $file->store('posts/media', 'public');
					$mime = $file->getMimeType();
					$fileType = str_starts_with($mime, 'video') ? 'video' : 'image';

					/* PostMedia::create([
						'post_id' => $post->id,
						'file_path' => $path,
						'file_type' => $fileType,
					]); */
					PostMedia::create([
						'post_id' => $post->id,
						'file_path' => $path,
						'file_type' =>  $fileType,
					]);
				}
			}

			/* return response()->json([
				'success' => true,
				'message' => 'Post created successfully.',
				'post_id' => $post->id,
			]); */
			return redirect()->route('user.feed1')->with('success', 'Post created successfully.');
		}



		/* public function update(Request $request, $id)
		{
			$request->validate([
				'modalContent' => 'nullable|string|max:5000',
				'media.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,webm,mov|max:20480'
			]);

			$post = Post::findOrFail($id);
			$post->content = $request->modalContent;
			$post->save();

			if ($request->hasFile('media')) {

				foreach ($post->media as $media) {
					Storage::disk('public')->delete($media->file_path);
					$media->delete();
				}

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
				'message' => 'Post updated successfully.',
				'post_id' => $post->id,
			]);
		} */
}
