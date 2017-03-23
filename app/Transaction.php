<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
    	'account_id', 'type','amount'
    ];
    /**
     * Get user for each transaction
     */
    public function accounts(){
    	return $this->belongsTo('App\Account');
    }
}
