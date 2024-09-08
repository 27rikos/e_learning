<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\MateriOnSiswaController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SubmitController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\TugasOnSiswaController;
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
    Route::resource('room', RuanganController::class);
    Route::post('imports-mapels', [MapelController::class, 'imports']);
    Route::post('imports-guru', [GuruController::class, 'imports']);
    Route::post('imports-kelas', [KelasController::class, 'imports']);
    Route::post('imports-siswa', [SiswaController::class, 'imports']);
});
Route::middleware(['auth', 'user-access:guru'])->group(function () {
    Route::get('/dashboard-guru', [App\Http\Controllers\HomeController::class, 'guru'])->name('guru');
    Route::get('materi/index', [MateriController::class, 'index'])->name('materi.index');
    Route::get('materi/show/{id}', [MateriController::class, 'show'])->name('materi.show');
    Route::get('materi/create/{id}', [MateriController::class, 'create'])->name('materi.create');
    Route::post('materi/store/{id}', [MateriController::class, 'store'])->name('materi.store');
    Route::get('materi/{id}/edit/{materi_id}', [MateriController::class, 'edit'])->name('materi.edit');
    Route::put('materi/{id}/update/{materi_id}', [MateriController::class, 'update'])->name('materi.update');
    Route::delete('materi/{id}/destroy/{materi_id}', [MateriController::class, 'destroy'])->name('materi.destroy');
    Route::get('tugas/index', [TugasController::class, 'index'])->name('tugas.index');
    Route::get('tugas/show/{id}', [TugasController::class, 'show'])->name('tugas.show');
    Route::get('tugas/create/{id}', [TugasController::class, 'create']);
    Route::post('tugas/store/{id}', [TugasController::class, 'store']);
    Route::get('tugas/{id}/edit/{tugas_id}', [TugasController::class, 'edit']);
    Route::put('tugas/{id}/update/{tugas_id}', [TugasController::class, 'update']);
    Route::delete('tugas/{id}/destroy/{tugas_id}', [TugasController::class, 'destroy']);
    Route::get('quiz/index', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('quiz/show/{id}', [QuizController::class, 'show']);
    Route::get('quiz/create/{id}', [QuizController::class, 'create']);
    Route::post('quiz/store/{id}', [QuizController::class, 'store']);
    Route::get('quiz/{id}/edit/{kuis_id}', [QuizController::class, 'edit']);
    Route::put('quiz/{id}/update/{kuis_id}', [QuizController::class, 'update']);
    Route::delete('quiz/{id}/destroy/{kuis_id}', [QuizController::class, 'destroy']);
    Route::get('submit/mapel', [SubmitController::class, 'index'])->name('submit.index');
    Route::get('submit/show/{id}', [SubmitController::class, 'show'])->name('submit.show');
    Route::put('submit/update/{id}', [SubmitController::class, 'update'])->name('submit.update');
    Route::delete('submit/destroy/{id}', [SubmitController::class, 'destroy'])->name('submit.destroy');
    Route::get('quiz-answer', [QuizController::class, 'mapel'])->name('kuis');
    Route::get('quiz-answer/check/{id}', [QuizController::class, 'check']);

});

Route::middleware(['auth', 'user-access:siswa'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('materi', [MateriOnSiswaController::class, 'index'])->name('siswa.index');
    Route::get('materi-siswa/show/{id}', [MateriOnSiswaController::class, 'show'])->name('siswa.show');
    Route::get('tugas', [TugasOnSiswaController::class, 'index'])->name('tugas');
    Route::post('tugas/upload', [TugasOnSiswaController::class, 'store'])->name('tugas-submit');
    Route::get('kuis/mapel', [JawabanController::class, 'index'])->name('jawaban');
    Route::get('kuis/show/{id}', [JawabanController::class, 'show']);
    Route::post('kuis/store/{id}', [JawabanController::class, 'store']);

});

// Public Route :
Route::get('/', [LandingPageController::class, 'index'])->name('front');
