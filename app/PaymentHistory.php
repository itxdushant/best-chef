<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_history';

    protected $fillable = [
		'booking_id', 'user_id', 'payment_data'
    ];
    
}
