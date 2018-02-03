<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToApplyJobTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('apply_job', function(Blueprint $table)
		{
			$table->foreign('classified_id', 'apply_job_ibfk_1')->references('id')->on('classifieds')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('customer_id', 'apply_job_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('apply_job', function(Blueprint $table)
		{
			$table->dropForeign('apply_job_ibfk_1');
			$table->dropForeign('apply_job_ibfk_2');
		});
	}

}
