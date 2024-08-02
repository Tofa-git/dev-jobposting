<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin-run8'], function () {
	Auth::routes();
});

/*Routing Backend*/
$route_files = File::allFiles(__DIR__ . '/backend/');
foreach ($route_files as $partial){require_once $partial->getPathName();}

/*Routing Frontend*/
$route_files = File::allFiles(__DIR__ . '/frontend/');
foreach ($route_files as $partial){require_once $partial->getPathName();}