<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class FB_api_group extends Model {

    public static function where($column, $operator = null, $value = null, $boolean = 'and') {
        $apiGroup_full = FB_api_group_full_mode::where($column, $operator, $value, $boolean);
        $DB_apiGroup_full = $apiGroup_full->get();

        $apiGroup_partial = FB_api_group_partial_mode::where($column, $operator, $value, $boolean);
        $DB_apiGroup_partial = $apiGroup_partial->get();

        if( sizeof( $DB_apiGroup_full ) > 0 && !sizeof( $DB_apiGroup_partial ) )
            return $apiGroup_full;

        elseif( sizeof( $DB_apiGroup_partial ) > 0 && !sizeof( $DB_apiGroup_full ) )
            return $apiGroup_partial;

        elseif( !sizeof( $DB_apiGroup_partial ) && !sizeof( $DB_apiGroup_full ) )
            return null;

        else {
            $loggerStream = new StreamHandler(storage_path('logs/critical') . '/apiGroup.log', Logger::DEBUG);
            $logger = new Logger( 'FB_api_group' );
            $logger->pushHandler( $loggerStream );

            $logger->addCritical( "existing apiGroup partial & apiGroup full have the same column: $column -> operator: $operator, value: $value" );

            return null;
        }
    }

}
