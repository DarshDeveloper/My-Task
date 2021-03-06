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

// Mobile API Routs
//First API
Route::post('/mobilelogin', 'ApiController@login');
//Second API
Route::post('/mobileregister', 'ApiController@Register');

//Third API to Authenicate with JWT
Route::get('auth/register', 'UserController@register');
Route::get('auth/login', 'UserController@login');
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user', 'UserController@getAuthUser');
});