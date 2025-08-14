<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ForumService;
use App\Models\Forum;
use App\Models\Member;
use App\Models\ForumTopic;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    protected $forumService;
    protected $notificationService;

    public function __construct(ForumService $forumService, NotificationService $notificationService)
    {
        $this->forumService = $forumService;
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $forums = $this->forumService->getUserForums();
            // print_r($forums);die;
        return view('user.forum', compact('forums'));
    }
    
    public function show($id)
    {
     $forum = DB::table('forums')
            ->join('members', 'members.id', '=', 'forums.created_by')
            ->select(
                'forums.id',
                'forums.name',
                'forums.description',
                'forums.images',
                'forums.created_at',
                'forums.end_date',
                'forums.created_by',
                'members.name as member_name',
                'members.profile_pic as member_profile_image'
            )
            ->where('forums.id', $id)
            ->first();

        if (!$forum) {
            abort(404, 'Forum not found');
        }

        // Likes list with member details
        $forum->likes = DB::table('forum_like')
            ->join('members', 'members.id', '=', 'forum_like.user_id')
            ->select(
                'forum_like.id',
                'forum_like.user_id',
                'members.name as member_name',
                'members.profile_pic',
                'forum_like.created_at'
            )
            ->where('forum_like.forum_id', $id)
            ->get();

        // Comments list with member details
        $forum->comments = DB::table('forum_comment')
            ->join('members', 'members.id', '=', 'forum_comment.user_id')
            ->select(
                'forum_comment.id',
                'forum_comment.user_id',
                'members.name as member_name',
                'members.profile_pic',
                'forum_comment.comment',
                'forum_comment.created_at'
            )
            ->where('forum_comment.forum_id', $id)
            ->orderBy('forum_comment.created_at', 'asc')
            ->get();

		// Is forum liked by current user
		$userId = Auth::guard('user')->id();
		$forum->has_liked = false;
		if ($userId) {
			$forum->has_liked = DB::table('forum_like')
				->where('forum_id', $id)
				->where('user_id', $userId)
				->exists();
		}

            
        return view('user.forum-detail', compact('forum'));
    }

    public function like($id)
    {
        $userId = $this->forumService->getCurrentUserId();
        $this->forumService->likeTopic($id, $userId);

        return back();
    }

    public function unlike($id)
    {
        $userId = $this->forumService->getCurrentUserId();
        $this->forumService->unlikeTopic($id, $userId);
        
        return back();
    }

    public function comment(Request $request, $id)
    {
        $this->forumService->validateComment($request);
        
        $userId = $this->forumService->getCurrentUserId();
        $this->forumService->addComment($id, $userId, $request->comment);

        return back();
    }
    
    /**
     * Update forum (user-owned)
     */
    public function updateForum(Request $request, $id)
    {
      
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'end_date' => 'nullable|date',
        ]);
        
        $userId = Auth::guard('user')->id();
        $forum = DB::table('forums')->where('id', $id)->first();
        if (!$forum) {
            return $request->expectsJson()
                ? response()->json(['success' => false, 'message' => 'Forum not found'], 404)
                : back()->with('error', 'Forum not found');
        }
        if ((int)$forum->created_by !== (int)$userId) {
            return $request->expectsJson()
                ? response()->json(['success' => false, 'message' => 'Forbidden'], 403)
                : back()->with('error', 'You are not allowed to update this forum');
        }

       $updated = DB::table('forums')->where('id', $id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'end_date' => $request->input('end_date') ?: null,
            'updated_at' => now(),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'forum' => [
                    'id' => (int)$id,
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'end_date' => $request->input('end_date'),
                ],
            ]);
        }

        return back()->with('success', 'Forum updated successfully');
    }
	/**
	 * Forum-level like (not topic like)
	 */
	public function likeForum(Request $request, $id)
	{
		$userId = Auth::guard('user')->id();
		if (!$userId) {
			return $request->expectsJson()
				? response()->json(['success' => false, 'message' => 'Unauthorized'], 401)
				: back();
		}

		$already = DB::table('forum_like')
			->where('forum_id', $id)
			->where('user_id', $userId)
			->exists();

		if (!$already) {
			DB::table('forum_like')->insert([
				'forum_id' => $id,
				'user_id' => $userId,
				'created_at' => now(),
				'updated_at' => now(),
			]);
		}

		$likeCount = DB::table('forum_like')->where('forum_id', $id)->count();

		if ($request->expectsJson()) {
			return response()->json([
				'success' => true,
				'status' => 'liked',
				'like_count' => $likeCount,
			]);
		}

		return back();
	}

	/**
	 * Forum-level unlike (not topic unlike)
	 */
	public function unlikeForum(Request $request, $id)
	{
		$userId = Auth::guard('user')->id();
		if ($userId) {
			DB::table('forum_like')
				->where('forum_id', $id)
				->where('user_id', $userId)
				->delete();
		}

		$likeCount = DB::table('forum_like')->where('forum_id', $id)->count();

		if ($request->expectsJson()) {
			return response()->json([
				'success' => true,
				'status' => 'unliked',
				'like_count' => $likeCount,
			]);
		}

		return back();
	}

	/**
	 * Forum-level comment create (not topic comment)
	 */
	public function commentForum(Request $request, $id)
	{
		$request->validate([
			'comment' => 'required|string',
		]);
		$userId = Auth::guard('user')->id();
		if (!$userId) {
			return $request->expectsJson()
				? response()->json(['success' => false, 'message' => 'Unauthorized'], 401)
				: back();
		}

		$insertedId = DB::table('forum_comment')->insertGetId([
			'forum_id' => $id,
			'user_id' => $userId,
			'comment' => $request->input('comment'),
			'created_at' => now(),
			'updated_at' => now(),
		]);

		$comment = DB::table('forum_comment')
			->join('members', 'members.id', '=', 'forum_comment.user_id')
			->select(
				'forum_comment.id',
				'forum_comment.user_id',
				'members.name as member_name',
				'members.profile_pic',
				'forum_comment.comment',
				'forum_comment.created_at'
			)
			->where('forum_comment.id', $insertedId)
			->first();

		$commentCount = DB::table('forum_comment')->where('forum_id', $id)->count();

		if ($request->expectsJson()) {
			return response()->json([
				'success' => true,
				'comment' => $comment,
				'comment_count' => $commentCount,
			]);
		}

		return back();
	}

	/**
	 * Update a forum-level comment (owner only)
	 */
	public function updateForumComment(Request $request, $commentId)
	{
		$request->validate([
			'comment' => 'required|string',
		]);
		$userId = Auth::guard('user')->id();
		$record = DB::table('forum_comment')->where('id', $commentId)->first();
		if (!$record) {
			return $request->expectsJson()
				? response()->json(['success' => false, 'message' => 'Not found'], 404)
				: back();
		}
		if ((int)$record->user_id !== (int)$userId) {
			return $request->expectsJson()
				? response()->json(['success' => false, 'message' => 'Forbidden'], 403)
				: back();
		}
		DB::table('forum_comment')->where('id', $commentId)->update([
			'comment' => $request->input('comment'),
			'updated_at' => now(),
		]);
		$updated = DB::table('forum_comment')->where('id', $commentId)->first();
		if ($request->expectsJson()) {
			return response()->json([
				'success' => true,
				'comment' => $updated,
			]);
		}
		return back();
	}

	/**
	 * Delete a forum-level comment (owner only)
	 */
	public function deleteForumComment(Request $request, $commentId)
	{
		$userId = Auth::guard('user')->id();
		$record = DB::table('forum_comment')->where('id', $commentId)->first();
		if (!$record) {
			return $request->expectsJson()
				? response()->json(['success' => false, 'message' => 'Not found'], 404)
				: back();
		}
		if ((int)$record->user_id !== (int)$userId) {
			return $request->expectsJson()
				? response()->json(['success' => false, 'message' => 'Forbidden'], 403)
				: back();
		}
		DB::table('forum_comment')->where('id', $commentId)->delete();
		$commentCount = DB::table('forum_comment')->where('forum_id', $record->forum_id)->count();
		if ($request->expectsJson()) {
			return response()->json([
				'success' => true,
				'comment_count' => $commentCount,
			]);
		}
		return back();
	}
    public function member_search(Request $request)
    {

        $query = $request->input('q');
        $userId = auth()->guard('user')->id();
      
    $results = Member::where('status', 1)
                 ->where('name', 'LIKE', '%' . $query . '%')
                 ->orderby('name', 'asc')
                 ->get();
                  $results->transform(function ($item) use ($userId) {
        // Check if this member is in favorites
        $isFav = DB::table('favorite_users')
            ->where('user_id', $userId)
            ->where('favorite_user_id', $item->id)
            ->exists();

        $item->encrypted_id = Crypt::encrypt($item->id);
        $item->is_favourite = $isFav ? true : false;
        
        unset($item->id); // optional
        return $item;
    });


    return response()->json($results);
    }
    function member_store_topic(Request $request, $forumId){
       
        $validated = $request->validate([
            'description' => 'required|string',
        ]);

        $userId = Auth::guard('user')->id();
        $topic = ForumTopic::create([
            'forum_id' => $forumId,
            'created_by' => $userId,
            'description' => $validated['description'],
            'created_date' => now(),
            'status' => 1, // Assuming status 1 means active
        ]);

        if ( $topic) {
            $forum = Forum::find($forumId);
            $message = $forum->name . ' - New topic added: ' . $request->input('description');
            $notification = $this->notificationService->notifyAllMembers(
                'forum_topic',
                $message,
                $forumId,
                'forum'
            );
    
            if ($notification) {
                // Update notified_at
                DB::table('forum_topics')->where('id', $topic->id)->update(['notified_at' => 1]);
                Member::query()->update(['is_notification' => 0]);
            }
        }

        return redirect()->back()->with('success', 'Topic saved successfully!');

    }
    function activateForum(Request $request){
        // Validate the request
        $request->validate([
            'forum_id' => 'required|exists:forums,id',
            'end_date' => 'required|date|after_or_equal:today',
        ]);
        $forum = Forum::find($request->input('forum_id'));
        if (!$forum) {
            return redirect()->back()->with('error', 'Forum not found.');
        }
        // Activate the forum
        $forum->end_date = $request->input('end_date');
        $forum->updated_at = now();
        $forum->save();

        return redirect()->back()->with('success', 'Forum activated successfully!');
    }

public function deleteforum(Request $request)
{
    $request->validate([
        'forum_id' => 'required|exists:forums,id',
    ]);

    DB::beginTransaction();

    try {
        $forum = Forum::with('topics')->findOrFail($request->input('forum_id'));

        $forumName = $forum->name;
        $forumId = $forum->id;

        // Delete related topics
        $forum->topics()->delete();

        // Delete forum
         $forum->delete();

        // Notify all members that the forum has been deleted
        $message = $forumName . ' forum has been deleted.';
        $notification = $this->notificationService->notifyAllMembers(
            'forum_deleted',
            $message,
            $forumId,
            'forum'
        );

        if ($notification) {
            Member::query()->update(['is_notification' => 0]);
        }
    

        DB::commit();

        return redirect()->route('user.forum')->with('success', 'Forum deleted successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Failed to delete forum. Please try again.');
    }
}

}
