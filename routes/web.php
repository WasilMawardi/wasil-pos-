<?php

use App\Http\Controllers\barangController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\dashboardController;

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/dashboard');
});


Route::get('/transaksi', [App\Http\Controllers\transaksiController::class, 'index']);
Route::post('/pesan', [App\Http\Controllers\transaksiController::class, 'pesan']);
Route::post('/simpan', [App\Http\Controllers\transaksiController::class, 'simpan']);

Route::get('/TambahBarang', [App\Http\Controllers\barangController::class, 'index']);
Route::get('/barang', [App\Http\Controllers\barangController::class, 'index']);
Route::get('/updateBarang/{id}', [App\Http\Controllers\barangController::class, 'update'])->name('update');
Route::post('/simpan-barang', [App\Http\Controllers\barangController::class, 'simpan']);

Route::get('/customer', [App\Http\Controllers\customerController::class, 'index']);
Route::get('/updateCustomer/{id}', [App\Http\Controllers\customerController::class, 'update'])->name('update');
Route::post('/simpan-customer', [App\Http\Controllers\customerController::class, 'simpan']);

Route::get('/dashboard', [App\Http\Controllers\dashboardController::class, 'index']);
Route::get('/detail/{id}', [App\Http\Controllers\dashboardController::class, 'detail'])->name('detail');
Route::get('/details/{id}', [App\Http\Controllers\dashboardController::class, 'details'])->name('details');
Route::get('/update/{id}', [App\Http\Controllers\dashboardController::class, 'update'])->name('update');

Route::resource('dboard', dashboardController::class);
Route::resource('barangs', barangController::class);
Route::resource('customers', customerController::class);
