<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPromoCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('promo_codes', function(Blueprint $table)
		{
			$table->foreign('category_id')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('classified_id')->references('id')->on('classifieds')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('parent_categoryid')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('promo_codes', function(Blueprint $table)
		{
			$table->dropForeign('promo_codes_category_id_foreign');
			$table->dropForeign('promo_codes_classified_id_foreign');
			$table->dropForeign('promo_codes_parent_categoryid_foreign');
		});
	}

}
