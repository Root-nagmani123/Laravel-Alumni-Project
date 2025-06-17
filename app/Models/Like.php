<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'member_id', // or user_id, depending on your schema
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id'); // or user() if you use User model
    }
}
