<?php

use Illuminate\Database\Seeder;

class AttributeTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attribute_types')->delete();
        
        \DB::table('attribute_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Text',
                'slug' => 'text',
                'status' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Textarea',
                'slug' => 'textarea',
                'status' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Email',
                'slug' => 'Email',
                'status' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Drop-Down',
                'slug' => 'Drop-Down',
                'status' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Multi-Select',
                'slug' => 'Multi-Select',
                'status' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Dropdown',
                'slug' => 'dropdown',
                'status' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Radio-button',
                'slug' => 'Radio-button',
                'status' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Calendar',
                'slug' => 'calendar',
                'status' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Url',
                'slug' => 'Url',
                'status' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Image-Gallery',
                'slug' => 'Image-Gallery',
                'status' => 0,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'File',
                'slug' => 'File',
                'status' => 0,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Color',
                'slug' => 'Color',
                'status' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Time',
                'slug' => 'Time',
                'status' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Date-Time',
                'slug' => 'Date-Time',
                'status' => 0,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Number',
                'slug' => 'Number',
                'status' => 0,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Range',
                'slug' => 'Range',
                'status' => 0,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Video',
                'slug' => 'Video',
                'status' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Numeric',
                'slug' => 'Numeric',
                'status' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Date',
                'slug' => 'Date',
                'status' => 1,
            ),
        ));
        
        
    }
}