<?php

use App\Http\Controllers\frontend\frontendController;

Route::get('/', [frontendController::class, 'index'])->name('welcome.index');
Route::get('/halaman/{layout}/{page}', [frontendController::class, 'halaman'])->name('halaman.index');

//Content
Route::get('/content/pasang-lowongan-kerja', [frontendController::class, 'pasangLoker'])->name('content.pasang-loker');
Route::get('/content/cari-karyawan', [frontendController::class, 'cariKaryawan'])->name('content.cari-karyawan');
Route::get('/content/{layout}/{page}', [frontendController::class, 'content'])->name('content.content');

//General
Route::get('file-manager/link-url', [frontendController::class, 'fileLinkUrl']);