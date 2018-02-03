<?php

use Illuminate\Database\Seeder;

class NewsletterAttachmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('newsletter_attachments')->delete();
        
        \DB::table('newsletter_attachments')->insert(array (
            0 => 
            array (
                'id' => 4,
                'newsletter_id' => 5,
                'image' => '26613.jpg',
            ),
            1 => 
            array (
                'id' => 5,
                'newsletter_id' => 6,
                'image' => '92849.jpg',
            ),
            2 => 
            array (
                'id' => 6,
                'newsletter_id' => 7,
                'image' => '95894.jpg',
            ),
            3 => 
            array (
                'id' => 7,
                'newsletter_id' => 8,
                'image' => '67816.jpg',
            ),
            4 => 
            array (
                'id' => 8,
                'newsletter_id' => 9,
                'image' => '32619.jpg',
            ),
        ));
        
        
    }
}