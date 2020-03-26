<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Facebook\Facebook;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FacebookApiPartialFetcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fbapi:partial {basePathKey?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The scheduler processor which fetches partial API from Facebook.';

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
            $this->fetchElement( $basePathKey );
        else
            $this->fetchAll();
    }

    /**
     * Fetches all data from partial mode (CronJob).
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    private function fetchAll()
    {
        $this->deleteExpiredAPIs();

        $apis = DB::table( 'fb_api_partial_mode' )
            ->join( 'fb_api_group_partial_mode', 'fb_api_group_partial_mode.id_api_group', '=', 'fb_api_partial_mode.groupApi' )->get();

        foreach( $apis as $api )
            $this->fetchElement( $api->basePathKey );

        //  Decrementing the expires date
        DB::table( 'fb_api_group_partial_mode' )
            ->where( 'missingDaysToWhiteList', '!=', 'null' )
            ->decrement( 'missingDaysToWhiteList' );

        session( ['apiFetcher.partials.isFetched' => true] );

        return true;
    }

    /**
     * Fetches data related to an API partial group.
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    private function fetchElement( $basePathKey )
    {
        $records_apis = DB::table( 'fb_api_group_partial_mode' )
            ->where( 'fb_api_group_partial_mode.basePathKey', $basePathKey );
        $apiGroup = DB::table( 'fb_api_group_partial_mode' )
            ->where( 'fb_api_group_partial_mode.basePathKey', $basePathKey )->get();

        if( sizeof($apiGroup) == 1 ) {
            $apis = DB::table( 'fb_api_group_partial_mode' )
                ->where( 'fb_api_group_partial_mode.basePathKey', $basePathKey )
                ->join( 'fb_api_partial_mode', 'fb_api_partial_mode.groupApi', '=', 'fb_api_group_partial_mode.id_api_group' )->get();

            foreach( $apis as $api ) {

                $DB_fields = DB::table( '_fb_parent_field' )
                    ->select( 'field' )
                    ->where( 'edgeNode', $api->endPath )
                    //->orWhere( 'edge', $api->pageEdge )
                    ->distinct()
                    ->get();

                $fields = '?fields=';
                $DB_fieldsNo = sizeof($DB_fields);
                for( $i = 0; $i < $DB_fieldsNo; )
                    $fields .= $DB_fields[ $i ]->field . ( ++$i != $DB_fieldsNo ? ',' : '' );


                $URI = '/' . $api->base . '/' . $api->endPath . $fields;
                $response = Facebook::fetchRequest( $URI );

                if( $response[ 'success' ] ) {
                    $responseData = $response[ 'response' ][ 'data' ];

                    DB::table( 'fb_api_partial_mode' )
                        ->where( 'id_api', $api->id_api )
                        ->update( ['response' => json_encode( $responseData )] );

                    session( ['apiFetcher.element.isFetched' => true] );
                    $records_apis->increment( 'totalUpdates' );
                    $records_apis->update( ['updated_at' => Carbon::now()] );
                    //preparing success apis
                }
                else {
                    session( ['apiFetcher.element.isFetched' => false] );
                    //log file di errore
                }

            }
        }
        else
            session( ['apiFetcher.element.isFetched' => false] );
    }

    /**
     * Delete expired API partial groups.
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    private function deleteExpiredAPIs()
    {
        $apiGroups = DB::table( 'fb_api_group_partial_mode' )
            ->where( 'missingDaysToWhiteList', '=', 0 );
        $DB_apiGroups = DB::table( 'fb_api_group_partial_mode' )
            ->where( 'missingDaysToWhiteList', '=', 0 )->get();

        foreach( $DB_apiGroups as $group )
            DB::table( 'fb_api_partial_mode' )->where( 'groupApi', $group->id_api_group )->delete();

        $apiGroups->delete();
    }
}
