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

Route::get('/test', function () {
    return "test";
});

Route::group([
    'middleware' => 'guest',
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers\Api'
], function () {
    Route::post('register', 'UserController@store');
    Route::post('login', 'AuthController@login');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers\Api'
], function () {
    // Route::match(['put', 'patch'], 'update', 'UserController@update');
    Route::post('update', 'UserController@update');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'UserController@me');

});