<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as'=>'home', function()
{
	return View::make('home')->with('body_class', 'page_home');
}));
Route::get('about', array('as' => 'about', function(){
	return View::make('pages.about');
}));

// Route model bindings: auto-passes the model to the controller
Route::model('user', 'User');
Route::model('payment', 'Payment');
Route::model('payer', 'Payer');
Route::model('page', 'Page');

//Must be logged in to go to these routes
Route::group(array('before' => 'auth'), function(){
	Route::get('/dashboard', array('as' => 'users.dashboard', 'uses' => 'UserController@dashboard'));
	Route::get('/users', array('uses' => 'UsersController@index'));

	Route::get('payers/add', array('as' => 'payers.add', 'uses' => 'PayersController@add'));

	Route::get('payers', array('as' => 'payers.index', 'uses' => 'PayersController@index'));

	Route::get('payments/add', array('as' => 'payments.add', 'uses' => 'PaymentsController@add'));
	Route::get('payments/reimburse', array('as' => 'payments.reimburse', 'uses' => 'PaymentsController@addReimbursement'));
	
	Route::get('statement', array('as' => 'payments.statement', 'uses' => 'PaymentsController@statement'));
});

Route::group(array('before' => array('auth', 'restrictPayers')), function(){
	Route::get('payers/{payer}/edit', array('as' => 'payers.edit', 'uses' => 'PayersController@edit'));
});

Route::group(array('before' => array('auth', 'restrictPayments')), function(){
	Route::get('payments/{payment}/edit', array('as' => 'payments.edit', 'uses' => 'PaymentsController@edit'));
});

// must be logged in and check for XSS attacks
Route::group(array('before' => array('auth', 'csrf')), function(){
	Route::post('payments/store', array('as' => 'payments.store', 'uses' => 'PaymentsController@store'));
	Route::post('payments/storeReimbursement', array('as' => 'payments.storeReimbursement', 'uses' => 'PaymentsController@storeReimbursement'));
	Route::delete('payments/{payment}', array('as' => 'payments.delete', 'uses' => 'PaymentsController@delete'));
	Route::put('payments/update/{payment}', array('as' => 'payments.update', 'uses' => 'PaymentsController@update'));

	Route::post('payers/store', array('as' => 'payers.store', 'uses' => 'PayersController@store'));
	Route::put('payers/update/{payer}', array('as' => 'payers.update', 'uses' => 'PayersController@update'));
});

// Confide routes
Route::get( 'register', array( 'as' => 'users.create', 	'uses' => 'UserController@create'));
Route::get( 'user/edit', array( 'as' => 'users.edit', 	'uses' => 'UserController@edit'));
Route::put( 'user/update/{user}', array( 'as' => 'users.update', 	'uses' => 'UserController@update'));
Route::post('user/store', array( 'as' => 'users.store', 	'uses' => 'UserController@store'));
Route::get( 'login', array( 'as' => 'users.login', 	'uses' => 'UserController@login'));
Route::post('login', array( 'as' => 'users.do_login', 	'uses' => 'UserController@do_login'));
Route::get( 'user/confirm/{code}', array( 'as' => 'users.confirm', 	'uses' => 'UserController@confirm'));
Route::get( 'user/forgot_password', array( 'as' => 'users.forgot_password', 	'uses' => 'UserController@forgot_password'));
Route::post('user/forgot_password', array( 'as' => 'users.do_forgot_password', 	'uses' => 'UserController@do_forgot_password'));
Route::get( 'user/reset_password/{token}', array( 'as' => 'users.reset_password', 	'uses' => 'UserController@reset_password'));
Route::post('user/reset_password', array( 'as' => 'users.do_reset_password', 	'uses' => 'UserController@do_reset_password'));
Route::get( 'user/logout', array( 'as' => 'users.logout', 	'uses' => 'UserController@logout'));
