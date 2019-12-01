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

        /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'account_number';
    }

    public function transfers()
    {
    	return $this->hasMany('App\Transfer','account_id','id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }

    public function updateBalance($method, $balance)
    {
        if ($method) {
            $sum = $this->balance + $balance;
        } else {
            $sum = $this->balance - $balance;
        }
       return $this->update([
            'balance' => $sum,
       ]);
    }
}
