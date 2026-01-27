<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\NadzirController;
use App\Http\Controllers\PendaftaranNadzir;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomePageController::class, 'index'])->name('homepage');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/profil', [HomePageController::class, 'profil'])->name('homepage.profil');
Route::get('/dokumen-administrasi', [HomePageController::class, 'documentAdministrasi'])->name('homepage.documentAdministrasi');
Route::get('/kontak', [HomePageController::class, 'kontak'])->name('homepage.kontak');
Route::get('/pendaftaran-nadzir', [PendaftaranNadzir::class, 'index'])->name('pendaftaranNadzir');

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
});

require __DIR__ . '/auth.php';
