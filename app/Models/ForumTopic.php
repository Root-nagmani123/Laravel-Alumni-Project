<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    return $this->belongsTo(User::class, 'created_by');
}
}
