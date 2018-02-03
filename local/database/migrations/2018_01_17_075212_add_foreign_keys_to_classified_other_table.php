<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClassifiedOtherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('classified_other', function(Blueprint $table)
		{
			$table->foreign('classified_id', 'classified_other_ibfk_1')->references('id')->on('classifieds')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('classified_other', function(Blueprint $table)
		{
			$table->dropForeign('classified_other_ibfk_1');
		});
	}

}
