<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ReCaptchaController extends Controller
{
    private static $reCaptchaURL = 'https://www.google.com/recaptcha/api/siteverify';
    private static $reCaptchaSecret = '6LfUvCcTAAAAAERtvPe2jkZSUJ5rzK2XwYI_fXO2';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function validateReCaptcha( $recaptchaResponseValue )
    {
        if( env( 'APP_ENV' ) == 'local' )
            return true;
        
        if( !strlen($recaptchaResponseValue) )
            return false;
            
        $init = curl_init( self::$reCaptchaURL );
        
        $postData = array();
        $postData[ 'secret' ] = self::$reCaptchaSecret;
        $postData[ 'response' ] = $recaptchaResponseValue;
        
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($init, CURLOPT_POST, true);
        curl_setopt($init, CURLOPT_POSTFIELDS, $postData);
        
        $response = json_decode( curl_exec( $init ), true );
        return $response[ 'success' ];
    }
}
