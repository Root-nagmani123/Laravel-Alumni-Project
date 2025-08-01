<?php
 namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //added by me on 03-05-2025
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /* public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    } */
	
	 public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check())
        {
            return $next($request);
        }

        return redirect()->route('admin.login');

    }
}
 
 