<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClassifiedimageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('classifiedimage', function(Blueprint $table)
		{
			$table->foreign('classified_id', 'classifiedimage_ibfk_1')->references('id')->on('classifieds')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('classifiedimage', function(Blueprint $table)
		{
			$table->dropForeign('classifiedimage_ibfk_1');
		});
	}

}
