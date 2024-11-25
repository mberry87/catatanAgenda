<?php

use App\Http\Controllers\AgendaKegiatanController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardCotroller;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use App\Models\AgendaKegiatan;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


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


Auth::routes();

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('islogin')->group(function () {
    Route::get('/dashboard', [DashboardCotroller::class, 'index'])->name('dashboard');

    // agenda
    Route::get('agenda', [AgendaKegiatanController::class, 'index'])->name('agenda.index');
    Route::get('agenda/create', [AgendaKegiatanController::class, 'create'])->name('agenda.create');
    Route::post('agenda', [AgendaKegiatanController::class, 'store'])->name('agenda.store');
    Route::get('agenda/{id}/edit', [AgendaKegiatanController::class, 'edit'])->name('agenda.edit');
    Route::get('agenda/{id}/show', [AgendaKegiatanController::class, 'show'])->name('agenda.show');
    Route::put('agenda/{id}', [AgendaKegiatanController::class, 'update'])->name('agenda.update');
    Route::patch('agenda/{id}/selesai', [AgendaKegiatanController::class, 'updateStatus'])->name('agenda.updateStatus');
    Route::delete('agenda/{id}', [AgendaKegiatanController::class, 'destroy'])->name('agenda.destroy');


    // pegawai
    Route::get('pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('create/pegawai', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');


    // instansi
    Route::get('instansi', [InstansiController::class, 'index'])->name('instansi.index');
    Route::get('create/instansi', [InstansiController::class, 'create'])->name('instansi.create');
    Route::post('instansi', [InstansiController::class, 'store'])->name('instansi.store');
    Route::get('instansi/{id}/edit', [InstansiController::class, 'edit'])->name('instansi.edit');
    Route::put('instansi/{id}', [InstansiController::class, 'update'])->name('instansi.update');
    Route::delete('instansi/{id}', [InstansiController::class, 'destroy'])->name('instansi.destroy');

    //user
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('create/user', [UserController::class, 'create'])->name('user.create');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');

    // profil
    Route::get('profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::post('profil/updateFotoProfil', [ProfilController::class, 'updateFotoProfil'])->name('profil.updateFotoProfil');
    Route::post('profil/updateProfil', [ProfilController::class, 'updateProfil'])->name('profil.updateProfil');
    Route::post('profil/updatePassword', [ProfilController::class, 'updatePassword'])->name('profil.updatePassword');

    Route::get('status-selesai', [AgendaKegiatanController::class, 'countSelesai'])->name('status.countSelesai');
    Route::get('status-belum-selesai', [AgendaKegiatanController::class, 'countBelumSelesai'])->name('status.countBelumSelesai');


    //signout
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
