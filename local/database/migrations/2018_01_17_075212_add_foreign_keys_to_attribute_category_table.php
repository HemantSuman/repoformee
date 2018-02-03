<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAttributeCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('attribute_category', function(Blueprint $table)
		{
			$table->foreign('attribute_id', 'attribute_category_ibfk_3')->references('id')->on('attributes')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attribute_category', function(Blueprint $table)
		{
			$table->dropForeign('attribute_category_ibfk_3');
		});
	}

}
