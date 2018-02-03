<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSuburbsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('suburbs', function(Blueprint $table)
		{
			$table->foreign('city_id', 'suburbs_ibfk_1')->references('CityId')->on('cities')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('suburbs', function(Blueprint $table)
		{
			$table->dropForeign('suburbs_ibfk_1');
		});
	}

}
