<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->client('Luis eduardo gonzalez balam', 'admin@admin.com', 'admin');
        $this->client('Jose', 'jose@email.com');
        $this->client('Manuel', 'manuel@email.com');
        $this->client('Areli', 'areli@email.com');
        $this->client('Sandra', 'sandra@email.com');
    }

    public function client($name, $email, $type = 'user')
    {
        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'type_user' => $type,
            'password' => Hash::make('123456789'),
            'rol_id' => null,
        ]);
    }
}
