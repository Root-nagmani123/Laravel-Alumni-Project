<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Admin;

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
		//return $this->belongsTo(Member::class, 'created_by');
		 return $this->belongsTo(Admin::class, 'created_by');
	}
}
