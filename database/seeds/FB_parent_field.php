<?php

use Illuminate\Database\Seeder;

class FB_parent_field extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* edge - ALBUMS */
        App\FB_parent_field::create([
            'edge' => 'albums',
            'edgeNode' => null,
            'field' => 'location',
            'isDefault' => 0
        ]);

        App\FB_parent_field::create([
            'edge' => 'albums',
            'edgeNode' => null,
            'field' => 'privacy',
            'isDefault' => 0
        ]);

        App\FB_parent_field::create([
            'edge' => 'albums',
            'edgeNode' => null,
            'field' => 'link',
            'isDefault' => 1
        ]);

        App\FB_parent_field::create([
            'edge' => 'albums',
            'edgeNode' => null,
            'field' => 'cover_photo',
            'isDefault' => 0
        ]);

        App\FB_parent_field::create([
            'edge' => 'albums',
            'edgeNode' => null,
            'field' => 'description',
            'isDefault' => 0
        ]);

        App\FB_parent_field::create([
            'edge' => 'albums',
            'edgeNode' => null,
            'field' => 'name',
            'isDefault' => 0
        ]);

        /* edge - EVENTS */
        App\FB_parent_field::create([
            'edge' => 'events',
            'edgeNode' => null,
            'field' => 'place',
            'isDefault' => 1
        ]);

        App\FB_parent_field::create([
            'edge' => 'events',
            'edgeNode' => null,
            'field' => 'name',
            'isDefault' => 1
        ]);

        App\FB_parent_field::create([
            'edge' => 'events',
            'edgeNode' => null,
            'field' => 'description',
            'isDefault' => 1
        ]);

        App\FB_parent_field::create([
            'edge' => 'events',
            'edgeNode' => null,
            'field' => 'cover',
            'isDefault' => 1
        ]);

        /* edge - MILESTONES */
        App\FB_parent_field::create([
            'edge' => 'milestones',
            'edgeNode' => null,
            'field' => 'description',
            'isDefault' => 1
        ]);

        App\FB_parent_field::create([
            'edge' => 'milestones',
            'edgeNode' => null,
            'field' => 'title',
            'isDefault' => 1
        ]);

        /* edge - POSTS */
        App\FB_parent_field::create([
            'edge' => 'posts',
            'edgeNode' => null,
            'field' => 'link',
            'isDefault' => 1
        ]);

        App\FB_parent_field::create([
            'edge' => 'posts',
            'edgeNode' => null,
            'field' => 'message',
            'isDefault' => 1
        ]);

        App\FB_parent_field::create([
            'edge' => 'posts',
            'edgeNode' => null,
            'field' => 'created_time',
            'isDefault' => 1
        ]);

        /* edge - VIDEOS */
        App\FB_parent_field::create([
            'edge' => 'videos',
            'edgeNode' => null,
            'field' => 'source',
            'isDefault' => 1
        ]);

        App\FB_parent_field::create([
            'edge' => 'videos',
            'edgeNode' => null,
            'field' => 'description',
            'isDefault' => 1
        ]);

        /* edgeNode - COMMENTS */
        App\FB_parent_field::create([
            'edge' => null,
            'edgeNode' => 'comments',
            'field' => 'created_time',
            'isDefault' => 0
        ]);

        App\FB_parent_field::create([
            'edge' => null,
            'edgeNode' => 'comments',
            'field' => 'from',
            'isDefault' => 0
        ]);

        App\FB_parent_field::create([
            'edge' => null,
            'edgeNode' => 'comments',
            'field' => 'message',
            'isDefault' => 0
        ]);

        /* edgeNode - PHOTOS */
        App\FB_parent_field::create([
            'edge' => null,
            'edgeNode' => 'photos',
            'field' => 'source',
            'isDefault' => 0
        ]);

        /* edgeNode - VIDEOS */
        App\FB_parent_field::create([
            'edge' => null,
            'edgeNode' => 'videos',
            'field' => 'source',
            'isDefault' => 0
        ]);
    }
}
