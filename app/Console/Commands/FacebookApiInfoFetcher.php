<?php

namespace App\Console\Commands;

use Facebook\Facebook;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\FB_api_info;

class FacebookApiInfoFetcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fbapi:info {basePathKey?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The scheduler processor which fetches info API from Facebook.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $basePathKey = $this->argument( 'basePathKey' );

        if( $basePathKey )
            return $this->fetchElement( $basePathKey );
        else
            return $this->fetchAll();
    }

    /**
     * Fetches all data from page info (CronJob).
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    private function fetchAll()
    {
        $apiInfos = DB::table( 'fb_api_info' )->get();

        foreach( $apiInfos as $apiInfo )
            $this->fetchElement( $apiInfo->basePathKey );

        return true;
    }

    /**
     * Fetches data related to an API info.
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    private function fetchElement( $basePathKey )
    {
        $apiInfo = DB::table( 'fb_api_info' )->where( 'basePathKey', $basePathKey )->get()[ 0 ];
        $fields = DB::table( '_fbapiinfo_field' )->where( 'basePathKey', $basePathKey )->get();
        $fieldsNo = sizeof( $fields );

        $requestFields = '?fields=';
        $i = 0;
        foreach( $fields as $field ) {
            $requestFields .= $field->query;

            if( ++$i != $fieldsNo )
                $requestFields .= ',';
        }

        $URI = '/' . $apiInfo->source . $requestFields;
        $response = Facebook::fetchRequest( $URI );

        if( $response[ 'success' ] ) {
            FB_api_info::where( 'basePathKey', $basePathKey )->update([
                'response' => json_encode( $response[ 'response' ] ),
                'updated_at' => Carbon::now()
            ]);

            session( ['apiFetcher.element.isFetched' => true] );
        }
        else
            session( ['apiFetcher.element.isFetched' => false] );
    }
}
