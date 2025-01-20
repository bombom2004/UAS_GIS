<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengaturanController;

Route::get('/', [HomeController::class, 'index']); // Halaman depan

/*
|---------------------------------------------------------------------------
| Route untuk Authentikasi (Login, Register, Logout)
|---------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|---------------------------------------------------------------------------
| Route untuk Pengguna
|---------------------------------------------------------------------------
*/
Route::get('/pengguna', [AuthController::class, 'datapengguna'])->middleware('auth');
Route::get('/daftar', [AuthController::class, 'formUser'])->name('daftar')->middleware('auth');
Route::post('/daftar', [AuthController::class, 'simpan'])->name('daftar')->middleware('auth');
Route::get('/pengguna/{id}/edit', [AuthController::class, 'editUser'])->name('auth.editUser')->middleware('auth');
Route::put('/pengguna/{id}', [AuthController::class, 'updateUser'])->name('updateUser')->middleware('auth');
Route::delete('/auth/deleteUser/{id}', [AuthController::class, 'deleteUser'])->name('auth.deleteUser')->middleware('auth');
Route::get('/datapengguna', [AuthController::class, 'datapengguna'])->name('datapengguna')->middleware('auth');

/*
|---------------------------------------------------------------------------
| Route untuk Dashboard dan Halaman Admin
|---------------------------------------------------------------------------
*/
Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard')->middleware('auth');

/*
|---------------------------------------------------------------------------
| Route untuk Pengaturan
|---------------------------------------------------------------------------
*/
Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan')->middleware('auth');
Route::post('/pengaturan/update', [PengaturanController::class, 'update'])->name('update')->middleware('auth');

/*
|---------------------------------------------------------------------------
| Route untuk Kategori
|---------------------------------------------------------------------------
*/
Route::resource('kategori', KategoriController::class)->middleware('auth');

/*
|---------------------------------------------------------------------------
| Route untuk Lokasi
|---------------------------------------------------------------------------
*/
Route::resource('lokasi', LokasiController::class)->middleware('auth');

/*
|---------------------------------------------------------------------------
| Route untuk Area
|---------------------------------------------------------------------------
*/
Route::resource('area', AreaController::class)->middleware('auth');

/*
|---------------------------------------------------------------------------
| Route tambahan untuk Kategori (jika tidak menggunakan resource)
|---------------------------------------------------------------------------
*/
// Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index')->middleware('auth');
// Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create')->middleware('auth');
// Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store')->middleware('auth');
// Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit')->middleware('auth');
// Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update')->middleware('auth');
// Route::delete('/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy')->middleware('auth');