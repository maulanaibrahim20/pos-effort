<?php

namespace Database\Seeders\Auth;

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
        User::factory()->create([
            'nama' => 'Maulana Ibrahim',
            'email' => 'maul@gmail.com',
            'password' => bcrypt('maulana123'),
            'akses' => 1,
            'status' => 1,
        ]);

        User::factory()->create([
            'nama' => 'Ultramen Polindra',
            'email' => 'ultramen@gmail.com',
            'password' => bcrypt('ultramen123'),
            'akses' => 1,
            'status' => 1,
        ]);
    }
}
