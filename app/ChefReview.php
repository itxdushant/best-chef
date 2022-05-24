<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChefReview extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chef_reviews';

    protected $fillable = [
		'user_id', 'chef_id', 'rating', 'review', 'photos', 'bid'
    ];
    
}
