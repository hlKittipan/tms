<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*Back-end*/
Route::get('/letmepass',function(){
    return view('backends.index');
})->name('letmepass');

Route::get('/backend/home', 'HomeController@index')->name('backend.home');

Route::group(['prefix' => 'backend','namespace'=>'Backend','as'=>'backend.'], function () {
    Route::resource('user','UserController');
    //Product
    Route::resource('product','ProductController');
    Route::get('product/after/{id}','ProductController@afterCreateProduct')->name('product.after');
    Route::resource('product_type','ProductTypeController');
    Route::resource('setup','SettingController');
});
/*End Back-end*/
Route::get('/task', function(){
    return response()->json([
        'message' => 'Task deleted successfully!'
    ], 200);
})->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

