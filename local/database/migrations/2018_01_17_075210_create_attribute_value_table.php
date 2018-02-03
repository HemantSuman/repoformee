<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributeValueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_value', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('attribute_id')->index('attribute_id');
			$table->string('values');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attribute_value');
	}

}
