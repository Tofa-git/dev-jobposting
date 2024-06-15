<?php

use App\Http\Controllers\HalamanWebsiteController;

Route::resource('web-content/halaman-website', HalamanWebsiteController::class)->except([
	'show'
]);
Route::get('web-content/halaman-website/{id}/status', [HalamanWebsiteController::class, 'status'])->name('halaman-website.status');
Route::get('web-content/halaman-website/{id}/publish', [HalamanWebsiteController::class, 'publish'])->name('halaman-website.publish');
Route::get('web-content/halaman-website/{id}/restore', [HalamanWebsiteController::class, 'restore'])->name('halaman-website.restore');