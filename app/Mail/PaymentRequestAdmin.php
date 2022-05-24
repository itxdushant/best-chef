<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class PaymentRequestAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $chef;
    public $price;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($chef, $price)
    {
        $this->chef = $chef;
        $this->price = $price;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // return $this->view('emails.payment-request-admin');
		return $this->from('info@bestlocalchef.com','Best Local Chef')
                ->subject('User Requested Payment')
                ->view('emails.payment-request-admin');
    }
}
