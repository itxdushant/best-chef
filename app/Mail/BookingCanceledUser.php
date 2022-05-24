<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingCanceledUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $chef;
    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $chef, $booking)
    {
        $this->user = $user;
        $this->chef = $chef;
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.booking-canceled-user');
    }
}
