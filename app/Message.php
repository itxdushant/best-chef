<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    protected $fillable = [
		'sender', 'receiver', 'message','is_read', 'media_ids'
    ];
    function sender(){
      //tell the relationship which column they are related on on that table
      return $this->belongsTo(User::class, 'sender'); 
    }

    function receiver(){
      //same applies here
      return $this->belongsTo(User::class, 'receiver'); 
    }

    // public function chats()
    // { 
    //   return $this->hasMany(Message::class,'sender')->union($this->hasMany(Message::class,'receiver'));
    // }

    public function getMediaIdsAttribute($value)
    {
      if( !empty( $value ) ){
        return Media::whereIn('id', explode(',', $value))->get();
      }else{
        return $value;
      }
    }
}
