<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function sender()
    {
        return $this->belongsTo(Member::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Member::class, 'receiver_id');
    }
}
