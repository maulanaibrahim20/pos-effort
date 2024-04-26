<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPage\AppController;
use App\Http\Controllers\Master\KategoriBahanController;
use App\Http\Controllers\Master\BahanController;
use App\Http\Controllers\Master\ProdukController;
use App\Http\Controllers\Master\SatuanBahanController;
use App\Http\Controllers\SemiMaster\GroupingKategoriBahanController;
use App\Http\Controllers\SemiMaster\GroupingSatuanBahanController;
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
            Route::prefix('master')->group(function () {
                Route::resource('kategori_bahan', KategoriBahanController::class);
                Route::get("kategori_bahan/{id}/edit", [KategoriBahanController::class, "edit"]);
                Route::resource('bahan', BahanController::class);
                Route::get('bahan/{id}/edit', [BahanController::class, "edit"]);
                Route::resource('satuan_bahan', SatuanBahanController::class);
                Route::get('satuan_bahan/{id}/edit', [SatuanBahanController::class, 'edit']);
                Route::post('satuan_bahan/changeStatus/{id}', [SatuanBahanController::class, 'changeStatus']);
                Route::resource('produk', ProdukController::class);
                Route::get('produk/{id}/id', [ProdukController::class, 'edit']);
                Route::post('produk/changeStatus/{id}', [ProdukController::class, 'changeStatus']);

                Route::get('member', function () {
                    return view('super_admin.pages.member.index');
                });
                Route::get('supplier', function () {
                    return view('super_admin.pages.supplier.index');
                });
            });
            Route::prefix('semi_master')->group(function () {
                Route::resource('grouping_kategori_bahan', GroupingKategoriBahanController::class);
                Route::resource('grouping_satuan_bahan', GroupingSatuanBahanController::class);
            });
            Route::get('/dashboard', [DashboardController::class, 'super_admin']);
        });
    });

    Route::group(['middleware' => ['can:pelanggan']], function () {
        Route::prefix('pelanggan')->group(function () {
            Route::get('/home', function () {
                return view('welcome');
            });
            Route::get('/dashboard', function () {
                return view('pelanggan.pages.dashboard.index');
            });
        });
    });
});
