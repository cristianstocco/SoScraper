<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    protected $table = 'user_payment';
    
    protected $fillable = [ 'paymentID', 'user_email', 'payerID', 'token', 'created_at', 'finish_at' ];
    
    public $timestamps = false;
}