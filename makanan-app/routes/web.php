<?php

use App\Http\Controllers\MakananController;
use App\Http\Controllers\landingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
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
    Route::get('/checkout/makanan', [MakananController::class, 'checkout'])->name('checkout');
});

// Route::prefix('/penjual')->name('penjual.')->group(function(){
//     Route::get('/data', [OrdersController::class, 'index'])->name('data');
//     Route::get('/tambah', [OrdersController::class, 'create'])->name('tambah');
//     Route::post('/tambah/proses', [OrdersController::class, 'store'])->name('tambah.proses');
//     Route::get('/ubah/{id}', [OrdersController::class, 'edit'])->name('ubah');
//     Route::patch('/penjual/ubah/{id}', [OrdersController::class, 'update'])->name('penjual.ubah.proses');
//     Route::delete('/hapus/{id}', [OrdersController::class, 'destroy'])->name('hapus');
// }); 

Route::prefix('/pesan')->name('pesan.')->group(function(){
    Route::get('/data', [OrdersController::class, 'index'])->name('data');
    Route::get('/create', [OrdersController::class, 'create'])->name('create');
    Route::post('/create/proses', [OrdersController::class, 'store'])->name('proses');      
    Route::get('orders/{id}', [OrdersController::class, 'show'])->name('struk');
    Route::get('/data/orders', [OrdersController::class, 'data'])->name('data.order');
    Route::get('/cetak/{id}', [OrdersController::class, 'exportPDF'])->name('cetak');
    Route::get('/export', [OrdersController::class, 'exportExcelDataOrder'])->name('export');
});

});