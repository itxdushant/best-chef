<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewBookTrip extends Mailable
{
    use Queueable, SerializesModels;

    public $trip;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trip, $order)
    {
        $this->trip = $trip;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@captainexperiences.com')
                ->view('emails.new-book-trip');
    }
}
