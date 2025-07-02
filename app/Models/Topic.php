<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{

    protected $table = 'topic';

    public $timestamps = false;

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

    public function member()
    {
        //return $this->belongsTo(Member::class);
        return $this->belongsTo(Member::class, 'created_by');
    }

    public function created_by() {
    return $this->belongsTo(User::class, 'created_by');
}

}
