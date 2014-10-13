<?php

class PayerPayment extends Eloquent {
	protected $guarded = array();

	protected $table = 'payer_payment';

	public static $rules = array(
		'amount'		=> 'numeric',
		'payment_id' 	=> 'integer',
		'payer_id'		=> 'integer',
		);
}
