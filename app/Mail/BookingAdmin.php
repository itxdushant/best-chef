<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $menu;
    public $chef;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($menu, $chef, $order)
    {
         $this->menu = $menu;
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
        //return $this->view('emails.booking-admin');
		return $this->from('info@bestlocalchef.com','Best Local Chef')
                ->subject('A new chef is booked on the website')
                ->view('emails.booking-admin');
    }
}
