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
}
