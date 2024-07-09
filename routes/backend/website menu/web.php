<?php

use App\Http\Controllers\WebsiteMenuController;

Route::resource('web-content/website-menu', WebsiteMenuController::class)->except([
	'show'
])->names('website-menu');
Route::get('web-content/website-menu/{id}/status', [WebsiteMenuController::class, 'status'])->name('website-menu.status');
Route::get('web-content/website-menu/{id}/publish', [WebsiteMenuController::class, 'publish'])->name('website-menu.publish');