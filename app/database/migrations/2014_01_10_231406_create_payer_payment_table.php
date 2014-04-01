<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayerPaymentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payer_payment', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('payer_id');
			$table->unsignedInteger('payment_id');
			$table->foreign('payer_id')->references('id')->on('payers')->onDelete('cascade');
			$table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
			$table->decimal('amount', 10, 2);
			$table->boolean('pays');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payer_payment');
	}

}