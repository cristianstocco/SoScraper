<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FB_requests_dates_info extends Model
{
    protected $table = 'fb_requests_dates_info';

    protected $fillable = ['api', 'year', 'month', 'requestNo'];

    public $timestamps = false;
}
