<?php

/* namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\DashboardModel;



class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', ['user' => Auth::user()]);
    }
}
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\DashboardModel;
use App\Models\Forum;
use App\Models\Member;
use App\Models\Topic;


class DashboardController extends Controller
{
    protected $user;

    public function __construct(DashboardModel $user)
    {
        $this->user = $user;
    }

    public function index_old()
    {
        $members = Member::all();
        $forums = Forum::all();
        $topics = Topic::all();


        $total_user = $members->count();
        $total_forums = $forums->count();
        $total_topics = $topics->count();
        $userData = $topics;


        return view('admin.dashboard', compact(
            'members',
            'forums',
            'topics',
            'total_user',
            'total_forums',
            'total_topics',
            'userData'
        ));
    }

    public function index()
{
    $members = Member::all();
    $forums = Forum::all();
    $topics = Topic::with('member')->get(); // Eager load member info

    $total_user = $members->count();
    $total_forums = $forums->count();
    $total_topics = $topics->count();
    $userData = $topics;

    return view('admin.dashboard', compact(
        'members',
        'forums',
        'topics',
        'total_user',
        'total_forums',
        'total_topics',
        'userData'
    ));
}
public function directory(Request $request)
{
    $members = Member::where('status', 1)->get();


    // print_r($members);die;
    return view('directory', compact('members'));
    
}
    public function submitRsvp(Request $request)
{
    $request->validate([
        'event_id' => 'required|integer|exists:events,id',
        'rsvp_status' => 'required|in:1,2,3',
    ]);

    // Assuming authenticated user
    $user = auth()->guard('user')->user();
    $userId = $user->id;
    // Save or update RSVP
    DB::table('event_rsvp')->updateOrInsert(
        ['event_id' => $request->event_id, 'user_id' => $userId],
        ['status' => $request->rsvp_status, 'responded_at' => now()]
    );

    return response()->json(['message' => 'RSVP updated successfully!']);
}
    public function allevents(Request $request)
{
    $user = auth()->guard('user')->user(); // Get logged-in user
        $userId = $user->id;
        $events = DB::table('events')
        ->where('status', 1)
        ->where('end_datetime', '>', now())
        ->orderBy('id', 'desc')
        ->get();
// print_r($events);die;

    // RSVP Events by status
    $accept_events = DB::table('events')
        ->join('event_rsvp', 'events.id', '=', 'event_rsvp.event_id')
        ->where('event_rsvp.user_id', $userId)
        ->where('event_rsvp.status', '1')
        ->where('events.status', 1)
        ->where('events.end_datetime', '>', now())
        ->select('events.*')
        ->orderBy('events.id', 'desc')
        ->get();

    $maybe_events = DB::table('events')
        ->join('event_rsvp', 'events.id', '=', 'event_rsvp.event_id')
        ->where('event_rsvp.user_id', $userId)
        ->where('event_rsvp.status', '2')
        ->where('events.status', 1)
        ->where('events.end_datetime', '>', now())
        ->select('events.*')
        ->orderBy('events.id', 'desc')
        ->get();

    $decline_events = DB::table('events')
        ->join('event_rsvp', 'events.id', '=', 'event_rsvp.event_id')
        ->where('event_rsvp.user_id', $userId)
        ->where('event_rsvp.status', '3')
        ->where('events.status', 1)
        ->where('events.end_datetime', '>', now())
        ->select('events.*')
        ->orderBy('events.id', 'desc')
        ->get();
    return view('user.events',compact('events', 'accept_events', 'maybe_events', 'decline_events'));

}
}
