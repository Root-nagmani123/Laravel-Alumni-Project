<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Member;

class ChatList extends Component
{
    public $search = '';
    public $openChats = [];
    
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

    public function render()
    {
        $chats = Member::query();

        if($this->search) {
            $chats = $chats->where('name', 'like', '%' . $this->search . '%');
        }

        $chats = $chats->get();

        $openMembers = Member::whereIn('id', $this->openChats)->get();


        return view('livewire.chat.chat-list', [
            'chats' => $chats,
            'openMembers' => $openMembers,
        ]);
    }
}
