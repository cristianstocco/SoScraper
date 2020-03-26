<?php

use Illuminate\Database\Seeder;

class FB_api_group_full_mode_and_statistics extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  BeatBox creation
        App\FB_api_group_full_mode::create([
            'user' => 2,
            'whiteListDomain' => 'beatboxfamily.it/',
            'whiteListStagingIP' => '',
            'pageEdge' => 'events',
            'basePathKey' => '8LKvfO2WbmUAbmrX8ibfETbeVmv4v9yG',
            'missingDaysToWhiteList' => 0,
            'source' => 'italianbeatboxfamily',
            'created_at' => '2016-07-17 21:03:47',
            'paymentID' => 'PAY-XXXXXXXXXXXXXXXXXXXXXXXX',
        ]);
        
        //  BeatBox parameters
        App\FB_apiGroupFullMode_edgeNode::create([
            'apiGroup' => 1,
            'edgeNode' => 'attending'
        ]);
        
        //  BeatBox statistics
        App\FB_requests_dates_full_mode::create([
            'year' => 2016,
            'month' => 7,
            'requestsNo' => 26,
            'groupApi' => 1
        ]);
        App\FB_requests_dates_full_mode::create([
            'year' => 2016,
            'month' => 8,
            'requestsNo' => 41,
            'groupApi' => 1
        ]);
        App\FB_requests_dates_full_mode::create([
            'year' => 2016,
            'month' => 9,
            'requestsNo' => 222,
            'groupApi' => 1
        ]);
        App\FB_requests_dates_full_mode::create([
            'year' => 2016,
            'month' => 10,
            'requestsNo' => 157,
            'groupApi' => 1
        ]);
        App\FB_requests_dates_full_mode::create([
            'year' => 2016,
            'month' => 11,
            'requestsNo' => 50,
            'groupApi' => 1
        ]);
        App\FB_requests_dates_full_mode::create([
            'year' => 2016,
            'month' => 12,
            'requestsNo' => 140,
            'groupApi' => 1
        ]);
        
        
        
        //  Farmacia Amazzone creation
        App\FB_api_group_full_mode::create([
            'user' => 2,
            'whiteListDomain' => 'farmaciaamazzone.it',
            'whiteListStagingIP' => '',
            'pageEdge' => 'posts',
            'basePathKey' => 'N9jxmLlUmxPB0L3D0jPbAbrIjUwqgxHU',
            'missingDaysToWhiteList' => 0,
            'source' => 'farmacia.amazzone',
            'created_at' => '2016-08-24 17:32:01',
            'paymentID' => 'PAY-XXXXXXXXXXXXXXXXXXXXXXXX',
        ]);
        
        //  Farmacia Amazzone parameters
        App\FB_apiGroupFullMode_edgeNode::create([
            'apiGroup' => 2,
            'edgeNode' => 'attachments'
        ]);
        
        //  Farmacia Amazzone statistics
        App\FB_requests_dates_full_mode::create([
            'year' => 2016,
            'month' => 10,
            'requestsNo' => 100,
            'groupApi' => 2
        ]);
        App\FB_requests_dates_full_mode::create([
            'year' => 2016,
            'month' => 11,
            'requestsNo' => 176,
            'groupApi' => 2
        ]);
        App\FB_requests_dates_full_mode::create([
            'year' => 2016,
            'month' => 12,
            'requestsNo' => 236,
            'groupApi' => 2
        ]);
        
        
        
        //  Farmacia Alla Redenzione creation
        App\FB_api_group_full_mode::create([
            'user' => 2,
            'whiteListDomain' => 'farmaciaredenzione.it',
            'whiteListStagingIP' => '',
            'pageEdge' => 'posts',
            'basePathKey' => 'Zp4ez8hi3BmSQ4GC7HkmyZ7ZCwDaahzo',
            'missingDaysToWhiteList' => 0,
            'source' => 'allaredenzionetrieste',
            'created_at' => '2016-09-02 18:31:31',
            'paymentID' => 'PAY-XXXXXXXXXXXXXXXXXXXXXXXX',
        ]);
        
        //  Farmacia Alla Redenzione parameters
        App\FB_apiGroupFullMode_edgeNode::create([
            'apiGroup' => 3,
            'edgeNode' => 'attachments'
        ]);
        
        //  Farmacia Alla Redenzione parameters
//        App\FB_requests_dates_full_mode::create([
//            'year' => 0,
//            'month' => 0,
//            'requestsNo' => 0,
//            'groupApi' => 3
//        ]);
        
        
        
        //  Sportland creation
        App\FB_api_group_full_mode::create([
            'user' => 2,
            'whiteListDomain' => 'ideoplayground.com',
            'whiteListStagingIP' => '',
            'pageEdge' => 'posts',
            'basePathKey' => '5LHXuzdoxIrnGIb9XTX54qRGl2upNVV9',
            'missingDaysToWhiteList' => 0,
            'source' => 'sportebenstare',
            'created_at' => '2016-12-06 10:23:58',
            'paymentID' => 'PAY-XXXXXXXXXXXXXXXXXXXXXXXX',
        ]);
        
        //  Sportland parameters
        App\FB_apiGroupFullMode_edgeNode::create([
            'apiGroup' => 4,
            'edgeNode' => 'attachments'
        ]);
        App\FB_apiGroupFullMode_edgeNode::create([
            'apiGroup' => 4,
            'edgeNode' => 'likes'
        ]);
        
        //  Sportland parameters
//        App\FB_requests_dates_full_mode::create([
//            'year' => 0,
//            'month' => 0,
//            'requestsNo' => 0,
//            'groupApi' => 4
//        ]);
    }
}
