<?php

class Payer extends Eloquent {
	protected $guarded = array();

	

	public static $rules = array(
		'name'=>'required|alpha|min:2',
		);

	public function users(){
		return $this->belongsTo('User');
	}
	public function payments(){
		return $this->belongsToMany('Payment', 'payer_payment')
			->withPivot('amount', 'pays')
			->withTimestamps();
	}
}
