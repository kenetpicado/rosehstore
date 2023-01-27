<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'Josiel Alonso',
            'email' => 'josielalonso@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'Rosa Guevara',
            'email' => 'rosaelenaguevaramolieri@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
