<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuburbsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('suburbs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('city_id')->nullable()->index('city_id');
			$table->string('postcode', 5)->nullable();
			$table->string('suburb', 100)->nullable();
			$table->string('state', 4)->nullable();
			$table->decimal('latitude', 6, 3)->nullable();
			$table->decimal('longitude', 6, 3)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('suburbs');
	}

}
