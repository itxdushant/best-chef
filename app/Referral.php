<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'referrals';

    protected $fillable = [
		'promo_code', 'email', 'message','guide_id', 'status', 'user_id', 'amount','active','expire_date','full'
    ];
    
}
