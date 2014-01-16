<?php 
class Helper {
	public static function pr($arr, $dump = false){
		echo '<pre>';
		if ($dump) {
			var_dump($arr);
		} else {
			print_r($arr);
		};
		echo '</pre>';
	}

	public static function process_payment($payments){

		foreach ($payments as $pmt_id => $payment){

			//get the total for the payment
			$pmt_sum = 0; $pyrs_sum = 0;
			foreach ($payment['payers'] as $payer){
				$pmt_sum += $payer['pivot']['amount'];
				$pyrs_sum += $payer['pivot']['pays'];
				if (!isset($payer_totals[$payer['pivot']['payer_id']])) {
				$payer_totals[$payer['pivot']['payer_id']] = array(
					'amount'	=> 0, 
					'fair_share'=> 0, 
					'owes'		=> 0
					);
			}
			}
			$fair_share = $pmt_sum / $pyrs_sum;
			$payments[$pmt_id]['total'] = $pmt_sum;
			$payments[$pmt_id]['fair_share'] = $fair_share;



			foreach ($payment['payers'] as $pyr_id => $payer){
				$pyr_fs = $fair_share * $payer['pivot']['pays'];
				$payments[$pmt_id]['payers'][$pyr_id]['pivot']['fair_share'] = $pyr_fs;
				$payments[$pmt_id]['payers'][$pyr_id]['pivot']['owes'] = $pyr_fs - $payer['pivot']['amount'];
				$payer_id = $payer['pivot']['payer_id'];
				$payments[$pmt_id]['payers_tmp'][$payer_id] = $payments[$pmt_id]['payers'][$pyr_id];

				//add the totals to the total array
				$payer_totals[$payer_id]['amount'] += $payer['pivot']['amount'];
				$payer_totals[$payer_id]['fair_share'] += $pyr_fs;
				$payer_totals[$payer_id]['owes'] += $payments[$pmt_id]['payers'][$pyr_id]['pivot']['owes'];
			}
			$payments[$pmt_id]['payers'] = $payments[$pmt_id]['payers_tmp'];
			unset($payments[$pmt_id]['payers_tmp']);
		}
		return array('payments' => $payments, 'totals'=>$payer_totals);
	}

}

 ?>