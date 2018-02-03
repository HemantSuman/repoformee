<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCategoryRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('category_role', function(Blueprint $table)
		{
			$table->foreign('category_id', 'category_roles_category_id_foreign')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('role_id', 'category_roles_role_id_foreign')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('category_role', function(Blueprint $table)
		{
			$table->dropForeign('category_roles_category_id_foreign');
			$table->dropForeign('category_roles_role_id_foreign');
		});
	}

}
