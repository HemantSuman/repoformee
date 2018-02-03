<?php

use Illuminate\Database\Seeder;

class NewslettersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('newsletters')->delete();
        
        \DB::table('newsletters')->insert(array (
            0 => 
            array (
                'id' => 5,
                'title' => 'Amazon',
            'body' => '<p><b>Amazon.com</b>&nbsp;(<a href="https://en.wikipedia.org/wiki/Help:IPA_for_English" title="Help:IPA for English">/?&aelig;m?z?n/</a>&nbsp;or&nbsp;<a href="https://en.wikipedia.org/wiki/Help:IPA_for_English" title="Help:IPA for English">/?&aelig;m?z?n/</a>), also called&nbsp;<b>Amazon</b>, is an American&nbsp;<a href="https://en.wikipedia.org/wiki/E-commerce" title="E-commerce">electronic commerce</a>&nbsp;and&nbsp;<a href="https://en.wikipedia.org/wiki/Cloud_computing" title="Cloud computing">cloud computing</a>company that was founded on July 5, 1994, by&nbsp;<a href="https://en.wikipedia.org/wiki/Jeff_Bezos" title="Jeff Bezos">Jeff Bezos</a>&nbsp;and is based in&nbsp;<a href="https://en.wikipedia.org/wiki/Seattle" title="Seattle">Seattle</a>,&nbsp;<a href="https://en.wikipedia.org/wiki/Washington_(state)" title="Washington (state)">Washington</a>. It is the largest Internet-based retailer in the world by total sales and market capitalization.<sup id="cite_ref-15"><a href="https://en.wikipedia.org/wiki/Amazon.com#cite_note-15">[15]</a></sup>&nbsp;Amazon.com started as an online&nbsp;<a href="https://en.wikipedia.org/wiki/Bookstore" title="Bookstore">bookstore</a>, later diversifying to sell&nbsp;<a href="https://en.wikipedia.org/wiki/DVD" title="DVD">DVDs</a>,&nbsp;<a href="https://en.wikipedia.org/wiki/Blu-ray" title="Blu-ray">Blu-rays</a>,&nbsp;<a href="https://en.wikipedia.org/wiki/Compact_Disc" title="Compact Disc">CDs</a>,&nbsp;<a href="https://en.wikipedia.org/wiki/Amazon_Video" title="Amazon Video">video</a>&nbsp;downloads/streaming,&nbsp;<a href="https://en.wikipedia.org/wiki/MP3" title="MP3">MP3</a>&nbsp;downloads/streaming,&nbsp;<a href="https://en.wikipedia.org/wiki/Audible.com" title="Audible.com">audiobook</a>downloads/streaming,&nbsp;<a href="https://en.wikipedia.org/wiki/Software" title="Software">software</a>,&nbsp;<a href="https://en.wikipedia.org/wiki/Video_game" title="Video game">video games</a>,&nbsp;<a href="https://en.wikipedia.org/wiki/Consumer_electronics" title="Consumer electronics">electronics</a>, apparel, furniture, food, toys, and jewelry. The company also produces&nbsp;<a href="https://en.wikipedia.org/wiki/Consumer_electronics" title="Consumer electronics">consumer electronics</a>&mdash;notably,&nbsp;<a href="https://en.wikipedia.org/wiki/Amazon_Kindle" title="Amazon Kindle">Kindle</a>&nbsp;<a href="https://en.wikipedia.org/wiki/E-reader" title="E-reader">e-readers</a>,&nbsp;<a href="https://en.wikipedia.org/wiki/Kindle_Fire" title="Kindle Fire">Fire</a>&nbsp;<a href="https://en.wikipedia.org/wiki/Tablet_computer" title="Tablet computer">tablets</a>,&nbsp;<a href="https://en.wikipedia.org/wiki/Fire_TV" title="Fire TV">Fire TV</a>, and&nbsp;<a href="https://en.wikipedia.org/wiki/Amazon_Echo" title="Amazon Echo">Echo</a>&mdash;and is the world&#39;s largest provider of&nbsp;<a href="https://en.wikipedia.org/wiki/Cloud_infrastructure" title="Cloud infrastructure">cloud infrastructure</a>&nbsp;services (IaaS and PaaS).<sup id="cite_ref-16"><a href="https://en.wikipedia.org/wiki/Amazon.com#cite_note-16">[16]</a></sup>&nbsp;Amazon also sells certain low-end products like USB cables under its in-house brand AmazonBasics.</p>

<p>Amazon has separate retail websites for the United States, the United Kingdom, Ireland, France, Canada, Germany, Italy, Spain, Netherlands, Australia, Brazil, Japan, China, India, and Mexico. Amazon also offers international shipping to certain other countries for some of its products.<sup id="cite_ref-Amazon.com-Jan-2013-10-K_17-0"><a href="https://en.wikipedia.org/wiki/Amazon.com#cite_note-Amazon.com-Jan-2013-10-K-17">[17]</a></sup>&nbsp;In 2016, Dutch, Polish, and Turkish language versions of the German Amazon website were launched.<sup id="cite_ref-18"><a href="https://en.wikipedia.org/wiki/Amazon.com#cite_note-18">[18]</a></sup><sup id="cite_ref-19"><a href="https://en.wikipedia.org/wiki/Amazon.com#cite_note-19">[19]</a></sup><sup id="cite_ref-20"><a href="https://en.wikipedia.org/wiki/Amazon.com#cite_note-20">[20]</a></sup></p>

<p>In 2015, Amazon surpassed&nbsp;<a href="https://en.wikipedia.org/wiki/Walmart" title="Walmart">Walmart</a>&nbsp;as the most valuable retailer in the United States by&nbsp;<a href="https://en.wikipedia.org/wiki/Market_capitalization" title="Market capitalization">market capitalization</a>,<sup id="cite_ref-NYtimes-bruising_21-0"><a href="https://en.wikipedia.org/wiki/Amazon.com#cite_note-NYtimes-bruising-21">[21]</a></sup>&nbsp;and was in the third quarter of 2016 the&nbsp;<a href="https://en.wikipedia.org/wiki/List_of_public_corporations_by_market_capitalization#Publicly_traded_companies" title="List of public corporations by market capitalization">fourth most valuable public company</a>.<sup id="cite_ref-22"><a href="https://en.wikipedia.org/wiki/Amazon.com#cite_note-22">[22]</a></sup></p>
',
                'recipients' => 'avnet@mailinator.com,q@mailinator.com',
                'type' => 'plain',
                'newsletter_template_id' => NULL,
                'no_of_reciepents' => 2,
                'no_of_unsubscribers' => 0,
                'timer' => '2017-04-17',
                'is_default_template' => 0,
                'created_at' => '2017-04-17 09:31:19',
                'updated_at' => '2017-04-17 09:31:19',
            ),
            1 => 
            array (
                'id' => 6,
                'title' => 'Flipkart',
            'body' => '<p><b>Flipkart</b>&nbsp;is an&nbsp;<a href="https://en.wikipedia.org/wiki/Electronic_commerce" title="Electronic commerce">electronic commerce</a>&nbsp;company headquartered in&nbsp;<a href="https://en.wikipedia.org/wiki/Bangalore,_Karnataka" title="Bangalore, Karnataka">Bangalore, Karnataka</a>. It was founded in 2007 by&nbsp;<a href="https://en.wikipedia.org/wiki/Sachin_Bansal" title="Sachin Bansal">Sachin Bansal</a>&nbsp;and&nbsp;<a href="https://en.wikipedia.org/wiki/Binny_Bansal" title="Binny Bansal">Binny Bansal</a>&nbsp;(no relation). The company is registered in Singapore.<sup id="cite_ref-4"><a href="https://en.wikipedia.org/wiki/Flipkart#cite_note-4">[4]</a></sup><sup id="cite_ref-5"><a href="https://en.wikipedia.org/wiki/Flipkart#cite_note-5">[5]</a></sup><sup id="cite_ref-6"><a href="https://en.wikipedia.org/wiki/Flipkart#cite_note-6">[6]</a></sup>&nbsp;Flipkart has launched its own product range under the name &quot;DigiFlip&quot; with products including tablets, USBs, and laptop bags.<sup id="cite_ref-7"><a href="https://en.wikipedia.org/wiki/Flipkart#cite_note-7">[7]</a></sup><sup id="cite_ref-8"><a href="https://en.wikipedia.org/wiki/Flipkart#cite_note-8">[8]</a></sup><sup id="cite_ref-9"><a href="https://en.wikipedia.org/wiki/Flipkart#cite_note-9">[9]</a></sup>&nbsp;As of April 2017, the company was valued at $11.6 billion</p>
',
                'recipients' => 'roopal.goyal@planetwebsolution.com,q@mailinator.com',
                'type' => 'plain',
                'newsletter_template_id' => NULL,
                'no_of_reciepents' => 2,
                'no_of_unsubscribers' => 0,
                'timer' => '2017-04-17',
                'is_default_template' => 0,
                'created_at' => '2017-04-17 09:32:59',
                'updated_at' => '2017-04-17 15:11:31',
            ),
            2 => 
            array (
                'id' => 7,
                'title' => 'Paytm',
                'body' => '<p><em>Paytm</em>&nbsp;is India&#39;s largest mobile payments and commerce platform. It started with online mobile recharge and bill payments and has an online marketplace today.</p>
',
                'recipients' => 'ravindra.yadav@planetwebsolution.com,avnet@mailinator.com,q@mailinator.com',
                'type' => 'plain',
                'newsletter_template_id' => NULL,
                'no_of_reciepents' => 3,
                'no_of_unsubscribers' => 0,
                'timer' => '2017-04-17',
                'is_default_template' => 0,
                'created_at' => '2017-04-17 09:34:31',
                'updated_at' => '2017-04-17 09:34:31',
            ),
            3 => 
            array (
                'id' => 8,
                'title' => 'Free recharge',
                'body' => '<p><b>FreeCharge</b>&nbsp;is an&nbsp;<a href="https://en.wikipedia.org/wiki/E-commerce" title="E-commerce">e-commerce</a>&nbsp;website headquartered in&nbsp;<a href="https://en.wikipedia.org/wiki/Mumbai" title="Mumbai">Mumbai, Maharashtra</a>. It provides&nbsp;<a href="https://en.wikipedia.org/wiki/Online_transactions" title="Online transactions">online</a>&nbsp;facility to recharge any<a href="https://en.wikipedia.org/wiki/Prepaid_mobile_phone" title="Prepaid mobile phone">prepaid mobile phone</a>,&nbsp;<a href="https://en.wikipedia.org/wiki/Postpaid_mobile" title="Postpaid mobile">postpaid mobile</a>,&nbsp;<a href="https://en.wikipedia.org/wiki/Direct-broadcast_satellite_television" title="Direct-broadcast satellite television">DTH</a>&nbsp;&amp;&nbsp;<a href="https://en.wikipedia.org/wiki/Mobile_broadband_modem" title="Mobile broadband modem">Data Cards</a>&nbsp;in India. On 8 April 2015,&nbsp;<a href="https://en.wikipedia.org/wiki/Snapdeal" title="Snapdeal">Snapdeal</a>&nbsp;acquired Freecharge in what is being referred to as the second biggest take over in the Indian e-commerce sector so far, after the buy out of&nbsp;<a href="https://en.wikipedia.org/wiki/Ibibo" title="Ibibo">Ibibo</a>&nbsp;by rival<a href="https://en.wikipedia.org/wiki/MakeMyTrip" title="MakeMyTrip">MakeMyTrip</a>, and the biggest Venture Capital exit in India to date. According to&nbsp;<i><a href="https://en.wikipedia.org/wiki/The_Economic_Times" title="The Economic Times">The Economic Times</a></i>, the deal is expected to be anything around US$400 to US$450 million.<sup id="cite_ref-1"><a href="https://en.wikipedia.org/wiki/FreeCharge#cite_note-1">[1]</a></sup></p>
',
                'recipients' => 'roopal.goyal@planetwebsolution.com',
                'type' => 'plain',
                'newsletter_template_id' => NULL,
                'no_of_reciepents' => 1,
                'no_of_unsubscribers' => 0,
                'timer' => '2017-04-17',
                'is_default_template' => 0,
                'created_at' => '2017-04-17 09:35:44',
                'updated_at' => '2017-04-17 09:35:44',
            ),
            4 => 
            array (
                'id' => 9,
                'title' => 'Goibibibo',
                'body' => '<p>Goibibo is the largest online hotels booking engine in India and also one of the leading air aggregator. Goibibo is also the number one ranked mobile app under the travel category. Goibibo&#39;s core value differentiator is delivery of the fastest and the most trusted user experiences, be it in terms of quickest search and booking, fastest payments, settlement and refund processes. Goibibo has grown its hotels booking volumes by 5x in 2015 over the previous year. 70% of hotel bookings take place on Goibibo&#39;s mobile app.</p>
',
                'recipients' => 'avinesh.mathur@planetwebsolution.com,avnet@mailinator.com,q@mailinator.com',
                'type' => 'plain',
                'newsletter_template_id' => NULL,
                'no_of_reciepents' => 3,
                'no_of_unsubscribers' => 0,
                'timer' => '2017-04-17',
                'is_default_template' => 0,
                'created_at' => '2017-04-17 09:37:16',
                'updated_at' => '2017-04-20 19:19:44',
            ),
            5 => 
            array (
                'id' => 10,
                'title' => 'testcode',
                'body' => '<p>test</p>
',
                'recipients' => 'avinesh.mathur@planetwebsolution.com',
                'type' => 'html',
                'newsletter_template_id' => NULL,
                'no_of_reciepents' => 1,
                'no_of_unsubscribers' => 0,
                'timer' => NULL,
                'is_default_template' => 1,
                'created_at' => '2017-04-20 13:44:13',
                'updated_at' => '2017-04-20 19:18:41',
            ),
        ));
        
        
    }
}