<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notification', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('sender_id');
			$table->integer('receiver_id');
			$table->string('subject')->nullable();
			$table->string('devicename')->nullable();
			$table->text('massage', 65535);
			$table->text('deviceid', 65535)->nullable();
			$table->integer('classified_id')->index('classified_id');
			$table->integer('offer_price');
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
		Schema::drop('notification');
	}

}
