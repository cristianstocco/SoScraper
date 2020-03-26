<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\User;
use App\CheckoutFlow;

class CheckoutFlowController extends Controller
{
    function __construct() {}

    /**
     * Determine if the user checkout is valid by referer and current request.
     *
     * @return bool
     */
    function isValid() {
        $requestController = new RequestController();

        if( User::isAdmin() || User::isModerator() )
            return true;

        $previousPath = $requestController->getPath( url()->previous() );
        $previousPathData = CheckoutFlow::where( 'path', $previousPath )->get()->first();

        $currentPath = $requestController->getPath( url()->current() );
        $currentPathData = CheckoutFlow::where( ['path' => $currentPath] )->get()->first();

        //  under checkout steps
        if( is_object($currentPathData) && is_object($previousPathData) && $currentPathData != $previousPathData ) {
            $stepDiff = ceil( $currentPathData->step - $previousPathData->step );

            if( $stepDiff == 1 )
                return true;

            return false;
        }

        //  first checkout step
        if( is_object($currentPathData) )
            return $currentPathData->step == 1;

        //  not valid
        return false;
    }

}
