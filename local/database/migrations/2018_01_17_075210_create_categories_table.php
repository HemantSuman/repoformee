<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pid')->default(0);
			$table->string('name')->default('');
			$table->text('description', 65535);
			$table->string('icon')->default('');
			$table->string('image')->default('');
			$table->boolean('belong_to_community')->default(0);
			$table->boolean('accessible_to_users')->default(0);
			$table->boolean('show_on_info_area');
			$table->boolean('show_static_attributes');
			$table->integer('status')->default(0);
			$table->integer('feactured')->nullable();
			$table->string('overlay_colour', 50)->nullable();
			$table->integer('order_no')->nullable();
			$table->string('metakeyword');
			$table->string('metadescription');
			$table->timestamps();
			$table->integer('is_sellable')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
