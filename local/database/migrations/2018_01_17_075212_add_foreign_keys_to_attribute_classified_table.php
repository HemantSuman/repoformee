<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAttributeClassifiedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('attribute_classified', function(Blueprint $table)
		{
			$table->foreign('attribute_id', 'attribute_classified_ibfk_3')->references('id')->on('attributes')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attribute_classified', function(Blueprint $table)
		{
			$table->dropForeign('attribute_classified_ibfk_3');
		});
	}

}
