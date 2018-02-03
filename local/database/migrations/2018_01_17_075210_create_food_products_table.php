<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFoodProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('food_products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id')->index('food_products_category_id_foreign');
			$table->string('name');
			$table->text('description', 65535);
			$table->string('image');
			$table->integer('status')->default(0)->comment('0-deactive,1-active');
			$table->string('bar_code');
			$table->string('ingredient');
			$table->string('nutrition');
			$table->string('metakeyword');
			$table->string('metadescription');
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
		Schema::drop('food_products');
	}

}
