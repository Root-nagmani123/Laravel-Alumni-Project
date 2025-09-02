<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OfflineMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $receiver;
    public $messageText;

    public function __construct($sender, $receiver, $messageText)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->messageText = $messageText;
    }

     public function build()
    {
        return $this->subject("New Message from {$this->sender->name}")
                    ->view('emails.offline-message')
                    ->with([
                        'senderName' => $this->sender->name,
                        'receiverName' => $this->receiver->name,
                        'messageText' => $this->messageText,
                    ]);
    }

}
