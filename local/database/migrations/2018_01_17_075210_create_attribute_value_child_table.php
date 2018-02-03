<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributeValueChildTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_value_child', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('attribute_id')->index('attribute_id');
			$table->integer('attribute_parent_id');
			$table->integer('attribute_value_id')->index('attribute_value_id');
			$table->string('attribute_value')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attribute_value_child');
	}

}
