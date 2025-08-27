<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grievance extends Model
{
    protected $table = 'grievances';
    protected $fillable = [
        'name',
        'subject',
        'email',
        'type',
        'message',
        'attachment',
        'status',
        'user_id',
    ];

// In Grievance.php
public function member()
    {
        return $this->belongsTo(Member::class, 'user_id'); // points to members table
    }

}