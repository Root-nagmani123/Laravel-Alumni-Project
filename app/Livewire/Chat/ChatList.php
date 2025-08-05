<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Member;
use App\Models\Message;
use App\Events\MessageSentEvent;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class ChatList extends Component
{
    public $search = '';
    
    public $newMessage = '';
    public $messages = [];
    public $selectedChat = null;
    public $senderId = auth()->guard('user')->id();

    public function selectChat($chatId)
    {
        $this->selectedChat = $chatId;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        if ($this->selectedChat) {
            $this->messages = Message::where(function ($query) {
                $query->where('sender_id', auth()->guard('user')->id())
                    ->where('receiver_id', $this->selectedChat);
            })
                ->orWhere(function ($query) {
                    $query->where('sender_id', $this->selectedChat)
                        ->where('receiver_id', auth()->guard('user')->id());
                })
                ->orderBy('created_at', 'asc')
                ->get();
        }
    }

    public function closeChat($chatId)
    {
        $this->reset(['selectedChat', 'newMessage']);
    }

    public function submit()
    {
        if (empty($this->newMessage)) {
            return;
        }

        $message = new Message();
        $message->sender_id = auth()->guard('user')->id();
        $message->receiver_id = $this->selectedChat;
        $message->message = $this->newMessage;
        $message->save();

        // broadcast(new MessageSentEvent($message))->toOthers();
        broadcast(new MessageSentEvent($message))->toOthers();
        $this->reset(['newMessage']);
    }

    

    public function render()
    {
        $chats = Member::query();

        if ($this->search) {
            $chats = $chats->where('name', 'like', '%' . $this->search . '%');
        }

        $chats = $chats->limit(10)->get();
        // dump($chats);
        $selectChat = $this->selectedChat ? Member::find($this->selectedChat) : null;

        return view('livewire.chat.chat-list', [
            'chats' => $chats,
            'selectChat' => $selectChat,
            'messages' => $this->messages,
        ]);
    }
}
