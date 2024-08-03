<?php

use App\Http\Controllers\LandingPageController;

Route::resource('content-management/landing-page', LandingPageController::class)->except([
	'show'
]);
Route::get('content-management/landing-page/{id}/status', [LandingPageController::class, 'status'])->name('landing-page.status');
Route::get('content-management/landing-page/{id}/status-widget', [LandingPageController::class, 'statusWidget'])->name('landing-page.status-widget');
Route::get('content-management/landing-page/{id}/publish', [LandingPageController::class, 'publish'])->name('landing-page.publish');

/*Routing Widget*/
Route::get('content-management/landing-page/{id}/edit-widget', [LandingPageController::class, 'editWidget'])->name('landing-page.edit-widget');
Route::put('content-management/landing-page/{id}/update-widget', [LandingPageController::class, 'updateWidget'])->name('landing-page.update-widget');