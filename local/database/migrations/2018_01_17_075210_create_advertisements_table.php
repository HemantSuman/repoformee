<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertisementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advertisements', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 155);
			$table->integer('page_id');
			$table->integer('category_id')->nullable();
			$table->integer('subcategory_id')->nullable();
			$table->string('image');
			$table->string('image_url');
			$table->string('banner_position', 155)->nullable();
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
			$table->string('contact_email', 155)->nullable();
			$table->string('contact_number', 55)->nullable();
			$table->integer('order_no')->nullable();
			$table->boolean('is_default')->nullable()->default(0);
			$table->boolean('status');
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
		Schema::drop('advertisements');
	}

}
