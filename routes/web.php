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

Route::get('/', 'IndexController@index');

Route::match(['get', 'post'], '/admin', 'AdminController@login');
Route::get('/logout', 'AdminController@logout');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Category/Listing Page
Route::get('/products/{url}', 'ProductsController@products');

// Product details page
Route::get('/product/{url}', 'ProductsController@product');

// Add to Cart Route
Route::match(['get', 'post'], '/cart', 'ProductsController@cart');
Route::match(['get', 'post'], '/add-cart', 'ProductsController@addToCart');
Route::get('/cart/delete-product/{id}', 'ProductsController@deleteCartProduct');
Route::get('/cart/update-quantity/{id}/{quantity}', 'ProductsController@updateCartQuantity');

// Get Product Attribute price
Route::get('/get-product-price', 'ProductsController@getProductPrice');

// Apply Coupon
Route::post('/cart/apply-coupon', 'ProductsController@applyCoupon');

// Authentication
Route::get('/user-auth', 'UsersController@memberLoginRegister');
Route::post('/account-register', 'UsersController@register');
Route::post('/account-login', 'UsersController@login');
Route::get('/account-logout', 'UsersController@logout');

// All routes after login
Route::group(['middleware' => ['frontlogin']], function () {
    // User Account page
    Route::match(['get', 'post'], 'account', 'UsersController@account');

    // Check user password
    Route::post('/check-user-password', 'UsersController@checkUserPassword');

    // Update user password
    Route::post('/update-user-password', 'UsersController@updatePassword');

    // Checkout page
    Route::match(['get', 'post'], '/checkout', 'ProductsController@checkout');

    // Order review
    Route::match(['get', 'post'], '/order-review', 'ProductsController@orderReview');
});

// Admin
Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check-pwd', 'AdminController@chkPassword');
    Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword');

    // Categories Rputes (Admin)
    Route::match(['get', 'post'], '/admin/add-category', 'CategoryController@addCategory');
    Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory');
    Route::match(['get', 'post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory');
    Route::get('/admin/view-categories', 'CategoryController@viewCategories');

    // Products Routes (Admin)
    Route::match(['get', 'post'], '/admin/add-product', 'ProductsController@addProduct');
    Route::match(['get', 'post'], '/admin/edit-product/{id}', 'ProductsController@editProduct');
    Route::get('/admin/view-products', 'ProductsController@viewProducts');
    Route::get('/admin/delete-product/{id}', 'ProductsController@deleteProduct');
    Route::get('/admin/delete-product-image/{id}', 'ProductsController@deleteProductImage');
    Route::get('/admin/delete-more-photos/{id}', 'ProductsController@deleteMorePhotos');

    // Product Attributes Routes (Admin)
    Route::match(['get', 'post'], '/admin/add-attributes/{id}', 'ProductsController@addAttributes');
    Route::match(['get', 'post'], '/admin/edit-attributes/{id}', 'ProductsController@editAttributes');
    Route::get('/admin/delete-attribute/{id}', 'ProductsController@deleteAttribute');

    // Coupon Routes (Admin)
    Route::match(['get', 'post'], '/admin/add-coupon', 'CouponController@addCoupon');
    Route::match(['get', 'post'], '/admin/edit-coupon/{id}', 'CouponController@editCoupon');
    Route::get('/admin/view-coupons', 'CouponController@viewCoupons');
    Route::get('/admin/delete-coupon/{id}', 'CouponController@deleteCoupon');
});
