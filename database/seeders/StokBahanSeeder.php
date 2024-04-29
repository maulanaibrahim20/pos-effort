<?php

namespace Database\Seeders;

use App\Models\Bahan;
use App\Models\StokBahan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class StokBahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where("email", "ultramen@gmail.com")->first();

        $bahan = Bahan::first();

        $bahan2 = Bahan::where("namaBahan", "Timun")->first();

        $bahan3 = Bahan::where("namaBahan", "Cabe")->first();

        StokBahan::create([
            "userId" => $user["id"],
            "bahanId" => $bahan["id"],
            "tanggalTransaksi" => date("Y-m-d H:i:s"),
            "qty" => 5,
            "hargaStokBahan" => 10000,
            "status" => 1
        ]);

        StokBahan::create([
            "userId" => $user["id"],
            "bahanId" => $bahan2["id"],
            "tanggalTransaksi" => date("Y-m-d H:i:s"),
            "qty" => 10,
            "hargaStokBahan" => 20000,
            "status" => 1
        ]);

        StokBahan::create([
            "userId" => $user["id"],
            "bahanId" => $bahan3["id"],
            "tanggalTransaksi" => date("Y-m-d H:i:s"),
            "qty" => 15,
            "hargaStokBahan" => 25000,
            "status" => 1
        ]);
    }
}
