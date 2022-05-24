<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentRequests extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_requests';

    protected $fillable = [
		'chef_id', 'amount', 'booking_ids', 'status'
    ];
    
}
