<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoGameConsolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_game_consoles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video_game_id');
            $table->unsignedBigInteger('console_id');
            $table->timestamps();
            
            $table->foreign('video_game_id')->references('id')->on('video_games');
            $table->foreign('console_id')->references('id')->on('consoles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_game_consoles');
    }
}
