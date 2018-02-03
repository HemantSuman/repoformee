<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('options', function(Blueprint $table)
		{
			$table->foreign('classified_id', 'options_ibfk_1')->references('id')->on('classifieds')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('question_id', 'options_ibfk_2')->references('id')->on('questions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('options', function(Blueprint $table)
		{
			$table->dropForeign('options_ibfk_1');
			$table->dropForeign('options_ibfk_2');
		});
	}

}
