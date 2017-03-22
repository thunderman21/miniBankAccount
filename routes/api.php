<?php

use Illuminate\Http\Request;

/*
| 	Models
|		-> Account:
|				-> Name
|				-> Email
|				-> Account_id (randomly generate account numbers)
|				-> Password
|				-> Account_bal
|		-> Transactions
|				-> Transaction_id
|				-> Account_id
|				-> type { deposit, withdrawal }
|				-> Amount
|				-> Date
|
|	Endpoints : 
| 		-> Balance:
|				-> Show balance
|		-> Deposit - credit account with specified amount
|				-> Max deposit for the day 150k
|				-> Max desposit per transaction 40k
|				-> Max deposit frequency = 4 transactions/day
|		-> Withdrawls - Deduct account with specified amount
|				-> Max withdrawal for the day 50k
|				-> Max withdrawal per transactions 20k
|				-> Max withdaral frequency = 3 transaction/day
|				-> Cannot withdraw when balance is less than the withdrawal amount
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users', function(){
     return response()
            ->json(['name' => 'Abigail', 'state' => 'CA', 'date' => Carbon\Carbon::now()]); 
 });