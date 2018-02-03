<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrayerTimingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prayer_timings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->boolean('is_default')->default(0);
			$table->boolean('status')->default(0);
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
		Schema::drop('prayer_timings');
	}

}
