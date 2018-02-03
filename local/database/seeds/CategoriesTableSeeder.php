<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 30,
                'pid' => 0,
                'name' => 'Automotive124',
                'description' => '<p>In this category, a user can find all the sub categories of the Automotives</p>
',
                'icon' => '19644.png',
                'image' => '32669.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 1,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-26 13:24:07',
                'updated_at' => '2017-10-12 04:46:10',
                'is_sellable' => 0,
            ),
            1 => 
            array (
                'id' => 31,
                'pid' => 30,
                'name' => 'Cars & Vans',
                'description' => '<p>List all the car models and their attributes</p>
',
                'icon' => '25893.png',
                'image' => '19997.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => 0,
                'overlay_colour' => NULL,
                'order_no' => 2,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-26 19:20:44',
                'updated_at' => '2017-10-12 04:46:09',
                'is_sellable' => 1,
            ),
            2 => 
            array (
                'id' => 32,
                'pid' => 30,
                'name' => 'MotorCycle',
                'description' => '<p>List all the Motorcycle models and their attributes</p>
',
                'icon' => '15049.png',
                'image' => '78939.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 2,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-26 19:25:47',
                'updated_at' => '2017-10-12 04:46:09',
                'is_sellable' => 0,
            ),
            3 => 
            array (
                'id' => 33,
                'pid' => 0,
                'name' => 'Mosques',
                'description' => '<p>List of all the Mosque in the area</p>
',
                'icon' => '63544.png',
                'image' => '19784.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 1,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 2,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-26 19:28:25',
                'updated_at' => '2017-04-26 19:28:26',
                'is_sellable' => 0,
            ),
            4 => 
            array (
                'id' => 34,
                'pid' => 0,
                'name' => 'Schools',
                'description' => '<p>List all the schools and Kindergarten&nbsp;</p>
',
                'icon' => '49330.png',
                'image' => '42303.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 1,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 3,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 10:56:43',
                'updated_at' => '2017-04-27 10:56:43',
                'is_sellable' => 0,
            ),
            5 => 
            array (
                'id' => 35,
                'pid' => 0,
                'name' => 'Resturant',
                'description' => '<p>List All the Resturnt Data</p>
',
                'icon' => '59308.jpg',
                'image' => '19836.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 1,
                'show_static_attributes' => 1,
                'status' => 0,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 4,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 11:49:26',
                'updated_at' => '2017-04-27 11:49:26',
                'is_sellable' => 0,
            ),
            6 => 
            array (
                'id' => 36,
                'pid' => 30,
                'name' => 'Caravan&Campers',
                'description' => '<p>List all the Caravans and Campers with their attributes.</p>
',
                'icon' => '85320.png',
                'image' => '75262.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 5,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 15:51:41',
                'updated_at' => '2017-10-12 04:46:09',
                'is_sellable' => 0,
            ),
            7 => 
            array (
                'id' => 37,
                'pid' => 0,
                'name' => 'Jobs',
                'description' => '<p>List all the functioanl job areas with their skill sets</p>
',
                'icon' => '56774.png',
                'image' => '33075.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 5,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 15:57:49',
                'updated_at' => '2017-04-27 15:57:49',
                'is_sellable' => 0,
            ),
            8 => 
            array (
                'id' => 38,
                'pid' => 37,
                'name' => 'Accounting',
                'description' => '<ol>
<li>List all the Accounting Jobs in this sections&nbsp;
<p>Bookkeeping</p>

<p>Accounting</p>

<p>Accounts Officer</p>

<p>Accounts Payable</p>

<p>Financial Accounting &amp;amp; Reporting</p>

<p>Payroll Accounting</p>

<p>Taxation</p>

<p>Accounts Receivable/Credit Control</p>

<p>Business Services &amp;amp; Corporate</p>

<p>Advisory</p>

<p>Financial Manager &amp;amp; Controller</p>

<p>Other</p>
</li>
</ol>
',
                'icon' => '54308.png',
                'image' => '55178.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 6,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 16:04:26',
                'updated_at' => '2017-04-27 16:04:27',
                'is_sellable' => 0,
            ),
            9 => 
            array (
                'id' => 39,
                'pid' => 30,
                'name' => 'Parts',
                'description' => '<p>All the accessories and car parts.</p>
',
                'icon' => '40431.png',
                'image' => '32378.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 6,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 16:27:36',
                'updated_at' => '2017-10-12 04:46:09',
                'is_sellable' => 0,
            ),
            10 => 
            array (
                'id' => 40,
                'pid' => 0,
                'name' => 'Property and Real Estate',
                'description' => '<p>Here is list of real state and properties.</p>
',
                'icon' => '45670.png',
                'image' => '38908.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 6,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 16:34:16',
                'updated_at' => '2017-04-27 16:34:16',
                'is_sellable' => 0,
            ),
            11 => 
            array (
                'id' => 41,
                'pid' => 0,
                'name' => 'Home & Garden',
                'description' => '<p>List of all Home and Garden.</p>
',
                'icon' => '59402.png',
                'image' => '12940.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 7,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 19:00:44',
                'updated_at' => '2017-04-27 19:15:59',
                'is_sellable' => 0,
            ),
            12 => 
            array (
                'id' => 42,
                'pid' => 0,
                'name' => 'Services',
                'description' => '<p>List of All kinds of Services.</p>
',
                'icon' => '78835.png',
                'image' => '65003.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 8,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 19:29:52',
                'updated_at' => '2017-04-27 19:29:53',
                'is_sellable' => 0,
            ),
            13 => 
            array (
                'id' => 43,
                'pid' => 37,
                'name' => ' Administration & Office Support ',
                'description' => '<p>Administration and office staff</p>
',
                'icon' => '72822.png',
                'image' => '68596.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => 0,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 19:35:09',
                'updated_at' => '2017-04-27 19:35:37',
                'is_sellable' => 0,
            ),
            14 => 
            array (
                'id' => 44,
                'pid' => 37,
                'name' => 'Advertising',
                'description' => '<p>Adverstising is here.</p>
',
                'icon' => '32570.png',
                'image' => '58391.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 19:41:21',
                'updated_at' => '2017-04-27 19:41:21',
                'is_sellable' => 0,
            ),
            15 => 
            array (
                'id' => 45,
                'pid' => 37,
                'name' => ' Engineering ',
                'description' => '<p>Engineering</p>

<p style="margin-left:11.0pt;"><em>Civil/Structural Engineering </em></p>

<p><em>&nbsp;&nbsp;&nbsp; Aerospace Engineering</em></p>

<p><em>&nbsp;&nbsp;&nbsp; Water and waste Engineering</em></p>

<p style="margin-left:11.0pt;"><em>Mechanical Engineering</em></p>

<p style="margin-left:11.0pt;"><em>Building Services Engineering</em></p>

<p style="margin-left:11.0pt;"><em>Automotive Engineering </em></p>

<p style="margin-left:11.0pt;"><em>Maintenance</em></p>

<p><em>Other</em></p>
',
                'icon' => '26516.png',
                'image' => '82288.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 19:54:54',
                'updated_at' => '2017-04-27 19:54:54',
                'is_sellable' => 0,
            ),
            16 => 
            array (
                'id' => 46,
                'pid' => 37,
                'name' => 'Farming & Veterinary ',
                'description' => '<p style="margin-left:11.0pt;">List of Farming &amp; Veterinary &nbsp;</p>

<p style="margin-left:11.0pt;"><em>Agronomy &amp; Farm Services </em></p>

<p style="margin-left:11.0pt;"><em>Farm Management </em></p>

<p style="margin-left:11.0pt;"><em>Horticulture </em></p>

<p style="margin-left:11.0pt;"><em>Vet &amp; Animal Welfare </em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '60991.png',
                'image' => '30800.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 20:08:53',
                'updated_at' => '2017-04-27 20:08:53',
                'is_sellable' => 0,
            ),
            17 => 
            array (
                'id' => 47,
                'pid' => 42,
                'name' => ' Automotive',
                'description' => '<p>&nbsp;Automotive<br />
<em>Mechanics &amp; Garages </em></p>

<p><em>&nbsp;&nbsp;&nbsp; Cars, Trailers &amp; Excavators Hire </em></p>

<p><em>&nbsp;&nbsp;&nbsp; Paint &amp; Body Repair </em></p>

<p><em>&nbsp;&nbsp; Other Automotive </em></p>
',
                'icon' => '72380.png',
                'image' => '21766.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 20:12:31',
                'updated_at' => '2017-04-27 20:12:31',
                'is_sellable' => 0,
            ),
            18 => 
            array (
                'id' => 48,
                'pid' => 42,
                'name' => 'Building & Construction',
                'description' => '<p>List of Building and construction services.</p>

<p style="margin-left:11.0pt;"><em>Air Conditioning &amp; Heating </em></p>

<p style="margin-left:11.0pt;"><em>Bricklaying </em></p>

<p style="margin-left:11.0pt;"><em>Carpentry </em></p>

<p style="margin-left:11.0pt;"><em>Concreting &amp; Paving </em></p>

<p style="margin-left:11.0pt;"><em>Electrical </em></p>

<p style="margin-left:11.0pt;"><em>Fencing &amp; Gates </em></p>

<p style="margin-left:11.0pt;"><em>Flooring </em></p>

<p style="margin-left:11.0pt;"><em>Handyman</em></p>

<p style="margin-left:11.0pt;"><em>Painting &amp; Decorating </em></p>

<p style="margin-left:11.0pt;"><em>Pest Control </em></p>

<p style="margin-left:11.0pt;"><em>Plastering &amp; Tiling </em></p>

<p style="margin-left:11.0pt;"><em>Plumbing </em></p>

<p style="margin-left:11.0pt;"><em>Roofing </em></p>

<p style="margin-left:11.0pt;"><em>Rubbish Removal &amp; Skip Hiring</em></p>

<p style="margin-left:11.0pt;"><em>Scaffolding </em></p>

<p style="margin-left:11.0pt;"><em>Other </em></p>
',
                'icon' => '92571.png',
                'image' => '77392.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 20:21:13',
                'updated_at' => '2017-04-27 20:21:13',
                'is_sellable' => 0,
            ),
            19 => 
            array (
                'id' => 49,
                'pid' => 42,
                'name' => 'Childcare & Nanny   Cleaning ',
                'description' => '<p>Childcare &amp; Nanny &nbsp; Cleaning&nbsp;</p>
',
                'icon' => '85943.png',
                'image' => '60224.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 20:42:30',
                'updated_at' => '2017-04-27 20:42:30',
                'is_sellable' => 0,
            ),
            20 => 
            array (
                'id' => 50,
                'pid' => 42,
                'name' => 'Computer, Telecom & Freelance',
                'description' => '<p>Computer, Telecome &amp; Freelance</p>

<p style="margin-left:11.0pt;"><em>Computer &amp; Phone Repairs </em></p>

<p style="margin-left:11.0pt;"><em>Graphic &amp; Web Design </em></p>

<p style="margin-left:11.0pt;"><em>Web Development </em></p>

<p style="margin-left:11.0pt;"><em>Online Marketing </em></p>

<p style="margin-left:11.0pt;"><em>Other Computer, Telecom &amp; Freelance </em></p>
',
                'icon' => '96641.jpg',
                'image' => '35173.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 20:50:25',
                'updated_at' => '2017-04-27 20:50:25',
                'is_sellable' => 0,
            ),
            21 => 
            array (
                'id' => 51,
                'pid' => 42,
                'name' => 'Dress Making & Alterations ',
                'description' => '<p>Dress Making&nbsp;</p>
',
                'icon' => '23986.jpg',
                'image' => '31969.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 20:58:40',
                'updated_at' => '2017-04-27 20:58:40',
                'is_sellable' => 0,
            ),
            22 => 
            array (
                'id' => 52,
                'pid' => 41,
                'name' => 'Appliances ',
                'description' => '<p>Appliances</p>

<p><em>Air Conditioning &amp; Heating </em></p>

<p><em>Blenders, Juicers &amp; Food processors </em></p>

<p><em>Coffee Machines </em></p>

<p><em>Cooktops &amp; Range-hoods </em></p>

<p><em>Dishwashers </em></p>

<p><em>Fridges &amp; Freezers </em></p>

<p><em>Microwaves </em></p>

<p><em>Ovens </em></p>

<p><em>Sewing Machines </em></p>

<p><em>Small Appliances </em></p>

<p><em>Vacuum Cleaners </em></p>

<p><em>Washing Machines &amp; Dryers </em></p>

<p><em>Other Appliances </em></p>

<p>&nbsp;</p>

<p><a href="https://www.gumtree.com.au/s-building-materials/north-richmond-sydney/c20103l3003712r20">Building Materials</a></p>

<p>&nbsp;</p>

<p><a href="https://www.gumtree.com.au/s-furniture/north-richmond-sydney/c20073l3003712r20">Furniture&nbsp;</a></p>

<p><strong><em>Sub-Categories</em></strong></p>

<p><em>Armchairs</em></p>

<p><em>Bedside Tables</em></p>

<p><em>Beds </em></p>

<p><em>Bookcases &amp; Shelves </em></p>

<p><em>Buffets &amp; Side Tables </em></p>

<p><em>Cabinets </em></p>

<p><em>Coffee Tables </em></p>

<p><em>Desks</em></p>

<p><em>Dining Chairs </em></p>

<p><em>Dining Tables </em></p>

<p><em>Dressers &amp; Drawers </em></p>

<p><em>Entertainment &amp; TV Units </em></p>

<p><em>Mirrors </em></p>

<p><em>Office Chairs </em></p>

<p><em>Sofas </em></p>

<p><em>Stools &amp; Bar stools </em></p>

<p><em>Wardrobes </em></p>

<p><em>Other Furniture </em></p>

<p>&nbsp;</p>

<p><a href="https://www.gumtree.com.au/s-garden/north-richmond-sydney/c18398l3003712r20">Garden &amp; Outdoors&nbsp;</a></p>

<p><strong><em>Sub-Categories</em></strong></p>

<p><em>Barbecue </em></p>

<p><em>Landscaping &amp; Gardening Services </em></p>

<p><em>Garden D&eacute;cor</em></p>

<p><em>Hand Tools</em></p>

<p><em>Lawn Mowers </em></p>

<p><em>Lounging &amp; Relaxing Furniture </em></p>

<p><em>Outdoor Dining</em> Furniture</p>

<p><em>Parasols &amp; Gazebos </em></p>

<p><em>Plants </em></p>

<p><em>Watering Accessories</em></p>

<p><em>Pool </em></p>

<p><em>Pots &amp; Garden Beds </em></p>

<p><em>Sheds &amp; Storage </em></p>

<p><em>Other Garden </em></p>
',
                'icon' => '24697.jpg',
                'image' => '93911.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 21:03:33',
                'updated_at' => '2017-04-27 21:03:33',
                'is_sellable' => 0,
            ),
            23 => 
            array (
                'id' => 54,
                'pid' => 41,
                'name' => 'Home Decor ',
                'description' => '<p>Home Deco</p>

<p><em>Decorative Accessories </em></p>

<p><em>Rugs &amp; Carpets </em></p>

<p><em>Vases &amp; Bowls </em></p>

<p><em>Curtains &amp; Blinds </em></p>

<p><em>Picture Frames </em></p>

<p><em>Manchester &amp; Textiles </em></p>

<p><em>Clocks </em></p>

<p><em>Other </em></p>
',
                'icon' => '26411.png',
                'image' => '35471.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 21:12:39',
                'updated_at' => '2017-04-27 21:12:39',
                'is_sellable' => 0,
            ),
            24 => 
            array (
                'id' => 55,
                'pid' => 41,
                'name' => 'Kitchen & Dining ',
                'description' => '<p>Kitchen &amp; Dinning</p>

<p><em>Benchtops</em></p>

<p><em>Kitchen Taps &amp; Sinks</em></p>

<p><em>Cooking Accessories </em></p>

<p><em>Appliances</em></p>

<p><em>Dinnerware </em></p>

<p><em>Pots &amp; Pans </em></p>

<p><em>Cutlery </em></p>

<p><em>Other </em></p>
',
                'icon' => '64361.jpg',
                'image' => '34765.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 21:17:05',
                'updated_at' => '2017-04-27 21:17:06',
                'is_sellable' => 0,
            ),
            25 => 
            array (
                'id' => 56,
                'pid' => 41,
                'name' => 'Lighting ',
                'description' => '<p>Lighting</p>

<p><em>Interior Lights </em></p>

<p><em>Table &amp; Desk Lamps </em></p>

<p><em>Floor Lamps </em></p>

<p><em>Party Lighting</em></p>

<p><em>Outdoor Lighting </em></p>

<p><em>Other Lighting </em></p>
',
                'icon' => '41908.png',
                'image' => '93874.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 21:21:02',
                'updated_at' => '2017-04-27 21:21:02',
                'is_sellable' => 0,
            ),
            26 => 
            array (
                'id' => 57,
                'pid' => 41,
                'name' => 'Tools & DIY ',
                'description' => '<p><a href="https://www.gumtree.com.au/s-tools-diy/north-richmond-sydney/c18430l3003712r20">Tools &amp; DIY&nbsp;</a></p>

<p><em>Power Tools </em></p>

<p><em>Hand Tools </em></p>

<p><em>Tool Storage </em></p>

<p><em>Garden Tools </em></p>

<p><em>Ladders &amp; Scaffholding</em></p>

<p><em>Other</em></p>
',
                'icon' => '95811.jpg',
                'image' => '78252.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-27 21:28:37',
                'updated_at' => '2017-04-27 21:28:38',
                'is_sellable' => 0,
            ),
            27 => 
            array (
                'id' => 58,
                'pid' => 37,
                'name' => 'Banking & Financial Services ',
                'description' => '<p>Banking and Financial Services</p>

<p style="margin-left:11.0pt;"><em>Financial Planning </em></p>

<p style="margin-left:11.0pt;"><em>Mortgage Broker </em></p>

<p style="margin-left:11.0pt;"><em>Funds Management </em></p>

<p style="margin-left:11.0pt;"><em>Account &amp; Relationship Management </em></p>

<p style="margin-left:11.0pt;"><em>Analysis &amp; Reporting </em></p>

<p style="margin-left:11.0pt;"><em>Banking - Retail/Branch</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '72604.jpg',
                'image' => '95169.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => 0,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 06:37:13',
                'updated_at' => '2017-04-28 06:38:59',
                'is_sellable' => 0,
            ),
            28 => 
            array (
                'id' => 59,
                'pid' => 37,
                'name' => 'Call Centre & Customer Service ',
                'description' => '<p>Call Centre &amp; Customer Service&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Sales - Call Centre </em></p>

<p style="margin-left:11.0pt;"><em>Customer Service - Call Centre </em></p>

<p style="margin-left:11.0pt;"><em>Customer Service - Customer Facing </em></p>

<p style="margin-left:11.0pt;"><em>Sales - Customer Facing</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '63212.png',
                'image' => '58349.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 06:45:08',
                'updated_at' => '2017-04-28 06:45:08',
                'is_sellable' => 0,
            ),
            29 => 
            array (
                'id' => 60,
                'pid' => 37,
                'name' => 'Community Services & Development ',
                'description' => '<p>Community Services &amp; Development&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Aged &amp; Disability Support </em></p>

<p style="margin-left:11.0pt;"><em>Child Welfare</em></p>

<p style="margin-left:11.0pt;"><em>Youth &amp; Family Services </em></p>

<p style="margin-left:11.0pt;"><em>Employment Services</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '37976.png',
                'image' => '62868.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 06:48:24',
                'updated_at' => '2017-04-28 06:48:24',
                'is_sellable' => 0,
            ),
            30 => 
            array (
                'id' => 61,
                'pid' => 37,
                'name' => 'Construction ',
                'description' => '<p>Construction&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Machine &amp; Plant Operator </em></p>

<p style="margin-left:11.0pt;"><em>Foreman/Supervisor </em></p>

<p style="margin-left:11.0pt;"><em>Contract Management </em></p>

<p style="margin-left:11.0pt;"><em>Project Management </em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '25645.jpg',
                'image' => '82874.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 06:51:18',
                'updated_at' => '2017-04-28 06:51:18',
                'is_sellable' => 0,
            ),
            31 => 
            array (
                'id' => 62,
                'pid' => 37,
                'name' => 'Design & Architecture ',
                'description' => '<p>Design &amp; Architecture&nbsp;</p>

<p><em>Architecture </em></p>

<p style="margin-left:11.0pt;"><em>Graphic Design </em></p>

<p style="margin-left:11.0pt;"><em>Interior Design </em></p>

<p style="margin-left:11.0pt;"><em>Interaction &amp; Web Design </em></p>

<p><em>&nbsp;&nbsp; Other </em></p>
',
                'icon' => '26285.png',
                'image' => '76873.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 06:54:18',
                'updated_at' => '2017-04-28 06:54:18',
                'is_sellable' => 0,
            ),
            32 => 
            array (
                'id' => 63,
                'pid' => 37,
                'name' => 'Education & Teaching ',
                'description' => '<p>Education &amp; Teaching&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Tutoring </em></p>

<p style="margin-left:11.0pt;"><em>Management</em></p>

<p style="margin-left:11.0pt;">&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Childcare &amp; After School Care </em></p>

<p style="margin-left:11.0pt;"><em>Teaching </em></p>

<p style="margin-left:11.0pt;"><em>Workplace Training &amp; Assessment </em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '71491.png',
                'image' => '43834.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 06:55:45',
                'updated_at' => '2017-04-28 06:55:45',
                'is_sellable' => 0,
            ),
            33 => 
            array (
                'id' => 64,
                'pid' => 37,
                'name' => 'Government & Defense',
                'description' => '<p style="margin-left:11.0pt;"><a href="https://www.gumtree.com.au/s-government-defence/north-richmond-sydney/c22310l3003712r20?ad=offering">Government &amp; Defense</a></p>

<p style="margin-left:11.0pt;"><em>Army</em></p>

<p style="margin-left:11.0pt;"><em>Emergency Services</em></p>

<p style="margin-left:11.0pt;"><em>Navy</em></p>

<p style="margin-left:11.0pt;"><em>Police &amp; Corrections</em></p>

<p style="margin-left:11.0pt;"><em>Policy, Planning &amp; Regulation</em></p>

<p style="margin-left:11.0pt;"><em>Government - Federal</em></p>

<p style="margin-left:11.0pt;"><em>Government - Local</em></p>

<p style="margin-left:11.0pt;"><em>Government - State</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>

<p style="margin-left:11.0pt;">&nbsp;</p>
',
                'icon' => '64348.png',
                'image' => '54542.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:00:46',
                'updated_at' => '2017-04-28 07:00:46',
                'is_sellable' => 0,
            ),
            34 => 
            array (
                'id' => 65,
                'pid' => 37,
                'name' => 'Healthcare & Nursing ',
                'description' => '<p>Healthcare &amp; Nursing&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Chiropractic &amp; Osteopathic</em></p>

<p style="margin-left:11.0pt;"><em>Clinical/Medical Research</em></p>

<p style="margin-left:11.0pt;"><em>Dental</em></p>

<p style="margin-left:11.0pt;"><em>Dieticians</em></p>

<p style="margin-left:11.0pt;"><em>Environmental Services</em></p>

<p style="margin-left:11.0pt;"><em>General Practitioners</em></p>

<p style="margin-left:11.0pt;"><em>Management</em></p>

<p style="margin-left:11.0pt;">&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Medical Administration</em></p>

<p style="margin-left:11.0pt;"><em>Medical Imaging</em></p>

<p style="margin-left:11.0pt;"><em>Medical Specialists</em></p>

<p style="margin-left:11.0pt;"><em>Natural Therapies &amp; Alternative Medicine</em></p>

<p style="margin-left:11.0pt;"><em>Nursing - A&amp;E, Critical Care &amp; ICU</em></p>

<p style="margin-left:11.0pt;"><em>Nursing - Aged Care</em></p>

<p style="margin-left:11.0pt;"><em>Nursing - Community, Maternal &amp; Child Health</em></p>

<p style="margin-left:11.0pt;"><em>Nursing - Educators &amp; Facilitators</em></p>

<p style="margin-left:11.0pt;"><em>Nursing - General Medical &amp; Surgical</em></p>

<p style="margin-left:11.0pt;"><em>Nursing - High Acuity</em></p>

<p style="margin-left:11.0pt;"><em>Nursing - Management</em></p>

<p style="margin-left:11.0pt;"><em>Nursing - Midwifery, Neo-Natal, SCN &amp; NICU</em></p>

<p style="margin-left:11.0pt;"><em>Nursing - Pediatric &amp; PICU</em></p>

<p style="margin-left:11.0pt;"><em>Nursing - Psych, Forensic &amp; Correctional Health</em></p>

<p style="margin-left:11.0pt;"><em>Nursing - Theatre &amp; Recovery</em></p>

<p style="margin-left:11.0pt;"><em>Optical</em></p>

<p style="margin-left:11.0pt;"><em>Pathology</em></p>

<p style="margin-left:11.0pt;"><em>Pharmaceuticals &amp; Medical Devices</em></p>

<p style="margin-left:11.0pt;"><em>Pharmacy</em></p>

<p style="margin-left:11.0pt;"><em>Physiotherapy, OT &amp; Rehabilitation</em></p>

<p style="margin-left:11.0pt;"><em>Psychology, Counselling &amp; Social Work</em></p>

<p style="margin-left:11.0pt;"><em>Residents &amp; Registrars</em></p>

<p style="margin-left:11.0pt;"><em>Sales</em></p>

<p style="margin-left:11.0pt;"><em>Speech Therapy</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '86235.png',
                'image' => '85467.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:06:06',
                'updated_at' => '2017-04-28 07:06:07',
                'is_sellable' => 0,
            ),
            35 => 
            array (
                'id' => 66,
                'pid' => 37,
                'name' => '  Hospitality & Tourism ',
                'description' => '<p>&nbsp; Hospitality &amp; Tourism&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Bar &amp; Beverage Staff</em></p>

<p style="margin-left:11.0pt;"><em>Chefs/Cooks</em></p>

<p style="margin-left:11.0pt;"><em>Front Office &amp; Guest Services</em></p>

<p style="margin-left:11.0pt;"><em>Gaming</em></p>

<p style="margin-left:11.0pt;"><em>Housekeeping</em></p>

<p style="margin-left:11.0pt;"><em>Kitchen &amp; Sandwich Hands</em></p>

<p style="margin-left:11.0pt;"><em>Management</em></p>

<p style="margin-left:11.0pt;"><em>Reservations</em></p>

<p style="margin-left:11.0pt;"><em>Tour Guides</em></p>

<p style="margin-left:11.0pt;"><em>Travel Agents/Consultants</em></p>

<p style="margin-left:11.0pt;"><em>Waiting Staff</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '38633.jpg',
                'image' => '56553.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:11:02',
                'updated_at' => '2017-04-28 07:11:02',
                'is_sellable' => 0,
            ),
            36 => 
            array (
                'id' => 67,
                'pid' => 37,
                'name' => 'Information & Communication Technology ',
                'description' => '<p>Information &amp; Communication Technology&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Business/Systems Analysts</em></p>

<p style="margin-left:11.0pt;"><em>Computer Operators</em></p>

<p style="margin-left:11.0pt;"><em>Consultants</em></p>

<p style="margin-left:11.0pt;"><em>Database Development &amp; Administration</em></p>

<p style="margin-left:11.0pt;"><em>Developers/Programmers</em></p>

<p style="margin-left:11.0pt;"><em>Engineering - Hardware</em></p>

<p style="margin-left:11.0pt;"><em>Engineering - Network</em></p>

<p style="margin-left:11.0pt;"><em>Engineering - Software</em></p>

<p style="margin-left:11.0pt;"><em>Help Desk &amp; IT Support</em></p>

<p style="margin-left:11.0pt;"><em>Management</em></p>

<p style="margin-left:11.0pt;"><em>Networks &amp; Systems Administration</em></p>

<p style="margin-left:11.0pt;"><em>Product Management &amp; Development</em></p>

<p style="margin-left:11.0pt;"><em>Programme &amp; Project Management</em></p>

<p style="margin-left:11.0pt;"><em>Sales - Pre &amp; Post</em></p>

<p style="margin-left:11.0pt;"><em>Security</em></p>

<p style="margin-left:11.0pt;"><em>Team Leaders</em></p>

<p style="margin-left:11.0pt;"><em>Technical Writing</em></p>

<p style="margin-left:11.0pt;"><em>Telecommunications</em></p>

<p style="margin-left:11.0pt;"><em>Testing &amp; Quality Assurance</em></p>

<p style="margin-left:11.0pt;"><em>Web Development &amp; Production</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '70060.jpg',
                'image' => '45486.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:12:43',
                'updated_at' => '2017-04-28 07:12:43',
                'is_sellable' => 0,
            ),
            37 => 
            array (
                'id' => 68,
                'pid' => 37,
                'name' => 'Manufacturing, Transport & Logistics ',
                'description' => '<p>Manufacturing, Transport &amp; Logistics&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Assembly &amp; Process Work</em></p>

<p style="margin-left:11.0pt;"><em>Aviation Services</em></p>

<p style="margin-left:11.0pt;"><em>Couriers, Drivers &amp; Postal Services</em></p>

<p style="margin-left:11.0pt;"><em>Fleet Management</em></p>

<p style="margin-left:11.0pt;"><em>Freight/Cargo Forwarding</em></p>

<p style="margin-left:11.0pt;"><em>Import/Export &amp; Customs</em></p>

<p style="margin-left:11.0pt;"><em>Machine Operators</em></p>

<p style="margin-left:11.0pt;"><em>Management</em></p>

<p style="margin-left:11.0pt;"><em>Pattern Makers &amp; Garment Technicians</em></p>

<p style="margin-left:11.0pt;"><em>Pickers &amp; Packers</em></p>

<p style="margin-left:11.0pt;"><em>Production, Planning &amp; Scheduling</em></p>

<p style="margin-left:11.0pt;"><em>Public Transport &amp; Taxi Services</em></p>

<p style="margin-left:11.0pt;"><em>Purchasing, Procurement &amp; Inventory</em></p>

<p style="margin-left:11.0pt;"><em>Quality Assurance &amp; Control</em></p>

<p style="margin-left:11.0pt;"><em>Rail &amp; Maritime Transport</em></p>

<p style="margin-left:11.0pt;"><em>Road Transport</em></p>

<p style="margin-left:11.0pt;"><em>Team Leaders/Supervisors</em></p>

<p style="margin-left:11.0pt;"><em>Warehousing, Storage &amp; Distribution</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '56911.png',
                'image' => '62055.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:16:26',
                'updated_at' => '2017-04-28 07:16:26',
                'is_sellable' => 0,
            ),
            38 => 
            array (
                'id' => 69,
                'pid' => 37,
                'name' => 'Marketing & Communications ',
                'description' => '<p style="margin-left:11.0pt;"><a href="https://www.gumtree.com.au/s-marketing-communications/north-richmond-sydney/c22320l3003712r20?ad=offering">Marketing &amp; Communications&nbsp;</a></p>

<p style="margin-left:11.0pt;"><em>Digital &amp; Search Marketing</em></p>

<p style="margin-left:11.0pt;"><em>Direct Marketing &amp; CRM</em></p>

<p style="margin-left:11.0pt;"><em>Event Management</em></p>

<p style="margin-left:11.0pt;"><em>Internal Communications</em></p>

<p style="margin-left:11.0pt;"><em>Management</em></p>

<p style="margin-left:11.0pt;"><em>Market Research &amp; Analysis</em></p>

<p style="margin-left:11.0pt;"><em>Marketing Assistants/Coordinators</em></p>

<p style="margin-left:11.0pt;"><em>Marketing Communications</em></p>

<p style="margin-left:11.0pt;"><em>Product Management &amp; Development</em></p>

<p style="margin-left:11.0pt;"><em>Public Relations &amp; Corporate Affairs</em></p>

<p style="margin-left:11.0pt;"><em>Trade Marketing</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '95702.jpg',
                'image' => '31507.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:18:50',
                'updated_at' => '2017-04-28 07:18:50',
                'is_sellable' => 0,
            ),
            39 => 
            array (
                'id' => 70,
                'pid' => 37,
                'name' => 'Mining, Resources & Energy ',
                'description' => '<p style="margin-left:11.0pt;"><a href="https://www.gumtree.com.au/s-mining-resources-energy/north-richmond-sydney/c22330l3003712r20?ad=offering">Mining, Resources &amp; Energy&nbsp;</a></p>

<p style="margin-left:11.0pt;"><em>Health, Safety &amp; Environment</em></p>

<p style="margin-left:11.0pt;"><em>Management</em></p>

<p style="margin-left:11.0pt;"><em>Mining - Drill &amp; Blast</em></p>

<p style="margin-left:11.0pt;"><em>Mining - Engineering &amp; Maintenance</em></p>

<p style="margin-left:11.0pt;"><em>Mining - Exploration &amp; Geoscience</em></p>

<p style="margin-left:11.0pt;"><em>Mining - Operations</em></p>

<p style="margin-left:11.0pt;"><em>Mining - Processing</em></p>

<p style="margin-left:11.0pt;"><em>Natural Resources &amp; Water</em></p>

<p style="margin-left:11.0pt;"><em>Oil &amp; Gas - Drilling</em></p>

<p style="margin-left:11.0pt;"><em>Oil &amp; Gas - Engineering &amp; Maintenance</em></p>

<p style="margin-left:11.0pt;"><em>Oil &amp; Gas - Exploration &amp; Geoscience</em></p>

<p style="margin-left:11.0pt;"><em>Oil &amp; Gas - Operations</em></p>

<p style="margin-left:11.0pt;"><em>Oil &amp; Gas - Production &amp; Refinement</em></p>

<p style="margin-left:11.0pt;"><em>Power Generation &amp; Distribution</em></p>

<p style="margin-left:11.0pt;"><em>Surveying</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>

<p style="margin-left:11.0pt;">&nbsp;</p>
',
                'icon' => '74184.jpg',
                'image' => '80845.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:21:32',
                'updated_at' => '2017-04-28 07:21:33',
                'is_sellable' => 0,
            ),
            40 => 
            array (
                'id' => 71,
                'pid' => 37,
                'name' => ' Real Estate & Property ',
                'description' => '<p>&nbsp;Real Estate &amp; Property&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Analysts</em></p>

<p style="margin-left:11.0pt;"><em>Body Corporate &amp; Facilities Management</em></p>

<p style="margin-left:11.0pt;"><em>Commercial Sales, Leasing &amp; Property Mgmt</em></p>

<p style="margin-left:11.0pt;"><em>Residential Leasing &amp; Property Management</em></p>

<p style="margin-left:11.0pt;"><em>Residential Sales</em></p>

<p style="margin-left:11.0pt;"><em>Retail &amp; Property Development</em></p>

<p style="margin-left:11.0pt;"><em>Valuation</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '94889.png',
                'image' => '56239.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:23:23',
                'updated_at' => '2017-04-28 07:23:23',
                'is_sellable' => 0,
            ),
            41 => 
            array (
                'id' => 72,
                'pid' => 37,
                'name' => 'Retail and Consumer Products',
                'description' => '<p>Retail and Consumer Products</p>

<p style="margin-left:11.0pt;"><em>Management - Area/Multi-site</em></p>

<p style="margin-left:11.0pt;"><em>Management - Department/Assistant</em></p>

<p style="margin-left:11.0pt;"><em>Management - Store</em></p>

<p style="margin-left:11.0pt;"><em>Merchandisers</em></p>

<p style="margin-left:11.0pt;"><em>Planning</em></p>

<p style="margin-left:11.0pt;"><em>Retail Assistants</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '92162.png',
                'image' => '61532.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:28:39',
                'updated_at' => '2017-04-28 07:28:39',
                'is_sellable' => 0,
            ),
            42 => 
            array (
                'id' => 73,
                'pid' => 37,
                'name' => ' Sales ',
                'description' => '<p>Sales</p>

<p style="margin-left:11.0pt;"><em>Analysis &amp; Reporting</em></p>

<p style="margin-left:11.0pt;"><em>Management</em></p>

<p style="margin-left:11.0pt;"><em>Business Development</em></p>

<p style="margin-left:11.0pt;"><em>Sales Coordinators</em></p>

<p style="margin-left:11.0pt;"><em>Sales Representatives/Consultants</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>

<p style="margin-left:11.0pt;">&nbsp;</p>

<p style="margin-left:11.0pt;">&nbsp;</p>
',
                'icon' => '53587.png',
                'image' => '94789.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:35:11',
                'updated_at' => '2017-04-28 07:35:11',
                'is_sellable' => 0,
            ),
            43 => 
            array (
                'id' => 74,
                'pid' => 37,
                'name' => ' Sports & Recreation ',
                'description' => '<p>&nbsp;Sports &amp; Recreation&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Fitness &amp; Personal Training</em></p>

<p style="margin-left:11.0pt;"><em>Management</em></p>

<p style="margin-left:11.0pt;"><em>Other</em></p>
',
                'icon' => '98564.png',
                'image' => '86407.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:39:15',
                'updated_at' => '2017-04-28 07:39:15',
                'is_sellable' => 0,
            ),
            44 => 
            array (
                'id' => 75,
                'pid' => 37,
                'name' => ' Trades & Services ',
                'description' => '<p>&nbsp;Trades &amp; Services&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Analysis &amp; Reporting</em></p>

<p style="margin-left:11.0pt;"><em>Automotive Trades</em></p>

<p style="margin-left:11.0pt;"><em>Bakers &amp; Pastry Chefs</em></p>

<p style="margin-left:11.0pt;"><em>Building Trades</em></p>

<p style="margin-left:11.0pt;"><em>Butchers</em></p>

<p style="margin-left:11.0pt;"><em>Carpentry &amp; Cabinet Making</em></p>

<p style="margin-left:11.0pt;"><em>Cleaning Services</em></p>

<p style="margin-left:11.0pt;"><em>Electricians</em></p>

<p style="margin-left:11.0pt;"><em>Fitters, Turners &amp; Machinists</em></p>

<p style="margin-left:11.0pt;"><em>Floristry</em></p>

<p style="margin-left:11.0pt;"><em>Gardening &amp; Landscaping</em></p>

<p style="margin-left:11.0pt;"><em>Hair &amp; Beauty Services</em></p>
',
                'icon' => '82252.png',
                'image' => '51505.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:48:30',
                'updated_at' => '2017-04-28 07:48:30',
                'is_sellable' => 0,
            ),
            45 => 
            array (
                'id' => 76,
                'pid' => 37,
                'name' => 'Other Jobs',
                'description' => '<p>Other Jobs</p>
',
                'icon' => '26255.png',
                'image' => '34405.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:51:56',
                'updated_at' => '2017-04-28 07:51:56',
                'is_sellable' => 0,
            ),
            46 => 
            array (
                'id' => 77,
                'pid' => 42,
                'name' => 'Health, Fitness & Beauty',
                'description' => '<p>Health, Fitness &amp; Beauty</p>

<p style="margin-left:11.0pt;"><em>Beauty Treatments </em></p>

<p style="margin-left:11.0pt;"><em>Hairdressing </em></p>

<p style="margin-left:11.0pt;"><em>Personal Training </em></p>

<p><em>&nbsp;&nbsp;&nbsp; Massages </em></p>

<p style="margin-left:11.0pt;"><em>Alternative Therapies</em></p>

<p style="margin-left:11.0pt;"><em>Other Health, Fitness &amp; Beauty </em></p>
',
                'icon' => '67570.png',
                'image' => '55364.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:55:52',
                'updated_at' => '2017-04-28 07:55:52',
                'is_sellable' => 0,
            ),
            47 => 
            array (
                'id' => 78,
                'pid' => 42,
                'name' => 'Hiring',
                'description' => '<p>Hiring</p>

<p style="margin-left:11.0pt;"><em>Party Hire </em></p>

<p style="margin-left:11.0pt;"><em>Baby Products Hire</em></p>

<p style="margin-left:11.0pt;"><em>Bands, Entertainers &amp; Staff Hire </em></p>

<p style="margin-left:11.0pt;"><em>Car Hire</em></p>

<p><em>&nbsp;&nbsp; &nbsp;Trailers &amp; Excavators Hire </em></p>

<p style="margin-left:11.0pt;"><em>Tools &amp; Equipment Hire </em></p>

<p style="margin-left:11.0pt;"><em>Furniture &amp; Appliances Hire </em></p>

<p><em>Other Hiring </em></p>
',
                'icon' => '97120.png',
                'image' => '55331.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 07:58:26',
                'updated_at' => '2017-04-28 07:58:26',
                'is_sellable' => 0,
            ),
            48 => 
            array (
                'id' => 79,
                'pid' => 42,
                'name' => 'Landscaping & Gardening',
                'description' => '<p>Landscaping &amp; Gardening</p>

<p>&nbsp;</p>

<p><em>HSC, University &amp; School Tutoring </em></p>

<p style="margin-left:11.0pt;"><em>Courses &amp; Training </em></p>

<p style="margin-left:11.0pt;"><em>Music Tutoring </em></p>

<p style="margin-left:11.0pt;"><em>Dance Training </em></p>

<p style="margin-left:11.0pt;"><em>Swimming lessons</em></p>

<p style="margin-left:11.0pt;"><em>Language Learning &amp; Tutoring </em></p>

<p style="margin-left:11.0pt;"><em>Professional Tutoring </em></p>

<p><em>Other, Leisure and Sports </em></p>
',
                'icon' => '56558.png',
                'image' => '98763.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:02:50',
                'updated_at' => '2017-04-28 08:02:50',
                'is_sellable' => 0,
            ),
            49 => 
            array (
                'id' => 80,
                'pid' => 42,
                'name' => 'Pet Services',
                'description' => '<p>Pet Services</p>

<p style="margin-left:11.0pt;"><em>Sitting </em></p>

<p style="margin-left:11.0pt;"><em>Grooming </em></p>

<p style="margin-left:11.0pt;"><em>Training </em></p>

<p style="margin-left:11.0pt;"><em>Other Pet Services </em></p>
',
                'icon' => '71732.png',
                'image' => '58340.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:06:38',
                'updated_at' => '2017-04-28 08:06:38',
                'is_sellable' => 0,
            ),
            50 => 
            array (
                'id' => 81,
                'pid' => 42,
                'name' => 'Photography & Video ',
                'description' => '<p style="margin-left:11.0pt;"><a href="https://www.gumtree.com.au/s-photography-video/north-richmond-sydney/c18448l3003712r20">Photography &amp; Video&nbsp;</a></p>
',
                'icon' => '12287.jpg',
                'image' => '79572.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:09:24',
                'updated_at' => '2017-04-28 08:09:25',
                'is_sellable' => 0,
            ),
            51 => 
            array (
                'id' => 82,
                'pid' => 42,
                'name' => 'Real Estate ',
                'description' => '<p style="margin-left:11.0pt;"><a href="https://www.gumtree.com.au/s-real-estate/north-richmond-sydney/c18467l3003712r20">Real Estate&nbsp;</a></p>
',
                'icon' => '35511.png',
                'image' => '77845.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:10:15',
                'updated_at' => '2017-04-28 08:10:15',
                'is_sellable' => 0,
            ),
            52 => 
            array (
                'id' => 83,
                'pid' => 42,
                'name' => 'Removals & Storage ',
                'description' => '<p><a href="https://www.gumtree.com.au/s-removals-storage/north-richmond-sydney/c18643l3003712r20">Removals &amp; Storage&nbsp;</a></p>
',
                'icon' => '91630.png',
                'image' => '65998.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:14:08',
                'updated_at' => '2017-04-28 08:14:08',
                'is_sellable' => 0,
            ),
            53 => 
            array (
                'id' => 84,
                'pid' => 0,
                'name' => 'Electronics',
                'description' => '<p>List all electronics</p>
',
                'icon' => '29880.png',
                'image' => '27848.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 9,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:16:55',
                'updated_at' => '2017-04-28 08:16:55',
                'is_sellable' => 0,
            ),
            54 => 
            array (
                'id' => 85,
                'pid' => 84,
                'name' => 'Computers & Software ',
                'description' => '<p style="margin-left:11.0pt;"><a href="https://www.gumtree.com.au/s-computers-software/north-richmond-sydney/c18309l3003712r20">Computers &amp; Software&nbsp;</a></p>

<p style="margin-left:11.0pt;"><em>Laptops </em></p>

<p style="margin-left:11.0pt;"><em>Desktops </em></p>

<p style="margin-left:11.0pt;"><em>Computer Accessories </em></p>

<p style="margin-left:11.0pt;"><em>Components </em></p>

<p style="margin-left:11.0pt;"><em>Printers &amp; Scanners </em></p>

<p style="margin-left:11.0pt;"><em>Modems &amp; Routers </em></p>

<p style="margin-left:11.0pt;"><em>Monitors </em></p>

<p style="margin-left:11.0pt;"><em>Other Computers &amp; Software </em></p>

<p style="margin-left:11.0pt;"><em>Hard Drives &amp; USB Sticks </em></p>

<p style="margin-left:11.0pt;"><em>Software</em></p>
',
                'icon' => '30189.png',
                'image' => '21980.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => 0,
                'overlay_colour' => NULL,
                'order_no' => 10,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:19:22',
                'updated_at' => '2017-11-17 06:51:35',
                'is_sellable' => 1,
            ),
            55 => 
            array (
                'id' => 86,
                'pid' => 84,
                'name' => 'Video Games & Consoles ',
                'description' => '<p><u>Video Games &amp; Consoles&nbsp;</u></p>

<p><em>Playstation </em></p>

<p style="margin-left:11.0pt;"><em>Xbox </em></p>

<p style="margin-left:11.0pt;"><em>Other Consoles </em></p>

<p style="margin-left:11.0pt;"><em>Wii </em></p>

<p style="margin-left:11.0pt;"><em>Video Games </em></p>

<p style="margin-left:11.0pt;"><em>Console Accessories </em></p>
',
                'icon' => '21733.png',
                'image' => '93930.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 10,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:22:00',
                'updated_at' => '2017-04-28 08:22:00',
                'is_sellable' => 0,
            ),
            56 => 
            array (
                'id' => 87,
                'pid' => 84,
                'name' => 'Phones ',
                'description' => '<p><a href="https://www.gumtree.com.au/s-phones/north-richmond-sydney/c18313l3003712r20">Phones&nbsp;</a></p>

<p><em>iPhone </em></p>

<p style="margin-left:11.0pt;"><em>Android Phones </em></p>

<p style="margin-left:11.0pt;"><em>Phone Accessories</em></p>

<p style="margin-left:11.0pt;"><em>Other Phones</em></p>

<p style="margin-left:11.0pt;"><em>Home Phones </em></p>
',
                'icon' => '79528.png',
                'image' => '77261.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => 0,
                'overlay_colour' => NULL,
                'order_no' => 10,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:23:56',
                'updated_at' => '2017-11-02 13:33:40',
                'is_sellable' => 1,
            ),
            57 => 
            array (
                'id' => 88,
                'pid' => 84,
                'name' => 'Audio ',
                'description' => '<p style="margin-left:11.0pt;"><a href="https://www.gumtree.com.au/s-audio/north-richmond-sydney/c21106l3003712r20">Audio&nbsp;</a></p>

<p><em>Speakers </em></p>

<p style="margin-left:11.0pt;"><em>Headphones &amp; Earphones </em></p>

<p style="margin-left:11.0pt;"><em>Other Audio </em></p>

<p style="margin-left:11.0pt;"><em>Stereo Systems </em></p>

<p style="margin-left:11.0pt;"><em>Home Theatre Systems </em></p>

<p style="margin-left:11.0pt;"><em>iPods &amp; MP3 Players </em></p>

<p style="margin-left:11.0pt;"><em>Radios &amp; Receivers </em></p>
',
                'icon' => '13594.jpg',
                'image' => '94725.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 10,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:25:24',
                'updated_at' => '2017-04-28 08:25:24',
                'is_sellable' => 0,
            ),
            58 => 
            array (
                'id' => 89,
                'pid' => 84,
                'name' => 'Cameras ',
                'description' => '<p style="margin-left:11.0pt;"><a href="https://www.gumtree.com.au/s-cameras/north-richmond-sydney/c18394l3003712r20">Cameras&nbsp;</a></p>

<p style="margin-left:11.0pt;"><em>GoPro &amp; Action Cameras </em></p>

<p style="margin-left:11.0pt;"><em>Digital SLR </em></p>

<p style="margin-left:11.0pt;"><em>Digital Compact Cameras </em></p>

<p style="margin-left:11.0pt;"><em>Digital Camera Accessories </em></p>

<p style="margin-left:11.0pt;"><em>Other Cameras </em></p>

<p style="margin-left:11.0pt;"><em>Lenses </em></p>

<p style="margin-left:11.0pt;"><em>Non Digital Cameras </em></p>

<p style="margin-left:11.0pt;"><em>Video Cameras </em></p>

<p style="margin-left:11.0pt;"><em>Video Camera Accessories</em></p>
',
                'icon' => '16534.PNG',
                'image' => '19786.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => 0,
                'overlay_colour' => NULL,
                'order_no' => 10,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:27:34',
                'updated_at' => '2017-11-17 06:51:43',
                'is_sellable' => 1,
            ),
            59 => 
            array (
                'id' => 90,
                'pid' => 84,
                'name' => 'TV & DVD players ',
                'description' => '<p style="margin-left:11.0pt;"><a href="https://www.gumtree.com.au/s-tv-dvd-players/north-richmond-sydney/c21127l3003712r20">TV &amp; DVD players&nbsp;</a></p>

<p style="margin-left:11.0pt;"><em>TVs </em></p>

<p style="margin-left:11.0pt;"><em>TV Accessories </em></p>

<p style="margin-left:11.0pt;"><em>Home Theatre Systems </em></p>

<p style="margin-left:11.0pt;"><em>Other TV &amp; DVD Players (8)</em></p>

<p style="margin-left:11.0pt;"><em>DVD Players </em></p>
',
                'icon' => '63368.png',
                'image' => '72716.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 10,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:29:19',
                'updated_at' => '2017-04-28 08:29:19',
                'is_sellable' => 0,
            ),
            60 => 
            array (
                'id' => 91,
                'pid' => 84,
                'name' => 'Tablets & eBooks ',
                'description' => '<p style="margin-left:11.0pt;">&nbsp;</p>

<p style="margin-left:11.0pt;"><a href="https://www.gumtree.com.au/s-tablets-ebooks/north-richmond-sydney/c21121l3003712r20">Tablets &amp; eBooks</a></p>

<p>&nbsp;&nbsp;&nbsp; <em>iPads </em></p>

<p style="margin-left:11.0pt;"><em>Android Tablets </em></p>

<p style="margin-left:11.0pt;"><em>Other Tablets </em></p>

<p style="margin-left:11.0pt;"><em>Tablet Accessories </em></p>

<p style="margin-left:11.0pt;"><em>Kindle &amp; eBooks</em></p>
',
                'icon' => '65530.png',
                'image' => '18864.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 10,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:31:50',
                'updated_at' => '2017-04-28 08:31:50',
                'is_sellable' => 0,
            ),
            61 => 
            array (
                'id' => 92,
                'pid' => 0,
                'name' => 'Community',
                'description' => '<p>Community</p>
',
                'icon' => '81519.jpg',
                'image' => '84085.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 10,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:36:20',
                'updated_at' => '2017-04-28 08:36:20',
                'is_sellable' => 0,
            ),
            62 => 
            array (
                'id' => 93,
                'pid' => 92,
                'name' => 'Activities & Hobbies ',
                'description' => '<p><a href="https://www.gumtree.com.au/s-activities-hobbies/north-richmond-sydney/c18324l3003712r20">Activities &amp; Hobbies&nbsp;</a></p>
',
                'icon' => '86650.jpg',
                'image' => '43776.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:41:33',
                'updated_at' => '2017-04-28 08:41:33',
                'is_sellable' => 0,
            ),
            63 => 
            array (
                'id' => 94,
                'pid' => 92,
                'name' => 'Discussion and Forums',
                'description' => '<p>Discussion and Forums</p>
',
                'icon' => '13112.png',
                'image' => '25055.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:43:04',
                'updated_at' => '2017-04-28 08:43:04',
                'is_sellable' => 0,
            ),
            64 => 
            array (
                'id' => 95,
                'pid' => 92,
                'name' => 'Classes ',
                'description' => '<p><a href="https://www.gumtree.com.au/s-classes/north-richmond-sydney/c18325l3003712r20">Classes&nbsp;</a></p>
',
                'icon' => '63206.jpg',
                'image' => '25845.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:45:26',
                'updated_at' => '2017-04-28 08:45:26',
                'is_sellable' => 0,
            ),
            65 => 
            array (
                'id' => 96,
                'pid' => 92,
                'name' => 'Dance Partners ',
                'description' => '<p>&nbsp;&nbsp;&nbsp; <a href="https://www.gumtree.com.au/s-dance-partners/north-richmond-sydney/c20000l3003712r20">Dance Partners&nbsp;</a></p>
',
                'icon' => '14520.jpg',
                'image' => '20928.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 08:47:14',
                'updated_at' => '2017-04-28 08:47:14',
                'is_sellable' => 0,
            ),
            66 => 
            array (
                'id' => 97,
                'pid' => 92,
                'name' => 'Events',
                'description' => '<p>Events</p>
',
                'icon' => '78304.png',
                'image' => '51192.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 09:27:25',
                'updated_at' => '2017-04-28 09:27:25',
                'is_sellable' => 0,
            ),
            67 => 
            array (
                'id' => 98,
                'pid' => 92,
                'name' => 'Garage Sale ',
                'description' => '<p><a href="https://www.gumtree.com.au/s-garage-sale/north-richmond-sydney/c18486l3003712r20">Garage Sale&nbsp;</a></p>
',
                'icon' => '40735.jpg',
                'image' => '41958.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 09:30:27',
                'updated_at' => '2017-04-28 09:30:27',
                'is_sellable' => 0,
            ),
            68 => 
            array (
                'id' => 99,
                'pid' => 92,
                'name' => 'Language Swap ',
                'description' => '<p>Language Swap&nbsp;</p>
',
                'icon' => '80384.jpg',
                'image' => '60156.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 09:33:29',
                'updated_at' => '2017-04-28 09:33:29',
                'is_sellable' => 0,
            ),
            69 => 
            array (
                'id' => 100,
                'pid' => 92,
                'name' => 'Lost & Found ',
                'description' => '<p><a href="https://www.gumtree.com.au/s-lost-found/north-richmond-sydney/c18326l3003712r20">Lost &amp; Found&nbsp;</a></p>

<p>&nbsp;</p>
',
                'icon' => '78629.png',
                'image' => '55315.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 09:40:28',
                'updated_at' => '2017-04-28 09:40:28',
                'is_sellable' => 0,
            ),
            70 => 
            array (
                'id' => 101,
                'pid' => 92,
                'name' => 'Missed Connections ',
                'description' => '<p><a href="https://www.gumtree.com.au/s-missed-connections/north-richmond-sydney/c18441l3003712r20">Missed Connections&nbsp;</a></p>
',
                'icon' => '81253.jpg',
                'image' => '31220.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 09:42:56',
                'updated_at' => '2017-04-28 09:42:56',
                'is_sellable' => 0,
            ),
            71 => 
            array (
                'id' => 102,
                'pid' => 92,
                'name' => 'Musicians & Artists ',
                'description' => '<p>Musicians &amp; Artists&nbsp;</p>
',
                'icon' => '57131.png',
                'image' => '70313.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 09:46:06',
                'updated_at' => '2017-04-28 09:46:06',
                'is_sellable' => 0,
            ),
            72 => 
            array (
                'id' => 103,
                'pid' => 92,
                'name' => 'Rideshare & Travel Partners ',
                'description' => '<p><a href="https://www.gumtree.com.au/s-rideshare-travel-partners/north-richmond-sydney/c18332l3003712r20">Rideshare &amp; Travel Partners&nbsp;</a></p>
',
                'icon' => '36500.png',
                'image' => '30228.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:00:25',
                'updated_at' => '2017-04-28 10:00:25',
                'is_sellable' => 0,
            ),
            73 => 
            array (
                'id' => 104,
                'pid' => 92,
                'name' => 'Sports Partners ',
                'description' => '<p><a href="https://www.gumtree.com.au/s-sports-partners/north-richmond-sydney/c18331l3003712r20">Sports Partners&nbsp;</a></p>
',
                'icon' => '73892.jpg',
                'image' => '81632.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:02:57',
                'updated_at' => '2017-04-28 10:02:57',
                'is_sellable' => 0,
            ),
            74 => 
            array (
                'id' => 105,
                'pid' => 41,
                'name' => 'Building Materials  Furniture ',
                'description' => '<p><a href="https://www.gumtree.com.au/s-building-materials/north-richmond-sydney/c20103l3003712r20">Building Materials</a></p>

<p>&nbsp;</p>

<p><a href="https://www.gumtree.com.au/s-furniture/north-richmond-sydney/c20073l3003712r20">Furniture&nbsp;</a></p>
',
                'icon' => '32024.jpg',
                'image' => '27672.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:05:13',
                'updated_at' => '2017-04-28 10:05:13',
                'is_sellable' => 0,
            ),
            75 => 
            array (
                'id' => 106,
                'pid' => 41,
                'name' => 'Garden & Outdoors ',
                'description' => '<p><a href="https://www.gumtree.com.au/s-garden/north-richmond-sydney/c18398l3003712r20">Garden &amp; Outdoors&nbsp;</a></p>

<p><em>Barbecue </em></p>

<p><em>Landscaping &amp; Gardening Services </em></p>

<p><em>Garden D&eacute;cor</em></p>

<p><em>Hand Tools</em></p>

<p><em>Lawn Mowers </em></p>

<p><em>Lounging &amp; Relaxing Furniture </em></p>

<p><em>Outdoor Dining</em> Furniture</p>

<p><em>Parasols &amp; Gazebos </em></p>

<p>&nbsp;</p>

<p><em>Plants </em></p>

<p><em>Watering Accessories</em></p>

<p><em>Pool </em></p>

<p><em>Pots &amp; Garden Beds </em></p>

<p><em>Sheds &amp; Storage </em></p>

<p><em>Other Garden </em></p>
',
                'icon' => '42839.jpg',
                'image' => '32118.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:09:14',
                'updated_at' => '2017-04-28 10:09:15',
                'is_sellable' => 0,
            ),
            76 => 
            array (
                'id' => 107,
                'pid' => 0,
                'name' => 'Pets',
                'description' => '<p>List all pets</p>
',
                'icon' => '79468.png',
                'image' => '44869.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 11,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:09:56',
                'updated_at' => '2017-04-28 10:09:57',
                'is_sellable' => 0,
            ),
            77 => 
            array (
                'id' => 108,
                'pid' => 107,
                'name' => 'Birds ',
                'description' => '<p style="margin-left:11.0pt;"><u>Birds </u></p>
',
                'icon' => '52169.jpg',
                'image' => '68510.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 12,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:11:35',
                'updated_at' => '2017-04-28 10:11:35',
                'is_sellable' => 0,
            ),
            78 => 
            array (
                'id' => 109,
                'pid' => 107,
                'name' => 'Cats & Kittens ',
                'description' => '<p style="margin-left:11.0pt;"><u>Cats &amp; Kittens </u></p>
',
                'icon' => '22896.png',
                'image' => '80061.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 12,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:12:54',
                'updated_at' => '2017-04-28 10:12:54',
                'is_sellable' => 0,
            ),
            79 => 
            array (
                'id' => 110,
                'pid' => 107,
                'name' => 'Dogs & Puppies ',
                'description' => '<p style="margin-left:11.0pt;"><u>Dogs &amp; Puppies </u></p>
',
                'icon' => '85713.png',
                'image' => '17565.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 12,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:13:31',
                'updated_at' => '2017-04-28 10:13:31',
                'is_sellable' => 0,
            ),
            80 => 
            array (
                'id' => 111,
                'pid' => 107,
                'name' => 'Fish ',
                'description' => '<p style="margin-left:11.0pt;"><u>Fish </u></p>
',
                'icon' => '52785.png',
                'image' => '97247.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 12,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:14:54',
                'updated_at' => '2017-04-28 10:14:54',
                'is_sellable' => 0,
            ),
            81 => 
            array (
                'id' => 112,
                'pid' => 107,
                'name' => 'Horses & Ponies ',
                'description' => '<p style="margin-left:11.0pt;"><u>Horses &amp; Ponies </u></p>
',
                'icon' => '20891.png',
                'image' => '60962.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 12,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:17:24',
                'updated_at' => '2017-04-28 10:17:24',
                'is_sellable' => 0,
            ),
            82 => 
            array (
                'id' => 113,
                'pid' => 107,
                'name' => 'Livestock ',
                'description' => '<p style="margin-left:11.0pt;"><u>Livestock </u></p>
',
                'icon' => '29208.png',
                'image' => '93802.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 12,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:19:07',
                'updated_at' => '2017-04-28 10:19:07',
                'is_sellable' => 0,
            ),
            83 => 
            array (
                'id' => 114,
                'pid' => 107,
                'name' => 'Lost & Found ',
                'description' => '<p style="margin-left:11.0pt;"><u>Lost &amp; Found </u></p>
',
                'icon' => '57978.png',
                'image' => '26034.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 12,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:21:45',
                'updated_at' => '2017-04-28 10:21:45',
                'is_sellable' => 0,
            ),
            84 => 
            array (
                'id' => 115,
                'pid' => 107,
                'name' => 'Pet Products ',
                'description' => '<p style="margin-left:11.0pt;"><u>Pet Products </u></p>
',
                'icon' => '70557.png',
                'image' => '75831.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 12,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:22:12',
                'updated_at' => '2017-04-28 10:22:13',
                'is_sellable' => 0,
            ),
            85 => 
            array (
                'id' => 116,
                'pid' => 107,
                'name' => 'Pet Services ',
                'description' => '<p style="margin-left:11.0pt;"><u>Pet Services </u></p>
',
                'icon' => '42714.png',
                'image' => '56920.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 12,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:22:39',
                'updated_at' => '2017-04-28 10:22:39',
                'is_sellable' => 0,
            ),
            86 => 
            array (
                'id' => 117,
                'pid' => 0,
                'name' => 'Books, Music Sports & Fitness',
                'description' => '<p><strong>Books, Music Sports &amp; Fitness</strong></p>
',
                'icon' => '75665.png',
                'image' => '40844.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 12,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:24:20',
                'updated_at' => '2017-05-25 08:15:31',
                'is_sellable' => 0,
            ),
            87 => 
            array (
                'id' => 118,
                'pid' => 117,
                'name' => ' Books',
                'description' => '<p><b>&nbsp;</b><u>Books</u></p>

<p>&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Books </em></p>

<p style="margin-left:11.0pt;"><em>Textbooks </em></p>

<p style="margin-left:11.0pt;"><em>Children&#39;s Books </em></p>

<p style="margin-left:11.0pt;"><em>Nonfiction Books </em></p>

<p style="margin-left:11.0pt;"><em>Fiction Books </em></p>

<p style="margin-left:11.0pt;"><em>Travel Guides </em></p>

<p style="margin-left:11.0pt;"><em>Business Books</em></p>

<p style="margin-left:11.0pt;"><em>Comic Books </em></p>

<p style="margin-left:11.0pt;"><em>Magazines </em></p>

<p style="margin-left:11.0pt;"><em>Graphic Novels</em></p>

<p style="margin-left:11.0pt;"><em>Other Books </em></p>
',
                'icon' => '24979.png',
                'image' => '27799.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 13,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:25:01',
                'updated_at' => '2017-05-25 08:15:31',
                'is_sellable' => 0,
            ),
            88 => 
            array (
                'id' => 119,
                'pid' => 117,
                'name' => '   Musical Instrument',
                'description' => '<p>?&nbsp;&nbsp; <u>Musical Instrument</u></p>

<p>&nbsp;</p>

<p><em>Sub-Categories</em></p>

<p><em>&nbsp;&nbsp;&nbsp; Guitars &amp; Amps </em></p>

<p><em>&nbsp;&nbsp;&nbsp; Keyboards &amp; Pianos</em></p>

<p><em>&nbsp;&nbsp;&nbsp; Percussion &amp; Drums </em></p>

<p><em>&nbsp;&nbsp;&nbsp; Woodwind &amp; Brass </em></p>

<p><em>&nbsp;&nbsp; Instrument Accessories </em></p>

<p><em>&nbsp;&nbsp;&nbsp;Other </em></p>
',
                'icon' => '35700.jpg',
                'image' => '56128.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 13,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:26:36',
                'updated_at' => '2017-05-25 08:15:31',
                'is_sellable' => 0,
            ),
            89 => 
            array (
                'id' => 120,
                'pid' => 117,
                'name' => 'Sports Equipment?',
                'description' => '<p style="margin-left:11.0pt;"><u>Sports Equipment?</u></p>

<p style="margin-left:11.0pt;">&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Sports</em></p>

<p style="margin-left:11.0pt;"><em>Cycling</em></p>

<p style="margin-left:11.0pt;"><em>Camping &amp; Hiking </em></p>

<p style="margin-left:11.0pt;"><em>Fishing </em></p>

<p style="margin-left:11.0pt;"><em>Gym &amp; Fitness </em></p>

<p style="margin-left:11.0pt;"><em>Clothing and Footwear</em></p>

<p style="margin-left:11.0pt;"><em>Personal Training Services </em></p>

<p style="margin-left:11.0pt;"><em>Skateboards &amp; Rollerblades </em></p>

<p style="margin-left:11.0pt;"><em>Snow Sports </em></p>

<p style="margin-left:11.0pt;"><em>Sports Bags </em></p>

<p style="margin-left:11.0pt;"><em>Surfing </em></p>

<p style="margin-left:11.0pt;"><em>Fangear</em></p>

<p style="margin-left:11.0pt;"><em>Other </em></p>
',
                'icon' => '69796.png',
                'image' => '32836.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 13,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 10:28:45',
                'updated_at' => '2017-05-25 08:15:31',
                'is_sellable' => 0,
            ),
            90 => 
            array (
                'id' => 122,
                'pid' => 40,
                'name' => 'Commercial',
                'description' => '<p style="margin-left:11.0pt;"><u>Commercial</u></p>

<p style="margin-left:11.0pt;"><em>Lease</em></p>

<p style="margin-left:11.0pt;"><em>Buy</em></p>

<p style="margin-left:11.0pt;"><em>Sell </em></p>

<p style="margin-left:11.0pt;"><em>Business for sale</em></p>

<p style="margin-left:11.0pt;"><em>Office Space</em></p>
',
                'icon' => '55414.png',
                'image' => '18499.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => 0,
                'overlay_colour' => NULL,
                'order_no' => 14,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 11:06:27',
                'updated_at' => '2017-11-17 11:03:08',
                'is_sellable' => 0,
            ),
            91 => 
            array (
                'id' => 123,
                'pid' => 40,
                'name' => 'Rural',
                'description' => '<p>Rural</p>

<p style="margin-left:11.0pt;"><em>Lease</em></p>

<p style="margin-left:11.0pt;"><em>Buy</em></p>

<p style="margin-left:11.0pt;"><em>Sell </em></p>
',
                'icon' => '59674.jpg',
                'image' => '49059.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => 0,
                'overlay_colour' => NULL,
                'order_no' => 14,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 13:29:44',
                'updated_at' => '2017-11-17 11:03:24',
                'is_sellable' => 0,
            ),
            92 => 
            array (
                'id' => 124,
                'pid' => 40,
                'name' => 'Other Real Estate',
                'description' => '<p style="margin-left:11.0pt;"><a href="https://www.gumtree.com.au/s-other-real-estate/north-richmond-sydney/c18302l3003712r20">Other Real Estate</a><br />
&nbsp;</p>

<p style="margin-left:11.0pt;"><em>Short term</em></p>

<p style="margin-left:11.0pt;"><em>Parking space</em></p>

<p style="margin-left:11.0pt;">&nbsp;</p>
',
                'icon' => '20713.png',
                'image' => '48569.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => 0,
                'overlay_colour' => NULL,
                'order_no' => 14,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 13:32:53',
                'updated_at' => '2017-11-17 11:03:20',
                'is_sellable' => 0,
            ),
            93 => 
            array (
                'id' => 125,
                'pid' => 0,
                'name' => 'Baby & Children',
                'description' => '<p>List of all baby and children</p>
',
                'icon' => '80205.jpg',
                'image' => '75730.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 14,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 13:43:17',
                'updated_at' => '2017-04-28 13:43:17',
                'is_sellable' => 0,
            ),
            94 => 
            array (
                'id' => 126,
                'pid' => 125,
                'name' => 'Toys - Indoor',
                'description' => '<h1><strong>Toys - Indoor</strong></h1>
',
                'icon' => '49998.jpg',
                'image' => '80604.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 15,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 13:45:33',
                'updated_at' => '2017-04-28 13:45:34',
                'is_sellable' => 0,
            ),
            95 => 
            array (
                'id' => 127,
                'pid' => 125,
                'name' => 'Kids Clothing',
                'description' => '<ul itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
<li>
<h1><strong>Kids Clothing</strong></h1>
</li>
</ul>
',
                'icon' => '40676.jpg',
                'image' => '47017.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 15,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 13:48:56',
                'updated_at' => '2017-04-28 13:48:56',
                'is_sellable' => 0,
            ),
            96 => 
            array (
                'id' => 128,
                'pid' => 125,
                'name' => 'Other Baby & Children',
                'description' => '<h1><strong>Other Baby &amp; Children</strong></h1>
',
                'icon' => '20851.jpg',
                'image' => '96414.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 15,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 13:49:49',
                'updated_at' => '2017-04-28 13:49:49',
                'is_sellable' => 0,
            ),
            97 => 
            array (
                'id' => 129,
                'pid' => 125,
                'name' => 'Baby Children Cots Bedding',
                'description' => '<h3>Baby Children Cots Bedding</h3>
',
                'icon' => '75195.jpg',
                'image' => '43701.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 15,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 13:54:52',
                'updated_at' => '2017-04-28 13:54:52',
                'is_sellable' => 0,
            ),
            98 => 
            array (
                'id' => 130,
                'pid' => 125,
                'name' => 'Prams & Strollers',
                'description' => '<h1><strong>Prams &amp; Strollers</strong></h1>
',
                'icon' => '80421.png',
                'image' => '48933.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 15,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 13:57:42',
                'updated_at' => '2017-04-28 13:57:42',
                'is_sellable' => 0,
            ),
            99 => 
            array (
                'id' => 131,
                'pid' => 125,
                'name' => 'Toys - Outdoor',
                'description' => '<h1><strong>Toys - Outdoor</strong></h1>
',
                'icon' => '99197.jpg',
                'image' => '90317.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 15,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 13:59:14',
                'updated_at' => '2017-04-28 13:59:14',
                'is_sellable' => 0,
            ),
            100 => 
            array (
                'id' => 132,
                'pid' => 125,
                'name' => 'Feeding',
                'description' => '<h1><strong>Feeding</strong></h1>
',
                'icon' => '26206.png',
                'image' => '43005.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 15,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 14:07:18',
                'updated_at' => '2017-04-28 14:07:18',
                'is_sellable' => 0,
            ),
            101 => 
            array (
                'id' => 133,
                'pid' => 125,
                'name' => 'Baby Carriers',
                'description' => '<h1><strong>Baby Carriers</strong></h1>
',
                'icon' => '80077.jpg',
                'image' => '72791.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 15,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 14:09:47',
                'updated_at' => '2017-04-28 14:09:47',
                'is_sellable' => 0,
            ),
            102 => 
            array (
                'id' => 134,
                'pid' => 125,
                'name' => 'Safety',
                'description' => '<h1><strong>Safety</strong></h1>
',
                'icon' => '14033.jpg',
                'image' => '49331.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 15,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 14:11:25',
                'updated_at' => '2017-04-28 14:11:25',
                'is_sellable' => 0,
            ),
            103 => 
            array (
                'id' => 135,
                'pid' => 42,
                'name' => 'Learning & Tutoring',
                'description' => '<p>List all the services under learning category</p>
',
                'icon' => '49890.png',
                'image' => '46683.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 15,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-04-28 14:22:03',
                'updated_at' => '2017-04-28 14:22:03',
                'is_sellable' => 0,
            ),
            104 => 
            array (
                'id' => 137,
                'pid' => 40,
                'name' => 'Domestic',
                'description' => '<p>Domestic</p>
',
                'icon' => '85815.jpg',
                'image' => '87093.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 14,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-05-03 11:34:46',
                'updated_at' => '2017-05-03 11:34:46',
                'is_sellable' => 0,
            ),
            105 => 
            array (
                'id' => 138,
                'pid' => 0,
                'name' => 'Food Certification',
                'description' => '<p>List all the Halal Food&nbsp;</p>
',
                'icon' => '66175.png',
                'image' => '44507.png',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 2,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 14,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-05-05 08:47:19',
                'updated_at' => '2017-05-05 08:47:19',
                'is_sellable' => 0,
            ),
            106 => 
            array (
                'id' => 139,
                'pid' => 30,
                'name' => 'demo1',
                'description' => '<p>as dasd</p>
',
                'icon' => '33358.jpg',
                'image' => '47050.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 0,
                'feactured' => 0,
                'overlay_colour' => NULL,
                'order_no' => 15,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-09-21 11:30:10',
                'updated_at' => '2017-10-12 04:46:09',
                'is_sellable' => 0,
            ),
            107 => 
            array (
                'id' => 140,
                'pid' => 0,
                'name' => 'demo2',
                'description' => '<p>gh j gh ghj</p>
',
                'icon' => '48630.jpg',
                'image' => '33516.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => 0,
                'overlay_colour' => NULL,
                'order_no' => 15,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-09-21 11:41:53',
                'updated_at' => '2017-10-13 08:00:30',
                'is_sellable' => 0,
            ),
            108 => 
            array (
                'id' => 141,
                'pid' => 30,
                'name' => 'demo3',
                'description' => '<p>as dz</p>
',
                'icon' => '88441.jpg',
                'image' => '15680.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 0,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 16,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-09-21 11:42:58',
                'updated_at' => '2017-10-12 04:46:09',
                'is_sellable' => 0,
            ),
            109 => 
            array (
                'id' => 142,
                'pid' => 140,
                'name' => 'demo 2 sub',
                'description' => '<p>as a</p>
',
                'icon' => '14857.jpg',
                'image' => '84941.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => NULL,
                'overlay_colour' => NULL,
                'order_no' => 16,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2017-10-13 08:00:04',
                'updated_at' => '2017-10-13 08:00:30',
                'is_sellable' => 0,
            ),
            110 => 
            array (
                'id' => 143,
                'pid' => 0,
                'name' => 'Qwerty',
                'description' => '<p>QWERTY Description</p>
',
                'icon' => '57403.png',
                'image' => '15611.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 1,
                'show_on_info_area' => 0,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 16,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2018-01-10 06:23:48',
                'updated_at' => '2018-01-10 06:23:48',
                'is_sellable' => 0,
            ),
            111 => 
            array (
                'id' => 144,
                'pid' => 143,
                'name' => 'Qwerty Child',
                'description' => '<p>sdas das das</p>
',
                'icon' => '37847.png',
                'image' => '53640.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 0,
                'show_static_attributes' => 0,
                'status' => 1,
                'feactured' => 0,
                'overlay_colour' => NULL,
                'order_no' => 17,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2018-01-10 06:27:23',
                'updated_at' => '2018-01-10 06:40:24',
                'is_sellable' => 1,
            ),
            112 => 
            array (
                'id' => 145,
                'pid' => 0,
                'name' => 'Gym',
                'description' => '<p>GYM description</p>
',
                'icon' => '87473.png',
                'image' => '95548.jpg',
                'belong_to_community' => 0,
                'accessible_to_users' => 0,
                'show_on_info_area' => 1,
                'show_static_attributes' => 1,
                'status' => 1,
                'feactured' => 1,
                'overlay_colour' => NULL,
                'order_no' => 17,
                'metakeyword' => '',
                'metadescription' => '',
                'created_at' => '2018-01-10 06:29:47',
                'updated_at' => '2018-01-10 06:29:47',
                'is_sellable' => 0,
            ),
        ));
        
        
    }
}