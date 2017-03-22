<?php

namespace App\Http\Middleware;

use Closure;
use App\Account;
use App\Transaction;

class checkDeposit
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
        $deposit_amount = $request->amount;
        $account_bal = $account->account_bal;
        $transaction_frequency = Transaction::where('created_at' = date('Y-m-d'))
                                            ->where('type' = 'deposit')
                                            ->count();
        $transaction_amnt_for_day = Transaction::where('created_at' = date('Y-m-d'))
                                                ->sum('amount');

        /**
         * check if the maximum deposit per transaction has been deposited
         * Max deposit per transaction = $40,000
         */
        if($deposit_amount > 40000){
            //redirect somewhere
        }

        /**
         * Check if the user has exceeded the maximum deposit frequency per day
         * Max deposit frequency = 4 transactions/day
         */
        elseif($transaction_frequency > 4){
            //redirect somewhere
        }
        elseif ($transaction_amnt_for_day => 150000) {
            //redirect somewhere
        }
        return $next($request);
    }
}
