<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media';

    protected $fillable = ['file_name', 'file_type'];
    
}
