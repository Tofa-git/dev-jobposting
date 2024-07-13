<?php

use App\Http\Controllers\PostingBeritaController;

Route::resource('content-management/posting-berita', PostingBeritaController::class)->except([
	'show'
])->names('posting-berita');
Route::get('content-management/posting-berita/{id}/status', [PostingBeritaController::class, 'status'])->name('posting-berita.status');
Route::get('content-management/posting-berita/{id}/publish', [PostingBeritaController::class, 'publish'])->name('posting-berita.publish');