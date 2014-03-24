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


 public static function payer_summary($user_id){
  $totals = DB::table('payers')
  ->join('payer_payment', 'payers.id', '=', 'payer_payment.payer_id')
  ->join(DB::raw('(SELECT payment_id,
    SUM(amount) / SUM(pays) AS single_share
    FROM   payer_payment
    GROUP  BY payment_id) AS payments_share'), 'payer_payment.payment_id', '=', 'payments_share.payment_id')
  ->select(DB::raw('
    payers.name,
    payer_payment.payer_id,
    SUM(payer_payment.amount)                             AS total_paid,
    SUM(payer_payment.pays * payments_share.single_share) AS fair_share
    '))                 
  ->where('payers.user_id', '=', Auth::user()->id)
  ->groupBy('payer_payment.payer_id')
  ->get();
  
  $totals_tmp = array();
  if ( $totals ){
    foreach ($totals as $total){
      $totals_tmp[$total->payer_id] = $total;
    } 
  }

  return $totals_tmp;

}
}
