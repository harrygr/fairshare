<?php

class PayerPaymentTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('payer_payment')->truncate();
		 
        $now = date('Y-m-d H:i:s');
		$payer_payments = array(
            array(
                'payment_id'    => 1,
                'payer_id'      => 4,
                'amount'        => 26,
                'pays'          => 1,
                'created_at' => $now,
			    'updated_at' => $now,
                ),
            array(
                'payment_id'    => 1,
                'payer_id'      => 5,
                'amount'        => 18,
                'pays'          => 1,
                'created_at' => $now,
			    'updated_at' => $now,
                )
		);

		// Uncomment the below to run the seeder
		 DB::table('payer_payment')->insert($payer_payments);
	}

}
