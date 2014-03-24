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

	
/**
* Calculate the best way for a group of people to pay each other back
*
* @param array An array of how much each user owes
*
* @return array An array of the transactions needed to clear each balance
*/
public static function settleUp($totals) {
	
	$payments = array();
	do {
		$min = 0;
		$max = 0;
		foreach ($totals as $id => $row){
			if (!isset($totals[$id]->owes))	$totals[$id]->owes = $row->fair_share - $row->total_paid;
			if ($totals[$id]->owes < $min) {
				$min = $totals[$id]->owes;
				$min_id = $id;
			}
			if ($totals[$id]->owes > $max) {
				$max = $totals[$id]->owes;
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

			$totals[$max_id]->owes += $amount;
			$totals[$min_id]->owes -= $amount;
		}

	} while ( $amount > 0.1 || $amount < -0.1 );
	return $payments;
}

public static function deleteResource($route, $button_label='Delete',$form_parameters = array(),$button_options=array('class' => 'btn btn-link')){

	$id = camel_case(implode($route,"."));

	if(empty($form_parameters)){
		$form_parameters = array(
			'method'=>'DELETE',
			'class' =>'delete-form confirm-form',
			'route'   => $route,
			'id'	=> $id,
			);
	}else{
		$form_parameters['route'] = $route;
		$form_parameters['method'] = 'DELETE';
	}

	return Form::open($form_parameters)
	. '<button type="submit" class="' . $button_options['class'] . '">' . $button_label . '</button>'
	. Form::close();
}

}

?>