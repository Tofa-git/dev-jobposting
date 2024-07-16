<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*Routing API*/
$route_files = File::allFiles(__DIR__ .DIRECTORY_SEPARATOR.'openApi'.DIRECTORY_SEPARATOR);
foreach ($route_files as $partial){require_once $partial->getPathName();}
