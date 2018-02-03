<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertisementAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advertisement_attachments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('advertisement_id');
			$table->string('image');
			$table->string('url');
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
		Schema::drop('advertisement_attachments');
	}

}
