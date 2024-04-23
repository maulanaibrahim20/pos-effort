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

            if (!empty($data["keranjang"])) {
                $data["keranjangDetail"] = $this->keranjangDetail->where("keranjangId", $data["keranjang"]["id"])
                    ->get();
            }
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

            $countKeranjang = $this->keranjang->where("userId", Auth::user()->id)
                ->where("status", 1)
                ->count();

            $produk = $this->produk->where("id", $idProduk)->first();

            if ($countKeranjang == 0) {
                $cart = $this->keranjang->create([
                    "userId" => Auth::user()->id,
                    "tanggal" => date("Y-m-d"),
                    "totalHarga" => 0,
                    "status" => 1
                ]);

                $detailCart = $this->keranjangDetail->create([
                    "keranjangId" => $cart["id"],
                    "produkId" => $idProduk,
                    "qty" => 1,
                    "harga" => $produk["hargaProduk"]
                ]);

                $cart->update([
                    "totalHarga" => $produk["hargaProduk"]
                ]);
            } else {

                $keranjangBelanja = $this->keranjang->where("userId", Auth::user()->id)
                    ->where("status", 1)
                    ->first();

                $keranjangDetail = $this->keranjangDetail->where("keranjangId", $keranjangBelanja["id"])
                    ->where("produkId", $produk["id"])
                    ->first();

                if ($keranjangDetail) {
                    $keranjangDetail->update([
                        "qty" => $keranjangDetail['qty'] + 1,
                        "harga" => $keranjangDetail['harga'] + $produk["hargaProduk"]
                    ]);

                    $keranjangBelanja->update([
                        "totalHarga" => $keranjangBelanja["totalHarga"] + $produk["hargaProduk"]
                    ]);
                } else {
                    $this->keranjangDetail->create([
                        "keranjangId" => $keranjangBelanja["id"],
                        "produkId" => $produk["id"],
                        "qty" => 1,
                        "harga" => $produk["hargaProduk"]
                    ]);

                    $keranjangBelanja->update([
                        "totalHarga" => $keranjangBelanja["totalHarga"] + $produk["hargaProduk"]
                    ]);
                }
            }

            DB::commit();

            return redirect()->to("/");

        } catch (\Exception $e) {
            DB::rollback();

            die($e->getMessage());
        }
    }

    public function detailProduk($idProduk)
    {
        try {
            DB::beginTransaction();

            $data = [
                "produk" => $this->produk->where("id", $idProduk)->first()
            ];

            DB::commit();

            return view("landing-page.detail", $data);


        } catch (\Exception $e) {
            DB::rollBack();

            die($e->getMessage());
        }
    }

    public function detailQty(Request $request, $idProduk)
    {
        try {

            DB::beginTransaction();

            $countKeranjang = $this->keranjang->where("userId", Auth::user()->id)
                ->where("status", 1)
                ->count();

            $produk = $this->produk->where("id", $idProduk)->first();

            if ($countKeranjang == 0) {
                $cart = $this->keranjang->create([
                    "userId" => Auth::user()->id,
                    "tanggal" => date("Y-m-d"),
                    "totalHarga" => 0,
                    "status" => 1
                ]);

                $detailCart = $this->keranjangDetail->create([
                    "keranjangId" => $cart["id"],
                    "produkId" => $idProduk,
                    "qty" => $request["qty-produk"],
                    "harga" => $produk["hargaProduk"]
                ]);

                $cart->update([
                    "totalHarga" => $produk["hargaProduk"] * $request["qty-produk"]
                ]);
            } else {

                $keranjangBelanja = $this->keranjang->where("userId", Auth::user()->id)
                    ->where("status", 1)
                    ->first();

                $keranjangDetail = $this->keranjangDetail->where("keranjangId", $keranjangBelanja["id"])
                    ->where("produkId", $produk["id"])
                    ->first();

                if ($keranjangDetail) {
                    $keranjangDetail->update([
                        "qty" => $keranjangDetail['qty'] + $request["qty-produk"],
                        "harga" => $keranjangDetail['harga'] + ($produk["hargaProduk"] * $request["qty-produk"])
                    ]);

                    $keranjangBelanja->update([
                        "totalHarga" => $keranjangBelanja["totalHarga"] + ($produk["hargaProduk"] * $request["qty-produk"] )
                    ]);
                } else {
                    $this->keranjangDetail->create([
                        "keranjangId" => $keranjangBelanja["id"],
                        "produkId" => $produk["id"],
                        "qty" => $request["qty-produk"],
                        "harga" => $produk["hargaProduk"]
                    ]);

                    $keranjangBelanja->update([
                        "totalHarga" => $keranjangBelanja["totalHarga"] + ($produk["hargaProduk"] * $request["qty-produk"])
                    ]);
                }
            }

            DB::commit();

            return redirect()->to("/");

        } catch (\Exception $e) {
            DB::rollBack();

            die($e->getMessage());
        }
    }
}
