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
	return View::make('home');
}));


Route::model('payment', 'Payment');
Route::model('payer', 'Payer');


//User Routes
Route::get('/register', array('as' => 'users.showRegister', 'uses' => 'UsersController@showRegister'));
Route::get('/login', array('as' => 'users.showLogin', 'uses' => 'UsersController@showLogin'));
Route::get('/logout', array('as' => 'users.logout', 'uses' => 'UsersController@logout'));
Route::post('/login', array('as' => 'users.doLogin', 'uses' => 'UsersController@doLogin'));

Route::group(array('before' => 'csrf'), function(){
	Route::post('/register', array('as' => 'users.doRegister', 'uses' => 'UsersController@doRegister'));
});

Route::group(array('before' => 'auth'), function(){
	Route::get('/dashboard', array('as' => 'users.dashboard', 'uses' => 'UsersController@dashboard'));
	Route::get('/users', array('uses' => 'UsersController@index'));

	Route::get('payers/add', array('as' => 'payers.add', 'uses' => 'PayersController@add'));
	Route::get('payers/edit/{payer}', array('as' => 'payers.edit', 'uses' => 'PayersController@edit'));
	Route::get('payers/', array('as' => 'payers.index', 'uses' => 'PayersController@index'));


	Route::get('payments/add', array('as' => 'payments.add', 'uses' => 'PaymentsController@add'));

	Route::get('payments/edit/{payment}', array('as' => 'payments.edit', 'uses' => 'PaymentsController@edit'));


	Route::get('statement', array('as' => 'payments.statement', 'uses' => 'PaymentsController@statement'));

});

Route::group(array('before' => array('auth', 'csrf')), function(){
	Route::post('payments/store', array('as' => 'payments.store', 'uses' => 'PaymentsController@store'));
	Route::delete('payments/{payment}', array('as' => 'payments.delete', 'uses' => 'PaymentsController@delete'));
	Route::put('payments/update/{payment}', array('as' => 'payments.update', 'uses' => 'PaymentsController@update'));

	Route::post('payers/store', array('as' => 'payers.store', 'uses' => 'PayersController@store'));
	Route::put('payers/update/{payer}', array('as' => 'payers.update', 'uses' => 'PayersController@update'));
});
