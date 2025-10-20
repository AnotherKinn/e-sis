<?php

use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\SiswaLengkapController;
use App\Http\Controllers\Admin\WaliKelasController;
use App\Http\Controllers\Admin\IzinController;
use App\Http\Controllers\Admin\ValidasiController;
use App\Http\Controllers\Siswa\IzinController as IzinSiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Siswa\ProfilController;
use App\Http\Controllers\Siswa\DashboardController as DashboardSiswaController;
use App\Http\Controllers\Admin\DashboardController as DashboardAdminController;
use App\Exports\UserFormatExport;
use App\Http\Controllers\Admin\NotifikasiController;
use App\Http\Controllers\Admin\UserExportController;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page');
});

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route untuk Admin (bisa admin & petugas)
Route::prefix('admin')->middleware(['auth:petugas,web', 'role:admin,petugas'])->group(function () {
    // Route Dashboard Admin
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    // Route Manajemen Data Pengguna
    Route::get('/data-pengguna', [UserController::class, 'index'])->name('admin.data-pengguna');
    Route::get('/data-pengguna/search', [UserController::class, 'searchKelas'])->name('admin.data-pengguna.search');
    Route::get('/data-pengguna/{kelasId}', [UserController::class, 'byKelas'])->name('admin.data-pengguna.kelas');
    Route::post('/data-pengguna/{kelasId}/import', [UserController::class, 'import'])->name('admin.data-pengguna.import');
    Route::post('data-pengguna/import-global', [UserController::class, 'importGlobal'])
        ->name('admin.data-pengguna.import.global');
    Route::post('/data-pengguna/download-format', [UserController::class, 'downloadFormat'])->name('admin.data-pengguna.download-format');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.form-tambah-pengguna');
    Route::post('users/create', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('admin.form-edit-pengguna');
    Route::put('/users/edit/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Route Manajemen Data Kelas
    Route::get('/data-kelas', [KelasController::class, 'index'])->name('admin.data-kelas');
    Route::get('/kelas/search', [KelasController::class, 'search'])->name('admin.kelas.search');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('admin.form-tambah-kelas');
    Route::post('kelas/create', [KelasController::class, 'store'])->name('admin.kelas.store');
    Route::get('/kelas/edit/{kelas}', [KelasController::class, 'edit'])->name('admin.form-edit-kelas');
    Route::put('/kelas/edit/{kelas}', [KelasController::class, 'update'])->name('admin.kelas.update');
    Route::delete('/kelas/destroy/{kelas}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy');

    // Route Manajemen Data Jurusan
    Route::get('/data-jurusan', [JurusanController::class, 'index'])->name('admin.data-jurusan');
    Route::get('/jurusan/create', [JurusanController::class, 'create'])->name('admin.form-tambah-jurusan');
    Route::post('jurusan/create', [JurusanController::class, 'store'])->name('admin.jurusan.store');
    Route::get('/jurusan/edit/{jurusan}', [JurusanController::class, 'edit'])->name('admin.form-edit-jurusan');
    Route::put('/jurusan/edit/{jurusan}', [JurusanController::class, 'update'])->name('admin.jurusan.update');
    Route::delete('/jurusan/destroy/{jurusan}', [JurusanController::class, 'destroy'])->name('admin.jurusan.destroy');

    // Route Manajemen Data Siswa
    Route::get('/data-siswa', [SiswaLengkapController::class, 'index'])->name('admin.data-siswa');
    Route::get('/siswa/search', [SiswaLengkapController::class, 'search'])->name('admin.siswa.search');
    Route::get('/siswa/create', [SiswaLengkapController::class, 'create'])->name('admin.form-tambah-siswa');
    Route::post('siswa/create', [SiswaLengkapController::class, 'store'])->name('admin.siswa.store');
    Route::get('/siswa/edit/{siswa}', [SiswaLengkapController::class, 'edit'])->name('admin.form-edit-siswa');
    Route::put('/siswa/edit/{siswa}', [SiswaLengkapController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/siswa/destroy/{user}', [SiswaLengkapController::class, 'destroy'])->name('admin.siswa.destroy');

    // Route Manajemen Data Walikelas
    Route::get('/data-walikelas', [WaliKelasController::class, 'index'])->name('admin.data-walikelas');
    Route::get('/walikelas/search', [WaliKelasController::class, 'search'])->name('admin.walikelas.search');
    Route::get('/walikelas/create', [WaliKelasController::class, 'create'])->name('admin.form-tambah-walikelas');
    Route::post('walikelas/create', [WaliKelasController::class, 'store'])->name('admin.walikelas.store');
    Route::get('/walikelas/edit/{walikelas}', [WaliKelasController::class, 'edit'])->name('admin.form-edit-walikelas');
    Route::put('/walikelas/edit/{walikelas}', [WaliKelasController::class, 'update'])->name('admin.walikelas.update');
    Route::delete('/walikelas/destroy/{walikelas}', [WaliKelasController::class, 'destroy'])->name('admin.walikelas.destroy');

    // Route Manajemen Data Petugas
    Route::get('/data-petugas', [PetugasController::class, 'index'])->name('admin.data-petugas');
    Route::get('/petugas/create', [PetugasController::class, 'create'])->name('admin.form-tambah-petugas');
    Route::post('petugas/create', [PetugasController::class, 'store'])->name('admin.petugas.store');
    Route::get('/petugas/edit/{petugas}', [PetugasController::class, 'edit'])->name('admin.form-edit-petugas');
    Route::put('/petugas/edit/{petugas}', [PetugasController::class, 'update'])->name('admin.petugas.update');
    Route::delete('/petugas/destroy/{petugas}', [PetugasController::class, 'destroy'])->name('admin.petugas.destroy');


    // Scanner QR Code untuk admin/petugas
    Route::get('izin/scanner', function () {
        return view('admin.izin.scanner');
    })->middleware(['role:admin,petugas', 'auth'])->name('admin.izin.scanner');

    // Validasi izin (oleh admin/petugas)
    Route::get('validasi', [ValidasiController::class, 'index'])->name('admin.validasi.index');
    Route::get('validasi/{id}', [ValidasiController::class, 'show'])->name('admin.validasi.show');
    Route::post('validasi/{id}', [ValidasiController::class, 'proses'])->name('admin.validasi.proses');

    // Route Laporan Izin
    Route::get('/izin', [IzinController::class, 'index'])->name('admin.izin.index');
    Route::get('/izin/search', [IzinController::class, 'search'])->name('admin.izin.search');
    Route::get('/izin/export-excel', [IzinController::class, 'exportExcel'])->name('admin.izin.export');

    // Route Manajemen Notifikasi
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');


    // Route Scanner QR Code di Admin
    Route::get('/izin/cetak/{id}/{token}', [IzinController::class, 'cetak'])->name('admin.izin.cetak');
});

// Endpoint REST notifikasi
// routes/web.php
Route::get('/notifikasi', function () {
    return App\Models\Notifikasi::where('user_id', auth()->id())
        ->latest()
        ->take(10)
        ->get();
})->middleware('auth');


// Route untuk Siswa (hanya siswa)
Route::prefix('siswa')->middleware(['auth', 'role:siswa'])->group(function () {
    // Route Dashboard Siswa
    Route::get('/dashboard', [DashboardSiswaController::class, 'index'])->name('siswa.dashboard');

    // Route Manajemen Biodata Siswa
    Route::prefix('profil')->group(function () {
        Route::get('/', [ProfilController::class, 'profil'])->name('siswa.profil');

        // Data diri siswa
        Route::get('/data-diri', [ProfilController::class, 'dataDiri'])->name('siswa.profil.data-diri');
        Route::get('/data-diri/edit', [ProfilController::class, 'editDataDiri'])->name('siswa.profil.data-diri.edit');
        Route::put('/data-diri', [ProfilController::class, 'updateDataDiri'])->name('siswa.profil.data-diri.update');

        // Pengaturan siswa
        Route::get('/pengaturan', [ProfilController::class, 'pengaturan'])->name('siswa.profil.pengaturan');
        Route::get('/pengaturan/password', [ProfilController::class, 'editPassword'])->name('siswa.profil.pengaturan.password.edit');
        Route::put('/pengaturan/password', [ProfilController::class, 'updatePassword'])->name('siswa.profil.pengaturan.password.update');

        // Walikelas
        Route::get('/walikelas', [ProfilController::class, 'walikelas'])->name('siswa.profil.walikelas');

        // Notifikasi
        Route::get('/notifikasi', [ProfilController::class, 'notifikasi'])->name('siswa.profil.notifikasi');
    });

    // Route Manajemen Pengajuan Izin
    // Formulir pengajuan izin (tahap 1)
    Route::get('/izin/index', [IzinSiswaController::class, 'index'])->name('izin.index'); //index
    Route::get('/izin', [IzinSiswaController::class, 'create'])->name('izin.create');
    Route::post('/izin', [IzinSiswaController::class, 'store'])->name('izin.store');

    // Upload bukti izin (tahap 2)
    Route::get('/izin/upload/{izin}', [IzinSiswaController::class, 'uploadForm'])->name('izin.upload.form');
    Route::post('/izin/upload/{izin}', [IzinSiswaController::class, 'uploadBukti'])->name('izin.upload');

    // Halaman QR setelah izin berhasil
    Route::get('/izin/qr/{id}/{token}', [IzinSiswaController::class, 'showQr'])
        ->name('siswa.izin.qr');

    // Cetak izin (berdasarkan QR Code)
    // Route::get('/siswa/izin/cetak/{id}/{token}', [IzinSiswaController::class, 'cetak'])
    //     ->name('siswa.izin.cetak');


    // Riwayat izin siswa
    Route::get('/izin/riwayat', [IzinSiswaController::class, 'riwayat'])->name('izin.riwayat');
});



require __DIR__ . '/auth.php';
