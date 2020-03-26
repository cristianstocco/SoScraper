<?php

use Illuminate\Database\Seeder;

class Provider extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Provider::create([
            'name' => 'facebook',
            'created_at' => '2015-12-19 21:55:10',
            'updated_at' => '2015-12-19 21:55:10'
        ]);
    }
}
