<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQueryRespondsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('query_responds', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('query_id');
			$table->integer('user_id')->default(0);
			$table->integer('asked_by')->default(0);
			$table->text('respond', 65535);
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
		Schema::drop('query_responds');
	}

}
