<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Admin;
use App\Models\Member;

class ForumTopic extends Model
{
    protected $table = 'forum_topics';
    protected $fillable = [
        'title',
        'description',
        'images',
        'files',
        'video',
        'video_link',
        'live_video',
        'video_caption',
        'status',
        'forum_id',
        'group_id',
        'created_by',
        'created_date',
        'is_deleted',
    ];
    
    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'created_by');
    }

    public function likes()
    {
        return $this->hasMany(ForumTopicLike::class, 'topic_id');
    }

    public function comments()
    {
        return $this->hasMany(ForumTopicComment::class, 'topic_id');
    }

    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }
}
