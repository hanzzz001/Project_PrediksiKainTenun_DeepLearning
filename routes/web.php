<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictionController;

// Beranda
Route::get('/', function () {
    return view('home');
})->name('home');

// Halaman prediksi (form upload + prediksi)
Route::get('/prediksi', function () {
    return view('prediksi');
})->name('prediksi');

// Simpan hasil prediksi
Route::post('/predictions', [PredictionController::class, 'store'])->name('predictions.store');

// Histori prediksi (Read - daftar semua prediksi)
Route::get('/histori', [PredictionController::class, 'index'])->name('predictions.index');

// Detail salah satu prediksi (Read - single item)
Route::get('/predictions/{id}', [PredictionController::class, 'show'])->name('predictions.show');

// Form edit prediksi
Route::get('/predictions/{id}/edit', [PredictionController::class, 'edit'])->name('predictions.edit');

// Update data prediksi
Route::put('/predictions/{id}', [PredictionController::class, 'update'])->name('predictions.update');

// Hapus data prediksi
Route::delete('/predictions/{id}', [PredictionController::class, 'destroy'])->name('predictions.destroy');

// Halaman panduan pengguna
Route::get('/panduan', function () {
    return view('panduan');
})->name('panduan');
