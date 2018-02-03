<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplyJobAnswerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apply_job_answer', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('classified_id')->index('classified_id');
			$table->integer('customer_id')->index('customer_id');
			$table->integer('apply_job_id')->index('apply_job_id');
			$table->integer('question_id')->index('question_id');
			$table->text('answer', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('apply_job_answer');
	}

}
