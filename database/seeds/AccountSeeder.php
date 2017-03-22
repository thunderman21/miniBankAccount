<?php

use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'account_id' => '12345678',
            'account_bal' => '0',
            'password' => bcrypt('secret'),
        ]);
    }
}
