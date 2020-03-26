<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payment', function (Blueprint $table) {
            
            $table->string( 'paymentID' )->primary();
            $table->string( 'user_email' );
            $table->string( 'payerID' );
            $table->string( 'token' );
            $table->timestamp( 'created_at' );
            $table->timestamp( 'finish_at' );
            
            $table->foreign( 'user_email' )
                    ->on( 'users' )
                    ->references( 'email' );
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_payment');
    }
}
