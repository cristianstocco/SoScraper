<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FB_api_mode extends Model
{
    protected $table = 'fb_api_mode';

    public $timestamps = false;

    /**
     * Define if record exists.
     *
     * @var string
     *
     * @return bool
     */
    public static function getMode( $modeName = null ) {
        if( is_null($modeName) || !strlen($modeName) )
            return false;

        $mode = FB_api_mode::where( 'name', $modeName )->get();

        if( sizeof($mode) == 1 ) {
            $mode = $mode[ 0 ];
            return array(
                            'toFetchMedia' => $mode[ 'fetchMedia' ],
                            'isInfo' => $mode[ 'name' ] == 'info',
                            'isFull' => $mode[ 'name' ] == 'full'
                        );
        }
        else
            return false;
    }
}
