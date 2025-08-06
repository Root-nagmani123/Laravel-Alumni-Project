<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share notifications with header view
        View::composer('layouts.header', function ($view) {
            if (Auth::guard('user')->check()) {
                $userId = Auth::guard('user')->id();
                
                $notifications = Notification::where(function ($query) use ($userId) {
                    $query->whereIn('type', ['event', 'broadcast','forum_admin']) // show to all users
                          ->orWhere(function ($q) use ($userId) {
                              $q->whereNotIn('type', ['event', 'broadcast','forum_admin'])
                                ->whereJsonContains('user_id', $userId); // user-specific notifications
                          });
                })
                ->orderBy('created_at', 'desc')
                ->limit(5) // Limit to 5 most recent notifications
                ->get(['id', 'message', 'created_at', 'source_id', 'source_type']);
                
                $view->with('notifications', $notifications);
            } else {
                $view->with('notifications', collect([]));
            }
        });
    }
}
