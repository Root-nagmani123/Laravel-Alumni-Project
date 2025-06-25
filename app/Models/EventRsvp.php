<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Events;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
	
	public static function getAllRsvps($eventId = null)
	{
		$query = DB::table('event_rsvp')
			->select(
				'event_rsvp.*',
				'events.title as event_title',
				'members.name as user_name'
			)
			->join('events', 'event_rsvp.event_id', '=', 'events.id')
			->join('members', 'event_rsvp.user_id', '=', 'members.id');

		if (!is_null($eventId)) {
			$query->where('event_rsvp.event_id', $eventId);
		}

		return $query->get();
	}
}
