<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FB_page_edge extends Model
{
    protected $table = 'fb_page_edge';

    public $timestamps = false;

    /**
     * Define if record exists.
     *
     * @param $endPath
     *
     * @return bool
     */
    public static function exists( $endPath = null ) {
        if( is_null($endPath) || !strlen($endPath) )
            return false;

        $pageEdge = FB_page_edge::where( 'endPath', '=', $endPath )->get();

        return sizeof( $pageEdge ) == 1;
    }
}
