<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'favorites';

    protected $fillable = [
		'user_id', 'chef_id'
    ];
    
}
