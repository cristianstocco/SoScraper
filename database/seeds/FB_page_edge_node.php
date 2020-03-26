<?php

use Illuminate\Database\Seeder;

class FB_page_edge_node extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\FB_page_edge_node::create([
            'endPath' => 'admins',
            'title' => 'Admins',
            'description' => 'The album\'s admins.',
            'isRecursive' => 1
        ]);
        
        App\FB_page_edge_node::create([
            'endPath' => 'attachments',
            'title' => 'Attachments',
            'description' => 'The attachments of the ^^??^^.',
            'isRecursive' => 1
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'attending',
            'title' => 'Attending people',
            'description' => 'The attending people for the event.',
            'isRecursive' => 0
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'comments',
            'title' => 'Comments',
            'description' => 'The comments inserted.',
            'isRecursive' => 1
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'declined',
            'title' => 'Declined',
            'description' => 'The people who has declined the event.',
            'isRecursive' => 0
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'feed',
            'title' => 'Feed',
            'description' => 'The feed of posts (including status updates) and links published to this event\'s wall.',
            'isRecursive' => 1
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'interested',
            'title' => 'Interested',
            'description' => 'Interested people.',
            'isRecursive' => 1
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'likes',
            'title' => 'Likes',
            'description' => 'The likes received.',
            'isRecursive' => 0
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'maybe',
            'title' => 'Maybe',
            'description' => 'The people who perhaps attend to the event.',
            'isRecursive' => 0
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'noreply',
            'title' => 'No reply',
            'description' => 'The people who does not replied to the event.',
            'isRecursive' => 0
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'photos',
            'title' => 'Photos',
            'description' => 'The photos uploaded.',
            'isRecursive' => 1
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'picture',
            'title' => 'Picture',
            'description' => 'The album\' picture.',
            'isRecursive' => 1
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'reactions',
            'title' => 'Reactions',
            'description' => 'The reactions from people as like, love, wow, [...] .',
            'isRecursive' => 1
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'roles',
            'title' => 'Roles',
            'description' => 'List of profiles having roles on the event.',
            'isRecursive' => 1
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'sharedposts',
            'title' => 'Shares',
            'description' => 'The shares of the element.',
            'isRecursive' => 1
        ]);

        App\FB_page_edge_node::create([
            'endPath' => 'video_insights',
            'title' => 'Video insights',
            'description' => 'Total insights from all video posts associated with this video.',
            'isRecursive' => 1
        ]);
        


        //  Request Tokens
        App\FB_page_edge_node::create([             //  request token
            'endPath' => 'videos',
            'title' => 'Videos',
            'description' => 'Videos added.',
            'isRecursive' => 1
        ]);

        App\FB_page_edge_node::create([             //  request token
            'endPath' => 'live_videos',
            'title' => 'Live videos',
            'description' => 'The live videos linked to this event.',
            'isRecursive' => 1
        ]);

        App\FB_page_edge_node::create([             //  request token
            'endPath' => 'captions',
            'title' => 'Captions',
            'description' => 'Captions for the video.',
            'isRecursive' => 1
        ]);

        App\FB_page_edge_node::create([             //  request token
            'endPath' => 'tags',
            'title' => 'Tags',
            'description' => 'Users tagged in the video.',
            'isRecursive' => 1
        ]);
        
        App\FB_page_edge_node::create([             //  request token
            'endPath' => 'sponsor_tags',
            'title' => 'Sponsor tags',
            'description' => 'Sponsor pages tagged in the video.',
            'isRecursive' => 1
        ]);
        
        App\FB_page_edge_node::create([             //  request token
           'endPath' => 'thumbnails',
            'title' => 'Thumbnails',
            'description' => 'Thumbnails for the video.',
            'isRecursive' => 1
        ]);
        
        //  Insights ( to be supported )
//        App\FB_page_edge_node::create([
//            'endPath' => 'insights',
//            'title' => 'Insights',
//            'description' => 'Insights for this post.',
//            'isRecursive' => 1
//        ]);

    }
}
