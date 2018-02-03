<?php

use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('faqs')->delete();
        
        \DB::table('faqs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'faq_category_id' => 1,
                'question' => 'How do I post an ad?',
                'answer' => '<title></title>
<p style="box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; outline: 0px; line-height: 22px; color: rgb(24, 24, 24); font-family: Lato, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><a href="http://google.com">http://google.com</a>Posting ads to Locanto is quick, easy and free. Just click the &ldquo;Post free ad&rdquo; button in the top-right corner of the page and then follow the subsequent instructions.</p>

<p style="box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; outline: 0px; line-height: 22px; color: rgb(24, 24, 24); font-family: Lato, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">An ad should include a convincing title and a detailed description. You can upload up to 20 images to your ad. If you don&#39;t have a Locanto account yet, be sure to confirm your email address so that your ad can be brought online.</p>
',
                'created_at' => '2017-04-24 18:26:45',
                'updated_at' => '2017-04-24 12:56:45',
            ),
            1 => 
            array (
                'id' => 2,
                'faq_category_id' => 1,
                'question' => 'Can I use HTML tags or URLs in my ads?',
                'answer' => '<title></title>
<p><span style="color: rgb(24, 24, 24); font-family: Lato, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);"><a href="http://google.com">http://google.com</a>Locanto allows HTML (limited) and linkable URLs in ads on the site. However, if your ad only consists of links it will not be accepted. Furthermore, you are not allowed to link to other classifieds sites, even if it is only to bring attention to another ad.</span></p>
',
                'created_at' => '2017-04-24 18:26:56',
                'updated_at' => '2017-04-24 12:56:56',
            ),
            2 => 
            array (
                'id' => 3,
                'faq_category_id' => 2,
                'question' => 'How do I post an ad?',
                'answer' => '<title></title>
<p style="box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; outline: 0px; line-height: 22px; color: rgb(24, 24, 24); font-family: Lato, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><a href="http://google.com">http://google.com</a>Posting ads to Locanto is quick, easy and free. Just click the &ldquo;Post free ad&rdquo; button in the top-right corner of the page and then follow the subsequent instructions.</p>

<p style="box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; outline: 0px; line-height: 22px; color: rgb(24, 24, 24); font-family: Lato, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">An ad should include a convincing title and a detailed description. You can upload up to 20 images to your ad. If you don&#39;t have a Locanto account yet, be sure to confirm your email address so that your ad can be brought online.</p>
',
                'created_at' => '2017-04-24 18:27:06',
                'updated_at' => '2017-04-24 12:57:06',
            ),
            3 => 
            array (
                'id' => 4,
                'faq_category_id' => 3,
                'question' => ' How do I post an ad?',
                'answer' => '<title></title>
<p style="box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; outline: 0px; line-height: 22px; color: rgb(24, 24, 24); font-family: Lato, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><a href="http://google.com">http://google.com</a>Posting ads to Locanto is quick, easy and free. Just click the &ldquo;Post free ad&rdquo; button in the top-right corner of the page and then follow the subsequent instructions.</p>

<p style="box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; outline: 0px; line-height: 22px; color: rgb(24, 24, 24); font-family: Lato, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">An ad should include a convincing title and a detailed description. You can upload up to 20 images to your ad. If you don&#39;t have a Locanto account yet, be sure to confirm your email address so that your ad can be brought online.</p>
',
                'created_at' => '2017-04-24 18:27:16',
                'updated_at' => '2017-04-24 12:57:16',
            ),
            4 => 
            array (
                'id' => 5,
                'faq_category_id' => 2,
                'question' => 'Can I use HTML tags or URLs in my ads?',
                'answer' => '<title></title>
<p><span style="color: rgb(24, 24, 24); font-family: Lato, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);"><a href="http://google.com">http://google.com</a>Locanto allows HTML (limited) and linkable URLs in ads on the site. However, if your ad only consists of links it will not be accepted. Furthermore, you are not allowed to link to other classifieds sites, even if it is only to bring attention to another ad.</span></p>
',
                'created_at' => '2017-04-24 18:27:33',
                'updated_at' => '2017-04-24 12:57:33',
            ),
            5 => 
            array (
                'id' => 6,
                'faq_category_id' => 3,
                'question' => 'Can I use HTML tags or URLs in my ads?',
                'answer' => '<title></title>
<p><span style="color: rgb(24, 24, 24); font-family: Lato, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);"><a href="http://google.com">http://google.com</a>Locanto allows HTML (limited) and linkable URLs in ads on the site. However, if your ad only consists of links it will not be accepted. Furthermore, you are not allowed to link to other classifieds sites, even if it is only to bring attention to another ad.</span></p>
',
                'created_at' => '2017-04-24 18:27:42',
                'updated_at' => '2017-04-24 12:57:42',
            ),
            6 => 
            array (
                'id' => 9,
                'faq_category_id' => 3,
                'question' => 'test',
                'answer' => '<p><a href="http://google.com">http://google.com</a></p>
<title></title>
<p>&nbsp;</p>
',
                'created_at' => '2017-04-24 18:27:52',
                'updated_at' => '2017-04-24 12:57:52',
            ),
            7 => 
            array (
                'id' => 10,
                'faq_category_id' => 3,
                'question' => 'test',
                'answer' => '<p><a href="http://google.com">http://google.com</a></p>
<title></title>
<p>&nbsp;</p>
',
                'created_at' => '2017-04-24 18:28:00',
                'updated_at' => '2017-04-24 12:58:00',
            ),
            8 => 
            array (
                'id' => 11,
                'faq_category_id' => 2,
                'question' => 'test pws',
                'answer' => '<p><a href="http://google.com">http://google.com</a>ans</p>
',
                'created_at' => '2017-04-24 18:28:10',
                'updated_at' => '2017-04-24 12:58:10',
            ),
        ));
        
        
    }
}