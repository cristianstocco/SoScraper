<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbRequestsDatesPartialModeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_requests_dates_partial_mode', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->integer( 'year' )->unsigned();
            $table->integer( 'month' )->unsigned();
            $table->integer( 'requestsNo' )->unsigned();

            $table->integer( 'groupApi' )->unsigned();

            $table->foreign( 'groupApi' )
                ->on( 'fb_api_group_partial_mode' )
                ->references( 'id_api_group' )
                ->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fb_requests_dates_partial_mode');
    }
}
