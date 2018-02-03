<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function(Blueprint $table)
		{
			$table->smallInteger('CountryId', true);
			$table->string('Country', 50);
			$table->string('FIPS104', 2);
			$table->string('ISO2', 2);
			$table->string('ISO3', 3);
			$table->string('ISON', 4);
			$table->string('Internet', 2);
			$table->string('Capital', 25)->nullable();
			$table->string('MapReference', 50)->nullable();
			$table->string('NationalitySingular', 35)->nullable();
			$table->string('NationalityPlural', 35)->nullable();
			$table->string('Currency', 30)->nullable();
			$table->string('CurrencyCode', 3)->nullable();
			$table->bigInteger('Population')->nullable();
			$table->string('Title', 50)->nullable();
			$table->string('Comment')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('countries');
	}

}
