<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Partida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('partida');

        Schema::create('partida', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user1')->default()->unique();
            $table->integer('user2')->default()->unique();

            $table->tinyInteger('blancas')->default(0);
            $table->tinyInteger('negras')->default(0);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
