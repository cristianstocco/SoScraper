<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';

    /**
     * Define if record exists.
     *
     * @param $name
     *
     * @return bool
     */
    public static function exists( $name ) {
        $provider = Provider::where( 'name', '=', $name )->get();

        return sizeof( $provider ) == 1;
    }

}