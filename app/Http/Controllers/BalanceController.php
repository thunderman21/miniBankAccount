<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BalanceController extends Controller
{
	public function index(){
	    $balance = Account::where("account_id" = "12345678")->get();
	    return response->json([
	    		"status" => "success",
	    		"data" => $balance,
	    	], 200);
	}
}
