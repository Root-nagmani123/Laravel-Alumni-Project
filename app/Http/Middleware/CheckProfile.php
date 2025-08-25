<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProfile
{
    public function handle($request, Closure $next)
    {
        if (auth()->guard('user')->check()) {
            $user = auth()->guard('user')->user();

            // 👇 agar already profile edit route par hai to bypass kar do
            if ($request->routeIs('user.profile.data') || $request->routeIs('user.profile.update')) {
                return $next($request);
            }

            // yaha check karo profile fields
            if (
                !$user->name || !$user->date_of_birth || !$user->gender || 
                !$user->mobile || !$user->bio || !$user->profile_pic || 
                !$user->current_designation || !$user->current_department || 
                !$user->current_location || !$user->Service || !$user->sector
            ) {
                // return redirect()->route('user.profile.data', $user->id)
                //                  ->with('error', 'Please complete your profile first.');
            }
        }

        return $next($request);
    }
}
