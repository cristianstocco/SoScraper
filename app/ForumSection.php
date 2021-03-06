<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumSection extends Model
{
    protected $table = 'forum_section';
    
    protected $fillable = ['name', 'description', 'routeName'];
    
    public $timestamps = false;
}
