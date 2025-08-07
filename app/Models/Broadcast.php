<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    protected $table = 'broadcasts';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'video_url',
        'youtube_link',
        'status',
        'createdBy',
        'is_deleted',
        'deleted_by',
        'deleted_on',
        'notified_at',
    ];

    public $timestamps = true;
}
