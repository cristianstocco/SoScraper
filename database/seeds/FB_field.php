<?php

use Illuminate\Database\Seeder;

class FB_field extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\FB_field::create([
            'query' => 'about',
            'description' => 'The title of the Page.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'app_links',
            'description' => 'The link of the Page for the Facebook App.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'category',
            'description' => 'The Page category.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'category_list',
            'description' => 'The Page sub-categories.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'contact_address',
            'description' => 'The mailing/contact address.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'cover',
            'description' => 'The cover information of the Page.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'cover_photo',
            'description' => 'The cover photo.',
            'isFollowingRequest' => 1,
            'isPageField' => 0,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'created_time',
            'description' => 'When it was created.',
            'isFollowingRequest' => 0,
            'isPageField' => 0,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'current_location',
            'description' => 'The current location of the Page ^^??^^.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'description',
            'description' => 'The description.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'emails',
            'description' => 'The email addresses listed on "About".',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'end_time',
            'description' => 'The end time.',
            'isFollowingRequest' => 0,
            'isPageField' => 0,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'from',
            'description' => 'The author.',
            'isFollowingRequest' => 0,
            'isPageField' => 0,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'general_info',
            'description' => 'The general information of the Page.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'hours',
            'description' => 'The operating hours.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'impressum',
            'description' => 'The legal information about the Page publishers.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'is_always_open',
            'description' => 'If location is always open.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'likes',
            'description' => 'The likes received by users.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'link',
            'description' => 'The link.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'location',
            'description' => 'The location where the albums is shooted.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'message',
            'description' => 'The message.',
            'isFollowingRequest' => 0,
            'isPageField' => 0,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'name',
            'description' => 'The name.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 1
        ]);

        App\FB_field::create([
            'query' => 'phone',
            'description' => 'The phone number.',
            'isFollowingRequest' => 0,
            'isPageField' => 1,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'place',
            'description' => 'The place where the event it\'s made.',
            'isFollowingRequest' => 0,
            'isPageField' => 0,
            'isBasic' => 1
        ]);

        App\FB_field::create([
            'query' => 'privacy',
            'description' => 'The privacy about the album.',
            'isFollowingRequest' => 0,
            'isPageField' => 0,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'source',
            'description' => 'The source.',
            'isFollowingRequest' => 0,
            'isPageField' => 0,
            'isBasic' => 1
        ]);

        App\FB_field::create([
            'query' => 'start_time',
            'description' => 'The start time.',
            'isFollowingRequest' => 0,
            'isPageField' => 0,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'title',
            'description' => 'The title.',
            'isFollowingRequest' => 0,
            'isPageField' => 0,
            'isBasic' => 0
        ]);

        App\FB_field::create([
            'query' => 'update_time',
            'description' => 'The update time.',
            'isFollowingRequest' => 0,
            'isPageField' => 0,
            'isBasic' => 0
        ]);
    }
}
