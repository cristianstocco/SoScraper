<?php

use Illuminate\Database\Seeder;

class ForumSection extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ForumSection::create([
            'name' => 'Feature',
            'description' => 'Ask and discuss about features about service response you want to be implemented in.',
            'routeName' => 'static_forum.feature'
        ]);
        
        App\ForumSection::create([
            'name' => 'Support',
            'description' => 'Ask support of any type of problem.',
            'routeName' => 'static_forum.support'
        ]);
        
        App\ForumSection::create([
            'name' => 'Request',
            'description' => 'Ask request on service.',
            'routeName' => 'static_forum.request'
        ]);
    }
}