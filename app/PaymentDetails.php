<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_details';

   /* protected $fillable = [
		'user_id', 'acholder_name', 'account_type', 'country', 'business_type', 'currency', 'routing_number', 'account_number', 'account_id', 'account', 'bank_name', 'last4'
    ];*/
    protected $fillable = [
		  'user_id', 'Acholder_name', 'account_type', 'country', 'business_type', 'currency', 'routing_number', 'account_number', 'account_id', 'account', 'bank_name', 'last4', 'request_data', 'first_name', 'last_name', 'dob', 'address1', 'phone', 'city', 'state', 'zip', 'mcc', 'website'
    ];
}


