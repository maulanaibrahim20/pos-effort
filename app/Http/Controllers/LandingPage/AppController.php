<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\KeranjangDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    protected $keranjang, $keranjangDetail, $produk;

    public function __construct()
    {
        $this->keranjang = new Keranjang();
        $this->keranjangDetail = new KeranjangDetail();
        $this->produk = new Produk();
    }

    public function home()
    {
        $data = [
            "produk" => $this->produk->where("status", 1)->get(),
        ];

        if (!empty(Auth::user())) {
            $data["keranjang"] = $this->keranjang->where("userId", Auth::user()->id)->first();
            $data["keranjangDetail"] = $this->keranjangDetail->where("keranjangId", $data["keranjang"]["id"])
                ->get();
        }

        return view("landing-page.home", $data);
    }

    public function landingPage()
    {
        return view("landing-page.main");
    }

    public function keranjang($idProduk)
    {
        try {
            DB::beginTransaction();

            $cart = $this->keranjang->create([
                "userId" => Auth::user()->id,
                "tanggal" => date("Y-m-d"),
                "totalHarga" => 1000,
                "status" => 1
            ]);

            $produk = $this->produk->where("id", $idProduk)->first();

            $detailCart = $this->keranjangDetail->create([
                "keranjangId" => $cart["id"],
                "produkId" => $idProduk,
                "qty" => 1,
                "harga" => $produk["hargaProduk"]
            ]);

            DB::commit();

            return redirect()->to("/");

        } catch (\Exception $e) {
            DB::rollback();

            die($e->getMessage());
        }
    }
}
