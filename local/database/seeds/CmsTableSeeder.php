<?php

use Illuminate\Database\Seeder;

class CmsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cms')->delete();
        
        \DB::table('cms')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'About Us',
                'slug' => 'About-Us',
                'description' => '<p><a href="http://google.com">http://google.com</a><a id="google.com" name="google.com"></a></p>

<p>&nbsp;</p>

<p>&nbsp;</p>
',
                'metatitle' => 'test about us',
                'metakeyword' => 'test about us 1',
                'created_at' => '2016-12-19 18:10:53',
                'updated_at' => '2017-10-16 11:06:22',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Safety Tip',
                'slug' => 'Safety-Tips',
                'description' => '<h3 style="font-style: italic;"><a id="Testing" name="Testing"></a><a href="http://google.com">http://google.com</a></h3>

<p>&nbsp;</p>
<title></title>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<div class="what-baout">
<div class="title">What is Lorem Ipsum?</div>

<ul>
<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
<li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
<li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</li>
<li>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li>
</ul>

<p>&nbsp;</p>
</div>

<p>&nbsp;</p>

<p>&nbsp;</p>
',
                'metatitle' => 'test safety Tips',
                'metakeyword' => 'test safety Tips',
                'created_at' => '2016-12-19 18:13:54',
                'updated_at' => '2017-04-24 18:25:11',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Contact Us',
                'slug' => 'Contact-Us',
                'description' => '<title></title>
<p><span style="color: rgb(24, 24, 24); font-family: Lato, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);"><a href="http://google.com">http://google.com</a></span></p>

<p><span style="color: rgb(24, 24, 24); font-family: Lato, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Still can&#39;t find what you are looking for? Please use the form below to contact our Community Support team.</span><br style="box-sizing: border-box; color: rgb(24, 24, 24); font-family: Lato, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);" />
<span style="color: rgb(24, 24, 24); font-family: Lato, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">We try to reply to all inquiries within 24 hours.</span></p>

<p>&nbsp;</p>
',
                'metatitle' => 'test contact us',
                'metakeyword' => 'test contact us',
                'created_at' => '2016-12-19 18:15:31',
                'updated_at' => '2017-04-24 18:23:48',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Terms of Use',
                'slug' => 'Terms-of-Use',
                'description' => '<title></title>
<p><a href="http://google.com">http://google.com</a>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<div class="what-baout">
<div class="title">What is Lorem Ipsum?</div>

<ul>
<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
<li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
<li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</li>
<li>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li>
</ul>
</div>
',
                'metatitle' => 'test term use',
                'metakeyword' => 'test term use',
                'created_at' => '2016-12-19 18:16:19',
                'updated_at' => '2017-04-24 18:18:34',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Privacy Policy',
                'slug' => 'Privacy-Policy',
                'description' => '<p><a href="http://google.com">http://google.com</a>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<div class="what-baout">
<div class="title">What is Lorem Ipsum?</div>

<ul>
<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
<li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
<li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</li>
<li>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li>
</ul>
</div>

<p>&nbsp;</p>

<p>&nbsp;</p>
',
                'metatitle' => 'privacy ',
                'metakeyword' => 'policy',
                'created_at' => '2016-12-19 18:16:54',
                'updated_at' => '2017-04-24 18:19:50',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'T&C and Legal Notices',
                'slug' => 'T&C-and-Legal-Notices',
                'description' => '<p><a href="http://google.com">google.com</a>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<div class="what-baout">
<div class="title">What is Lorem Ipsum?</div>

<ul>
<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
<li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
<li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</li>
<li>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li>
</ul>
</div>

<p>&nbsp;</p>

<p>&nbsp;</p>
',
                'metatitle' => 'legal',
                'metakeyword' => 'Noitces',
                'created_at' => '2016-12-19 18:17:22',
                'updated_at' => '2017-04-24 18:20:14',
            ),
        ));
        
        
    }
}