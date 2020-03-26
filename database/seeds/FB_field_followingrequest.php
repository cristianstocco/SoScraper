<?php

use Illuminate\Database\Seeder;

class FB_field_followingrequest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\FB_field_followingrequest::create([
            'parentField' => 'cover_photo',
            'field' => 'source'
        ]);
    }
}
