<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamePlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_player', function (Blueprint $table) {
            $table->primary(['game_id','player_id']);
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('player_id');
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games')->
            onDelete('cascade')->onUpdate('cascade');

            $table->foreign('player_id')->references('id')->on('players')->
            onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_player');
    }
}
