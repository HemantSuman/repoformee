<?php

use Illuminate\Database\Seeder;

class FeedsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('feeds')->delete();
        
        \DB::table('feeds')->insert(array (
            0 => 
            array (
                'id' => 1,
                'feed_category_id' => 1,
                'news_type' => 'National',
                'title' => 'National News',
                'url' => 'http://www.news.com.au/national/rss',
                'status' => 1,
                'front_status' => 0,
                'created_at' => '2017-03-09 12:41:40',
                'updated_at' => '2017-03-09 12:41:40',
            ),
            1 => 
            array (
                'id' => 2,
                'feed_category_id' => 2,
                'news_type' => 'National',
                'title' => 'ABC News',
                'url' => 'http://www.abc.net.au/news/feed/45910/rss.xml',
                'status' => 1,
                'front_status' => 0,
                'created_at' => '2017-03-09 12:43:26',
                'updated_at' => '2017-03-09 12:43:26',
            ),
        ));
        
        
    }
}