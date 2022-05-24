<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Menu extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category',
        'name',
		'meal_prefrences',
        'ingredients',
        'requirements',
        'description',
        'calories',
        'prep_time',
        'cost',
        'images',
        'user_id'
        ];
}
