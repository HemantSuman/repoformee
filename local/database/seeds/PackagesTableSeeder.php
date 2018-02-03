<?php

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('packages')->delete();
        
        \DB::table('packages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'package_name' => 'Plus',
                'package_slug' => 'daily',
                'package_discription' => 'Plus description',
                'package_price' => '100.00',
                'number_image_upload' => 6,
                'duration' => 4,
                'classified_type' => 'premium',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => '2017-12-07 09:09:24',
            ),
            1 => 
            array (
                'id' => 2,
                'package_name' => 'Featured',
                'package_slug' => 'weekly',
                'package_discription' => 'Featured Description',
                'package_price' => '200.00',
                'number_image_upload' => 10,
                'duration' => 6,
                'classified_type' => 'featured',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => '2017-12-07 09:25:19',
            ),
            2 => 
            array (
                'id' => 3,
                'package_name' => 'Premium',
                'package_slug' => 'premium_weekly',
                'package_discription' => 'Show Ad on Premium Location on product listing.',
                'package_price' => '300.00',
                'number_image_upload' => 12,
                'duration' => 8,
                'classified_type' => 'premium',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => '2017-12-07 09:25:05',
            ),
        ));
        
        
    }
}