<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function() {
	if (Auth::guest()) return Redirect::guest('/login')
		->with('message', 'You must be logged in to access this area.')
		->with('alert-class', 'alert-danger');
});



Route::filter('auth.basic', function() {
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| Resource protection filters
|--------------------------------------------------------------------------
|
| Stop users from viewing/editing other users' models
| 
*/

//Payers
Route::filter('restrictPayers', function($route) {
$payer = $route->parameter('payer');

    if (!Auth::user()->payers()->find($payer->id)) return Redirect::route('payers.index')
    	->with('message', 'You can\'t see this as it doesn\'t belong to you.')
    	->with('alert-class', 'alert-danger');
});

Route::filter('restrictPayments', function($route) {
		$payment = $route->parameter('payment');

		//Ensure the currently logged in user is the owner of this payment
		$payment_user = DB::table('payers')
		->select('user_id')
		->join('payer_payment', 'payers.id', '=',  'payer_payment.payer_id')
		->where('payer_payment.payment_id', '=', $payment->id)
		->where('payers.user_id', '=', Auth::user()->id)
		->groupBy('user_id')
		->get();

    if ( !$payment_user ) return Redirect::route('payments.statement')
    	->with('message', 'You can\'t see this as it doesn\'t belong to you.')
    	->with('alert-class', 'alert-danger');
});