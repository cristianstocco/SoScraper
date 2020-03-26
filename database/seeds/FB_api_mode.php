<?php

use Illuminate\Database\Seeder;

class FB_api_mode extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\FB_api_mode::create([
            'name' => 'partial',
            'description' => 'The partial mode dispatch and refresh data about sub-content choosen, descending from the media choosen.',
            'fetchMedia' => 1
        ]);

        App\FB_api_mode::create([
            'name' => 'full',
            'description' => 'The full mode dispatch and refresh data about every sub-content, descending from the media choosen.',
            'fetchMedia' => 0
        ]);

        App\FB_api_mode::create([
            'name' => 'info',
            'description' => 'The info mode fetches information about page.',
            'fetchMedia' => 0
        ]);
    }
}
