<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $chef;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $chef, $order)
    {
         $this->user = $user;
         $this->chef = $chef;
         $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
		 return $this->from('info@bestlocalchef.com','Best Local Chef')
                ->subject('Your Booking Request Sent')
                ->view('emails.booking-user');
    }
}
