<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LdapRecord\Laravel\Facades\Ldap;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        //if (Auth::guard('user')->check()) {
       /*  return redirect()->route('user.feed1'); */
		 return view('user.auth.login');
    }



    public function login_807205(Request $request)
    {
		//$name = Auth::guard('user')->user()->name;

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
//dd($request);
        if (Auth::guard('user')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/user/feed');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function login_ldap(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $username = $request->input('username');
    $password = $request->input('password');
    $serverHost = $request->getHost(); // e.g., localhost or production domain

    try {
        if (in_array($serverHost, ['localhost', '127.0.0.1', 'dev.local'])) {
            // 👨‍💻 Localhost: Normal DB-based login
            $user = \App\Models\Member::where('username', $username)
                        ->where('status', 1) // only active users
                        ->first();

            if ($user) {
                Auth::guard('user')->login($user);
                $request->session()->regenerate();
                return redirect()->intended('/user/feed');
            }
        } else {
            // 🌐 Production: LDAP authentication
            if (Ldap::auth()->attempt($username, $password)) {
                $user = \App\Models\Member::where('username', $username)
                            ->where('status', 1)
                            ->first();

                if ($user) {
                    Auth::guard('user')->login($user);
                    $request->session()->regenerate();
                    return redirect()->intended('/user/feed');
                }
            }
        }
    } catch (\Exception $e) {
        logger('Login failed: ' . $e->getMessage());
    }

    return back()->withErrors([
        'username' => 'Invalid username or password.',
    ]);
}
 public function login(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $username = $request->input('username');
    $password = $request->input('password');
    $serverHost = $request->getHost(); // e.g., localhost or production domain

    try {
        if (in_array($serverHost, ['localhost', '127.0.0.1', 'dev.local'])) {
            // 👨‍💻 Localhost: Normal DB-based login
            $user = \App\Models\Member::where('username', $username)
                        ->where('status', 1) // only active users
                        ->first();

            if ($user) {
                Auth::guard('user')->login($user);
                $request->session()->regenerate();
                return redirect()->intended('/user/feed');
            }
        } else {
            // 🌐 Production: LDAP authentication
            if (Ldap::auth()->attempt($username, $password)) {
                $user = \App\Models\Member::where('username', $username)
                            ->where('status', 1)
                            ->first();

                if ($user) {
                    Auth::guard('user')->login($user);
                    $request->session()->regenerate();
                    return redirect()->intended('/user/feed');
                }
            }
        }
    } catch (\Exception $e) {
        logger('Login failed: ' . $e->getMessage());
    }

    return back()->withErrors([
        'username' => 'Invalid username or password.',
    ]);
}


    public function login_bkp(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Add 'status' => 1 to only allow active users
    $credentials['status'] = 1;

    if (Auth::guard('user')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/user/feed');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records or your account is inactive.',
    ]);
}

	/* public function logout()
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
       	return redirect('user/login')->with('success', 'Logged Out Successfully');;
    } */

	public function logout(Request $request)
	{
		Auth::guard('user')->logout();

		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return redirect('user/login')->with('success', 'Logged Out Successfully');
	}
}

