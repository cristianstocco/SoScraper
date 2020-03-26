<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Returns if the logged user is a member.
     *
     * @var boolean
     */
    public static function isMember() {
        if( !Auth::check() )
            return false;

        return Auth::user()[ 'role' ] == 'member';
    }

    /**
     * Returns if the logged user is a admin.
     *
     * @var boolean
     */
    public static function isAdmin() {
        if( !Auth::check() )
            return false;

        return Auth::user()[ 'role' ] == 'admin';
    }

    /**
     * Returns if the logged user is a moderator.
     *
     * @var boolean
     */
    public static function isModerator() {
        if( !Auth::check() )
            return false;

        return Auth::user()[ 'role' ] == 'moderator';
    }
}
