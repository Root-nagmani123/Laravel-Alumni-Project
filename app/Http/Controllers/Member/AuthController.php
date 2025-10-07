<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AuditService;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('member.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('member')->attempt($credentials)) {
            $user = Auth::guard('member')->user();
            
            // Log successful login
            AuditService::logSuccessfulLogin($request, $user->username ?? $user->email, 'member_panel');
            
            return redirect()->route('member.dashboard');
        }

        // Log failed login attempt
        AuditService::logFailedLogin($request, $request->input('email'), 'Invalid credentials', 'member_panel');

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('member')->user();
        if ($user) {
            // Log logout
            AuditService::logLogout($request, $user->username ?? $user->email);
        }
        
        Auth::guard('member')->logout();
        return redirect()->route('member.login');
    }
}

