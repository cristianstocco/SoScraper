<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{
    protected $table = 'forum_comment';
    
    protected $fillable = [ 'topicID', 'message', 'author' ];
    
    public $timestamps = false;
}
