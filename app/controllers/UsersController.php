<?php

class UsersController extends BaseController {

	protected $layout = "layouts.master";

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('dashboard')));
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
		//Helper::pr($users);
		
		return View::make('users.index')->with('users', $users);
	}

	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function register() {
		return View::make('users.register');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$validator = Validator::make(Input::all(), User::$rules);

		if ($validator->passes()) {
      // validation has passed, save user in DB
			$user = new User;
			$user->username = Input::get('username');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			return Redirect::to('users/login')->with('message', 'Thanks for registering!');
		} else {
      // validation has failed, display error messages 
			return Redirect::to('users/register')
				->with('message', 'The following errors occurred')
				->with('alert-class', 'alert-danger')
				->withErrors($validator)->withInput();
		}  
	}

	public function login() {
		return View::make('users.login');
	}

	public function signin(){
		if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))) {
			return Redirect::to('users/dashboard')
				->with('message', 'You are now logged in!')
				->with('alert-class', 'alert-success');
		} else {
			return Redirect::to('users/login')
				->with('message', 'Your username/password combination was incorrect')
				->with('alert-class', 'alert-danger')
				->withInput();
		}
	}

	public function logout() {
		Auth::logout();
		return Redirect::to('users/login')
			->with('message', 'You are now logged out!')
			->with('alert-class', 'alert-success');
	}

	public function dashboard() {
		return View::make('users.dashboard');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('users.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('users.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
