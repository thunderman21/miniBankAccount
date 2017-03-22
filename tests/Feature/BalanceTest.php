<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BalanceTest extends TestCase
{
    public function testBalance()
    {
        $response = $this->get('/balance');

        $response->assertStatus(200);
    }
}
