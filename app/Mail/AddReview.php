<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class AddReview extends Mailable
{
    use Queueable, SerializesModels;

    public $menu;
    public $review;
    public $chef;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($menu, $review, $chef)
    {
        $this->menu = $menu;
        $this->review = $review;
        $this->chef = $chef;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
				 return $this->from('info@bestlocalchef.com','Best Local Chef')
                ->subject('You Have A New Review')
                ->view('emails.chef-review');
    }
}
