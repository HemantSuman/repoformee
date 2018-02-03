<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_address', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('user_id');
			$table->string('fname', 250)->nullable();
			$table->string('lname', 250)->nullable();
			$table->string('address_1', 250)->nullable();
			$table->string('address_2', 250)->nullable();
			$table->string('city', 250)->nullable();
			$table->string('state', 250)->nullable();
			$table->string('country', 250);
			$table->string('postalcode', 100);
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
		Schema::drop('user_address');
	}

}
