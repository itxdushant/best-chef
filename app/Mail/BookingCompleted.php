<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $menu;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $menu)
    {
        $this->user = $user;
        $this->menu = $menu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		return $this->from('info@bestlocalchef.com','Best Local Chef')
                ->subject('Booking completed!')
                ->view('emails.booking-completed-user');
        
    }
}
