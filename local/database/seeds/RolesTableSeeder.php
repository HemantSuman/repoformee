<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'admin',
                'role_type' => 'admin',
                'role_slug' => 'admin',
                'seller_type' => 'admin',
                'is_merchant' => 0,
                'status' => 0,
                'add_date' => '2016-10-13 00:00:00',
                'created_at' => '2016-09-25 23:52:57',
                'updated_at' => '2016-09-25 23:52:57',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'operator',
                'role_type' => 'admin',
                'role_slug' => 'admin',
                'seller_type' => 'admin',
                'is_merchant' => 0,
                'status' => 0,
                'add_date' => '2017-10-05 00:00:00',
                'created_at' => '2017-10-05 06:06:38',
                'updated_at' => '2017-10-05 06:06:38',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Private',
                'role_type' => 'front',
                'role_slug' => 'private',
                'seller_type' => 'private',
                'is_merchant' => 0,
                'status' => 0,
                'add_date' => '2017-10-05 14:19:55',
                'created_at' => '2017-10-05 14:20:03',
                'updated_at' => '2017-10-05 14:20:03',
            ),
        ));
        
        
    }
}