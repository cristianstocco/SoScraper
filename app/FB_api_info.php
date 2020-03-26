<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FB_api_info extends Model
{
    protected $table = 'fb_api_info';

    protected $primaryKey = 'id_api';

    protected $fillable = ['user', 'source', 'whiteListDomain', 'whiteListStagingIP', 'name', 'basePathKey', 'paymentID', 'totalUpdates', 'missingDaysToWhiteList', 'response', 'updated_at'];

    public $timestamps = true;

    public static function createWithFields( $attributes, $fields )
    {
        $basePathKey = $attributes[ 'basePathKey' ];

        self::create( $attributes );

        foreach( $fields as $field )
            FB_apiInfo_field::create([
                'basePathKey' => $basePathKey,
                'query' => $field->query
            ]);
    }

    public function deleteCollection()
    {
        $basePathKey = $this->basePathKey;

        FB_apiInfo_field::where( 'basePathKey', $basePathKey )->delete();
        $this->delete();

        return true;
    }
}
