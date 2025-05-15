<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //added by me on 04-09-2024
use Symfony\Component\HttpFoundation\Response;

class AdminGuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //added by me on 04-09-2024
        if(Auth::check())
        {
            return redirect()->route('admin.dashboard');
        }
        //added by me on 04-09-2024
        
        return $next($request);
    }
}
