<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function store(Request $request){
    	$transaction = new App\Transaction;
    	$transaction = $request->all();
    	$transaction->type = 'deposit';
    	$transaction->created_at = date('Y-m-d');
    	$transaction->save();
    	$account = App\Account::where("account_id" = $request->account_id);
    	$account->account_bal = $account->bal + $request->amount;
    	$account->save();

    	return $response()->json({
    		"status" => "success",
    		"message"  => "you have successfully made a deposit",
    	}, 200);

    }
}
