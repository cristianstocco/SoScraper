<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FB_api_group_partial_mode extends Model
{
    protected $table = 'fb_api_group_partial_mode';

    protected $primaryKey = 'id_api_group';

    protected $fillable = ['user', 'whiteListDomain', 'whiteListStagingIP', 'name', 'pageEdge', 'basePathKey', 'paymentID', 'missingDaysToWhiteList', 'source'];

    public function deleteCollection() {
        $apiGroupID = $this->id_api_group;

        FB_api_partial_mode::where( 'groupApi', $apiGroupID )->delete();
        $this->delete();

        return true;
    }
    
}
