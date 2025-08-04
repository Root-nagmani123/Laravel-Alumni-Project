<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('channel-name', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
