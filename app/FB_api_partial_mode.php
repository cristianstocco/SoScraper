<?php

namespace App;

use Facebook\Facebook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class FB_api_partial_mode extends Model
{
    protected $table = 'fb_api_partial_mode';

    protected $primaryKey = 'id_api';

    protected $fillable = ['base', 'endPath', 'childNo', 'response', 'groupApi'];

    public $timestamps = false;

    public static function createCollection( $apisEdges, $apiGroup )
    {

        $basePathKey = $apiGroup[ 'basePathKey' ];

        //  Looping for edges
        foreach( $apisEdges[ 'media' ] as $apiEdge ) {

            //  Looping for selectors
            foreach( $apisEdges[ 'mediaSelector' ] as $apiSelector ) {
                FB_api_partial_mode::create(
                    [
                        'base' => $apiEdge[ 'endPath' ],
                        'endPath' => $apiSelector[ 'endPath' ],
                        'groupApi' => $apiGroup->id_api_group
                    ]
                );
            }
        }

        Artisan::call( 'fbapi:partial', [
            'basePathKey' => $basePathKey
        ]);

        return session( 'apiFetcher.element.isFetched' );

    }
}