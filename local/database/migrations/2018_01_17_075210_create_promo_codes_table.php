<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePromoCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promo_codes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('parent_categoryid')->index('promo_codes_parent_categoryid_foreign');
			$table->integer('category_id')->index('promo_codes_category_id_foreign');
			$table->integer('classified_id')->index('promo_codes_classified_id_foreign');
			$table->date('start_date');
			$table->date('end_date');
			$table->string('discount_type');
			$table->string('discount_value');
			$table->string('promocode');
			$table->integer('status')->default(0)->comment('0-deactive,1-active');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('promo_codes');
	}

}
