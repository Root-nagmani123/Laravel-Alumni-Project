<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Member;
use App\Models\Message;
use App\Events\{MessageSentEvent, UnreadMessage};
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Mail;
use App\Events\UserTyping;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class ChatList extends Component
{
    use WithFileUploads;
    public $attachment;
    public $search = '';

    public $newMessage = '';
    public $chatMessages = [];
    public $selectedChat = null;
    public $senderId;
    public $messageLimit = 20;
    public $hasMoreMessages = false;
    protected $rules = [
        'newMessage' => 'nullable|string|max:5000',
        'attachment' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,gif',
        // ,webp,mp4,mov,avi,mkv,pdf,doc,docx,xls,xlsx,zip
    ];
    protected $messages = [
        'attachment.mimes' => 'This file type is not allowed. Please upload an image (jpg, png, gif, webp), video (mp4, mov, avi, mkv), or document (pdf, doc, docx, xls, xlsx, zip).',
        'attachment.max'   => 'The file is too large. Maximum allowed size is 5 MB.',
        'newMessage.max'   => 'Message text should not exceed 5000 characters.',
    ];


    public function loadOlderMessages()
    {
        $this->messageLimit += 20;
        $this->loadMessages();
    }



    public function mount()
    {
        $this->senderId = auth()->guard('user')->id();
    }

    public function selectChat($chatId)
    {
        if ($this->selectedChat && $this->selectedChat !== $chatId) {
            Message::where('receiver_id', auth()->guard('user')->id())
                ->where('sender_id', $this->selectedChat)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);

            broadcast(new UnreadMessage(auth()->guard('user')->id(), $this->selectedChat, 0));
        }
        
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
        broadcast(new UnreadMessage(auth()->guard('user')->id(), $this->selectedChat, 0));
    }

    public function loadMessages()
    {
        // if ($this->selectedChat) {


        //     Message::where('sender_id', $this->selectedChat)
        //     ->where('receiver_id', auth()->guard('user')->id())
        //     ->where('is_read', 0)
        //     ->update(['is_read' => 1]);

        //     $this->chatMessages = Message::where(function ($query) {
        //         $query->where('sender_id', auth()->guard('user')->id())
        //             ->where('receiver_id', $this->selectedChat);
        //     })
        //         ->orWhere(function ($query) {
        //             $query->where('sender_id', $this->selectedChat)
        //                 ->where('receiver_id', auth()->guard('user')->id());
        //         })
        //         ->orderBy('created_at', 'asc')
        //         ->get();
                
        // }

        if ($this->selectedChat) {
            $query = Message::where(function ($query) {
                    $query->where('sender_id', auth()->guard('user')->id())
                        ->where('receiver_id', $this->selectedChat);
                })
                ->orWhere(function ($query) {
                    $query->where('sender_id', $this->selectedChat)
                        ->where('receiver_id', auth()->guard('user')->id());
                });

            $totalMessages = $query->count();

            $this->hasMoreMessages = $totalMessages > $this->messageLimit;

            $this->chatMessages = $query
                ->orderBy('created_at', 'desc')
                ->limit($this->messageLimit)
                ->get()
                ->reverse()
                ->values();
        }
    }

    public function closeChat($chatId)
    {
        Message::where('receiver_id', auth()->guard('user')->id())
            ->where('sender_id', $this->selectedChat)
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

        $this->reset(['selectedChat', 'newMessage']);
    }

    public function submit()
    {
        if (empty($this->newMessage) && !$this->attachment ) {
            return;
        }

        $message = new Message();
        $message->sender_id = auth()->guard('user')->id();
        $message->receiver_id = $this->selectedChat;
        $message->message = $this->newMessage;
        
        if ($this->attachment) {
            // Server-side MIME validation for images
            $mimeType = $this->attachment->getMimeType();
            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($mimeType, $allowedMimes)) {
                $this->addError('attachment', 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.');
                return;
            }
            
            $extension = $this->attachment->extension();
            $filename = uniqid() . '.' . time() . '.' . $extension;
            $path = $this->attachment->storeAs('chat_uploads', $filename, 'public');
            $message->file_path = $path;

            // Detect type
            $message->file_type = 'image';
        }

        $message->save();
        $this->chatMessages[] = $message;
        
        broadcast(new MessageSentEvent($message))->toOthers();
        
        $user = auth()->guard('user')->user();
        $newMessage = ($user->name ?? 'Unknown') . ' has been sent message - ' . $this->newMessage;
        //Notification 
        app()->make(\App\Services\NotificationService::class)
            ->notifyChatMessage(
                $this->selectedChat,
                $user->id ?? null,
                $newMessage,
                $user->id
            );


         // --- Check if receiver is offline ---
        $receiver = Member::find($this->selectedChat);
        $isOnline = $receiver->last_seen && $receiver->last_seen->gt(now()->subMinutes(5));

        if (!$isOnline && $receiver->email) {
            // Send email
            Mail::to($receiver->email)->send(new \App\Mail\OfflineMessageMail($user, $receiver, $this->newMessage));
        }

        $unreadCount = $this->getUnreadMessagesCount();
        broadcast(new UnreadMessage($this->selectedChat, $user->id ?? null, $unreadCount))->toOthers();
        $this->reset(['newMessage']);
        $this->attachment = null;
        $this->dispatch('messageSent');
    }

    #[On('echo-private:chat-channel.{senderId},MessageSentEvent')]
    public function listenMessage($event)
    {
        # Convert the event message array into an Eloquent model with relationships
        $newMessage = Message::find($event['message']['id'])->load('sender:id,name', 'receiver:id,name');

        $this->chatMessages[] = $newMessage;
    }

    public function getUnreadMessagesCount()
    {
        return Message::where('receiver_id', $this->selectedChat)
            ->where('sender_id', auth()->guard('user')->id())
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
        //     'messages' => $this->chatMessages,
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
            'chatMessages' => $this->chatMessages,
        ]);
    }

    function MentorList()
    {
        $user_id = auth()->guard('user')->user()->id;

        $results = DB::table('mentor_mentee_connection')
        ->join('members as mentors', 'mentor_mentee_connection.mentee_id', '=', 'mentors.id')
        ->where('mentor_mentee_connection.mentor_id', $user_id)
        ->where(strtolower('mentors.Service'), 'ias')
        ->where('mentor_mentee_connection.status', 1)
        ->select('mentors.id as member_id', 'mentors.name as name', 'mentors.cader as cadre', 'mentors.batch', 'mentors.sector', 'mentors.profile_pic', DB::raw("'mentee' as role_type"))
        ->get();

        return $results;
    }

    function menteeList()
    {
        $user_id = auth()->guard('user')->user()->id;
        
        $results = DB::table('mentor_mentee_connection')
            ->join('members as mentors', 'mentor_mentee_connection.mentor_id', '=', 'mentors.id')
            ->where('mentor_mentee_connection.mentee_id', $user_id)
            ->where(strtolower('mentors.Service'), 'ias')
            ->where('mentor_mentee_connection.status', 1)
            ->select('mentors.id as member_id', 'mentors.name as name', 'mentors.cader as cadre', 'mentors.batch', 'mentors.sector', 'mentors.profile_pic', DB::raw("'mentor' as role_type"))
            ->get();

        return $results;
    }

    public function deleteMessage($messageId)
    {
        $message = Message::find($messageId);

        // Only sender can delete their message
        if ($message && $message->sender_id === auth()->guard('user')->id()) {
            $message->delete();
            $this->chatMessages = $this->chatMessages->filter(fn($msg) => $msg->id !== $messageId);
        }
    }

}
