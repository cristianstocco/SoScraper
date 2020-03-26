<?php

use Illuminate\Database\Seeder;

class ApiDiscount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ApiDiscount::create([
            'monthNo' => 4,
            'discount%' => 10
        ]);
        
        App\ApiDiscount::create([
            'monthNo' => 12,
            'discount%' => 25
        ]);
    }
}
