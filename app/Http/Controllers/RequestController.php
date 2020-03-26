<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    const PROTOCOL_DELIMITER = '://';

    function __construct() {}

    /**
     * Returns the path from a URI.
     *
     * @param  string   $uri
     * @return string
     */
    function getPath( $uri ) {
        $path = $uri;

        //  protocol
        $protocolPosition = strpos( $path, self::PROTOCOL_DELIMITER );
        if( is_int( $protocolPosition ) )
            $path = substr( $path, $protocolPosition + strlen( self::PROTOCOL_DELIMITER ) );

        //  slash
        $slashPosition = strpos( $path, '/' );
        if( is_int( $slashPosition ) )
            $path = substr( $path, $slashPosition );

        return $path;
    }
}
