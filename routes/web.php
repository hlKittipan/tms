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
Route::get('/backend',function(){
    return view('backend.index');
})->name('backend');
Route::get('/backend/users',function(){
    return view('backend.users.index');
})->name('backend.users');

Route::get('/backend/home', 'HomeController@index')->name('backend.home');
/*End Back-end*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
