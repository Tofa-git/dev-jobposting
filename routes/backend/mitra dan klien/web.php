<?php

use App\Http\Controllers\DataClientController;

Route::resource('hr-module/mitra-dan-klien', DataClientController::class)->except([
	'show'
])->names('mitra-dan-klien');
Route::get('hr-module/mitra-dan-klien/{id}/status', [DataClientController::class, 'status'])->name('mitra-dan-klien.status');