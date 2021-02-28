<?php

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home',function(){
	return redirect()->route('home');
});

Route::get('/book/{id}','BookController@showBookDetailByID')->name('book')->where('id', '[0-9]+');
Route::post('/book/{id}','RatingController@getRatingPaginate')->name('book')->where('id', '[0-9]+');

Route::get('/category/{id}','CategoryController@listBooksById')->name('category')->where('id', '[0-9]+');
Route::post('/category/{id}','CategoryController@listBookPaginate')->name('post_category');

Route::post('/newsletter','NewsletterController@subscribe')->name('newsletter_subscribe');
Route::get('/contact_us','ContactUsController@index')->name('contact_us');
Route::post('/contact_us','ContactUsController@write_contact')->name('contact_us_post');

Route::get('/search/name', 'SearchController@searchByName');
Route::get('/search', 'SearchController@index')->name('search');
Route::post('/search', 'SearchController@searchbyajax')->name('search_ajax');

Route::get('/auth/{provider}', 'SocialAuthController@redirectToProvider');
Route::get('/auth/{provide}/callback', 'SocialAuthController@handleProviderCallback');

Route::group(['middleware' => 'auth'], function(){
	Route::delete('/delete_rating/','RatingController@destroy')->name('delete_rating');
	Route::post('/add_rating','RatingController@Rating')->name('add_rating');
	Route::get('/detail', 'OrderController@detail')->name('detail_order');
	
	Route::group(['prefix' => 'account','middleware' => 'verified'], function(){
		Route::get('/','UserController@account')->name('account_profile');
		Route::get('/edit','UserController@edit_show')->name('account_edit');
		Route::post('/edit','UserController@update')->name('account_update');
		Route::get('order/wait','OrderController@orderWait')->name('order_wait');
		Route::get('order/confirmed','OrderController@orderConfirmed')->name('order_confirm');
		Route::get('order/borrow','OrderController@orderBorrowing')->name('order_borrow');
		Route::get('order/history','OrderController@orderHistory')->name('order_history');
		Route::delete('/cart_cancel','OrderController@cancel')->name('cart_cancel');
		Route::post('/upload', 'UserController@upload')->name('upload');
		Route::get('/napthe','NapTheController@index')->name('napthe');
		Route::post('/napthe','NapTheController@napthe')->name('napthe');
		Route::get('/napthe/log','NapTheController@napthe_log')->name('napthe_log');
	});
});

Route::group(['prefix' => 'cart'], function(){
	Route::get('/', 'CartController@cart')->name('cart');
	Route::get('/add_to_cart/{id}','CartController@addToCart');
	Route::delete('/remove_from_cart','CartController@remove')->name('remove-cart');
	Route::get('submit','CartController@submit_cart')->name('submit_cart')->middleware('auth');
});

Route::get('logout', 'Auth\LoginController@logout', function () {
	return abort(404);
});

