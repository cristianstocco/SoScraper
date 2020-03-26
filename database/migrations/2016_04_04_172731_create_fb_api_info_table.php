<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateFbApiInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_api_info', function (Blueprint $table) {
            $table->increments('id_api');
            $table->unsignedInteger( 'user' );
            $table->string( 'source' );
            $table->string( 'name' );
            $table->string( 'whiteListDomain' );
            $table->string( 'whiteListStagingIP' );
            $table->string( 'basePathKey', 32 )->unique();
            $table->string( 'paymentID' );
            $table->unsignedInteger( 'totalUpdates' )->default( 0 );
            $table->unsignedInteger( 'missingDaysToWhiteList' )->nullable();
            $table->string( 'mode' )->default( 'info' );
            $table->longText( 'response' );
            $table->timestamps();

            $table->foreign( 'user' )
                ->on( 'users' )
                ->references( 'id' );

            $table->foreign( 'paymentID' )
                ->on( 'user_payment' )
                ->references( 'paymentID' );
            
        });

        Schema::create('_fbapiinfo_field', function (Blueprint $table) {
            $table->primary( ['basePathKey', 'query'] );

            $table->string( 'basePathKey', 32 );
            $table->string( 'query' );

            $table->foreign( 'basePathKey' )
                ->on( 'fb_api_info' )
                ->references( 'basePathKey' );
            $table->foreign( 'query' )
                ->on( 'fb_field' )
                ->references( 'query' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('_fbapiinfo_field');
        Schema::drop('fb_api_info');
    }
}
