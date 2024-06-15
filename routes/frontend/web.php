<?php

/*
|--------------------------------------------------------------------------
| Web Routes For Frontend
|--------------------------------------------------------------------------
|
| Created by : Budi Susilo
| Date       : December 17, 2023
|
*/

use App\Http\Controllers\frontend\frontendController;

Route::get('/', [frontendController::class, 'index'])->name('welcome.index');
Route::get('halaman/{page}', [frontendController::class, 'halaman'])->name('halaman.index');
Route::get('profile/{page}', [frontendController::class, 'profile']);
Route::get('berita', [frontendController::class, 'berita']);
Route::get('berita/{page}', [frontendController::class, 'beritaDetail']);
Route::get('kegiatan-relawan/{page}', [frontendController::class, 'kegiatanRelawan']);
Route::post('data-polling/{pilihan}', [frontendController::class, 'dataPolling'])->name('data-polling.polling');
Route::get('file-manager/link-url', [frontendController::class, 'fileLinkUrl']);


Route::get('website-content/{content}', [frontendController::class, 'content'])->name('website-content.index');
Route::get('website-content/{content}/{id}/detail', [frontendController::class, 'productDetail'])->name('website-content.product-detail');

Route::get('custom/{halaman}', [frontendController::class, 'custom'])->name('frontend.custom');

Route::post('visi-misi/download', [frontendController::class, 'downloadVisiMisi'])->name('frontend.download-visi-misi');


Route::get('profile/download', [frontendController::class, 'downloadProfile'])->name('frontend.profile-download');