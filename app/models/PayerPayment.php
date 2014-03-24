<?php

class PayerPayment extends Eloquent {
	protected $guarded = array();

	protected $table = 'payer_payment';

	public static $rules = array(
		'amount'		=> 'numeric',
		'payment_id' 	=> 'integer',
		'payer_id'		=> 'integer',
		);
	public static function getPaymentTotals($user_id){

		$totals = DB::select(DB::raw('SELECT payer_payment.payer_id, 
       Sum(payer_payment.amount)                             AS total_paid, 
       Sum(payer_payment.pays * payments_share.single_share) AS fair_share 
FROM   payers 
       INNER JOIN (payer_payment 
                   INNER JOIN (SELECT payment_id, 
                                      Sum(amount) / Sum(pays) AS single_share 
                               FROM   payer_payment 
                               GROUP  BY payment_id) AS payments_share 
                           ON payer_payment.payment_id = 
                              payments_share.payment_id) 
               ON payers.id = payer_payment.payer_id 
WHERE  (( ( payers.user_id ) = :user_id )) 
GROUP  BY payer_payment.payer_id '), array(':user_id', $user_id) );

		return $totals;

	}
}
