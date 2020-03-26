<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_field', function (Blueprint $table) {

            $table->string('query')->primary();
            $table->string('description');
            $table->boolean('isFollowingRequest');
            $table->boolean('isPageField');
            $table->boolean('isBasic');

        });

        Schema::create('_fb_parent_field', function (Blueprint $table) {

            $table->string('edge')->nullable();
            $table->foreign('edge')
                ->references('endPath')
                ->on('fb_page_edge')
                ->onDelete('cascade');

            $table->string('edgeNode')->nullable();
            $table->foreign('edgeNode')
                ->references('endPath')
                ->on('fb_page_edge_node')
                ->onDelete('cascade');

            $table->string('field');
            $table->foreign('field')
                ->references('query')
                ->on('fb_field')
                ->onDelete('cascade');

            $table->boolean('isDefault')->default( 0 );
            $table->string('defaultRoot');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('_fb_parent_field');
        Schema::drop('fb_field');
    }
}
