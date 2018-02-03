<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplyJobTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apply_job', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('classified_id')->index('classified_id');
			$table->integer('receiver_id');
			$table->integer('customer_id')->index('user_id');
			$table->string('applicant_email', 200);
			$table->string('fname', 200);
			$table->string('lname', 200);
			$table->string('mobile', 50);
			$table->string('job_role_type', 50);
			$table->string('prev_job_title', 200);
			$table->string('prev_company', 200);
			$table->string('prev_job_start', 50);
			$table->boolean('cover_letter');
			$table->string('cover_letter_file', 200);
			$table->boolean('resume');
			$table->string('resume_file', 200);
			$table->string('application_status', 100);
			$table->text('sendmsg', 65535);
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
		Schema::drop('apply_job');
	}

}
