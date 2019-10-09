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
    return view('backend.index');
})->name('letmepass');

Route::get('/backend/home', 'HomeController@index')->name('backend.home');
// Add user
Route::resource('/backend/user','Backend\UserController')->names([
    'index' => 'backend.user.index',
    'store' => 'backend.user.store',
    'edit' => 'backend.user.edit',
    'update' => 'backend.user.update',
    'destroy' => 'backend.user.destroy',
]);
Route::resource('/backend/product/type','Backend\ProductTypeController');

Route::group(['prefix' => 'backend','namespace'=>'Backend','as'=>'backend.'], function () {
    Route::resource('product','ProductController');
});
/*End Back-end*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
