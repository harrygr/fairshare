<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users')->truncate();

		$users = array(
			array('username'=>'harry', 'password' => 'hacp3')
		);

		// Uncomment the below to run the seeder
		 DB::table('users')->insert($users);
	}

}
