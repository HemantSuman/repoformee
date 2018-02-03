<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembershipPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('membership_plans', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('plan_name');
			$table->string('plan_type');
			$table->integer('role_id')->index('membership_plans_role_id_foreign');
			$table->decimal('plan_price', 10);
			$table->date('start_date');
			$table->date('end_date');
			$table->string('discount_type');
			$table->string('discount_value');
			$table->integer('is_job_post')->default(0);
			$table->integer('job_post_count')->default(0);
			$table->integer('is_featured_ads')->default(0);
			$table->string('featured_ads_type');
			$table->integer('featured_ads_count')->default(0);
			$table->integer('is_video')->default(0);
			$table->integer('is_youtube')->default(0);
			$table->integer('is_premium_parent_cat')->default(0);
			$table->integer('is_premium_sub_cat')->default(0);
			$table->integer('display_order')->default(1);
			$table->string('number_image_upload')->nullable();
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
		Schema::drop('membership_plans');
	}

}
