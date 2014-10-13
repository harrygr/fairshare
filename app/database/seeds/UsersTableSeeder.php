<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		$now = date('Y-m-d H:i:s');

		$users = array(
			array( 
			 'username'=>'example',
			 'email' => 'lary@marpay.com',
			 'password' => Hash::make('example'),
			 'confirmation_code' => md5( uniqid(mt_rand(), true) ),
			 'confirmed' => true,
			 'created_at' => $now,
			 'updated_at' => $now,
			 ),
			array( 
			 'username'=>'example2',
			 'email' => 'lary@marpayly.com',
			 'password' => Hash::make('example2'),
			 'confirmation_code' => md5( uniqid(mt_rand(), true) ),
			 'confirmed' => true,
			 'created_at' => $now,
			 'updated_at' => $now,
			 )
		);

		// Uncomment the below to run the seeder
		 DB::table('users')->insert($users);
	}

}
