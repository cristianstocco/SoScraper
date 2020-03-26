<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbpartialmodePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_fbapigrouppartialmode_payment', function (Blueprint $table) {
            $table->string( 'endPoint' );
            $table->string( 'paymentID' );
            
            $table->primary( ['endPoint', 'paymentID'] );
            
            $table->foreign( 'endPoint' )
                    ->on( 'fb_api_group_partial_mode' )
                    ->references( 'basePathKey' );
            $table->foreign( 'paymentID' )
                    ->on( 'user_payment' )
                    ->references( 'paymentID' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('_fbapigrouppartialmode_payment');
    }
}
