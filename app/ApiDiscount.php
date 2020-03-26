<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiDiscount extends Model
{
    protected $table = 'api_discount';
    
    protected $fillable = [ 'monthNo', 'discount%' ];

    public $timestamps = false;
}
