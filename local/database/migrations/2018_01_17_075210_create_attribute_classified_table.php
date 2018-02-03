<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributeClassifiedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_classified', function(Blueprint $table)
		{
			$table->integer('attribute_id')->index('attribute_id');
			$table->integer('classified_id')->default(0)->index('classified_id');
			$table->integer('food_product_id')->default(0);
			$table->string('attr_value');
			$table->integer('attr_type_id')->default(0);
			$table->string('attr_type_name')->default('');
			$table->integer('parent_value_id')->default(0);
			$table->integer('parent_attribute_id')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attribute_classified');
	}

}
