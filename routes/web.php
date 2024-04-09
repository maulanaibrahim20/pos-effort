<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Master\KategoriController;
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



Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login.index');
    });

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
    Route::group(['middleware' => ['can:admin']], function () {
        Route::prefix('admin')->group(function () {
            Route::prefix('master')->group(function () {
                Route::resource('kategori', KategoriController::class);
                Route::get('produk', function () {
                    return view('admin.pages.master.produk.index');
                });
                Route::get('member', function () {
                    return view('admin.pages.member.index');
                });
                Route::get('supplier', function () {
                    return view('admin.pages.supplier.index');
                });
            });
            Route::get('/dashboard', function () {
                return view('admin.pages.dashboard.index');
            });
        });
    });

    Route::group(['middleware' => ['can:member']], function () {
        Route::prefix('member')->group(function () {
            Route::get('/home', function () {
                return view('welcome');
            });
            Route::get('/dashboard', function () {
                return view('member.pages.dashboard.index');
            });
        });
    });
});
