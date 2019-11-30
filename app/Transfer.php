<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
	protected $fillable = ['user_id','account_id','sender_account_number','receiver_account_number','amount'];
	

    public function account()
    {
    	return $this->belongsTo('App\Account');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
