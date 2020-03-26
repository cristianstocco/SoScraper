<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

use Illuminate\Support\Facades\DB;

class FB_api_resource extends Model
{
    public static function where($column, $operator = null, $value = null, $boolean = 'and') {
        $apiGroup_full = FB_api_group_full_mode::where($column, $operator, $value, $boolean);
        $DB_apiGroup_full = $apiGroup_full->get();

        $apiGroup_partial = FB_api_group_partial_mode::where($column, $operator, $value, $boolean);
        $DB_apiGroup_partial = $apiGroup_partial->get();

        $apiGroup_info = FB_api_info::where($column, $operator, $value, $boolean);
        $DB_apiGroup_info = $apiGroup_info->get();

        if( sizeof( $DB_apiGroup_full ) && !sizeof( $DB_apiGroup_partial ) && !sizeof( $DB_apiGroup_info ) )
            return $apiGroup_full;

        elseif( sizeof( $DB_apiGroup_partial ) && !sizeof( $DB_apiGroup_full ) && !sizeof( $DB_apiGroup_info ) )
            return $apiGroup_partial;

        elseif( sizeof( $DB_apiGroup_info ) && !sizeof( $DB_apiGroup_full ) && !sizeof( $DB_apiGroup_partial ) )
            return $apiGroup_info;

        elseif( !sizeof( $DB_apiGroup_partial ) && !sizeof( $DB_apiGroup_full ) && !sizeof( $DB_apiGroup_partial ) )
            return null;

        else {
            $loggerStream = new StreamHandler(storage_path('logs/critical') . '/apiGroup.log', Logger::DEBUG);
            $logger = new Logger( 'FB_api_group' );
            $logger->pushHandler( $loggerStream );

            $logger->addCritical( "existing apiGroup partial & apiGroup full have the same column: $column -> operator: $operator, value: $value" );

            return null;
        }
    }

    public static function isMedia($key, $value, $strict = true) {
        $apiGroup_full = FB_api_group_full_mode::where($key, $value, $strict);
        $DB_apiGroup_full = $apiGroup_full->get();

        $apiGroup_partial = FB_api_group_partial_mode::where($key, $value, $strict);
        $DB_apiGroup_partial = $apiGroup_partial->get();

        $apiGroup_info = FB_api_info::where($key, $value, $strict);
        $DB_apiGroup_info = $apiGroup_info->get();

        if( sizeof( $DB_apiGroup_full ) && !sizeof( $DB_apiGroup_partial ) && !sizeof( $DB_apiGroup_info ) )
            return true;

        elseif( sizeof( $DB_apiGroup_partial ) && !sizeof( $DB_apiGroup_full ) && !sizeof( $DB_apiGroup_info ) )
            return true;

        elseif( sizeof( $DB_apiGroup_info ) && !sizeof( $DB_apiGroup_full ) && !sizeof( $DB_apiGroup_partial ) )
            return false;

        elseif( !sizeof( $DB_apiGroup_partial ) && !sizeof( $DB_apiGroup_full ) && !sizeof( $DB_apiGroup_partial ) )
            return null;

        else {
            $loggerStream = new StreamHandler(storage_path('logs/critical') . '/apiGroup.log', Logger::DEBUG);
            $logger = new Logger( 'FB_api_group' );
            $logger->pushHandler( $loggerStream );

            $logger->addCritical( "existing apiGroup partial & apiGroup full have the same key: $key -> value: $value, strict: $strict" );

            return null;
        }
    }

    public static function deleteCollection( $basePathKey, $userID )
    {
        $apiResource = self::where( ['basePathKey' => $basePathKey, 'user' => $userID] )->get();

        if( is_object($apiResource) )
            return $apiResource[ 0 ]->deleteCollection();
        else
            return false;
    }
    
    public static function all($columns = ['*']) {
        $apiGroup_full = DB::table( 'fb_api_group_full_mode' )
                ->join( 'user_payment', 'user_payment.paymentID', '=', 'fb_api_group_full_mode.paymentID' )
                ->get();

        $apiGroup_partial = DB::table( 'fb_api_group_partial_mode' )
                ->join( 'user_payment', 'user_payment.paymentID', '=', 'fb_api_group_partial_mode.paymentID' )
                ->get();

        $apiGroup_info = DB::table( 'fb_api_info' )
                ->join( 'user_payment', 'user_payment.paymentID', '=', 'fb_api_info.paymentID' )
                ->get();
        
        return array_merge( $apiGroup_full, $apiGroup_partial, $apiGroup_info );
    }
}
