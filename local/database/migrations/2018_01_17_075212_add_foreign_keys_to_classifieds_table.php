<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClassifiedsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('classifieds', function(Blueprint $table)
		{
			$table->foreign('user_id', 'classifieds_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('classifieds', function(Blueprint $table)
		{
			$table->dropForeign('classifieds_ibfk_1');
		});
	}

}
