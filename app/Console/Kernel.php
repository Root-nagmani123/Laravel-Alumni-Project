<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\SendBirthdayNotifications::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
       $schedule->command('send:birthday-notifications')
                   ->dailyAt('16:00') // send at 4:00 PM
                   ->timezone('Asia/Kolkata');

        // 👤 new: mark users offline if last_seen older than 5 minutes
       $schedule->call(function () {
       \App\Models\Member::where('is_online', 1)
           ->where('last_seen', '<', now()->subMinutes(5))
              ->update(['is_online' => 0]);
      })->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
