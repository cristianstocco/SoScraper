<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbPageEdgeNodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_page_edge_node', function (Blueprint $table) {
            $table->string('endPath')->primary();
            $table->string('title');
            $table->string('description');
            $table->boolean('isRecursive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fb_page_edge_node');
    }
}
