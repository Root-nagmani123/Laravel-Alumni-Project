<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Like;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'member_id',
        'content',
        'media_type',
        'media_path',
        'group_id',
        'video_link',
        'status',
    ];

    // Optional: set default attributes
    protected $attributes = [
        'media_type' => 'none',
    ];

    // If using timestamps and the table uses `created_at` and `updated_at`, you can leave this as-is.
    public $timestamps = true;

    // Relationships
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

	//16-6-2025
	public function media()
		{
			return $this->hasMany(PostMedia::class);
		}

		/*public function user()
		{
			return $this->belongsTo(User::class);
		}
            */

            public function user()
            {
                return $this->belongsTo(User::class, 'member_id'); // 'member_id' is your foreign key in `posts` table
            }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        //return $this->hasMany(Comment::class);
         return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }
  public function group()
{
    return $this->belongsTo(Group::class, 'group_id');
}


	//16-6-2025
    //18-6-2025

   /* public function likes()
    {
        return $this->hasMany(PostLike::class);
    }*/






}
