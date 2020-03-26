<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HostWhitelistController extends Controller
{
    const MISSING_PARAMS_ERROR = 'You must insert a domain to white list him or just a staging IP.';
    const IP_NOT_VALID_ERROR = 'The IP is not valid.';

    public $isSuccessfullyProcessed;
    public $error;

    private $noWhiteList;
    public $missingDaysToWhiteList;
    public $whiteListDomain;
    public $whiteListStagingIP;

    public function __construct( $noWhiteList, $missingDaysToWhiteList, $whiteListDomain, $whiteListStagingIP )
    {
        $this->noWhiteList = $noWhiteList;
        $this->missingDaysToWhiteList = $missingDaysToWhiteList;
        $this->whiteListDomain = $whiteListDomain;
        $this->whiteListStagingIP  = $whiteListStagingIP;
        
        $this->execute();
    }

    private function execute()
    {
        if( is_null($this->noWhiteList) || is_null($this->missingDaysToWhiteList) ) {

            //  Checking whitelist domains & IPs
            if (
                    (is_null($this->whiteListDomain) || strlen($this->whiteListDomain) == 0)
                &&  (is_null($this->whiteListStagingIP) || strlen($this->whiteListStagingIP) == 0)
            ) {
                $this->isSuccessfullyProcessed = false;
                $this->error = self::MISSING_PARAMS_ERROR;
                return;
            }

            if( !is_null($this->whiteListDomain) && strlen($this->whiteListDomain) ) {
                $hostChecker = new HostCheckerController( $this->whiteListDomain, 'update' );
                $hostChecker_response = $hostChecker->execute();

                if ( !$hostChecker_response[ 'isValid' ] ) {
                    $this->isSuccessfullyProcessed = false;
                    $this->error = $hostChecker_response[ 'error' ];
                    return;
                }
            }

            if( !is_null($this->whiteListStagingIP) && strlen($this->whiteListStagingIP) ) {
                $isValid = HostCheckerController::isIP( $this->whiteListStagingIP );

                if ( !$isValid ) {
                    $this->isSuccessfullyProcessed = false;
                    $this->error = self::IP_NOT_VALID_ERROR;
                    return;
                }
            }

            $this->missingDaysToWhiteList = null;
            $this->isSuccessfullyProcessed = true;

        }
        else {
            $this->whiteListDomain = "";
            $this->whiteListStagingIP = "";
            $this->missingDaysToWhiteList = 7;
            $this->isSuccessfullyProcessed = true;
        }
    }
}
