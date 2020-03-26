<?php

namespace App;

use Facebook\Facebook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class FB_api_full_mode extends Model
{
    protected $table = 'fb_api_full_mode';

    protected $primaryKey = 'id_api';

    protected $fillable = ['base', 'endPath', 'childNo', 'response', 'groupApi', 'created_at'];

    public $timestamps = false;
}