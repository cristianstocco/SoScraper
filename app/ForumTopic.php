<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumTopic extends Model
{
    protected $table = 'forum_topic';
    
    protected $fillable = [ 'ID', 'title', 'message', 'author', 'section' ];
    
    public $timestamps = false;
}
