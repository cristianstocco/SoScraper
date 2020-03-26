<?php

use Illuminate\Database\Seeder;

class FB_edge_edgeNode extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* ALBUMS */
        App\FB_edge_edgeNode::create([
            'edge' => 'albums',
            'edgeNode' => 'comments'
        ]);
        
        App\FB_edge_edgeNode::create([
            'edge' => 'albums',
            'edgeNode' => 'photos'
        ]);
        
        App\FB_edge_edgeNode::create([
            'edge' => 'albums',
            'edgeNode' => 'picture'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'albums',
            'edgeNode' => 'reactions'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'albums',
            'edgeNode' => 'sharedposts'
        ]);

        /* EVENTS */
        App\FB_edge_edgeNode::create([
            'edge' => 'events',
            'edgeNode' => 'admins'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'events',
            'edgeNode' => 'attending'
        ]);
        
        App\FB_edge_edgeNode::create([
            'edge' => 'events',
            'edgeNode' => 'comments'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'events',
            'edgeNode' => 'declined'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'events',
            'edgeNode' => 'feed'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'events',
            'edgeNode' => 'interested'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'events',
            'edgeNode' => 'maybe'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'events',
            'edgeNode' => 'noreply'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'events',
            'edgeNode' => 'photos'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'events',
            'edgeNode' => 'picture'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'events',
            'edgeNode' => 'roles'
        ]);

        /* MILESTONES */
        App\FB_edge_edgeNode::create([
            'edge' => 'milestones',
            'edgeNode' => 'comments'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'milestones',
            'edgeNode' => 'likes'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'milestones',
            'edgeNode' => 'photos'
        ]);

        /* POSTS */
        App\FB_edge_edgeNode::create([
            'edge' => 'posts',
            'edgeNode' => 'attachments'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'posts',
            'edgeNode' => 'comments'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'posts',
            'edgeNode' => 'reactions'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'posts',
            'edgeNode' => 'sharedposts'
        ]);

        /* VIDEOS */
        App\FB_edge_edgeNode::create([
            'edge' => 'videos',
            'edgeNode' => 'comments'
        ]);

        App\FB_edge_edgeNode::create([
            'edge' => 'videos',
            'edgeNode' => 'reactions'
        ]);
        
        App\FB_edge_edgeNode::create([
            'edge' => 'videos',
            'edgeNode' => 'sharedposts'
        ]);
        
        App\FB_edge_edgeNode::create([
            'edge' => 'videos',
            'edgeNode' => 'video_insights'
        ]);
    }
}
