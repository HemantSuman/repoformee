<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAttributeValueChildTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('attribute_value_child', function(Blueprint $table)
		{
			$table->foreign('attribute_id', 'attribute_value_child_ibfk_5')->references('id')->on('attributes')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('attribute_value_id', 'attribute_value_child_ibfk_6')->references('id')->on('attribute_value')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('attribute_value_id', 'attribute_value_child_ibfk_7')->references('id')->on('attribute_value')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('attribute_id', 'attribute_value_child_ibfk_8')->references('id')->on('attributes')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attribute_value_child', function(Blueprint $table)
		{
			$table->dropForeign('attribute_value_child_ibfk_5');
			$table->dropForeign('attribute_value_child_ibfk_6');
			$table->dropForeign('attribute_value_child_ibfk_7');
			$table->dropForeign('attribute_value_child_ibfk_8');
		});
	}

}
