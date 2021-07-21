<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_games', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->text('description')->nullable();
            $table->string('image');
            $table->date('realese_date');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('registered_id');
            $table->timestamps();
            
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('registered_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_games');
    }
}
