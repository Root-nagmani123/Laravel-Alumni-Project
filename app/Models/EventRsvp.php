<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Events;
use App\Models\User;

class EventRsvp extends Model
{
    use HasFactory;

    protected $table = 'event_rsvp';

    protected $fillable = [
        'event_id',
        'user_id',
        'status',
        'responded_at',
    ];

    public $timestamps = false;

    // Relationships
    public function event()
    {
        return $this->belongsTo(Events::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
