<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class FeedController extends Controller
{
    public function index()
    {
        $user = auth()->guard('user')->user();
        $userId = $user->id;
		/*$posts = Post::with(['member', 'media', 'likes', 'comments'])
             ->orderBy('created_at', 'desc')
                 ->get();*/
         $posts = Post::with(['member', 'media', 'likes', 'comments.member'])
        ->orderBy('created_at', 'desc')
        ->get();

           //dd($posts);
          // dd($user);
           $broadcast = DB::table('broadcasts')
                ->where('status',1)
            ->orderBy('broadcasts.id', 'desc')
            ->get();
          $events = DB::table('events')
        ->where('status', 1)
        ->where('end_datetime', '>', now())
        ->orderBy('id', 'desc')
        ->get();
// print_r($events);die;
       
    // RSVP Events by status
    $accept_events = DB::table('events')
        ->join('event_rsvp', 'events.id', '=', 'event_rsvp.event_id')
        ->where('event_rsvp.user_id', $userId)
        ->where('event_rsvp.status', 'accept')
        ->where('events.status', 1)
        ->where('events.end_datetime', '>', now())
        ->select('events.*')
        ->orderBy('events.id', 'desc')
        ->get();

    $maybe_events = DB::table('events')
        ->join('event_rsvp', 'events.id', '=', 'event_rsvp.event_id')
        ->where('event_rsvp.user_id', $userId)
        ->where('event_rsvp.status', 'maybe')
        ->where('events.status', 1)
        ->where('events.end_datetime', '>', now())
        ->select('events.*')
        ->orderBy('events.id', 'desc')
        ->get();

    $decline_events = DB::table('events')
        ->join('event_rsvp', 'events.id', '=', 'event_rsvp.event_id')
        ->where('event_rsvp.user_id', $userId)
        ->where('event_rsvp.status', 'decline')
        ->where('events.status', 1)
        ->where('events.end_datetime', '>', now())
        ->select('events.*')
        ->orderBy('events.id', 'desc')
        ->get();

        $forums = DB::table('forums as f')
            ->join('forum_topics as ft', 'ft.forum_id', '=', 'f.id')
            ->join('forums_member as fm', 'fm.forums_id', '=', 'f.id')
            ->select('f.id', 'f.name','ft.id as topic_id', 'ft.title as topic_name', 'ft.description','ft.images','ft.created_date')
            ->where('fm.user_id', $userId)
            ->get();
        // print_r($forums);die;



    return view('user.feed', compact(
        'posts',
        'user',
        'broadcast',
        'events',
        'accept_events',
        'maybe_events',
        'decline_events',
        'forums'
    ));
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
           ]);
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $results = Post::where('content', 'like', "%$keyword%")
            ->with('member')
            ->limit(10)
            ->get();

        if ($results->isEmpty()) {
            return '<ul class="crowd_search_list"></ul>';
        }

        $html = '<ul class="crowd_search_list">';
        foreach ($results as $result) {
            $html .= '<li>' . e($result->content) . '</li>';
        }
        $html .= '</ul>';

        return $html;
    }



}
