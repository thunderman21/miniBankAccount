<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WithdrawalTest extends TestCase
{
	use DatabaseMigrations;

    public function testwithdraw()
    {
    	$account  = App\Account::where("account_id" "12345678");
    	$account->account_bal =  "12000";
    	@account->save();
     	$data = [
    	   		"_token" = csrf_token(),
	    		"account" = "12345678",
	    		"amount" = "10000",
    		]
        response =  $this->post('/withdrawal',$data); 

        $response->assertStatus(200);
    }
    public function testMaxwithdrawalPerTransaction()
    {
    	$account  = App\Account::where("account_id" "12345678");
    	$account->account_bal =  "30000";
    	@account->save();
    	$data = [
    		"_token" = csrf_token,
    		"account" = "12345678",
    		"amount" = "25000",
    	]
        $response = $this->post('/withdraw',);

        $response->assertStatus(406);
    }
    public function testWithdrawalFrequency()
    {

    	$account  = App\Account::where("account_id" "12345678");
    	$account->account_bal =  "12000";
    	@account->save();
    	$data = [
    	   		"_token" = csrf_token(),
	    		"account" = "12345678",
	    		"amount" = "3000",
    		]
  
        $this->post('/withdraw',$data); //first withdraw
        $this->post('/withdraw',$data); //2nd withdraw
        $this->post('/withdraw',$data); //3rd withdraw
        $response =  $this->post('/withdraw',$data); //testcase 4th withdraw

        $response->assertStatus(406);
    }
     public function testMaxwithdrawForTheDay()
    { 
    	$account  = App\Account::where("account_id" "12345678");
    	$account->account_bal =  "70000";
    	@account->save();
    	$data = [
    	   		"_token" = csrf_token(),
	    		"account" = "12345678",
	    		"amount" = "20000",
    		]
  		//3 withdraws of 20000 should exceed max withdraw allowed
        $this->post('/withdraw',$data); //first withdraw
        $this->post('/withdraw',$data); //2nd withdraw
        $response =  $this->post('/withdraw',$data); //testcase 5th withdraw

        $response->assertStatus(406);
    }
    public function testWithdrawalShouldNotBeMoreThanBalance()
    {
    	$account  = App\Account::where("account_id" "12345678");
    	$account->account_bal =  "10000";
    	@account->save();
    	$data = [
    		"_token" = csrf_token,
    		"account" = "12345678",
    		"amount" = "12000",
    	]
        $response = $this->post('/withdraw',);

        $response->assertStatus(406);
    }
}
