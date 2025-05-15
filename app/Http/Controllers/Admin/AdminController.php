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
        date_default_timezone_set('Asia/Calcutta');
    }

    public function index(){
        return view('admin.login');
    }

     /* public function loginAuth(Request $req){
        //print_r($_POST); die();
        if($req->isMethod('post')){
            $data = $req->all();

           if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password'], 'isAdmin'=>'1'])){
            $users = Auth::guard('admin')->name;
		     $sql = DB::table('users')->where(['email'=>$data['email'], 'isAdmin'=>'1'])->first();
            session(['LoginName' => $sql->name]);
            session(['LoginID' => $sql->id]);
            session(['LoginEmail' => $data['email']]);
            session(['isAdmin' => $sql->isAdmin]);
            session(['logged_in' => '1']);
            return redirect('admin/dashboard');
           }else{
            return redirect()->back()->with('error','Invalid login credential!!');
           }
        }
    } */

	/* public function loginAuth(Request $request)
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

    // Attempt login with admin guard
    $credentials = [
        'email' => $request->input('email'),
        'password' => $request->input('password'),
        'isAdmin' => 1,
    ];

    if (Auth::guard('admin')->attempt($credentials)) {
        $admin = Auth::guard('admin')->user();

        // Set session data
        session([
            'LoginName'  => $admin->name,
            'LoginID'    => $admin->id,
            'LoginEmail' => $admin->email,
            'isAdmin'    => $admin->isAdmin,
            'logged_in'  => true,
        ]);

        //return redirect()->route('admin.dashboard')->with('success', 'Welcome back, ' . $admin->name . '!');
		return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $admin->name . '!');

    }

    return redirect()->back()->withErrors([
        'email' => 'Invalid login credentials or unauthorized access.',
    ]);
} */


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

        // Set session data
        session([
            'LoginName'  => $admin->name,
            'LoginID'    => $admin->id,
            'LoginEmail' => $admin->email,
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


}
