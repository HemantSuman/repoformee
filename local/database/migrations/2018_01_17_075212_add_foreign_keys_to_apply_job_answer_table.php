<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToApplyJobAnswerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('apply_job_answer', function(Blueprint $table)
		{
			$table->foreign('classified_id', 'apply_job_answer_ibfk_1')->references('id')->on('classifieds')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('customer_id', 'apply_job_answer_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('apply_job_id', 'apply_job_answer_ibfk_3')->references('id')->on('apply_job')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('question_id', 'apply_job_answer_ibfk_4')->references('id')->on('questions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('apply_job_answer', function(Blueprint $table)
		{
			$table->dropForeign('apply_job_answer_ibfk_1');
			$table->dropForeign('apply_job_answer_ibfk_2');
			$table->dropForeign('apply_job_answer_ibfk_3');
			$table->dropForeign('apply_job_answer_ibfk_4');
		});
	}

}
