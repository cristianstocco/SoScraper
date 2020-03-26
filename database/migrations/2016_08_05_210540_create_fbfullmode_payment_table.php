<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbfullmodePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_fbapigroupfullmode_payment', function (Blueprint $table) {
            $table->string( 'endPoint' );
            $table->string( 'paymentID' );
            
            $table->primary( ['endPoint', 'paymentID'] );
            
            $table->foreign( 'endPoint' )
                    ->on( 'fb_api_group_full_mode' )
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
        Schema::drop('_fbapigroupfullmode_payment');
    }
}
