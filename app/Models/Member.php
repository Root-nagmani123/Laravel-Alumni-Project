<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Authenticatable
{
    use Notifiable;
    // use SoftDeletes;

    protected $table = 'members';
    // protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'cader',
        'designation','batch','address','bio','profile_pic','date_of_birth',
        'place_of_birth','gender','marital_status',
        'school_name','school_year','undergrad_college',
        'undergrad_degree','undergrad_year','postgrad_college',
        'postgrad_degree','postgrad_year','current_designation',
        'current_department','current_location','previous_postings','service'
    ];

    public function otps()
{
    return $this->hasMany(\App\Models\UserOtp::class);
}

    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    public function topics()
        {
            return $this->hasMany(Topic::class);
        }


    public function profileTopic()
    {
    $userId = Auth::user()->id;

    $topics = DB::table('posts as p')
        ->select(
            'p.id as post_id',
            'p.video_link',
            'p.description',
            'm.id as member_id',
            'm.name as member_name',
            'pm.id as image_id',
            'pm.name as image_name',
            'p.created_at as created_date' // Assuming `created_date` is a timestamp column
        )
        ->leftJoin('members as m', 'p.created_by', '=', 'm.id') // Changed from `t.created_by` to `p.created_by`
        ->leftJoin('post_media as pm', 'p.id', '=', 'pm.post_id')
        ->where('m.id', $userId)
        ->get();

    return $topics;
    }

    public function forumTopicLikes()
    {
        return $this->hasMany(ForumTopicLike::class, 'user_id');
    }
    
    public function forumTopicComments()
    {
        return $this->hasMany(ForumTopicComment::class, 'user_id');
    }

    public function unreadMessages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'id')->where('is_read', false);
    }
}

//
