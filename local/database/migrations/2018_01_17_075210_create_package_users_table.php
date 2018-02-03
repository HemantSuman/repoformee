<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePackageUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('package_users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('package_id')->index('package_id');
			$table->string('package_name', 250);
			$table->integer('user_id')->index('user_id');
			$table->integer('classified_id')->index('classified_id');
			$table->decimal('package_price', 10);
			$table->integer('number_image_upload');
			$table->integer('duration');
			$table->string('classified_type', 250);
			$table->integer('status')->default(0);
			$table->string('paypal_token', 100);
			$table->string('paypal_payer_id', 100);
			$table->string('paypal_transaction_id', 100);
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
		Schema::drop('package_users');
	}

}
