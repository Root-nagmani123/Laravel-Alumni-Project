<?php

namespace App\Services;

use App\Models\Forum;
use App\Models\ForumTopic;
use App\Models\ForumTopicLike;
use App\Models\ForumTopicComment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForumService
{
    /**
     * Get all forums that the current user has access to
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserForums()
    {
        return DB::table('forums')
        // ->leftJoin('forum_topics', 'forum_topics.forum_id', '=', 'forums.id')
             ->select('forums.id', 'forums.name', 'forums.id as forum_id', 'forums.name', 'forums.images', 'forums.created_at','forums.end_date')
            // ->where('forums_member.user_id', $userId)
            ->where('forums.status', 1)
             ->whereNot('forums.end_date', null)
    ->where(function($query) {
        $query->whereNull('forums.end_date')
              ->orWhere('forums.end_date', '>=', now());
    })
            ->orderBy('forums.id', 'desc')
            ->where('forums.end_date', '>=', now())
            ->get();
    }

    /**
     * Get forum details by ID
     *
     * @param int $forumId
     * @return Forum
     */
    public function getForumById($forumId)
    {
        return Forum::findOrFail($forumId);
    //      return DB::table('forums')
    //     // ->leftJoin('forum_topics', 'forum_topics.forum_id', '=', 'forums.id')
    //          ->select('forums.id', 'forums.name', 'forums.id as forum_id', 'forums.name', 'forums.images', 'forums.created_at','forums.end_date')
    //         // ->where('forums_member.user_id', $userId)
    //         ->where('forums.id', $forumId)
    //         ->where('forums.status', 1)
    //          ->whereNot('forums.end_date', null)
    // ->where(function($query) {
    //     $query->whereNull('forums.end_date')
    //           ->orWhere('forums.end_date', '>=', now());
    // })
    //         ->orderBy('forums.id', 'desc')
    //         ->where('forums.end_date', '>=', now())
    //         ->get();
    }

    /**
     * Check if user has access to a specific forum
     *
     * @param int $forumId
     * @param int $userId
     * @return bool
     */
    public function userHasAccessToForum($forumId, $userId)
    {
        return Forum::where('id', $forumId)
            ->whereHas('members', function($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->where('status', 1);
            })
            ->exists();
    }

    /**
     * Get topics for a specific forum
     *
     * @param int $forumId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getForumTopics($forumId)
    {
        return ForumTopic::where('forum_id', $forumId)
            ->where('status', 1)
            ->orderBy('created_date', 'desc')
            ->with(['creator', 'likes', 'comments' => function($query) {
                $query->orderBy('created_at', 'desc');
            }, 'comments.user'])
            ->get();
    }

    /**
     * Get forum data for sidebar
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getForumsForSidebar()
    {
        return Forum::join('forum_topics', 'forum_topics.forum_id', '=', 'forums.id')
            ->join('forums_member', 'forums_member.forums_id', '=', 'forums.id')
            ->select('forums.id', 'forums.name', 'forum_topics.id as topic_id', 'forum_topics.title as topic_name', 'forum_topics.description', 'forum_topics.images', 'forum_topics.created_date')
            // ->where('forums_member.user_id', $userId)
            ->where('forums.status', 1)
            ->orderBy('forums.id', 'desc')
            ->get();
    }

    /**
     * Like a forum topic
     *
     * @param int $topicId
     * @param int $userId
     * @return bool
     */
    public function likeTopic($topicId, $userId)
    {
        if (!$this->hasUserLikedTopic($topicId, $userId)) {
            ForumTopicLike::create([
                'topic_id' => $topicId,
                'user_id' => $userId,
            ]);
            return true;
        }
        return false;
    }

    /**
     * Unlike a forum topic
     *
     * @param int $topicId
     * @param int $userId
     * @return bool
     */
    public function unlikeTopic($topicId, $userId)
    {
        $deleted = ForumTopicLike::where('topic_id', $topicId)
            ->where('user_id', $userId)
            ->delete();
        
        return $deleted > 0;
    }

    /**
     * Check if user has already liked a topic
     *
     * @param int $topicId
     * @param int $userId
     * @return bool
     */
    public function hasUserLikedTopic($topicId, $userId)
    {
        return ForumTopicLike::where('topic_id', $topicId)
            ->where('user_id', $userId)
            ->exists();
    }

    /**
     * Add a comment to a forum topic
     *
     * @param int $topicId
     * @param int $userId
     * @param string $comment
     * @return ForumTopicComment
     */
    public function addComment($topicId, $userId, $comment)
    {
        return ForumTopicComment::create([
            'topic_id' => $topicId,
            'user_id' => $userId,
            'comment' => $comment,
        ]);
    }

    /**
     * Validate comment data
     *
     * @param Request $request
     * @return array
     */
    public function validateComment(Request $request)
    {
        return $request->validate([
            'comment' => 'required|string'
        ]);
    }

    /**
     * Get current authenticated user
     *
     * @return User|null
     */
    public function getCurrentUser()
    {
        return Auth::guard('user')->user();
    }

    /**
     * Get current authenticated user ID
     *
     * @return int|null
     */
    public function getCurrentUserId()
    {
        return Auth::guard('user')->id();
    }
}
