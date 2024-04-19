<?php

namespace Database\Seeders;

use App\Models\Bahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bahan::create([
            "namaBahan" => "Tomat",
            "slugBahan" => "tomat"
        ]);

        Bahan::create([
            "namaBahan" => "Timun",
            "slugBahan" => "timun"
        ]);

        Bahan::create([
            "namaBahan" => "Cabe",
            "slugBahan" => "cabe"
        ]);

        Bahan::create([
            "namaBahan" => "Kol",
            "slugBahan" => "kol"
        ]);

        Bahan::create([
            "namaBahan" => "Brokoli",
            "slugBahan" => "brokoli"
        ]);
    }
}
