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
use App\Models\Grievance;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;



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
        'password' => 'required|string',
         'g-recaptcha-response' => 'required'
    ];
      $enc = $request->input('password_salt');

        try {
            // Decrypt timestamp
            $timestamp = (int) Crypt::decryptString($enc);

            // Verify: should not be expired (30 sec ahead)
            if (now()->timestamp > $timestamp) {
                return back()->withErrors([ 'email' => 'Invalid login credentials or unauthorized access.']);
            }
            
              $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => '6LcxQc0rAAAAAN5Wl6h1kH78PHIszwHdLitSdPi8',
        'response' => $request->input('g-recaptcha-response'),
        'remoteip' => $request->ip(),
    ]);
     $result = $response->json();

    if (!$result['success']) {
        return back()->withErrors(['captcha' => 'Captcha verification failed. Please try again.'])->withInput();
    }
    
     $encodedKey = config('app.key'); // Get APP_KEY
   if (strpos($encodedKey, 'base64:') === 0) {
       $encodedKey = substr($encodedKey, 7); // Remove "base64:" prefix
   }
   $secretKey = base64_decode($encodedKey); // Decode Key
   if (strlen($secretKey) !== 32) {
       return response()->json(["error" => "Invalid key length!"], 400);
   }
   $iv = "1234567890123456"; // Must be exactly 16 bytes
   $encryptedPassword = base64_decode($request->password); // Decode from Base64
   $decryptedPassword = openssl_decrypt(
       $encryptedPassword,
       'AES-256-CBC',
       $secretKey,
       OPENSSL_RAW_DATA,
       $iv
   );

   // Re-encrypt the password using Laravel's Hash facade for consistent storage
   $hashedPassword = Hash::make($decryptedPassword);

    $request->validate($rules, $messages);

    // Credentials
    $credentials = [
        'email' => $request->input('email'),
        'password' => $decryptedPassword,
        'isAdmin' => 1,
    ];

     $allowedRedirects = [
        'dashboard' => route('dashboard'),
    ];

    $target = $request->input('redirect'); // query param like ?redirect=dashboard

    if ($target && array_key_exists($target, $allowedRedirects)) {
        return redirect($allowedRedirects[$target]);
    }

    // Check if remember checkbox is checked
    $remember = $request->has('remember');

    // Attempt login with remember
    if (Auth::guard('admin')->attempt($credentials, $remember)) {
        $admin = Auth::guard('admin')->user();
        
        // Update the admin's password with the consistent hash if it's different
        if ($admin->password !== $hashedPassword) {

            $admin->password = $hashedPassword;
        }
        
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
     } catch (\Exception $e) {
            return back()->withErrors([ 'email' => 'Invalid login credentials or unauthorized access.']);
        }
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


//     public function socialwall(){
//     $rawPosts = DB::table('posts')
//     ->join('members', 'posts.member_id', '=', 'members.id')
//     ->leftJoin('post_media', 'posts.id', '=', 'post_media.post_id')
//     ->select(
//         'posts.id as post_id',
//         'posts.content',
//         'posts.media_type',
//         'posts.created_at as post_created_at',
//         'post_media.file_path',
//         'post_media.file_type',
//         'members.name as member_name',
//         'members.profile_pic as member_profile_pic'
//     )
//     ->whereNull('posts.group_id')// Assuming 0 is the group ID for social wall posts
//     ->orderBy('posts.created_at', 'desc')
//     ->get();
// $groupedPosts = $rawPosts->groupBy('post_id')->map(function ($group) {
//     $first = $group->first();
//     return [
//         'post_id' => $first->post_id,
//         'member_name' => $first->member_name,
//         'member_profile_pic' => $first->member_profile_pic,
//         'content' => $first->content,
//         'media_type' => $first->media_type,
//         'created_at' => $first->post_created_at, 
//         'media' => $group->map(function ($item) {
//             return [
//                 'file_path' => $item->file_path,
//                 'file_type' => $item->file_type
//             ];
//         })->filter(fn($media) => !empty($media['file_path']))->values()
//     ];
// })->values();

// // print_r($groupedPosts);die;
//         return view('admin.socialwall.index',compact('groupedPosts'));

