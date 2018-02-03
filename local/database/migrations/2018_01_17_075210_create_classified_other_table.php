<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassifiedOtherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classified_other', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('classified_id')->index('classified_id');
			$table->string('other_title');
			$table->string('other_slug');
			$table->string('other_value');
			$table->string('image')->nullable();
			$table->string('url')->nullable();
			$table->string('content_type')->nullable();
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
		Schema::drop('classified_other');
	}

}
