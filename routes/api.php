<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');
Route::post('refreshtoken', 'Api\UserController@refreshToken');

Route::get('/unauthorized', 'Api\UserController@unauthorized')->name('api.unauthorized');
Route::group(['middleware' => ['CheckClientCredentials','auth:api']], function() {
    Route::get('/room/availability', 'Api\AppController@availability');
    Route::post('/room/reservation', 'Api\AppController@createReservation');
    Route::put('/room/reservation', 'Api\AppController@updateReservation');
    Route::delete('/room/reservation', 'Api\AppController@deleteReservation');
});
