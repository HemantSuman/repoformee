<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePackagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('packages', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('package_name');
			$table->string('package_slug');
			$table->text('package_discription', 65535);
			$table->decimal('package_price', 10);
			$table->integer('number_image_upload')->nullable();
			$table->integer('duration')->nullable();
			$table->string('classified_type')->nullable();
			$table->integer('status')->default(0)->comment('0-deactive,1-active');
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
		Schema::drop('packages');
	}

}
