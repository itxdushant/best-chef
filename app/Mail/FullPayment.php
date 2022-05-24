<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FullPayment extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $chef;
    public $order;
    public $chef_cost;
    public $tip;
    public $menus_desserts;
    public $menus_appetizers;
    public $menus_sides;
    public $price_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$chef,$order,$chef_cost,$tip,$menus_desserts,$menus_appetizers,$menus_sides,$price_data)
    {
        $this->user = $user;
        $this->chef = $chef;
        $this->order = $order;
        $this->chef_cost = $chef_cost;
        $this->tip = $tip;
        $this->menus_desserts = $menus_desserts;
        $this->menus_appetizers = $menus_appetizers;
        $this->menus_sides = $menus_sides;
        $this->price_data = $price_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
		return $this->from('info@bestlocalchef.com','Best Local Chef')
                ->subject('Cha-Ching! You’ve Been Paid!')
                ->view('emails.full-payment');
    }
}
