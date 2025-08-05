<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        // Ensure message has sender and receiver relationships loaded
        $this->message = $message->load('sender:id,name', 'receiver:id,name');
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat-channel.' . $this->message->receiver->id),
        ];
    }

    // public function broadcastWith(): array
    // {
    //     // This ensures that the frontend receives useful data
    //     return [
    //         'message' => $this->message,
    //     ];
    // }
}


// use Illuminate\Broadcasting\Channel;
// use Illuminate\Broadcasting\InteractsWithSockets;
// use Illuminate\Broadcasting\PrivateChannel;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
// use Illuminate\Foundation\Events\Dispatchable;
// use Illuminate\Queue\SerializesModels;

// class MessageSentEvent implements ShouldBroadcastNow
// {
//     use Dispatchable, InteractsWithSockets, SerializesModels;

//     public $message;

//     public function __construct($message)
//     {
//         $this->message = $message->load('sender:id,name', 'receiver:id,name');
//         \Log::info('MessageSentEvent created for message ID: ' . $this->message->id);
//     }

//     public function broadcastOn(): array
//     {
//         $channels = [
//             new PrivateChannel('chat-channel.' . $this->message->receiver_id),
//             new PrivateChannel('chat-channel.' . $this->message->sender_id), // So sender also gets the update
//         ];
        
//         \Log::info('Broadcasting on channels: ' . json_encode([
//             'chat-channel.' . $this->message->receiver_id,
//             'chat-channel.' . $this->message->sender_id
//         ]));
        
//         return $channels;
//     }

//     public function broadcastAs(): string
//     {
//         return 'message.sent';
//     }

//     public function broadcastWith(): array
//     {
//         return [
//             'message' => [
//                 'id' => $this->message->id,
//                 'message' => $this->message->message,
//                 'sender_id' => $this->message->sender_id,
//                 'receiver_id' => $this->message->receiver_id,
//                 'sender' => [
//                     'id' => $this->message->sender->id,
//                     'name' => $this->message->sender->name,
//                 ],
//                 'receiver' => [
//                     'id' => $this->message->receiver->id,
//                     'name' => $this->message->receiver->name,
//                 ],
//                 'created_at' => $this->message->created_at,
//             ]
//         ];
//     }
// }