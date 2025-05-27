<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    // If your table is not named 'topics', specify it explicitly
    protected $table = 'topic';

    // If your primary key is not "id", you would set it here
    // protected $primaryKey = 'id';

    // Disable timestamps if your table doesn't use created_at / updated_at
    public $timestamps = false;

    // Define fillable fields if using mass assignment
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

}
