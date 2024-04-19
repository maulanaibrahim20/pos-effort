<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
            "kategori" => "Makanan",
            "nama" => "Rendang Mahal",
            "status" => 1,
            "hargaProduk" => 10000
        ]);

        Produk::create([
            "kategori" => "Minuman",
            "nama" => "Red Velvet",
            "status" => 1,
            "hargaProduk" => 30000
        ]);
    }
}
