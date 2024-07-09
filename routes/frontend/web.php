<?php

use App\Http\Controllers\frontend\frontendController;

Route::get('/', [frontendController::class, 'index'])->name('welcome.index');
Route::get('/halaman/{layout}/{page}', [frontendController::class, 'halaman'])->name('halaman.index');

Route::get('file-manager/link-url', [frontendController::class, 'fileLinkUrl']);