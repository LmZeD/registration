<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return true;
});

Route::get('/login', function () {
    return response(json_encode(['error' => 'unauthorized']));
})->name('login');

Route::any('/{any}', function ($any) {
    return response(json_encode(['error' => 'Route does not exist']));
})->where('any', '.*');