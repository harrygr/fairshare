<?php

class PayersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $payers = Payer::where('user_id', '=', Auth::user()->id)->get();

        return View::make('payers.index')
        ->with('payers', $payers);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function add()
	{
        return View::make('payers.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Payer::$rules);
		if (Auth::check()){
		if ($validator->passes()) {
      // validation has passed, save user in DB
			$payer = new Payer;
			$payer->name = Input::get('name');
			$payer->email = Input::get('email');
			$payer->user_id = Auth::user()->id;
			$payer->save();

			return Redirect::to('payers/')->with('message', 'Payer Added!');
		} else {
      // validation has failed, display error messages 
			return Redirect::to('payers/add')
				->with('message', 'The following errors occurred')
				->with('alert-class', 'alert-danger')
				->withErrors($validator)->withInput();
		}
		} else {
			return Redirect::to('users/login')
			->with('message', 'You need to be logged in to do that!')
			->with('alert-class', 'alert-danger');
		}  
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$payers = Payer::where('user_id', '=', Auth::user()->id)->get();

        return View::make('payers.show')
        ->with('payers', $payers);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('payers.edit');
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
