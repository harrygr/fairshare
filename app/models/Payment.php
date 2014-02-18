<?php

class Payment extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
			'payment_date' => 'required',
			'company' => 'required',
			'item' => 'required'
		);

	public function payers(){
		return $this->belongsToMany('Payer', 'payer_payment')
			->withPivot('amount', 'pays')
			->withTimestamps();
	}

	public function getStatement(){
		
	}
}
