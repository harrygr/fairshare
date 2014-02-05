<?php

class PaymentsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('payments.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function add()
	{
		$payers = Payer::where('user_id', '=', Auth::user()->id)->get();

        return View::make('payments.add')->with('payers', $payers);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Payment::$rules);
		if (Auth::check()){
		if ($validator->passes()) {
      // validation has passed, save payment in DB
			$payment = new Payment;
			$payment->payment_date = Input::get('payment_date');
			$payment->company = Input::get('company');
			$payment->item = Input::get('item');
			$payment->save();

			//Save the amount each payer paid
			$payers = Payer::where('user_id', '=', Auth::user()->id)->get();
			
			foreach ($payers as $payer){
				$payment_payer = new PayerPayment;
				$payment_payer->payment_id = $payment->id;
				$payment_payer->payer_id = $payer->id;
				$payment_payer->amount = Input::get($payer->id . '-amount');

				$payment_payer->pays = Input::has($payer->id . '-pays');
				$payment_payer->save();
			}


			return Redirect::to('payers/')->with('message', 'Payment Added!');
		} else {
      // validation has failed, display error messages 
			return Redirect::to('payments/add')
				->with('message', 'The following errors occurred')
				->with('alert-class', 'alert-danger')
				->withErrors($validator)->withInput();
		}
		} else {
			return Redirect::route('users.showLogin')
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
        return View::make('payments.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('payments.edit');
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
	public function statement(){

		$payments_data = Payment::with('payers')->get()->toArray();
		$payment_data = Helper::process_payment($payments_data);
		$payers = Payer::where('user_id', '=', Auth::user()->id)->get();

		return View::make('payments.statement')
			->with('payments', $payment_data['payments'])
			->with('payment_totals', $payment_data['totals'])
			->with('payers', $payers);

		
	}

}
