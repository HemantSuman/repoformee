<?php

use Illuminate\Database\Seeder;

class FeedCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('feed_categories')->delete();
        
        \DB::table('feed_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'General',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'News',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Sports',
            ),
        ));
        
        
    }
}