<?php

namespace Database\Seeders;

use App\Models\Bahan;
use App\Models\GroupingKategoriBahan;
use App\Models\KategoriBahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupingKategoriBahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriBahan1 = KategoriBahan::first();
        $bahan1 = Bahan::first();

        $kategoriBahanLatest = KategoriBahan::orderBy("namaKategori", "DESC")->first();
        $bahanLatest = Bahan::orderBy("namaBahan", "DESC")->first();

        GroupingKategoriBahan::create([
            "kategoriBahanId" => $kategoriBahan1->id,
            "bahanId" => $bahan1->id
        ]);

        GroupingKategoriBahan::create([
            "kategoriBahanId" => $kategoriBahanLatest->id,
            "bahanId" => $bahanLatest->id
        ]);
    }
}
