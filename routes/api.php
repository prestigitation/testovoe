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

Route::post('login', 'App\Http\Controllers\UserController@login')->name('login')->middleware('guest');

Route::prefix('user/{id}/')->middleware('auth:sanctum')->group(function () {
    Route::get('car', 'App\Http\Controllers\UserController@showCar')->middleware('ability:seeCarInfo')->name('users.see_car_info');
    Route::post('car/{car_id}', 'App\Http\Controllers\UserController@editCar')->middleware('ability:editCars')->name('users.edit_car');
    Route::delete('car/{car_id}', 'App\Http\Controllers\UserController@detachCar')->middleware('ability:editCars')->name('users.detach_car');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
