<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
//use App\Http\Controllers\Admin\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;


use App\Models\User;

class AdminController extends Controller
{
    public function __construct(){
        ini_set('max_execution_time', '600');
        date_default_timezone_set('Asia/Kolkata');
    }

    public function index(){
        return view('admin.login');
    }

public function loginAuth(Request $request)
{
    // Custom validation messages
    $messages = [
        'email.required' => 'We need to know your email address!',
        'email.email' => 'The email you provided is not valid.',
        'password.required' => 'A password is required to log in.',
        'password.min' => 'The password must be at least :min characters long.',
    ];

    // Validation rules
    $rules = [
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ];

    $request->validate($rules, $messages);

    // Credentials
    $credentials = [
        'email' => $request->input('email'),
        'password' => $request->input('password'),
        'isAdmin' => 1,
    ];

    // Check if remember checkbox is checked
    $remember = $request->has('remember');

    // Attempt login with remember
    if (Auth::guard('admin')->attempt($credentials, $remember)) {
        $admin = Auth::guard('admin')->user();
        // Update last login time
            $admin->last_login = now();
            $admin->save();
        // Set session data
        session([
            'LoginName'  => $admin->name,
            'LoginID'    => $admin->id,
            'LoginEmail' => $admin->email,
			'LoginPhone' => $admin->mobile,
            'profile_pic' => $admin->profile_pic,
            'last_login' => $admin->last_login,
            'isAdmin'    => $admin->isAdmin,
            'logged_in'  => true,
        ]);

        return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $admin->name . '!');
    }

    return redirect()->back()->withErrors([
        'email' => 'Invalid login credentials or unauthorized access.',
    ]);
}





	public function dashboard(){
        $viewData['title'] = "Dashboard";
        return view('admin.dashboard',$viewData);

    }

    public function logout(){
        Auth::guard('admin')->logout();
        Session::flush();
       // return redirect('admin/login');
       return redirect('admin/login')->with('success', 'Logged Out Successfully');;
        /*Auth::guard('admin')->logout();
        return redirect('http://127.0.0.1:8000/admin/login');*/

    }
    public function socialwall(){
    $rawPosts = DB::table('posts')
    ->join('members', 'posts.member_id', '=', 'members.id')
    ->leftJoin('post_media', 'posts.id', '=', 'post_media.post_id')
    ->select(
        'posts.id as post_id',
        'posts.content',
        'posts.media_type',
        'posts.created_at as post_created_at',
        'post_media.file_path',
        'post_media.file_type',
        'members.name as member_name',
        'members.profile_pic as member_profile_pic'
    )
    ->whereNull('posts.group_id')// Assuming 0 is the group ID for social wall posts
    ->orderBy('posts.created_at', 'desc')
    ->get();
$groupedPosts = $rawPosts->groupBy('post_id')->map(function ($group) {
    $first = $group->first();
    return [
        'post_id' => $first->post_id,
        'member_name' => $first->member_name,
        'member_profile_pic' => $first->member_profile_pic,
        'content' => $first->content,
        'media_type' => $first->media_type,
        'created_at' => $first->post_created_at,
        'media' => $group->map(function ($item) {
            return [
                'file_path' => $item->file_path,
                'file_type' => $item->file_type
            ];
        })->filter(fn($media) => !empty($media['file_path']))->values()
    ];
})->values();

// print_r($groupedPosts);die;
        return view('admin.socialwall.index',compact('groupedPosts'));

    }

  public function socialwall_delete($id)
{
    // Step 1: Get post
    $post = DB::table('posts')->where('id', $id)->first();

    if (!$post) {
        return response()->json(['message' => 'Post not found'], 404);
    }

    // Step 2: Delete media files (optional: physical file also)
    $mediaItems = DB::table('post_media')->where('post_id', $id)->get();
    foreach ($mediaItems as $media) {
        $path = storage_path('app/public/' . $media->file_path);
        if (file_exists($path)) {
            unlink($path); // delete physical file
        }
    }

    // Step 3: Delete media from table
    DB::table('post_media')->where('post_id', $id)->delete();

    // Step 4: Delete post
    DB::table('posts')->where('id', $id)->delete();

    return response()->json(['message' => 'Post deleted successfully']);
}






	public function profile(){
        $viewData['title'] = "admin profile";
        return view('admin.profile.profile',$viewData);

    }
    public function grievanceList()
    {
        // echo "grievance list";die;
       $grievances = DB::table('grievances')->orderBy('created_at', 'desc')->get();
        return view('admin.grievance.list', compact('grievances'));
    }
    public function mentorship(Request $request)
    {
        
    //     $mentee_connections = DB::table('mentee_requests')
    // ->join('members as mentors', 'mentee_requests.mentor', '=', 'mentors.id')
    // ->join('members as mentees', 'mentee_requests.mentees_ids', '=', 'mentees.id')
    // ->select(
    //     'mentee_requests.id as request_id',
    //     'mentors.name as mentor_name',
    //     'mentees.name as mentee_name',
    //     'mentee_requests.status'
    // )
    // ->get();

     
    // $mentor_connections = DB::table('mentor_requests')
    // ->join('members as mentors', 'mentor_requests.Mentor_ids', '=', 'mentors.id')
    // ->join('members as mentees', 'mentor_requests.mentees', '=', 'mentees.id')
    // // ->where('mentor_requests.status', 1)
    // ->select(
    //     'mentor_requests.id as request_id',
    //     'mentors.name as mentor_name',
    //     'mentees.name as mentee_name',
    //     'mentor_requests.status'
    // )
    // ->get();
    $members = DB::table('members')->select('id', 'name')->where('status', 1)->get();

        return view('admin.mentorship.index', compact('members'));
    }
    function mentorshipSearch(Request $request){
         $id = $request->id;
    $role = $request->role;

    if ($role === 'mentor') {
         $results = DB::table('mentor_mentee_connection')
        ->join('members as mentors', 'mentor_mentee_connection.mentor_id', '=', 'mentors.id')
        ->where('mentor_mentee_connection.mentee_id', $id)
         ->select('mentors.name as name', 'mentors.cader as cadre', 'mentors.batch', 'mentors.sector')
         ->get();
       
    }else{
        
          $results = DB::table('mentor_mentee_connection')
        ->join('members as mentors', 'mentor_mentee_connection.mentee_id', '=', 'mentors.id')
        ->where('mentor_mentee_connection.mentor_id', $id)
        ->select('mentors.name as name', 'mentors.cader as cadre', 'mentors.batch', 'mentors.sector')
        ->get();
    }
   
    $html = view('admin.mentorship.result_table', compact('results', 'role'))->render();

    return response()->json(['html' => $html]);
        
    }
    function membersSearch(Request $request){
         $query = $request->input('q');

    $results = DB::table('members')
        ->select('id', 'name')
        ->where('status', 1)
        ->where(function($q) use ($query) {
            $q->where('name', 'like', "%{$query}%");
        })
        ->limit(20)
        ->get();

    return response()->json($results);
    }

}
