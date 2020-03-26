<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_topic', function (Blueprint $table) {
            $table->string( 'ID', 8 )->primary();
            $table->string( 'title' );
            $table->string( 'message' );
            $table->string( 'author' );
            $table->string( 'section' );
            $table->timestamp( 'created_at' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forum_topic');
    }
}
