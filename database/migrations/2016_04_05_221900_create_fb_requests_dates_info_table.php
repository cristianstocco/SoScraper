<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbRequestsDatesInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_requests_dates_info', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->integer( 'year' )->unsigned();
            $table->integer( 'month' )->unsigned();
            $table->integer( 'requestsNo' )->unsigned();

            $table->integer( 'api' )->unsigned();

            $table->foreign( 'api' )
                ->on( 'fb_api_info' )
                ->references( 'id_api' )
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
        Schema::drop('fb_requests_dates_info');
    }
}
