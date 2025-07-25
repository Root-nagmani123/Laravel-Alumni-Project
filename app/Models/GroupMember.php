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
}

