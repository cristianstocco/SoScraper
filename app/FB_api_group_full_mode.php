<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class FB_api_group_full_mode extends Model
{
    protected $table = 'fb_api_group_full_mode';

    protected $primaryKey = 'id_api_group';

    protected $fillable = ['user', 'whiteListDomain', 'whiteListStagingIP', 'pageEdge', 'name', 'basePathKey', 'paymentID', 'missingDaysToWhiteList', 'source', 'updated_at'];

    public static function linkEdges( $mediaSelectors, $apiGroup )
    {
        foreach( $mediaSelectors as $mediaSelector ) {
            FB_apiGroupFullMode_edgeNode::create([
                'apiGroup' => $apiGroup->id_api_group,
                'edgeNode' => $mediaSelector[ 'endPath' ]
            ]);
        }
    }

    public function deleteCollection()
    {
        $apiGroupID = $this->id_api_group;

        FB_apiGroupFullMode_edgeNode::where( 'apiGroup', $apiGroupID )->delete();
        FB_api_group_full_mode_source::where( 'apiGroup', $apiGroupID )->delete();
        FB_api_full_mode::where( 'groupApi', $apiGroupID )->delete();
        $this->delete();

        return true;
    }
}
