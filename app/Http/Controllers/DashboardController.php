<?php

namespace App\Http\Controllers;

use App\Models\KategoriBahan;
use App\Models\Mitra;
use App\Models\Produk;
use App\Models\StokProduk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $user, $produk, $transaksi, $stokProduk, $mitra;

    public function __construct(User $user, Produk $produk, Transaksi $transaksi, StokProduk $stokProduk, Mitra $mitra)
    {
        $this->user = $user;
        $this->produk = $produk;
        $this->transaksi = $transaksi;
        $this->stokProduk = $stokProduk;
        $this->mitra = $mitra;
    }
    public function super_admin()
    {
        $data = [
            'total_user' => $this->user->where('akses', '2')->count(),
            'total_produk' => $this->produk::count(),
            'total_transaksi' => $this->transaksi::count(),
            'total_mitra' => $this->mitra::count(),
        ];
        return view('super_admin.pages.dashboard.index', $data);
    }

    public function admin()
    {
        return view('admin.pages.dashboard.index');
    }


    public function karyawan()
    {
        return view('karyawan.pages.dashboard.index');
    }
}
