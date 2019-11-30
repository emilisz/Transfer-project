<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['user_id','account_number','balance'];

    public function transfers()
    {
    	return $this->hasMany('App\Transfer');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