//     }


public function socialwall()
{

    // Get filter inputs
    $year = request('year');
    $month = request('month');
    $day = request('day');


    $years = DB::table('posts')
        ->selectRaw('DISTINCT YEAR(created_at) as year')
        ->orderBy('year', 'desc')
        ->pluck('year')
        ->filter()
        ->values();

    $months = DB::table('posts')
        ->selectRaw('DISTINCT MONTH(created_at) as month')
        ->when($year, function ($query, $year) {
            return $query->whereYear('created_at', $year);
        })
        ->orderBy('month', 'asc')
        ->pluck('month')
        ->filter()
        ->values();

    $days = DB::table('posts')
        ->selectRaw('DISTINCT DAY(created_at) as day')
        ->when($year, function ($query, $year) {
            return $query->whereYear('created_at', $year);
        })
        ->when($month, function ($query, $month) {
            return $query->whereMonth('created_at', $month);
        })
        ->orderBy('day', 'asc')
        ->pluck('day')
        ->filter()
        ->values();

    // Fetch posts + media
    $rawPosts = DB::table('posts')
        ->join('members', 'posts.member_id', '=', 'members.id')
        ->leftJoin('post_media', 'posts.id', '=', 'post_media.post_id')
        ->select(
            'posts.id as post_id',
            'posts.content',
            'posts.media_type',
            'posts.video_link',
            'posts.created_at as post_created_at',
            'post_media.file_path',
            'post_media.file_type',
            'posts.status',
            'posts.group_id',
            'members.name as member_name',
            'members.profile_pic as member_profile_pic'
        )
       
       ->when($year, function ($query, $year) {
            return $query->whereYear('posts.created_at', $year);
        })
        ->when($month, function ($query, $month) {
            return $query->whereMonth('posts.created_at', $month);
        })
        ->when($day, function ($query, $day) {
            return $query->whereDay('posts.created_at', $day);
        })
        ->orderBy('posts.created_at', 'desc')
        ->get();

    // Bulk fetch likes counts
    $likesCounts = DB::table('likes')
        ->select('post_id', DB::raw('COUNT(*) as total_likes'))
        ->groupBy('post_id')
        ->pluck('total_likes', 'post_id');

    // Bulk fetch comments
    $comments = DB::table('comments')
        ->join('members', 'comments.member_id', '=', 'members.id')
        ->select(
            'comments.id',
            'comments.post_id',
            'comments.comment',
            'comments.created_at',
            'comments.status',
            'members.name as member_name',
            'members.profile_pic as member_profile_pic'
        )
        ->orderBy('comments.created_at', 'asc')
        ->get()
        ->groupBy('post_id');

    $groupedPosts = $rawPosts->groupBy('post_id')->map(function ($group) use ($likesCounts, $comments) {
        $first = $group->first();
        return [
            'post_id' => $first->post_id,
            'member_name' => $first->member_name,
            'member_profile_pic' => $first->member_profile_pic,
            'content' => $first->content,
            'media_type' => $first->media_type,
            'created_at' => $first->post_created_at,
            'video_link' => $first->video_link,
            'group_id' => $first->group_id,
            'status' => $first->status,
            'media' => $group->map(function ($item) {
                return [
                    'file_path' => $item->file_path,
                    'file_type' => $item->file_type,
                ];
            })->filter(fn($media) => !empty($media['file_path']))->values(),
            'likes_count' => $likesCounts[$first->post_id] ?? 0,
            'comments' => $comments[$first->post_id] ?? collect(),
        ];
    })->values();

    return view('admin.socialwall.index', compact('groupedPosts', 'years', 'months', 'days'));
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
    $grievances = Grievance::with('member')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.grievance.list', compact('grievances'));
}

  public function updateGrievanceStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:1,2,3',
    ]);
    $grievance = Grievance::find($id);

    if (!$grievance) {
        return redirect()->back()->withErrors(['error' => 'Grievance not found.']);
    }
    $grievance->status = (int) $request->status;
    $grievance->save();
    return redirect()->back()->with('success', 'Grievance status updated successfully.');
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
        ->orderby('name', 'asc')
        ->limit(20)

        ->get();

    return response()->json($results);
    }

}
