<?php

use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('channel-name', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// Broadcast::routes(['middleware' => ['web']]);
// routes/channels.php में
Broadcast::routes(['middleware' => ['web', 'auth:user']]);
Broadcast::channel('chat-channel.{userId}', function ($user, $userId) {
    \Log::info('Chat channel accessed by user: ' . $user->id . ' for userId: ' . $userId);
    return (int) $user->id === (int) $userId;
}, ['guards' => ['user', 'member']]);

Broadcast::channel('unread-channel.{receiverId}', function ($user, $receiverId) {
    \Log::info('Unread channel accessed by user: ' . $user->id . ' for receiverId: ' . $receiverId);
    return (int) $user->id === (int) $receiverId;
}, ['guards' => ['user', 'member']]);