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

Route::get('users', 'API\UserController@index');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*Api*/
Route::group(['prefix' => 'api','namespace'=>'API','as'=>'api.'], function () {
    route::get('search/product','ProductController@searchProduct')->name('search.product');
});

/*End Api*/
