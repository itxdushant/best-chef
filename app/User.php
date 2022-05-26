<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;
    protected $appends = ['rating'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'user_type',
        'first_name',
        'last_name',
        'profile_pic',
        'phone_number',
        'status',
        'provider',
        'provider_id',
        'customer_id',
        'city',
        'state',
        'zip',
        'address',
        'experience',
        'licenses',
        'insurance',
        'login_time',
        'college',
        'graduate_year',
        'experience',
        'service_area',
        'miles_away',
        'available_dates',
        'featured',
        'bio',
        'video_url',
        'latitude',
        'longitude',
        'device_token',
        'certificate_data',
        'avg_cost',
        'avg_time',
        'customer_expect',
        'meal_speciality',
        'cooking_class',
        'area_range'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function senderChat(){
        return $this->hasMany(Message::class, 'sender', 'id'); //specify in both models just in case
    }

    public  function receiverChat(){
        return $this->hasMany(Message::class, 'receiver', 'id');
    }

    public function chats()
    { 
      return $this->hasMany(Message::class,'sender','id')->union($this->hasMany(Message::class,'receiver','id'));
    }

    public function Reviews(){
        return $this->hasMany(ChefReview::class, 'chef_id', 'id');
    }
}
