<?php

use App\Http\Controllers\Auth\LoginController;
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

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.pages.dashboard.index');
        });
    });
    Route::prefix('member')->group(function () {
        Route::get('/dashboard', function () {
            return view('member.pages.dashboard.index');
        });
    });
});
