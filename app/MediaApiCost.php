<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaApiCost extends Model
{
    protected $table = 'media_api_cost';
    
    protected $fillable = [ 'monthCost', 'servicesNo' ];
    
    public $timestamps = false;
    
    public static function filterAll() {
        $apis = self::all();
        
        foreach( $apis as $api ) {
            if( $api->monthCost == 0 )
                $api->monthCost = "FREE";
            
            if( $api->servicesNo == -1 )
                $api->servicesNo = "Unlimited";
        }
            
        return $apis;
    }
    
    public static function filter( $apis ) {
        for( $i = 0; $i < sizeof($apis); $i++ ) {
            if( $apis[ $i ][ 'monthCost' ] == 0 )
                $apis[ $i ][ 'monthCost' ] = "FREE";
            
            if( $apis[ $i ][ 'servicesNo' ] == -1 )
                $apis[ $i ][ 'servicesNo' ] = "Unlimited";
        }
            
        return $apis;
    }
    
    public static function getMonthlyCost( $apiRate ) {
        if( $apiRate == "Unlimited" )
            $apiRate = -1;
        if( $apiRate == "FREE" )
            $apiRate = 0;
        
        $costs = self::where( 'servicesNo', $apiRate )->get();
        
        if( sizeof($costs) == 0 )
            return false;
        
        return $costs[ 0 ][ 'monthCost' ];
    }
    
}
