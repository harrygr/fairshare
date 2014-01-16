<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users')->truncate();

		$now = date('Y-m-d H:i:s');

		$users = array(
			array( 'username'=>'mackay',
			 'email' => 'lary@marpay.com',
			 'password' => Hash::make('mackay'),
			 'created_at' => $now,
			 'updated_at' => $now,
			 ),
			array( 'username'=>'onslow',
			 'email' => 'lary@marpay.com',
			 'password' => Hash::make('onslow'),
			 'created_at' => $now,
			 'updated_at' => $now,
			 )
		);

		// Uncomment the below to run the seeder
		 DB::table('users')->insert($users);
	}

}
