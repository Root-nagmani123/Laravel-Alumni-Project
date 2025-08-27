<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Observers\RecentActivityObserver;

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
                    $query->whereIn('type', ['event', 'broadcast','event_deactivated','broadcast_deactivated','forum_admin','forum_topic','forum_deleted','birthday']) // show to all users
                          ->orWhere(function ($q) use ($userId) {
                              $q->whereNotIn('type', ['event', 'broadcast','event_deactivated','broadcast_deactivated','forum_admin','forum_topic','forum_deleted','birthday']) // exclude these types
                                ->where('user_id', $userId); // user-specific notifications
                          });
                })
                ->orderBy('created_at', 'desc')
                ->where('user_id', $userId)
                ->get(['id', 'message', 'created_at', 'source_id', 'source_type', 'is_read']);

                $view->with('notifications', $notifications);
            } else {
                $view->with('notifications', collect([]));
            }
        });

        Group::observe(RecentActivityObserver::class);
    }
}
