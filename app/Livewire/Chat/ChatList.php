<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Member;
use App\Models\Message;
use App\Events\{MessageSentEvent, UnreadMessage};
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Events\UserTyping;
use Illuminate\Support\Facades\DB;

class ChatList extends Component
{
    public $search = '';

    public $newMessage = '';
    public $messages = [];
    public $selectedChat = null;
    public $senderId;

    public function mount()
    {
        $this->senderId = auth()->guard('user')->id();
    }

    public function selectChat($chatId)
    {
        $this->selectedChat = $chatId;
        $this->loadMessages();
        $this->markMessagesAsRead();
    }

    public function markMessagesAsRead()
    {
        Message::where('receiver_id', auth()->guard('user')->id())
            ->where('sender_id', $this->selectedChat)
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

        # Broadcast unread message count
        broadcast(new UnreadMessage(auth()->guard('user')->id(), $this->selectedChat, 0))->toOthers();
    }

    public function loadMessages()
    {
        if ($this->selectedChat) {


            Message::where('sender_id', $this->selectedChat)
            ->where('receiver_id', auth()->guard('user')->id())
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

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

        $this->messages[] = $message;
        broadcast(new MessageSentEvent($message))->toOthers();
        
        $unreadCount = $this->getUnreadMessagesCount();
        broadcast(new UnreadMessage($this->selectedChat, auth()->guard('user')->id(), $unreadCount))->toOthers();
        $this->reset(['newMessage']);
    }

    #[On('echo-private:chat-channel.{senderId},MessageSentEvent')]
    public function listenMessage($event)
    {
        # Convert the event message array into an Eloquent model with relationships
        $newMessage = Message::find($event['message']['id'])->load('sender:id,name', 'receiver:id,name');

        $this->messages[] = $newMessage;
    }

    public function getUnreadMessagesCount()
    {
        return Message::where('receiver_id', $this->selectedChat)
            ->where('is_read', 0)
            ->count();
    }

    public function render()
    {
        // $chats = Member::query();

        // if ($this->search) {
        //     $chats = $chats->where('name', 'like', '%' . $this->search . '%');
        // }

        // $chats = $chats->whereNot('id', $this->senderId)->limit(10)->get();
        // // dump($chats);
        // $selectChat = $this->selectedChat ? Member::find($this->selectedChat) : null;

        // return view('livewire.chat.chat-list', [
        //     'chats' => $chats,
        //     'selectChat' => $selectChat,
        //     'messages' => $this->messages,
        // ]);

        $mentorList = $this->MentorList();
        $menteeList = $this->menteeList();

        // Merge both lists and convert to collection
        $mergedList = collect($mentorList)->merge($menteeList);

        $uniqueChats = $mergedList->unique('member_id')->values();
        
        // Optional: Filter search
        if ($this->search) {
            $uniqueChats = $uniqueChats->filter(function ($chat) {
                return stripos($chat->name, $this->search) !== false;
            })->values();
        }

        // Optional: Limit results
        $chats = $uniqueChats;
        // \Log::info('chats profile');
        // \Log::info($chats);
        
        $selectChat = $this->selectedChat ? Member::find($this->selectedChat) : null;

        return view('livewire.chat.chat-list', [
            'chats' => $chats,
            'selectChat' => $selectChat,
            'messages' => $this->messages,
        ]);
    }

    function MentorList()
    {
        $user_id = auth()->guard('user')->user()->id;

        $mentor_connections = DB::table('mentor_requests')
            ->join('members', 'mentor_requests.Mentor_ids', '=', 'members.id')
            ->where('mentor_requests.mentees', $user_id)
            ->where('mentor_requests.status', 1)
            ->select('mentor_requests.id as request_id', 'members.name', 'members.cader as cadre', 'members.batch', 'members.sector', 'mentor_requests.status', 'members.id as member_id')
            ->get();

        return $mentor_connections;
    }

    function menteeList()
    {
        $user_id = auth()->guard('user')->user()->id;
        
        $mentee_connections = DB::table('mentee_requests')
            ->join('members', 'mentee_requests.mentor', '=', 'members.id')
            ->where('mentee_requests.mentees_ids', $user_id)
            ->where('mentee_requests.status', 1)
            ->select('mentee_requests.id as request_id', 'members.name', 'members.cader as cadre', 'members.batch', 'members.sector', 'mentee_requests.status', 'members.id as member_id')
            ->get();
        
        return $mentee_connections;
    }
}
