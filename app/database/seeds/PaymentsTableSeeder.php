<?php

class PaymentsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('payments')->truncate();
		
        $now = date('Y-m-d H:i:s');
		$payments = array(
            array(
                'id'            => 1,
                'payment_date'  => '2014-01-05',
                'company'       => 'Kaff',
                'item'          => 'Cocktails',
                'created_at' => $now,
			    'updated_at' => $now,
                )
		);

		// Uncomment the below to run the seeder
		 DB::table('payments')->insert($payments);
	}

}
