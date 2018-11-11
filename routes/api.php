<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'appointment'], function () {
        Route::get('/', [
            'uses' => 'AppointmentController@index',
            'as'   => 'appointment.index'
        ]);
        Route::get('/{id}', [
            'uses' => 'AppointmentController@show',
            'as'   => 'appointment.show'
        ]);
        Route::post('/', [
            'uses' => 'AppointmentController@store',
            'as'   => 'appointment.store'
        ]);
        Route::put('/', [
            'uses' => 'AppointmentController@update',
            'as'   => 'appointment.update'
        ]);
        Route::delete('/', [
            'uses' => 'AppointmentController@destroy',
            'as'   => 'appointment.destroy'
        ]);
    });
    Route::get('/user/all', [
        'uses' => 'UserController@all',
        'as'   => 'user.all'
    ]);
});

Route::any('/{any}', function ($any) {
    return response(json_encode(['error' => 'Route does not exist']));
})->where('any', '.*');