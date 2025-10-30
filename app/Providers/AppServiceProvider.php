<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\{Group, Broadcast};
use App\Observers\RecentActivityObserver;
use Illuminate\Pagination\Paginator;

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
        // ✅ Add CSP nonce globally (for every view)
        View::composer('*', function ($view) {
            $nonce = base64_encode(random_bytes(16));
            $view->with('cspNonce', $nonce);
        });

        // ✅ Share notifications with header view
        View::composer('layouts.header', function ($view) {
            if (Auth::guard('user')->check()) {
                $userId = Auth::guard('user')->id();

                $notifications = \App\Models\Notification::where(function ($query) use ($userId) {
                    $query->whereIn('type', [
                        'event', 'broadcast', 'event_deactivated', 'broadcast_deactivated',
                        'forum_admin', 'forum_topic', 'forum_deleted', 'birthday'
                    ])->orWhere(function ($q) use ($userId) {
                        $q->whereNotIn('type', [
                            'event', 'broadcast', 'event_deactivated', 'broadcast_deactivated',
                            'forum_admin', 'forum_topic', 'forum_deleted', 'birthday'
                        ])->where('user_id', $userId);
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

        // Use Bootstrap pagination style
        Paginator::useBootstrap();
    }
}
