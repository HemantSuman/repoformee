<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\SavedSearch;
use App\models\Category;
use App\models\Classified;
use App\models\User;
use Hash;
use DB;
use Mail;
use App\Event;
use Session;
use Cookie;
use Illuminate\Routing\Route;
use Redirect;
use DateTime;
use Illuminate\Support\Facades\Redis;
use App\Url;

class SavedSearchesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'saved_searches';
        $this->viewName = 'saved_searches';
        $this->modelTitle = 'SavedSearch';
        $this->model = new SavedSearch;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * save_search
     * function to save the user search
     *
     * @return void
     * @access public
     */
    public function save_search(Request $request) {

        if ($request->isMethod('post')) {
            $requestArray = Input::all();
            $data = new \App\models\SavedSearch;
            foreach ($requestArray as $rqstKy => $rqstVal) {
                if (!in_array($rqstKy, array("_token"))) {
                    $data->$rqstKy = Input::get($rqstKy);
                }
            }
            $data->user_id = Auth::guard('web')->user()->id;

            $conditions = array(
                array('name', '=', $request->name),
                array('user_id', '=', Auth::guard('web')->user()->id),
                array('usr_state', '=', $request->usr_state),
                array('usr_city', '=', $request->usr_city)
            );
            if ($request->category_id) {
                $checkCategoryIsParent = \DB::table("categories")->select("id", "pid")->where("id", "=", $request->category_id)->first();
                $data->is_category_parent = ($checkCategoryIsParent->pid == 0) ? 1 : 0;
                $conditions[] = array('category_id', '=', $request->category_id);
            } else {
                $data->is_category_parent = null;
            }

            if ($request->category_id) {
                $checkAlredyExist = $this->model->where($conditions)->first();
                if ($checkAlredyExist) {
                    return response()->json(['status' => false, 'message' => 'Search could not be saved. A similar search already saved in your account.']);
                }
            }


            if ($data->save()) {
                return response()->json(['status' => true, 'message' => 'Your search has been saved successfully.']);
            } else {
                return response()->json(['status' => false, 'message' => 'Search could not be saved. Please try again.']);
            }
        }
    }

    /**
     * save_search
     * function to save the user search
     *
     * @return response
     * @access public
     */
    public function save_searchapi(Request $request) {

        if ($request->isMethod('post')) {
            $data = new \App\models\SavedSearch;

            $logginid = $request->user_id;
            $name = $request->name;
            $email_frequency = $request->email_frequency;
            $keyword = $request->keyword;
            $city = $request->address;
            $lat = $request->lat;
            $lng = $request->lng;
            $usr_state = $request->usr_state;
            $usr_city = $request->usr_city;
            $usr_pcode = $request->usr_pcode;
            $distance = 50;
            $category_id = $request->category_id;

            if (!empty($logginid) && !empty($keyword) && !empty($category_id) && !empty($name)) {
                $conditions = array(
                    array('name', '=', $request->name),
                    array('user_id', '=', $logginid),
                    array('usr_state', '=', $usr_state),
                    array('usr_city', '=', $usr_city)
                );
                if ($category_id) {
                    $checkCategoryIsParent = \DB::table("categories")->select("id", "pid")->where("id", "=", $request->category_id)->first();
                    $data->is_category_parent = ($checkCategoryIsParent->pid == 0) ? 1 : 0;
                    $conditions[] = array('category_id', '=', $request->category_id);
                } else {
                    $data->is_category_parent = null;
                }
                $data->user_id = $logginid;
                $data->name = $name;
                $data->email_frequency = $email_frequency;
                $data->keyword = $keyword;
                $data->city = $city;
                $data->lat = $lat;
                $data->lng = $lng;
                $data->usr_state = $usr_state;
                $data->usr_city = $usr_city;
                $data->usr_pcode = $usr_pcode;
                $data->distance = $distance;
                $data->category_id = $category_id;


                if ($request->category_id) {
                    $checkAlredyExist = $this->model->where($conditions)->first();
                    if ($checkAlredyExist) {
                        $result['status'] = 0;
                        $result['msg'] = 'Search could not be saved. A similar search already saved in your account.';
                        echo json_encode($result);
                        die;
                    }
                }


                if ($data->save()) {
                    $result['status'] = 1;
                    $result['msg'] = 'Your search has been saved successfully.';
                    echo json_encode($result);
                    die;
                } else {
                    $result['status'] = 0;
                    $result['msg'] = 'Search could not be saved. Please try again.';
                    echo json_encode($result);
                    die;
                }
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Invalid Details';
                echo json_encode($result);
                die;
            }
        }
    }

    /**
     * index
     * function to save the user search
     *
     * @return void
     * @access public
     */
    public function index(Request $request) {
        $logged_in_user_id = Auth::guard('web')->user()->id;
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);
        $showMessage = false;

        $userObj = new User;
        $user_details = $userObj->where('id', '=', $logged_in_user_id)->first();

        if ($request->isMethod('post')) {

            $updateStatus = $this->model->where("id", "=", $request->svdSrchID)->update(array("email_frequency" => $request->e_freq));
            if ($updateStatus) {
                return response()->json(['status' => true, 'message' => 'Updated successfully.']);
            } else {
                return response()->json(['status' => false, 'message' => 'Could not be updated. Please try again.']);
            }
        } else {
            $searchData = Input::all();
            $searchVal = null;
            $data = $this->model->with(["category" => function($category) {
                            $category->select("id", "name");
                        }])->where("user_id", "=", $logged_in_user_id);

            if (isset($searchData['name'])) {
                $data = $data->where("name", "LIKE", "%{$searchData['name']}%");
                $searchVal = $searchData['name'];
            }
        }

        $userClassifiedObj = new Classified;
        $user_total_classifieds = $userClassifiedObj->where('user_id', '=', Auth::guard('web')->user()->id)->count();
        //count total number of views of his/her all classifieds
        $total_viewer = $userClassifiedObj->selectRaw("sum(count) as total_views")->where('user_id', '=', Auth::guard('web')->user()->id)->first();

        $data = $data->orderBy('id', 'DESC')->paginate(10);
        $data->setPath('')->appends(Input::query())->render();
        
		
		$user_type = Auth::guard('web')->user()->seller_type;
		if($user_type == 'business'){
        	return view('front/' . $this->viewName . '/index', compact('allSubCategories', 'allComCategories', 'allSubCategoriesForMenu', 'data', 'searchVal', 'showMessage', 'user_details', 'user_total_classifieds', 'total_viewer'));
		}else{
			return view('front/' . $this->viewName . '/private/index', compact('allSubCategories', 'allComCategories', 'allSubCategoriesForMenu', 'data', 'searchVal', 'showMessage', 'user_details', 'user_total_classifieds', 'total_viewer'));
		}
			
		
    }

    /**
     * searchlistupdatestatusapi
     * function to searchlistupdatestatusapi
     *
     * @return response
     * @access public
     */
    public function searchlistupdatestatusapi(Request $request) {
        $id = $request->id;
        $email_frequency = $request->email_frequency;
        if (!empty($id) && !empty($email_frequency)) {
            $updateStatus = $this->model->where("id", "=", $id)->update(array("email_frequency" => $email_frequency));
            if ($updateStatus) {
                $result['status'] = 1;
                $result['msg'] = 'Search has been updated successfully.';
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Search could not be updated. Please try again.';
                echo json_encode($result);
                die;
            }
        } else {
            $result['status'] = 0;
            $result['msg'] = 'Invalid Detail';
            echo json_encode($result);
            die;
        }
    }

    /**
     * savesearchlistapi
     * function to savesearchlistapi
     *
     * @return response
     * @access public
     */
    public function savesearchlistapi(Request $request) {
        $logged_in_user_id = $request->user_id;
        $task = new Category;

        if ($request->isMethod('post')) {
            if (!empty($logged_in_user_id)) {
                $searchData = Input::all();
                $searchVal = null;
                $data = $this->model->with(["category" => function($category) {
                                $category->select("id", "name");
                            }])->where("user_id", "=", $logged_in_user_id);
                $data = $data->orderBy('id', 'DESC')->get();
                $data = $data->toarray();
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        if (!empty($value['usr_city'])) {
                            $location = $value['usr_city'];
                        } else {
                            $location = 'N/A';
                        }

                        $valuedata[] = array(
                            'id' => $value['id'],
                            'phrase' => $value['name'],
                            'category' => $value['category']['name'],
                            'emailfrequency' => $value['email_frequency'],
                            'location' => $location,
                        );
                    }

                    $result['status'] = 1;
                    $result['msg'] = 'Result Found';
                    $result['data'] = $valuedata;
                    echo json_encode($result);
                    die;
                } else {
                    $result['status'] = 0;
                    $result['msg'] = 'No Data Found';
                    echo json_encode($result);
                    die;
                }
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Invalid Detail';
                echo json_encode($result);
                die;
            }
        }
    }

    /**
     * delete_saved_searchapi
     * function to save the delete_saved_searchapi
     *
     * @return response
     * @access public
     */
    public function delete_saved_searchapi(Request $request) {
        $id = $request->id;
        if (!empty($id)) {
            $data = $this->model->findOrFail($id);
            if ($data->delete()) {
                $result['status'] = 1;
                $result['msg'] = 'Search has been deleted successfully.';
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Search could not be deleted. Please try again.';
                echo json_encode($result);
                die;
            }
        } else {
            $result['status'] = 0;
            $result['msg'] = 'Invalid Detail';
            echo json_encode($result);
            die;
        }
    }

    /**
     * delete_saved_search
     * function to save the delete_saved_search
     *
     * @return response
     * @access public
     */
    public function delete_saved_search($id = null) {
        if (!empty($id)) {
            $result = $this->model->findOrFail($id);
            if ($result->delete()) {
                return Redirect::back()->withSuccess("Search has been deleted successfully.");
            } else {
                return Redirect::back()->withDanger("Search could not be deleted. Please try again.");
            }
        }
    }

    /**
     * mail_at_daily_frequency
     * function to mail_at_daily_frequency
     *
     * @return response
     * @access public
     */
    public function mail_at_daily_frequency() {
        $mailData = array();

        $userEmailsData = $this->model
                ->with(["user" => function($user) {
                        $user->select("id", "name", "email");
                    }])
                ->where("email_frequency", "=", 2)
                ->groupBy('user_id')
                ->get();

        $newAddedClassifiedData = array();
        foreach ($userEmailsData as $userEmailsDataKey => $userEmailsDataVal) {
            $userDetail = $this->model
                    ->with(["user" => function($user) {
                            $user->select("id", "name", "email", "device_id", "device_type", "image", "avatar");
                        }])
                    ->where("user_id", "=", $userEmailsDataVal['user_id'])
                    ->groupBy('user_id')
                    ->first();

            $data = $this->model
                    ->where("user_id", "=", $userEmailsDataVal['user_id'])
                    ->where("category_id", "!=", 0)
                    ->where("email_frequency", "=", 2)
                    ->groupBy('category_id')
                    ->get();

            $classifiedData = array();
            $savedSearchData = null;
            foreach ($data as $dataKey => $dataVal) {
                $newData = Category::where("id", "=", $dataVal['category_id']);
                $savedSearchData[] = $dataVal->toarray();
                if ($dataVal['is_category_parent'] == 1) {
                    //is parent
                    $newData = $newData->with(["parentCategory_classifieds" => function($parentCategory_classifieds) {
                                    $parentCategory_classifieds->select("id", "title", "parent_categoryid", "category_id", "price", "location", "created_at", "lat", "lng");
                                    $parentCategory_classifieds->whereDate('created_at', '=', date('Y-m-d'));
                                    $parentCategory_classifieds->where('status', '=', 1);
                                    $parentCategory_classifieds->with(["classified_image" => function($classified_image) {
                                            
                                        }]);
                                    $parentCategory_classifieds->with(["categoriesname" => function($pcClsfdCat) {
                                            $pcClsfdCat->select("id", "pid", "name");
                                        }]);
                                }])->select("id", "pid", "name")->first();
                            $categoryName = $newData->name;
                            $classifiedData[] = $newData->parentCategory_classifieds->toarray();
                        } else {
                            //not parent
                            $newData = $newData->with(["subCategory_classifieds" => function($subCategory_classifieds) {
                                            $subCategory_classifieds->select("id", "title", "parent_categoryid", "category_id", "price", "location", "created_at", "lat", "lng");
                                            $subCategory_classifieds->whereDate('created_at', '=', date('Y-m-d'));
                                            $subCategory_classifieds->where('status', '=', 1);
                                            $subCategory_classifieds->with(["classified_image" => function($classified_image) {
                                                    
                                                }]);
                                            $subCategory_classifieds->with(["Subcategoriesname" => function($scClsfdCat) {
                                                    $scClsfdCat->select("id", "pid", "name");
                                                }]);
                                        }])->select("id", "pid", "name")->first();
                                    $categoryName = $newData->name;
                                    $classifiedData[] = $newData->subCategory_classifieds->toarray();
                                }
                            }
                            $newAddedClassifiedData[$userEmailsDataKey]['new_added_classifieds'] = $classifiedData;
                            $newAddedClassifiedData[$userEmailsDataKey]['user_detail'] = $userDetail->user->toarray();
                            $newAddedClassifiedData[$userEmailsDataKey]['saved_search_data'] = $savedSearchData;
                        }

                        foreach ($newAddedClassifiedData as $newAddedClassifiedDataKey => $newAddedClassifiedDataVal) {
                            $userDetails = $newAddedClassifiedDataVal['user_detail'];
                            $newClassifiedDetails = $newAddedClassifiedDataVal['new_added_classifieds'];
                            $countclassified = count($newClassifiedDetails);

                            $mergeClassifieds = null;
                            foreach ($newClassifiedDetails as $finalClassifiedDetailKey => $finalClassifiedDetailVal) {
                                if (!empty($finalClassifiedDetailVal)) {

                                    if (!empty($finalClassifiedDetailVal->lat) && !empty($finalClassifiedDetailVal->lng) && !empty($newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey]['lat']) && !empty($newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey]['lng']) && $newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey]['defaultlocation'] == 0) {

                                        $calculate_distance = SQRT(POW(69.1 * (($newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey]['lat']) - ($finalClassifiedDetailVal->lat)), 2) + POW(69.1 * (($finalClassifiedDetailVal->lng) - ($newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey]['lng'])) * COS(($newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey]['lat']) / 57.3), 2));

                                        if ($calculate_distance <= $savedSearchDataVal->distance) {
                                            $mergeClassifieds = $finalClassifiedDetailVal;
                                            $savedSrchDtl = $newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey];
                                            if (!empty($mergeClassifieds)) {

                                                $device_id = $userDetails['device_id'];
                                                $categoryname = $savedSrchDtl['name'];
                                                $type = $userDetails['device_type'];
                                                $message = " $countclassified new product added in $categoryname your Save search list";
                                                $messagetype = 'Save search';

                                                $categoryid = $savedSrchDtl['category_id'];



                                                $sender_id = $userDetails['id'];
                                                $receiver_id = '0';
                                                $sendername = $userDetails['name'];

                                                if ($userDetails['image']) {
                                                    $imgurl = \URL::asset('upload_images/users/' . $userDetails['id'] . '/' . $userDetails['image']);
                                                } elseif ($userDetails['avatar']) {
                                                    $imgurl = $userDetails['avatar'];
                                                } else {
                                                    $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
                                                }





                                                if (!empty($userDetails['device_id'])) {


                                                    if ($type == 'Android') {
                                                        $this->simplePushNotificationA($message, $device_id, $type, $messagetype, $categoryid);
                                                    } else {
                                                        $this->simplePushNotificationI($message, $device_id, $type, $messagetype, $categoryid);
                                                    }
                                                    //$this->simplePushNotificationA($message, $device_id, $type, $sender_id, $classified_id, $receiver_id);
                                                } else {
                                                    $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $categoryid, $receiver_id, $sendername, $messagetype, $imgurl);
                                                }
                                                Mail::send('emails.saved_search_template', ['mailDetails' => $mergeClassifieds, 'userDetails' => $userDetails, 'savedSrchDtl' => $savedSrchDtl], function($message) use ($userDetails) {
                                                    $message->to($userDetails['email'])->subject('New results in your saved searches.');
                                                });
                                            }
                                        }
                                    } else {
                                        $mergeClassifieds = $finalClassifiedDetailVal;
                                        $savedSrchDtl = $newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey];
                                        if (!empty($mergeClassifieds)) {

                                            $categoryname = $savedSrchDtl['name'];
                                            $device_id = $userDetails['device_id'];
                                            $type = $userDetails['device_type'];
                                            $message = " $countclassified new product added in $categoryname your Save search list";
                                            $messagetype = 'Save search';
                                            $categoryid = $savedSrchDtl['category_id'];

                                            $sender_id = $userDetails['id'];
                                            $receiver_id = '0';
                                            $sendername = $userDetails['name'];

                                            if ($userDetails['image']) {
                                                $imgurl = \URL::asset('upload_images/users/' . $userDetails['id'] . '/' . $userDetails['image']);
                                            } elseif ($userDetails['avatar']) {
                                                $imgurl = $userDetails['avatar'];
                                            } else {
                                                $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
                                            }

                                            if (!empty($userDetails['device_id'])) {


                                                if ($type == 'Android') {
                                                    $this->simplePushNotificationA($message, $device_id, $type, $messagetype, $categoryid);
                                                } else {
                                                    $this->simplePushNotificationI($message, $device_id, $type, $messagetype, $categoryid);
                                                }
                                            } else {
                                                $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $categoryid, $receiver_id, $sendername, $messagetype, $imgurl);
                                            }
                                            Mail::send('emails.saved_search_template', ['mailDetails' => $mergeClassifieds, 'userDetails' => $userDetails, 'savedSrchDtl' => $savedSrchDtl], function($message) use ($userDetails) {
                                                $message->to($userDetails['email'])->subject('New results in your saved searches.');
                                            });
                                        }
                                    }


                                }
                            }
                        }
                    }

                    /**
                     * Function send mail to user [Weekly email frequency]
                     * @return response
                     * @access public
                     */
                    public function mail_at_weekly_frequency() {
                        $mailData = array();

                        $userEmailsData = $this->model
                                ->with(["user" => function($user) {
                                        $user->select("id", "name", "email");
                                    }])
                                ->where("email_frequency", "=", 3)
                                ->groupBy('user_id')
                                ->get();

                        $newAddedClassifiedData = array();
                        foreach ($userEmailsData as $userEmailsDataKey => $userEmailsDataVal) {
                            $userDetail = $this->model
                                    ->with(["user" => function($user) {
                                            $user->select("id", "name", "email", "device_id", "device_type", "image", "avatar");
                                        }])
                                    ->where("user_id", "=", $userEmailsDataVal['user_id'])
                                    ->groupBy('user_id')
                                    ->first();

                            $data = $this->model
                                    ->where("user_id", "=", $userEmailsDataVal['user_id'])
                                    ->where("category_id", "!=", 0)
                                    ->where("email_frequency", "=", 3)
                                    ->groupBy('category_id')
                                    ->get();

                            $classifiedData = array();
                            $savedSearchData = array();
                            foreach ($data as $dataKey => $dataVal) {
                                $newData = Category::where("id", "=", $dataVal['category_id']);
                                $savedSearchData[] = $dataVal->toarray();
                                if ($dataVal['is_category_parent'] == 1) {
                                    //is parent
                                    $newData = $newData->with(["parentCategory_classifieds" => function($parentCategory_classifieds) {
                                                    $parentCategory_classifieds->select("id", "title", "parent_categoryid", "category_id", "price", "location", "created_at", "lat", "lng");
                                                    $parentCategory_classifieds->whereBetween('created_at', [date('Y-m-d', strtotime("-7 days")), date("Y-m-d")]);
                                                    $parentCategory_classifieds->where('status', '=', 1);
                                                    $parentCategory_classifieds->with(["classified_image" => function($classified_image) {
                                                            
                                                        }]);
                                                    $parentCategory_classifieds->with(["categoriesname" => function($pcClsfdCat) {
                                                            $pcClsfdCat->select("id", "pid", "name");
                                                        }]);
                                                }])->select("id", "pid", "name")->first();
                                            $categoryName = $newData->name;
                                            $catNamee[] = $newData->name;
                                            $classifiedData[] = $newData->parentCategory_classifieds->toarray();
                                        } else {
                                            //not parent
                                            $newData = $newData->with(["subCategory_classifieds" => function($subCategory_classifieds) {
                                                            $subCategory_classifieds->select("id", "title", "parent_categoryid", "category_id", "price", "location", "created_at", "lat", "lng");
                                                            $subCategory_classifieds->whereBetween('created_at', [date('Y-m-d', strtotime("-7 days")), date("Y-m-d")]);
                                                            $subCategory_classifieds->where('status', '=', 1);
                                                            $subCategory_classifieds->with(["classified_image" => function($classified_image) {
                                                                    
                                                                }]);
                                                            $subCategory_classifieds->with(["Subcategoriesname" => function($scClsfdCat) {
                                                                    $scClsfdCat->select("id", "pid", "name");
                                                                }]);
                                                        }])->select("id", "pid", "name")->first();
                                                    $categoryName = $newData->name;
                                                    $catNamee[] = $newData->name;
                                                    $classifiedData[] = $newData->subCategory_classifieds->toarray();
                                                }
                                            }
                                            $newAddedClassifiedData[$userEmailsDataKey]['new_added_classifieds'] = $classifiedData;
                                            $newAddedClassifiedData[$userEmailsDataKey]['user_detail'] = $userDetail->user->toarray();
                                            $newAddedClassifiedData[$userEmailsDataKey]['saved_search_data'] = $savedSearchData;
                                            $newAddedClassifiedData[$userEmailsDataKey]['category_description'] = $catNamee;
                                        }


                                        foreach ($newAddedClassifiedData as $newAddedClassifiedDataKey => $newAddedClassifiedDataVal) {
                                            $userDetails = $newAddedClassifiedDataVal['user_detail'];
                                            $newClassifiedDetails = $newAddedClassifiedDataVal['new_added_classifieds'];
                                            $countclassified = count($newClassifiedDetails);
                                            $mergeClassifieds = null;
                                            foreach ($newClassifiedDetails as $finalClassifiedDetailKey => $finalClassifiedDetailVal) {
                                                if (!empty($finalClassifiedDetailVal)) {

                                                    if (!empty($finalClassifiedDetailVal->lat) && !empty($finalClassifiedDetailVal->lng) && !empty($newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey]['lat']) && !empty($newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey]['lng']) && $newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey]['defaultlocation'] == 0) {

                                                        $calculate_distance = SQRT(POW(69.1 * (($newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey]['lat']) - ($finalClassifiedDetailVal->lat)), 2) + POW(69.1 * (($finalClassifiedDetailVal->lng) - ($newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey]['lng'])) * COS(($newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey]['lat']) / 57.3), 2));

                                                        if ($calculate_distance <= $savedSearchDataVal->distance) {
                                                            $mergeClassifieds = $finalClassifiedDetailVal;
                                                            $savedSrchDtl = $newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey];
                                                            if (!empty($mergeClassifieds)) {
                                                                $device_id = $userDetails['device_id'];
                                                                $type = $userDetails['device_type'];
                                                                $categoryname = $savedSrchDtl['name'];
                                                                $message = " $countclassified new product added in $categoryname your Save search list";
                                                                $messagetype = 'Save search';
                                                                $categoryid = $savedSrchDtl['category_id'];

                                                                $sender_id = $userDetails['id'];
                                                                $receiver_id = '0';
                                                                $sendername = $userDetails['name'];

                                                                if ($userDetails['image']) {
                                                                    $imgurl = \URL::asset('upload_images/users/' . $userDetails['id'] . '/' . $userDetails['image']);
                                                                } elseif ($userDetails['avatar']) {
                                                                    $imgurl = $userDetails['avatar'];
                                                                } else {
                                                                    $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
                                                                }


                                                                if (!empty($userDetails['device_id'])) {


                                                                    if ($type == 'Android') {
                                                                        $this->simplePushNotificationA($message, $device_id, $type, $messagetype, $categoryid);
                                                                    } else {
                                                                        $this->simplePushNotificationI($message, $device_id, $type, $messagetype, $categoryid);
                                                                    }
                                                                } else {
                                                                    $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $categoryid, $receiver_id, $sendername, $messagetype, $imgurl);
                                                                }

                                                                Mail::send('emails.saved_search_template', ['mailDetails' => $mergeClassifieds, 'userDetails' => $userDetails, 'savedSrchDtl' => $savedSrchDtl], function($message) use ($userDetails) {
                                                                    $message->to($userDetails['email'])->subject('New results in your saved searches.');
                                                                });
                                                            }
                                                        }
                                                    } else {
                                                        $mergeClassifieds = $finalClassifiedDetailVal;
                                                        $savedSrchDtl = $newAddedClassifiedDataVal['saved_search_data'][$finalClassifiedDetailKey];
                                                        if (!empty($mergeClassifieds)) {

                                                            $device_id = $userDetails['device_id'];
                                                            $categoryname = $savedSrchDtl['name'];
                                                            $type = $userDetails['device_type'];
                                                            $message = " $countclassified new product added in your Save search list";
                                                            $messagetype = 'Save search';
                                                            $categoryid = $savedSrchDtl['category_id'];


                                                            $sender_id = $userDetails['id'];
                                                            $receiver_id = '0';
                                                            $sendername = $userDetails['name'];

                                                            if ($userDetails['image']) {
                                                                $imgurl = \URL::asset('upload_images/users/' . $userDetails['id'] . '/' . $userDetails['image']);
                                                            } elseif ($userDetails['avatar']) {
                                                                $imgurl = $userDetails['avatar'];
                                                            } else {
                                                                $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
                                                            }


                                                            if (!empty($userDetails['device_id'])) {


                                                                if ($type == 'Android') {
                                                                    $this->simplePushNotificationA($message, $device_id, $type, $messagetype, $categoryid);
                                                                } else {
                                                                    $this->simplePushNotificationI($message, $device_id, $type, $messagetype, $categoryid);
                                                                }
                                                            } else {
                                                                $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $categoryid, $receiver_id, $sendername, $messagetype, $imgurl);
                                                            }
                                                            Mail::send('emails.saved_search_template', ['mailDetails' => $mergeClassifieds, 'userDetails' => $userDetails, 'savedSrchDtl' => $savedSrchDtl], function($message) use ($userDetails) {
                                                                $message->to($userDetails['email'])->subject('New results in your saved searches.');
                                                            });
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    /**
                                     * Function send mail to user [Immediately email frequency]
                                     * @return response
                                     * @access public
                                     */
                                    public function mail_at_immediately_frequency($classifiedId = null) {

                                        $classifiedObj = new Classified;
                                        $classifiedData = $classifiedObj
                                                ->with("classified_image")
                                                ->where("id", "=", $classifiedId)
                                                ->first();
                                        // dd($classifiedData);
                                        if (!empty($classifiedData->location)) {
                                            $categoriesIdArray = array($classifiedData->parent_categoryid, $classifiedData->category_id);
                                            foreach ($categoriesIdArray as $categoriesIdArrayKey => $categoriesIdArrayVal) {
                                                if ($categoriesIdArrayVal != 0) {
                                                    $savedSearchData = $this->model
                                                            ->with(["user" => function($user) {
                                                                    $user->select("id", "name", "email", "device_id", "device_type", "image", "avatar");
                                                                }])
                                                            ->with(["category" => function($category) {
                                                                    $category->select("id", "pid", "name");
                                                                }])
                                                            ->where("category_id", "=", $categoriesIdArrayVal)
                                                            ->where("email_frequency", "=", 1)
                                                            ->groupBy('user_id')
                                                            ->get();

                                                    $mailDetails["classified_data"] = $classifiedData->toarray();
                                                    if (count($savedSearchData) > 0) {
                                                        foreach ($savedSearchData as $savedSearchDataKey => $savedSearchDataVal) {

                                                            //SQRT(POW(69.1 * (lat - $lat), 2) + POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))
                                                            if (!empty($savedSearchDataVal->lat) && !empty($savedSearchDataVal->lng) && !empty($classifiedData->lat) && !empty($classifiedData->lng) && $savedSearchDataVal->defaultlocation == 0) {
                                                                $calculate_distance = SQRT(POW(69.1 * (($savedSearchDataVal->lat) - ($classifiedData->lat)), 2) + POW(69.1 * (($classifiedData->lng) - ($savedSearchDataVal->lng)) * COS(($savedSearchDataVal->lat) / 57.3), 2));
                                                                if ($calculate_distance <= $savedSearchDataVal->distance) {
                                                                    $mailDetails["category"] = $savedSearchDataVal->category['name'];
                                                                    $mailDetails["user_detail"] = $savedSearchDataVal->user->toarray();
                                                                    $mailDetails["saved_srch_name"] = $savedSearchDataVal->name;
                                                                    $mailDetails["svd_srch_dtl"] = $savedSearchDataVal->toarray();
                                                                    Mail::send('emails.saved_search_immediately_template', ['mailDetails' => $mailDetails], function($message) use ($mailDetails) {
                                                                        $message->to($mailDetails["user_detail"]['email'])->subject('New results in your saved searches.');
                                                                    });
                                                                }
                                                            } else {
                                                                $mailDetails["category"] = $savedSearchDataVal->category['name'];
                                                                $mailDetails["user_detail"] = $savedSearchDataVal->user->toarray();
                                                                $mailDetails["saved_srch_name"] = $savedSearchDataVal->name;
                                                                $mailDetails["svd_srch_dtl"] = $savedSearchDataVal->toarray();

                                                                $categoryname = $savedSearchDataVal->category['name'];
                                                                $device_id = $mailDetails["user_detail"]['device_id'];
                                                                $type = $mailDetails["user_detail"]['device_type'];
                                                                $message = " 1 new product added in $categoryname your Save search list";
                                                                $messagetype = 'Save search';
                                                                $categoryid = $categoriesIdArrayVal;
                                                                $receiver_id = $mailDetails["user_detail"]['id'];
                                                                $sender_id = '0';
                                                                $sendername = $mailDetails["user_detail"]['name'];

                                                                if ($mailDetails["user_detail"]['image']) {
                                                                    $imgurl = \URL::asset('upload_images/users/' . $mailDetails["user_detail"]['id'] . '/' . $mailDetails["user_detail"]['image']);
                                                                } elseif ($mailDetails["user_detail"]['avatar']) {
                                                                    $imgurl = $mailDetails["user_detail"]['avatar'];
                                                                } else {
                                                                    $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
                                                                }

                                                                if (!empty($mailDetails["user_detail"]['device_id'])) {


                                                                    if ($type == 'Android') {
                                                                        $this->simplePushNotificationA($message, $device_id, $type, $messagetype, $categoryid);
                                                                    } else {
                                                                        $this->simplePushNotificationI($message, $device_id, $type, $messagetype, $categoryid);
                                                                    }
                                                                } else {
                                                                    $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $categoryid, $receiver_id, $sendername, $messagetype, $imgurl);
                                                                }
                                                                Mail::send('emails.saved_search_immediately_template', ['mailDetails' => $mailDetails], function($message) use ($mailDetails) {
                                                                    $message->to($mailDetails["user_detail"]['email'])->subject('New results in your saved searches.');
                                                                });
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            $categoriesIdArray = array($classifiedData->parent_categoryid, $classifiedData->category_id);
                                            foreach ($categoriesIdArray as $categoriesIdArrayKey => $categoriesIdArrayVal) {
                                                if ($categoriesIdArrayVal != 0) {
                                                    $savedSearchData = $this->model
                                                            ->with(["user" => function($user) {
                                                                    $user->select("id", "name", "email", "device_id", "device_type", "image", "avatar");
                                                                }])
                                                            ->with(["category" => function($category) {
                                                                    $category->select("id", "pid", "name");
                                                                }])
                                                            ->where("category_id", "=", $categoriesIdArrayVal)
                                                            ->where("email_frequency", "=", 1)
                                                            ->groupBy('user_id')
                                                            ->get();

                                                    $mailDetails["classified_data"] = $classifiedData->toarray();
                                                    if (count($savedSearchData) > 0) {

                                                        foreach ($savedSearchData as $savedSearchDataKey => $savedSearchDataVal) {


                                                            $mailDetails["category"] = $savedSearchDataVal->category['name'];
                                                            $mailDetails["user_detail"] = $savedSearchDataVal->user->toarray();
                                                            $mailDetails["saved_srch_name"] = $savedSearchDataVal->name;
                                                            $mailDetails["svd_srch_dtl"] = $savedSearchDataVal->toarray();

                                                            $categoryname = $savedSearchDataVal->category['name'];
                                                            $device_id = $mailDetails["user_detail"]['device_id'];
                                                            $type = $mailDetails["user_detail"]['device_type'];
                                                            $message = " 1 new product added in $categoryname your Save search list";
                                                            $messagetype = 'Save search';
                                                            $categoryid = $categoriesIdArrayVal;
                                                            $receiver_id = $mailDetails["user_detail"]['id'];
                                                            $sender_id = '0';
                                                            $sendername = $mailDetails["user_detail"]['name'];

                                                            if ($mailDetails["user_detail"]['image']) {
                                                                $imgurl = \URL::asset('upload_images/users/' . $mailDetails["user_detail"]['id'] . '/' . $mailDetails["user_detail"]['image']);
                                                            } elseif ($mailDetails["user_detail"]['avatar']) {
                                                                $imgurl = $mailDetails["user_detail"]['avatar'];
                                                            } else {
                                                                $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
                                                            }






                                                            if (!empty($mailDetails["user_detail"]['device_id'])) {


                                                                if ($type == 'Android') {
                                                                    $this->simplePushNotificationA($message, $device_id, $type, $messagetype, $categoryid);
                                                                } else {
                                                                    $this->simplePushNotificationI($message, $device_id, $type, $messagetype, $categoryid);
                                                                }
                                                            } else {
                                                                $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $categoryid, $receiver_id, $sendername, $messagetype, $imgurl);
                                                            }
                                                            Mail::send('emails.saved_search_immediately_template', ['mailDetails' => $mailDetails], function($message) use ($mailDetails) {
                                                                $message->to($mailDetails["user_detail"]['email'])->subject('New results in your saved searches.');
                                                            });
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    /**
                                     * simplePushNotificationA
                                     * function to simplePushNotificationA
                                     *
                                     * @return response
                                     * @access public
                                     */
                                    public static function simplePushNotificationA($message = NULL, $device_id = NULL, $type = NULL, $messagetype = NULL, $categoryid = NULL) {

                                        $registrationIds = array($device_id);

                                        // prep the bundle
                                        $msg = array
                                            (
                                            'message' => $message,
                                            'subject' => $messagetype,
                                            'categoryid' => $categoryid,
                                        );
                                        $attachmentData[] = array(
                                            'massage' => $message,
                                            'deviceid' => $device_id,
                                            'devicename' => $type,
                                            'subject' => $messagetype,
                                            'categoryid' => $categoryid,
                                        );
                                        \DB::table('savesearchnotification')->insert($attachmentData);
                                        $fields = array
                                            (
                                            'registration_ids' => $registrationIds,
                                            'data' => $msg
                                        );

                                        $headers = array
                                            (
                                            'Authorization: key=AIzaSyA1nkpUUbZ8PeysERRCcVVD3ap46KwPykw',
                                            'Content-Type: application/json'
                                        );

                                        $ch = curl_init();
                                        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
                                        curl_setopt($ch, CURLOPT_POST, true);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                                        $result = curl_exec($ch);
                                        curl_close($ch);

                                        if (!$result)
                                        // echo 'Message not delivered' . PHP_EOL;
                                            return 0;
                                        else
                                        //echo 'Message successfully delivered' . PHP_EOL;
                                            return 1;
                                        exit;
                                    }

                                    /**
                                     * simplePushNotificationI
                                     * function to simplePushNotificationI
                                     *
                                     * @return response
                                     * @access public
                                     */
                                    public static function simplePushNotificationI($msg = NULL, $device_id = NULL, $type = NULL, $messagetype = NULL, $categoryid = NULL) {
                                        $now = new DateTime();
                                        $now->format('Y-m-d H:i:s');
                                        $currentdatetime = $now->getTimestamp();
                                        $passphrase = '12345';

                                        $message = $msg;
                                        $categoryid = $categoryid;
                                        $attachmentData[] = array(
                                            'massage' => $message,
                                            'deviceid' => $device_id,
                                            'devicename' => $type,
                                            'subject' => $messagetype,
                                            'categoryid' => $categoryid,
                                        );
                                        \DB::table('savesearchnotification')->insert($attachmentData);
                                        ////////////////////////////////////////////////////////////////////////////////
                                        $ctx = stream_context_create();
                                        stream_context_set_option($ctx, 'ssl', 'local_cert', 'Certificates.pem');
                                        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

                                        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
                                        if (!$fp)
                                            return 0;
                                        //echo 'Connected to APNS' . PHP_EOL;

                                        $body['aps'] = array(
                                            'alert' => $message,
                                            'type' => $type,
                                            'massage' => $msg,
                                            'subject' => $messagetype,
                                            'categoryid' => $categoryid,
                                            'msg_time' => $currentdatetime,
                                            'sound' => 'default'
                                        );

                                        $payload = json_encode($body);
                                        $msg = chr(0) . pack('n', 32) . pack('H*', $device_id) . pack('n', strlen($payload)) . $payload;
                                        $result = fwrite($fp, $msg, strlen($msg));
                                        if (!$result)
                                            return 0;
                                        else
                                            return 1;

                                        fclose($fp);
                                        exit;
                                    }

                                    /**
                                     * simplePushNotificationW
                                     * function to simplePushNotificationW
                                     *
                                     * @return response
                                     * @access public
                                     */
                                    public static function simplePushNotificationW($msg = NULL, $device_id = NULL, $type = NULL, $senderId = NULL, $classified_id = NULL, $receiver_id = NULL, $sendername = NULL, $messagetype = NULL, $imageurl = NULL) {
                                        $now = new DateTime();
                                        $now->format('Y-m-d H:i:s');
                                        $currentdatetime = $now->getTimestamp();

                                        $redis = Redis::connection();
                                        $data1 = ['msg' => $msg, 's_id' => $senderId, 'r_id' => $receiver_id, 'classified_id' => $classified_id, 'name' => $sendername, 'image' => $imageurl, 'type' => $messagetype];
                                        $redis->publish('message', json_encode($data1));
                                        $msg = array
                                            (
                                            'message' => $msg,
                                            'subject' => 'web' . $messagetype,
                                            'categoryid' => $classified_id,
                                        );
                                        $attachmentData[] = array(
                                            'massage' => $msg,
                                            'deviceid' => $device_id,
                                            'devicename' => $type,
                                            'subject' => $messagetype,
                                            'categoryid' => $classified_id,
                                        );

                                        return 1;
                                        exit;
                                    }

                                }
                                