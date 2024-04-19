<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

<<<<<<< HEAD
use Database\Seeders\UserSeeder;
=======
>>>>>>> c37dc75b4a8302b44407ec9448f2a3289f864ee2
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BahanSeeder::class,
            KategoriBahanSeeder::class,
            SatuanBahanSeeder::class,
            GroupingKategoriBahanSeeder::class,
            GroupingSatuanBahanSeeder::class,
            ProdukSeeder::class,
            ProdukDetailSeeder::class
        ]);
    }
}
