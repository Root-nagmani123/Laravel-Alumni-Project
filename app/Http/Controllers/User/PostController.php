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

public function store_chnagefor_video_link(Request $request)
    {


        $request->validate([
            'modalContent' => 'nullable|string|max:5000',
           //'media.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,webm,mov|max:51200'
           'media.*' => 'file|mimes:jpg,jpeg,png,gif|max:51200'
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

       return redirect('/user/feed')->with('success', 'Post created successfully.');
    }



    public function store(Request $request)
{
    $request->validate([
        'modalContent' => 'nullable|string|max:5000',
        'media.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:51200', // Adjust if needed
        'video_link' => 'nullable|url|max:1000',
    ]);

    $mediaFiles = $request->file('media');
    $videoLink = $request->video_link;

    // Extract YouTube video ID if video_link is YouTube
    $embedLink = null;
    if ($videoLink && str_contains($videoLink, 'youtube.com')) {
        parse_str(parse_url($videoLink, PHP_URL_QUERY), $query);
        if (isset($query['v'])) {
            $embedLink = 'https://www.youtube.com/embed/' . $query['v'];
        }
    } elseif ($videoLink && str_contains($videoLink, 'youtu.be')) {
        $videoId = basename(parse_url($videoLink, PHP_URL_PATH));
        $embedLink = 'https://www.youtube.com/embed/' . $videoId;
    } else {
        $embedLink = $videoLink; // fallback for other URLs (optional)
    }

    $post = new Post();
    $post->member_id = auth()->guard('user')->id();  // Or 'member' guard if applicable
    $post->content = $request->modalContent;
    $post->media_type = $mediaFiles ? 'photo_video' : ($videoLink ? 'video_link' : 'none');
    $post->video_link = $embedLink;
    $post->save();

    if ($mediaFiles) {
        foreach ($mediaFiles as $file) {
            $filename = uniqid() . '_' . $file->getClientOriginalName();
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

    return redirect('/user/feed')->with('success', 'Post created successfully.');
}
public function group_post_store(Request $request)
{
    $request->validate([
        'group_id' => 'required|integer|exists:groups,id',
        'modalContent' => 'nullable|string',
        'media' => 'nullable',
        'media.*' => 'image|max:5120', // 5MB max per file
        'video' => 'nullable|url',
    ]);
    $mediaFiles = $request->file('media');
 if ($request->video_link) {
        parse_str(parse_url($request->video_link, PHP_URL_QUERY), $query);
        $embedLink = isset($query['v']) ? "https://www.youtube.com/embed/" . $query['v'] : $request->video_link;
    }
    $post = Post::create([
        'group_id' => $request->group_id,
        'member_id' => auth('user')->id(),
        'content' => $request->modalContent,
        'video_link' => $embedLink ?? null, // Save video link if provided
        'media_type' => $request->hasFile('media') && $request->video
            ? 'photo_video'
            : ($request->hasFile('media') ? 'photo_video' : ($request->video ? 'photo_video' : null)),
    ]);

    if ($mediaFiles) {
        foreach ($mediaFiles as $file) {
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('posts/media', $filename, 'public');

            PostMedia::create([
                'post_id' => $post->id,
                'file_path' => $path,
                'file_type' => 'image',
            ]);
        }
    }

    return redirect()->back()->with('success', 'Group Post created successfully.');
}


  public function store23062025(Request $request)
{
    $request->validate([
        'modalContent' => 'nullable|string|max:5000',
        'media.*' => 'file|mimes:jpg,jpeg,png,gif|max:51200',
        'video_link' => 'nullable|url|max:1000'
    ]);

    $mediaFiles = $request->file('media');

    $post = new Post();
    $post->member_id = auth()->guard('user')->id();
    $post->content = $request->modalContent;
    $post->media_type = $mediaFiles ? 'photo_video' : ($request->video_link ? 'video_link' : 'none');
    $post->video_link = $request->video_link; // Save video link in the DB (if column exists)
    $post->save();

    if ($mediaFiles) {
        foreach ($mediaFiles as $file) {
            $filename = uniqid() . '_' . $file->getClientOriginalName();
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

    return redirect('/user/feed')->with('success', 'Post created successfully.');
}


public function toggleLike(Post $post)
{
    $user = auth('user')->user();

    // Toggle like
    $liked = $post->likes()->where('member_id', $user->id)->exists();
    if ($liked) {
        $post->likes()->where('member_id', $user->id)->delete();
    } else {
        $post->likes()->create(['member_id' => $user->id]);
    }

    $likeUsersTooltip = $post->likes()->with('member')->get()->pluck('member.name')->implode('<br>');

    return response()->json([
        'like_count' => $post->likes()->count(),
        'tooltip_html' => $likeUsersTooltip ?: 'No likes yet',
    ]);
}


    public function toggleLike_old25062025(Post $post, Request $request)
    {
    $user = auth('user')->user();

    if (!$user) {
        return redirect()->back()->withErrors('You must be logged in to like posts.');
    }

    $existingLike = $post->likes()->where('member_id', $user->id)->first();

    if ($existingLike) {
        $existingLike->delete();
    } else {
        $post->likes()->create(['member_id' => $user->id]);
    }


    return redirect()->back()->with('status', $existingLike ? 'Post unliked' : 'Post liked');
    }

    public function toggleLike_25june329pm(Post $post, Request $request)
{
    $user = auth('user')->user(); // or auth('member')->user() based on your guard

    if (!$user) {
        return redirect()->back()->withErrors('You must be logged in to like posts.');
    }

    $existingLike = $post->likes()->where('member_id', $user->id)->first();

    if ($existingLike) {
        $existingLike->delete(); // Unlike
    } else {
        $post->likes()->create(['member_id' => $user->id]); // Like
    }

    return redirect()->back()->with('status', $existingLike ? 'Post unliked' : 'Post liked');
}

public function storePostComment(Request $request, $id)
{
    $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    $post = Post::findOrFail($id);
    $userId = auth('user')->id();

    $comment = $post->comments()->create([
        'member_id' => $userId,
        'content' => $request->comment,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Comment added successfully.',
        'comment' => $comment,
    ]);

}
    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $userId = auth('user')->id();

        if ($post->member_id !== $userId) {
            return redirect()->back()->withErrors('You do not have permission to delete this post.');
        }

        // Delete associated media
        foreach ($post->media as $media) {
            Storage::disk('public')->delete($media->file_path);
            $media->delete();
        }

        // Delete the post
        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
    public function deletePostComment($id)
    {
        $comment = PostComment::findOrFail($id);
        $userId = auth('user')->id();

        if ($comment->member_id !== $userId) {
            return redirect()->back()->withErrors('You do not have permission to delete this comment.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
    public function edit($id)
{
    $post = Post::findOrFail($id);
    return response()->json($post);
}

public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);
    $post->content = $request->content;
    $post->save();

    return response()->json(['message' => 'Updated']);
}

public function destroy($id)
{
    Post::destroy($id);
    return response()->json(['message' => 'Deleted']);
}

};

