<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartClassifiedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart_classified', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('classified_id')->index('classified_id');
			$table->integer('cart_id')->index('cart_id');
			$table->integer('qty');
			$table->string('ship_name', 100)->nullable();
			$table->decimal('ship_cost', 10)->default(0.00);
			$table->string('promocode')->nullable();
			$table->string('discount_type')->nullable();
			$table->string('discount_value')->nullable();
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
		Schema::drop('cart_classified');
	}

}
