<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_comment', function (Blueprint $table) {
            $table->string( 'topicID', 8 );
            $table->string( 'message' );
            $table->string( 'author' );
            $table->timestamp( 'created_at' );
            
            $table->primary( ['topicID', 'created_at'] );
            $table->foreign( 'topicID' )
                    ->on( 'forum_topic' )
                    ->references( 'ID' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forum_comment');
    }
}
