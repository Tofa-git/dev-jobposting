<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register'=>false, 'verify' => true]);

/*Routing Backend*/
$route_files = File::allFiles(__DIR__ . '/backend/');
foreach ($route_files as $partial){require_once $partial->getPathName();}

/*Routing Frontend*/
$route_files = File::allFiles(__DIR__ . '/frontend/');
foreach ($route_files as $partial){require_once $partial->getPathName();}