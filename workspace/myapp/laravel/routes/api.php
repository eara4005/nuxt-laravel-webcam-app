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

Route::group(['middleware' => 'api'], function () {

  Route::get('/current_user', function () {
    return Auth::user();
  })->name('currentUser');
});

Route::group(['middleware' => ['cors']], function () {
    Route::get('index_faces', 'Api\ImgUpController@indexFaces');
    Route::post('index_faces', 'Api\ImgUpController@StoreIndexFaces');
    Route::apiResource('upload','Api\ImgUpController');
});