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


// <!-- Start Admin Route -->
Route::get('/admin-page', 'AdminController@index');
Route::get('/dashboard', 'AdminController@showDashboard');
Route::post('/admin-dashboard', 'AdminController@dashboard');


// category
Route::get('/all-category', 'CategoryProduct@showCategory');
Route::get('/get-category', 'CategoryProduct@getCategory');

Route::post('/add-category', 'CategoryProduct@addCategory');
Route::get('/edit-category/{category_product_id}', 'CategoryProduct@editCategory');
Route::post('/update-category/{category_product_id}', 'CategoryProduct@updateCategory');
Route::get('/delete-category/{category_product_id}', 'CategoryProduct@deleteCategory');

//product
Route::get('/all-product', 'ProductController@showProduct');
Route::get('/get-product', 'ProductController@getProduct');

Route::post('/add-product', 'ProductController@addProduct');
Route::get('/edit-product/{product_id}', 'ProductController@editProduct');
Route::post('/update-product/{product_id}', 'ProductController@updateProduct');
Route::get('/delete-product/{product_id}', 'ProductController@deleteProduct');

//order
Route::get('/manage-orders', 'OrderController@manageOrder');
Route::get('/view-order/{order_id}', 'OrderController@viewOrder');

//send mail
Route::get('/send-mail', 'AdminController@sendMail');

//Login facebook
Route::get('/login-facebook','AdminController@login_facebook');
Route::get('/admin/callback','AdminController@callback_facebook');

// <!-- End Admin Route --> 

// <!-- Start App Route --> 

Route::get('get_categories', 'HomeController@getCategories');
Route::get('get_products', 'HomeController@getProducts');
Route::get('get_product_details', 'HomeController@getProductDetails');
Route::get('get_product_recommend', 'HomeController@getRecommendList');
Route::post('add_to_cart', 'CartController@addToCart');
Route::post('add_cart_ajax', 'CartController@addCartAjax');
Route::get('get_Cart', 'CartController@getCart');

Route::post('update_cart', 'CartController@updateCart');
Route::post('delete_product_cart', 'CartController@deleteProductCart');
Route::post('delete_cart', 'CartController@deleteCart');

Route::get('login_checkout', 'CheckOutController@loginCheckOut');
Route::post('add_customer', 'CheckOutController@addCustomer');
Route::post('validate_checkout', 'CheckOutController@validateCheckout');
Route::post('save_checkout_customer', 'CheckOutController@saveCheckout');
Route::post('login_customer', 'CheckOutController@loginCheckout');
Route::post('save_order', 'CheckOutController@saveOrder');

Route::get('get_customerId', 'MainController@getCustomerId');
Route::post('logout', 'MainController@logout');
// Route::get('/categories/{product_name}', 'HomeController@apiProduct');
// <!-- End App Route --> 


Route::get('/', 'HomeController@index');
// Route::get('{any}', 'HomeController@index')->where('any','.*');
Route::any('{slug}', function(){
    return view('welcome');
});
Route::any('categories/{slug}', 'HomeController@apiProduct');