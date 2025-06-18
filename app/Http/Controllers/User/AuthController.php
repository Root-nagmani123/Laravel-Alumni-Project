<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        //if (Auth::guard('user')->check()) {
       /*  return redirect()->route('user.feed1'); */
		 return view('user.auth.login');
    }



    public function login(Request $request)
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

