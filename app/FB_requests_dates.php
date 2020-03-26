<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FB_requests_dates extends Model
{
    public static function createFromHub( $attributes, $mode )
    {
        if( $mode == "full" )
            return FB_requests_dates_full_mode::create( $attributes );
        elseif( $mode == "partial" )
            return FB_requests_dates_partial_mode::create( $attributes );
        else
            return null;
    }
}
