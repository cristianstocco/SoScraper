<?php

use Illuminate\Database\Seeder;

class InfoApiCost extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\InfoApiCost::create([
            'monthCost' => 0,
            'servicesNo' => 2
        ]);
        
        App\InfoApiCost::create([
            'monthCost' => 2,
            'servicesNo' => 2
        ]);
        
        App\InfoApiCost::create([
            'monthCost' => 8,
            'servicesNo' => 10
        ]);
        
        App\InfoApiCost::create([
            'monthCost' => 20,
            'servicesNo' => -1
        ]);
    }
}
