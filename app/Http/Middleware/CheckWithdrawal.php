<?php

namespace App\Http\Middleware;

use Closure;
use App\Transaction;
use App\Account;

class CheckWithdrawal
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
        $account = Account::where('account_id', $request->account_id)->first();
        $account_bal = $account->account_bal;
        $withdrawl_amount = $request->amount;
        $withdrawl_frequency = Transaction::where('account_id', $request->account_id)
                                            ->where('created_at',date('Y-m-d'))
                                            ->where('type', 'deposit')
                                            ->count();

        $total_widthdrawed_amount = Transaction::where('account_id', $request->account_id)
                                                ->where('created_at', date('Y-m-d'))
                                                ->where('type', 'deposit')
                                                ->sum('amount');
        
        //check if the withdrawl amount exceeds the maximum withdrawl per transaction
        //Max withdrawal per transactions 20k
        if($withdrawal_amount> 20000){
            $error_message = "The amount you have entered exceeds the allowed withrawal per Transaction";
            return response()->json([
                    'status' => 'Not Acceptable',
                    'error'  => $error_message,
                ], 406); 
         }

        //check if balance is less than the withdrawal amount
        //Cannot withdraw when balance is less than the withdrawal amount
        elseif( $withdrawal_amount > $account_bal){
            $error_message = "You have have Insufficient funds in your acount to make this withdrawal";
            return response()->json([
                    'status' => 'Not Acceptable',
                    'error'  => $error_message,
                ], 406);
        }

        //check if the request exceeds the withdrawl frequency allowed per day
        //Max withdaral frequency = 3 transaction/day
        elseif (withdrawal_frequency > 3){
            $error_message = "You have exceeded the number of times you are allowed to withraw in a day";
            return response()->json([
                    'status' => 'Not Acceptable',
                    'error'  => $error_message,
                ], 406);
        }

        //check if the user has exceeded the withdrwal amount alowed per day
        //Max withdrawal for the day 50k
        if(total_widthdrawed_amount>50000){
            $error_message = " You have exceeded the Maximum amount you are allowed to withdraw in a day";
            return response()->json([
                    'status' => 'Not Acceptable',
                    'error'  => $error_message,
                ], 406);
        }
    
        return $next($request);
    }
}
