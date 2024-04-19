<?php

namespace Database\Seeders;

use App\Models\SatuanBahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanBahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SatuanBahan::create([
            "satuanBahan" => "KG",
            "aktif" => 1
        ]);

        SatuanBahan::create([
            "satuanBahan" => "PCS",
            "aktif" => 1
        ]);

        SatuanBahan::create([
            "satuanBahan" => "GRAM",
            "aktif" => 1
        ]);
    }
}
