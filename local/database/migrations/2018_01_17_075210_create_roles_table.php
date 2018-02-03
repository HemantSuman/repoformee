<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->unique();
			$table->string('role_type')->default('admin');
			$table->string('role_slug')->default('admin');
			$table->string('seller_type')->default('admin');
			$table->integer('is_merchant')->default(0);
			$table->integer('status')->default(0);
			$table->dateTime('add_date');
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
		Schema::drop('roles');
	}

}
