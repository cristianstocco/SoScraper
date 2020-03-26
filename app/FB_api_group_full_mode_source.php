<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FB_api_group_full_mode_source extends Model
{
    protected $table = 'fb_api_group_full_mode_source';

    protected $fillable = [ 'source', 'info', 'apiGroup' ];

    public $timestamps = true;
}
