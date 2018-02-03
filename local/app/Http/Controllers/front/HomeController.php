<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\models\User;
use App\models\Wishlist;
use App\models\Classified;
use App\models\Message;
use App\models\Advertisement;
use App\models\Category;
use App\models\Query;
use App\Helpers\Helper;
use App\Classes\PrayTime;
use Session;
use Cookie;
use Illuminate\Support\Facades\Redis;
use Mail;
use Validator;
use Illuminate\Support\Facades\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\QueryException;
use Illuminate\Routing\Route;
use File;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {

    }

    /**
     * homepageindex show first page
     *index
     *
     * @return void
     * @access public
     */
    public function index() {

        $userObj = new User;

        //get the advertisements to show at front
        $current_date = date("Y-m-d");
        $top_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 1)->where("banner_position", "=", "top")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();
        $right_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 1)->where("banner_position", "=", "right")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();
        $bottom_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 1)->where("banner_position", "=", "bottom")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();

        $default_top_position_ad = \DB::table('advertisements')->where("page_id", "=", 1)->where("banner_position", "=", "top")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_right_position_ad = \DB::table('advertisements')->where("page_id", "=", 1)->where("banner_position", "=", "right")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_bottom_position_ad = \DB::table('advertisements')->where("page_id", "=", 1)->where("banner_position", "=", "bottom")->where("is_default", "=", 1)->where("status", "=", 1)->first();

        $feactured_category = Category::where('pid', 0)->with(['parentCategory_classifieds'])->where('feactured', 1)->where("status", "=", 1)->orderBy('created_at', 'DESC')->get();
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);

        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        $informationAreaCategories = $task->getInformationAreaCategories($selectedCategories);


        $wishlistItems = array();
        if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
            $wishlistObj = new Wishlist;
            $wishlistItems = $wishlistObj->where('user_id', '=', Auth::guard('web')->user()->id)->pluck("classified_id", "id")->all();
        } elseif (Cookie::get('wishlistItems')) {
            $wishlistItems = Cookie::get('wishlistItems');
        }

        return view('front.index', compact('top_positions_ads', 'right_positions_ads', 'bottom_positions_ads', 'default_top_position_ad', 'default_right_position_ad', 'default_bottom_position_ad', 'allSubCategories', 'feactured_category', 'allComCategories', 'allSubCategoriesForMenu', 'wishlistItems', 'informationAreaCategories'));

    }

    public function login_test() {

        if (Auth::guard('admin')->attempt(['email' => 'abhi@gmail.com', 'password' => '123456'])) {
        }

        dd(Auth::guard('admin'));
    }

    public function login_test2() {

        if (Auth::guard('web')->attempt(['email' => 'abhi@gmail.com', 'password' => '123456'])) {
            return redirect('login_test3');
        }

        dd(Auth::guard('web'));

        dd('ok');
    }

    public function apicheck() {

        die("yes");
    }

    public function login_test3() {

        dd(Auth::guard('web'));
    }


    public function admin_login() {
        if (Auth::guard('admin')->attempt(['email' => 'admin@gmail.com', 'password' => '123456'])) {
            return redirect('admin/dashboard');
        }
    }

    public function web_login() {

        if (Auth::guard('web')->attempt(['email' => 'abhi@gmail.com', 'password' => '123456'])) {
            return redirect('user/dashboard');
        }
        dd('2');
    }

     /**
     * admin_dashboard
     *admin_dashboard
     *
     * @return void
     * @access public
     */
    public function admin_dashboard() {
        dd(Auth::guard('admin')->user()->name);
        dd('admin is login');
    }

     /**
     * front logout
     *web_logout
     *
     * @return void
     * @access public
     */
    public function web_logout() {
        Auth::guard('web')->logout();
        return redirect('logout');
        dd('logout web');
    }

     /**
     * admin logout
     *admin_logout
     *
     * @return void
     * @access public
     */
    public function admin_logout() {
        Auth::guard('admin')->logout();
        return redirect('logout');
        dd('logout admin');
    }

    public function logout() {
        dd('logout done');
    }

    public function api() {
        $user = User::find(242);
        $token = $user->createToken('Token Name')->accessToken;
        dd($token);
    }

   
 /**
     * cms page
     *about_us
     *
     * @return void
     * @access public
     */
    public function about_us() {

        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        return view('front1.about_us', compact('allSubCategories', 'allComCategories', 'allSubCategoriesForMenu'));
    }

    /**
     * cms page
     *contact_us
     *
     * @return void
     * @access public
     */
    public function contact_us(Request $request) {
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        if ($request->isMethod('post')) {
            $data = new Query;
            $data->name = $mailingData["name"] = $request->name;
            $data->type = $mailingData["type"] = $request->query_type;
            $data->email = $mailingData["email"] = $request->email;
            $data->contact_query = $mailingData["contact_query"] = $request->contact_query;
            $data->status = 0;

            if ($data->save()) {
                $siteContactEmail = Redis::get('site-contact-email');
                $result = Mail::send('emails.contact_query_template_for_admin', array('mailingData' => $mailingData), function($message) use ($siteContactEmail) {
                            $message->to($siteContactEmail)->subject("Contact Query");
                        }, true);
                return Redirect::back()->withSuccess("Saved successfully.");
            } else {
                return Redirect::back()->withDanger("Could not be saved. Please try again.");
            }
        }

        return view('front1.contact_us', compact('allSubCategories', 'allComCategories', 'allSubCategoriesForMenu'));
    }

    /**
     * cms page
     *faq
     *
     * @return void
     * @access public
     */
    public function faq() {
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        return view('front.faq', compact('allSubCategories', 'allComCategories', 'allSubCategoriesForMenu'));
    }

    /**
     * lat_long_using_ip
     *lat_long_using_ip
     *
     * @return void
     * @access public
     */
    public function lat_long_using_ip() {
        $user = new User;
        $data = $user->get_lat_long_using_ip();
        $ndata = json_decode($data);
        dd($ndata);
    }

}
