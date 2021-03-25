<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $from;

    public $email;

    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $email, String $body, String $from)
    {
        $this->email = $email;
        $this->from = $from;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('rimonomega@gmail.com')
            ->view('mails.contact');
    }
}
