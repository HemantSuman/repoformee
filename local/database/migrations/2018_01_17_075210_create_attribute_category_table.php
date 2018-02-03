<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributeCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_category', function(Blueprint $table)
		{
			$table->integer('category_id');
			$table->integer('attribute_id')->index('attribute_id');
			$table->integer('is_active')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attribute_category');
	}

}
