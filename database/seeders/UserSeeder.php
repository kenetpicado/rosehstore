<?php

namespace Database\Seeders;

use App\Models\User;
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
        $root = User::create([
            'name' => 'Kenet Picado',
            'email' => 'kenetpicado1@gmail.com',
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
