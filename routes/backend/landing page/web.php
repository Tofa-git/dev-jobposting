<?php

use App\Http\Controllers\LandingPageController;

Route::resource('content-management/landing-page', LandingPageController::class)->except([
	'show'
]);
Route::get('content-management/landing-page/{id}/status', [LandingPageController::class, 'status'])->name('landing-page.status');
Route::get('content-management/landing-page/{id}/status-widget', [LandingPageController::class, 'statusWidget'])->name('landing-page.status-widget');
Route::get('content-management/landing-page/{id}/publish', [LandingPageController::class, 'publish'])->name('landing-page.publish');