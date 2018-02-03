<?php

use Illuminate\Database\Seeder;

class PrayerTimingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('prayer_timings')->delete();
        
        \DB::table('prayer_timings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'University of Islamic Sciences, Karachi',
                'is_default' => 1,
                'status' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2017-03-08 02:44:28',
            ),
            1 => 
            array (
                'id' => 2,
            'name' => 'Islamic Society of North America (ISNA)',
                'is_default' => 0,
                'status' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-10-26 06:48:31',
            ),
            2 => 
            array (
                'id' => 3,
            'name' => 'Muslim World League (MWL)',
                'is_default' => 0,
                'status' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-12-02 05:13:34',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Umm al-Qura, Makkah',
                'is_default' => 0,
                'status' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2017-02-10 08:10:17',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Egyptian General Authority of Survey',
                'is_default' => 0,
                'status' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2017-03-08 02:44:28',
            ),
        ));
        
        
    }
}