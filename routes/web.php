<?php

use App\Http\Controllers\CekRoleController;
use App\Http\Controllers\Peminjam\BukuController as PeminjamBukuController;
use App\Http\Controllers\Peminjam\KeranjangController;
use App\Http\Controllers\Petugas\BukuController;
use App\Http\Controllers\Petugas\KategoriController;
use App\Http\Controllers\Petugas\PenerbitController;
use App\Http\Controllers\Petugas\RakController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', PeminjamBukuController::class);

Auth::routes();

Route::get('/cek-role', CekRoleController::class)->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::middleware(['auth', 'role:admin|petugas'])->group(function () {
    Route::get('/dashboard', function () {
        return view('petugas/dashboard');
    });

    Route::get('/kategori', KategoriController::class);
    Route::get('/rak', RakController::class);
    Route::get('/penerbit', PenerbitController::class);
    Route::get('/buku', BukuController::class);
});

Route::middleware(['auth', 'role:peminjam'])->group(function () {
    Route::get('/keranjang', KeranjangController::class);
});