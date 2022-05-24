<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bookings';

    protected $fillable = [
		'menu_id',
		'desserts_id',
		'dessert_guests',
		'appetizers_id',
		'appetizer_guests',
		'user_id',
		'price',
		'balance_transaction',
		'customer',
		'completed',
		'transfer_group',
		'currency',
		'status',
		'booking_date',
		'transaction_id',
		'guests',
		'booking_time',
		'payment_request',
		'complete_date',
		'confirm_date',
		'location',
		'notes',
		'price_data',
    ];
    
}
