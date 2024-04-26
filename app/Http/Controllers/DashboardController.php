<?php

namespace App\Http\Controllers;

use App\Models\KategoriBahan;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $user, $produk, $kategori, $transaksi;

    public function __construct(User $user, Produk $produk, KategoriBahan $kategori, Transaksi $transaksi)
    {
        $this->user = $user;
        $this->produk = $produk;
        $this->kategori = $kategori;
        $this->transaksi = $transaksi;
    }
    public function super_admin()
    {
        $data = [
            'total_user' => $this->user->where('akses', '!=', 1)->count(),
            'total_produk' => $this->produk::count(),
            'total_kategori' => $this->kategori::count(),
            'total_transaksi' => $this->transaksi::count(),
        ];
        return view('super_admin.pages.dashboard.index', $data);
    }
}
