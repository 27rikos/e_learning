<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjaranController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
    Route::resource('administrator', AdminController::class);
    Route::resource('tahun-ajaran', TahunAjaranController::class);
    Route::resource('teacher', GuruController::class);
    Route::resource('student', SiswaController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('mapel', MapelController::class);
});
Route::middleware(['auth', 'user-access:guru'])->group(function () {
    Route::get('/dashboard-guru', [App\Http\Controllers\HomeController::class, 'guru'])->name('guru');
});
Route::middleware(['auth', 'user-access:siswa'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});

// Public Route :
Route::get('/', [LandingPageController::class, 'index'])->name('front');