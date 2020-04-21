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

// ADMIN HERE
// Trang chu Admin hien thi o day
Route::get('admin/home', function() {
	return view('admin.homeadmin');
});

Route::resource('admin/about','AboutController');
// Định dạng lại destroy
Route::delete('about_delete_modal', 'AboutController@destroy')->name('about_delete_modal');
Route::resource('admin/brand','BrandController');
// Định dạng lại destroy
Route::delete('brand_delete_modal', 'BrandController@destroy')->name('brand_delete_modal');
Route::resource('admin/category','CategoryController');
// Định dạng lại destroy
Route::delete('category_delete_modal', 'CategoryController@destroy')->name('category_delete_modal');
Route::resource('admin/comment','CommentController');
Route::resource('admin/image','ImageController');
Route::resource('admin/order','OrderController');
Route::resource('admin/orderdetail','OrderDetailController');
Route::resource('admin/product','ProductController');
// Định dạng lại destroy
Route::delete('product_delete_modal', 'ProductController@destroy')->name('product_delete_modal');
Route::resource('admin/slide','SlideController');
// Định dạng lại destroy
Route::delete('slide_delete_modal', 'SlideController@destroy')->name('slide_delete_modal');
Route::get('/setvalue', 'ProductController@setvalue');
// END ADMIN

// --------------------------------------------

// USER HERE
// Trang chu User hien thi o day
Route::get('/', function () {
    return view('user.home');
});
// END USER

// ---------------------------------------------
Route::get('admin/home', function () {
    return view('admin.homeadmin');
});

// CART
Route::get('product', 'ProductsController@index');

Route::get('cart', 'ProductsController@cart');

Route::get('add-to-cart/{id}', 'ProductsController@addToCart');

Route::patch('update-cart', 'ProductsController@update');

Route::delete('remove-from-cart', 'ProductsController@remove');
// END CART

// ----------------------------------------------