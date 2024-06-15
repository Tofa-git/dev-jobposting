<?php

use App\Http\Controllers\DataFileController;

Route::resource('content-management/file-management', DataFileController::class)->except([
	'show'
]);
Route::get('content-management/file-management/{id}/status', [DataFileController::class, 'status'])->name('file-management.status');
Route::get('content-management/file-management/{id}/restore', [DataFileController::class, 'restore'])->name('file-management.restore');