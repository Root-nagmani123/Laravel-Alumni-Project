<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;

    protected $table = 'group_member';
  
    protected $fillable = [
       'group_id', 'member_id', 'mentor', 'mentiee', 'status'
    ];

    public function getMembersCount() {
        $mentorCount = !empty($this->mentor) ? 1 : 0;
        $menteeCount = 0;
        if (!empty($this->mentiee)) {
            $mentees = json_decode($this->mentiee, true);
            if (is_array($mentees)) {
                $menteeCount = count($mentees);
            }
        }

        return $mentorCount + $menteeCount;
    }

}

