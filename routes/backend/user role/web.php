<?php

use App\Http\Controllers\UserRoleController;

Route::resource('backend/user-role', UserRoleController::class)->only([
	'edit', 'update'
]);