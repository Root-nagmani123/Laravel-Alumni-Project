<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Member, Post};
use \App\Services\RecentActivityService;
class FeedController extends Controller
{
    protected $recentActivityService;

    function __construct(RecentActivityService $recentActivityService)
    {
        $this->recentActivityService = $recentActivityService;
    }
    public function index(Request $request)
    {
        $posts = Post::latest('id');

        if($request->has('status_filter') && !empty($request->status_filter)) {
            $statusMap = match($request->status_filter) {
                'approved' => 1,
                'declined' => 2,
                'pending' => 0,
            };
            $posts = $posts->where('approved_by_moderator', $statusMap);
        }
        if($request->has('post_type') && !empty($request->post_type)) {
            if($request->post_type == 'normal') {
                $posts = $posts->whereNull('group_id');
            }
            elseif($request->post_type == 'group') {
                $posts = $posts->whereNotNull('group_id');
            }
        }
        $posts = $posts->paginate(10);
        return view('admin.feeds.index')->with(['posts'=>$posts, 'status_filter' => $request->status_filter, 'post_type' => $request->post_type]);
    }

    function approve(Request $request)
    {
        $post = Post::findOrFail($request->_post_id);
        $post->approved_by_moderator = 1;
        $post->save();

        
        if(auth()->guard('admin')->check()) {
            $this->recentActivityService->logActivity(
                'Post approved',
                'Posts',
                auth()->guard('admin')->id(),
                'Post approved successfully',
                1,
                $post->id
            );
            return redirect()->route('admin.feeds.index')->with('success', 'Post approved successfully.');
        }
        else {
              $this->recentActivityService->logActivity(
                'Post approved',
                'Posts',
                auth()->guard('user')->id(),
                'Post approved successfully',
                2,
                $post->id
            );
            return redirect()->route('user.moderation')->with('success', 'Post approved successfully.');
        }
    }

    function decline(Request $request)
    {
        $post = Post::findOrFail($request->_post_id);
        $post->approved_by_moderator = 2;
        $post->save();

        if(auth()->guard('admin')->check()) {
            $this->recentActivityService->logActivity(
                'Post rejected',
                'Posts',
                auth()->guard('admin')->id(),
                'Post rejected successfully',
                1,
                $post->id
            );
            return redirect()->route('admin.feeds.index')->with('success', 'Post declined successfully.');
        }
        else {
            $this->recentActivityService->logActivity(
                'Post rejected',
                'Posts',
                auth()->guard('user')->id(),
                'Post rejected successfully',
                2,
                $post->id
            );
            return redirect()->route('user.moderation')->with('success', 'Post declined successfully.');
        }
    }

    function view(Request $request)
    {
        $post = Post::with(['member', 'likes', 'comments'])->findOrFail($request->post_id);
        $html = view('partials.post-field-details', compact('post'))->render();
        return response()->json(['html' => $html]);
    }

    function userPostModeration(Request $request)
    {
        if(auth()->guard('user')->check() && auth()->guard('user')->user()->is_moderator && auth()->guard('user')->user()->moderator_active_inactive) {
            $posts = Post::latest('id');

            if($request->has('status_filter') && !empty($request->status_filter)) {
                $statusMap = match($request->status_filter) {
                    'approved' => 1,
                    'declined' => 2,
                    'pending' => 0,
                };
                $posts = $posts->where('approved_by_moderator', $statusMap);
            }
            if($request->has('post_type') && !empty($request->post_type)) {
                if($request->post_type == 'normal') {
                    $posts = $posts->whereNull('group_id');
                }
                elseif($request->post_type == 'group') {
                    $posts = $posts->whereNotNull('group_id');
                }
            }
            $posts = $posts->paginate(10);
            return view('user.moderation', compact('posts'))->with(['status_filter' => $request->status_filter, 'post_type' => $request->post_type]);
        }
        abort(403, 'Unauthorized action.');
    }
}
