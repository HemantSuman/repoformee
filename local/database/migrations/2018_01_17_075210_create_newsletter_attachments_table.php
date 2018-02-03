<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsletterAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newsletter_attachments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('newsletter_id');
			$table->string('image');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('newsletter_attachments');
	}

}
