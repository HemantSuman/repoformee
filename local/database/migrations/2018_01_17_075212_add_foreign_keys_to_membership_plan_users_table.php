<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMembershipPlanUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('membership_plan_users', function(Blueprint $table)
		{
			$table->foreign('membership_plan_id')->references('id')->on('membership_plans')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('membership_plan_users', function(Blueprint $table)
		{
			$table->dropForeign('membership_plan_users_membership_plan_id_foreign');
			$table->dropForeign('membership_plan_users_user_id_foreign');
		});
	}

}
