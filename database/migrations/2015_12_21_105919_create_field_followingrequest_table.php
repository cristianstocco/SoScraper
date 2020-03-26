<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldFollowingrequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_fb_field_followingrequest', function (Blueprint $table) {

            $table->string('parentField')->primary();
            $table->string('field');

            $table->foreign('parentField')
                ->references('query')
                ->on('fb_field')
                ->onDelete('cascade');

            $table->foreign('field')
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
        Schema::drop('_fb_field_followingrequest');
    }
}
