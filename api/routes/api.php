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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'namespace' => 'Records\\Controllers',
    'prefix' => '/records',
    'middleware' => 'auth:api'
], function () {
    Route::post('/exercises', 'ExerciseController@store');
    Route::get('/exercises', 'ExerciseController@index');
    Route::get('/exercises/{id}', 'ExerciseController@show');
    Route::put('/exercises/{id}', 'ExerciseController@update');
    Route::delete('/exercises/{id}', 'ExerciseController@delete');
    Route::post('/results', 'ResultController@store');
    Route::get('/results', 'ResultController@index');
    Route::get('/results/{id}', 'ResultController@show');
    Route::put('/results/{id}', 'ResultController@update');
    Route::delete('/results/{id}', 'ResultController@delete');
});
