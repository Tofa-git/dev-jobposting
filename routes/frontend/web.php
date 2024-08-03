<?php

use App\Http\Controllers\frontend\frontendController;
use App\Http\Controllers\frontend\otpController;

Route::get('/', [frontendController::class, 'index'])->name('welcome.index');
Route::get('/halaman/{layout}/{page}', [frontendController::class, 'halaman'])->name('halaman.index');
Route::get('/content/{page}', [frontendController::class, 'indexContent'])->name('content.index-content');

//Content
/*
Route::get('/content/pasang-lowongan-kerja', [frontendController::class, 'pasangLoker'])->name('content.pasang-loker');
Route::get('/content/{layout}/{page}', [frontendController::class, 'content'])->name('content.content');

Route::get('/content/cari-karyawan', [frontendController::class, 'cariKaryawan'])->name('content.cari-karyawan');
*/

//General
Route::get('file-manager/link-url', [frontendController::class, 'fileLinkUrl']);

//OTP Login
Route::get('login', [otpController::class, 'showLogin'])->name('otp.login');
Route::post('generate', [otpController::class, 'generate'])->name('otp.generate');
Route::get('otp/{id}', [otpController::class, 'showOtp'])->name('otp.show-otp');
Route::post('check-otp/{id}', [otpController::class, 'checkOtp'])->name('otp.check-otp');
Route::get('register', [otpController::class, 'showRegister'])->name('otp.register');
Route::post('register', [otpController::class, 'postRegister'])->name('otp.post-register');
Route::get('activation/{id}', [otpController::class, 'activation'])->name('otp.activation');

Route::post('logout', [otpController::class, 'logout'])->name('otp.logout')->middleware('auth');