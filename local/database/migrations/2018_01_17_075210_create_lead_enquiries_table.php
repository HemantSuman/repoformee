<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeadEnquiriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lead_enquiries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('receiver_id');
			$table->integer('classified_id')->index('classified_id');
			$table->string('name', 250);
			$table->string('email', 250);
			$table->string('phone', 100);
			$table->text('message', 65535);
			$table->string('status', 100)->default('Open');
			$table->text('lead_content', 65535);
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
		Schema::drop('lead_enquiries');
	}

}
