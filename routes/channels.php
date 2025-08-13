<?php

use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('channel-name', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });


Broadcast::channel('chat-channel.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
}, ['guards' => ['user', 'member']]);

Broadcast::channel('unread-channel.{receiverId}', function ($user, $receiverId) {
    return (int) $user->id === (int) $receiverId;
}, ['guards' => ['user', 'member']]);