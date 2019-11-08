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

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
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
    //create period
    Route::get('product/period/create/{id}','ProductController@createPeriod')->name('product.period.create');
    Route::post('product/period/store','ProductController@storePeriod')->name('product.period.store');
    //edit period
    Route::get('product/period/edit/{id}','ProductController@editPeriod')->name('product.period.edit');
    Route::post('product/period/update','ProductController@updatePeriod')->name('product.period.update');
    //create price
    Route::get('product/price/create/{product_id}/{period_id}','ProductController@createPrice')->name('product.price.create');
    Route::post('product/price/store','ProductController@storePrice')->name('product.price.store');
    //edit price
    Route::get('product/price/edit/{id}','ProductController@editPrice')->name('product.price.edit');
    Route::post('product/price/update','ProductController@updatePrice')->name('product.price.update');
    //upload image
    Route::post('product/image/store','ProductController@storeImage')->name('product.image.store');
    //set type image
    Route::get('product/image/set/{id}/{type}/{product_id}','ProductController@setTypeImage')->name('product.image.set');
    //edit image
    Route::get('product/image/edit/{id}','ProductController@editImage')->name('product.image.edit');
    Route::put('product/image/{id}','ProductController@updateImage')->name('product.image.update');
    Route::post('product/image/destroy','ProductController@destroyImage')->name('product.image.destroy');
    Route::resource('product_type','ProductTypeController');
    Route::resource('setup','SettingController');

    Route::resource('booking','QuotationController');

});


/*End Back-end*/


Route::get('/task', function(){
    return response()->json([
        'message' => 'Task deleted successfully!'
    ], 200);
})->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

