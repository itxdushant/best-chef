<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMessageToChef extends Mailable
{
    use Queueable, SerializesModels;

   
    public $user_email;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_email,$data)
    {
      
         $this->user_email = $user_email;
         $this->data = $data;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->user_email,'Best Local Chef')
                ->subject('You have new message')
                ->view('emails.send-message-to-chef');
    }
}