Route::get('admin/login', 'Admin\LoginController@showLoginForm')->name('AdminLoginForm');
Route::post('admin/login', 'Admin\LoginController@login')->name('AdminLogin');
Route::get('admin/logout', 'Admin\LoginController@logout')->name('AdminLogout');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){
	Route::get('/', 'Admin\DashboardController@index')->name('admin-home');

	Route::group(['prefix' => 'users'], function(){
		Route::get('/list', 'Admin\UserController@index')->name('User.List');
		Route::get('/api/search', 'Admin\UserController@apiSearch');
		Route::delete('/deleted', 'Admin\UserController@destroy');
		Route::get('/{id}/show', 'Admin\UserController@show')->name('User.Show');
		Route::get('/{id}/edit', 'Admin\UserController@edit')->name('User.Edit');
		Route::post('/{id}/edit', 'Admin\UserController@update')->name('User.Update');
		Route::get('/search', 'Admin\UserController@search')->name('User.Search');
		Route::get('/create', 'Admin\UserController@create')->name('User.Create');
		Route::post('/create', 'Admin\UserController@store')->name('User.Store');
		Route::post('/update-expiry', 'Admin\UserController@UpdateExpiry');
	});

	Route::group(['prefix' => 'category'], function(){
		Route::get('/list', 'Admin\CategoryController@index')->name('Category.List');
		Route::post('/add', 'Admin\CategoryController@store');
		Route::put('/updated', 'Admin\CategoryController@update');
		Route::delete('/deleted', 'Admin\CategoryController@destroy');
	});

	Route::group(['prefix' => 'books'], function(){
		Route::get('/list', 'Admin\BookController@index')->name('Book.List');
		Route::get('/create', 'Admin\BookController@create')->name('Book.Create');
		Route::post('/create', 'Admin\BookController@store')->name('Book.Store');
		Route::get('/{id}/edit', 'Admin\BookController@edit')->name('Book.Edit');
		Route::post('/{id}/edit', 'Admin\BookController@update')->name('Book.Update');
		Route::get('/search', 'Admin\BookController@search')->name('Book.Search');
		Route::get('/api/search', 'Admin\BookController@apiSearch');
		Route::delete('/deleted', 'Admin\BookController@destroy');
	});

	Route::group(['prefix' => 'order'], function(){
		Route::get('/list/{status}', 'Admin\OrderController@index')->name('Order.List');
		Route::get('/show', 'Admin\OrderController@show')->name('Order.Show');
		Route::get('/create', 'Admin\OrderController@create')->name('Order.Create');
		Route::post('/create', 'Admin\OrderController@store')->name('Order.Store');
		Route::get('/{status}/search', 'Admin\OrderController@search')->name('Order.Search');
		Route::put('/updated', 'Admin\OrderController@update');
		Route::delete('/deleted', 'Admin\OrderController@destroy');
		Route::get('/book/{id}', 'Admin\OrderController@OrderByBook')->name('Order.Book');
		Route::get('/user/{id}', 'Admin\OrderController@OrderByUser')->name('Order.User');
		Route::get('/report/{id}', 'Admin\OrderController@report')->name('Order.Report');
	});

	Route::group(['prefix' => 'comment'], function(){
		Route::get('/list', 'Admin\RatingController@index')->name('Comment.List');
		Route::get('/search', 'Admin\RatingController@search')->name('Comment.Search');
		Route::delete('/deleted', 'Admin\RatingController@destroy');
	});

	Route::group(['prefix' => 'lost-books'], function(){
		Route::post('/add', 'Admin\LostBookController@store');
		Route::get('/list', 'Admin\LostBookController@index')->name('LostBook.List');
		Route::delete('/deleted', 'Admin\LostBookController@destroy');
	});

	Route::group(['prefix' => 'contacts'], function(){
		Route::get('/list', 'Admin\ContactUsController@index')->name('Contact.List');
		Route::delete('/deleted', 'Admin\ContactUsController@destroy');
		Route::get('/show', 'Admin\ContactUsController@show');
		Route::post('/reply', 'Admin\ContactUsController@reply');
		Route::get('/search', 'Admin\ContactUsController@search')->name('Contact.Search');
	});
	
	Route::group(['prefix' => 'transaction'], function(){
		Route::get('/list', 'Admin\LogcardController@index')->name('Transaction.List');
		Route::get('/search', 'Admin\LogcardController@search')->name('Transaction.Search');
		Route::delete('/deleted', 'Admin\LogcardController@destroy');
	});

	Route::group(['prefix' => 'slider'], function(){
		Route::get('/list', 'Admin\SliderController@index')->name('Slider.List');
		Route::get('/create', 'Admin\SliderController@create')->name('Slider.Create');
		Route::post('/create', 'Admin\SliderController@store')->name('Slider.Store');
		Route::get('/{id}/edit', 'Admin\SliderController@edit')->name('Slider.Edit');
		Route::post('/{id}/edit', 'Admin\SliderController@update')->name('Slider.Update');
		Route::get('/search', 'Admin\SliderController@search')->name('Slider.Search');
		Route::delete('/deleted', 'Admin\SliderController@destroy');
	});
});

