<?php

use App\Http\Controllers\LogActivityController;

Route::resource('administrative-tools/log-activities', LogActivityController::class)->only([
	'index', 'destroy'
]);