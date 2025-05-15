<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    protected $table = 'broadcasts';

    protected $fillable = [
        'title',
        'content',
        'image_url',
        'video_url',
        'youtube_link',
        'createdBy',
        'is_deleted',
        'deleted_by',
        'deleted_on'
    ];

    public $timestamps = true;
}
