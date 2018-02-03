<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('templates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('template_name');
			$table->string('template_slug', 50);
			$table->string('default_child_listing_slug', 50);
			$table->string('default_parent_listing_slug', 50);
			$table->string('default_detail_slug', 50);
			$table->string('default_detail_preview_slug', 50);
			$table->string('template_type', 50);
			$table->integer('is_price_range')->default(0);
			$table->integer('is_inspection_date')->default(0);
			$table->integer('questions_answer')->default(0);
			$table->integer('status')->default(1);
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
		Schema::drop('templates');
	}

}
