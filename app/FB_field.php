<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FB_field extends Model
{
    protected $table = 'fb_field';

    protected $primaryKey = 'query';

    public $timestamps = false;
}
