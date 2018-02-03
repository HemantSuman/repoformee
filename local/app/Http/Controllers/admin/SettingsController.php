<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Event;
use Illuminate\Routing\Route;
use Session;
use Illuminate\Support\Facades\Redis;
use App\models\User;

class SettingsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {
        
    }

    /**
     * Admin index
     * indexing of all setting created by admin
     *
     * @return void
     * @access public
     */
    public function admin_index($id = null) {

        $id = Auth::guard('admin')->user()->id;
        $userObj = new User;
        $user_details = $userObj->where('id', '=', $id)->first();
        $data = Redis::keys('*');
        foreach ($data as $key => $value) {
            $result[$value] = Redis::get($value);
        }
//        dd($result);
        return view('admin/settings/index', compact('result', 'user_details'));
    }

    /**
     * Admin admin_add
     * admin_add of all setting created by admin
     *
     * @return void
     * @access public
     */
    public function admin_add() {


        $requestArr = Input::all();
        return view('admin/settings/add', compact(''));
    }

    /**
     * Admin admin_edit
     * admin_edit of all setting created by admin
     *
     * @return void
     * @access public
     */
    public function admin_edit($key = null) {

        if (isset($key)) {
            $data = Redis::get($key);
            if (isset($data)) {
                $result = [$key, $data];
            } else {
                Session::flash('alert-class', 'alert-info alert-dismissible');
                Session::flash('message', 'Key not exist.');
                return Redirect::to('admin/settings');
            }
        }
        return view('admin/settings/edit', compact('result'));
    }

    /**
     * Admin admin_create
     * admin_create of all setting created by admin
     *
     * @return void
     * @access public
     */
    public function admin_create(Request $request) {


        $requestArr = Input::all();
//        dd($requestArr);
        $this->validate($request, [
            'key' => 'required',
            'value' => 'required'
        ]);

        if (Redis::exists($requestArr['key'])) {
            Session::flash('alert-class', 'alert-danger alert-dismissible');
            Session::flash('message', 'Key already exist.');
        } else {

            Redis::set($requestArr['key'], $requestArr['value']);
            Session::flash('alert-class', 'alert-success alert-dismissible');
            Session::flash('message', 'Successfully submitted.');
        }
        return Redirect::to('admin/settings');
    }

    /**
     * Admin admin_update
     * admin_update of all setting created by admin
     *
     * @return void
     * @access public
     */
    public function admin_update(Request $request) {


        $requestArr = Input::all();

        $this->validate($request, [
            'key' => 'required',
            'value' => 'required'
        ]);

        if ($requestArr['old_key'] != $requestArr['key']) {

            if (Redis::exists($requestArr['key'])) {
                Session::flash('alert-class', 'alert-danger alert-dismissible');
                Session::flash('message', 'Key already exist.');
            } else {
                Redis::renamenx($requestArr['old_key'], $requestArr['key']);
                Session::flash('alert-class', 'alert-success alert-dismissible');
                Session::flash('message', 'Successfully submitted.');
            }
        } else {

            Redis::set($requestArr['key'], $requestArr['value']);
            Session::flash('alert-class', 'alert-success alert-dismissible');
            Session::flash('message', 'Successfully submitted.');
        }
        return Redirect::to('admin/settings');
    }

    /**
     * Admin admin_delete
     * admin_delete of all setting created by admin
     *
     * @return void
     * @access public
     */
    public function admin_delete($key = null) {


        if (isset($key)) {
            Redis::del($key);
        }
        return Redirect::to('admin/settings');
    }

    /**
     * Admin admin_import
     * import of all setting values
     *
     * @return void
     * @access public
     */
    public function admin_import($key = null) {

        $all_settings = [
            "Default-Search-Radius" => "1000",
            "home-page-bottom-ad-max-images" => "3",
            "user_299" => "user_299",
            "classified-detail-top-ad-max-images" => "3",
            "classified-detail-bottom-ad-max-images" => "3",
            "social-facebook-page-url" => "https://www.facebook.com/Formee-1512729375422926/",
            "string key" => "string val",
            "prayer-timing-top-ad-max-images" => "3",
            "keyword-filtering-spam" => "sex toys,demo 1,demo 2,demo3",
            "Recent-Classified-hours" => "600",
            "Trending-Classified-hours" => "400",
            "google-recaptcha-api-key" => "6LdUOxETAAAAAH96hlB5MPR1YbVPe_VkcIQPq3m8",
            "framework" => "AngularJS",
            "classified-detail-right-ad-max-images" => "3",
            "Halal Products" => "Food Certification",
            "social-twitter-page-url" => "https://twitter.com/FormeeFor",
            "prayer-timing-right-ad-max-images" => "3",
            "Feature-Classified-Day" => "5",
            "site-contact-email" => "nilesh@planetwebsolution.com",
            "classified-listing-right-ad-max-images" => "3",
            "home-page-top-ad-max-images" => "3",
            "home-page-right-ad-max-images" => "3",
            "social-google-plus-page-url" => "https://plus.google.com/110142128170842505936",
            "ad-posting-quantity-for-private-sellers" => "2",
            "prayer-timing-bottom-ad-max-images" => "3",
            "classified-listing-bottom-ad-max-images" => "3",
            "Unfeature-Classified-Day" => "30",
            "classified-listing-top-ad-max-images" => "3",
        ];

        foreach ($all_settings as $k => $v) {
            
            if (!Redis::exists($k)) {
                
                Redis::set($k, $v);
            }
        }
        return Redirect::to('admin/settings');
    }

}
