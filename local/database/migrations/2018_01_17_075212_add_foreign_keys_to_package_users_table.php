<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPackageUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('package_users', function(Blueprint $table)
		{
			$table->foreign('package_id', 'package_users_ibfk_1')->references('id')->on('packages')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id', 'package_users_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('classified_id', 'package_users_ibfk_3')->references('id')->on('classifieds')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('package_users', function(Blueprint $table)
		{
			$table->dropForeign('package_users_ibfk_1');
			$table->dropForeign('package_users_ibfk_2');
			$table->dropForeign('package_users_ibfk_3');
		});
	}

}
