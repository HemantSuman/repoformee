<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsletterSubscribersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newsletter_subscribers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('newsletter_id');
			$table->string('email', 155);
			$table->boolean('status')->default(1);
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('modified_at')->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('newsletter_subscribers');
	}

}
