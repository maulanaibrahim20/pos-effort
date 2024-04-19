<?php

namespace Database\Seeders;

use App\Models\Bahan;
use App\Models\GroupingSatuanBahan;
use App\Models\SatuanBahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupingSatuanBahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $satuanBahan1 = SatuanBahan::first();
        $bahan1 = Bahan::first();

        $satuanBahan2 = SatuanBahan::orderBy("satuanBahan", "DESC")->first();
        $bahan2 = Bahan::orderBy("namaBahan", "DESC")->first();

        GroupingSatuanBahan::create([
            "satuanBahanId" => $satuanBahan1->id,
            "bahanId" => $bahan1->id
        ]);

        GroupingSatuanBahan::create([
            "satuanBahanId" => $satuanBahan2->id,
            "bahanId" => $bahan2->id
        ]);
    }
}
