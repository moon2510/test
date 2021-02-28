<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $contact, $reply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->contact = $data['contact'];
        $this->reply = $data['reply'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reply Contact Email')->view('admin.mails.replycontact');
    }
}
