<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'Riot Games',
            'registered_id' => 1,
        ]);

        DB::table('companies')->insert([
            'name' => 'Supercell',
            'registered_id' => 1,
        ]);
    }
}
