<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVideoGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_video_games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('video_game_id');
            $table->enum('add_type', ['Lo tengo', 'Lo quiero'])->nullable()->default('Lo tengo');
            $table->boolean('favorite')->nullable()->default(false);
            $table->timestamps();

            
            $table->foreign('user_id')->references('id')->on('users');//->onDelete('cascade');
            $table->foreign('video_game_id')->references('id')->on('video_games');//->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_video_games');
    }
}
