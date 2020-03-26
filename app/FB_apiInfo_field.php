<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FB_apiInfo_field extends Model
{
    protected $table = '_fbapiinfo_field';

    protected $fillable = ['basePathKey', 'query'];

    public $timestamps = false;
}
