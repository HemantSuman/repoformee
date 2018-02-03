<?php

use Illuminate\Database\Seeder;

class TemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('templates')->delete();
        
        \DB::table('templates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'template_name' => 'Automotive',
                'template_slug' => 'auto',
                'default_child_listing_slug' => 'default_child_listing_all',
                'default_parent_listing_slug' => 'default_parent_listing_all',
                'default_detail_slug' => 'default_detail_all',
                'default_detail_preview_slug' => 'all',
                'template_type' => 'detail',
                'is_price_range' => 0,
                'is_inspection_date' => 0,
                'questions_answer' => 0,
                'status' => 1,
                'created_at' => '2017-12-13 19:16:46',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            1 => 
            array (
                'id' => 2,
                'template_name' => 'Jobs',
                'template_slug' => 'job',
                'default_child_listing_slug' => 'default_child_listing_job',
                'default_parent_listing_slug' => 'default_child_listing_job',
                'default_detail_slug' => 'default_detail_job',
                'default_detail_preview_slug' => 'job',
                'template_type' => 'detail',
                'is_price_range' => 0,
                'is_inspection_date' => 0,
                'questions_answer' => 1,
                'status' => 1,
                'created_at' => '2017-12-13 19:16:46',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            2 => 
            array (
                'id' => 3,
                'template_name' => 'RealEstate',
                'template_slug' => 'realestate',
                'default_child_listing_slug' => 'default_child_listing_realestate',
                'default_parent_listing_slug' => 'default_child_listing_realestate',
                'default_detail_slug' => 'default_detail_realestate',
                'default_detail_preview_slug' => 'realestate',
                'template_type' => 'detail',
                'is_price_range' => 1,
                'is_inspection_date' => 1,
                'questions_answer' => 0,
                'status' => 1,
                'created_at' => '2017-12-13 19:16:46',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            3 => 
            array (
                'id' => 4,
                'template_name' => 'HomeGarden',
                'template_slug' => 'homegarden',
                'default_child_listing_slug' => 'default_child_listing_all',
                'default_parent_listing_slug' => 'default_parent_listing_all',
                'default_detail_slug' => 'default_detail_all',
                'default_detail_preview_slug' => 'all',
                'template_type' => 'detail',
                'is_price_range' => 0,
                'is_inspection_date' => 0,
                'questions_answer' => 0,
                'status' => 1,
                'created_at' => '2017-12-13 19:16:46',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            4 => 
            array (
                'id' => 5,
                'template_name' => 'Services',
                'template_slug' => 'services',
                'default_child_listing_slug' => 'default_child_listing_all',
                'default_parent_listing_slug' => 'default_parent_listing_all',
                'default_detail_slug' => 'default_detail_all',
                'default_detail_preview_slug' => 'all',
                'template_type' => 'detail',
                'is_price_range' => 0,
                'is_inspection_date' => 0,
                'questions_answer' => 0,
                'status' => 1,
                'created_at' => '2017-12-13 19:16:46',
                'updated_at' => '0000-00-00 00:00:00',
            ),
        ));
        
        
    }
}