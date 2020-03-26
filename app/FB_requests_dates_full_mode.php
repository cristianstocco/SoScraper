<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FB_requests_dates_full_mode extends Model
{
    protected $table = 'fb_requests_dates_full_mode';

    protected $fillable = ['year', 'month', 'requestsNo', 'groupApi'];

    public $timestamps = false;
}
