<?php

class Payment extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function payers(){
		return $this->belongsToMany('Payer', 'payer_payment')
			->withPivot('amount', 'pays')
			->withTimestamps();
	}

	public function getStatement(){
		
	}
}
