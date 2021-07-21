<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class VideoGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('video_games')->insert([
            'name' => 'League of Legends. ',
            'description' => 'Pasa de jugador casual a gamer profesional de LOL.',
            'image' => 'https://crehana-public-catalog.imgix.net/images/projects/images/ac60a909/proyecto-coach-league-of-legends.jpeg',
            'realese_date' => '2021-07-20',
            'company_id' => 1,
            'registered_id' => 1 
        ]);

        DB::table('video_games')->insert([
            'name' => 'Clash of Clans',
            'description' => 'Clash of Clans, también conocido como CoC, es un videojuego de estrategia y de construcción de aldeas en línea',
            'image' => 'https://1000logos.net/wp-content/uploads/2021/02/Clash-of-Clans-logo.png',
            'realese_date' => '2021-07-20',
            'company_id' => 2,
            'registered_id' => 1 
        ]);

        $this->createConsole(1,1);
        $this->createConsole(1,2);
        $this->createConsole(1,3);

        //Segundo juego
        $this->createConsole(2,1);
        $this->createConsole(2,2);
        $this->createConsole(2,3);
    }

    public function createConsole($videoID, $consoleId)
    {
        DB::table('video_game_consoles')->insert([
            'video_game_id' => $videoID,
            'console_id' => $consoleId
        ]);
    }
}
