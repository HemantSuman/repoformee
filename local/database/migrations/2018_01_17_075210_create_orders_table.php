<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('user_id');
			$table->decimal('order_subtotal', 10);
			$table->decimal('order_shipping', 10);
			$table->decimal('order_discount', 10);
			$table->decimal('order_grandtotal', 10);
			$table->string('transaction_status', 50)->nullable();
			$table->string('order_status', 50);
			$table->string('customer_fname', 200)->nullable();
			$table->string('customer_lname', 200)->nullable();
			$table->string('customer_address1', 200)->nullable();
			$table->string('customer_address2', 200)->nullable();
			$table->string('customer_city', 200)->nullable();
			$table->string('customer_state', 200)->nullable();
			$table->string('customer_country', 200)->nullable();
			$table->string('customer_postcode', 100)->nullable();
			$table->text('paypal_response', 65535)->nullable();
			$table->string('paypal_paykey', 100)->nullable()->index('paypal_paykey');
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
		Schema::drop('orders');
	}

}
