<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributeGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_group', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('attribute_id')->index('attribute_id');
			$table->integer('group_id')->index('group_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attribute_group');
	}

}
