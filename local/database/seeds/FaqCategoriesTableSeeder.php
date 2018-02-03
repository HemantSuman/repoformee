<?php

use Illuminate\Database\Seeder;

class FaqCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('faq_categories')->delete();
        
        \DB::table('faq_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Posting an ad ',
                'created_at' => '2016-12-23 09:11:10',
                'updated_at' => '2016-12-23 09:11:10',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'REGISTRATION',
                'created_at' => '2016-12-23 09:12:01',
                'updated_at' => '2016-12-23 09:18:58',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'MY MESSAGES',
                'created_at' => '2016-12-23 09:12:34',
                'updated_at' => '2016-12-23 09:19:31',
            ),
        ));
        
        
    }
}