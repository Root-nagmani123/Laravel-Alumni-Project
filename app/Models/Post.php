<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'member_id',
        'content',
        'media_type',
        'media_path',
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



	//16-6-2025
}
