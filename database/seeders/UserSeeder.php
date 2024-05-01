<?php

namespace Database\Seeders;

use App\Models\Auth\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Maulana Ibrahim',
            'email' => 'maul@gmail.com',
            'username' => 'maul',
            'password' => bcrypt('maulana123'),
            'akses' => 1,
            'active' => 1,
        ]);

        User::create([
            'nama' => 'Ultramen Polindra',
            'email' => 'ultramen@gmail.com',
            'username' => 'ultramen',
            'password' => bcrypt('ultramen123'),
            'akses' => 2,
            'active' => 1,
        ]);
        User::create([
            'nama' => 'Ultramen Gamaci',
            'email' => 'ultramenG@gmail.com',
            'username' => 'ultramenG',
            'password' => bcrypt('ultramen123'),
            'akses' => 3,
            'active' => 1,
        ]);
    }
}
