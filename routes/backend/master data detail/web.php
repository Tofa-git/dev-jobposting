<?php

use App\Http\Controllers\MasterDataDetailController;

Route::resource('administrative-tools/master-data-detail', MasterDataDetailController::class)->except([
	'show'
]);
Route::get('administrative-tools/master-data-detail/{id}/status', [MasterDataDetailController::class, 'status'])->name('master-data-detail.status');