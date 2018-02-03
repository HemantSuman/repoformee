<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 54,
                'name' => 'Ammar Rana',
                'fname' => 'Ammar',
                'lname' => 'Rana',
                'email' => 'ammar.rana@scei.edu.au',
                'password' => '$2y$10$RYkNOe5fqvg/tMfXB2Zk6eVbKHOcFd3GWsOTRYubVSOzzJPauCBUO',
                'image' => '',
                'remember_token' => 'tSuKECcfQHCRIhR9C6us5p5qP7QgR7MklkoUYvoJlWYfrgbatPna7ZSdTFvN',
                'verification_code' => 'Bmnxd0WeZFhTI99tLfIuQaq7bnMarP',
                'status' => 1,
                '_token' => '2yLrrQlQw4g4CL2T55pNrcPMN2SDIqqPUOme7iqQ',
                'seller_type' => NULL,
                'social_id' => '114176289689117228895',
                'login_type' => 'gmail',
                'role_id' => 2,
                'mobile_no' => '9785864055',
                'active_role_name' => 'admin',
                'location' => 'Planet Street, Carlisle, Western Australia, Australia',
                'state' => 'Western Australia',
                'city' => 'Carlisle',
                'phonecode' => NULL,
                'country' => NULL,
                'latitude' => NULL,
                'longitude' => NULL,
                'pincode' => '6101',
                'is_notification_active' => 1,
                'is_survey_active' => 1,
                'is_invites_active' => 1,
                'is_newsletter_active' => 1,
                'new_requested_email' => NULL,
                'new_requested_email_status' => 0,
                'email_updation_verification_code' => NULL,
                'created_at' => '2017-02-08 10:12:38',
                'updated_at' => '2018-01-10 06:11:03',
                'avatar' => 'https://lh6.googleusercontent.com/-30QR6rN2Iqc/AAAAAAAAAAI/AAAAAAAAAK0/MN1uoO7yiRc/photo.jpg?sz=50',
                'device_id' => '',
                'device_model' => '',
                'device_type' => '',
                'os_version' => '',
                'network_provider' => '',
                'app_version_no' => '',
                'business_name' => NULL,
                'business_location' => NULL,
                'business_state_id' => NULL,
                'business_city_id' => NULL,
                'business_pincode' => NULL,
                'business_lat' => NULL,
                'business_lng' => NULL,
                'paypal_email' => NULL,
            ),
        ));
        
        
    }
}