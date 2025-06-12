<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in via 'user' guard
        if (Auth::guard('user')->check()) {
            return $next($request);
        }

        // Redirect to user login page if not authenticated
        return redirect()->route('user.login');
    }
}
