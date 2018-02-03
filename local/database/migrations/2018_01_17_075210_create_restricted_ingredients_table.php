<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestrictedIngredientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('restricted_ingredients', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->string('certification');
			$table->integer('status')->default(0)->comment('0-deactive,1-active');
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
		Schema::drop('restricted_ingredients');
	}

}
