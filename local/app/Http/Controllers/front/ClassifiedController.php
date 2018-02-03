<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\Classified;
use App\models\Category;
use App\models\ClassifiedImage;
use App\models\ClassifiedOther;
use App\models\Message;
use App\models\LeadEnquiry;
use App\models\User;
use App\models\Attribute;
use App\models\Wishlist;
use App\models\Report;
use App\models\CategoryRole;
use App\models\Question;
use App\models\Package;
use App\models\PackageUser;
use App\models\Review;
use Helper;
use Hash;
use DB;
use Mail;
use App\Event;
use File;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\QueryException;
use Session;
use Intervention\Image\Facades\Image as image1;
use Validator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use App\models\Classes\PrayTime;
use Illuminate\Support\Facades\Paginator;
use App\models\State;
use App\models\Role;
use App\Url;
use DateTime;
use Cookie;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttributesController;
use App\Jobs\SendReminderEmail;
use LRedis;
use Srmklive\PayPal\Services\ExpressCheckout;

class ClassifiedController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $auscountryid;

    public function __construct(Route $route, Request $request) {

        $this->viewName = 'classifieds';
        $this->modelTitle = 'Classified';
        $this->model = new Classified;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);

        $countryarr = DB::table('countries')->where('Country', 'Australia')->first();
    }

    /**
     * frontchangestatus
     * frontchangestatus classifieds 
     *
     * @return void
     * @access public
     */
    public function frontchangestatus(Request $request) {

        if ($request->isMethod('post')) {
            if ($request->state == 1) {
                $updated_data["status"] = 1;
            } else {
                $updated_data["status"] = 0;
            }
            \DB::table('classifieds')->where('id', $request->id)->update($updated_data);
        }
    }

   
    /**
     *   front classifieds index
     *  front classifieds ad posting for business users
     *
     * @return void
     * @access public
     */
    public function index() {

        $selectedCategories = null;
        $packages = new Package;
        $packages = $packages->where(['status' => 1])->get();

        $categories = new Category;
        $parent_cat = $categories->getaddclassifiedcategories();
        foreach ($parent_cat as $key => $value) {
            if (count($value['children']) == 0) {
                unset($parent_cat[$key]);
            }
        }
        $collectionCat = collect($parent_cat);
        $parentCategory = $collectionCat->groupBy('id');
        $stateCode = DB::table('state')->where('country_id', 14)->pluck('id', 'code')->toarray();
        $selectedCategories = explode(',', $selectedCategories);


        $state = DB::table('state')->pluck('name', 'id');

        if (!empty((Auth::guard('web')->user()->state))) {
            $statename = Auth::guard('web')->user()->state;
            $statedata = DB::table('state')->where("name", '=', $statename)->first();
            if (!empty($statedata)) {
                $statevalueid = $statedata->id;
            } else {
                $statevalueid = 0;
            }
        } else {
            $statevalueid = 0;
        }
        return view('front.classifieds.index', compact('parent_cat', 'state', 'stateCode', 'parentCategory', 'statevalueid', 'packages'));
    }

    /**
     * admin_allregins
     * admin_allregins classifieds 
     *
     * @return response
     * @access public
     */
    public function admin_allregins() {

        $data = Input::all();

        if (isset($data['id'])) {

            $sub_regions = DB::table('subregions')
                            ->where('region_id', $data['id'])->pluck('name', 'id');

            return response()->json(['status' => true, 'sub_regions' => $sub_regions]);
        }
    }

    /**
     * Admin create
     * function for create a product
     *
     * @return void
     * @access public
     */
    public function business_create(Request $request) {


        if ($request->isMethod('post')) {

            $requestArr = Input::all();

            $subregions_id = $requestArr['subregions_id'];
            $state_id = $requestArr['state_id'];
            $lat = $requestArr['lat'];
            $lng = $requestArr['lng'];
            if (!empty($subregions_id)) {
                $row = \DB::table('cities')->where("City", '=', $subregions_id)->first();

                if (!empty($row)) {
                    $city_id = $row->CityId;
                } else {
                    $attachmentData = array('City' => $subregions_id, 'Latitude' => $lat, 'Longitude' => $lng, 'RegionID' => $state_id);
                    $insertcityid = \DB::table('cities')->insertGetId($attachmentData);
                    $city_id = $insertcityid;
                }
            }

            $this->validate($request, [
                'title' => 'required|unique:classifieds',
                'location' => 'required',
                'state_id' => 'sometimes',
                'pincode' => 'sometimes',
                'contact_title' => 'required',
                'contact_name' => 'required',
                'contact_email' => 'required',
                'contact_mobile' => 'required',
                'end_date' => 'sometimes',
                'start_date' => 'sometimes'
            ]);
            //GET TEMPLATE DATA
            $template_arr = DB::table('templates')
                    ->leftJoin('category_template', 'templates.id', '=', 'category_template.template_id')
                    ->where('category_template.category_id', '=', $request->parent_categoryid)
                    ->first();

            if (!empty($request->other_value)) {
                foreach ($request->other_value as $key_parent => $value_parent) {

                    foreach ($value_parent as $key => $value) {
                        if ($value && $value['title'] != '') {
                            $other_value[$key_parent][$key]["other_slug"] = $key_parent;

                            if (!empty($value['title'])) {
                                $other_value[$key_parent][$key]["other_title"] = $value['title'];
                            } else {
                                $other_value[$key_parent][$key]["other_title"] = '';
                            }

                            if (!empty($value['desc'])) {
                                $other_value[$key_parent][$key]["other_value"] = $value['desc'];
                            } else {
                                $other_value[$key_parent][$key]["other_value"] = '';
                            }

                            if (isset($value['content_type']) && !empty($value['content_type'])) {
                                $other_value[$key_parent][$key]["content_type"] = $value['content_type'];
                            } else {
                                $other_value[$key_parent][$key]["content_type"] = '';
                            }

                            if (!empty($value['url'])) {
                                $other_value[$key_parent][$key]["url"] = $value['url'];
                            } else {
                                $other_value[$key_parent][$key]["url"] = '';
                            }

                            if (!empty($value['image'])) {
                                $other_value[$key_parent][$key]["image"] = $ran = rand(11111, 99999) . '.' . $value['image']->getClientOriginalExtension();
                                $other_value[$key_parent][$key]["image_arr"] = $value['image'];
                            } else {
                                $other_value[$key_parent][$key]["image"] = '';
                                $other_value[$key_parent][$key]["image_arr"] = [];
                            }
                        }
                    }
                }
            }

            if (!empty($template_arr) && $template_arr->questions_answer == 1 && $request->questions) {

                foreach ($request->questions as $key => $value) {

                    if ($value['question']) {
                        $questions[$key]["question"] = $value['question'];
                        $questions[$key]["ans_type"] = $value['ans_type'];
                        if (!empty($value['options'])) {
                            $questions[$key]["options"] = $value['options'];
                        }
                    }
                }
            }

            $exceptFields = ['_token', 'attr_ids', 'fileuploader-list-image', 'other_value', 'classified_type'];
            $data = new Classified();
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }
            if ($request->classified_type == 'premium') {
                $data->is_premium = 1;
            } else if ($request->classified_type == 'featured') {
                $data->featured_classified = 1;
                $data->is_premium = 0;
                $data->is_premium_parent_cat = 0;
                $data->is_premium_sub_cat = 0;
            } else {
                $data->is_premium = 0;
                $data->is_premium_parent_cat = 0;
                $data->is_premium_sub_cat = 0;
            }

            if (isset($request->state_id) && $request->state_id == '') {
                $data->state_id = 0;
            }

            if (isset($city_id)) {
                $data->city_id = $city_id;
            }
            if (isset($request->subregions_id) && $request->subregions_id == '') {
                $data->subregions_id = 0;
            }

            $data->status = 4;
            $data->user_id = Auth::guard('web')->user()->id;

            $data->start_date = date("Y-m-d");
            $data->end_date = date("Y-m-d", strtotime("+" . Redis::get('Unfeature-Classified-Day') . " day"));

            if (isset($request->min_offer_check) && $request->min_offer_check == 'on') {
                $data->min_offer_check = 1;
            } else {
                $data->min_offer_check = 0;
            }

            if (isset($request->pay_pal) && $request->pay_pal == 'on') {
                $data->pay_pal = 1;
            } else {
                $data->pay_pal = 0;
            }

            if (isset($request->pic_n_pay) && $request->pic_n_pay == 'on') {
                $data->pic_n_pay = 1;
            } else {
                $data->pic_n_pay = 0;
            }
//for multi-select - checkbox
            if (isset($request->attr_value_multi) && $request->attr_value_multi) {

                foreach ($request->attr_value_multi as $key => $value) {
                    foreach ($value as $k => $v) {

                        $extra1[$v]["attribute_id"] = $key;
                        $extra1[$v]["attr_type_name"] = $request->attr_type_name_multi;
                        $extra1[$v]["attr_type_id"] = $request->attr_type_id_multi;
                        $extra1[$v]["attr_value"] = $v;
                    }
                }
            } else {
                $extra1 = [];
            }

//for Radio
            if (isset($request->attr_value_radio) && $request->attr_value_radio) {

                foreach ($request->attr_value_radio as $key => $value) {
                    foreach ($value as $k => $v) {

                        $extra2[$v]["attribute_id"] = $key;
                        $extra2[$v]["attr_type_name"] = $request->attr_type_name_radio;
                        $extra2[$v]["attr_type_id"] = $request->attr_type_id_radio;
                        $extra2[$v]["attr_value"] = $v;
                    }
                }
                $extra1 = $extra1 + $extra2;
            }

            $requestArr1['attr_ids'] = [];
            if (isset($requestArr['attr_ids']) && !empty($requestArr['attr_ids'])) {

                foreach ($request->attr_type_name as $key => $value) {
                    if ($request->attr_value[$key] != '') {
                        $extra[$key]["attr_type_name"] = $value;
                        $extra[$key]["attr_type_id"] = $request->attr_type_id[$key];
                        $extra[$key]["attr_value"] = $request->attr_value[$key];
                        $extra[$key]["parent_value_id"] = $request->parent_value_id[$key];
                        $extra[$key]["parent_attribute_id"] = $request->parent_attribute_id[$key];

                        $requestArr1['attr_ids'][$key] = $requestArr['attr_ids'][$key];
                    }
                }
                $dataExtra = array_combine($requestArr1['attr_ids'], $extra);
            }
            //forVideo Type
            if (Input::file('attr_value_video')) {
                $attr_value_video = Input::file('attr_value_video');
                foreach ($attr_value_video as $key => $val) {
                    $extension = $val->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $VideoNameAttrType[] = $ran . '.' . $extension;
                    $extraVideo[$request->attr_ids_video[$key]]["attr_type_name"] = $request->attr_type_name_video[$key];
                    $extraVideo[$request->attr_ids_video[$key]]["attr_type_id"] = $request->attr_type_id_video[$key];
                    $extraVideo[$request->attr_ids_video[$key]]["attr_value"] = $VideoNameAttrType[$key];
                }
                if (isset($dataExtra) && !empty($dataExtra)) {
                    $dataExtra = $dataExtra + $extraVideo;
                } else {
                    $dataExtra = $extraVideo;
                }
            }

            $classified = $this->model->create($data->toArray());
            if (isset($dataExtra) && !empty($dataExtra)) {
                $classified->classified_attribute()->sync($dataExtra);
            }

            if (isset($extra1) && !empty($extra1)) {
                foreach ($extra1 as $ke => $val) {
                    $val['classified_id'] = $classified->id;
                    \DB::table('attribute_classified')->insert($val);
                }
            }

            if (!empty($other_value)) {
                foreach ($other_value as $key => $value) {
                    $other_save = [];
                    $other_save['other_slug'] = $key;
                    foreach ($value as $k => $val) {

                        $other_save['classified_id'] = $classified->id;
                        $other_save['other_title'] = $val['other_title'];
                        $other_save['other_value'] = $val['other_value'];
                        $other_save['image'] = $val['image'];
                        $other_save['url'] = $val['url'];
                        $other_save['content_type'] = $val['content_type'];

                        \DB::table('classified_other')->insert($other_save);
                        if (!empty($val['image_arr'])) {
                            if (!is_dir('upload_images/others/')) {
                                File::makeDirectory('upload_images/others/', 0777, true);
                            }
                            $destinationPath = 'upload_images/others/';
                            $val['image_arr']->move($destinationPath, $val['image']);
                        }
                    }
                }
            }

            if (isset($questions) && !empty($questions)) {
                foreach ($questions as $ke => $val) {

                    $q = new Question;

                    $q['classified_id'] = $classified->id;
                    $q['question'] = $val['question'];
                    $q['ans_type'] = $val['ans_type'];
                    $q = $q->create($q->toArray());
                    if (!empty($val['options'])) {
                        foreach ($val['options'] as $k1 => $v1) {
                            $opt['classified_id'] = $classified->id;
                            $opt['question_id'] = $q->id;
                            $opt['option_value'] = $v1;
                            \DB::table('options')->insert($opt);
                        }
                    }
                }
            }
            $lastinstertid = $classified->id;
            if ($lastinstertid) {
                if (Input::file('image')) {
                    $image = Input::file('image');

                    $attachmentData = array();
                    if (!is_dir('upload_images/classified/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/30px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/30px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/950x530px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/950x530px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/285x217px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/285x217px/' . $lastinstertid, 0777, true);
                    }
                    foreach ($image as $key => $val) {



                        $destinationPath = 'upload_images/classified/' . $lastinstertid . '/';

                        $destinationPaththumb = 'upload_images/classified/30px/' . $lastinstertid . '/';
                        $destinationPaththumb150x100px = 'upload_images/classified/950x530px/' . $lastinstertid . '/';
                        $destinationPaththumb285x217px = 'upload_images/classified/285x217px/' . $lastinstertid . '/';
                        $extension = $val->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $fileName = $ran . '.' . $extension;

                        $val->move($destinationPath, $fileName);
                        image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                        image1::make($destinationPath . $fileName)->resize(950, 530)->save($destinationPaththumb150x100px . $fileName);
                        image1::make($destinationPath . $fileName)->resize(285, 217)->save($destinationPaththumb285x217px . $fileName);
                        $attachmentData[] = array('classified_id' => $lastinstertid, 'name' => $fileName);
                    }
                    \DB::table('classifiedimage')->insert($attachmentData);
                }
            }
            
            //For Videotype attribute value
            if (Input::file('attr_value_video')) {
                $attr_value_video = Input::file('attr_value_video');
                foreach ($attr_value_video as $key => $val) {
                    File::makeDirectory('upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key], 0777, true);
                    $destinationPath = 'upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key] . '/';
                    $val->move($destinationPath, $VideoNameAttrType[$key]);
                }
            }
            return response()->json(['status' => true, 'id' => $lastinstertid]);
        }
    }

    /**
     * Admin create
     * function for create a product
     *
     * @return void
     * @access public
     */
    public function private_post_create(Request $request) {


        if ($request->isMethod('post')) {

            $requestArr = Input::all();

            $subregions_id = $requestArr['subregions_id'];
            $state_id = $requestArr['state_id'];
            $lat = $requestArr['lat'];
            $lng = $requestArr['lng'];
            if (!empty($subregions_id)) {
                $row = \DB::table('cities')->where("City", '=', $subregions_id)->first();

                if (!empty($row)) {
                    $city_id = $row->CityId;
                } else {
                    $attachmentData = array('City' => $subregions_id, 'Latitude' => $lat, 'Longitude' => $lng, 'RegionID' => $state_id);
                    $insertcityid = \DB::table('cities')->insertGetId($attachmentData);
                    $city_id = $insertcityid;
                }
            }

            $this->validate($request, [
                'title' => 'required',
                'location' => 'required',
                'state_id' => 'sometimes',
                'pincode' => 'sometimes',
                'contact_title' => 'required',
                'contact_name' => 'required',
                'contact_email' => 'required',
                'contact_mobile' => 'required',
                'end_date' => 'sometimes',
                'start_date' => 'sometimes'
            ]);
            //GET TEMPLATE DATA
            $template_arr = DB::table('templates')
                    ->leftJoin('category_template', 'templates.id', '=', 'category_template.template_id')
                    ->where('category_template.category_id', '=', $request->parent_categoryid)
                    ->first();

            if (!empty($request->other_value)) {
                foreach ($request->other_value as $key_parent => $value_parent) {

                    foreach ($value_parent as $key => $value) {
                        if ($value && $value['title'] != '') {
                            $other_value[$key_parent][$key]["other_slug"] = $key_parent;

                            if (!empty($value['title'])) {
                                $other_value[$key_parent][$key]["other_title"] = $value['title'];
                            } else {
                                $other_value[$key_parent][$key]["other_title"] = '';
                            }

                            if (!empty($value['desc'])) {
                                $other_value[$key_parent][$key]["other_value"] = $value['desc'];
                            } else {
                                $other_value[$key_parent][$key]["other_value"] = '';
                            }

                            if (isset($value['content_type']) && !empty($value['content_type'])) {
                                $other_value[$key_parent][$key]["content_type"] = $value['content_type'];
                            } else {
                                $other_value[$key_parent][$key]["content_type"] = '';
                            }

                            if (!empty($value['url'])) {
                                $other_value[$key_parent][$key]["url"] = $value['url'];
                            } else {
                                $other_value[$key_parent][$key]["url"] = '';
                            }

                            if (!empty($value['image'])) {
                                $other_value[$key_parent][$key]["image"] = $ran = rand(11111, 99999) . '.' . $value['image']->getClientOriginalExtension();
                                $other_value[$key_parent][$key]["image_arr"] = $value['image'];
                            } else {
                                $other_value[$key_parent][$key]["image"] = '';
                                $other_value[$key_parent][$key]["image_arr"] = [];
                            }
                        }
                    }
                }
            }

            if (!empty($template_arr) && $template_arr->questions_answer == 1 && $request->questions) {

                foreach ($request->questions as $key => $value) {

                    if ($value['question']) {
                        $questions[$key]["question"] = $value['question'];
                        $questions[$key]["ans_type"] = $value['ans_type'];
                        if (!empty($value['options'])) {
                            $questions[$key]["options"] = $value['options'];
                        }
                    }
                }
            }

            $exceptFields = ['_token', 'attr_ids', 'fileuploader-list-image', 'other_value'];
            $data = new Classified();
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if (isset($request->state_id) && $request->state_id == '') {
                $data->state_id = 0;
            }

            if (isset($city_id)) {
                $data->city_id = $city_id;
            }
            if (isset($request->subregions_id) && $request->subregions_id == '') {
                $data->subregions_id = 0;
            }

            $data->status = 4;
            $data->user_id = Auth::guard('web')->user()->id;

            $data->start_date = date("Y-m-d");
            $data->end_date = date("Y-m-d", strtotime("+" . Redis::get('Unfeature-Classified-Day') . " day"));

            if (isset($request->min_offer_check) && $request->min_offer_check == 'on') {
                $data->min_offer_check = 1;
            } else {
                $data->min_offer_check = 0;
            }

            if (isset($request->pay_pal) && $request->pay_pal == 'on') {
                $data->pay_pal = 1;
            } else {
                $data->pay_pal = 0;
            }

            if (isset($request->pic_n_pay) && $request->pic_n_pay == 'on') {
                $data->pic_n_pay = 1;
            } else {
                $data->pic_n_pay = 0;
            }
//for multi-select - checkbox
            if (isset($request->attr_value_multi) && $request->attr_value_multi) {

                foreach ($request->attr_value_multi as $key => $value) {
                    foreach ($value as $k => $v) {

                        $extra1[$v]["attribute_id"] = $key;
                        $extra1[$v]["attr_type_name"] = $request->attr_type_name_multi;
                        $extra1[$v]["attr_type_id"] = $request->attr_type_id_multi;
                        $extra1[$v]["attr_value"] = $v;
                    }
                }
            } else {
                $extra1 = [];
            }

//for Radio
            if (isset($request->attr_value_radio) && $request->attr_value_radio) {

                foreach ($request->attr_value_radio as $key => $value) {
                    foreach ($value as $k => $v) {

                        $extra2[$v]["attribute_id"] = $key;
                        $extra2[$v]["attr_type_name"] = $request->attr_type_name_radio;
                        $extra2[$v]["attr_type_id"] = $request->attr_type_id_radio;
                        $extra2[$v]["attr_value"] = $v;
                    }
                }
                $extra1 = $extra1 + $extra2;
            }

            $requestArr1['attr_ids'] = [];
            if (isset($requestArr['attr_ids']) && !empty($requestArr['attr_ids'])) {

                foreach ($request->attr_type_name as $key => $value) {
                    if ($request->attr_value[$key] != '') {
                        $extra[$key]["attr_type_name"] = $value;
                        $extra[$key]["attr_type_id"] = $request->attr_type_id[$key];
                        $extra[$key]["attr_value"] = $request->attr_value[$key];
                        $extra[$key]["parent_value_id"] = $request->parent_value_id[$key];
                        $extra[$key]["parent_attribute_id"] = $request->parent_attribute_id[$key];

                        $requestArr1['attr_ids'][$key] = $requestArr['attr_ids'][$key];
                    }
                }
                $dataExtra = array_combine($requestArr1['attr_ids'], $extra);
            }
            //forVideo Type
            if (Input::file('attr_value_video')) {
                $attr_value_video = Input::file('attr_value_video');
                foreach ($attr_value_video as $key => $val) {
                    $extension = $val->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $VideoNameAttrType[] = $ran . '.' . $extension;
                    $extraVideo[$request->attr_ids_video[$key]]["attr_type_name"] = $request->attr_type_name_video[$key];
                    $extraVideo[$request->attr_ids_video[$key]]["attr_type_id"] = $request->attr_type_id_video[$key];
                    $extraVideo[$request->attr_ids_video[$key]]["attr_value"] = $VideoNameAttrType[$key];
                }
                if (isset($dataExtra) && !empty($dataExtra)) {
                    $dataExtra = $dataExtra + $extraVideo;
                } else {
                    $dataExtra = $extraVideo;
                }
            }

            $classified = $this->model->create($data->toArray());
            if (isset($dataExtra) && !empty($dataExtra)) {
                $classified->classified_attribute()->sync($dataExtra);
            }
            $package_users = new PackageUser;
            $package_users = $package_users->saveAll($data->package_id, $classified->id);

            DB::table('classifieds')->where('id', $classified->id)->update(['package_user_id' => $package_users->id]);

            if (isset($extra1) && !empty($extra1)) {
                foreach ($extra1 as $ke => $val) {
                    $val['classified_id'] = $classified->id;
                    \DB::table('attribute_classified')->insert($val);
                }
            }

            if (!empty($other_value)) {
                foreach ($other_value as $key => $value) {
                    $other_save = [];
                    $other_save['other_slug'] = $key;
                    foreach ($value as $k => $val) {

                        $other_save['classified_id'] = $classified->id;
                        $other_save['other_title'] = $val['other_title'];
                        $other_save['other_value'] = $val['other_value'];
                        $other_save['image'] = $val['image'];
                        $other_save['url'] = $val['url'];
                        $other_save['content_type'] = $val['content_type'];

                        \DB::table('classified_other')->insert($other_save);
                        if (!empty($val['image_arr'])) {
                            if (!is_dir('upload_images/others/')) {
                                File::makeDirectory('upload_images/others/', 0777, true);
                            }
                            $destinationPath = 'upload_images/others/';
                            $val['image_arr']->move($destinationPath, $val['image']);
                        }
                    }
                }
            }

            if (isset($questions) && !empty($questions)) {
                foreach ($questions as $ke => $val) {

                    $q = new Question;

                    $q['classified_id'] = $classified->id;
                    $q['question'] = $val['question'];
                    $q['ans_type'] = $val['ans_type'];
                    $q = $q->create($q->toArray());
                    if (!empty($val['options'])) {
                        foreach ($val['options'] as $k1 => $v1) {
                            $opt['classified_id'] = $classified->id;
                            $opt['question_id'] = $q->id;
                            $opt['option_value'] = $v1;
                            \DB::table('options')->insert($opt);
                        }
                    }
                }
            }
            $lastinstertid = $classified->id;
            if ($lastinstertid) {
                if (Input::file('image')) {
                    $image = Input::file('image');

                    $attachmentData = array();
                    if (!is_dir('upload_images/classified/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/30px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/30px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/950x530px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/950x530px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/285x217px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/285x217px/' . $lastinstertid, 0777, true);
                    }
                    foreach ($image as $key => $val) {



                        $destinationPath = 'upload_images/classified/' . $lastinstertid . '/';

                        $destinationPaththumb = 'upload_images/classified/30px/' . $lastinstertid . '/';
                        $destinationPaththumb150x100px = 'upload_images/classified/950x530px/' . $lastinstertid . '/';
                        $destinationPaththumb285x217px = 'upload_images/classified/285x217px/' . $lastinstertid . '/';
                        $extension = $val->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $fileName = $ran . '.' . $extension;

                        $val->move($destinationPath, $fileName);
                        image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                        image1::make($destinationPath . $fileName)->resize(950, 530)->save($destinationPaththumb150x100px . $fileName);
                        image1::make($destinationPath . $fileName)->resize(285, 217)->save($destinationPaththumb285x217px . $fileName);
                        $attachmentData[] = array('classified_id' => $lastinstertid, 'name' => $fileName);
                    }
                    \DB::table('classifiedimage')->insert($attachmentData);
                }
            }

            //For Videotype attribute value
            if (Input::file('attr_value_video')) {
                $attr_value_video = Input::file('attr_value_video');
                foreach ($attr_value_video as $key => $val) {
                    File::makeDirectory('upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key], 0777, true);
                    $destinationPath = 'upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key] . '/';
                    $val->move($destinationPath, $VideoNameAttrType[$key]);
                }
            }
			
			

            Session::flash('type', 'success');
            Session::flash('message', 'Your Classified has been submitted Successfully.');
           return response()->json(['status' => true, 'id' => $lastinstertid]);
        }
    }

/*
private_post_paypal_success
Get PayPal response when user purchase a package for As Posting


*/
	public function private_post_paypal_success(Request $request){
		
		$provider = new ExpressCheckout; 
		
		
		$data=array();
		
		$token = $request->token;
		$payerid = $request->PayerID;
		

		$response = $provider->getExpressCheckoutDetails($token);
		
		
		if($response['ACK'] == 'Success'){
			
			$invid = $response['INVNUM'];
			
				$package_data = DB::table('package_users')->select('package_name', 'package_price')->where(['classified_id'=>$invid])->first();
		
			
			$data = [];
			$data['items'] = [
				[
					'name' => $package_data->package_name,
					'price' => $package_data->package_price,
					'qty' => 1
				]
			];
			
			$data['invoice_id'] = $invid;
			$data['invoice_description'] = "Classified ID #{$invid} Invoice";
			
			$total = 0;
			foreach($data['items'] as $item) {
				$total += $item['price']*$item['qty'];
			}
			
			$data['total'] = $total;
			
			$response = $provider->doExpressCheckoutPayment($data, $token, $payerid);
			if($response['ACK'] == 'Success'){
				
				 $updated_data["status"] = 2;
				 $updated_data["paypal_token"] = $token;
				 $updated_data["paypal_payer_id"] = $payerid;
				 $updated_data["paypal_transaction_id"] = $response['PAYMENTINFO_0_TRANSACTIONID'];
				 
				 $updated_data_classified["status"] = 2;
				 
					\DB::table('package_users')->where('classified_id', $invid)->update($updated_data);
					DB::table('classifieds')->where('id', $invid)->update($updated_data_classified);
		
					Session::flash('type', 'success');
					Session::flash('message', 'Your Classified has been submitted Successfully.');
					return Redirect::to('user/dashboard');
				
				
			}else{
					Session::flash('alert-class', 'alert-warning');
            		Session::flash('message', 'Something wrong, please try again.');
					return Redirect::to('user/dashboard');
			}
			

			
		}else{
					Session::flash('alert-class', 'alert-warning');
            		Session::flash('message', 'Something wrong, please try again.');
					return Redirect::to('user/dashboard');
			}
		
		
		
	}


    /**
     *  front classifieds create
     * create classifieds 
     *
     * @return void
     * @access public
     */
    public function create(Request $request) {


        if ($request->isMethod('post')) {

            $requestArr = Input::all();

            $subregions_id = $requestArr['subregions_id'];
            $state_id = $requestArr['state_id'];
            $lat = $requestArr['lat'];
            $lng = $requestArr['lng'];
            if (!empty($subregions_id)) {
                $row = \DB::table('cities')->where("City", '=', $subregions_id)->first();

                if (!empty($row)) {
                    $city_id = $row->CityId;
                } else {
                    $attachmentData = array('City' => $subregions_id, 'Latitude' => $lat, 'Longitude' => $lng, 'RegionID' => $state_id);
                    $insertcityid = \DB::table('cities')->insertGetId($attachmentData);
                    $city_id = $insertcityid;
                }
            }

            $this->validate($request, [
                'title' => 'required',
                'attr_value_video.*' => 'sometimes|required|max:50000',
                'location' => 'sometimes',
                'state_id' => 'sometimes',
                'pincode' => 'sometimes',
                'contact_name' => 'sometimes',
                'contact_email' => 'sometimes',
                'contact_mobile' => 'sometimes',
                'end_date' => 'sometimes',
                'start_date' => 'sometimes'
                    ], [
                'pCatId.required' => 'category is required.',
            ]);


            $exceptFields = ['_token', 'attr_ids', 'fileuploader-list-image'];
            $data = new Classified();
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }
            if (isset($request->category_id) && $request->category_id == '') {
                $data->category_id = 0;
            }

            if (isset($request->state_id) && $request->state_id == '') {
                $data->state_id = 0;
            }

            if (isset($city_id)) {
                $data->city_id = $city_id;
            }
            if (isset($request->subregions_id) && $request->subregions_id == '') {
                $data->subregions_id = 0;
            }

            $data->status = 2;
            $data->user_id = Auth::guard('web')->user()->id;

            $data->start_date = date("Y-m-d");
            $data->end_date = date("Y-m-d", strtotime("+" . Redis::get('Unfeature-Classified-Day') . " day"));

            if (isset($request->withCommunty) && $request->withCommunty == 1) {
                $data->end_date = '';
            }

            if (isset($request->withCommunty) && $request->withCommunty == 1) {
                $data->price = 0;
            }
//for multi-select - checkbox
            if (isset($request->attr_value_multi) && $request->attr_value_multi) {

                foreach ($request->attr_value_multi as $key => $value) {
                    foreach ($value as $k => $v) {

                        $extra1[$v]["attribute_id"] = $key;
                        $extra1[$v]["attr_type_name"] = $request->attr_type_name_multi;
                        $extra1[$v]["attr_type_id"] = $request->attr_type_id_multi;
                        $extra1[$v]["attr_value"] = $v;
                    }
                }
            } else {
                $extra1 = [];
            }

//for Radio
            if (isset($request->attr_value_radio) && $request->attr_value_radio) {

                foreach ($request->attr_value_radio as $key => $value) {
                    foreach ($value as $k => $v) {

                        $extra2[$v]["attribute_id"] = $key;
                        $extra2[$v]["attr_type_name"] = $request->attr_type_name_radio;
                        $extra2[$v]["attr_type_id"] = $request->attr_type_id_radio;
                        $extra2[$v]["attr_value"] = $v;
                    }
                }
                $extra1 = $extra1 + $extra2;
            }
//for Image Gallery
            $requestArr1['attr_ids'] = [];
            if (isset($requestArr['attr_ids']) && !empty($requestArr['attr_ids'])) {

                foreach ($request->attr_type_name as $key => $value) {
                    if ($request->attr_value[$key] != '') {
                        $extra[$key]["attr_type_name"] = $value;
                        $extra[$key]["attr_type_id"] = $request->attr_type_id[$key];
                        $extra[$key]["attr_value"] = $request->attr_value[$key];
                        $extra[$key]["parent_value_id"] = $request->parent_value_id[$key];
                        $extra[$key]["parent_attribute_id"] = $request->parent_attribute_id[$key];

                        $requestArr1['attr_ids'][$key] = $requestArr['attr_ids'][$key];
                    }
                }
                $dataExtra = array_combine($requestArr1['attr_ids'], $extra);
            }

            $classified = $this->model->create($data->toArray());
            if (isset($dataExtra) && !empty($dataExtra)) {
                $classified->classified_attribute()->sync($dataExtra);
            }

            if (isset($extra1) && !empty($extra1)) {
                foreach ($extra1 as $ke => $val) {
                    $val['classified_id'] = $classified->id;
                    \DB::table('attribute_classified')->insert($val);
                }
            }

            $lastinstertid = $classified->id;
            if ($lastinstertid) {
                if (Input::file('image')) {
                    $image = Input::file('image');

                    $attachmentData = array();
                    if (!is_dir('upload_images/classified/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/30px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/30px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/950x530px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/950x530px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/285x217px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/285x217px/' . $lastinstertid, 0777, true);
                    }
                    foreach ($image as $key => $val) {



                        $destinationPath = 'upload_images/classified/' . $lastinstertid . '/';

                        $destinationPaththumb = 'upload_images/classified/30px/' . $lastinstertid . '/';
                        $destinationPaththumb150x100px = 'upload_images/classified/950x530px/' . $lastinstertid . '/';
                        $destinationPaththumb285x217px = 'upload_images/classified/285x217px/' . $lastinstertid . '/';
                        $extension = $val->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $fileName = $ran . '.' . $extension;

                        $val->move($destinationPath, $fileName);
                        image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                        image1::make($destinationPath . $fileName)->resize(950, 530)->save($destinationPaththumb150x100px . $fileName);
                        image1::make($destinationPath . $fileName)->resize(285, 217)->save($destinationPaththumb285x217px . $fileName);
                        $attachmentData[] = array('classified_id' => $lastinstertid, 'name' => $fileName);
                    }
                    \DB::table('classifiedimage')->insert($attachmentData);
                }

//For ImagesGallery attribute value
                if (Input::file('attr_value_image')) {
                    $attr_value_images = Input::file('attr_value_image');

                    foreach ($attr_value_images as $key => $val) {
                        foreach ($val as $k => $v) {

                            if (!is_dir('upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key)) {
                                File::makeDirectory('upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key, 0777, true);
                            }
                            $destinationPath = 'upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key . '/';

                            $v->move($destinationPath, $fileNameAttrTypeImageGallery[$key][$k]);
                        }
                    }
                }
            }

            Session::flash('type', 'success');
            Session::flash('message', 'Your Classified has been submitted Successfully.');
            return response()->json(['status' => true, 'url' => 'post-classified']);
        }
    }

    /**
     *  front classifieds update
     * update classifieds 
     *
     * @return void
     * @access public
     */
    public function update(Request $request) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        if ($request->isMethod('post')) {

            $input = Input::all();
            $id = $request->id;
            $subregions_id = $request->subregions_id;
            $lat = $request['lat'];
            $lng = $request['lng'];
            if (!empty($subregions_id)) {
                $row = \DB::table('cities')->where("City", '=', $subregions_id)->first();
                if (!empty($row)) {
                    $city_id = $row->CityId;
                } else {
                    $attachmentData = array('City' => $subregions_id, 'Latitude' => $lat, 'Longitude' => $lng);
                    $insertcityid = \DB::table('cities')->insertGetId($attachmentData);
                    $city_id = $insertcityid;
                }
            }
            $this->validate($request, [
                'title' => 'required|unique:classifieds,title,' . $id,
                'parent_categoryid' => 'required',
                'location' => 'sometimes',
                'state_id' => 'sometimes',
                'pincode' => 'sometimes',
                'contact_name' => 'sometimes',
                'contact_email' => 'sometimes',
                'contact_mobile' => 'sometimes',
            ]);
            $saved_image = $this->model->where('id', '=', $id)->with('classified_image')->first();
            if (empty($saved_image->classified_image->toarray()) && !($request['image'])) {
                $nbr = count(Input::file('image')) - 1;
                foreach (range(0, $nbr) as $index) {
                    $rules['image.' . $index] = 'required | mimes:jpeg,png|max:3000';
                }

                $validator = Validator::make($input, $rules);
                if ($validator->fails()) {

                    $messages = $validator->messages();
                    return \Response::json($messages, 417);
                }
            }

            $requestArr = Input::all();
            $exceptFields = ['_token', 'attr_type_name', 'attr_type_id', 'attr_value', 'attr_ids', 'parent_value_id', 'parent_attribute_id', 'image', 'attr_ids_multi',
                'attr_value_multi', 'attr_type_id_multi', 'attr_type_name_multi', 'attr_type_name_file', 'attr_type_id_file',
                'attr_ids_file', 'attr_value_file_old', 'attr_value_file', 'hour', 'minute', 'meridian', 'attr_type_name_video',
                'attr_type_id_video', 'attr_ids_video', 'attr_value_video_old', 'attr_value_video',
                'attr_ids_radio', 'attr_value_radio', 'attr_type_id_radio', 'attr_type_name_radio', 'attr_type_name_image',
                'attr_type_name_image', 'attr_type_id_image', 'attr_ids_image', 'attr_value_image_old', 'attr_value_image', 'withCommunty', 'city',
                'other_value'];
            $data = $this->model->findOrFail($requestArr['id']);

            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if (isset($request->category_id) && $request->category_id == '') {
                $data->category_id = 0;
            }

            if (isset($request->state_id) && $request->state_id == '') {
                $data->state_id = 0;
            }
            if (isset($city_id)) {
                $data->city_id = $city_id;
            }

            if (isset($request->subregions_id) && $request->subregions_id == '') {
                $data->subregions_id = 0;
            }

            if (!isset($request->featured_classified) && $request->featured_classified != 1) {
                $data->featured_classified = 0;
            }

            if (isset($request->start_date) && $request->start_date != '') {
                $request->start_date = new \DateTime($request->start_date);
                $data->start_date = date_format($request->start_date, 'Y-m-d');
            } else {
                $data->start_date = date("Y-m-d");
            }


            if (isset($request->end_date) && $request->end_date != '') {
                $request->end_date = new \DateTime($request->end_date);
                $data->end_date = date_format($request->end_date, 'Y-m-d');
            } else {
                if ($data->featured_classified == 0) {
                    $data->end_date = date("Y-m-d", strtotime($data->start_date . "+" . Redis::get('Unfeature-Classified-Day') . " day"));
                } else {
                    $data->end_date = date("Y-m-d", strtotime($data->start_date . "+" . Redis::get('Feature-Classified-Day') . " day"));
                }
            }
            if (isset($request->withCommunty) && $request->withCommunty == 1) {
                $data->end_date = '9999-01-01';
            }
            if (isset($request->withCommunty) && $request->withCommunty == 1) {
                $data->price = 0;
            }
            if (isset($request->description)) {
                $data->description = $request->description;
            }

            $data->status = 2;
            $extra1 = [];
            $extra2 = [];
            $extra3 = [];
            $extra4 = [];
            $dataExtra = [];
            if (isset($requestArr['attr_ids_multi']) && !empty($requestArr['attr_ids_multi'])) {

                foreach ($request->attr_value_multi as $key => $value) {
                    foreach ($value as $k => $v) {

                        $extra1[$v]["attribute_id"] = $key;
                        $extra1[$v]["attr_type_name"] = $request->attr_type_name_multi;
                        $extra1[$v]["attr_type_id"] = $request->attr_type_id_multi;
                        $extra1[$v]["attr_value"] = $v;
                    }
                }
            } else {
                $extra1 = [];
            }
            if (isset($requestArr['attr_ids_radio']) && !empty($requestArr['attr_ids_radio'])) {
                if (isset($request->attr_value_radio)) {
                    foreach ($request->attr_value_radio as $key => $value) {
                        foreach ($value as $k => $v) {

                            $extra2[$v]["attribute_id"] = $key;
                            $extra2[$v]["attr_type_name"] = $request->attr_type_name_radio;
                            $extra2[$v]["attr_type_id"] = $request->attr_type_id_radio;
                            $extra2[$v]["attr_value"] = $v;
                        }
                    }
                }
                $extra1 = $extra1 + $extra2;
            }
            if (isset($request->attr_ids_image)) {
                foreach ($request->attr_ids_image as $key => $value) {

                    if (isset($request->attr_value_image[$value]) && (!empty($request->attr_value_image[$value]))) {
                        foreach ($request->attr_value_image[$value] as $k => $v) {
                            $extension = $v->getClientOriginalExtension();
                            $ran = rand(11111, 99999);
                            $fileNameAttrTypeImageGallery[$value][] = $ran . '.' . $extension;

                            $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attribute_id"] = $value;
                            $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attr_type_name"] = $request->attr_type_name_image;
                            $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attr_type_id"] = $request->attr_type_id_image;
                            $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attr_value"] = $fileNameAttrTypeImageGallery[$value][$k];
                        }
                        $extra1 = $extra1 + $extra3;
                    }
                    if (!empty($request->attr_value_image_old)) {
                        foreach ($request->attr_value_image_old[$value] as $k1 => $v1) {

                            $extra4[$v1]["attribute_id"] = $value;
                            $extra4[$v1]["attr_type_name"] = $request->attr_type_name_image;
                            $extra4[$v1]["attr_type_id"] = $request->attr_type_id_image;
                            $extra4[$v1]["attr_value"] = $v1;
                        }
                        $extra1 = $extra1 + $extra4;
                    }
                }
            }

            if (isset($requestArr['attr_ids']) && !empty($requestArr['attr_ids'])) {
                foreach ($request->attr_type_name as $key => $value) {
                    $request_attr_value = $request->attr_value[$key];

                    if ($request_attr_value == ';' || $request_attr_value == 'on') {
                        $request_attr_value = '';
                    }
                    $extra[$key]["attr_type_name"] = $value;
                    $extra[$key]["attr_type_id"] = $request->attr_type_id[$key];
                    $extra[$key]["attr_value"] = $request_attr_value;
                    $extra[$key]["parent_value_id"] = $request->parent_value_id[$key];
                    $extra[$key]["parent_attribute_id"] = $request->parent_attribute_id[$key];

                    $requestArr1['attr_ids'][$key] = $requestArr['attr_ids'][$key];
                }

                $dataExtra = array_combine($requestArr1['attr_ids'], $extra);
            }

            $classified = $data->save();
            if (isset($dataExtra) && !empty($dataExtra)) {
                $data->classified_attribute()->sync($dataExtra);
            }

            foreach ($dataExtra as $k2 => $v2) {
                if ($v2['attr_value'] == '' || $v2['attr_value'] == 'on') {
                    DB::table('attribute_classified')->where('classified_id', '=', $requestArr['id'])->where('attribute_id', '=', $k2)->delete();
                }
            }
            DB::table('attribute_classified')->where('classified_id', '=', $requestArr['id'])->where('attr_type_name', '=', 'Multi-Select')->delete();
            DB::table('attribute_classified')->where('classified_id', '=', $requestArr['id'])->where('attr_type_name', '=', 'Radio-button')->delete();
            if (isset($extra1) && !empty($extra1)) {
                foreach ($extra1 as $ke => $val) {
                    $val['classified_id'] = $requestArr['id'];
                    \DB::table('attribute_classified')->insert($val);
                }
            }

            $lastinstertid = $requestArr['id'];
            if ($lastinstertid) {
                if (Input::file('image')) {

                    $image = Input::file('image');
                    $attachmentData = array();
                    if (!is_dir('upload_images/classified/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/30px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/30px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/950x530px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/950x530px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/285x217px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/285x217px/' . $lastinstertid, 0777, true);
                    }

                    foreach ($image as $key => $val) {

                        $destinationPath = 'upload_images/classified/' . $lastinstertid . '/';

                        $destinationPaththumb = 'upload_images/classified/30px/' . $lastinstertid . '/';
                        $destinationPaththumb1 = 'upload_images/classified/950x530px/' . $lastinstertid . '/';
                        $destinationPaththumb285x217px = 'upload_images/classified/285x217px/' . $lastinstertid . '/';
                        $extension = $val->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $fileName = $ran . '.' . $extension;

                        $val->move($destinationPath, $fileName);
                        image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                        image1::make($destinationPath . $fileName)->resize(950, 530)->save($destinationPaththumb1 . $fileName);
                        image1::make($destinationPath . $fileName)->resize(285, 217)->save($destinationPaththumb285x217px . $fileName);
                        $attachmentData[] = array('classified_id' => $lastinstertid, 'name' => $fileName);
                    }
                    \DB::table('classifiedimage')->insert($attachmentData);
                }
            }
            return response()->json(['status' => true]);
        }
    }

    /**
     *  front classifieds edit
     * edit classifieds 
     *
     * @return void
     * @access public
     */
    public function edit($id = null) {

        return Redirect::to('user/edit_business_post/' . $id);

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        $childCategoryName = [];
        $category = new Category;
        $BelongsToCommunities = $category->where(['pid' => 0])->pluck('belong_to_community', 'id')->toArray();

        $state = DB::table('state')->where('country_id', 14)->pluck('name', 'id');
        $stateCode = DB::table('state')->where('country_id', 14)->pluck('id', 'code')->toarray();
        $showStaticAttributes = $category->where(['pid' => 0])->pluck('show_static_attributes', 'id')->toArray();
        $result = false;
        if (isset($id)) {
            try {
                $result = $this->model->where('id', '=', $id)->with(['classified_attribute' => function ($query) {
                                $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'size', 'measure_unit', 'display_name');
                            }, 'classified_image'])->first();

                if ($result->user_id != Auth::guard('web')->user()->id) {
                    return Redirect::to('user/post-classified');
                }
                $parentCategoryName = $category->select('name')->where(['id' => $result->parent_categoryid])->first()->toarray();


                $childCategoryName = $category->select('name')->where(['id' => $result->category_id])->first();
                $suburb = DB::table('cities')->select('City')->where('CityId', '=', $result->city_id)->first();

                $statename = DB::table('state')->select('name')->where('id', '=', $result->state_id)->first();
                $checkCatIsBelToCommunity = DB::table('categories')->where('id', '=', $result->parent_categoryid)->first();
                $isCommunity = $checkCatIsBelToCommunity->belong_to_community == 1 ? "hide" : null;
                if ($result->category_id != 0) {
                    $data['id'] = $result->category_id;
                } else {
                    $data['id'] = $result->parent_categoryid;
                }
                $data = Category::where("id", "=", $data['id'])
                                ->with(['attributes' => function ($query) {
                                        $query->select("id as attribute_id", "name", "attributetype_id", "required as is_required", "attributetype_id as attr_type_id", "attribute_value as attr_value", "p_attr_id", "required", "size", "measure_unit", "display_name")
                                        ->where(['p_attr_id' => 0, 'status' => 1, 'is_active' => 1])
                                        ->with(['attributeType' => function($q) {
                                                $q->select("id", "name", "slug");
                                            }]);
                                    }])->select("id")->first();

                $collection = collect($data->attributes->toArray());
                $at_idsArr = $collection->groupBy('attribute_id');
                $collection1 = collect($result->classified_attribute);
                $at_val_ids = $collection1->implode('attribute_id', ',');
                $at_val_idsArr = explode(',', $at_val_ids);
                $newAttrForUnsaved = [];
                foreach ($at_idsArr as $k1 => $v1) {
                    if (!in_array($k1, $at_val_idsArr)) {
                        $newAttrForUnsaved[$k1]['attribute_id'] = $v1[0]['attribute_id'];
                        $newAttrForUnsaved[$k1]['classified_id'] = $id;
                        $newAttrForUnsaved[$k1]['attr_value'] = $v1[0]['attr_value'];
                        $newAttrForUnsaved[$k1]['attr_type_id'] = $v1[0]['attr_type_id'];
                        $newAttrForUnsaved[$k1]['attr_type_name'] = $v1[0]['attribute_type']['slug'];
                        $newAttrForUnsaved[$k1]['name'] = $v1[0]['name'];
                        $newAttrForUnsaved[$k1]['display_name'] = $v1[0]['display_name'];
                        $newAttrForUnsaved[$k1]['p_attr_id'] = $v1[0]['p_attr_id'];
                        $newAttrForUnsaved[$k1]['parent_value_id'] = 0;
                        $newAttrForUnsaved[$k1]['parent_attribute_id'] = 0;
                        $newAttrForUnsaved[$k1]['is_required'] = $v1[0]['is_required'];
                    }
                }
                $result1 = $result->toArray();
                $result1['classified_attribute'] = $result1['classified_attribute'] + $newAttrForUnsaved;
                $multi_select = [];
                foreach ($result1['classified_attribute'] as $key => $value) {
                    $is_req = DB::table('attributes')->select('required')->where(['id' => $value['attribute_id']])->first();

                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] == 0) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $result1['classified_attribute'][$key]['attr_AllValues'] = $attr_AllValues->toArray();
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] != 0) {
                        $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $value['attribute_id'])->where('attribute_value_id', $value['parent_value_id'])->pluck('attribute_value', 'id');
                        $result1['classified_attribute'][$key]['attr_AllValues'] = $attr_AllValues->toArray();
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_name'] == 'Numeric') {
                        $attr_AllValuesNumeric = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $result1['classified_attribute'][$key]['attr_AllValuesNumeric'] = $attr_AllValuesNumeric->toarray();
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_name'] == 'calendar') {
                        $attr_AllValuesCalendar = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $result1['classified_attribute'][$key]['attr_AllValuesNumeric'] = $attr_AllValuesCalendar->toarray();
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_name'] == 'Multi-Select' || $value['attr_type_name'] == 'Radio-button') {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $multi_select[$value['attribute_id']]['attr_ids_multi'] = $value['attribute_id'];
                        $multi_select[$value['attribute_id']]['attr_type_name_multi'] = $value['attr_type_name'];
                        $multi_select[$value['attribute_id']]['name'] = $value['name'];
                        $multi_select[$value['attribute_id']]['display_name'] = $value['display_name'];
                        $multi_select[$value['attribute_id']]['attr_type_id_multi'] = $value['attr_type_id'];
                        $multi_select[$value['attribute_id']]['selected'][] = $value['attr_value'];
                        $multi_select[$value['attribute_id']]['attribute_value'] = $attr_AllValues->toArray();
                        $multi_select[$value['attribute_id']]['is_required'] = $is_req->required;
                    } else {
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    }
                }
                if (isset($multi_select) && !empty($multi_select)) {
                    $result1['multi_select'] = $multi_select;
                }


            } catch (ModelNotFoundException $ex) {
                
            }
        }
        $selectedCategories = null;
        $allSubCategoriesForMenu = $category->getFrontCategoriesForMenu($selectedCategories);

        return view('front.classifieds.edit', compact('parentCategoryName', 'childCategoryName', 'modelTitle', 'classified', 'controllerName', 'actionName', 'state', 'suburb', 'result', 'result1', 'allSubCategoriesForMenu', 'subcategories', 'isCommunity', 'BelongsToCommunities', 'stateCode', 'statename', 'showStaticAttributes'));
    }

    /**
     *  front business classifieds edit
     * edit classifieds 
     *
     * @return void
     * @access public
     */
    public function edit_business_post($id = null) {

        $category = new Category;

        $state = DB::table('state')->where('country_id', 14)->pluck('name', 'id');
        $stateCode = DB::table('state')->where('country_id', 14)->pluck('id', 'code')->toarray();
        $result = false;
        if (isset($id)) {
            try {
                $result = $this->model
                                ->where(['id' => $id, 'user_id' => Auth::guard('web')->user()->id])
                                ->with(['classified_attribute' => function ($query) {
                                        $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'size', 'measure_unit', 'display_name');
                                    }, 'classified_image', 'classified_hasmany_other', 'categoriesname', 'Subcategoriesname',
                                    'classified_hasmany_questions' => function($q1) {
                                        $q1->with(['question_hasmany_options']);
                                    }, 'city', 'classified_ho_package_user'])->first();

                if (!$result) {
                    return Redirect::to('user/dashboard');
                }

                $suburb = DB::table('cities')->select('City')->where('CityId', '=', $result->city_id)->first();
                $statename = DB::table('state')->select('name')->where('id', '=', $result->state_id)->first();
                $data['id'] = $result->category_id;
                $data = Category::where("id", "=", $data['id'])
                                ->with(['attributes' => function ($query) {
                                        $query->select("id as attribute_id", "name", "attributetype_id", "required as is_required", "attributetype_id as attr_type_id", "attribute_value as attr_value", "p_attr_id", "required", "size", "measure_unit", "display_name")
                                        ->where(['p_attr_id' => 0, 'status' => 1, 'is_active' => 1])
                                        ->with(['attributeType' => function($q) {
                                                $q->select("id", "name", "slug");
                                            }]);
                                    }])->select("id")->first();

                $memPlanUser = DB::table('membership_plan_users')
                        ->where(['id' => $result->membership_plan_user_id, 'user_id' => Auth::guard('web')->user()->id])->get()
                        ->map(function ($item, $key) {
                    return (array) $item;
                });

                $catid = $result->parent_categoryid;
                //change 14 dec. $result->category_id to  $result->parent_categoryid
                $template_arr = DB::table('templates')
                        ->leftJoin('category_template', 'templates.id', '=', 'category_template.template_id')
                        ->where('category_template.category_id', '=', $catid)
                        ->first();

                $collection = collect($data->attributes->toArray());
                $at_idsArr = $collection->groupBy('attribute_id');
                $collection1 = collect($result->classified_attribute);
                $at_val_ids = $collection1->implode('attribute_id', ',');
                $at_val_idsArr = explode(',', $at_val_ids);
                $newAttrForUnsaved = [];
                foreach ($at_idsArr as $k1 => $v1) {
                    if (!in_array($k1, $at_val_idsArr)) {
                        $newAttrForUnsaved[$k1]['attribute_id'] = $v1[0]['attribute_id'];
                        $newAttrForUnsaved[$k1]['classified_id'] = $id;
                        $newAttrForUnsaved[$k1]['attr_value'] = $v1[0]['attr_value'];
                        $newAttrForUnsaved[$k1]['attr_type_id'] = $v1[0]['attr_type_id'];
                        $newAttrForUnsaved[$k1]['attr_type_name'] = $v1[0]['attribute_type']['slug'];
                        $newAttrForUnsaved[$k1]['name'] = $v1[0]['name'];
                        $newAttrForUnsaved[$k1]['display_name'] = $v1[0]['display_name'];
                        $newAttrForUnsaved[$k1]['p_attr_id'] = $v1[0]['p_attr_id'];
                        $newAttrForUnsaved[$k1]['parent_value_id'] = 0;
                        $newAttrForUnsaved[$k1]['parent_attribute_id'] = 0;
                        $newAttrForUnsaved[$k1]['is_required'] = $v1[0]['is_required'];
                    }
                }
                $result1 = $result->toArray();
                $result1['classified_attribute'] = $result1['classified_attribute'] + $newAttrForUnsaved;
                $multi_select = [];
                foreach ($result1['classified_attribute'] as $key => $value) {
                    $is_req = DB::table('attributes')->select('required')->where(['id' => $value['attribute_id']])->first();

                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] == 0) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $result1['classified_attribute'][$key]['attr_AllValues'] = $attr_AllValues->toArray();
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] != 0) {
                        $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $value['attribute_id'])->where('attribute_value_id', $value['parent_value_id'])->pluck('attribute_value', 'id');
                        $result1['classified_attribute'][$key]['attr_AllValues'] = $attr_AllValues->toArray();
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_name'] == 'Numeric') {
                        $attr_AllValuesNumeric = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $result1['classified_attribute'][$key]['attr_AllValuesNumeric'] = $attr_AllValuesNumeric->toarray();
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_name'] == 'calendar') {
                        $attr_AllValuesCalendar = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $result1['classified_attribute'][$key]['attr_AllValuesNumeric'] = $attr_AllValuesCalendar->toarray();
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_name'] == 'Multi-Select' || $value['attr_type_name'] == 'Radio-button') {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $multi_select[$value['attribute_id']]['attr_ids_multi'] = $value['attribute_id'];
                        $multi_select[$value['attribute_id']]['attr_type_name_multi'] = $value['attr_type_name'];
                        $multi_select[$value['attribute_id']]['name'] = $value['name'];
                        $multi_select[$value['attribute_id']]['display_name'] = $value['display_name'];
                        $multi_select[$value['attribute_id']]['attr_type_id_multi'] = $value['attr_type_id'];
                        $multi_select[$value['attribute_id']]['selected'][] = $value['attr_value'];
                        $multi_select[$value['attribute_id']]['attribute_value'] = $attr_AllValues->toArray();
                        $multi_select[$value['attribute_id']]['is_required'] = $is_req->required;
                    } else {
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    }
                }
                if (isset($multi_select) && !empty($multi_select)) {
                    $result1['multi_select'] = $multi_select;
                }
            } catch (ModelNotFoundException $ex) {
                
            }
        }

        return view('front.classifieds.edit_business_post', compact('memPlanUser', 'template_arr', 'state', 'result', 'result1', 'stateCode', 'statename'));
    }

    /**
     *  front classifieds update
     * update classifieds 
     *
     * @return void
     * @access public
     */
    public function update_business_post(Request $request) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        if ($request->isMethod('post')) {

            $input = Input::all();

            $id = $request->id;
            $subregions_id = $request->subregions_id;
            $lat = $request['lat'];
            $lng = $request['lng'];
            if (!empty($subregions_id)) {
                $row = \DB::table('cities')->where("City", '=', $subregions_id)->first();
                if (!empty($row)) {
                    $city_id = $row->CityId;
                } else {
                    $attachmentData = array('City' => $subregions_id, 'Latitude' => $lat, 'Longitude' => $lng);
                    $insertcityid = \DB::table('cities')->insertGetId($attachmentData);
                    $city_id = $insertcityid;
                }
            }
            $this->validate($request, [
                'title' => 'required|unique:classifieds,title,' . $id,
                'parent_categoryid' => 'required',
                'location' => 'sometimes',
                'state_id' => 'sometimes',
                'pincode' => 'sometimes',
                'contact_name' => 'sometimes',
                'contact_email' => 'sometimes',
                'contact_mobile' => 'sometimes',
            ]);
            $saved_image = $this->model->where('id', '=', $id)->with('classified_image')->first();
            if (empty($saved_image->classified_image->toarray()) && !($request['image'])) {
                $nbr = count(Input::file('image')) - 1;
                foreach (range(0, $nbr) as $index) {
                    $rules['image.' . $index] = 'required | mimes:jpeg,png|max:3000';
                }

                $validator = Validator::make($input, $rules);
                if ($validator->fails()) {

                    $messages = $validator->messages();
                    return \Response::json($messages, 417);
                }
            }
            //GET TEMPLATE DATA
            $template_arr = DB::table('templates')
                    ->leftJoin('category_template', 'templates.id', '=', 'category_template.template_id')
                    ->where('category_template.category_id', '=', $request->parent_categoryid)
                    //change 14 dec. $request->category_id to  $request->parent_categoryid
                    ->first();

            if (!empty($request->edit_other_value)) {
                foreach ($request->edit_other_value as $key_parent => $value_parent) {

                    foreach ($value_parent as $key => $value) {
                        if ($value && $value['title'] != '') {
                            $edit_other_value[$key_parent][$key]["id"] = $value['id'];
                            $edit_other_value[$key_parent][$key]["other_slug"] = $key_parent;

                            if (!empty($value['title'])) {
                                $edit_other_value[$key_parent][$key]["other_title"] = $value['title'];
                            } else {
                                $edit_other_value[$key_parent][$key]["other_title"] = '';
                            }

                            if (!empty($value['desc'])) {
                                $edit_other_value[$key_parent][$key]["other_value"] = $value['desc'];
                            } else {
                                $edit_other_value[$key_parent][$key]["other_value"] = '';
                            }

                            if (isset($value['content_type']) && !empty($value['content_type'])) {
                                $edit_other_value[$key_parent][$key]["content_type"] = $value['content_type'];
                            } else {
                                $edit_other_value[$key_parent][$key]["content_type"] = '';
                            }

                            if (!empty($value['url'])) {
                                $edit_other_value[$key_parent][$key]["url"] = $value['url'];
                            } else {
                                $edit_other_value[$key_parent][$key]["url"] = '';
                            }

                            if (!empty($value['edit_image'])) {
                                $edit_other_value[$key_parent][$key]["image"] = $ran = rand(11111, 99999) . '.' . $value['edit_image']->getClientOriginalExtension();
                                $edit_other_value[$key_parent][$key]["image_arr"] = $value['edit_image'];
                            } else if (!empty($value['image'])) {
                                $edit_other_value[$key_parent][$key]["image"] = $value['image'];
                                $edit_other_value[$key_parent][$key]["image_arr"] = [];
                            } else {
                                $edit_other_value[$key_parent][$key]["image"] = '';
                                $edit_other_value[$key_parent][$key]["image_arr"] = [];
                            }
                        }
                    }
                }
            }

            if (!empty($request->other_value)) {
                foreach ($request->other_value as $key_parent => $value_parent) {

                    foreach ($value_parent as $key => $value) {
                        if ($value && $value['title'] != '') {
                            $other_value[$key_parent][$key]["other_slug"] = $key_parent;

                            if (!empty($value['title'])) {
                                $other_value[$key_parent][$key]["other_title"] = $value['title'];
                            } else {
                                $other_value[$key_parent][$key]["other_title"] = '';
                            }

                            if (!empty($value['desc'])) {
                                $other_value[$key_parent][$key]["other_value"] = $value['desc'];
                            } else {
                                $other_value[$key_parent][$key]["other_value"] = '';
                            }

                            if (isset($value['content_type']) && !empty($value['content_type'])) {
                                $other_value[$key_parent][$key]["content_type"] = $value['content_type'];
                            } else {
                                $other_value[$key_parent][$key]["content_type"] = '';
                            }

                            if (!empty($value['url'])) {
                                $other_value[$key_parent][$key]["url"] = $value['url'];
                            } else {
                                $other_value[$key_parent][$key]["url"] = '';
                            }

                            if (!empty($value['image'])) {
                                $other_value[$key_parent][$key]["image"] = $ran = rand(11111, 99999) . '.' . $value['image']->getClientOriginalExtension();
                                $other_value[$key_parent][$key]["image_arr"] = $value['image'];
                            } else {
                                $other_value[$key_parent][$key]["image"] = '';
                                $other_value[$key_parent][$key]["image_arr"] = [];
                            }
                        }
                    }
                }
            }

            if (!empty($template_arr) && $template_arr->questions_answer == 1 && $request->questions) {

                foreach ($request->questions as $key => $value) {

                    if ($value['question']) {
                        $questions[$key]["question"] = $value['question'];
                        $questions[$key]["ans_type"] = $value['ans_type'];
                        if (!empty($value['options'])) {
                            $questions[$key]["options"] = $value['options'];
                        }
                    }
                }
            }

            if (!empty($template_arr) && $template_arr->questions_answer == 1 && $request->edit_questions) {

                foreach ($request->edit_questions as $key => $value) {

                    if ($value['question']) {
                        $edit_questions[$key]["id"] = $value['id'];
                        $edit_questions[$key]["question"] = $value['question'];
                        $edit_questions[$key]["ans_type"] = $value['ans_type'];
                        if (!empty($value['options'])) {
                            $edit_questions[$key]["options"] = $value['options'];
                        }
                    }
                }
            }

            $requestArr = Input::all();
            $exceptFields = ['_token', 'attr_type_name', 'attr_type_id', 'attr_value', 'attr_ids', 'parent_value_id', 'parent_attribute_id', 'image', 'attr_ids_multi',
                'attr_value_multi', 'attr_type_id_multi', 'attr_type_name_multi', 'attr_type_name_file', 'attr_type_id_file',
                'attr_ids_file', 'attr_value_file_old', 'attr_value_file', 'hour', 'minute', 'meridian', 'attr_type_name_video',
                'attr_type_id_video', 'attr_ids_video', 'attr_value_video_old', 'attr_value_video',
                'attr_ids_radio', 'attr_value_radio', 'attr_type_id_radio', 'attr_type_name_radio', 'attr_type_name_image',
                'attr_type_name_image', 'attr_type_id_image', 'attr_ids_image', 'attr_value_image_old', 'attr_value_image', 'withCommunty', 'city',
                'other_value', 'classified_type', 'questions', 'edit_questions', 'edit_other_value'];
            $data = $this->model->findOrFail($requestArr['id']);

            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if ($request->classified_type == 'premium') {
                $data->is_premium = 1;
                $row = \DB::table('membership_plan_users')->where(['id' => $data->membership_plan_user_id])->first();
                $data->is_premium_parent_cat = $row->is_premium_parent_cat;
                $data->is_premium_sub_cat = $row->is_premium_sub_cat;
            } else if ($request->classified_type == 'featured') {
                $data->featured_classified = 1;
                $data->is_premium = 0;
                $data->is_premium_parent_cat = 0;
                $data->is_premium_sub_cat = 0;
            } else {
                $data->is_premium = 0;
                $data->is_premium_parent_cat = 0;
                $data->is_premium_sub_cat = 0;
            }

            if ($request->min_offer_check == 'on') {
                $data->min_offer_check = 1;
                $data->minimum_price = $request->minimum_price;
            } else {
                $data->min_offer_check = 0;
                $data->minimum_price = 0;
            }

            if ($request->pay_pal == 'on') {
                $data->pay_pal = 1;
                $data->pic_n_pay = 0;
            } else if ($request->pic_n_pay == 'on') {
                $data->pic_n_pay = 1;
                $data->pay_pal = 0;
                $data->shipping = 0;
            }

            if (isset($request->category_id) && $request->category_id == '') {
                $data->category_id = 0;
            }

            if (isset($request->state_id) && $request->state_id == '') {
                $data->state_id = 0;
            }
            if (isset($city_id)) {
                $data->city_id = $city_id;
            }

            if (isset($request->subregions_id) && $request->subregions_id == '') {
                $data->subregions_id = 0;
            }

            if (isset($request->description)) {
                $data->description = $request->description;
            }

            $data->status = 2;
            $extra1 = [];
            $extra2 = [];
            $extra3 = [];
            $extra4 = [];
            $dataExtra = [];
            if (isset($requestArr['attr_ids_multi']) && !empty($requestArr['attr_ids_multi'])) {

                foreach ($request->attr_value_multi as $key => $value) {
                    foreach ($value as $k => $v) {

                        $extra1[$v]["attribute_id"] = $key;
                        $extra1[$v]["attr_type_name"] = $request->attr_type_name_multi;
                        $extra1[$v]["attr_type_id"] = $request->attr_type_id_multi;
                        $extra1[$v]["attr_value"] = $v;
                    }
                }
            } else {
                $extra1 = [];
            }
            if (isset($requestArr['attr_ids_radio']) && !empty($requestArr['attr_ids_radio'])) {
                if (isset($request->attr_value_radio)) {
                    foreach ($request->attr_value_radio as $key => $value) {
                        foreach ($value as $k => $v) {

                            $extra2[$v]["attribute_id"] = $key;
                            $extra2[$v]["attr_type_name"] = $request->attr_type_name_radio;
                            $extra2[$v]["attr_type_id"] = $request->attr_type_id_radio;
                            $extra2[$v]["attr_value"] = $v;
                        }
                    }
                }
                $extra1 = $extra1 + $extra2;
            }
            if (isset($request->attr_ids_image)) {
                foreach ($request->attr_ids_image as $key => $value) {

                    if (isset($request->attr_value_image[$value]) && (!empty($request->attr_value_image[$value]))) {
                        foreach ($request->attr_value_image[$value] as $k => $v) {
                            $extension = $v->getClientOriginalExtension();
                            $ran = rand(11111, 99999);
                            $fileNameAttrTypeImageGallery[$value][] = $ran . '.' . $extension;

                            $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attribute_id"] = $value;
                            $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attr_type_name"] = $request->attr_type_name_image;
                            $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attr_type_id"] = $request->attr_type_id_image;
                            $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attr_value"] = $fileNameAttrTypeImageGallery[$value][$k];
                        }
                        $extra1 = $extra1 + $extra3;
                    }
                    if (!empty($request->attr_value_image_old)) {
                        foreach ($request->attr_value_image_old[$value] as $k1 => $v1) {

                            $extra4[$v1]["attribute_id"] = $value;
                            $extra4[$v1]["attr_type_name"] = $request->attr_type_name_image;
                            $extra4[$v1]["attr_type_id"] = $request->attr_type_id_image;
                            $extra4[$v1]["attr_value"] = $v1;
                        }
                        $extra1 = $extra1 + $extra4;
                    }
                }
            }

            if (isset($requestArr['attr_ids']) && !empty($requestArr['attr_ids'])) {
                foreach ($request->attr_type_name as $key => $value) {
                    $request_attr_value = $request->attr_value[$key];

                    if ($request_attr_value == ';' || $request_attr_value == 'on') {
                        $request_attr_value = '';
                    }
                    $extra[$key]["attr_type_name"] = $value;
                    $extra[$key]["attr_type_id"] = $request->attr_type_id[$key];
                    $extra[$key]["attr_value"] = $request_attr_value;
                    $extra[$key]["parent_value_id"] = $request->parent_value_id[$key];
                    $extra[$key]["parent_attribute_id"] = $request->parent_attribute_id[$key];

                    $requestArr1['attr_ids'][$key] = $requestArr['attr_ids'][$key];
                }

                $dataExtra = array_combine($requestArr1['attr_ids'], $extra);
            }
            //forVideo Type
            if (isset($request->attr_ids_video)) {
                foreach ($request->attr_ids_video as $key => $val) {
                    $attr_value_video = Input::file('attr_value_video');
                    if (isset($attr_value_video[$key])) {

                        $extension = $attr_value_video[$key]->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $VideoNameAttrType[$key] = $ran . '.' . $extension;
                        $extraVideo[$request->attr_ids_video[$key]]["attr_type_name"] = $request->attr_type_name_video[$key];
                        $extraVideo[$request->attr_ids_video[$key]]["attr_type_id"] = $request->attr_type_id_video[$key];
                        $extraVideo[$request->attr_ids_video[$key]]["attr_value"] = $VideoNameAttrType[$key];
                    } else if (isset($request->attr_value_video_old[$key]) && (!empty($request->attr_value_video_old[$key]))) {
                        $extraVideo[$request->attr_ids_video[$key]]["attr_type_name"] = $request->attr_type_name_video[$key];
                        $extraVideo[$request->attr_ids_video[$key]]["attr_type_id"] = $request->attr_type_id_video[$key];
                        $extraVideo[$request->attr_ids_video[$key]]["attr_value"] = $request->attr_value_video_old[$key];
                    }
                }
                if (isset($dataExtra) && !empty($dataExtra)) {
                    $dataExtra = $dataExtra + $extraVideo;
                } else {
                    $dataExtra = $extraVideo;
                }
            }

            $classified = $data->save();
            if (isset($dataExtra) && !empty($dataExtra)) {
                $data->classified_attribute()->sync($dataExtra);
            }

            foreach ($dataExtra as $k2 => $v2) {
                if ($v2['attr_value'] == '' || $v2['attr_value'] == 'on') {
                    DB::table('attribute_classified')->where('classified_id', '=', $requestArr['id'])->where('attribute_id', '=', $k2)->delete();
                }
            }
            DB::table('attribute_classified')->where('classified_id', '=', $requestArr['id'])->where('attr_type_name', '=', 'Multi-Select')->delete();
            DB::table('attribute_classified')->where('classified_id', '=', $requestArr['id'])->where('attr_type_name', '=', 'Radio-button')->delete();
            if (isset($extra1) && !empty($extra1)) {
                foreach ($extra1 as $ke => $val) {
                    $val['classified_id'] = $requestArr['id'];
                    \DB::table('attribute_classified')->insert($val);
                }
            }

            if (!empty($edit_other_value)) {
                foreach ($edit_other_value as $key => $value) {

                    foreach ($value as $k => $val) {

                        $o_obj = new ClassifiedOther;

                        $other_save = [];
                        $other_save['other_slug'] = $key;
                        $other_save['classified_id'] = $requestArr['id'];
                        $other_save['other_title'] = $val['other_title'];
                        $other_save['other_value'] = $val['other_value'];
                        $other_save['image'] = $val['image'];
                        $other_save['url'] = $val['url'];
                        $other_save['content_type'] = $val['content_type'];

                        $o_obj->where(['id' => $val['id']])->update($other_save);
                        if (!empty($val['image_arr'])) {
                            if (!is_dir('upload_images/others/')) {
                                File::makeDirectory('upload_images/others/', 0777, true);
                            }
                            $destinationPath = 'upload_images/others/';
                            $val['image_arr']->move($destinationPath, $val['image']);
                        }
                    }
                }
            }
            if (!empty($other_value)) {
                foreach ($other_value as $key => $value) {
                    $other_save = [];
                    $other_save['other_slug'] = $key;
                    foreach ($value as $k => $val) {

                        $other_save['classified_id'] = $requestArr['id'];
                        $other_save['other_title'] = $val['other_title'];
                        $other_save['other_value'] = $val['other_value'];
                        $other_save['image'] = $val['image'];
                        $other_save['url'] = $val['url'];
                        $other_save['content_type'] = $val['content_type'];

                        \DB::table('classified_other')->insert($other_save);
                        if (!empty($val['image_arr'])) {
                            if (!is_dir('upload_images/others/')) {
                                File::makeDirectory('upload_images/others/', 0777, true);
                            }
                            $destinationPath = 'upload_images/others/';
                            $val['image_arr']->move($destinationPath, $val['image']);
                        }
                    }
                }
            }

            if (isset($edit_questions) && !empty($edit_questions)) {
                foreach ($edit_questions as $ke => $val) {

                    $q_obj = new Question;

                    $q['classified_id'] = $requestArr['id'];
                    $q['question'] = $val['question'];
                    $q['ans_type'] = $val['ans_type'];
//                    dd($options);
                    $q_obj->where(['id' => $val['id']])->update($q);

                    DB::table('options')->where('question_id', '=', $val['id'])->delete();

                    if (!empty($val['options'])) {
                        foreach ($val['options'] as $k1 => $v1) {
                            $opt['classified_id'] = $requestArr['id'];
                            $opt['question_id'] = $val['id'];
                            $opt['option_value'] = $v1;
                            \DB::table('options')->insert($opt);
                        }
                    }
                }
            }
            if (isset($questions) && !empty($questions)) {
                foreach ($questions as $ke => $val) {

                    $q = new Question;

                    $q['classified_id'] = $requestArr['id'];
                    $q['question'] = $val['question'];
                    $q['ans_type'] = $val['ans_type'];
                    $q = $q->create($q->toArray());
                    if (!empty($val['options'])) {
                        foreach ($val['options'] as $k1 => $v1) {
                            $opt['classified_id'] = $requestArr['id'];
                            $opt['question_id'] = $q->id;
                            $opt['option_value'] = $v1;
                            \DB::table('options')->insert($opt);
                        }
                    }
                }
            }

            $lastinstertid = $requestArr['id'];
            if ($lastinstertid) {
                if (Input::file('image')) {

                    $image = Input::file('image');
                    $attachmentData = array();
                    if (!is_dir('upload_images/classified/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/30px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/30px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/950x530px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/950x530px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/285x217px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/285x217px/' . $lastinstertid, 0777, true);
                    }

                    foreach ($image as $key => $val) {

                        $destinationPath = 'upload_images/classified/' . $lastinstertid . '/';

                        $destinationPaththumb = 'upload_images/classified/30px/' . $lastinstertid . '/';
                        $destinationPaththumb1 = 'upload_images/classified/950x530px/' . $lastinstertid . '/';
                        $destinationPaththumb285x217px = 'upload_images/classified/285x217px/' . $lastinstertid . '/';
                        $extension = $val->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $fileName = $ran . '.' . $extension;

                        $val->move($destinationPath, $fileName);
                        image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                        image1::make($destinationPath . $fileName)->resize(950, 530)->save($destinationPaththumb1 . $fileName);
                        image1::make($destinationPath . $fileName)->resize(285, 217)->save($destinationPaththumb285x217px . $fileName);
                        $attachmentData[] = array('classified_id' => $lastinstertid, 'name' => $fileName);
                    }
                    \DB::table('classifiedimage')->insert($attachmentData);
                }
                
                //For Videotype attribute value
                if (Input::file('attr_value_video')) {
                    $attr_value_video = Input::file('attr_value_video');
                    foreach ($attr_value_video as $key => $val) {

                        if (!is_dir('upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key])) {
                            File::makeDirectory('upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key], 0777, true);
                        }

                        $destinationPath = 'upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key] . '/';

                        $val->move($destinationPath, $VideoNameAttrType[$key]);
                    }
                }
            }
            return response()->json(['status' => true]);
        }
    }

    /**
     *  front classifieds send_enq_msg
     * send_enq_msg classified 
     *
     * @return response
     * @access public
     */
    public function send_enq_msg() {
        $data = Input::all();
        $dataArray = new LeadEnquiry;
        $dataArray->receiver_id = $data['receiver_id'];
        $dataArray->classified_id = $data['classified_id'];
        $dataArray->message = $data['e_msg'];
        $dataArray->name = $data['e_name'];
        $dataArray->email = $data['e_email'];
        $dataArray->phone = $data['e_phone'];

        $result = $dataArray->create($dataArray->toarray());

        $classified_title = DB::table('classifieds')->select('title')->where('id', $data['classified_id'])->get()->toArray();
        $data['classified_title'] = $classified_title[0]->title;
        $dataSendInMail = $this->model
                        ->with(["categoriesname", "Subcategoriesname", "classified_users"
                        ])
                        ->where("id", "=", $data['classified_id'])->first();
        $classfiedOwnerEmail = $dataSendInMail->classified_users['email'];
        $mailResult = Mail::send('emails.lead_enquiry_template', array('dataSendInMail' => $data), function($message) use ($classfiedOwnerEmail) {
                    $message->to($classfiedOwnerEmail)->subject("Lead Enquiry from Formee");
                }, true);
    }

    /**
     *  front classifieds send_msg_popup
     * send_msg_popup classified 
     *
     * @return response
     * @access public
     */
    public function send_msg_popup() {
        $data = Input::all();
        $dataArray = new Message;
        $dataArray->sender_id = Auth::guard('web')->user()->id;
        $sender_id = Auth::guard('web')->user()->id;
        $dataArray->receiver_id = $data['receiver_id'];
        $dataArray->classified_id = $data['classified_id'];
        $dataArray->massage = $data['msgTeaxArea'];
        $dataArray->flag = 'user-message';
        $dataArray->subject = 'User message';

        $result = $dataArray->create($dataArray->toarray());

        $users = User::select('id', 'name', 'email', 'device_id', 'device_type')->where(['id' => $data['receiver_id']])->first()->toarray();
        if (!empty($sender_id)) {
            $senders = User::select('id', 'name', 'email', 'device_id', 'device_type', 'image', 'avatar')->where(['id' => $sender_id])->first()->toarray();
        }
        $device_id = $users['device_id'];
        $type = $users['device_type'];
        $message = $data['msgTeaxArea'];
        $sender_id = Auth::guard('web')->user()->id;
        $classified_id = $data['classified_id'];
        $receiver_id = $data['receiver_id'];
        $messagetype = 'user-message';


        $chattype = 'chat';
        $sendername = $senders['name'];

        if ($senders['image']) {
            $imgurl = \URL::asset('upload_images/users/' . $senders['id'] . '/' . $senders['image']);
        } elseif ($senders['avatar']) {
            $imgurl = $senders['avatar'];
        } else {
            $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
        }
        if (0) {
            if ($type == 'Android') {
                $this->simplePushNotificationA($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $messagetype, $sendername);
            } else {
                $this->simplePushNotificationI($message, $device_id, $chattype, $sender_id, $classified_id, $receiver_id, $sendername, $type, $messagetype);
            }
        } else {
            $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $sendername, $messagetype, $imgurl);
        }
        $userdata = array(
            "name" => $users['name'],
            "massage" => $data['msgTeaxArea'],
        );
        $loginemail = Auth::guard('web')->user()->email;
        $loginusername = Auth::guard('web')->user()->name;
    }

    /**
     * admin_delete_gallery_front
     * admin_delete_gallery_front classifieds 
     *
     * @return response
     * @access public
     */
    public function admin_delete_gallery_front(Request $request) {

        if ($request->isMethod('post')) {
            $data = Input::all();

            if (!empty($data)) {

                $row = \DB::table('attribute_classified')->where("classified_id", '=', $data['classified_id'])->where("attr_value", '=', $data['file_name'])->delete();
                if ($row) {
                    return response()->json(['status' => true]);
                } else {
                    return response()->json(['status' => false]);
                }
            }
        }
    }

    /**
     * admin_delete
     * admin_delete classifieds 
     *
     * @return response
     * @access public
     */
    public function delete() {

        $viewName = $this->viewName;
        $data = Input::all();

        $id = $data['id'];
        if (!empty($id)) {

            $result = $this->model->findOrFail($id);

            $result->attributes_classified()->delete();

            $result->classified_image()->delete();
            $result->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully Deleted.');

            return response()->json(['status' => true, 'url' => 'user/classifieds']);

            return response()->json(['status' => false, 'url' => 'classifieds', 'message' => 'First delete all the bind attributes.']);
        }

    }

    /**
     * deletenomsg
     * deletenomsg classifieds 
     *
     * @return response
     * @access public
     */
    public function deletenomsg() {

        $viewName = $this->viewName;
        $data = Input::all();

        $id = $data['id'];
        if (!empty($id)) {

            $result = $this->model->findOrFail($id);

            $result->attributes_classified()->delete();

            $result->classified_image()->delete();
            $result->delete();


            return response()->json(['status' => true, 'url' => 'user/classifieds']);

            return response()->json(['status' => false, 'url' => 'classifieds', 'message' => 'First delete all the bind attributes.']);
        }

    }

    /**
     * front_delete_attachment
     * front_delete_attachment classifieds 
     *
     * @return response
     * @access public
     */
    public function front_delete_attachment(Request $request) {

        if ($request->isMethod('post')) {
            $data = Input::all();
            $id = $data['id'];
            if (!empty($id)) {

                $row = \DB::table('classifiedimage')->where("id", '=', $id)->first();
                $deletedModel = new ClassifiedImage;
                $result = $deletedModel->findOrFail($id);
                if ($result->delete()) {
                    $destinationPath = '/upload_images/classified/' . $row->classified_id . '/' . $row->name . '/';
                    $thumbDestinationPath = '/upload_images/classified/30px/' . $row->classified_id . '/';
                    File::delete($destinationPath . '/' . $row->name);
                    File::delete($thumbDestinationPath . '/' . $row->name);
                    if (!File::exists($destinationPath . '/' . $row->name) && !File::exists($thumbDestinationPath . '/' . $row->name)) {
                        return response()->json(['status' => true]);
                    } else {
                        return response()->json(['status' => false]);
                    }
                }
            }
        }
    }

    /**
     *  front business_post_ad1
     * HTML for business post Ad page 
     *
     * @return void
     * @access public
     */
    public function business_post_ad1() {


        return view('front.classifieds.business_post_ad1');
    }

    /**
     *  business_post_ad()
     *  front classifieds ad posting for business users
     *
     * @return void
     * @access public
     */
    public function business_post_ad() {
        if (Auth::guard('web')->user()->seller_type != 'business') {
            return Redirect::to('/user/post-classified');
        }
        $role_categories = new CategoryRole;
        $role_categories = $role_categories
                ->where(['role_id' => Auth::guard('web')->user()->role_id])
                ->get();
        $childIds = $role_categories->pluck('category_id')->toArray();
        $parentCatIds = collect($role_categories)->unique('pid')->pluck('pid')->toArray();
        $parentCategory = new Category;
        $parentCategory = $parentCategory
                        ->with(['categoryChilds' => function($q1) use($childIds) {
                                $q1->whereIn('id', $childIds);
                            }])
                        ->whereIn('id', $parentCatIds)
                        ->get()->keyBy('id');
        if ($parentCategory->first()) {
            $childCategory = $parentCategory->first()->toArray()['category_childs'];
        } else {
            $childCategory = [];
        }

        $state = DB::table('state')->pluck('name', 'id');
        $stateCode = DB::table('state')->where('country_id', 14)->pluck('id', 'code')->toarray();

        $currentDate = date('Y-m-d');
        $memPlanUser = DB::table('membership_plan_users')->where('start_date', '<=', $currentDate)
                ->where('end_date', '>=', $currentDate)
                ->where(['status' => 1, 'user_id' => Auth::guard('web')->user()->id])->get()
                ->map(function ($item, $key) {
            return (array) $item;
        });
        return view('front.classifieds.business_post_ad', compact('parentCategory', 'childCategory', 'childIds', 'state', 'stateCode', 'memPlanUser'));
    }

    /**
     *  front classifieds detail
     * index classifieds 
     *
     * @return void
     * @access public
     */
    public function real_estate_detail() {


        return view('front.classifieds.real_estate_detail');
    }

    public function home_garden_detail() {


        return view('front.classifieds.home_garden_detail');
    }

    public function baby_detail() {


        return view('front.classifieds.baby_detail');
    }

    public function complete_html() {


        return view('front.classifieds.complete_html');
    }

    public function automotive_detail() {


        return view('front.classifieds.automotive_detail');
    }

    public function job_listing() {


        return view('front.classifieds.job_listing');
    }

    public function real_estate_listing() {


        return view('front.classifieds.real_estate_listing');
    }

    public function job_detail() {


        return view('front.classifieds.job_detail');
    }

    public function job_detail1() {


        return view('front.classifieds.job_detail1');
    }

    public function job_detail2() {


        return view('front.classifieds.job_detail2');
    }

    /**
     *  front preview_detail_post
     * preview_detail_post preview classified
     *
     * @return void
     * @access public
     */
    public function preview_detail_post(Request $request) {
        $id = $request->id;
        $result = false;

        if (isset($id)) {
            try {
                $result = $this->model->where('id', '=', $id)->with([
                            'classified_attribute' => function ($query) {
                                $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'display_name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'show_list', 'icon');
                            },
                            'classified_users' => function ($q1) {
                                $q1->select('id', 'name', 'email', 'role_id');
                            },
                            'classified_image',
                            'categoriesname',
                            'Subcategoriesname',
                            'classified_hasmany_other',
                            'classified_hasmany_questions' => function($q4) {
                                $q4->with(['question_hasmany_options']);
                            },
                            'city' => function($q3) {
                                $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                            },
                        ])->first();
                $multi_select = [];
                foreach ($result['classified_attribute'] as $key => $value) {
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] == 0) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValues = $attr_AllValues->toArray();
                    }
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] != 0) {
                        $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $value['attribute_id'])->where('attribute_value_id', $value['parent_value_id'])->pluck('attribute_value', 'id');
                        $value->attr_AllValues = $attr_AllValues->toArray();
                    }
                    if ($value['attr_type_name'] == 'Numeric') {
                        $attr_AllValuesNumeric = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValuesNumeric = $attr_AllValuesNumeric->toarray();
                    }
                    if ($value['attr_type_name'] == 'calendar') {
                        $attr_AllValuesCalendar = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValuesNumeric = $attr_AllValuesCalendar->toarray();
                    }
                    if ($value['attr_type_name'] == 'Multi-Select' || $value['attr_type_name'] == 'Radio-button') {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $multi_select[$value['attribute_id']]['attr_ids_multi'] = $value['attribute_id'];
                        $multi_select[$value['attribute_id']]['attr_type_name_multi'] = $value['attr_type_name'];
                        $multi_select[$value['attribute_id']]['name'] = $value['name'];
                        $multi_select[$value['attribute_id']]['attr_type_id_multi'] = $value['attr_type_id'];
                        $multi_select[$value['attribute_id']]['selected'][] = $value['attr_value'];
                        $multi_select[$value['attribute_id']]['attribute_value'] = $attr_AllValues->toArray();
                    }
                }
                if (isset($multi_select) && !empty($multi_select)) {
                    $result->multi_select = $multi_select;
                }
            } catch (ModelNotFoundException $ex) {
                
            }
        }

        if ($result->subcategoriesname->is_sellable == 1) {
            $template_slug = 'is_sellable';
        } else {
            $catid = $result->parent_categoryid;
            //change 14 dec. $result->category_id to  $result->parent_categoryid
            $template_arr = DB::table('templates')->select('default_detail_preview_slug')
                    ->leftJoin('category_template', 'templates.id', '=', 'category_template.template_id')
                    ->where('category_template.category_id', '=', $catid)
                    ->first();
            $template_slug = $template_arr->default_detail_preview_slug;
        }


        return view('front.templates.' . $template_slug, compact('result'));
    }

    /**
     *  front final_submit_post_private
     * final_submit_post_private preview classified for private users
     *
     * @return void
     * @access public
     */
    public function final_submit_post_private(Request $request) {
        $id = $request->id;

        $result = false;
		
				//*****Redirect for PayPal recurring system*******
		$provider = new ExpressCheckout; 
		$package_data = DB::table('package_users')->select('package_name', 'package_price')->where(['classified_id'=>$id])->first();
		
		
		$data = [];
		$data['items'] = [
			[
				'name' => $package_data->package_name,
				'price' => $package_data->package_price,
				'qty' => 1
			]
		];
		
		$data['invoice_id'] = $id;
		$data['invoice_description'] = "Classified ID #{$id} Invoice";
		$data['return_url'] = url('/user/classifieds/private_post_paypal_success');
		$data['cancel_url'] = url('/');
		
		$total = 0;
		foreach($data['items'] as $item) {
			$total += $item['price']*$item['qty'];
		}
		
		$data['total'] = $total;
		
		$response = $provider->setExpressCheckout($data);
		

		// Use the following line when creating recurring payment profiles (subscriptions)
		
		 // This will redirect user to PayPal
		
		 return response()->json(['status' => true, 'url' => $response['paypal_link']]);

        if (isset($id)) {
            $updated_data["status"] = 2;
            \DB::table('classifieds')->where('id', $id)->update($updated_data);

            Session::flash('type', 'success');
            Session::flash('message', 'Your Classified has been submitted Successfully.');
        }
    }

    /**
     *  front final_submit_post
     * final_submit_post  after preview classified
     *
     * @return void
     * @access public
     */
    public function final_submit_post(Request $request) {
        $id = $request->id;

        $result = false;

        if (isset($id)) {
            $updated_data["status"] = 2;
            \DB::table('classifieds')->where('id', $id)->update($updated_data);

            Session::flash('type', 'success');
            Session::flash('message', 'Your Classified has been submitted Successfully.');
            return response()->json(['status' => true, 'url' => '/user/dashboard']);
        }
    }

    /*

      get_suburbs to get the Suburbs during posting the Ad.


     */

    public function get_suburbs(Request $request) {
        $postalcode = $request->postal_code;
        $location_str = $request->location_str;
        $location_arr = explode(" ", $location_str);
        $ziparr = DB::table('suburbs')->where('postcode', $postalcode)
                ->whereIn('suburb', $location_arr)
                ->first();


        if (!empty($ziparr->id)) {
            $suburbid = $ziparr->id;
        } else {
            $suburbid = "";
        }

        return $suburbid;
    }

    /**
     * delete_questions
     * delete question and options classifieds 
     *
     * @return response
     * @access public
     */
    public function delete_questions(Request $request) {

        if ($request->isMethod('post')) {
            $data = Input::all();

            if (!empty($data)) {

                $result1 = new Question;

                $result = $result1->findOrFail($data['ques_id']);
                $result->question_hasmany_options()->delete();
                $result->delete();

                return response()->json(['status' => true]);
            }
        }
    }

    /**
     * delete_others
     * delete others value classifieds 
     *
     * @return response
     * @access public
     */
    public function delete_others(Request $request) {

        if ($request->isMethod('post')) {
            $data = Input::all();

            if (!empty($data)) {

                $result1 = new ClassifiedOther;

                $result = $result1->findOrFail($data['others_id']);
                $result->delete();

                return response()->json(['status' => true]);
            }
        }
    }

    /**
     * add_review
     * add review and ratings for classifieds 
     *
     * @return response
     * @access public
     */
    public function add_review(Request $request) {

        if ($request->isMethod('post')) {
            $data = Input::all();

            if (!empty($data['classified_id'])) {

                $result1 = new Review;

                $save_value['classified_id'] = $data['classified_id'];
                $save_value['rating'] = $data['rating'];
                $save_value['review'] = $data['review'];
                $save_value['user_id'] = Auth::guard('web')->user()->id;

                $result1 = $result1->create($save_value);

                return response()->json(['status' => true]);
            }
        }
    }

}
