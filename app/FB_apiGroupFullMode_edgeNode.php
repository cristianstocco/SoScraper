<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FB_apiGroupFullMode_edgeNode extends Model
{
    protected $table = '_fbapigroupfullmode_edgenode';

    protected $fillable = ['apiGroup', 'edgeNode'];

    public $timestamps = false;
}
