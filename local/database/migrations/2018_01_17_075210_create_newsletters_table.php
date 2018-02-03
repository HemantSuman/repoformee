<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewslettersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newsletters', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 155);
			$table->text('body', 65535);
			$table->text('recipients', 65535);
			$table->string('type', 25)->nullable()->comment('HTML Template/ Plain');
			$table->text('newsletter_template_id', 65535)->nullable();
			$table->integer('no_of_reciepents');
			$table->integer('no_of_unsubscribers');
			$table->date('timer')->nullable();
			$table->boolean('is_default_template')->nullable();
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
		Schema::drop('newsletters');
	}

}
