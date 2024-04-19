<?php

namespace Database\Seeders;

use App\Models\GroupingSatuanBahan;
use App\Models\Produk;
use App\Models\ProdukDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groupingSatuanBahan1 = GroupingSatuanBahan::first();
        $produk1 = Produk::first();

        $groupingSatuanBahan2 = GroupingSatuanBahan::orderBy("id", "DESC")->first();
        $produk2 = Produk::orderBy("nama", "DESC")->first();

        ProdukDetail::create([
            "groupingSatuanBahanId" => $groupingSatuanBahan1->id,
            "produkId" => $produk1->id
        ]);

        ProdukDetail::create([
            "groupingSatuanBahanId" => $groupingSatuanBahan2->id,
            "produkId" => $produk2->id
        ]);
    }
}
