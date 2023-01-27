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
        $root = User::create([
                'name' => "Kenet Picado",
                'email' => "kenetpicado1@gmail.com",
                'password' => bcrypt('12345678'),
        ]);

        $root->assignRole('root');

        $users = [
            [
                'name' => 'Josiel Alonso',
                'email' => 'josielalonso@gmail.com',
            ],
            [
                'name' => 'Rosa Guevara',
                'email' => 'rosaelenaguevaramolieri@gmail.com',
            ],
        ];

        foreach ($users as $user) {
            $admin = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt('12345678'),
            ]);

            $admin->assignRole('administrador');
        }
    }
}
