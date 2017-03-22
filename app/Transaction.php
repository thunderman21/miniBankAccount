<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
    	'account', 'type','amount'
    ]
    /**
     * Get user for each transaction
     */
    public function users(){
    	return $this->belongsTo('App\User');
    }
}
