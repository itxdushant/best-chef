<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GuideTripDeclined extends Mailable
{
    use Queueable, SerializesModels;

    public $trip;
    public $user;
    public $guide_name;
    public $guide_email;

     /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trip, $user, $guide_name, $guide_email)
    {
        $this->trip = $trip;
        $this->user = $user;
        $this->guide_name = $guide_name;
        $this->guide_email = $guide_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->guide_email)
            ->view('emails.new-trip-book-declined-guide');
    }
}
