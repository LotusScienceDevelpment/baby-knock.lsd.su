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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->namespace('App\\Http\\Controllers\\Api\\v1')->group(function() {
    Route::prefix('users')->group(function() {
        # Создать нового пользователя
        Route::put('create', 'AuthController@register')->name('users.create');
        # Войти в ученую запись
        Route::post('login', 'AuthController@login')->name('users.login');

//        Route::get('');
    });

    Route::middleware('auth:api')->group(function() {
        Route::prefix('sounds')->group(function () {
            Route::match(['post', 'get'], 'stream', 'SoundController@stream')->name('sounds.stream');
            Route::match(['post', 'get'], 'save', 'SoundController@save')->name('sounds.save');
        });

        Route::prefix('mothers')->group(function () {
            Route::get('get', 'MotherController@getHearths')->name('mother.get');
            Route::post('rename', 'MotherController@renameHearth')->name('mother.rename');
            Route::delete('delete', 'MotherController@deleteHearth')->name('mother.delete');
        });

        Route::prefix('profile')->group(function () {
            Route::get('get', 'ProfileController@get')->name('profile.get');
            Route::post('update', 'ProfileController@change')->name('profile.change');
        });

        Route::prefix('patients')->group(function () {
            Route::get('get', 'DoctorController@getPatients')->name('patients.get');
            Route::get('view', 'DoctorController@viewPatient')->name('patients.view');
            Route::post('afterScan', 'DoctorController@afterScan')->name('patients.afterScan');
        });
    });
});
