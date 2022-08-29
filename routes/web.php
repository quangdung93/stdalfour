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

Route::group(['namespace' => 'admin'], function () {
	Route::get('dt-login', ['as' => 'login', 'uses' => 'LoginController@getLogin']);
    Route::post('dt-login', 'LoginController@postLogin');
    Route::get('dt-logout', ['as' => 'dt-logout', 'uses' => 'LoginController@getLogout']);
    Route::group(['prefix' => 'dt-admin'], function () {
    	Route::get('/', ['as' => 'admin.index', 'uses' => 'DashboardController@getIndex']);
		//Ajax
		Route::get('anhien',['as'=>'anhien','uses'=>'AjaxController@checkAnhien']);
		//User
		Route::get('/user/list',['as'=>'userlist','uses'=>'UserController@getList']);
    	Route::get('/user/password', ['as' => 'changepassword', 'uses' => 'UserController@getChangePassword']);
        Route::post('/user/password', 'UserController@postChangePassword');
		//Product
		Route::get("/product", 'ProductController@getList')->name('admin.product.list');
		Route::post("/product-up-price", 'ProductController@getUpPrice')->name('update.price.ad');
		Route::post("/product-up-discount", 'ProductController@getUpDiscount')->name('update.discount.ad');
		Route::get('/product/them', 'ProductController@getAddProduct');
		Route::post('/product/them', 'ProductController@postAddProduct');
		Route::get('/product/sua/{id}', 'ProductController@getEditProduct');
		Route::post('/product/sua/{id}', 'ProductController@postEditProduct');
		Route::get('/product/xoa/{id}', 'ProductController@getDeleteProduct');
		Route::get("/product/catfind", 'ProductController@catFind');
		Route::get("/product/profind", 'ProductController@proFind');
		Route::post("/product/deleteall", 'ProductController@deleteAll')->name('delete.product.all');
		//Category
		Route::get("/category", 'CategoryController@getList')->name('admin.category.list');
		Route::get('/category/them', 'CategoryController@getAddCategory');
		Route::post('/category/them', 'CategoryController@postAddCategory');
		Route::get('/category/sua/{id}', 'CategoryController@getEditCategory');
		Route::post('/category/sua/{id}', 'CategoryController@postEditCategory');
		Route::get('/category/xoa/{id}', 'CategoryController@getDeleteCategory');
		//Order
		Route::get("/order", 'OrderController@getList')->name('admin.order.list');
		Route::get('/order/them', 'OrderController@getAddOrder');
		Route::post('/order/them', 'OrderController@postAddOrder');
		Route::get('/order/sua/{id}', 'OrderController@getEditOrder');
		Route::post('/order/sua/{id}', 'OrderController@postEditOrder');
		Route::get('/order/xoa/{id}', 'OrderController@getDeleteOrder');
		Route::post("/order/addpro", 'OrderController@addOrderPro')->name('admin.order.addpro');
		Route::post("/order/delpro", 'OrderController@delProOrder')->name('admin.order.delpro');
		Route::post("/order/addnote", 'OrderController@addNoteOrderPro')->name('admin.order.addnote');
		Route::post("/order/deleteall", 'OrderController@deleteAll')->name('delete.order.all');
		//News
		Route::get("/news", 'NewsController@getList')->name('admin.news.list');
		Route::get('/news/them', 'NewsController@getAddNews');
		Route::post('/news/them', 'NewsController@postAddNews');
		Route::get('/news/sua/{id}', 'NewsController@getEditNews');
		Route::post('/news/sua/{id}', 'NewsController@postEditNews');
		Route::get('/news/xoa/{id}', 'NewsController@getDeleteNews');
		//Category News
		Route::get("/category-news", 'CategoryNewsController@getList')->name('admin.category.news.list');
		Route::get('/category-news/them', 'CategoryNewsController@getAddCategory');
		Route::post('/category-news/them', 'CategoryNewsController@postAddCategory');
		Route::get('/category-news/sua/{id}', 'CategoryNewsController@getEditCategory');
		Route::post('/category-news/sua/{id}', 'CategoryNewsController@postEditCategory');
		Route::get('/category-news/xoa/{id}', 'CategoryNewsController@getDeleteCategory');
		//Articles
		Route::get("/articles", 'ArticlesController@getList')->name('admin.articles.list');
		Route::get('/articles/them', 'ArticlesController@getAddArticles');
		Route::post('/articles/them', 'ArticlesController@postAddArticles');
		Route::get('/articles/sua/{id}', 'ArticlesController@getEditArticles');
		Route::post('/articles/sua/{id}', 'ArticlesController@postEditArticles');
		Route::get('/articles/xoa/{id}', 'ArticlesController@getDeleteArticles');
		//Contact
		Route::get('/contact','ContactController@listContact')->name("contact.list.add");
		Route::get('/contact/xoa/{id}', 'ContactController@getDeleteContact');
		//Review
		Route::get('/review','ReviewController@listReview')->name("review.list.add");
		Route::get('/review/xoa/{id}', 'ReviewController@getDeleteReview');
		//Slider
        Route::get('/slider','SliderController@index')->name("slider.list");
        Route::get('/slider/create','SliderController@create')->name("slider.create");
        Route::post('/slider/create','SliderController@store')->name("slider.store");
        Route::get('/slider/delete/{id}','SliderController@destroy')->name("slider.delete");
        Route::get('/slider/{id}/edit','SliderController@edit')->name('slider.edit');
        Route::put('/slider/{id}','SliderController@update')->name('slider.update');
		//Setting
		Route::get('/setting/sua/{id}', 'SettingController@getEditSetting');
		Route::post('/setting/sua/{id}', 'SettingController@postEditSetting');
		//Image
		Route::get('delimage',['as'=> 'checkDelimage','uses'=> 'MediaController@checkDelimage']);
		Route::post('upload',['as'=> 'checkUpload','uses'=> 'MediaController@postUpload']);
		Route::post('upload-services',['as'=> 'checkUploadServices','uses'=> 'MediaController@postUploadServices']);
		Route::get('/get-district', ['as'=>'cart.district', 'uses' => 'OrderController@districtCart']);
	});
});

Route::group(['namespace' => 'user'], function () {
    Route::get('/', 'HomeController@getHome')->name('frontend.home');
	Route::get("/tin-tuc",'NewsController@getNews')->name('frontend.news');
	Route::get("/tin-tuc/{urlpost}",'NewsController@getDetail')->name('frontend.news.detail');
	Route::get("/san-pham",'CategoryController@getAllProductList')->name('frontend.sanpham.list');
	Route::get("/san-pham/{urlpost}",'CategoryController@getDetail')->name('frontend.category.detail');
	Route::get("/thong-tin/{urlpost}",'NewsController@getInfo')->name('frontend.news.info');
	Route::get("/gio-hang", 'CartController@checkGiohang')->name('frontend.giohang');
	Route::post("/add_cart", 'CartController@addCart')->name('frontend.cart.add');
	Route::post("/save_checkout", 'CartController@checkoutCart')->name('frontend.cart.checkout');
	Route::get('/thanh-toan-tao-tai-khoan', 'CartController@cartReturn')->name('cart-return');
});
