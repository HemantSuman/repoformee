<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAttributeValueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('attribute_value', function(Blueprint $table)
		{
			$table->foreign('attribute_id', 'attribute_value_ibfk_3')->references('id')->on('attributes')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attribute_value', function(Blueprint $table)
		{
			$table->dropForeign('attribute_value_ibfk_3');
		});
	}

}
