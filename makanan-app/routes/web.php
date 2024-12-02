<?php

use App\Http\Controllers\MakananController;
use App\Http\Controllers\landingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\UserController;


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
Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'loginProses'])->name('login.proses');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['IsLogin'])->group(function () {

    
    Route::get('/landing', [landingPageController::class, 'index'])->name('landingPage');  


Route::prefix('/data-makanan')->name('data-makanan.')->group(function(){
    Route::get('/data', [MakananController::class, 'index'])->name('data');
    Route::get('/tambah', [MakananController::class, 'create'])->name('tambah');
    Route::post('/tambah/proses', [MakananController::class, 'store'])->name('tambah.proses');
    Route::get('/ubah/{id}', [MakananController::class, 'edit'])->name('ubah');
    Route::patch('/data-makanan/ubah/{id}', [MakananController::class, 'update'])->name('ubah.proses');
    Route::delete('/hapus/{id}', [MakananController::class, 'destroy'])->name('hapus');
    Route::patch('/ubah/stock/{id}', [MakananController::class, 'updateStock'])->name('ubah.stock');
});

Route::prefix('/penjual')->name('penjual.')->group(function(){
    Route::get('/data', [PenjualController::class, 'index'])->name('data');
    Route::get('/tambah', [PenjualController::class, 'create'])->name('tambah');
    Route::post('/tambah/proses', [PenjualController::class, 'store'])->name('tambah.proses');
    Route::get('/ubah/{id}', [PenjualController::class, 'edit'])->name('ubah');
    Route::patch('/penjual/ubah/{id}', [PenjualController::class, 'update'])->name('penjual.ubah.proses');
    Route::delete('/hapus/{id}', [PenjualController::class, 'destroy'])->name('hapus');
});

});