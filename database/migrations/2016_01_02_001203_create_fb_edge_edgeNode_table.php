<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbEdgeEdgeNodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_fb_edge_edgenode', function (Blueprint $table) {

            $table->string('edge');
            $table->string('edgeNode');
            $table->boolean('isDefault')->default( 0 );
            $table->string('defaultField')->nullable();
            $table->string('relativeRoot')->nullable();

            $table->foreign('edge')
                ->references('endPath')
                ->on('fb_page_edge')
                ->onDelete('cascade');

            $table->foreign('edgeNode')
                ->references('endPath')
                ->on('fb_page_edge_node')
                ->onDelete('cascade');

            $table->foreign('defaultField')
                ->references('query')
                ->on('fb_field')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('_fb_edge_edgenode');
    }
}
