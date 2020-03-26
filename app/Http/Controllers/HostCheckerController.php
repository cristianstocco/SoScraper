<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class HostCheckerController extends Controller
{
    const DOMAIN_NULL_ERROR = 'The domain is null.';
    const DOMAIN_NOT_VALID_ERROR = 'The domain is not valid.';
    const DOMAIN_REDIRECT_ERROR = 'The domain is not valid because the request is followed by a redirect.';
    const PROTOCOL_END_PATH = '//';

    private $response = array();
    private $logger;
    private $loggerStream;

    private $host;

    public function __construct( $host, $section )
    {
        $this->host = $host;
        $this->response = array();

        $this->loggerStream = new StreamHandler(storage_path('logs/info') . '/whitelist.log', Logger::DEBUG);
        $this->logger = new Logger( $this->getSection($section) );
        $this->logger->pushHandler( $this->loggerStream );
    }

    /**
     * Validates the domain, fetching the URL.
     * */
    public function execute()
    {
        if( $this->validateDomain() )
            $this->fetchCURL();

        return $this->response;
    }

    /**
     * Returns if the host domain is valid.
     *
     * @return boolean
     * */
    private function validateDomain()
    {
        if( is_null($this->host) || !strlen($this->host) ) {
            $this->response[ 'isValid' ] = false;
            $this->response[ 'error' ] = self::DOMAIN_NULL_ERROR;

            return false;
        }
        else {
            $this->cleanUpHost();
            if( $this->isDomain() )
                return true;

            else {
                $this->response[ 'isValid' ] = false;
                $this->response[ 'error' ] = self::DOMAIN_NOT_VALID_ERROR;

                return false;
            }
        }

    }

    /**
     * Clean up the host name, removing path or additional parameters.
     * */
    private function cleanUpHost()
    {
        if( str_contains($this->host, '?') )
            $this->host = substr( $this->host, 0, strpos($this->host, '?') );
        if( str_contains($this->host, '&') )
            $this->host = substr( $this->host, 0, strpos($this->host, '&') );
        if( str_contains($this->host, '#') )
            $this->host = substr( $this->host, 0, strpos($this->host, '#') );

        $endProtocolI = strpos( $this->host, self::PROTOCOL_END_PATH ) + strlen( self::PROTOCOL_END_PATH );
        $prototype = substr( $this->host, 0, $endProtocolI );
        $host = substr( $this->host, $endProtocolI );

        if( str_contains($host, '/') )
            $host = substr( $host, 0, strpos($host, '/') );

        $this->host = $prototype . $host;
    }

    /**
     * Fetches CURLs and build response.
     *
     * @param $domain
     * @param $section
     *
     * @return $response The response params from curl.
     * */
    private function fetchCURL()
    {
        $curl = curl_init( $this->host );
        curl_setopt( $curl, CURLINFO_HEADER_OUT, true );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_CONNECTTIMEOUT, 5 );
        curl_exec( $curl );
        $error = curl_error( $curl );
        $httpCode = curl_getinfo( $curl, CURLINFO_HTTP_CODE);
        curl_close( $curl );

        if( $httpCode == 200 )
            $this->response[ 'isValid' ] = true;

        elseif( $httpCode == 302 || $httpCode == 301 ) {
            $this->response[ 'isValid' ] = false;
            $this->response[ 'error' ] = self::DOMAIN_REDIRECT_ERROR;
        }

        else {
            $this->setLog( $error );

            $this->response[ 'isValid' ] = false;
            $this->response[ 'error' ] = self::DOMAIN_NOT_VALID_ERROR;
        }
    }

    /**
     * Returns if the host is a domain.
     *
     * @return boolean
     * */
    private function isDomain()
    {
        return      is_string( $this->host )
                &&  str_contains( $this->host, '.' )
                &&  !self::isIP( $this->host );
    }

    /**
     * Returns if the host is an IP.
     *
     * @oaram $host
     *
     * @return boolean
     * */
    public static function isIP( $host )
    {
        return sizeof( explode( '.', $host ) ) == 4;
    }

    /**
     * Logs the debug.
     *
     * @param $setLog
     *
     * @return void
     * */
    private function setLog( $error ) {
        $this->logger->addInfo( $error . " -> " . $this->host );
    }

    /**
     * Returns the section associated to $section, in order to describe the section where logs are associated.
     *
     * @param $section
     *
     * @return string
     * */
    private function getSection( $section ) {

        switch( $section ) {
            case "update":
                $_section = "update";
            break;

            case "create":
                $_section = "create";
            break;

            default:
                $_section = "default";
        }

        return $_section;

    }
}
