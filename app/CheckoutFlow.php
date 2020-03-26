<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckoutFlow extends Model
{
    protected $table = 'checkout_flow';

    protected $fillable = ['step', 'path'];

    public $timestamps = false;
}
