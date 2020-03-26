<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateApiResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_resource', function (Blueprint $table) {
            $table->string( 'basePathKey', 32 )->primary();
            $table->unsignedTinyInteger( 'type' );
            $table->string( 'provider' );
            $table->timestamps();

            $table->foreign( 'provider' )
                ->on( 'providers' )
                ->references( 'name' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('api_resource');
    }
}
