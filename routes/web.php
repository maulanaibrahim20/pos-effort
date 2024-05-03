<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\LandingPage\AppController;
use App\Http\Controllers\Master\AkunKaryawanController;
use App\Http\Controllers\Master\KategoriBahanController;
use App\Http\Controllers\Master\BahanController;
use App\Http\Controllers\Master\ProdukController;
use App\Http\Controllers\Master\SatuanBahanController;
use App\Http\Controllers\SemiMaster\GroupingKategoriBahanController;
use App\Http\Controllers\SemiMaster\GroupingSatuanBahanController;
use App\Http\Controllers\Transaksi\StokProdukController;
use App\Http\Controllers\Transaksi\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// LandingPage
Route::get("/", [AppController::class, "home"]);
Route::get("/landingPage", [AppController::class, "landingPage"]);
Route::get("/keranjang/{id_produk}", [AppController::class, "keranjang"]);
Route::get("/keranjang/{id_produk}/detail", [AppController::class, "detailProduk"]);
Route::post("/keranjang/{id_produk}/detailQty", [AppController::class, "detailQty"]);
Route::put("/keranjang/{idKeranjangDetail}/update-qty", [AppController::class, "updateQty"]);
Route::post("/checkout", [AppController::class, "checkout"]);

Route::get("/transaksi/{no_invoice}", [AppController::class, "invoice"]);

Route::get("/riwayat-transaksi", [AppController::class, "riwayatTransaksi"]);

Route::get("/pembayaran-cash/{id}", [AppController::class, "pembayaranCash"]);
Route::put("/pembayaran-cash/{id}", [AppController::class, "updateCashAmount"]);

Route::middleware(['guest'])->group(function () {

    Route::prefix('login')->name('login.')->group(function () {
        Route::get('/', [LoginController::class, 'index'])
            ->name('index');
        Route::post('/proccess', [LoginController::class, 'proccess'])
            ->name('proccess');
    });
});

Route::middleware(['auth'])->name('web.')->group(function () {
    Route::get('/logout', LogoutController::class)
        ->name('auth.logout');
});

Route::middleware(['autentikasi'])->group(function () {
    Route::group(['middleware' => ['can:super_admin']], function () {
        Route::prefix('super_admin')->group(function () {
            Route::prefix('profil')->group(function () {
                Route::get('user', [EditProfileController::class, 'index']);
                Route::put('user/{id}', [EditProfileController::class, 'update']);
                Route::put('user/update_password/{id}', [EditProfileController::class, 'UpdatePassword']);
            });
            Route::prefix('master')->group(function () {

                Route::get('member', function () {
                    return view('super_admin.pages.member.index');
                });
                Route::get('supplier', function () {
                    return view('super_admin.pages.supplier.index');
                });
            });
            Route::prefix('semi_master')->group(function () {
            });
            Route::get('/transaksi', [TransaksiController::class, 'index']);
            Route::post('transaksi/filterByStatus', [TransaksiController::class, 'filterByStatus']);
            Route::get('/dashboard', [DashboardController::class, 'super_admin']);
        });
    });

    Route::group(['middleware' => ['can:admin']], function () {
        Route::prefix('admin')->group(function () {
            Route::prefix('master')->group(function () {
                Route::resource('produk', ProdukController::class);
                Route::post('produk/changeStatus/{id}', [ProdukController::class, 'changeStatus']);
                Route::get('produk/{id}/edit', [ProdukController::class, 'edit']);
                Route::resource('karyawan', AkunKaryawanController::class);
                Route::get('karyawan/{id}/edit', [AkunKaryawanController::class, 'edit']);
            });
            Route::prefix('transaksi')->group(function () {
                Route::get('stok_produk', [StokProdukController::class, 'index']);
                Route::post('tambah_qty', [StokProdukController::class, 'tambahQty']);
                Route::post('changeStatus/{id}', [StokProdukController::class, 'changeStatus']);
            });
            Route::get('/dashboard', [DashboardController::class, 'admin']);
        });
    });
    Route::group(['middleware' => ['can:karyawan']], function () {
        Route::prefix('karyawan')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'karyawan']);
        });
    });
});
