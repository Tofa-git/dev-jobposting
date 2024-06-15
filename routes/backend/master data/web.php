<?php

use App\Http\Controllers\MasterDataController;

Route::resource('administrative-tools/master-data', MasterDataController::class)->except([
	'show'
]);
Route::get('administrative-tools/master-data/{id}/status', [MasterDataController::class, 'status'])->name('master-data.status');