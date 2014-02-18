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

/**
* Calculate the best way for a group of people to pay each other back
*
* @param array An array of how much each user owes
*
* @return array An array of the transactions needed to clear each balance
*/
public static function settleUp($totals) {
	    //self::pr($totals);
	$amount = 0.11; $i = 1;
	while ( $amount > 0.1 || $amount < -0.1 ){
		$min = 0;
		$max = 0;
		foreach ($totals as $id => $row){
			if ($row['owes'] < $min) {
				$min = $row['owes'];
				$min_id = $id;
			}
			if ($row['owes'] > $max) {
				$max = $row['owes'];
				$max_id = $id;
			}
		}
		$amount = -$min > $max ? -$max : $min;

		if ($amount <> 0) {
			$payments[] = array(
				'from' 	=> $max_id,
				'to'	=> $min_id,
				'amount'=> -$amount,
				);

			$totals[$max_id]['owes'] = $totals[$max_id]['owes'] + $amount;
			$totals[$min_id]['owes'] = $totals[$min_id]['owes'] - $amount;
			//	echo "<h2>$i</h2>";
			//self::pr($totals);
		}
		$i++;
	}
		//self::pr($payments);
	return $payments;
}

}

?>