<?php

use App\Http\Controllers\UserManagementController;

Route::resource('administrative-tools/user-management', UserManagementController::class)->except([
	'show'
]);

Route::get('administrative-tools/user-management/{id}/status', [UserManagementController::class, 'status'])->name('user-management.status');
Route::get('administrative-tools/user-management/{id}/verify', [UserManagementController::class, 'verify'])->name('user-management.verify');
Route::put('administrative-tools/user-management/{id}/reset-password', [UserManagementController::class, 'resetPassword'])->name('user-management.reset-password');
Route::get('administrative-tools/user-management/{id}/edit-user-role', [UserManagementController::class, 'editUserRole'])->name('user-management.edit-user-role');