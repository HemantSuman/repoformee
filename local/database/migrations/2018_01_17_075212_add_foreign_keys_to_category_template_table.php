<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCategoryTemplateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('category_template', function(Blueprint $table)
		{
			$table->foreign('template_id', 'category_template_ibfk_1')->references('id')->on('templates')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('category_id', 'category_template_ibfk_2')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('category_template', function(Blueprint $table)
		{
			$table->dropForeign('category_template_ibfk_1');
			$table->dropForeign('category_template_ibfk_2');
		});
	}

}
