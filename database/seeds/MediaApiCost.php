<?php

use Illuminate\Database\Seeder;

class MediaApiCost extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\MediaApiCost::create([
            'monthCost' => 0,
            'servicesNo' => 1
        ]);
        
        App\MediaApiCost::create([
            'monthCost' => 8,
            'servicesNo' => 1
        ]);
        
        App\MediaApiCost::create([
            'monthCost' => 30,
            'servicesNo' => 5
        ]);
        
        App\MediaApiCost::create([
            'monthCost' => 60,
            'servicesNo' => 15
        ]);
        
        App\MediaApiCost::create([
            'monthCost' => 100,
            'servicesNo' => -1
        ]);
    }
}
