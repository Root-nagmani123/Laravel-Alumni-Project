<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NotificationService;

class SendBirthdayNotifications extends Command
{
    protected $signature = 'send:birthday-notifications';
    protected $description = 'Send birthday notifications to members';

    public function handle(NotificationService $notificationService)
    {
        $notificationService->sendBirthdayNotifications();
        $this->info('Birthday notifications sent!');
    }
}