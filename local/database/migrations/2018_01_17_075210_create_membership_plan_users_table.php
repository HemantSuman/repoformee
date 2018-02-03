<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembershipPlanUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('membership_plan_users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('membership_plan_users_user_id_foreign');
			$table->integer('membership_plan_id')->index('membership_plan_users_membership_plan_id_foreign');
			$table->string('plan_name');
			$table->string('plan_type');
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
			$table->string('number_image_upload');
			$table->integer('status')->default(0)->comment('0-deactive,1-active');
			$table->string('paypal_profile_id', 100);
			$table->string('paypal_profile_status', 100);
			$table->string('paypal_token_id', 100);
			$table->string('paypal_payer_id', 100);
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
		Schema::drop('membership_plan_users');
	}

}
