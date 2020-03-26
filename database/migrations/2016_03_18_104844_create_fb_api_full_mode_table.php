<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbApiFullModeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_api_full_mode', function (Blueprint $table) {

            $table->increments( 'id_api' );
            $table->string( 'base' );
            $table->string( 'endPath' );
            $table->longText( 'response' );
            $table->longText( 'info' );
            $table->unsignedInteger( 'groupApi' );
            $table->date( 'created_at' );

            $table->foreign( 'groupApi' )
                ->on( 'fb_api_group_full_mode' )
                ->references( 'id_api_group' );

        });

        Schema::create('_fb_apis_full_mode_fields', function (Blueprint $table) {

            $table->primary( ['api', 'field'] );

            $table->unsignedInteger( 'api' );
            $table->string( 'field' );

            $table->foreign( 'api' )
                ->on( 'fb_api_full_mode' )
                ->references( 'id_api' )
                ->onDelete( 'cascade' );

            $table->foreign( 'field' )
                ->on( 'fb_field' )
                ->references( 'query' )
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
        Schema::drop('_fb_apis_full_mode_fields');
        Schema::drop('fb_api_full_mode');
    }
}
