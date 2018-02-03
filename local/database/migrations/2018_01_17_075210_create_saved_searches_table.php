<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSavedSearchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('saved_searches', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->integer('category_id')->nullable();
			$table->boolean('is_category_parent')->nullable();
			$table->text('keyword', 65535)->nullable();
			$table->text('name', 65535)->nullable();
			$table->string('city', 55)->nullable();
			$table->text('lat', 65535)->nullable();
			$table->text('lng', 65535)->nullable();
			$table->string('usr_state')->nullable();
			$table->string('usr_city')->nullable();
			$table->string('usr_pcode', 55)->nullable();
			$table->string('location');
			$table->integer('distance');
			$table->integer('email_frequency')->comment('1 - Immediately, 2 - Daily, 3 - Weekly, 4 - Never');
			$table->integer('defaultlocation')->default(0);
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
		Schema::drop('saved_searches');
	}

}
