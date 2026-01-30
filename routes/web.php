<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\NadzirController;
use App\Http\Controllers\PendaftaranNadzir;
use App\Http\Controllers\TypeDocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisNadzirController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomePageController::class, 'index'])->name('homepage');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/profil', [HomePageController::class, 'profil'])->name('homepage.profil');
Route::get('/dokumen-administrasi', [HomePageController::class, 'documentAdministrasi'])->name('homepage.documentAdministrasi');
Route::get('/kontak', [HomePageController::class, 'kontak'])->name('homepage.kontak');
Route::get('/pendaftaran-nadzir', [PendaftaranNadzir::class, 'index'])->name('pendaftaranNadzir');
Route::post('/submit-nadzir', [PendaftaranNadzir::class, 'store'])->name('pendaftaranNadzir.store');

Route::post('/kritik-saran', [KritikSaranController::class, 'store'])
    ->middleware('throttle:1,1')
    ->name('kritik.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/kritik-saran', [KritikSaranController::class, 'index'])->name('admin.kritik.index');
    Route::delete('/kritik-saran/{id}', [KritikSaranController::class, 'destroy'])->name('admin.kritik.destroy');

    Route::get('/nadzir', [NadzirController::class, 'index'])->name('admin.nadzir.index');

    Route::get('/jenis-nadzir', [JenisNadzirController::class, 'index'])->name('admin.jenisNadzir.index');
    Route::post('/save-jenis-nadzir', [JenisNadzirController::class, 'store'])->name('admin.jenisNadzir.store');
    Route::delete('/delete-jenis-nadzir/{jenisNadzir}', [JenisNadzirController::class, 'destroy'])->name('admin.jenisNadzir.destroy');
    Route::patch('/update-jenis-nadzir/{jenisNadzir}', [JenisNadzirController::class, 'update'])->name('admin.jenisNadzir.update');
    Route::patch('/non-active/{jenisNadzir}', [JenisNadzirController::class, 'nonActive'])->name('admin.jenisNadzir.nonActive');
    Route::patch('/active/{jenisNadzir}', [JenisNadzirController::class, 'active'])->name('admin.jenisNadzir.active');

    Route::get('/type-document', [TypeDocumentController::class, 'index'])->name('admin.document.index');
    Route::post('/save-document', [TypeDocumentController::class, 'store'])->name('admin.document.store');
    Route::delete('/delete-dokumen/{typeDocument}', [TypeDocumentController::class, 'destroy'])->name('admin.document.destroy');
    Route::match(
        ['post', 'patch'],
        '/update-dokumen/{typeDocument}',
        [TypeDocumentController::class, 'update']
    )->name('admin.document.update');
});

require __DIR__ . '/auth.php';
