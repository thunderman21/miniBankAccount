<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
    	'name', 'email','account_bal', 'account_id'
    ]

    public function transactions(){
    	return $this->hasMany('App\Transaction');
    }
}
