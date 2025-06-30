<?php
namespace App\Models;
use App\Models\Member;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Story extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'story_image'];

   public function user()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
