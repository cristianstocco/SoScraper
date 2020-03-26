<?php

use Illuminate\Database\Seeder;

class FB_page_edge extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\FB_page_edge::create([
            'endPath' => 'albums',
            'title' => 'Albums',
            'description' => 'The albums of photos located on the Page.',
            'toBeSupported' => 1
        ]);

        App\FB_page_edge::create([
            'endPath' => 'events',
            'title' => 'Events',
            'description' => 'The events created by the Page.',
            'toBeSupported' => 1
        ]);

        App\FB_page_edge::create([
            'endPath' => 'insights',
            'title' => 'Likes',
            'description' => 'Total likes received by users.',
            'toBeSupported' => 0
        ]);

        App\FB_page_edge::create([
            'endPath' => 'milestones',
            'title' => 'Milestones',
            'description' => 'The milestones created by the Page.',
            'toBeSupported' => 1
        ]);

        App\FB_page_edge::create([
            'endPath' => 'posts',
            'title' => 'Posts',
            'description' => 'The posts shared on Page\'s timeline.',
            'toBeSupported' => 1
        ]);

        App\FB_page_edge::create([
            'endPath' => 'videos',
            'title' => 'Videos',
            'description' => 'The videos created by the Page.',
            'toBeSupported' => 1
        ]);
    }
}
