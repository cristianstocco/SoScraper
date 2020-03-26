<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FB_page_edge_node extends Model
{
    protected $table = 'fb_page_edge_node';

    protected $primaryKey = 'endPath';

    public $timestamps = false;
}
