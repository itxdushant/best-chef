<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifications';

    protected $fillable = [
		'to_user', 'from_user', 'trip_id', 'message', 'is_read'
    ];
    
}
