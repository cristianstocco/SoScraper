<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbApiGroupFullModeSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_api_group_full_mode_source', function (Blueprint $table) {
            $table->string( 'source' );
            $table->unsignedInteger( 'apiGroup' );
            $table->longText( 'info' );
            $table->timestamps();

            $table->primary( ['source', 'apiGroup'] );
            $table->foreign( 'apiGroup' )
                ->on( 'fb_api_group_full_mode' )
                ->references( 'id_api_group' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fb_api_group_full_mode_source');
    }
}
