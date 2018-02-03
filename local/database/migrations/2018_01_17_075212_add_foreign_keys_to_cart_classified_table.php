<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCartClassifiedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cart_classified', function(Blueprint $table)
		{
			$table->foreign('classified_id', 'cart_classified_ibfk_2')->references('id')->on('classifieds')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('cart_id', 'cart_classified_ibfk_3')->references('id')->on('cart')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cart_classified', function(Blueprint $table)
		{
			$table->dropForeign('cart_classified_ibfk_2');
			$table->dropForeign('cart_classified_ibfk_3');
		});
	}

}
