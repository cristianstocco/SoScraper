<?php

use Illuminate\Database\Seeder;

class News extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\News::create([
            'writer' => 'admin',
            'title' => 'New IDEA!',
            'message' => 'Oh! I have few problems of configuration on the \'Community\' section, from developing API to set up the Cron-Job. So Is there a system o service which is doing this behaviour? Nope, it is not developed yet. So, let\'s go to [...]',
            'isImportant' => 1,
            'created_at' => '2015-12-19 21:55:10'
        ]);
        
        App\News::create([
            'writer' => 'admin',
            'title' => 'Starting Developing',
            'message' => 'In these weeks I\'ve configured the service in pure PHP. The PHP language, despite it was just enough old, was chosen because Facebook provides a library so reach of classes and methods. Why pure PHP? Just to see how Database, Facebook APIs, own APIs, responses and data manipulation should be configured. So I developed a framework to configure manually the Database. Okay, I\'m ready to code and to adapt the code to Laravel. Then [...]',
            'isImportant' => 1,
            'created_at' => '2016-01-15 17:56:27'
        ]);
    }
}
