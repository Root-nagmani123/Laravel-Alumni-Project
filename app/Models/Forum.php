<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Forum extends Model
{

    use HasFactory;
	protected $fillable =
			['name',
			'cat_id',
			'status',
			'created_by',
            'updated_at',
			'end_date',
			];


			public function members()
				{
				    return $this->hasMany(ForumMember::class, 'forums_id'); // not 'forum_id'
				}

			public function topics()
				{
				    return $this->hasMany(ForumTopic::class, 'forums_id');
				}
			public function getFilePath()
				{
    				return storage_path('app/' . $this->file); // adjust as per your path column
				}
}
