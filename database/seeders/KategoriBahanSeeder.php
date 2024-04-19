<?php

namespace Database\Seeders;

use App\Models\KategoriBahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriBahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriBahan::create([
            "namaKategori" => "Bumbu Dapur"
        ]);

        KategoriBahan::create([
            "namaKategori" => "Minuman Dingin"
        ]);

        KategoriBahan::create([
            "namaKategori" => "Makanan Penutup"
        ]);
    }
}
