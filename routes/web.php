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
	// return view('layouts.homes.index');
	return redirect('/login');
});
Route::get('/signup', 'HomeCtrl@signup');

Auth::routes();

Route::get('/home', 'HomeCtrl@index')->name('home');

//=================================CASTOM ROUTE===============================
	Route::get('/user/delete/{id}','UserCtrl@destroy')->name('user.delete');
	Route::get('/category/delete/{id}','CategoryCtrl@destroy')->name('category.delete');
	Route::get('/sub_category/delete/{id}','SubCategoryCtrl@destroy')->name('sub_category.delete');
	Route::get('/vendor/delete/{id}','VendorCtrl@destroy')->name('vendor.delete');
	Route::get('/product/delete/{id}','ProductCtrl@destroy')->name('product.delete');
	Route::get('/customer/delete/{id}','CustomerCtrl@destroy')->name('customer.delete');


	Route::get('/payment/{id}/get', 'PaymentCtrl@getPayment')->name('get.payment');
	Route::get('/payment/{id}/index', 'PaymentCtrl@index')->name('index.payment');
	Route::get('/payment/{id}/read', 'PaymentCtrl@show')->name('show.payment');
	Route::get('/payment/{id}/delete','PaymentCtrl@destroy')->name('payment.delete');

	//password change
	Route::get('/change_password', 'UserCtrl@changePassword')->name('user.password.change');
	Route::put('/change_password', 'UserCtrl@updatePassword')->name('user.change.password');

//=================================CASTOM ROUTE END ==========================
	
	//user routes
	Route::resource('/user', 'UserCtrl');
	Route::resource('/category', 'CategoryCtrl');

	Route::resource('/sub_category', 'SubCategoryCtrl');
	Route::get('/get_sub_cats/{catid}', 'SubCategoryCtrl@subCats');

	Route::resource('/vendor', 'VendorCtrl');
	Route::resource('/product', 'ProductCtrl');
	Route::resource('/customer', 'CustomerCtrl');
	Route::get('/search/customer/{mobile_number}', 'CustomerCtrl@searchCustomer');
	Route::post('/search/customer', 'CustomerCtrl@searchCustomer')->name('customer.search');
	Route::resource('/sale', 'SaleCtrl');
	// Route::get('/sale/{customer}/product', 'SaleCtrl@saleProduct');
	Route::get('/sale/{id}/print', 'SaleCtrl@print');
	Route::get('/sale/delete/{id}','SaleCtrl@destroy')->name('sale.delete');
	Route::get('/search/orders/{value}', 'SaleCtrl@search');
	Route::get('/sale/{type}/{view}', 'SaleCtrl@viewSalesByType');

	Route::get('/search_item_names', 'SaleCtrl@getNames');

	Route::get('/sale/print/{id}/change', 'SaleCtrl@changePrintStatus');

	//payments
	Route::resource('/payment', 'PaymentCtrl');
	Route::get('/payment/{type}/view', 'PaymentCtrl@getPaymentByType');

	//return order
	Route::resource('/return', 'OrderReturnCtrl');
	Route::get('/return/{id}/order', 'OrderReturnCtrl@getReturn');
	Route::post('/return', 'OrderReturnCtrl@storeReturn')->name('return.store');
	Route::get('/return/{id}/delete', 'OrderReturnCtrl@delete');