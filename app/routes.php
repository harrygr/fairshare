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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/users', array('uses' => 'UsersController@index'));



Route::get('users/register', array('as' => 'users.register', 'uses' => 'UsersController@register'));
Route::get('users/login', array('as' => 'users.login', 'uses' => 'UsersController@login'));
Route::get('users/dashboard', array('as' => 'users.dashboard', 'uses' => 'UsersController@dashboard'));
Route::get('users/logout', array('as' => 'users.logout', 'uses' => 'UsersController@logout'));
Route::post('users/create', array('uses' => 'UsersController@create'));
Route::post('users/signin', array('uses' => 'UsersController@signin'));

Route::group(array('before' => 'auth'), function(){
	Route::get('payers/add', array('as' => 'payers.add', 'uses' => 'PayersController@add'));
	Route::get('payers/', array('as' => 'payers.index', 'uses' => 'PayersController@index'));
	Route::post('payers/store', array('as' => 'payers.store', 'uses' => 'PayersController@store'));

	Route::get('payments/add', array('as' => 'payments.add', 'uses' => 'PaymentsController@add'));
	Route::post('payments/store', array('as' => 'payments.store', 'uses' => 'PaymentsController@store'));

	Route::get('/statement', array('uses' => 'PaymentsController@statement'));
	Route::resource('payments', 'PaymentsController');


});

//Route::resource('payers', 'PayersController');