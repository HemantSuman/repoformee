<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubscriberListsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscriber_lists', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('email', 155);
			$table->boolean('status')->comment('0 - Unsubscribe, 1 - Subscribe');
			$table->string('token');
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
		Schema::drop('subscriber_lists');
	}

}
