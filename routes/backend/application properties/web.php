<?php

use App\Http\Controllers\AppPropertiesController;

Route::resource('administrative-tools/application-properties', AppPropertiesController::class)->only([
	'index', 'update'
]);