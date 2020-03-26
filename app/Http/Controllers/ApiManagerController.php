<?php

namespace App\Http\Controllers;

use App\FB_api_group;
use App\FB_api_group_full_mode;
use App\FB_api_info;
use App\FB_api_partial_mode;
use App\FB_api_resource;
use App\FB_requests_dates;
use App\FB_requests_dates_info;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Builder;
use Illuminate\Http\Request;

use Facebook\Facebook;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FB_api_group_partial_mode;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

define( 'Facebook', app_path() . '/Facebook/src/Facebook/' );
require_once( Facebook . 'autoload.php' );

/**
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiManagerController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param   string  $basePathKey
     * @param   Request $request
     * @return  \Illuminate\Http\Response
     */
    public function show( $basePathKey, Request $request )
    {
        $isMedia = FB_api_resource::isMedia( 'basePathKey', $basePathKey );

        if( is_null($isMedia) )
            return $this->sendJSONResponse( false, $request, null, 'The resource do not exists.' );
        elseif( $isMedia )
            return $this->showMedia( $basePathKey, $request );
        else
            return $this->showInfo( $basePathKey, $request );

    }

    private function showInfo( $basePathKey, Request $request )
    {
        $apiGroup = FB_api_info::where( 'basePathKey', $basePathKey );

        $apiGroup = $apiGroup->get()[ 0 ];


        $patternDomain = '/.*'.$apiGroup->whiteListDomain.'.*/';
        $referer = $request->header( 'Referer' );
        if(
                preg_match( $patternDomain, $referer )
            ||  $request->ip() == $apiGroup->whiteListStagingIP
        ) {
            $id = $apiGroup->id_api;
            $now = Carbon::now();
            $month = $now->month;
            $year = $now->year;

            $response = json_decode( $apiGroup->response );

            $requestsInDate = FB_requests_dates_info::where( [
                [ 'api', $id ],
                [ 'month', $month ],
                [ 'year', $year ]
            ] );

            if( sizeof($requestsInDate->get()) == 1 )
                $requestsInDate->increment('requestsNo');
            else {
                FB_requests_dates_info::create([
                    'api' => $id,
                    'month' => $month,
                    'year' => $year,
                    'requestsNo' => 1
                ]);
            }

            return $this->sendJSONResponse( true, $request, $response );
        } else
            return $this->sendJSONResponse( false, $request, null, 'The resource is not accessible.' );
    }

    private function showMedia( $basePathKey, $request )
    {
        $apiGroup = FB_api_group::where( 'basePathKey', $basePathKey );

        $apiGroup = $apiGroup->get()[ 0 ];
        $response = array();

        $apis = DB::table( 'fb_api_group_' . $apiGroup->mode . '_mode' )
            ->join( 'fb_api_' . $apiGroup->mode . '_mode', 'fb_api_' . $apiGroup->mode . '_mode.groupApi', '=', 'fb_api_group_' . $apiGroup->mode . '_mode.id_api_group' )
            ->where( 'fb_api_group_' . $apiGroup->mode . '_mode.basePathKey', $basePathKey )->get();
        
        if( $apiGroup->mode == 'full' )
            $apis = array_reverse($apis);

        foreach( $apis as $api )
            $response[ $api->base ] = array();
        foreach( $apis as $api )
            if( !isset( $response[ $api->base ][ 'info' ] ) )
                $response[ $api->base ][ 'info' ] = json_decode( $api->info );

        foreach( $apis as $api )
            $response[ $api->base ][ $api->endPath ] = json_decode( $api->response );

        $patternDomain = '/.*'.preg_replace('/\//', '\\\/', $apiGroup->whiteListDomain).'.*/';
        $referer = $request->header( 'Referer' );
        if(
                preg_match( $patternDomain, $referer )
            &&  strlen($apiGroup->whiteListDomain)
            ||  $request->ip() == $apiGroup->whiteListStagingIP
                || true
        ) {
            $id = $apiGroup->id_api_group;
            $now = Carbon::now();
            $month = $now->month;
            $year = $now->year;

            $requestsInDate = DB::table('fb_requests_dates_' . $apiGroup->mode . '_mode')->where( [
                [ 'groupApi', $id ],
                [ 'month', $month ],
                [ 'year', $year ]
            ] );

            if( sizeof($requestsInDate->get()) == 1 )
                $requestsInDate->increment('requestsNo');
            else {
                FB_requests_dates::createFromHub( [
                    'groupApi' => $id,
                    'month' => $month,
                    'year' => $year,
                    'requestsNo' => 1
                ], $apiGroup->mode );
            }

            return $this->sendJSONResponse( true, $request, $response );
        } else
            return $this->sendJSONResponse( false, $request, null, 'The resource is not accessible.' );
    }

    /**
     *
     *
     *
     */
    public function index()
    {
        Artisan::call( 'api:fetch' );
    }

    /**
     *
     *
     *
     */
    public function fetch( $basePathKey, Request $request )
    {
        $DB_resource = FB_api_resource::where( 'basePathKey', $basePathKey );
        if( $DB_resource ) {
            $resource = $DB_resource->get()->toArray()[ 0 ];
            
            if( $resource[ 'mode' ] == 'full' ) {
                Artisan::call('fbapi:full', ['basePathKey' => $basePathKey]);
            }
            elseif ( $resource[ 'mode' ] == 'partial' ) {
                Artisan::call('fbapi:partial', ['basePathKey' => $basePathKey]);
            }
            else {
                Artisan::call('fbapi:info', ['basePathKey' => $basePathKey]);
            }
            
        }
    }

    /**
     * Return a JSON Response.
     * header( 'Cache-Control: max-age=86400' )     //  24 * 60 * 60 seconds = 1 day
     *
     * @param   boolean $success
     * @param   array   $data
     * @param   string  $message
     * @return  \Illuminate\Http\Response
     */
    private function sendJSONResponse( $success, $request, $data = null, $message = null )
    {
        $callback = $request->input( 'callback' );
        $response = array();
        $response[ 'success' ] = $success;
        $status = $success ? 200 : 401;

        if( $success )
            $response[ 'data' ] = $data;
        else
            $response[ 'message' ] = $message;

        if( is_null($callback) )
            return response()
                    ->json(
                        $response,
                        $status,
                        [
                            'Access-Control-Allow-Origin' => '*',
                            'Content-Type' => 'application/json',
                            'Cache-Control' => 'max-age=86400'
                        ]
                    );
        else
            return response()
                    ->jsonp(
                        $callback,
                        $response,
                        $status,
                        [
                            'Access-Control-Allow-Origin' => '*',
                            'Cache-Control' => 'max-age=86400'
                        ]
                    );
    }
}
