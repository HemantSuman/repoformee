<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cities', function(Blueprint $table)
		{
			$table->integer('CityId', true);
			$table->smallInteger('CountryID');
			$table->smallInteger('RegionID');
			$table->string('City', 45);
			$table->float('Latitude', 10, 0);
			$table->float('Longitude', 10, 0);
			$table->string('TimeZone', 10);
			$table->smallInteger('DmaId')->nullable();
			$table->string('County', 25)->nullable();
			$table->string('Code', 4)->nullable();
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
		Schema::drop('cities');
	}

}
