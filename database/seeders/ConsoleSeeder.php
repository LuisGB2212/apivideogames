<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ConsoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('consoles')->insert([
            'name' => 'Xbox 360',
            'year' => '2015',
            'registered_id' => 1,
        ]);

        DB::table('consoles')->insert([
            'name' => 'PlayStation 4',
            'year' => '2012',
            'registered_id' => 1,
        ]);

        DB::table('consoles')->insert([
            'name' => 'Xbox Series X',
            'year' => '2020',
            'registered_id' => 1,
        ]);
    }
}
