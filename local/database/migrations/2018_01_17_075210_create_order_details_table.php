<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('order_id')->index('order_id');
			$table->integer('classified_id')->index('classified_id');
			$table->string('item_name', 250);
			$table->integer('item_qty');
			$table->decimal('item_price', 10);
			$table->decimal('item_total_amt', 10);
			$table->integer('seller_id')->index('seller_id');
			$table->string('seller_paypal_email', 120);
			$table->decimal('item_ship_cost', 10);
			$table->string('item_ship_name', 100);
			$table->string('transaction_id', 100);
			$table->string('transaction_status', 50);
			$table->string('senderTransactionId', 100);
			$table->string('order_status', 200)->default('Pending');
			$table->string('buyer_pick_date', 200);
			$table->string('buyer_pick_time', 200);
			$table->text('buyer_msg', 65535);
			$table->text('seller_msg', 65535);
			$table->text('pickup_location', 65535);
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
		Schema::drop('order_details');
	}

}
