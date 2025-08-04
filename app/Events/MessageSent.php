<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public string $message)
    {
        \Log::info('MessageSent event created with message: ' . $message);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        \Log::info('Broadcasting on channel-name with message: ' . $this->message);
        return [
            new PrivateChannel('channel-name'),
        ];
    }

    public function broadcastWith(): array
    {
        \Log::info('Broadcasting with message: ' . $this->message);
        return [
            // 'message' => $this->message,
            'id' => auth()->id(),
            'sender_id' => $this->message,
            'receiver_id' => $this->message,
            'message' => $this->message,
        ];
    }
}
