<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SavedCards extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'saved_cards';

    protected $fillable = [
		'user_id', 'card_name', 'card_number', 'card_month', 'card_year'
    ];
    
}
