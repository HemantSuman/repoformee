<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Home Page',
                'alias' => 'home',
                'top' => 1,
                'right' => 1,
                'bottom' => 1,
                'left' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Detail Page',
                'alias' => 'detail',
                'top' => 0,
                'right' => 1,
                'bottom' => 1,
                'left' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Listing Page',
                'alias' => 'listing',
                'top' => 1,
                'right' => 1,
                'bottom' => 1,
                'left' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Prayer Timing',
                'alias' => 'prayer-timing',
                'top' => 1,
                'right' => 0,
                'bottom' => 0,
                'left' => 0,
            ),
        ));
        
        
    }
}