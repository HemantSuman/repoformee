<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassifiedsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classifieds', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->default(54)->index('user_id');
			$table->string('title');
			$table->string('product_code');
			$table->integer('parent_categoryid')->default(0);
			$table->integer('category_id')->default(0);
			$table->integer('package_user_id')->nullable();
			$table->integer('membership_plan_user_id')->nullable();
			$table->text('location', 65535);
			$table->integer('state_id')->default(0);
			$table->integer('city_id');
			$table->integer('subregions_id')->unsigned()->default(0)->index('subregions_id');
			$table->integer('suburbs_id');
			$table->string('pincode', 50);
			$table->string('contact_title', 50);
			$table->string('contact_name', 50);
			$table->string('contact_email', 50);
			$table->string('contact_mobile', 50);
			$table->text('website', 65535);
			$table->integer('price')->default(0);
			$table->integer('price_to');
			$table->integer('quantity')->default(1);
			$table->text('description', 65535);
			$table->boolean('featured_classified')->default(0);
			$table->dateTime('start_date')->nullable();
			$table->dateTime('end_date')->nullable();
			$table->integer('status')->default(0)->comment('0-deactive,1-active,2-unapproved,3-rejected,4-incomplete');
			$table->text('lat', 65535)->nullable();
			$table->text('lng', 65535)->nullable();
			$table->integer('count')->default(0);
			$table->integer('offer_count')->default(0);
			$table->integer('is_premium')->default(0);
			$table->integer('is_premium_parent_cat')->default(0);
			$table->integer('is_premium_sub_cat')->default(0);
			$table->string('price_type');
			$table->integer('min_offer_check')->default(0);
			$table->integer('minimum_price');
			$table->string('condition');
			$table->integer('pay_pal')->default(0);
			$table->integer('pic_n_pay')->default(0);
			$table->string('pick_address');
			$table->string('pick_city');
			$table->string('pick_country');
			$table->string('pick_state');
			$table->string('pick_zip');
			$table->string('pick_lat');
			$table->string('pick_lng');
			$table->integer('shipping')->default(0);
			$table->string('ship_name_1', 250)->nullable();
			$table->string('ship_name_2', 250)->nullable();
			$table->string('ship_name_3', 250)->nullable();
			$table->decimal('ship_amount_1', 10)->default(0.00);
			$table->decimal('ship_amount_2', 10)->default(0.00);
			$table->decimal('ship_amount_3', 10)->default(0.00);
			$table->text('product_description', 65535);
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
		Schema::drop('classifieds');
	}

}
