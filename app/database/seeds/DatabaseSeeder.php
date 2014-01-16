<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('PaymentsTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('PayersTableSeeder');
	}

}