<?php

use App\Http\Controllers\WilayahAdministrasiController;

Route::resource('administrative-tools/persiapan-data-awal/wilayah-administrasi', WilayahAdministrasiController::class)->except([
	'show'
]);
Route::get('administrative-tools/persiapan-data-awal/wilayah-administrasi/{id}/status', [WilayahAdministrasiController::class, 'status'])->name('wilayah-administrasi.status');

Route::get('administrative-tools/persiapan-data-awal/wilayah-administrasi/data-wilayah/get-child', [WilayahAdministrasiController::class, 'getChild'])->name('wilayah-administrasi.get-child');