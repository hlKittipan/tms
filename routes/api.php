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
Route::get('detail/{id}', 'API\ProductController@getProductDetail');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('top-sales','API\ProductController@topSales')->middleware(['auth:api','cors']);
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['namespace'=>'API','as'=>'api.'], function () {
    route::get('search/product','ProductController@searchProduct')->name('search.product');
    route::get('search/product/available','ProductController@searchAvailable')->name('search.product.available');
    Route::get('search/transport','ProductController@searchTransport')->name('search.transport');
});


