<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQueriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('queries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('type', 25)->comment('inbox, support_query');
			$table->string('name', 60);
			$table->string('email', 65);
			$table->string('image');
			$table->text('contact_query', 65535);
			$table->boolean('status')->default(0)->comment('0 -> Unseen, 1 -> Seen');
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
		Schema::drop('queries');
	}

}
