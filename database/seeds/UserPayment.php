<?php

use Illuminate\Database\Seeder;

class UserPayment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\UserPayment::create([
            'paymentID' => 'PAY-XXXXXXXXXXXXXXXXXXXXXXXX',
            'user_email' => 'cris94and1@gmail.com',
            'payerID' => 'XXXXXXXXXXXXX',
            'token' => 'EC-XXXXXXXXXXXXXXXXX',
            'created_at' => '2016-08-05 00:00:00',
            'finish_at' => '2038-01-19 04:14:07'
        ]);
    }
}
