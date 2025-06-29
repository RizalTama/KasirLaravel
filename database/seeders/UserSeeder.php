<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'Username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        for ($i = 1; $i <= 4; $i++) {
            User::create([
                'Username' => 'kasir' . $i,
                'email' => 'kasir' . $i . '@example.com',
                'password' => bcrypt('password'),
                'role' => 'kasir',
            ]);
        }
    }
}
