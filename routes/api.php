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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Lấy danh sách category
Route::get('categories', 'Api\CategoryController@index')->name('categories.index');

// Lấy thông tin sản phẩm theo category_id
Route::get('products/{categoryid}', 'Api\ProductController@categoryid')->name('products.categoryid');

//Lấy danh sách chi tiết hình ảnh theo product_id
Route::get('product-details-img/{productid}', 'Api\ProductController@detailsimg')->name('products.detailsimg');
//Login customer
Route::post('login', 'Api\CustomerController@login')->name('customer.login');

//Post Order
Route::post('checkout', 'Api\CheckoutController@orderPlace')->name('checkout.orderPlace');
