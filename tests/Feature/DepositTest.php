<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DepositTest extends TestCase
{
  	use DatabaseMigrations;

  	public function testDeposit()
    {
    	$data = [
    	   		"_token" = csrf_token(),
	    		"account" = "12345678",
	    		"amount" = "10000",
    		]
        response =  $this->post('/deposit',$data); //testcase 5th deposit

        $response->assertStatus(200);
    }
    public function testMaxDeposit()
    {
    	$data = [
    		"_token" = csrf_token,
    		"account" = "12345678",
    		"amount" = "45000",
    	]
        $response = $this->post('/deposit',);

        $response->assertStatus(406);
    }
    public function testDepositFrequency()
    {
    	$data = [
    	   		"_token" = csrf_token(),
	    		"account" = "12345678",
	    		"amount" = "10000",
    		]
  
        $this->post('/deposit',$data); //first deposit
        $this->post('/deposit',$data); //2nd deposit
        $this->post('/deposit',$data); //3rd deposit
        $this->post('/deposit',$data); //4th deposit
        response =  $this->post('/deposit',$data); //testcase 5th deposit

        $response->assertStatus(406);
    }
     public function testMaxDepositForTheDay()
    {
    	$data = [
    	   		"_token" = csrf_token(),
	    		"account" = "12345678",
	    		"amount" = "40000",
    		]
  		//4 deposits of 40000 should exceed max deposit allowed
        $this->post('/deposit',$data); //first deposit
        $this->post('/deposit',$data); //2nd deposit
        $this->post('/deposit',$data); //3rd deposit
        response =  $this->post('/deposit',$data); //testcase 4th deposit

        $response->assertStatus(406);
    }
}
