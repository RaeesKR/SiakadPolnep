<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\CetakKrsController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', fn () => redirect()->route('dashboard'));
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.attempt');
});
Route::middleware(['auth', 'historyback'])->group(function () {

    Route::get('/', fn () => redirect()->route('dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/mahasiswa/data', [MahasiswaController::class, 'data'])
        ->name('mahasiswa.data');
    Route::get('/dosen/data', [DosenController::class, 'data'])->name('dosen.data');
    Route::get('/matakuliah/data', [MataKuliahController::class, 'data'])
        ->name('matakuliah.data');
    Route::get('/krs/data', [KrsController::class, 'data'])->name('krs.data');


    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
    Route::get('/pengguna', [PenggunaController::class,'index'])
        ->middleware('role:admin')
        ->name('pengguna.index');
    Route::post('/logout', [LoginController::class,'logout'])->name('logout');


    Route::middleware('role:admin')->group(function () {
        Route::resource('dosen', DosenController::class)
        ->except(['index','show']);
        Route::resource('mahasiswa', MahasiswaController::class)
        ->except(['index', 'show']);
        Route::resource('matakuliah', MataKuliahController::class)
        ->except(['index', 'show']);
        Route::resource('krs', KrsController::class)
        ->parameters(['krs' => 'krs'])        
        ->except(['index', 'show']);

    // Tambahan Rute untuk Fitur Cetak & Export (di dalam grup auth)
    Route::get('/krs/{krs}/cetak', [KrsController::class, 'cetak'])->name('krs.cetak');
    Route::get('/mahasiswa/export/pdf', [MahasiswaController::class, 'exportPdf'])->name('mahasiswa.export.pdf');
    });

    // Export
    Route::prefix('export')->name('export.')->group(function () {
        Route::get('mahasiswa/excel',   [ExportController::class, 'mahasiswaExcel'])->name('mahasiswa.excel');
        Route::get('mahasiswa/pdf',     [ExportController::class, 'mahasiswaPdf'])->name('mahasiswa.pdf');
        Route::get('matakuliah/excel',  [ExportController::class, 'matakuliahExcel'])->name('matakuliah.excel');
        Route::get('matakuliah/pdf',    [ExportController::class, 'matakuliahPdf'])->name('matakuliah.pdf');
        Route::get('krs/excel',         [ExportController::class, 'krsExcel'])->name('krs.excel');
        Route::get('krs/pdf',           [ExportController::class, 'krsPdf'])->name('krs.pdf');
    });

    // Cetak KRS
    Route::get('krs/{id}/cetak', [CetakKrsController::class, 'cetak'])->name('krs.cetak');

    
    Route::resource('dosen', DosenController::class)
        ->only(['index','show']);
    Route::resource('mahasiswa', MahasiswaController::class)
        ->only(['index','show']);
    Route::resource('matakuliah', MataKuliahController::class)
        ->only(['index','show']);
    Route::resource('krs', KrsController::class)
        ->parameter('krs','krs')
        ->only(['index', 'show']);

    Route::get('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'show'])
        ->name('mahasiswa.show');
});