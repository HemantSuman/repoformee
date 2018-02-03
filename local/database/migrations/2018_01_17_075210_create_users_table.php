<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->nullable();
			$table->string('fname', 55)->nullable()->default('');
			$table->string('lname', 55)->nullable();
			$table->string('email');
			$table->string('password');
			$table->string('image')->nullable();
			$table->string('remember_token');
			$table->text('verification_code', 65535);
			$table->integer('status');
			$table->string('_token', 250);
			$table->string('seller_type')->nullable()->comment('For front End- private or business');
			$table->string('social_id', 100)->nullable();
			$table->string('login_type', 50)->nullable();
			$table->integer('role_id')->nullable()->default(0);
			$table->string('mobile_no', 55)->nullable();
			$table->string('active_role_name', 55)->nullable();
			$table->text('location', 65535)->nullable();
			$table->string('state', 55)->nullable();
			$table->string('city', 55)->nullable();
			$table->string('phonecode', 55)->nullable();
			$table->string('country', 55)->nullable();
			$table->text('latitude', 65535)->nullable();
			$table->text('longitude', 65535)->nullable();
			$table->string('pincode', 55)->nullable();
			$table->boolean('is_notification_active')->nullable()->default(0);
			$table->boolean('is_survey_active')->nullable()->default(0);
			$table->boolean('is_invites_active')->nullable()->default(0);
			$table->boolean('is_newsletter_active')->nullable()->default(0);
			$table->string('new_requested_email')->nullable();
			$table->integer('new_requested_email_status')->nullable()->default(0);
			$table->string('email_updation_verification_code')->nullable();
			$table->timestamps();
			$table->string('avatar')->nullable();
			$table->text('device_id', 65535)->nullable();
			$table->string('device_model')->nullable()->default('NA');
			$table->string('device_type')->nullable()->default('NA');
			$table->string('os_version')->nullable()->default('NA');
			$table->string('network_provider')->nullable()->default('NA');
			$table->string('app_version_no')->nullable()->default('NA');
			$table->string('business_name')->nullable();
			$table->string('business_location')->nullable();
			$table->string('business_state_id')->nullable();
			$table->string('business_city_id')->nullable();
			$table->string('business_pincode')->nullable();
			$table->text('business_lat', 65535)->nullable();
			$table->text('business_lng', 65535)->nullable();
			$table->string('paypal_email', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
