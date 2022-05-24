<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class TripCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $trip;
    public $user;
    public $guide;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trip, $user, $guide)
    {
        $this->trip = $trip;
        $this->user = $user;
        $this->guide = $guide;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->email)
                ->view('emails.trip-completed');
    }
}
