<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'member_id',
        'comment',
        // add other fields if needed
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);

    }

    public function member()
    {
        return $this->belongsTo(Member::class); // or User::class if using users
    }
}
