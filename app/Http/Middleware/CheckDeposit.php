<?php

namespace App\Http\Middleware;

use Closure;
use App\Account;
use App\Transaction;

class CheckDeposit
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
        $transaction_frequency = Transaction::where('account_id' = $request->account_id)
                                            ->where('created_at' = date('Y-m-d'))
                                            ->where('type' = 'deposit')
                                            ->count();
        $total_transaction_amnt_for_day = Transaction::where('account_id' = $request->account_id)
                                                    ->where('created_at' = date('Y-m-d'))
                                                    ->where('type' = 'deposit')
                                                    ->sum('amount')
                                                    ->get();

        /**
         * check if the maximum deposit per transaction has been deposited
         * Max deposit per transaction = $40,000
         */
        if($deposit_amount > 40000){
            $error_message = "The amount you have entered exceeds the allowed deposit per Transaction";
            return response()->json([
                    'status' => 'Not Acceptable',
                    'error'  => $error_message,
                ], 406);
        }

        /**
         * Check if the user has exceeded the maximum deposit frequency per day
         * Max deposit frequency = 4 transactions/day
         */
        elseif($transaction_frequency > 4){
            $error_message = "You have exceeded the number of times you are allowed to deposit in a day";
            return response()->json([
                    'status' => 'Not Acceptable',
                    'error'  => $error_message,
                ], 406);
        }
        /**
         * Check if the user has exceeded the maximum total deposit allowed per day
         * Max deposit for the day = 150k
         */
        elseif ($total_transaction_amnt_for_day > 150000) {
            $error_message = "You have exceeded the total Amount you are allowed to deposit in a day";
            return response()->json([
                    'status' => 'Not Acceptable',
                    'error'  => $error_message,
                ], 406);
        }
        return $next($request);
    }
}
