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
/*
 * Font
 * */
Route::resource('/', 'SiteController');
Route::get('/product/{product_id}', 'SiteController@getProductDetail')->name('product');
Route::get('/search', 'SiteController@postProductSearch')->name('search');
Route::get('/scheduler', 'SiteController@checkScheduler')->name('scheduler');
Route::get('/quotations', 'SiteController@getQuotations')->name('quotations');
Route::get('/checkAvailable', 'SiteController@checkAvailable')->name('available');
Route::post('/quotations/store', 'SiteController@storeQuotations')->name('quotations.store');
Route::get('/book', 'SiteController@getBook')->name('book');
Route::get('/search/booking', 'SiteController@searchBooking')->name('search/booking');
Route::get('/view', 'SiteController@showBooking')->name('view');
Route::get('/about', function () {
    return view('font.about-us');
});
Route::get('/contact', function () {
    return view('font.contact-us');
});
/*
 * end font
 * */
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Auth::routes();

/*Back-end*/
Route::get('/letmepass', function () {
    return view('backends.index');
})->name('letmepass');

Route::get('/backend/home', 'HomeController@index')->name('backend.home');

Route::group(['prefix' => 'backend', 'namespace' => 'Backend', 'as' => 'backend.'], function () {
    Route::resource('user', 'UserController');
    //Product
    Route::resource('product', 'ProductController');
    Route::get('product/after/{id}', 'ProductController@afterCreateProduct')->name('product.after');
    //create period
    Route::get('product/period/create/{id}', 'ProductController@createPeriod')->name('product.period.create');
    Route::post('product/period/store', 'ProductController@storePeriod')->name('product.period.store');
    //edit period
    Route::get('product/period/edit/{id}', 'ProductController@editPeriod')->name('product.period.edit');
    Route::post('product/period/update', 'ProductController@updatePeriod')->name('product.period.update');
    //Add service charge
    Route::post('product/service/store', 'ProductController@storeServiceCharge')->name('product.service.store');
    //Delete service charge
    Route::get('product/service/delete/{id}', 'ProductController@destroyServiceCharge')->name('product.service.delete');
    //create price
    Route::get('product/price/create/{product_id}/{period_id}/{status}', 'ProductController@createPrice')->name('product.price.create');
    Route::post('product/price/store', 'ProductController@storePrice')->name('product.price.store');
    //edit price
    Route::get('product/price/edit/{id}', 'ProductController@editPrice')->name('product.price.edit');
    Route::post('product/price/update', 'ProductController@updatePrice')->name('product.price.update');
    //delete price
    Route::get('product/price/delete/{id}', 'ProductController@deletePrice')->name('product.price.delete');
    //upload image
    Route::post('product/image/store', 'ProductController@storeImage')->name('product.image.store');
    //set type image
    Route::get('product/image/set/{id}/{type}/{product_id}', 'ProductController@setTypeImage')->name('product.image.set');
    //edit image
    Route::get('product/image/edit/{id}', 'ProductController@editImage')->name('product.image.edit');
    Route::put('product/image/{id}', 'ProductController@updateImage')->name('product.image.update');
    Route::post('product/image/destroy', 'ProductController@destroyImage')->name('product.image.destroy');
    Route::resource('product_type', 'ProductTypeController');
    Route::resource('province', 'ProvinceController');
    Route::resource('setup', 'SettingController');

    Route::resource('booking', 'QuotationController');

    Route::resource('transport', 'TransportController');

    //Report
    Route::get('report','ReportController@getReport')->name('report');
});


/*End Back-end*/
//Log
Route::post('/log/welcome', 'LogActivityController@store')->name('log.welcome');

Route::get('/task', function () {
    return response()->json([
        'message' => 'Task deleted successfully!'
    ], 200);
})->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function () {
    return view('test');
});

