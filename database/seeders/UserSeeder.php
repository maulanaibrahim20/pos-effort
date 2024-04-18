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
            'password' => bcrypt('maulana123'),
            'akses' => 1,
            'status' => 1,
        ]);

        User::create([
            'nama' => 'Ultramen Polindra',
            'email' => 'ultramen@gmail.com',
            'password' => bcrypt('ultramen123'),
            'akses' => 1,
            'status' => 1,
        ]);
    }
}
