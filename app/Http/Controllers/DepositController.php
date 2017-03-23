<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Transaction;
class DepositController extends Controller
{
    public function store(Request $request){
    	$transaction = new Transaction;
    	$transaction->account_id = $request->account_id ;
        $transaction->amount = $request->amount;
    	$transaction->type = 'deposit';
    	$transaction->created_at = date('Y-m-d');
    	$transaction->save();
    	$account = Account::where('account_id', $request->account_id)->first();
    	$account->account_bal = $account->account_bal + $request->amount;
    	$account->save();

    	return response()->json([
    		"status" => "success",
    		"message"  => "you have successfully made a deposit",
    	], 200);

    }
}
