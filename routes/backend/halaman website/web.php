<?php

use App\Http\Controllers\HalamanWebsiteController;

Route::resource('web-content/halaman-website', HalamanWebsiteController::class)->except([
	'show'
])->names('halaman-website');
Route::get('web-content/halaman-website/{id}/status', [HalamanWebsiteController::class, 'status'])->name('halaman-website.status');
Route::get('web-content/halaman-website/{id}/publish', [HalamanWebsiteController::class, 'publish'])->name('halaman-website.publish');