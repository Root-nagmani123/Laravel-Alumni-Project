<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Member;

class ChatList extends Component
{
    public $search = '';
    public $openChats = [];
    public $newMessage = [];
    public $messages = [];
    
    public function selectChat($chatId)
    {
        if (!in_array($chatId, $this->openChats)) {
            $this->openChats[] = $chatId;
        }
    }

    public function closeChat($chatId)
    {
        $this->openChats = array_filter($this->openChats, fn ($id) => $id != $chatId);
    }

    public function submit() 
    {
        if (empty($this->newMessage)) {
            return;
        }

        // Store In DB Logic
        // ChatMessage::create([
        //     'member_id' => auth()->id(),
        //     'message' => $this->newMessage,
        // ]);
        $this->messages[] = [
            'message' => $this->newMessage,
        ];
        
        \Log::info('New message submitted: ' . $this->newMessage);
        
        broadcast(new \App\Events\MessageSent($this->newMessage));
        $this->newMessage = '';
    }

    function getListeners()
    {
        return [
            'echo-private:channel-name,MessageSent' => 'newChatMessageNotification',
        ];
    }

    function newChatMessageNotification($event)
    {
        \Log::info('New chat message notification received: ' . json_encode($event));
        $this->messages[] = [
            'id' => $event['id'],
            'sender_id' => $event['sender_id'],
            'receiver_id' => $event['receiver_id'],
            'message' => $event['message'],
        ];
        
        // Optionally, you can also update the openChats or perform other actions
        if (!in_array($event['sender_id'], $this->openChats)) {
            $this->openChats[] = $event['sender_id'];
        }
    }

    public function render()
    {
        $chats = Member::query();

        if($this->search) {
            $chats = $chats->where('name', 'like', '%' . $this->search . '%');
        }

        $chats = $chats->limit(10)->get();

        $openMembers = Member::whereIn('id', $this->openChats)->get();

        // $this->messages = [];


        return view('livewire.chat.chat-list', [
            'chats' => $chats,
            'openMembers' => $openMembers,
            'messages' => $this->messages,
        ]);
    }
}
