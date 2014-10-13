<?php

class PayersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('payers')->truncate();
		
        $now = date('Y-m-d H:i:s');
		$payers = array(
            array(
                'name'      => 'Tim',
                'email'     => 'tim@tim.com',
                'user_id'   => 1,
                'created_at' => $now,
			    'updated_at' => $now,                
                ),
            array(
                'name'      => 'Tom',
                'email'     => 'tom@tim.com',
                'user_id'   => 1,
                'created_at' => $now,
			    'updated_at' => $now,
			    ),
            array(
                'name'      => 'Harry',
                'email'     => null,
                'user_id'   => 2,
                'created_at' => $now,
			    'updated_at' => $now,
			    ),
            array(
                'name'      => 'Gareth',
                'email'     => 'gareth@g.com',
                'user_id'   => 2,
                'created_at' => $now,
			    'updated_at' => $now,                
                ),
            array(
                'name'      => 'Bella',
                'email'     => 'b@email.com',
                'user_id'   => 2,
                'created_at' => $now,
			    'updated_at' => $now,
			    ),
		);

		// Uncomment the below to run the seeder
		 DB::table('payers')->insert($payers);
	}

}
