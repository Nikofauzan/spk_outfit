<?php

use Illuminate\Support\Facades\Route;
// Jangan lupa "panggil" atau import Controller-nya dulu di sini!
use App\Http\Controllers\RecommendationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah kamu mendaftarkan semua URL untuk aplikasimu.
|
*/

// Route #1: Untuk Halaman Utama (Homepage)
// Saat pengunjung membuka alamat "/", Laravel akan memanggil fungsi 'index'
// yang ada di dalam RecommendationController.
// Fungsi 'index' ini yang akan menampilkan form pilihan acara.
Route::get('/', [RecommendationController::class, 'index']);

// Route #2: Untuk Memproses Form
// Saat pengunjung menekan tombol "Cari Outfit!", form akan mengirim data
// ke alamat "/recommend" dengan metode POST. Laravel akan memanggil
// fungsi 'calculate' di RecommendationController untuk menghitung SPK-nya.
Route::post('/recommend', [RecommendationController::class, 'calculate']);
