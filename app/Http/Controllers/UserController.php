<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\FB_api_resource;
use App\FB_api_info;
use App\FB_api_group_partial_mode;
use App\FB_api_group_full_mode;
use Carbon\Carbon;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        return view('user.account.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apiGroup_full = [];
        
        $apiGroup_info = FB_api_info::where( 'user', Auth::user()->id )->get();
        $apiGroup_partial = FB_api_group_partial_mode::where( 'user', Auth::user()->id )->get();
        
        $apiGroup_full_sources = FB_api_group_full_mode::where( 'user', Auth::user()->id )->select( 'source' )->distinct()->get()->toArray();
        for( $i = 0; $i < sizeof($apiGroup_full_sources); $i++ )
            $apiGroup_full[ $i ] = FB_api_group_full_mode::where( ['user' => Auth::user()->id, 'source' => $apiGroup_full_sources[ $i ][ 'source' ]] )->get()->toArray();
        
        return view('user.dashboard', compact( 'apiGroup_info', 'apiGroup_partial', 'apiGroup_full' ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notifications()
    {
        $apis = FB_api_resource::all();
        $now = Carbon::now();
        
        $response = array();
        $toNotify = array();
        $apiData = array();
        
        for( $i = 0; $i < sizeof($apis); $i++ ) {
            $apiTime = Carbon::parse( $apis[ $i ]->finish_at );
            
            if( $apiTime->diffInMonths( $now ) == 0 )
                array_push( $toNotify, $apis[ $i ]->basePathKey );
        }
        
        $response[ 'success' ] = true;
        $response[ 'data' ] = $toNotify;
        return response(json_encode($response) )->header( 'Content-Type', 'application-json' );
    }
}
