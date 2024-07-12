<?php

use App\Http\Controllers\MasterDataDetailController;

Route::resource('administrative-tools/persiapan-data-awal/master-data-detail', MasterDataDetailController::class)->except([
	'show'
]);
Route::get('administrative-tools/persiapan-data-awal/master-data-detail/{id}/status', [MasterDataDetailController::class, 'status'])->name('master-data-detail.status');