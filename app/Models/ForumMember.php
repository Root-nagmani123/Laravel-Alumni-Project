<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumMember extends Model
{
    protected $table = 'forums_member';
    
    protected $fillable = [
        'forums_id',
        'user_id',
        'status'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forums_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 