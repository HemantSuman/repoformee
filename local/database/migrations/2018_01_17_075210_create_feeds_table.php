<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeedsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feeds', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('feed_category_id');
			$table->string('news_type');
			$table->string('title', 60);
			$table->string('url', 155);
			$table->boolean('status')->comment('0 - Inactive, 1 - Active');
			$table->boolean('front_status')->default(0)->comment('0 - Inactive, 1 - Active');
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
		Schema::drop('feeds');
	}

}
