<?php

namespace App\Console\Commands;

use App\FB_api_full_mode;
use App\FB_api_group_full_mode_source;
use Carbon\Carbon;
use Facebook\Facebook;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FacebookApiFullFetcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fbapi:full {basePathKey?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The scheduler processor which fetches full API from Facebook.';

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
     * Fetches all data from full mode (CronJob).
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    private function fetchAll()
    {
        $apiGroups = DB::table( 'fb_api_group_full_mode' )->get();

        foreach( $apiGroups as $apiGroup )
            $this->fetchElement( $apiGroup->basePathKey );
        
        return true;
    }

    /**
     * Fetches data related to an API full group.
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    private function fetchElement( $basePathKey )
    {
        $apiGroup = DB::table( 'fb_api_group_full_mode' )
            ->where( 'fb_api_group_full_mode.basePathKey', $basePathKey );

        $DB_apiGroup = DB::table( 'fb_api_group_full_mode' )
            ->where( 'fb_api_group_full_mode.basePathKey', $basePathKey )->get();
        $apiConfigurations = DB::table( 'fb_api_group_full_mode' )
            ->where( 'fb_api_group_full_mode.basePathKey', $basePathKey )
            ->join( '_fbapigroupfullmode_edgenode', '_fbapigroupfullmode_edgenode.apiGroup', '=', 'fb_api_group_full_mode.id_api_group' )
            ->join( 'fb_page_edge_node', 'fb_page_edge_node.endPath', '=', '_fbapigroupfullmode_edgenode.edgeNode' )
            ->get();

        if( sizeof($DB_apiGroup) == 1 ) {
            $DB_apiGroup = $DB_apiGroup[ 0 ];

            foreach( $apiConfigurations as $apiConfiguration ) {

                $URI = '/' . $apiConfiguration->source . '/' . $apiConfiguration->pageEdge . '?fields=id&limit=100';             //  should be requested just ID
                $response = Facebook::fetchRequest( $URI );



                if( $response[ 'success' ] ) {

                    $responseSource = $response[ 'response' ][ 'data' ];
                    $responseSource = array_reverse($responseSource);
                    $this->cleanRemovedData( $responseSource, $DB_apiGroup->id_api_group );
                    
                    foreach( $responseSource as $responseEdge ) {
                        $responseEdgeID = $responseEdge[ 'id' ];

                        //  response with sub requests
                        if( isset($responseEdgeID) ) {

                            //  Info for the edge
                            $edgeInfo = FB_api_group_full_mode_source::where([
                                'source' => $responseEdgeID,
                                'apiGroup' => $DB_apiGroup->id_api_group
                            ])->get();

                            if( !sizeof( $edgeInfo ) ) {
                                $DB_fields = DB::table( '_fb_parent_field' )
                                    ->select( 'field' )
                                    ->where( 'edge', $apiConfiguration->pageEdge )
                                    ->distinct()
                                    ->get();

                                $URI = '/' . $responseEdgeID;

                                $response = Facebook::fetchRequest( $URI );

                                $fields = '?fields=';
                                $DB_fieldsNo = sizeof($DB_fields);
                                for( $i = 0; $i < $DB_fieldsNo; )
                                    $fields .= $DB_fields[ $i ]->field . ( ++$i != $DB_fieldsNo ? ',' : '' );



                                if( $response[ 'success' ] )
                                    FB_api_group_full_mode_source::create([
                                        'source' => $responseEdgeID,
                                        'apiGroup' => $DB_apiGroup->id_api_group,
                                        'info' => json_encode( $response[ 'response' ], true )
                                    ]);
                            }



                            $api = FB_api_full_mode::where([
                                'base' => $responseEdgeID,
                                'endPath' => $apiConfiguration->endPath,
                                'groupApi' => $DB_apiGroup->id_api_group
                            ])->get()->toArray();

                            //  fields for the request
                            $DB_fields = DB::table( '_fb_parent_field' )
                                ->select( 'field' )
                                ->where( 'edgeNode', $apiConfiguration->edgeNode )
                                ->orWhere( 'edge', $apiConfiguration->pageEdge )
                                ->distinct()
                                ->get();

                            $fields = '?fields=';
                            $DB_fieldsNo = sizeof($DB_fields);
                            for( $i = 0; $i < $DB_fieldsNo; )
                                $fields .= $DB_fields[ $i ]->field . ( ++$i != $DB_fieldsNo ? ',' : '' );
                            


                            //  *********************************************************
                            $fields = '';
                            if( $apiConfiguration->basePathKey == 'uphxd3ozeeXFIqwPBbm7G8LBuiyr1jO9' && $apiConfiguration->endPath == 'photos' ) $fields = '?fields=source';
                            //  *********************************************************

                            $edgeURI = '/' . $responseEdgeID . '/' . $apiConfiguration->edgeNode . $fields;
                            $this->setInfo( $responseEdgeID, $apiConfiguration );

                            $edgeResponse = Facebook::fetchRequest( $edgeURI );
                            
                            if( isset($edgeResponse[ 'response' ]) && isset($edgeResponse[ 'response' ][ 'data' ]) ) {
                                $edgeEncodedResponseData = json_encode( $edgeResponse[ 'response' ][ 'data' ] );
                                
                                if( sizeof($api) == 0 )
                                    FB_api_full_mode::create([
                                        'base' => $responseEdgeID,
                                        'endPath' => $apiConfiguration->endPath,
                                        'groupApi' => $DB_apiGroup->id_api_group,
                                        'response' => $edgeEncodedResponseData,
                                        'created_at' => Carbon::now()
                                    ]);
                                else
                                    FB_api_full_mode::where([
                                        'base' => $responseEdgeID,
                                        'endPath' => $apiConfiguration->endPath,
                                        'groupApi' => $DB_apiGroup->id_api_group
                                    ])->update( ['response' => $edgeEncodedResponseData] );

                            }
                            else {
                                /*
                                 * print( var_dump($edgeURI) );
                                 * errors into full mode with all media selected
                                 * */
                            }

                        }

                    }

                    $apiGroup->increment( 'totalUpdates' );
                    $apiGroup->update([
                        'updated_at' => Carbon::now()
                    ]);

                    session( ['apiFetcher.element.isFetched' => true] );

                }
                else
                    session( ['apiFetcher.element.isFetched' => false] );

            }
        }
        else
            session( ['apiFetcher.element.isFetched' => false] );

    }

    private function setInfo( $responseEdgeID, $apiConfiguration )
    {
        $DB_pageFields = DB::table( '_fb_parent_field' )
            ->select( 'field' )
            // ->where( 'edgeNode', $apiConfiguration->basePathKey )
            ->orWhere( 'edge', $apiConfiguration->pageEdge )
            ->distinct()
            ->get();

        $api = FB_api_full_mode::where( ['base' => $responseEdgeID, 'endPath' => $apiConfiguration->endPath] );

        $fields = '?fields=';
        $DB_fieldsNo = sizeof($DB_pageFields);
        for( $i = 0; $i < $DB_fieldsNo; )
            $fields .= $DB_pageFields[ $i ]->field . ( ++$i != $DB_fieldsNo ? ',' : '' );

        $URI = '/' . $responseEdgeID . $fields;
        $response = Facebook::fetchRequest( $URI );

        if( $response[ 'success' ] ) {
            $encodedResponse = json_encode( $response[ 'response' ] );

            $api->update( ['info' => $encodedResponse] );
        }

    }

    private function cleanRemovedData( $responseSource, $apiGroupID ) {
        $DB_sources = FB_api_group_full_mode_source::where([
            'apiGroup' => $apiGroupID
        ])->select( 'source' )->get()->toArray();
        $DB_apis = FB_api_full_mode::where([
            'groupApi' => $apiGroupID
        ])->select( 'base' )->get()->toArray();

        //  deleting fields from 'FB_api_group_full_mode_source'
        for( $i = 0; $i < sizeof($DB_sources); $i++ ) {
            $isFound = false;

            for( $j = 0; $j < sizeof($responseSource) && !$isFound; $j++ )
                $isFound = $DB_sources[ $i ]['source'] == $responseSource[ $j ]['id'];

            //  deleting "removed posts" by user
            if( !$isFound )
                FB_api_group_full_mode_source::where([
                    'source' => $DB_sources[ $i ]['source'],
                    'apiGroup' => $apiGroupID
                ])->delete();
        }

        //  deleting fields from 'FB_api_full_mode'
        for( $i = 0; $i < sizeof($DB_apis); $i++ ) {
            $isFound = false;

            for( $j = 0; $j < sizeof($responseSource) && !$isFound; $j++ )
                $isFound = $DB_apis[ $i ]['base'] == $responseSource[ $j ]['id'];

            //  deleting "removed posts" by user
            if( !$isFound )
                FB_api_full_mode::where([
                    'base' => $DB_apis[ $i ]['base'],
                    'groupApi' => $apiGroupID
                ])->delete();
        }
    }
}
