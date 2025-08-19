<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat-channel.{userId}', function ($user, $userId) {
    \Log::info('Chat channel accessed by user: ' . $user->id . ' for userId: ' . $userId);
    return (int) $user->id === (int) $userId;
}, ['guards' => ['user']]);

Broadcast::channel('unread-channel.{receiverId}', function ($user, $receiverId) {
    \Log::info('Unread channel accessed by user: ' . $user->id . ' for receiverId: ' . $receiverId);
    return (int) $user->id === (int) $receiverId;
}, ['guards' => ['user']]);