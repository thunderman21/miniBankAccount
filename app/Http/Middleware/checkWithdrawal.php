<?php

namespace App\Http\Middleware;

use Closure;
use App\Transaction;
use App\Account;

class checkWithdrawal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $account = Account::findOrFail($request->account_id);
        $account_bal = $account->bal;
        $withdrawl_amount = $request->amount;
        $withdrawl_frequency = Transaction::where('account_id' = $request->account_id)
                                            ->where('created_at' = date('Y-m-d'))
                                            ->count();

        $total_widthdrawed_amount = Transaction::where('account_id' = $request->account_id)
                                                ->where('created_at' = date('Y-m-d'))
                                                ->sum('amount')
                                                ->get();
        
        //check if the withdrawl amount exceeds the maximum withdrawl per transaction
        //Max withdrawal per transactions 20k
        if($withdrawal_amount> 20000){
        }

        //check if balance is less than the withdrawal amount
        //Cannot withdraw when balance is less than the withdrawal amount
        elseif( $withdrawal_amount > $account_bal){

        }

        //check if the request exceeds the withdrawl frequency allowed per day
        //Max withdaral frequency = 3 transaction/day
        elseif (withdrawal_frequency > 3){
            # code...
        }

        //check if the user has exceeded the withdrwal amount alowed per day
        //Max withdrawal for the day 50k
        if(total_widthdrawed_amount>50000){
            
        }
    
        return $next($request);
    }
}
