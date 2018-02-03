<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLeadEnquiriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('lead_enquiries', function(Blueprint $table)
		{
			$table->foreign('classified_id', 'lead_enquiries_ibfk_1')->references('id')->on('classifieds')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('lead_enquiries', function(Blueprint $table)
		{
			$table->dropForeign('lead_enquiries_ibfk_1');
		});
	}

}
