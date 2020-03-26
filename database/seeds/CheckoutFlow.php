<?php

use Illuminate\Database\Seeder;

class CheckoutFlow extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\CheckoutFlow::create([
            'step' => 1,
            'path' => '/api/create/init'
        ]);
        
        App\CheckoutFlow::create([
            'step' => 2,
            'path' => '/api/create/filter'
        ]);
        
        App\CheckoutFlow::create([
            'step' => 2.1,
            'path' => '/api/create/content'
        ]);
        
        App\CheckoutFlow::create([
            'step' => 2.2,
            'path' => '/api/create/partial'
        ]);
        
        App\CheckoutFlow::create([
            'step' => 3,
            'path' => '/api/create/settings'
        ]);
        
        App\CheckoutFlow::create([
            'step' => 4,
            'path' => '/api/create/review'
        ]);
        
        App\CheckoutFlow::create([
            'step' => 5,
            'path' => '/api/checkout'
        ]);
    }
}
