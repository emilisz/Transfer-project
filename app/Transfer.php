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


    public function addTransfer($transfer, $account, $method)
    {
        if ($method) {
           $sum = $transfer['amount'];
        } else {
            $sum = -$transfer['amount'];
        }

       return $this->create([
            'user_id' => $transfer['user_id'],
            'account_id'=> $account,
            'sender_account_number'=> $transfer['sender_account_number'],
            'receiver_account_number'=> $transfer['receiver_account_number'],
            'amount' => $sum,
       ]);
    }
}
