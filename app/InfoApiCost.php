<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoApiCost extends Model
{
    protected $table = 'info_api_cost';
    
    protected $fillable = [ 'monthCost', 'servicesNo' ];
    
    public $timestamps = false;
    
    public static function filter( $apis ) {
        for( $i = 0; $i < sizeof($apis); $i++ ) {
            if( $apis[ $i ][ 'monthCost' ] == 0 )
                $apis[ $i ][ 'monthCost' ] = "FREE";
            
            if( $apis[ $i ][ 'servicesNo' ] == -1 )
                $apis[ $i ][ 'servicesNo' ] = "Unlimited";
        }
        
        return $apis;
    }
}
