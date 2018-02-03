<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubregionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subregions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('region_id')->unsigned()->nullable()->index('subregion_region_id');
			$table->string('name', 45)->nullable();
			$table->string('timezone', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subregions');
	}

}
