<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbApiGroupFullModeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_api_group_full_mode', function (Blueprint $table) {

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
            $table->string( 'mode' )->default( 'full' );
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

        Schema::create('_fbapigroupfullmode_edgenode', function (Blueprint $table) {

            $table->primary( ['apiGroup', 'edgeNode'] );

            $table->unsignedInteger( 'apiGroup' );
            $table->string( 'edgeNode' );

            $table->foreign( 'apiGroup' )
                ->on( 'fb_api_group_full_mode' )
                ->references( 'id_api_group' );

            $table->foreign( 'edgeNode' )
                ->on( 'fb_page_edge_node' )
                ->references( 'endPath' );

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('_fbapigroupfullmode_edgenode');
        Schema::drop('fb_api_group_full_mode');
    }
}
