<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingChef extends Mailable
{
    use Queueable, SerializesModels;

    public $menu;
    public $user;
    public $chef;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($menu, $user, $chef, $order)
    {
         $this->menu = $menu;
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
                ->subject('You’ve Received a Booking Request!')
                ->view('emails.booking-chef');
    }
}
