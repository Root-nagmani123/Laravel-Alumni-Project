<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumTopicLike extends Model
{
    protected $table = 'forum_topic_like';
    protected $fillable = ['topic_id', 'user_id'];

    public function topic()
    {
        return $this->belongsTo(ForumTopic::class, 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
