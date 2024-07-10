<?php

use App\Http\Controllers\ImageSliderController;

Route::resource('content-management/image-slider', ImageSliderController::class)->except([
	'show'
])->names('image-slider');
Route::get('content-management/image-slider/{id}/status', [ImageSliderController::class, 'status'])->name('image-slider.status');
Route::get('content-management/image-slider/{id}/publish', [ImageSliderController::class, 'publish'])->name('image-slider.publish');