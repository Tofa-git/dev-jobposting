<?php

use App\Http\Controllers\GroupRoleController;

Route::resource('administrative-tools/group-roles', GroupRoleController::class)->except([
	'show'
]);
Route::get('administrative-tools/group-roles/{id}/status', [GroupRoleController::class, 'status'])->name('group-roles.status');
Route::get('administrative-tools/group-roles/{id}/edit-role', [GroupRoleController::class, 'editRole'])->name('group-roles.edit-role');
Route::put('administrative-tools/group-roles/{id}/update-role', [GroupRoleController::class, 'updateRole'])->name('group-roles.update-role');