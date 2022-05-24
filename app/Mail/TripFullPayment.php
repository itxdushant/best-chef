<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TripFullPayment extends Mailable
{
    use Queueable, SerializesModels;

    public $trip;
    public $price;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trip, $price)
    {
        $this->trip = $trip;
        $this->price = $price;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@captainexperiences.com')
                ->view('emails.trip-full-payment');
    }
}
