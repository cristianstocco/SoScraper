<?php

use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'username' => 'admin',
            'email' => 'cris94and1@gmail.com',
            'password' => bcrypt( 'stykkyapis' ),
            'role' => 'admin',
            'remember_token' => null,
            'created_at' => '2015-12-19 21:55:10',
            'updated_at' => '2015-12-19 21:55:10'
        ]);
        
        App\User::create([
            'username' => 'ìdeo',
            'email' => 'info@ideonetwork.it',
            'password' => bcrypt( 'b1st3cc41' ),
            'role' => 'moderator',
            'remember_token' => null,
            'created_at' => '2015-12-19 21:55:10',
            'updated_at' => '2015-12-19 21:55:10'
        ]);
        
        App\User::create([
            'username' => 'Davide Saggioro',
            'email' => 'saggiorodavide@gmail.com',
            'password' => bcrypt( 'bistecca1' ),
            'remember_token' => null,
            'created_at' => '2016-08-07 17:37:10',
            'created_at' => '2016-08-07 17:37:10'
        ]);
    }
}
