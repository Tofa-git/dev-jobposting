<?php

use App\Http\Controllers\MasterDataController;

Route::resource('administrative-tools/persiapan-data-awal/master-data', MasterDataController::class)->except([
	'show'
]);
Route::get('administrative-tools/persiapan-data-awal/master-data/{id}/status', [MasterDataController::class, 'status'])->name('master-data.status');