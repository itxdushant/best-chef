<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GuideNewTripBooking extends Mailable
{
    use Queueable, SerializesModels;

    public $trip;
    public $guide;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trip, $guide)
    {
        $this->trip = $trip;
        $this->guide = $guide;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@captainexperiences.com')
                ->view('emails.new-book-trip-request-guide');
    }
}
