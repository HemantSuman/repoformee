<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\PrayerTiming;
use App\models\User;
use Hash;
use DB;
use Mail;
use App\Event;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Validator;
use App\Classes\PrayTime;

class PrayerTimingsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'prayer_timings';
        $this->viewName = 'prayer_timings';
        $this->modelTitle = 'PrayerTiming';
        $this->model = new PrayerTiming;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     * indexing of all prayer
     *
     * @return void
     * @access public
     */
    public function index(Request $request) {

       
        $prayer_timings = \DB::table('prayer_timings')->where('status', '=', 1)->pluck('name', 'id')->all();
        $all_countries = DB::table('countries')->where('Country', 'Australia')->pluck('Country', 'CountryId')->all();

        $inputs = $states = $cities = array();

        $start_date = date("M d, Y", strtotime("first day of this month"));
        $end_date = date("M d, Y", strtotime("last day of this month"));
        $pt_names = array('Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Sunset', 'Maghrib', 'Isha');
        $timings_data;
        $user_city = '';
        if ($request->isMethod('post')) {
            $prayTimeObj = new PrayTime($request->method);
            $latitude = $longitude = $timezone = "";
            if(!empty($request->country)) {
                $cityData = \DB::table('cities')->where('CityId', '=', $request->subregion)->select('Latitude', 'Longitude', 'City', 'TimeZone')->first();

                $latitude = $cityData->Latitude;
                $longitude = $cityData->Longitude;
                $str_time = $cityData->TimeZone;
                sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
                $timezone = $hours * 3600 + $minutes * 60;
                $user_city = $cityData->City;

                $states = \DB::table('state')->where('country_id', '=', Input::get('country'))->pluck('name', 'id')->all();
                $cities = \DB::table('cities')->where('RegionID', '=', Input::get('state'))->pluck('City', 'CityId')->all();
            }

            if(!empty($request->start_date)) {
                $date = strtotime($request->start_date);
                $endDate = strtotime($request->end_date);
                $start_date = date("M d, Y", strtotime($request->start_date));
                $end_date = date("M d, Y", strtotime($request->end_date));
            } else {
                $date = strtotime(date("M-d-Y"));
                $endDate = strtotime(date("M-d-Y"));
                $start_date = date("M d, Y", strtotime(date("M-d-Y")));
                $end_date = date("M d, Y", strtotime(date("M-d-Y")));
                $is_single_day_timing = 1;
            }

            while ($date <= $endDate) {
                $day = date('M d', $date);
                $timings_data[$day] = $prayTimeObj->getPrayerTimes($date, $latitude, $longitude, $timezone);
                $date += 24 * 60 * 60;  // next day
            }

            $inputs = Input::all();


        } else {
            
        }

        $current_date = date("Y-m-d");
        $top_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 4)->where("banner_position", "=", "top")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();
        $default_top_position_ad = \DB::table('advertisements')->where("page_id", "=", 4)->where("banner_position", "=", "top")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        
        return view('front.prayer_timings.prayer_timings', compact(
            'timings_data', 
            'user_city', 
            'start_date', 
            'end_date',
            'prayer_timings',
            'all_countries',
            'is_single_day_timing',
            'inputs',
            'states',
            'cities',
            'top_positions_ads',
            'default_top_position_ad'
        ));
    }

    /**
     *get_monthly_p_timing
     * get_monthly_p_timing
     *
     * @return void
     * @access public
     */
    public function get_monthly_p_timing(Request $request) {
        $lat = $request->lat; 
        $lng = $request->lng; 
        $tzone = $request->timezone; 
        $user_city = $request->cur_city;
        if(empty($lat) && empty($lng)) {

            $user_city = "Melbourne";
            $latitude = -37.813628;
            $longitude = 144.963058;
            $timezone = 10;
        } else {
            $latitude = $lat;
            $longitude = $lng;
            $timezone = $tzone / 60;
        }

        $prayer_timings = \DB::table('prayer_timings')->where('status', '=', 1)->pluck('name', 'id')->all();
        $default_pt = $this->model->select('id', 'name')->where('status', '=', 1)->where('is_default', '=', 1)->first();
        $is_today_timing = 1;
        $prayTime = new PrayTime($default_pt->id);
        
        $dateBegin = strtotime("first day of this month");
        $dateEnd = strtotime("last day of this month");
        $start_date = date("M d, Y", strtotime("first day of this month"));
        $end_date = date("M d, Y", strtotime("last day of this month"));
        
        $date = strtotime(date("d-M-Y", $dateBegin));
        $endDate = strtotime(date("d-M-Y", $dateEnd));
        
        while ($date <= $endDate) {
            $day = date('M d', $date);
            $timings_data[$day] = $prayTime->getPrayerTimes($date, $latitude, $longitude, $timezone);
            $date += 24 * 60 * 60;  // next day
        }

        $pt_names = array('Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Sunset', 'Maghrib', 'Isha');
        
        $current_date = date("Y-m-d");
        
        return view('front.prayer_timings.full_month_p_timing_ui', compact(
            'timings_data', 
            'final_current_day_timings',
            'is_today_timing',
            'user_city'
        ));
    }

    /**
     * get_p_timing
     * get_p_timing
     *
     * @return void
     * @access public
     */
    public function get_p_timing(Request $request) {
        $cur_time = date("Y-m-d H:i", strtotime($request->cur_time));

        $lat = $request->lat; 
        $lng = $request->lng; 
        $tzone = $request->timezone; 
        $user_city = $request->cur_city;
        if(empty($lat) && empty($lng)) {
          
            $user_city = "Melbourne";
            $latitude = -37.813628;
            $longitude = 144.963058;
            $timezone = 10;
        } else {
            $latitude = $lat;
            $longitude = $lng;
            $timezone = $tzone / 60;
        }

        $prayer_timings = \DB::table('prayer_timings')->where('status', '=', 1)->pluck('name', 'id')->all();
        $default_pt = $this->model->select('id', 'name')->where('status', '=', 1)->where('is_default', '=', 1)->first();
        $is_today_timing = 1;
        $prayTime = new PrayTime($default_pt->id);
        $current_day_timings = $prayTime->getPrayerTimes(strtotime(date("M-d-Y", strtotime($request->cur_time))), $latitude, $longitude, $timezone);
        
        if(date("Y-m-d H:i", strtotime($request->cur_time)) > date("Y-m-d H:i", strtotime(end($current_day_timings)))) {
            $is_today_timing = 0;
            $current_day_timings = $prayTime->getPrayerTimes(strtotime(date('M-d-Y', strtotime('+1 day', strtotime(date("M-d-Y", strtotime($request->cur_time)))))), $latitude, $longitude, $timezone);
        }

        $pt_names = array('Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Sunset', 'Maghrib', 'Isha');
        
        $final_current_day_timings = array_combine($pt_names, $current_day_timings);
        unset($final_current_day_timings['Sunrise'],  $final_current_day_timings['Sunset']);

        $current_date = date("Y-m-d");
        
        return view('front.prayer_timings.sidebar_p_timing_ui', compact(
            'timings_data', 
            'final_current_day_timings',
            'is_today_timing',
            'user_city',
            'cur_time'
        ));
    }

    

    

    /**
     * Check Status
     *
     * @return void
     * @access public
     */
    public function check_status($id = null) {
        $data = $this->model->where('status', 1)->where('id', '!=', $id)->get();
        return count($data);
    }

    /**
     * get_prayer_timing
     * get current day prayer timing to show at sidebar
     *
     * @return void
     * @access public
     */
    public function get_prayer_timing(Request $request) {
        if ($request->isMethod('post')) {
            $default_pt = $this->model->select('id', 'name')->where('status', '=', 1)->where('is_default', '=', 1)->first();
            $prayTime = new PrayTime($default_pt->id);
            $date = strtotime(date("M-d-Y"));
            $endDate = strtotime(date("M-d-Y"));
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            if ($latitude == 0 && $longitude == 0) {
                $timezone = 0;
            } else {
                $timezone = 10;
            }
            while ($date <= $endDate) {
                $day = date('M d', $date);
                $times[] = $prayTime->getPrayerTimes($date, $latitude, $longitude, $timezone);
                $date += 24 * 60 * 60;  // next day
            }
            $times[] = date("M d");

            $splitLastPrayerTime = explode(":", $times[0][6]);
            $user_current_time = date_parse($request->current_time);
            if ($user_current_time['hour'] >= $splitLastPrayerTime[0] && $user_current_time['minute'] > $splitLastPrayerTime[1]) {
                $date = strtotime(date('M-d-Y', strtotime(str_replace('-', '-', date("M-d-Y")) . "+1 days")));
                $endDate = strtotime(date('M-d-Y', strtotime(str_replace('-', '-', date("M-d-Y")) . "+1 days")));
                $times = null;
                while ($date <= $endDate) {
                    $day = date('M d', $date);
                    $times[] = $prayTime->getPrayerTimes($date, $latitude, $longitude, $timezone);
                    $date += 24 * 60 * 60;  // next day
                }
                $times[] = date("M d");
                return response()->json(['status' => true, 'times' => $times, 'isNextDayPrayer' => true]);
            } else {
                return response()->json(['status' => true, 'times' => $times, 'isNextDayPrayer' => false]);
            }
        }
    }

    /**
     * get_monthly_prayer_timing
     * get current month prayer timing at front
     *
     * @return void
     * @access public
     */
    public function get_monthly_prayer_timing(Request $request) {
        if ($request->isMethod('post')) {
            $default_pt = $this->model->select('id', 'name')->where('status', '=', 1)->where('is_default', '=', 1)->first();
            $prayTime = new PrayTime($default_pt->id);

            $dateBegin = strtotime("first day of this month");
            $dateEnd = strtotime("last day of this month");

            $date = strtotime(date("d-M-Y", $dateBegin));
            $endDate = strtotime(date("d-M-Y", $dateEnd));
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            if ($latitude == 0 && $longitude == 0) {
                $timezone = 0;
            } else {
                $timezone = 10;
            }
            while ($date <= $endDate) {
                $day = date('M d', $date);
                $times[$day] = $prayTime->getPrayerTimes($date, $latitude, $longitude, $timezone);
                $date += 24 * 60 * 60;  // next day
            }
            $times['day'] = date("M d");
            return view('front/prayer-timing/ptiming-of-all-month', compact('times'));
        }
    }

    /**
     * get_states
     * get states of the selected country
     *
     * @return void
     * @access public
     */
    public function get_states(Request $request) {
        if ($request->isMethod('post')) {
            $states = \DB::table('state')->select('id', 'name')->where('country_id', '=', $request->id)->get();
            return response()->json(['status' => true, 'states' => $states]);
        }
    }

    public function getprayertimingfillterdata(Request $request) {
        $countryarr1 = DB::table('countries')->where('Country', 'Australia')->select('CountryId', 'Country')->first();
        $country = DB::table('countries')->where('Country', 'Australia')->select('CountryId', 'Country')->get();
        $countryidaus1 = $countryarr1->CountryId;
        $stateCode = DB::table('state')->where('country_id', $countryidaus1)->select('id', 'name')->get();
        $cityCode = DB::table('cities')->where('CountryID', $countryidaus1)->select('CityId', 'City','RegionID', 'Latitude', 'Longitude')->get();
        $prayertimingmethod = $this->model->select('id', 'name')->where('status', '=', 1)->get();
        $result['status'] = 1;
        $result['country'] = $country;
        $result['state'] = $stateCode;
        $result['city'] = $cityCode;
        $result['prayertimingmethod'] = $prayertimingmethod;
        echo json_encode($result);
        die;
        
    }

    public function defalultactiveprayertimingapi(Request $request) {
        if ($request->isMethod('post')) {
            $default_pt = $this->model->select('id', 'name')->where('status', '=', 1)->where('is_default', '=', 1)->first();
            $result['status'] = 1;
            $result['data'] = $default_pt;
            echo json_encode($result);
            die;
        }
    }

    /**
     * get_subregions
     * get subregions of the selected state
     *
     * @return void
     * @access public
     */
    public function get_subregions(Request $request) {
        if ($request->isMethod('post')) {
            $cities = \DB::table('cities')->select('CityId', 'City', 'Latitude', 'Longitude')->where('RegionID', '=', $request->id)->get();
            return response()->json(['status' => true, 'cities' => $cities]);
        }
    }

    /**
     * get_subregions
     * get subregions of the selected state
     *
     * @return void
     * @access public
     */
    public function get_msq_subregions(Request $request) {
        if ($request->isMethod('post')) {
            $suburbs = \DB::table('subregions')->select('id', 'name')->where('region_id', '=', $request->id)->get();
            return response()->json(['status' => true, 'suburbs' => $suburbs]);
        }
    }

    public function test() {
        $prayTime = new PrayTime(2);

        $tomorrowDate = date('M-d-Y', strtotime(str_replace('-', '-', date("M-d-Y")) . "+1 days"));

        $date = strtotime($tomorrowDate);
        $endDate = strtotime($tomorrowDate);
        $times = array();
        while ($date <= $endDate) {
            $times[] = $prayTime->getPrayerTimes($date, 0, 0, 0);
            $date += 24 * 60 * 60;  // next day
        }
        dd($times);

    }

    /**
     * get_prayer_timing
     * get current day prayer timing to show at sidebar
     *
     * @return void
     * @access public
     */
    public function get_prayer_timing_for_test() {
        $default_pt = $this->model->select('id', 'name')->where('status', '=', 1)->where('is_default', '=', 1)->first();
        $prayTime = new PrayTime($default_pt->id);
        $date = strtotime(date("M-d-Y"));
        $endDate = strtotime(date("M-d-Y"));
        while ($date <= $endDate) {
            $day = date('M d', $date);
            $times[] = $prayTime->getPrayerTimes($date, -37.813628, 144.963058, +10);
            $date += 24 * 60 * 60;  // next day
        }
        $times[] = date("M d");

        $ssssss = explode(":", $times[0][6]);

        $dddd = date_parse("Fri Jan 13 2017 21:14:24 GMT+0530 (IST)");

        if ($dddd['hour'] >= $ssssss[0] && $dddd['minute'] > $ssssss[1]) {
            dd("get next day prayer");
        } else {
            dd("prayer remaining");
        }
    }

}
