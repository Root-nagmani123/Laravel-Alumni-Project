<?php

namespace App\Http\Controllers;

// use App\DataTables\TopicsDataTable;
use App\Models\RecentActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\DashboardModel;
use App\Models\Forum;
use App\Models\Member;
use App\Models\Topic;
use App\Models\Group;
use App\Models\Events;
use App\Models\Broadcast;
use App\Models\AuditLog;
use Carbon\Carbon;


class DashboardController extends Controller
{
    protected $user;

    public function __construct(DashboardModel $user)
    {
        $this->user = $user;
    }

    public function index_09072025()
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

    public function index()
    {
        $members = Member::where('status', 1)->get();
        $members_service = Member::select('Service', \DB::raw('COUNT(*) as member_count'))
    ->where('status', 1)
    ->groupBy('Service')
    ->get();

        //$forums = Forum::all();
        $forums = Forum::where('status', 1)->get();
        $groups = Group::where('status', 1)->get();
        $events = Events::where('status', 1)->get();
        $broadcasts = Broadcast::where('status', 1)->get();

        // topics created in the last 7 days
        $currentTopics = Topic::where('created_date', '>=', Carbon::now()->subDays(7))->get();

        $previousTopics = Topic::whereBetween('created_date', [
            Carbon::now()->subDays(14),
            Carbon::now()->subDays(7)
        ])->get();


        $topics = Topic::with('member')->get(); // all topics

        $total_user = $members->count();
        $total_forums = $forums->count();
        $total_groups = $groups->count();
        $total_events = $events->count();
        $total_broadcasts = $broadcasts->count();
        $total_topics = $topics->count();
        $userData = $topics;

        // Compare
        $currentCount = $currentTopics->count();
        $previousCount = $previousTopics->count();

       if ($previousCount > 0) {
            $change = (($currentCount - $previousCount) / $previousCount) * 100;
            $topicChangePercent = round($change, 2);
        } else {
            $topicChangePercent = null; 
        }

        // Audit Log Statistics
        $auditStats = [
            'total_requests_today' => AuditLog::whereDate('timestamp', today())->count(),
            'failed_logins_today' => AuditLog::whereDate('timestamp', today())->where('action_type', 'login_failed')->count(),
            'successful_logins_today' => AuditLog::whereDate('timestamp', today())->where('action_type', 'login_success')->count(),
            'unique_ips_today' => AuditLog::whereDate('timestamp', today())->distinct('ip_address')->count(),
            'failed_logins_week' => AuditLog::where('timestamp', '>=', Carbon::now()->subDays(7))->where('action_type', 'login_failed')->count(),
        ];


        return view('admin.dashboard', compact(
            'members',
            'forums',
            'groups',
            'events',
            'broadcasts',
            'topics',
            'total_user',
            'total_forums',
            'total_groups',
            'total_events',
            'total_broadcasts',
            'total_topics',
            'topicChangePercent',
            'userData',
            'members_service',
            'auditStats'
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
    ->get()
    ->map(function ($event) use ($userId) {
        $rsvp = DB::table('event_rsvp')
            ->where('event_id', $event->id)
            ->where('user_id', $userId)
            ->value('status'); // 1, 2, or 3

        $event->rsvp_status = $rsvp ?? ''; // Agar user ne response nahi diya
        return $event;
    });
    

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

    public function recentTopics()
    {
        // TopicsDataTable $topicsDataTable
        // $topics = Topic::where('status', 1)->latest('id')->get();
        $topics = RecentActivity::latest('id')->paginate(25);
        return view('admin.topics.index', compact('topics'));
    }
}
