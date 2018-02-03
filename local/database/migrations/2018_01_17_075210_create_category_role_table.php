<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_role', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('role_id')->index('role_id');
			$table->integer('category_id')->index('category_id');
			$table->integer('pid');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category_role');
	}

}
