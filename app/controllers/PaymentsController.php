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

    public function add_reimbursement()
	{
		$payers = Payer::where('user_id', '=', Auth::user()->id)->lists('name', 'id');

		return View::make('payments.reimburse')->with('payers', $payers);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Payment::$rules);

		if ($validator->passes()) {
		    
		    $payers = Payer::where('user_id', '=', Auth::user()->id)->get();
		    $has_payer = false;
		    //Prepare the join table data
		    foreach ($payers as $payer){
				$sync_data[$payer->id] = array(
					'amount'=> Input::has($payer->id . '-amount') ? Input::get($payer->id . '-amount') : 0,
					'pays'  => Input::has($payer->id . '-pays')
					);
				if ( Input::has($payer->id . '-pays') ) $has_payer = true;
			}
			//Ensure at least one person is a payer
			if (!$has_payer) {
			    return Redirect::route('payments.add')
        			->with('message', 'At least one person needs to be a payer')
        			->with('alert-class', 'alert-danger')
        			->withInput();
			}
			
      // validation has passed, save payment in DB
			$payment = new Payment;
			$payment->payment_date = Input::get('payment_date');
			$payment->company = Input::get('company');
			$payment->item = Input::get('item');
			$payment->save();

			//Save the amount each payer paid
			$payment->payers()->sync($sync_data);
			
			return Redirect::route('payments.statement')
			    ->with('message', 'Payment Added!')
			    ->with('alert-class', 'alert-success');
		} else {
      // validation has failed, display error messages 
			return Redirect::route('payments.add')
			->with('message', 'The following errors occurred')
			->with('alert-class', 'alert-danger')
			->withErrors($validator)->withInput();
		}
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		return View::make('payments.show');
	}

	public function delete(Payment $payment){

		PayerPayment::where('payment_id', '=', $payment->id)->delete();
		$payment->delete();
		return Redirect::route('payments.statement')->with('message', 'Payment Deleted');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Payment $payment) {
		$payers = Payer::where('user_id', '=', Auth::user()->id)->get();
		$payer_payments = PayerPayment::where('payment_id', '=', $payment->id)->get();

		$pps = array();
		foreach ($payer_payments as $payer_payment){
			$pps[$payer_payment->payer_id] = array(
				'amount' => $payer_payment->amount,
				'pays'	=> $payer_payment->pays,
				);
		}
		
		return View::make('payments.edit')
		->with('id', $payment->id)
		->with(compact('payers'))
		->with(compact('payment'))
		->with(compact('pps'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($payment)
	{
		$validator = Validator::make(Input::all(), Payment::$rules);

		if ($validator->passes()) {
		    
		    //Prepare the join table data
		    $payers = Payer::where('user_id', '=', Auth::user()->id)->get();
		    $has_payer = false;
		    foreach ($payers as $payer){
				$sync_data[$payer->id] = array(
					'amount'=> Input::has($payer->id . '-amount') ? Input::get($payer->id . '-amount') : 0,
					'pays'  => Input::has($payer->id . '-pays')
					);
				if ( Input::has($payer->id . '-pays') ) $has_payer = true;
			}
			//Ensure at least one person is a payer
			if (!$has_payer) {
			    return Redirect::route('payments.edit', array($payment->id))
        			->with('message', 'At least one person needs to be a payer')
        			->with('alert-class', 'alert-danger')
        			->withInput();
			}

			//Save the base payment data
			$payment->payment_date = Input::get('payment_date');
			$payment->company = Input::get('company');
			$payment->item = Input::get('item');
			$payment->save();

			//Save the amount each payer paid
			$payment->payers()->sync($sync_data);
			
			return Redirect::route('payments.statement')
    			->with('message', 'Payment Edited!')
    			->with('alert-class', 'alert-success');
		} else {
		    //Validator failed
			return Redirect::route('payments.edit', array($payment->id))
			->with('message', 'Validation Errors Occurred')
			->with('alert-class', 'alert-danger')
			->withErrors($validator)->withInput();
		}

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

		$payments = Payment::whereHas('payers', function($q){
		   $q->where('user_id', '=', Auth::user()->id); 
		},'>=', DB::raw('1'))->get();
		
		//lazy eager load the pivot data
		$payment_data = $payments->load(array(
        'payers' => function($q){
           $q->where('user_id', '=', Auth::user()->id);
        }))
        ->toArray();

       $payers = Payer::where('user_id', '=', Auth::user()->id)->get();
		
		
		if(count($payers) > 0) :
    		//Give each item in the payers object its appropriate payer id
    		foreach ($payers as $payer){
    			$payers_tmp[$payer->id] = $payer;
    		}
    		$payers = $payers_tmp;
    		unset($payers_tmp);
        else :
            $payers = null;
        endif;

		if ( $payment_data ) {
			$payment_data = Helper::process_payment($payment_data);
		} else {
			$payment_data['payments'] = array();
			$payment_data['totals'] = array();
			Session::flash('message', 'There are no payments. ' . HTML::linkRoute('payments.add', 'Add one') );
			Session::flash('alert-class', 'alert-warning');
		}
		//Helper::pr($payers);
		$settles = Helper::settleUp($payment_data['totals']);
	
		return View::make('payments.statement')
		->with('payments', $payment_data['payments'])
		->with('payment_totals', $payment_data['totals'])
		->with('payers', $payers)
		->with(compact('settles'));

	}

}
