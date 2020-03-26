<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use RandomLib\Factory;

class FB_page_field extends Model
{
    protected $table = 'fb_field';

    public $timestamps = false;

    private static $baseInputName = 'info';

    /**
     * Returns every record of 'FB_page_field' with a tokenized name for inputs.
     *
     * return Collection.
     */
    public static function allWithInputName()
    {
        $factory = new Factory();
        $generator = $factory->getLowStrengthGenerator();
        $tokens = array();

        $pageFields = self::all();
        $pageFieldsNo = sizeof( $pageFields );

        for( $i = 0; $i < $pageFieldsNo; $i++ ) {
            do {
                $toRegenerate = false;
                $isFound = false;

                $token = $generator->generateString( 8 );

                for( $j = 0; $j < sizeof($tokens) && !$isFound; $j++ )
                    if( $token == $tokens[ $j ] ) {
                        $toRegenerate = true;
                        $isFound = true;
                    }
            }
            while( $toRegenerate );

            $pageFields[ $i ][ 'inputName' ] = self::$baseInputName . $token;
            array_push( $tokens, $token );
        }

        return $pageFields;
    }

    /**
     * Extracts and validate FaceBook page fields from Request post params.
     *
     * @return array
     */
    public static function getFields( $request )
    {
        $fields = self::extractsFromRequest( $request );
        $fields = self::validateFields( $fields );

        return $fields;
    }

    /**
     * Extracts FaceBook page fields from Request post params.
     */
    private static function extractsFromRequest( $request ) {
        $postParams = $request->all();
        $postParamsKeys = array_keys($postParams);
        $postParamsKeysNo = sizeof( $postParamsKeys );
        $fields = array();
        $fieldsName = array();

        for( $i = 0; $i < $postParamsKeysNo; $i++ )
            if( is_numeric(strpos($postParamsKeys[ $i ], self::$baseInputName )) )
                array_push( $fieldsName, $postParamsKeys[ $i ] );

        for( $i = 0; $i < sizeof($fieldsName); $i++ )
            array_push( $fields, $request[ $fieldsName[$i] ] );

        return $fields;
    }

    /**
     * Validate FaceBook page fields from Request post params.
     */
    private static function validateFields( $fields ) {
        return self::whereIn( 'query', $fields )->where( 'isPageField', 1 )->get();
    }
}