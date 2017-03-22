<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BalanceController extends Controller
{
    $balance = Account::where("account_d" = "12345678")->get();
    return response->json([
    		"status" => "success",
    		"data" => $balance,
    	], 200);
}
