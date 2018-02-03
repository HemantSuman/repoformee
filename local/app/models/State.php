<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class State extends Authenticatable {

    protected $table = 'state';

    public function state_hasmany_cities() {
        return $this->hasMany('App\models\City', 'RegionID');
    }

    public function getclassifiedbystatecitycount($selectedCategories = null) {


        $data = DB::select(DB::raw("SELECT name state_name,s.id satet_id,
(SELECT count(DISTINCT classifieds.id) FROM `classifieds` left join categories
on classifieds.parent_categoryid = categories.id or classifieds.category_id = categories.id
where state_id=s.id and classifieds.status=1 and (categories.belong_to_community != 1) and (categories.show_on_info_area != 1)
and (curdate() between classifieds.start_date and classifieds.end_date)) state_count,
group_concat(c.City order by c.City) city_names,group_concat(c.CityId order by c.City) city_ids,
CONVERT(group_concat((SELECT count(DISTINCT classifieds.id) FROM `classifieds`left join categories
on classifieds.parent_categoryid = categories.id or classifieds.category_id = categories.id
 where (classifieds.status=1 and (categories.belong_to_community != 1) and (categories.show_on_info_area != 1)
and (curdate() between classifieds.start_date and classifieds.end_date)) and city_id=c.CityId) order by c.City) USING utf8) city_counts 
FROM `state` s left join cities c on s.id=c.RegionID where countryID=14 group by s.id order by s.name"));

        foreach ($data as $key => $value) {
            $citiesname = explode(',', $value->city_names);
            $city_ids = explode(',', $value->city_ids);
            $city_counts = explode(',', $value->city_counts);
            $city = [];
            if ($citiesname != '') {
                foreach ($citiesname as $key1 => $value1) {
                    $city[] = array('name' => $value1, 'city_ids' => $city_ids[$key1], 'city_counts' => $city_counts[$key1]);
                }
                $value->city = $city;
            }
        }

        return $data;
    }

    public function getCategoriesWithClassifiedCount($selectedCategories = null) {


        $data = DB::select(DB::raw("SELECT name state_name,s.id satet_id,
(SELECT count(DISTINCT classifieds.id) FROM `classifieds` left join categories
on classifieds.parent_categoryid = categories.id or classifieds.category_id = categories.id
where state_id=s.id and classifieds.status=1 and (classifieds.parent_categoryid=$selectedCategories or classifieds.category_id=$selectedCategories ) and (categories.belong_to_community != 1) and (categories.show_on_info_area != 1)
and (curdate() between classifieds.start_date and classifieds.end_date)) state_count,
group_concat(c.City order by c.City) city_names,group_concat(c.CityId order by c.City) city_ids,
CONVERT(group_concat((SELECT count(DISTINCT classifieds.id) FROM `classifieds`left join categories
on classifieds.parent_categoryid = categories.id or classifieds.category_id = categories.id
 where (classifieds.status=1  and (classifieds.parent_categoryid=$selectedCategories or classifieds.category_id=$selectedCategories ) and (categories.belong_to_community != 1) and (categories.show_on_info_area != 1)
and (curdate() between classifieds.start_date and classifieds.end_date)) and city_id=c.CityId) order by c.City) USING utf8) city_counts 
FROM `state` s left join cities c on s.id=c.RegionID where countryID=14 group by s.id order by s.name"));

        foreach ($data as $key => $value) {
            $citiesname = explode(',', $value->city_names);
            $city_ids = explode(',', $value->city_ids);
            $city_counts = explode(',', $value->city_counts);
            $city = [];
            if ($citiesname != '') {
                foreach ($citiesname as $key1 => $value1) {
                    $city[] = array('name' => $value1, 'city_ids' => $city_ids[$key1], 'city_counts' => $city_counts[$key1]);
                }
                $value->city = $city;
            }
        }

        return $data;
    }

    public function getclassifiedbystatecitycountwithcatid($selectedCategories = null) {

        $data = DB::select(DB::raw("SELECT name state_name,s.id satet_id,
(SELECT count(id) FROM `classifieds` where state_id=s.id and status=1 and (curdate() between classifieds.start_date and classifieds.end_date) ) state_count,
group_concat(c.City order by c.City) city_names,group_concat(c.CityId order by c.City) city_ids,
CONVERT(group_concat((SELECT count(id) FROM `classifieds` where city_id=c.CityId) order by c.City) USING utf8) city_counts 
FROM `state` s left join cities c on s.id=c.RegionID where countryID=14 group by s.id order by s.name"));

        foreach ($data as $key => $value) {
            $citiesname = explode(',', $value->city_names);
            $city_ids = explode(',', $value->city_ids);
            $city_counts = explode(',', $value->city_counts);
            $city = [];
            if ($citiesname != '') {
                foreach ($citiesname as $key1 => $value1) {
                    $city[] = array('name' => $value1, 'city_ids' => $city_ids[$key1], 'city_counts' => $city_counts[$key1]);
                }
                $value->city = $city;
            }
        }

        return $data;
    }

    public function getStateCitySubrubWithClassifiedCount() {
        
        $current_date = date('Y-m-d');
        
        $results = \App\models\State::with(['state_hasmany_cities' => function($q1) use($current_date){
                        $q1->with([
                            'city_hasmany_suburbs',
                            'city_hasmany_classifieds' => function($q2) use($current_date) {
                                $q2->where(['status' => 1])
                                ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ");
                            }]);
                    }])
                ->where(['country_id' => 14])
                ->get();




        return $results;
    }

}
