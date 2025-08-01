<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumTopicComment extends Model
{
    protected $table = 'forum_topic_comment';
    protected $fillable = ['topic_id', 'user_id', 'comment'];

    public function topic()
    {
        return $this->belongsTo(ForumTopic::class, 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo(Member::class, 'user_id');
    }
}
