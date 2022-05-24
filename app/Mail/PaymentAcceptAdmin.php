<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentAcceptAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $chef;
    public $price;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($chef,$price)
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
       
				return $this->from('info@bestlocalchef.com','Best Local Chef')
                ->subject('Payment Released')
                ->view('emails.payment-accepted-admin');
    }
}
