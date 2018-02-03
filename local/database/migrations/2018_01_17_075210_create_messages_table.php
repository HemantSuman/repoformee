<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('sender_id')->default(0);
			$table->integer('receiver_id')->default(0);
			$table->string('subject')->nullable();
			$table->text('massage', 65535)->nullable();
			$table->integer('classified_id')->default(0)->index('classified_id');
			$table->integer('offer_price')->default(0);
			$table->string('flag')->nullable();
			$table->integer('read_status')->nullable()->default(0)->comment('read -1, unread-0');
			$table->integer('deleted_by')->nullable()->default(0)->comment('deleted by user id ');
			$table->integer('deleted_at')->nullable()->default(1)->comment('1-active, 0-soft delete, 2-permanent delete');
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
		Schema::drop('messages');
	}

}
