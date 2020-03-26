<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class CheckoutFlow extends Controller
{
    static function checkRequest() {
        if( Auth::isAdmin() || Auth::isModerator() )
            return;
        
        $previousPath = url()->previous();
        $previousPath = substr( $previousPath, strlen( config('app.url') ) );
        $previousPathData = \App\CheckoutFlow::where( 'path', $previousPath )->get();
        
        $currentPath = url()->current();
        $currentPath = substr( $currentPath, strlen( config('app.url') ) );
        $currentPathData = \App\CheckoutFlow::where( ['path' => $currentPath] )->get();
        
        if( sizeof($currentPathData) == 1 && sizeof($previousPathData) == 1 ) {
            $currentPathData = $currentPathData[ 0 ];
            $previousPathData = $previousPathData[ 0 ];
            
            $stepDiff = ceil( $currentPathData[ 'step' ] - $previousPathData[ 'step' ] );
            
            if( !($stepDiff == 1) )
                return self::sendRedirect();
        }
        else
            return self::sendRedirect();
    }
    
    static function sendRedirect() {
        $dashboardRoute = route( 'dashboard' );
        
        if( request()->ajax() ) {
            $response = [];
            
            $response[ 'success' ] = false;
            $response[ 'location' ] = $dashboardRoute;
            
            return response( $response )->header( 'Content-Type', 'application/json' );
        }
        
        else
            return redirect( $dashboardRoute );
    }
    
}
