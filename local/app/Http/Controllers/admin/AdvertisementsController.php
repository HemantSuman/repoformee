<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\Advertisement;
use App\models\AdvertisementAttachment;
use App\models\Category;
use Hash;
use File;
use DB;
use Mail;
use App\Event;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Validator;
use Intervention\Image\Facades\Image as image1;
use Illuminate\Support\Facades\Redis;

class AdvertisementsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'advertisements';
        $this->viewName = 'advertisements';
        $this->modelTitle = 'Advertisement';
        $this->model = new Advertisement;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     * indexing of all feeds
     *
     * @return void
     * @access public
     */
    public function admin_index() {

    	$modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $requestArr = Input::all();
        $requestVal = array();
        $requestStatus = '';
        if (!empty($requestArr)) {
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, ['_token', 'form_search', 'page', 'sort', 'direction', 'filter', 'keyword'])) {
                    $this->model = $this->model->where($key, 'LIKE', "%{$value}%");
                    $requestVal[$key] = $value;
                }
                $requestStatus = $value;
            }
            if(!empty($requestArr["filter"])) {
                if($requestArr["filter"] == 'category') {
                    $this->model = $this->model->wherehas("category", function ($detail) use($requestArr) {
                        $detail->where("name", "LIKE", "%{$requestArr["keyword"]}%");
                    });
                } else if($requestArr["filter"] == 'page') {
                    $this->model = $this->model->wherehas("page", function ($detail) use($requestArr) {
                        $detail->where("name", "LIKE", "%{$requestArr["keyword"]}%");
                    });
                } else {
                    $this->model = $this->model->where($requestArr["filter"], 'LIKE', "%{$requestArr["keyword"]}%");
                }
            }
            $data = $this->model->orderBy('id','DESC')->paginate(10);
        } else {
            $data = $this->model->where('page_id', '=', 1)->where('banner_position', '=', 'top')->with('category')->with('sub_category')->with('page')->orderBy('id','DESC')->paginate(10);
        }

        $all_ad_positions = \DB::table('pages')->pluck('name', 'id')->all();
        
        $data->setPath('')->appends(Input::query())->render();
        return view('admin/' . $this->viewName . '/index', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'data', 'requestVal', 'all_ad_positions', 'requestStatus'));
    }

    /**
     * Admin create
     * function for create a feed
     *
     * @return void
     * @access public
     */
    public function admin_add(Request $request) {
        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $category = new Category;
        $categories = $category->categoryListing(['pid' => 0]);
        $communities_information = $category->select('id', 'belong_to_community', 'show_on_info_area')->where(['belong_to_community' => 1])->orWhere(['show_on_info_area' => 1])->get();
        $all_ad_positions = \DB::table('pages')->pluck('name', 'id')->all();
        $communities_informationarr = $communities_information->toarray();

        $nw_communities_informationarr = array();
        if(count($communities_informationarr) > 0) {
            foreach($communities_informationarr as $communities_informationarr_key => $communities_informationarr_val) {
                $nw_communities_informationarr[] = $communities_informationarr_val['id'];
            }
        }
        if ($request->isMethod('post')) {
            $requestArray = Input::all();
            
            $rules = [
                'title' => 'required',
                'page_id' => 'required',
                'banner_position' => 'required',
                'contact_email' => 'required|email',
                'image_url' => 'required'
            ];
            $messages = [
                'title.required' => 'This Field is required.',
                'page_id.required' => 'This Field is required.',
                'banner_position.required' => 'This Field is required.',
                'contact_email.required' => 'This Field is required.',
                'image_url.required' => 'This Field is required.',
            ];

            if(($request->page_id == 1 || $request->page_id == 4) && !Input::get('is_default')) {
                $addRules = [
                    'start_date' => 'required',
                    'end_date' => 'required',
                ];
                $addMessages = [
                    'start_date.required' => 'This Field is required.',
                    'end_date.required' => 'This Field is required.',
                ];
                $rules = array_merge($rules, $addRules);
                $messages = array_merge($messages, $addMessages);
            }

            if(($request->page_id != 1 && $request->page_id != 4) && !Input::get('is_default')) {
                $addRules = [
                    'category_id' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required'
                ];
                $addMessages = [
                    'category_id.required' => 'This Field is required.',
                    'start_date.required' => 'This Field is required.',
                    'end_date.required' => 'This Field is required.'
                ];
                $rules = array_merge($rules, $addRules);
                $messages = array_merge($messages, $addMessages);

//                if(!empty($request->category_id) && !in_array($request->category_id, $nw_communities_informationarr)) {
//                    $subCategoryRule = [
//                        'subcategory_id' => 'required',
//                    ];
//                    $subCategoryMessage = [
//                        'subcategory_id.required' => 'This Field is required.',
//                    ];
//
//                    $rules = array_merge($rules, $subCategoryRule);
//                    $messages = array_merge($messages, $subCategoryMessage);
//                }
            }
            if(($request->page_id != 1 && $request->page_id != 4) && Input::get('is_default')) {
                $addRules = [
                    'category_id' => 'required',
                ];
                $addMessages = [
                    'category_id.required' => 'This Field is required1.',
                ];
                $rules = array_merge($rules, $addRules);
                $messages = array_merge($messages, $addMessages);

//                if(!empty($request->category_id) && !in_array($request->category_id, $nw_communities_informationarr)) {
//                    $subCategoryRule = [
//                        'subcategory_id' => 'required',
//                    ];
//                    $subCategoryMessage = [
//                        'subcategory_id.required' => 'This Field is required.',
//                    ];
//                    $rules = array_merge($rules, $subCategoryRule);
//                    $messages = array_merge($messages, $subCategoryMessage);
//                }
            }

            //rules for image validation
            $addImgRules = $addImgMessages = array();
            if(!empty($request->banner_position)) {
                switch ($request->banner_position) {
                    case "top":
                        $addImgRules = [
                            'image' => 'required|mimes:jpeg,jpg,png|dimensions:width=1920,height=730'
                        ];
                        $addImgMessages = [
                            'image.required' => 'This Field is required.',
                            'image.mimes' => 'Image should be in jpeg, jpg or png format.',
                            'image.dimensions' => 'Image size should be of 1920x730px',
                        ];
                        break;
                    case "right":
                        $addImgRules = [
                            'image' => 'required|mimes:jpeg,jpg,png|dimensions:width=400,height=303'
                        ];
                        $addImgMessages = [
                            'image.required' => 'This Field is required.',
                            'image.mimes' => 'Image should be in jpeg, jpg or png format.',
                            'image.dimensions' => 'Image size should be of 400x303px',
                        ];
                        break;
                    case "bottom":
                        $addImgRules = [
                            'image' => 'required|mimes:jpeg,jpg,png|dimensions:width=1400,height=299'
                        ];
                        $addImgMessages = [
                            'image.required' => 'This Field is required.',
                            'image.mimes' => 'Image should be in jpeg, jpg or png format.',
                            'image.dimensions' => 'Image size should be of 1400x299px',
                        ];
                        break;
                } 
            }
            
            $rules = array_merge($rules, $addImgRules);
            $messages = array_merge($messages, $addImgMessages);

            //for check banner position availability on selected page within the selected time interval
            if(!Input::get('is_default') && (!empty($request->start_date) && !empty($request->end_date) && !empty($request->banner_position))) { 

                $cba_status = $this->check_availability($request->start_date, $request->end_date, $request->page_id, $request->banner_position);
                if($cba_status['status'] == false) {
                    return \Redirect::back()->withInput(Input::all())->withDanger( 'Some dates are already reserved within your time interval at your selected page and position. Your advertisement will be available after  '.$cba_status['nearest_end_date']);
                }
            }

            if(Input::get('is_default') && !empty($request->banner_position) && !empty($request->page_id)) {
                $getAlreadyDefaultStatus = $this->check_already_default_position($request->page_id, $request->banner_position, $request->category_id, $request->subcategory_id);
                if($getAlreadyDefaultStatus == 1) {
                    return \Redirect::back()->withInput(Input::all())->withDanger( 'Advertisement could not be saved. There is already a default advertisement saved on the selected page, position and categories.' );
                }
            }
            
            $validator = \Validator::make($request->all(), $rules, $messages);
            $this->validate($request, $rules, $messages);
            if ($validator->fails()) {
                return redirect('admin/advertisements/create/')
                    ->withErrors($validator)
                    ->withInput();
            }
            $data = new \App\models\Advertisement;

            if(($request->page_id == 1 || $request->page_id == 4) && !Input::get('is_default') ) {
                $valuesArray = array('title', 'page_id', 'banner_position', 'image_url', 'start_date', 'end_date', 'contact_email');
            }
            if(($request->page_id == 1 || $request->page_id == 4) && Input::get('is_default')) {
                $valuesArray = array('title', 'page_id', 'banner_position', 'image_url', 'contact_email');
            }
            if(($request->page_id != 1 && $request->page_id != 4) && !Input::get('is_default')) {
                $valuesArray = array('title', 'page_id', 'category_id', 'subcategory_id', 'banner_position', 'image_url', 'start_date', 'end_date', 'contact_email');
            }
            if(($request->page_id != 1 && $request->page_id != 4) && Input::get('is_default')) {
                $valuesArray = array('title', 'page_id', 'category_id', 'subcategory_id', 'banner_position', 'image_url', 'contact_email');
            }

            foreach($requestArray as $rqstKy => $rqstVal) {
                if(in_array($rqstKy, $valuesArray)) {
                    if($rqstKy == "start_date" || $rqstKy == "end_date") {
                        $data->$rqstKy = date("Y-m-d", strtotime(Input::get($rqstKy)));
                    } else {
                        $data->$rqstKy = Input::get($rqstKy);
                    }
                }
            }
            
            if(Input::get('status')) {
                $data->status = 1;
            } else {
                $data->status = 0;
            }

            if(Input::get('is_default')) {
                $data->is_default = 1;
            } else {
                $data->is_default = 0;
            }
            
            if (Input::file('image')) {
                $image = Input::file('image');
                $destinationPath = 'upload_images/advertisements/image/';

                $extension = $image->getClientOriginalExtension();
                $ran = rand(11111, 99999);
                $fileName = $ran . '.' . $extension;
                $thumbFileName = '100x100_' . $ran . '.' . $extension;

                $image->move($destinationPath, $fileName);
                image1::make($destinationPath . $fileName)->resize(100, 100)->save($destinationPath . $thumbFileName);
                $data->image = $fileName;
            }
            if($data->save()) {
                return \Redirect('admin/advertisements')->withSuccess( ' Advertisement has been added successfully.' );
            } else {
                return \Redirect('admin/advertisements/add')->withDanger( ' Advertisement could not be saved. Please try again.' );
            }  
        }
        
        return view('admin/' . $this->viewName . '/add', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'categories', 'all_ad_positions', 'communities_informationarr'));
    }

    /**
     * Admin edit
     * function for edit any feed
     *
     * @return void
     * @access public
     */
    public function admin_edit($id = null, Request $request) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $category = new Category;

        $communities_information = $category->select('id', 'belong_to_community', 'show_on_info_area')->where(['belong_to_community' => 1])->orWhere(['show_on_info_area' => 1])->get();
        $communities_informationarr = $communities_information->toarray();

        $nw_communities_informationarr = array();
        if(count($communities_informationarr) > 0) {
            foreach($communities_informationarr as $communities_informationarr_key => $communities_informationarr_val) {
                $nw_communities_informationarr[] = $communities_informationarr_val['id'];
            }
        }

        try {
            $data = $this->model->where("id", "=", $id)->with('category')->with('sub_category')->with(['page' => function($detail) {
                $detail->select('top', 'right', 'bottom', 'left', 'id');
            }])->first();
        } catch (\Exception $e) {
            
        }

        if ($request->isMethod('post')) {
            
            $requestArray = Input::all();

            $rules = [
                'title' => 'required',
                'page_id' => 'required',
                'banner_position' => 'required',
                'contact_email' => 'required|email',
            ];
            $messages = [
                'title.required' => 'This Field is required.',
                'page_id.required' => 'This Field is required.',
                'banner_position.required' => 'This Field is required.',
                'contact_email.required' => 'This Field is required.',
            ];

            // 1 -> For Home page, 4 -> For Prayer Timing page
            if(($request->page_id == 1 || $request->page_id == 4) && !Input::get('is_default')) {
                $addRules = [
                    'start_date' => 'required',
                    'end_date' => 'required',
                ];
                $addMessages = [
                    'start_date.required' => 'This Field is required.',
                    'end_date.required' => 'This Field is required.',
                ];
                $rules = array_merge($rules, $addRules);
                $messages = array_merge($messages, $addMessages);
            }
            if(($request->page_id != 1 && $request->page_id != 4) && !Input::get('is_default')) {
                $addRules = [
                    'category_id' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required'
                ];
                $addMessages = [
                    'category_id.required' => 'This Field is required.',
                    'start_date.required' => 'This Field is required.',
                    'end_date.required' => 'This Field is required.'
                ];
                $rules = array_merge($rules, $addRules);
                $messages = array_merge($messages, $addMessages);

//                if(!empty($request->category_id) && !in_array($request->category_id, $nw_communities_informationarr)) {
//                    $subCategoryRule = [
//                        'subcategory_id' => 'required',
//                    ];
//                    $subCategoryMessage = [
//                        'subcategory_id.required' => 'This Field is required.',
//                    ];
//
//                    $rules = array_merge($rules, $subCategoryRule);
//                    $messages = array_merge($messages, $subCategoryMessage);
//                }
            }
            if(($request->page_id != 1 && $request->page_id != 4) && Input::get('is_default')) {
                $addRules = [
                    'category_id' => 'required',
                ];
                $addMessages = [
                    'category_id.required' => 'This Field is required.',
                ];
                $rules = array_merge($rules, $addRules);
                $messages = array_merge($messages, $addMessages);

//                if(!empty($request->category_id) && !in_array($request->category_id, $nw_communities_informationarr)) {
//                    $subCategoryRule = [
//                        'subcategory_id' => 'required',
//                    ];
//                    $subCategoryMessage = [
//                        'subcategory_id.required' => 'This Field is required.',
//                    ];
//
//                    $rules = array_merge($rules, $subCategoryRule);
//                    $messages = array_merge($messages, $subCategoryMessage);
//                }
            }

            //rules for image validation
            $addImgRules = $addImgMessages = array();
            if(Input::file('image')) {
                switch ($request->banner_position) {
                    case "top":
                        $addImgRules = [
                            'image' => 'required|mimes:jpeg,jpg,png|dimensions:width=1920,height=730',
                            'image_url' => 'required'
                        ];
                        $addImgMessages = [
                            'image.required' => 'This Field is required.',
                            'image.mimes' => 'Image should be in jpeg, jpg or png format.',
                            'image.dimensions' => 'Image size should be of 1920x730px',
                            'image_url.required' => 'This field is required.'
                        ];
                        break;
                    case "right":
                        $addImgRules = [
                            'image' => 'required|mimes:jpeg,jpg,png|dimensions:width=400,height=303',
                            'image_url' => 'required'
                        ];
                        $addImgMessages = [
                            'image.required' => 'This Field is required.',
                            'image.mimes' => 'Image should be in jpeg, jpg or png format.',
                            'image.dimensions' => 'Image size should be of 400x303px',
                            'image_url.required' => 'This field is required.'
                        ];
                        break;
                    case "bottom":
                        $addImgRules = [
                            'image' => 'required|mimes:jpeg,jpg,png|dimensions:width=1400,height=299',
                            'image_url' => 'required'
                        ];
                        $addImgMessages = [
                            'image.required' => 'This Field is required.',
                            'image.mimes' => 'Image should be in jpeg, jpg or png format.',
                            'image.dimensions' => 'Image size should be of 1400x299px',
                            'image_url.required' => 'This field is required.'
                        ];
                        break;
                } 
            }
            
            $rules = array_merge($rules, $addImgRules);
            $messages = array_merge($messages, $addImgMessages);

            //for check banner position availability on selected page within the selected time interval
            if(!Input::get('is_default') && (!empty($request->start_date) && !empty($request->end_date) && !empty($request->banner_position))) {
                $cba_status = $this->check_availability($request->start_date, $request->end_date, $request->page_id, $request->banner_position, $id);
                
                if($cba_status['status'] == false) {
                    return \Redirect::back()->withInput(Input::all())->withDanger( 'Some dates are already reserved within your time interval at your selected page and position. Your advertisement will be available after  '.$cba_status['nearest_end_date']);
                }
            }
            
            if(Input::get('is_default') && !empty($request->banner_position) && !empty($request->page_id)) {
                $getAlreadyDefaultStatus = $this->check_already_default_position($request->page_id, $request->banner_position, $request->category_id, $request->subcategory_id, $id);
                if($getAlreadyDefaultStatus == 1) {
                    return \Redirect::back()->withInput(Input::all())->withDanger( 'Advertisement could not be saved. There is already a default advertisement saved on the selected page, position and categories.' );
                }
            }
            
            $validator = \Validator::make($request->all(), $rules, $messages);

            $this->validate($request, $rules, $messages);
            if ($validator->fails()) {
                return redirect('admin/advertisements/create/')
                    ->withErrors($validator)
                    ->withInput();
            }

            if(($request->page_id == 1 || $request->page_id == 4) && !Input::get('is_default') ) {
                $valuesArray = array('title', 'page_id', 'banner_position', 'pre_image_url', 'start_date', 'end_date', 'contact_email');
            }
            if(($request->page_id == 1 || $request->page_id == 4) && Input::get('is_default')) {
                $valuesArray = array('title', 'page_id', 'banner_position', 'pre_image_url', 'contact_email');
            }
            if(($request->page_id != 1 && $request->page_id != 4) && !Input::get('is_default')) {
                $valuesArray = array('title', 'page_id', 'category_id', 'subcategory_id', 'banner_position', 'pre_image_url', 'start_date', 'end_date', 'contact_email');
            }
            if(($request->page_id != 1 && $request->page_id != 4) && Input::get('is_default')) {
                $valuesArray = array('title', 'page_id', 'category_id', 'subcategory_id', 'banner_position', 'pre_image_url', 'contact_email');
            } 

            $updated_data = array();
            foreach($requestArray as $rqstKy => $rqstVal) {
                if(in_array($rqstKy, $valuesArray)) {
                    if($rqstKy == "start_date" || $rqstKy == "end_date") {
                        $updated_data[$rqstKy] = date("Y-m-d", strtotime(Input::get($rqstKy)));
                    } else if($rqstKy == "pre_image_url") {
                        $updated_data["image_url"] = Input::get($rqstKy);
                    } else {
                        $updated_data[$rqstKy] = Input::get($rqstKy);
                    }
                }
            }

            if(($request->page_id == 1 || $request->page_id == 4) && !Input::get('is_default') ) {
                $updated_data["category_id"] = $updated_data["subcategory_id"] =  null;
            }
            if(($request->page_id == 1 || $request->page_id == 4) && Input::get('is_default')) {
                $updated_data["category_id"] = $updated_data["subcategory_id"] = $updated_data["start_date"] = $updated_data["end_date"] = null;
            }
            if(($request->page_id != 1 && $request->page_id != 4) && Input::get('is_default')) {
                $updated_data["start_date"] = $updated_data["end_date"] = null;
            }
            
            if (!isset($request->status) && $request->status != 1) {
                $updated_data["status"] = 0;
            } else {
                $updated_data["status"] = 1;
            }

            if (!isset($request->is_default) && $request->is_default != 1) {
                $updated_data["is_default"] = 0;
            } else {
                $updated_data["is_default"] = 1;
            }

            if (Input::file('image')) {
                $image = Input::file('image');
                $destinationPath = 'upload_images/advertisements/image/';

                $extension = $image->getClientOriginalExtension();
                $ran = rand(11111, 99999);
                $fileName = $ran . '.' . $extension;
                $thumbFileName = '100x100_' . $ran . '.' . $extension;

                $image->move($destinationPath, $fileName);
                image1::make($destinationPath . $fileName)->resize(100, 100)->save($destinationPath . $thumbFileName);

                $updated_data["image"] = $fileName;
                $updated_data["image_url"] = Input::get('image_url');
            }

            try {
                \DB::table('advertisements')->where("id", $id)->update($updated_data);
                return \Redirect('admin/advertisements')->withSuccess( ' Advertisement has been updated successfully.' );
            } catch (\Exception $e) {
                dd($e);
                return redirect('admin/advertisements/edit/' . $id)->withDanger( ' Advertisement could not be saved. Please try again.' );
            }
        }

        $categories = $category->categoryListing(['pid' => 0]);
        $subcategories = $category->categoryListing(['pid' => $data->category_id]);
        $all_ad_positions = \DB::table('pages')->pluck('name', 'id')->all();

        return view('admin/' . $this->viewName . '/edit', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'data', 'categories', 'subcategories', 'all_ad_positions', 'communities_informationarr'));
    }

    /**
     * Admin delete
     * delete feeds
     *
     * @return void
     * @access public
     */
    public function admin_delete() {

        $viewName = $this->viewName;
        $data = Input::all();
        $id = $data['id'];

        if (!empty($id)) {
            $result = $this->model->findOrFail($id);
            $result->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully Deleted.');
            return response()->json(['status' => true, 'url' => 'advertisements']);
        }
    }

    /**
     * check_availability
     * Checks the new banner positions is already reserved or not for the selected time interval
     *
     * @return void
     * @access public
     */
    public function check_availability($s_date = null, $e_date = null, $pg = null, $b_pos = null, $ad_id = null) {
        $s_date = date("Y-m-d", strtotime($s_date));
        $e_date = date("Y-m-d", strtotime($e_date));
        $check_availability_status = array(
            'status' => true,
        );
        while (strtotime($s_date) <= strtotime($e_date)) {
            
            if($ad_id != null) {
                $conditions = array(
                    array('page_id', $pg),
                    array('banner_position', $b_pos),
                    array('id', '!=', $ad_id),
                    array('status', '=', 1),
                ); 
            } else {
                $conditions = array(
                    array('page_id', $pg),
                    array('banner_position', $b_pos),
                    array('status', '=', 1),
                );
            }
            $reserved_rows = \DB::table('advertisements')
                ->whereRaw(" '$s_date' Between advertisements.start_date  and advertisements.end_date ")
                ->where($conditions)
                ->get();
            $max_images = $this->get_allowed_no_of_images($pg, $b_pos);
            
            if(count($reserved_rows->toarray()) >= $max_images) {
                $check_availability_status = array(
                    'status' => false,
                    'nearest_end_date' => $reserved_rows[0]->end_date
                );
                return $check_availability_status;
            }
            $s_date = date ("Y-m-d", strtotime("+1 day", strtotime($s_date)));
        }
        return $check_availability_status;
    }

    /**
     * get_allowed_no_of_images
     * get max number of allowed at given page and position
     *
     * @return \Illuminate\Http\Response
     */
    public function get_allowed_no_of_images($selPagId = null, $selBannPos = null) {
        $get_max_images = null;
        //for home page
        if($selPagId == 1) {
            switch ($selBannPos) {
                case "top":
                    $get_max_images = Redis::get('home-page-top-ad-max-images');
                    break;
                case "right":
                    $get_max_images = Redis::get('home-page-right-ad-max-images');
                    break;
                case "bottom":
                    $get_max_images = Redis::get('home-page-bottom-ad-max-images');
                    break;
            }
        }
        if($selPagId == 2) {
            switch ($selBannPos) {
                case "top":
                    $get_max_images = Redis::get('classified-detail-top-ad-max-images');
                    break;
                case "right":
                    $get_max_images = Redis::get('classified-detail-right-ad-max-images');
                    break;
                case "bottom":
                    $get_max_images = Redis::get('classified-detail-bottom-ad-max-images');
                    break;
            }
        }
        if($selPagId == 3) {
            switch ($selBannPos) {
                case "top":
                    $get_max_images = Redis::get('classified-listing-top-ad-max-images');
                    break;
                case "right":
                    $get_max_images = Redis::get('classified-listing-right-ad-max-images');
                    break;
                case "bottom":
                    $get_max_images = Redis::get('classified-listing-bottom-ad-max-images');
                    break;
            }
        }
        if($selPagId == 4) {
            switch ($selBannPos) {
                case "top":
                    $get_max_images = Redis::get('prayer-timing-top-ad-max-images');
                    break;
                case "right":
                    $get_max_images = Redis::get('prayer-timing-right-ad-max-images');
                    break;
                case "bottom":
                    $get_max_images = Redis::get('prayer-timing-bottom-ad-max-images');
                    break;
            }
        }
        return $get_max_images;
    }

    /**
     * check_availability
     * Checks the new banner positions is already reserved or not for the selected time interval
     *
     * @return void
     * @access public
     */
    public function check_already_default_position($pg = null, $b_pos = null, $cat = null, $sub_cate = null, $id=null) {
        $check_already_default_position_status = 0;
        $whrCat = [];
        if($cat && !$sub_cate){
            $whrCat = ['category_id' => $cat, 'subcategory_id' => 0];
        }
        if($sub_cate){
            $whrCat = ['subcategory_id' => $sub_cate];
        }
        
        if($id){
            $already_exits = \DB::table('advertisements')->where("id", "!=", $id)->where($whrCat)->where("page_id", "=", $pg)->where("banner_position", "=", $b_pos)->where("is_default", "=", 1)->where("status", "=", 1)->first();
        } else {
            $already_exits = \DB::table('advertisements')->where($whrCat)->where("page_id", "=", $pg)->where("banner_position", "=", $b_pos)->where("is_default", "=", 1)->where("status", "=", 1)->first();
        }
        
        if($already_exits) {
            $check_already_default_position_status = 1;
        }
        return $check_already_default_position_status;
    }

    /**
     * admin_set_order
     * set order number of advertisement for reflect as given order at front
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_set_order(Request $request) {

        if ($request->isMethod('post')) {
            $newArray = json_decode($request->data, TRUE);
            $status = true;
            foreach($newArray as $id => $value) {
                $result = $this->model->where("id", $id)->update(array('order_no' => $value));
                if(!$result) {
                    $status = false;
                }
            }
            if($status) {
                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Order no updated successfully.');
                return response()->json(['status' => true, 'message' => "Order no updated successfully."]);
                die;    
            } else {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', 'Order no could not be updated. Please try again.');
                return response()->json(['status' => false, 'message' => "Order no could not be updated. Please try again."]);
                die;
            }
        }
    }

    /**
     * Admin Multi Check Rows
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_multi_check_options() {

        $data = Input::all();
        if (!empty($data['checkedId'])) {
            foreach ($data['checkedId'] as $key => $value) {
                DB::table('advertisements')
                        ->where('id', $value)
                        ->update(['status' => $data['status']]);
            }
            return response()->json(['status' => true, 'url' => 'advertisements']);
        }
    }

    /**
     * deactive_expired_ads
     * deactive all expired advertisements
     *
     * @return \Illuminate\Http\Response
     */
    public function deactive_expired_ads() {
        \DB::table('advertisements')->where('end_date', '<', date("Y-m-d"))->where('status', '=', 1)->update(['status' => 0]);
        die;
    } 
    
    /**
     * active_ads
     * deactive all expired advertisements
     *
     * @return \Illuminate\Http\Response
     */

    public function get_active_ad_positions(Request $request) {
        if ($request->isMethod('post')) {
            $data = \DB::table('pages')->select('top', 'right', 'bottom', 'left')->where('id', '=', $request->page)->first();
            $nwData = array_filter((array)$data);
            foreach($nwData as $key => $value){
                $nwData[$key] = $key;
            }
            Session::set('adPosData', $nwData);
            return response()->json(['status' => true, 'all_positions' => $data]);
        }
    }

}
