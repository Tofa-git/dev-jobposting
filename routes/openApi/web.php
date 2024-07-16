<?php

use App\Http\Controllers\openApi\OpenApiController;

Route::get('wilayah-administrasi', [OpenApiController::class, 'getWilayahAdministrasi']);