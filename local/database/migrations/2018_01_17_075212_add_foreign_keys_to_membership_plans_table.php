<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMembershipPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('membership_plans', function(Blueprint $table)
		{
			$table->foreign('role_id')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('membership_plans', function(Blueprint $table)
		{
			$table->dropForeign('membership_plans_role_id_foreign');
		});
	}

}
