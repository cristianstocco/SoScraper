<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbApiGroupPartialModeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_api_group_partial_mode', function (Blueprint $table) {

            $table->increments( 'id_api_group' );
            $table->unsignedInteger( 'user' );
            $table->string( 'whiteListDomain' );
            $table->string( 'whiteListStagingIP' );
            $table->string( 'pageEdge' );
            $table->string( 'name' );
            $table->string( 'basePathKey', 32 )->unique();
            $table->string( 'paymentID' );
            $table->unsignedInteger( 'missingDaysToWhiteList' )->nullable();
            $table->unsignedInteger( 'totalUpdates' )->default( 0 );
            $table->string( 'source' );
            $table->longText( 'info' );
            $table->string( 'mode' )->default( 'partial' );
            $table->timestamps();

            $table->foreign( 'pageEdge' )
                ->on( 'fb_page_edge' )
                ->references( 'endPath' );

            $table->foreign( 'user' )
                ->on( 'users' )
                ->references( 'id' );

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
        Schema::drop('fb_api_group_partial_mode');
    }
}
