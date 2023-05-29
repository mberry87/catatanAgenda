<?php

use App\Http\Controllers\BenderaController;
use App\Http\Controllers\PegawaiController;
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
    return view('backend/dashboard/index');
});

// pegawai
Route::get('pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('create/pegawai', [PegawaiController::class, 'create'])->name('pegawai.create');
Route::post('pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::get('pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
Route::put('pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
Route::get('pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

// bendera
Route::get('bendera', [BenderaController::class, 'index'])->name('bendera.index');
Route::get('create/bendera', [BenderaController::class, 'create'])->name('bendera.create');
Route::post('bendera', [BenderaController::class, 'store'])->name('bendera.store');
Route::get('bendera/{id}/edit', [BenderaController::class, 'edit'])->name('bendera.edit');
Route::put('bendera/{id}', [BenderaController::class, 'update'])->name('bendera.update');
Route::get('bendera/{id}', [BenderaController::class, 'destroy'])->name('bendera.destroy');
