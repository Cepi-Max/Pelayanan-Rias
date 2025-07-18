<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AntrianSuratController;
use App\Http\Controllers\Admin\JenisSuratController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Mail\NotifikasiPengajuanSurat;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;



Route::get('/tes-email', function () {
    $judul = 'Testing Email';
    $pesan = 'Ini isi email testing dari Laravel';

    Mail::to('cepi1939@gmail.com')->send(new NotifikasiPengajuanSurat($judul, $pesan));

    return 'Email dikirim (cek inbox atau spam)';
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Profie User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ================== ADMIN ==================
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        // Admin User Management
        Route::get('/pengaturan-pengguna', [UserManagementController::class, 'index'])->name('pengguna.index');
        Route::get('/pengaturan-pengguna/{id}', [UserManagementController::class, 'show'])->name('pengguna.show');
        Route::get('/pengaturan-pengguna/edit/{id}', [UserManagementController::class, 'edit'])->name('pengguna.edit');
        Route::post('/pengaturan-pengguna/update/{id}', [UserManagementController::class, 'update'])->name('pengguna.update');
        Route::delete('/pengaturan-pengguna/hapus/{id}', [UserManagementController::class, 'destroy'])->name('pengguna.destroy');


    });

    // // ================== OPERATOR ==================
    Route::middleware(['role:admin,operator'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Admin Operator Profile
        Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/admin/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::delete('/admin/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');

        // Operator Jenis Surat
        Route::get('/jenis-surat', [JenisSuratController::class, 'index'])->name('jenis-surat.index');
        Route::get('/jenis-surat/form/{id?}', [JenisSuratController::class, 'form'])->name('jenis-surat.form');
        Route::post('/jenis-surat/store', [JenisSuratController::class, 'storeOrUpdate'])->name('jenis-surat.store');
        Route::put('/jenis-surat/update/{id}', [JenisSuratController::class, 'storeOrUpdate'])->name('jenis-surat.update');
        Route::delete('/jenis-surat/delete/{id}', [JenisSuratController::class, 'destroy'])->name('jenis-surat.destroy');
        
        // Operator Antrian Pengajuan
        Route::get('/antrian-pengajuan-surat', [AntrianSuratController::class, 'index'])->name('antrian.index');
        Route::get('/antrian-pengajuan-surat/{id}', [AntrianSuratController::class, 'show'])->name('antrian.show');
        Route::post('/antrian-pengajuan-surat/{id}/update-status', [AntrianSuratController::class, 'updateStatus'])->name('antrian.updateStatus');
        Route::post('/antrian-pengajuan-surat/{id}/surat-selesai', [AntrianSuratController::class, 'kirimPdf'])->name('antrian.surat-selesai');

        // Arsip Surat
        Route::get('/arsip-surat', [ArsipController::class, 'index'])->name('arsip.index');
        Route::get('/arsip-surat/form', [ArsipController::class, 'form'])->name('arsip.form');
        Route::post('/arsip-surat/store', [ArsipController::class, 'store'])->name('arsip.store');
        Route::get('/arsip-surat/edit/{arsip}', [ArsipController::class, 'edit'])->name('arsip.edit');
        Route::post('/arsip-surat/update/{arsip}', [ArsipController::class, 'update'])->name('arsip.update');
        Route::delete('/arsip-surat/destroy/{arsip}', [ArsipController::class, 'destroy'])->name('arsip.destroy');
        
    });

    // ================== USER ==================
    Route::middleware(['role:user,admin,operator'])->group(function () {
        // Route::get('/', [PengajuanSuratController::class, 'beranda'])->name('user.beranda');

        // Pilih Surat
        Route::get('/ajukan-surat/{slug}', [PengajuanSuratController::class, 'form'])->name('pengajuan-surat.form');
        Route::post('/ajukan-surat/store', [PengajuanSuratController::class, 'store'])->name('pengajuan-surat.store');
        // Riwayat Pengajuan
        Route::get('/daftar-pengajuan', [UserController::class, 'daftarPengajuan'])->name('daftar-pengajuan.index');
        Route::get('/riwayat-pengajuan', [UserController::class, 'riwayatPengajuan'])->name('riwayat-pengajuan.index');
        // Di routes/web.php
        Route::get('/pengajuan/{id}/detail', [UserController::class, 'detailPengajuan'])
            ->name('pengajuan.detail');
        // Download Surat
        Route::get('/surat-selesai/download/{id}', [UserController::class, 'downloadSurat'])->name('download-pdf');
        
        Route::get('notif-dibaca/{id}', [AdminDashboardController::class, 'notifDibaca'])->name('dibaca');

    });
});

require __DIR__.'/auth.php';
