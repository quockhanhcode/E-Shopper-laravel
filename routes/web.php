<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\HomeController@index');

Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');


Route::post('admin/dashboard', 'App\Http\Controllers\AdminController@dashboard');
Route::get('logout', 'App\Http\Controllers\AdminController@logout');

//Category Products
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');
//Thêm category
Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');
//Cập Nhật

Route::get('/edit-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::post('/update-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@update_category_product');

Route::get('/delete-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@delete_category_product');

//Brand Products
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@all_brand_product');

//Thêm category
Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand_product');
//Cập Nhật

Route::get('/edit-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@edit_brand_product');
Route::post('/update-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@update_brand_product');

Route::get('/delete-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@delete_brand_product');

//Sản phẩm:
Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');
Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');
Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
Route::post('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');
Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');


//Tìm kiếm sản phẩm theo danh mục
Route::get('/danh-muc-san-pham/{category_id}', 'App\Http\Controllers\CategoryProduct@show_category_home');
//Tìm kiếm sản phẩm theo thương hiệu
Route::get('/thuong-hieu-san-pham/{brnad_id}', 'App\Http\Controllers\BrandProduct@show_brand_home');

//Tìm kiếm
Route::post('/tim-kiem', 'App\Http\Controllers\HomeController@search');

//Xem chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{product_id}', 'App\Http\Controllers\ProductController@detail_product');

//Thêm giỏ hàng
Route::get('/cart', 'App\Http\Controllers\CartController@cart');
//Update cart
Route::post('/update-cart-quantity', 'App\Http\Controllers\CartController@update_cart_quantity');

Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'App\Http\Controllers\CartController@delete_to_cart');

//Checkout
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@login_checkout');
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@add_customer');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');
Route::post('/save-checkout-customer', 'App\Http\Controllers\CheckoutController@save_checkout_customer');
Route::get('/logout-checkout', 'App\Http\Controllers\CheckoutController@logout_checkout');

Route::post('/login-customer', 'App\Http\Controllers\CheckoutController@login_customer');

//Auth roles
Route::get('/register-auth', 'App\Http\Controllers\AuthController@register_auth');
//đăng kí
Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::get('/login-auth', 'App\Http\Controllers\AuthController@login_auth');

Route::post('/login', 'App\Http\Controllers\AuthController@login');

//Danh sách người dùng
Route::get('/all-users', 'App\Http\Controllers\UserController@all_users');

//Cấp quyền cho từng user
Route::post('/assign-roles', 'App\Http\Controllers\UserController@assign_roles');
