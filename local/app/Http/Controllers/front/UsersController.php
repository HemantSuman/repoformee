<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\User;
use App\models\Category;
use App\models\Classified;
use App\models\Wishlist;
use App\models\Message;
use App\models\Query;
use App\models\Cart;
use App\models\Order;
use App\models\OrderDetail;
use App\models\MembershipPlanUser;
use Hash;
use File;
use DB;
use Illuminate\Support\Facades\URL;
use Mail;
use App\Event;
use Session;
use Cookie;
use Illuminate\Routing\Route;
use Redirect;
use App\models\Role;
use Crypt;
use Illuminate\Support\Facades\Redis;
use Intervention\Image\Facades\Image as image1;
use Log;
use Srmklive\PayPal\Services\ExpressCheckout;

//use Illuminate\Support\Facades\Log;

class UsersController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->viewName = 'users';
        $this->modelTitle = 'User';
        $this->model = new User;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     * indexing of all users created by admin
     *
     * @return void
     * @access public
     */
    public function index() {
        return view('admin/login');
    }

    public function notification(Request $request) {

        $logged_in_user_id = Auth::guard('web')->user()->id;
        $user_details = $this->model->where('id', '=', $logged_in_user_id)->first();


        return view('front.users.notification', compact('user_details'));
    }

    /**
     * Handles Login functionality from Job Apply ,
     * using this sign in. check mailid or password.
     *
     * @param array $request Name of method to call.
     * @return json by called method
     */
    public function postloginjob(Request $request) {
        $input = $request->all();
        $referral_url = $_SERVER['HTTP_REFERER'];
        $this->validate($request, [
            'email' => 'required|between:3,64|email',
            'password' => 'required|between:6,20',
        ]);

        $email = $request->email;
        $password = $request->password;
        $remember = true;
        $jobid = $request->jobid;
        $hashedPassword = Hash::make($password);
        $row = \DB::table('users')->where("email", '=', $email)->first();
        if (!empty($row)) {
            if ($row->status == 0) {
                $result = array(
                    'status' => false,
                    'msg' => 'Your account is still not activated. Please go through the activation email to activate your account.',
                    'data' => array()
                );
                echo json_encode($result);
                die;
            } else {
                if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password], $remember)) {

                    if ($remember) {
                        Cookie::queue('front', $input, 3600);
                    }
                    $logged_in_user_id = Auth::guard('web')->user()->id;
                    if (Cookie::get('wishlistItems')) {
                        $logged_in_user_id = Auth::guard('web')->user()->id;
                        $wishlistData = Cookie::get('wishlistItems');
                        $wishlistObj = new Wishlist;
                        $insertedWishlistData = array();
                        foreach ($wishlistData as $wsKey => $clId) {
                            $checkAlreadyExist = $wishlistObj->where('classified_id', '=', $clId)->first();
                            if (count($checkAlreadyExist) == 0) {
                                $insertedWishlistData[] = array('user_id' => $logged_in_user_id, 'classified_id' => $clId);
                            }
                        }
                        if (!empty($insertedWishlistData)) {
                            $wishlistObj->insert($insertedWishlistData);
                        }
                    }

                    $updated_data = array(
                        'device_id' => '',
                        'device_model' => '',
                        'device_type' => '',
                        'os_version' => '',
                        'network_provider' => '',
                        'app_version_no' => '',
                    );
                    \DB::table('users')->where("id", $logged_in_user_id)->update($updated_data);
                    $result = array(
                        'status' => true,
                        'msg' => 'login_successfully',
                        'data' => array()
                    );


                    $json = json_encode($result);
                    return Redirect::to('classifieds-job/job-apply/' . $jobid);
                } else {
                    $result = array(
                        'status' => false,
                        'msg' => 'Invalid email or password. Please try again.',
                        'data' => array()
                    );
                    echo json_encode($result);
                    die;
                }
            }
        } else {
            $result = array(
                'status' => false,
                'msg' => 'Invalid email or password. Please try again.',
                'data' => array()
            );
            echo json_encode($result);
            die;
        }
    }

    /**
     * Handles Login functionality ,
     * using this sign in. check mailid or password.
     *
     * @param array $request Name of method to call.
     * @return json by called method
     */
    public function postlogin(Request $request) {
        $input = $request->all();
        $this->validate($request, [
            'seller_type' => 'required',
            'email' => 'required|between:3,64|email',
            'password' => 'required|between:6,20',
                ], [
            'seller_type.required' => 'Please select seller type.',
        ]);

        $email = $request->email;
        $password = $request->password;
        $remember = true;
        $hashedPassword = Hash::make($password);
        $row = \DB::table('users')->where("email", '=', $email)->first();
        if (!empty($row)) {
            if ($row->status == 0) {
                $result = array(
                    'status' => false,
                    'msg' => 'Your account is still not activated. Please go through the activation email to activate your account.',
                    'data' => array()
                );
                echo json_encode($result);
                die;
            } else {
                if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password], $remember)) {

                    if ($remember) {
                        Cookie::queue('front', $input, 3600);
                    }
                    $logged_in_user_id = Auth::guard('web')->user()->id;
                    if (Cookie::get('wishlistItems')) {
                        $logged_in_user_id = Auth::guard('web')->user()->id;
                        $wishlistData = Cookie::get('wishlistItems');
                        $wishlistObj = new Wishlist;
                        $insertedWishlistData = array();
                        foreach ($wishlistData as $wsKey => $clId) {
                            $checkAlreadyExist = $wishlistObj->where('classified_id', '=', $clId)->first();
                            if (count($checkAlreadyExist) == 0) {
                                $insertedWishlistData[] = array('user_id' => $logged_in_user_id, 'classified_id' => $clId);
                            }
                        }
                        if (!empty($insertedWishlistData)) {
                            $wishlistObj->insert($insertedWishlistData);
                        }
                    }

                    $updated_data = array(
                        'device_id' => '',
                        'device_model' => '',
                        'device_type' => '',
                        'os_version' => '',
                        'network_provider' => '',
                        'app_version_no' => '',
                    );
                    \DB::table('users')->where("id", $logged_in_user_id)->update($updated_data);
                    $result = array(
                        'status' => true,
                        'msg' => 'login_successfully',
                        'data' => array()
                    );

                    $json = json_encode($result);
                    //************Add cart's item into Cart table******
                    $cartmodel = new Cart;
                    $cart = $cartmodel->where('user_id', '=', $logged_in_user_id)->first();
                    $cartmodel->user_id = $logged_in_user_id;
                    if (isset($cart) && !empty($cart)) {
                        $cart_id = $cart->id;
                    } else {
                        $cart = $cartmodel->create($cartmodel->toArray());
                        $cart_id = $cart->id;
                    }
                    if (isset($_COOKIE['cartCookie'])) {
                        $encodeddata = $_COOKIE['cartCookie'];
                        $dataArr = json_decode($encodeddata, true);
                        foreach ($dataArr as $key => $value) {
                            $classified_id = $value['classified_id'];
                            $cartItems = DB::table('cart_classified')->where(['cart_id' => $cart_id, 'classified_id' => $classified_id])->first();
                            if (isset($cartItems) && count($cartItems) > 0) { //same item found
                                $newqty = $value['qty'] + $cartItems->qty;
                                //dd($value->id);
                                DB::table('cart_classified')
                                        ->where('id', $cartItems->id)
                                        ->update(['qty' => $newqty]);
                                $itemadded = 1;
                            } else { // cart item not found
                                $dbvalues = array('classified_id' => $classified_id, 'cart_id' => $cart_id, 'qty' => $value['qty'], 'ship_name' => $value['ship_name'], 'ship_cost' => $value['ship_cost']);
                                DB::table('cart_classified')->insert($dbvalues);
                            }
                        }

                        setcookie('cartCookie', "", time() - 3600, "/");
                    }

                    $NewcartItems = DB::table('cart_classified')->where('cart_id', '=', $cart_id)->get();
                    Session::set('cartItems', count($NewcartItems));
                    //************************************
                    return response($json, 200)->withCookie(Cookie::forget('wishlistItems'));
                } else {
                    $result = array(
                        'status' => false,
                        'msg' => 'Invalid email or password. Please try again.',
                        'data' => array()
                    );
                    echo json_encode($result);
                    die;
                }
            }
        } else {
            $result = array(
                'status' => false,
                'msg' => 'Invalid email or password. Please try again.',
                'data' => array()
            );
            echo json_encode($result);
            die;
        }
    }

    /**
     * apilogin
     * apilogin
     *
     * @return response
     * @access public
     */
    public function apilogin(Request $request) {
        $userClassifiedObj = new Classified;
        $current_date = date('Y-m-d');

        $email = $request->email;

        $password = $request->password;
        $device_id = $request->device_id;
        $device_model = $request->device_model;
        $device_type = $request->device_type;
        $os_version = $request->os_version;
        $network_provider = $request->network_provider;
        $app_version_no = $request->app_version_no;


        $hashedPassword = Hash::make($password);
        $row = \DB::table('users')->where("email", '=', $email)->first();
        if (!empty($row)) {
            if ($row->status == 0) {
                $blankvalue = array(
                    '' => '',
                );
                $result['status'] = 0;
                $result['msg'] = 'Your Account Is Not Active';
                $result['data'] = $blankvalue;

                echo json_encode($result);
                die;
            } else {

                $logintype = $row->login_type;
                if ($logintype == 'gmail' || $logintype == 'facebook') {
                    $blankvalue = array(
                        '' => '',
                    );
                    $result['status'] = 0;
                    $result['msg'] = 'Invalid Details';
                    $result['data'] = $blankvalue;

                    echo json_encode($result);
                    die;
                }

                if (strlen($password) <= 5) {
                    $blankvalue = array(
                        '' => '',
                    );
                    $result['status'] = 0;
                    $result['msg'] = 'Invalid Detail';
                    $result['data'] = $blankvalue;

                    echo json_encode($result);
                    die;
                }
                if (Auth::attempt(['email' => $request->email,
                            'password' => $request->password])) {
                    if ($row->image) {
                        $imgurl = URL::asset('upload_images/users/' . $row->id . '/' . $row->image);
                    } elseif ($row->avatar) {
                        $imgurl = $row->avatar;
                    } else {
                        $imgurl = URL::asset('plugins/front/img/profile-img-new.jpg');
                    }
                    if ($row->city) {
                        $location = $row->city;
                    } else {
                        $location = 'N/A';
                    }
                    if (empty($row->latitude) || empty($row->longitude)) {
                        $lat = '0.0';
                        $lng = '0.0';
                    } else {
                        $lat = $row->longitude;
                        $lng = $row->latitude;
                    }
                    if (!empty($row->mobile_no)) {
                        $mobileno = $row->mobile_no;
                    } else {
                        $mobileno = 'N/A';
                    }
                    $useraddcount = $userClassifiedObj
                                    ->selectRaw('id as classifiedid')
                                    ->where('user_id', '=', $row->id)
                                    ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                                    ->get()->count();
                    $rowvalue = array(
                        'id' => $row->id,
                        'name' => $row->name,
                        'email' => $row->email,
                        'image' => $imgurl,
                        'login_type' => $row->login_type,
                        'mobile_no' => $mobileno,
                        'location' => $location,
                        'phonecode' => $row->login_type,
                        'lat' => $lat,
                        'lng' => $lng,
                        'state' => $row->state,
                        'city' => $row->city,
                        'pincode' => $row->pincode,
                        'device_id' => $device_id,
                        'device_model' => $device_model,
                        'device_type' => $device_type,
                        'os_version' => $os_version,
                        'network_provider' => $network_provider,
                        'app_version_no' => $app_version_no,
                        'classifiedcount' => $useraddcount,
                        'created_date' => date("d-m-Y", strtotime($row->created_at)),
                    );
                    $id = $row->id;
                    $updated_data = array(
                        'device_id' => $device_id,
                        'device_model' => $device_model,
                        'device_type' => $device_type,
                        'os_version' => $os_version,
                        'network_provider' => $network_provider,
                        'app_version_no' => $app_version_no,
                    );
                    \DB::table('users')->where("id", $id)->update($updated_data);
                    $result['status'] = 1;
                    $result['msg'] = 'login_successfully';
                    $result['data'] = $rowvalue;
                    echo json_encode($result);
                    die;
                } else {
                    $blankvalue = array(
                        '' => '',
                    );
                    $result['status'] = 0;
                    $result['msg'] = 'Invalid Detail';
                    $result['data'] = $blankvalue;

                    echo json_encode($result);
                    die;
                }
            }
        } else {
            $blankvalue = array(
                '' => '',
            );
            $result['status'] = 0;
            $result['msg'] = 'Invalid Detail';
            $result['data'] = $blankvalue;

            echo json_encode($result);
            die;
        }
    }

    /**
     * logout
     * logout
     *
     * @return response
     * @access public
     */
    public function logout() {

        Auth::guard('web')->logout();
        setcookie('cartCookie', "", time() - 3600, "/");
        return redirect('/');
    }

    /**
     * registration
     * registration
     *
     * @return response
     * @access public
     */
    public function registration(Request $request) {
        if ($request->isMethod('post')) {
            $rules = [
                'seller_type' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|between:6,20',
                'cpassword' => 'required|same:password',
                'seller_type' => 'required'
            ];
            $messages = [
                'seller_type.required' => 'Please select seller type.',
                'email.required' => 'Please enter your email.',
                'email.email' => 'Please enter a valid email.',
                'email.unique' => 'Email already has been used. Please provide another.',
                'password.required' => 'The password must be between 6 and 20 characters.',
                'cpassword.required' => 'Re-type your password.',
                'cpassword.same' => 'Password does not match.',
                'seller_type.required' => 'Please select seller type.',
            ];

            $validator = \Validator::make($request->all(), $rules, $messages);
            $this->validate($request, $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'errors' => $validator]);
                die;
            }

//check whether the email is requested for update by other person or not
            $checkReqst = $this->model->where('new_requested_email', '=', $request->email)->first();
            if ($checkReqst) {
                return response()->json(['status' => false, 'message' => 'Email already has been used. Please provide another.']);
                die;
            }

            $data = new \App\models\User;
            $name = Input::get('fname') . ' ' . Input::get('lname');
            $data->fname = Input::get('fname');
            $data->lname = Input::get('lname');
            $data->seller_type = Input::get('seller_type');
            $data->name = $name;
            $data->status = 0;
            $data->email = $email = Input::get('email');
            $data->password = Hash::make(Input::get('password'));
            $data->verification_code = $verification_code = str_random(30);
            $user = array(
                "name" => Input::get('fname') . ' ' . Input::get('lname'),
                "verification_code" => $verification_code
            );

            $result = Mail::send('emails.registeration', array('user' => $user), function($message) use ($email) {
                        $message->from('avinesh.mathur@planetwebsolution.com');
                        $message->to($email)->subject("Registration");
                    }, true);

            if ($data->save()) {
                return response()->json(['status' => true, 'message' => 'Thanks, Your account has been created successfully. A mail also has been sent to your email for activate your account. Please check.']);
                die;
            } else {
                return response()->json(['status' => false, 'message' => 'Oops! Please try again.']);
                die;
            }
        }
    }

    /**
     * apiregistration
     * apiregistration
     *
     * @return response
     * @access public
     */
    public function apiregistration(Request $request) {

        $userClassifiedObj = new Classified;
        $current_date = date('Y-m-d');

        if ($request->isMethod('post')) {


            if (empty($request->email)) {
                $blankvalue = array(
                    '' => '',
                );
                $result['status'] = 0;
                $result['msg'] = 'Email is Required';
                $result['data'] = $blankvalue;

                echo json_encode($result);
                die;
            }


            $data = new \App\models\User;
            $login_type = Input::get('login_type');
            $social_id = Input::get('social_id');
            $email = Input::get('email');
            $name = Input::get('fname') . ' ' . Input::get('lname');

            $checkReqstlogin_type = $this->model->where('login_type', '=', $login_type)->where('email', '=', $email)->first();
            if (!empty($checkReqstlogin_type) && !empty($login_type)) {
                $updated_data = array(
                    'name' => Input::get('name'),
                    'email' => Input::get('email'),
                    'social_id' => Input::get('social_id'),
                    'avatar' => Input::get('avatar'),
                    'login_type' => Input::get('login_type'),
                    'status' => 1,
                    'device_id' => Input::get('device_id'),
                    'device_model' => Input::get('device_model'),
                    'device_type' => Input::get('device_type'),
                    'os_version' => Input::get('os_version'),
                    'network_provider' => Input::get('network_provider'),
                    'app_version_no' => Input::get('app_version_no'),
                    'image' => '',
                );
                \DB::table('users')->where('login_type', '=', $login_type)->where('email', '=', $email)->update($updated_data);

                $useraddcount = $userClassifiedObj
                                ->selectRaw('id as classifiedid')
                                ->where('user_id', '=', $checkReqstlogin_type->id)
                                ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                                ->get()->count();
                if (empty($checkReqstlogin_type->latitude) || empty($checkReqstlogin_type->longitude)) {
                    $lat = '0.0';
                    $lng = '0.0';
                } else {
                    $lat = $checkReqstlogin_type->longitude;
                    $lng = $checkReqstlogin_type->latitude;
                }
                if ($checkReqstlogin_type->city) {
                    $location = $checkReqstlogin_type->city;
                } else {
                    $location = 'N/A';
                }
                $rowvalue = array(
                    'name' => Input::get('name'),
                    'email' => Input::get('email'),
                    'id' => $checkReqstlogin_type->id,
                    'lat' => $lat,
                    'lng' => $lng,
                    'state' => $checkReqstlogin_type->state,
                    'city' => $checkReqstlogin_type->city,
                    'pincode' => $checkReqstlogin_type->pincode,
                    'phonecode' => $checkReqstlogin_type->phonecode,
                    'login_type' => Input::get('login_type'),
                    'mobile_no' => $checkReqstlogin_type->mobile_no,
                    'location' => $location,
                    'image' => Input::get('avatar'),
                    'device_id' => Input::get('device_id'),
                    'device_model' => Input::get('device_model'),
                    'device_type' => Input::get('device_type'),
                    'os_version' => Input::get('os_version'),
                    'network_provider' => Input::get('network_provider'),
                    'app_version_no' => Input::get('app_version_no'),
                    'created_date' => date("d-m-Y", strtotime($checkReqstlogin_type->created_at)),
                    'classifiedcount' => $useraddcount,
                );
                $result['status'] = 1;
                $result['msg'] = 'login_successfully';
                $result['data'] = $rowvalue;
                echo json_encode($result);
                die;
            } else {

                $checkReqst = $this->model->where('email', '=', $request->email)->first();
                if (!empty($checkReqst)) {
                    $logintypecheckReqst = $checkReqst->login_type;
                }

                if (!empty($checkReqst) && !empty($logintypecheckReqst)) {

                    $updated_data = array(
                        'name' => Input::get('name'),
                        'email' => Input::get('email'),
                        'social_id' => Input::get('social_id'),
                        'avatar' => Input::get('avatar'),
                        'login_type' => Input::get('login_type'),
                        'status' => 1,
                        'device_id' => Input::get('device_id'),
                        'device_model' => Input::get('device_model'),
                        'device_type' => Input::get('device_type'),
                        'os_version' => Input::get('os_version'),
                        'network_provider' => Input::get('network_provider'),
                        'app_version_no' => Input::get('app_version_no'),
                        'image' => '',
                    );
                    \DB::table('users')->where('email', '=', $email)->update($updated_data);

                    $useraddcount = $userClassifiedObj
                                    ->selectRaw('id as classifiedid')
                                    ->where('user_id', '=', $checkReqst->id)
                                    ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                                    ->get()->count();
                    if ($checkReqst->city) {
                        $location = $checkReqst->city;
                    } else {
                        $location = 'N/A';
                    }
                    if (empty($checkReqst->latitude) || empty($checkReqst->longitude)) {
                        $lat = '0.0';
                        $lng = '0.0';
                    } else {
                        $lat = $checkReqst->longitude;
                        $lng = $checkReqst->latitude;
                    }
                    $rowvalue = array(
                        'name' => Input::get('name'),
                        'email' => Input::get('email'),
                        'id' => $checkReqst->id,
                        'lat' => $lat,
                        'lng' => $lng,
                        'state' => $checkReqst->state,
                        'city' => $checkReqst->city,
                        'pincode' => $checkReqst->pincode,
                        'phonecode' => $checkReqst->phonecode,
                        'login_type' => Input::get('login_type'),
                        'mobile_no' => $checkReqst->mobile_no,
                        'location' => $location,
                        'image' => Input::get('avatar'),
                        'device_id' => Input::get('device_id'),
                        'device_model' => Input::get('device_model'),
                        'device_type' => Input::get('device_type'),
                        'os_version' => Input::get('os_version'),
                        'network_provider' => Input::get('network_provider'),
                        'app_version_no' => Input::get('app_version_no'),
                        'created_date' => date("d-m-Y", strtotime($checkReqst->created_at)),
                        'classifiedcount' => $useraddcount,
                    );
                    $result['status'] = 1;
                    $result['msg'] = 'login_successfully';
                    $result['data'] = $rowvalue;
                    echo json_encode($result);
                    die;
                }

                if (!empty($checkReqst) && !empty($login_type)) {

                    $device_id = Input::get('device_id');
                    $device_model = Input::get('device_model');
                    $device_type = Input::get('device_type');
                    $os_version = Input::get('os_version');
                    $network_provider = Input::get('network_provider');
                    $app_version_no = Input::get('app_version_no');

//
                    if ($checkReqst->image) {
                        $imgurl = URL::asset('upload_images/users/' . $checkReqst->id . '/' . $checkReqst->image);
                    } elseif ($checkReqst->avatar) {
                        $imgurl = $checkReqst->avatar;
                    } else {
                        $imgurl = URL::asset('plugins/front/img/profile-img-new.jpg');
                    }
                    if ($checkReqst->city) {
                        $location = $checkReqst->city;
                    } else {
                        $location = 'N/A';
                    }
                    if (empty($checkReqst->latitude) || empty($checkReqst->longitude)) {
                        $lat = '0.0';
                        $lng = '0.0';
                    } else {
                        $lat = $checkReqst->longitude;
                        $lng = $checkReqst->latitude;
                    }
                    $useraddcount = $userClassifiedObj
                                    ->selectRaw('id as classifiedid')
                                    ->where('user_id', '=', $checkReqst->id)
                                    ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                                    ->get()->count();
                    $rowvalue = array(
                        'id' => $checkReqst->id,
                        'name' => $checkReqst->name,
                        'email' => $checkReqst->email,
                        'image' => $imgurl,
                        'login_type' => $checkReqst->login_type,
                        'mobile_no' => $checkReqst->mobile_no,
                        'location' => $location,
                        'lat' => $lat,
                        'lng' => $lng,
                        'state' => $checkReqst->state,
                        'city' => $checkReqst->city,
                        'pincode' => $checkReqst->pincode,
                        'phonecode' => $checkReqst->phonecode,
                        'device_id' => $device_id,
                        'device_model' => $device_model,
                        'device_type' => $device_type,
                        'os_version' => $os_version,
                        'network_provider' => $network_provider,
                        'app_version_no' => $app_version_no,
                        'classifiedcount' => $useraddcount,
                        'created_date' => date("d-m-Y", strtotime($checkReqst->created_at)),
                    );
                    $id = $checkReqst->id;
                    $updated_data = array(
                        'device_id' => $device_id,
                        'device_model' => $device_model,
                        'device_type' => $device_type,
                        'os_version' => $os_version,
                        'network_provider' => $network_provider,
                        'app_version_no' => $app_version_no,
                    );
                    \DB::table('users')->where("id", $id)->update($updated_data);
//
                    $result['status'] = 1;
                    $result['msg'] = 'login_successfully';
                    $result['data'] = $rowvalue;
                    echo json_encode($result);
                    die;
                }

                if (!empty($checkReqst)) {
                    $blankvalue = array(
                        '' => '',
                    );
                    $result['status'] = 0;
                    $result['msg'] = 'Email already has been used. Please provide another.';
                    $result['data'] = $blankvalue;

                    echo json_encode($result);
                    die;
                }


                if (!empty($social_id) && !empty($login_type)) {
                    $data->name = Input::get('name');
                    $data->email = Input::get('email');
                    $data->social_id = Input::get('social_id');
                    $data->avatar = Input::get('avatar');
                    $data->login_type = Input::get('login_type');
                    $data->status = 1;
                    $data->device_id = Input::get('device_id');
                    $data->device_model = Input::get('device_model');
                    $data->device_type = Input::get('device_type');
                    $data->os_version = Input::get('os_version');
                    $data->network_provider = Input::get('network_provider');
                    $data->app_version_no = Input::get('app_version_no');
                    $data->image = '';
                    if ($data->save()) {
                        $rowvalue = array(
                            'name' => Input::get('name'),
                            'id' => $data->id,
                            'email' => Input::get('email'),
                            'login_type' => Input::get('login_type'),
                            'image' => Input::get('avatar'),
                            'device_id' => Input::get('device_id'),
                            'device_model' => Input::get('device_model'),
                            'device_type' => Input::get('device_type'),
                            'os_version' => Input::get('os_version'),
                            'network_provider' => Input::get('network_provider'),
                            'app_version_no' => Input::get('app_version_no'),
                            'created_date' => date("d-m-Y", strtotime($data->created_at)),
                        );
                        $result['status'] = 1;
                        $result['msg'] = 'Thanks, Your account has been created successfully.';
                        $result['data'] = $rowvalue;

                        echo json_encode($result);
                        die;
                    } else {
                        $blankvalue = array(
                            '' => '',
                        );
                        $result['status'] = 0;
                        $result['msg'] = 'Oops! Please try again.';
                        $result['data'] = $blankvalue;

                        echo json_encode($result);
                        die;
                    }
                } else {
                    $name = Input::get('fname') . ' ' . Input::get('lname');
                    $data->fname = Input::get('fname');
                    $data->lname = Input::get('lname');
                    $data->name = $name;
                    $data->status = 0;
                    $data->email = $email = Input::get('email');
                    $data->password = Hash::make(Input::get('password'));
                    $data->verification_code = $verification_code = str_random(30);
                    $data->device_id = Input::get('device_id');
                    $data->device_model = Input::get('device_model');
                    $data->device_type = Input::get('device_type');
                    $data->os_version = Input::get('os_version');
                    $data->network_provider = Input::get('network_provider');
                    $data->app_version_no = Input::get('app_version_no');

                    $user = array(
                        "name" => Input::get('fname') . ' ' . Input::get('lname'),
                        "verification_code" => $verification_code
                    );

                    $result = Mail::send('emails.registeration', array('user' => $user), function($message) use ($email) {
                                $message->from('avinesh.mathur@planetwebsolution.com');
                                $message->to($email)->subject("Registration");
                            }, true);
                    if ($data->save()) {
                        $name = Input::get('fname') . ' ' . Input::get('lname');
                        $rowvalue = array(
                            'name' => $name,
                            'email' => Input::get('email'),
                            'fname' => Input::get('fname'),
                            'lname' => Input::get('lname'),
                            'device_id' => Input::get('device_id'),
                            'device_model' => Input::get('device_model'),
                            'device_type' => Input::get('device_type'),
                            'os_version' => Input::get('os_version'),
                            'network_provider' => Input::get('network_provider'),
                            'app_version_no' => Input::get('app_version_no'),
                        );
                        $result['status'] = 2;
                        $result['msg'] = 'Thanks, Your account has been created successfully. A mail also has been sent to your email for activate your account. Please check.';
                        $result['data'] = $rowvalue;

                        echo json_encode($result);
                        die;
                    } else {
                        $blankvalue = array(
                            '' => '',
                        );
                        $result['status'] = 0;
                        $result['msg'] = 'Oops! Please try again.';
                        $result['data'] = $blankvalue;

                        echo json_encode($result);
                        die;
                    }
                }
            }
        }
    }

    /**
     * activate
     * activate the user acount after click on the verification link
     *
     * @param string $confirmation_code Name of method to call.
     * @return void by called method
     */
    public function activate($confirmation_code) {
// dd("here");
        if (!$confirmation_code) {
            throw new InvalidConfirmationCodeException;
        }

        $userData = \DB::table('users')
                ->where('verification_code', $confirmation_code)
                ->first();

        $data = \DB::table('users')
                ->where('verification_code', $confirmation_code)
                ->update(['status' => 1, 'verification_code' => null]);
        if ($userData->seller_type == 'business') {

            if (Auth::loginUsingId($userData->id)) {

                $updated_data = array(
                    'device_id' => '',
                    'device_model' => '',
                    'device_type' => '',
                    'os_version' => '',
                    'network_provider' => '',
                    'app_version_no' => '',
                );
                \DB::table('users')->where("id", $userData->id)->update($updated_data);
                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Thanks, Your account has been activated successfully. Now, you can log in to your account.');
                return \Redirect('/membership_plans')->withMessage('Thanks, Your account has been activated and logIn successfully. Now please select the plan and continue.')->withType('success');
            }
        } else {

            if ($data == 1) {
                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Thanks, Your account has been activated successfully. Now, you can log in to your account.');
                return \Redirect('/')->withMessage('Thanks, Your account has been activated successfully. Now, you can log in to your account.')->withType('success');
            }
        }
        return \Redirect('/');
    }

    /**
     * forgotpassword
     * forgotpassword
     *
     * @return response
     * @access public
     */
    public function forgotpassword(Request $request) {

        if ($request->isMethod('post')) {
            $rules = [
                'email' => 'required|email'
            ];
            $messages = [
                'email.required' => 'Please enter your email.',
                'email.email' => 'Please enter a valid email.'
            ];

            $validator = \Validator::make($request->all(), $rules, $messages);
            $this->validate($request, $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'errors' => $validator]);
                die;
            }

            $email = $request->email;
            $_token = $request->_token;

            $nerd = User::where('email', '=', $email)->first();

            if (!empty($nerd)) {

                $users = array(
                    'name' => $nerd->name,
                    'email' => $nerd->email,
                    '_token' => $_token,
                );

                $nerd->_token = $_token;

                $nerd->save();

                Mail::send('emails.userForgotPassword', array('users' => $users), function( $message ) use ($users) {
                    $message->from('avinesh.mathur@planetwebsolution.com');

                    $message->to($users['email'])->subject("Reset Password Link");
                });

                return response()->json(['status' => true, 'message' => 'Reset password link has been sent to your email. Please check.']);
                die;
            } else {
                return response()->json(['status' => false, 'message' => 'Email address does not exist in our database. Please check your email.']);
                die;
            }
        }
    }

    /**
     * apiforgotpassword
     * apiforgotpassword
     *
     * @return response
     * @access public
     */
    public function apiforgotpassword(Request $request) {
        if ($request->isMethod('post')) {
            $email = $request->email;
            $blankvalue = array(
                '' => '',
            );
            if (empty($email)) {
                $result['status'] = 0;
                $result['msg'] = 'Email Feild is Required.';
                $result['data'] = $blankvalue;

                echo json_encode($result);
                die;
            }

            $email = $request->email;
            $_token = str_random(60);


            $nerd = User::where('email', '=', $email)->first();

            if (!empty($nerd)) {
                $status = $nerd->status;
                if ($status == 0) {
                    $result['status'] = 0;
                    $result['msg'] = 'Your Account is Not Activated Yet.';
                    $result['data'] = $blankvalue;

                    echo json_encode($result);
                    die;
                }
                $users = array(
                    'name' => $nerd->name,
                    'email' => $nerd->email,
                    '_token' => $_token,
                );

                $nerd->_token = $_token;

                $nerd->save();

                Mail::send('emails.userForgotPassword', array('users' => $users), function( $message ) use ($users) {
                    $message->from('avinesh.mathur@planetwebsolution.com');

                    $message->to($users['email'])->subject("Reset Password Link");
                });
                $result['status'] = 1;
                $result['msg'] = 'Reset password link has been sent to your email. Please check.';
                $result['data'] = $blankvalue;

                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Email address does not exist in our database. Please check your email.';
                $result['data'] = $blankvalue;

                echo json_encode($result);
                die;
            }
        }
    }

    /**
     * confirmResetCode
     * confirmResetCode
     *
     * @return response
     * @access public
     */
    public function confirmResetCode($_token) {

        if (!$_token) {
            throw new InvalidConfirmationCodeException;
        }

        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);
        return view('front/users/forgot_password')->with('usetoken', $_token)->with('allSubCategories', $allSubCategories)->with('allSubCategoriesForMenu', $allSubCategoriesForMenu);
    }

    /**
     * Handles reset password url link,
     * reset the user password when user comes thorugh the password reset link
     *
     * @param array $request Name of method to call.
     * @return json response by called method
     */
    public function reset_password(Request $request) {
        if ($request->isMethod('post')) {
            $rules = [
                'password' => 'required|between:6,20',
                'password_confirmation' => 'required|same:password'
            ];
            $messages = [
                'password.required' => 'The password must be between 6 and 20 characters.',
                'password_confirmation.required' => 'Re-type your password.',
                'password_confirmation.same' => 'Password does not match.'
            ];

            $validator = \Validator::make($request->all(), $rules, $messages);
            $this->validate($request, $rules, $messages);
            if ($validator->fails()) {
                return \Redirect::back()->withInput(Input::all())->withDanger();
            }

            $_token = $request->token;
//dd($_token);
            $password = $request->password;
            $hashedPassword = Hash::make($password);
            $nerd = User::where('_token', '=', $_token)->first();
            if (!empty($nerd) && !empty($_token)) {

                $nerd->_token = '';
                $nerd->password = $hashedPassword;
                $nerd->save();
                return \Redirect('/')->withSuccess('Your password has been updated successfully. Now you can login with your new password.')->with('usetoken', '');
            } else {
                return \Redirect::back()->withDanger('Your token has been expired.');
            }
        }

        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);

        return view('front/' . $this->viewName . '/forgot_password', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'allSubCategories'));
    }

    /**
     * user_classified1
     * user_classified1
     *
     * @return response
     * @access public
     */
    public function user_classified1(Request $request) {

        $logged_in_user_id = Auth::guard('web')->user()->id;
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        $s_date = date("Y-m-d");
        $userClassifiedObj = new Classified;

        $wishlistItems = array();
        if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
            $wishlistObj = new Wishlist;
            $wishlistItems = $wishlistObj->where('user_id', '=', Auth::guard('web')->user()->id)->pluck("classified_id", "id")->all();
        } elseif (Cookie::get('wishlistItems')) {
            $wishlistItems = Cookie::get('wishlistItems');
        }

        $cond_for_active_classf = '';
        if ($request->isMethod('post')) {

            $requestData = $request->all();
            $tab_val = $request->tab;
            $conditions = array(
                array('user_id', '=', $logged_in_user_id)
            );
            foreach ($requestData as $key => $value) {
                if (!in_array($key, ['_token', 'tab', 'page', 'title'])) {
                    $conditions[] = array($key, '=', $value);
                }
                if ($key == "title") {
                    $conditions[] = array($key, 'LIKE', "%{$value}%");
                }
                if ($value == "expired") {
                    $conditions = array(array('end_date', '<', $s_date), array('user_id', '=', $logged_in_user_id));
                }
            }

            $data = $userClassifiedObj->with(["classified_image" => function ($classified_image) {
                            
                        }])->with(["Subcategoriesname" => function($classified_subCategory) {
                            $classified_subCategory->select('id', 'name');
                        }])->with(["categoriesname" => function($classified_category) {
                            $classified_category->select("id", "name");
                        }])->where($conditions);

            if ($request->tab == "active") {
//$data = $data->whereRaw(" '$s_date' Between classifieds.start_date  and classifieds.end_date ");
            }



            $data = $data->where("parent_categoryid", "!=", 8)->orderBy('id', 'desc')->paginate(10);
            $data->setPath('?tab=' . $tab_val)->appends(Input::query())->render();

            return view('front/users/user_classified_ui', compact('data', 'wishlistItems'));
            die;
        }
        $total_user_active_classifieds = $userClassifiedObj->where('user_id', '=', $logged_in_user_id)->where('status', '=', 1)->orderBy('id', 'desc')->count();
        $total_user_inactive_classifieds = $userClassifiedObj->where('user_id', '=', $logged_in_user_id)->where('status', '=', 0)->count();
        $total_user_expired_classifieds = $userClassifiedObj->where('user_id', '=', $logged_in_user_id)->where('end_date', '<', $s_date)->count();
        $total_user_unapproved_classifieds = $userClassifiedObj->where('user_id', '=', $logged_in_user_id)->where('status', '=', 2)->count();
        $total_user_rejected_classifieds = $userClassifiedObj->where('user_id', '=', $logged_in_user_id)->where('status', '=', 3)->count();

//count total number of views of his/her all classifieds
        $user_total_classifieds = $userClassifiedObj->where('user_id', '=', Auth::guard('web')->user()->id)->count();
        $total_viewer = $userClassifiedObj->selectRaw("sum(count) as total_views")->where('user_id', '=', $logged_in_user_id)->first();
        $user_details = $this->model->where('id', '=', $logged_in_user_id)->get();

        return view('front/users/classified', compact('allSubCategories', 'allComCategories', 'allSubCategoriesForMenu', 'user_active_classifieds', 'total_user_active_classifieds', 'total_user_inactive_classifieds', 'total_user_expired_classifieds', 'total_user_unapproved_classifieds', 'total_user_rejected_classifieds', 'total_viewer', 'user_total_classifieds', 'wishlistItems', 'user_details'));
    }

    /**
     * user_classified
     * user_classified
     *
     * @return response
     * @access public
     */
    public function user_classified(Request $request) {
        $logged_in_user_id = Auth::guard('web')->user()->id;
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        $s_date = date("Y-m-d");
        $userClassifiedObj = new Classified;
        $wishlistItems = array();
        if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
            $wishlistObj = new Wishlist;
            $wishlistItems = $wishlistObj->where('user_id', '=', Auth::guard('web')->user()->id)->pluck("classified_id", "id")->all();
        } elseif (Cookie::get('wishlistItems')) {
            $wishlistItems = Cookie::get('wishlistItems');
        }
        $user_details = $this->model->where('id', '=', $logged_in_user_id)->first();

        $cond_for_active_classf = '';
        if ($request->isMethod('post')) {

            $requestData = $request->all();
            $tab_val = $request->tab;
            $conditions = array(
                array('user_id', '=', $logged_in_user_id)
            );
            foreach ($requestData as $key => $value) {
                if (!in_array($key, ['_token', 'tab', 'page', 'title'])) {
                    $conditions[] = array($key, '=', $value);
                }
                if ($key == "title") {
                    $conditions[] = array($key, 'LIKE', "%{$value}%");
                }
                if ($value == "expired") {
                    $conditions = array(array('end_date', '<', $s_date), array('user_id', '=', $logged_in_user_id));
                }
            }
            $data = $userClassifiedObj->with(["classified_image" => function ($classified_image) {
                            
                        }])->with(["Subcategoriesname" => function($classified_subCategory) {
                            $classified_subCategory->select('id', 'name');
                        }])->with(["categoriesname" => function($classified_category) {
                            $classified_category->select("id", "name");
                        }])->where($conditions);

            if ($request->tab == "active") {
                //$data = $data->whereRaw(" '$s_date' Between classifieds.start_date  and classifieds.end_date ");
            }
            $data = $data->orderBy('id', 'desc')->paginate(10);
            $data->setPath('?tab=' . $tab_val)->appends(Input::query())->render();



            $user_type = Auth::guard('web')->user()->seller_type;
            if ($user_type == 'business') {
                return view('front/users/user_classified_ui', compact('data', 'wishlistItems'));
            } else {
                return view('front/users/private/user_classified_ui', compact('data', 'wishlistItems'));
            }

            die;
        }
        $total_user_active_classifieds = $userClassifiedObj->where('user_id', '=', $logged_in_user_id)->where('status', '=', 1)->orderBy('id', 'desc')->count();
        $total_user_inactive_classifieds = $userClassifiedObj->where('user_id', '=', $logged_in_user_id)->where('status', '=', 0)->count();
        $total_user_expired_classifieds = $userClassifiedObj->where('user_id', '=', $logged_in_user_id)->where('end_date', '<', $s_date)->count();
        $total_user_unapproved_classifieds = $userClassifiedObj->where('user_id', '=', $logged_in_user_id)->where('status', '=', 2)->count();
        $total_user_rejected_classifieds = $userClassifiedObj->where('user_id', '=', $logged_in_user_id)->where('status', '=', 3)->count();

        //count total number of views of his/her all classifieds
        $total_viewer = $userClassifiedObj->selectRaw("sum(count) as total_views")->where('user_id', '=', $logged_in_user_id)->first();
        $user_total_classifieds = $userClassifiedObj->where('user_id', '=', Auth::guard('web')->user()->id)->count();



        $user_type = Auth::guard('web')->user()->seller_type;
        if ($user_type == 'business') {
            return view('front/users/classified', compact('allSubCategories', 'allComCategories', 'allSubCategoriesForMenu', 'user_active_classifieds', 'total_user_active_classifieds', 'total_user_inactive_classifieds', 'total_user_expired_classifieds', 'total_user_unapproved_classifieds', 'total_user_rejected_classifieds', 'total_viewer', 'user_total_classifieds', 'wishlistItems', 'user_details'));
        } else {
            return view('front/users/private/classified', compact('allSubCategories', 'allComCategories', 'allSubCategoriesForMenu', 'user_active_classifieds', 'total_user_active_classifieds', 'total_user_inactive_classifieds', 'total_user_expired_classifieds', 'total_user_unapproved_classifieds', 'total_user_rejected_classifieds', 'total_viewer', 'user_total_classifieds', 'wishlistItems', 'user_details'));
        }
    }

    /**
     * addmanagmenttabapi
     * addmanagmenttabapi
     *
     * @return response
     * @access public
     */
    public function addmanagmenttabapi(Request $request) {
        $current_date = date('Y-m-d');
        $rooturl = \Request::root();
        $loginid = $request->user_id;

        $flag = $request->flag_status;
        $task = new Category;
        $s_date = date("Y-m-d");
        $userClassifiedObj = new Classified;
        if (!empty($flag) && !empty($loginid)) {
            if ($flag == 2) {
                $flagvalue = 0;
                $conditions = array(
                    array('classifieds.status', '=', $flagvalue)
                );
            } elseif ($flag == 4) {

                $flagvalue = 2;
                $conditions = array(
                    array('classifieds.status', '=', $flagvalue)
                );
            } elseif ($flag == 5) {
                $flagvalue = 3;
                $conditions = array(
                    array('classifieds.status', '=', $flagvalue)
                );
            }

            if ($flag == 3) {
                $conditions = array(array('classifieds.end_date', '<', $current_date));
            }
            if ($flag == 1) {
                $conditions = array(
                    array('classifieds.status', '=', 1)
                );

                $data = $userClassifiedObj
                        ->selectRaw('classifieds.id as classifiedid ,classifieds.title as title,classifieds.status,'
                                . 'classifieds.description as description,classifiedimage.name as name,classifieds.price,UNIX_TIMESTAMP(classifieds.created_at)as createdtime,'
                                . 'concat("' . $rooturl . '/upload_images/classified/",classifieds.id,"/",classifiedimage.name) imageurl,classifieds.city_id')
                        ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                        ->where('classifieds.user_id', '=', $loginid)
                        ->where($conditions)
                        ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                        ->groupBy('classifieds.id')
                        ->with(['city_data' => function ($q3) {
                                $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                            },])
                        ->get();
                foreach ($data as $key => $value) {
                    if (!empty($value->city_data->CityId)) {
                        $data[$key]['location'] = $value->city_data->City;
                    } else {
                        $data[$key]['location'] = 'N/A';
                        unset($value->city_data);
                    }
                }
                $result['status'] = 1;
                $result['data'] = $data;

                echo json_encode($result);
                die;
            } else {
                $data = $userClassifiedObj
                        ->selectRaw('classifieds.id as classifiedid ,classifieds.title as title,classifieds.status,'
                                . 'classifieds.description as description,classifiedimage.name as name,classifieds.price,UNIX_TIMESTAMP(classifieds.created_at)as createdtime,'
                                . 'concat("' . $rooturl . '/upload_images/classified/",classifieds.id,"/",classifiedimage.name) imageurl,classifieds.city_id')
                        ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                        ->where('classifieds.user_id', '=', $loginid)
                        ->where($conditions)
                        ->groupBy('classifieds.id')
                        ->with(['city_data' => function ($q3) {
                                $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                            },])
                        ->get();
                foreach ($data as $key => $value) {
                    if (!empty($value->city_data->CityId)) {
                        $data[$key]['location'] = $value->city_data->City;
                    } else {
                        $data[$key]['location'] = 'N/A';
                        unset($value->city_data);
                    }
                }

                $result['status'] = 1;
                $result['data'] = $data;

                echo json_encode($result);
                die;
            }
        } else {

            $result['status'] = 0;
            $result['msg'] = 'Invalid Details.';
            echo json_encode($result);
            die;
        }
    }

    /**
     * user_profile
     * user_profile
     *
     * @return void
     * @access public
     */
    public function user_profile(Request $request) {

        $logged_in_user_id = Auth::guard('web')->user()->id;
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        $userClassifiedObj = new Classified;
        $user_total_classifieds = $userClassifiedObj->where('user_id', '=', $logged_in_user_id)->count();
        $user_details = $this->model->where('id', '=', $logged_in_user_id)->first();

        if ($request->isMethod('post')) {
            $rules = $messages = [];

            if (isset($request->new_email)) {
                $addRules = [
                    'current_email' => 'required|email',
                    'new_email' => 'required|email',
                    'confirm_new_email' => 'required|email|same:new_email'
                ];
                $addMessages = [
                    'current_email.required' => 'This Field is required.',
                    'current_email.email' => 'Please enter a valid email.',
                    'new_email.required' => 'This Field is required.',
                    'new_email.email' => 'Please enter a valid email.',
                    'confirm_new_email.required' => 'This Field is required.',
                    'confirm_new_email.email' => 'Please enter the same.',
                    'confirm_new_email.same' => 'Please enter the same.',
                ];
                $rules = array_merge($rules, $addRules);
                $messages = array_merge($messages, $addMessages);
            }

            if (isset($request->new_password)) {
                $addRules = [
                    'current_password' => 'required',
                    'new_password' => 'required|min:6',
                    'confirm_new_password' => 'required|same:new_password'
                ];
                $addMessages = [
                    'current_password.required' => 'This Field is required.',
                    'current_password.email' => 'Invalid email.',
                    'new_password.required' => 'This Field is required.',
                    'new_password.min' => 'Please enter at least 6 characters.',
                    'confirm_new_password.required' => 'This Field is required.',
                    'confirm_new_password.same' => 'Please enter the same.',
                ];
                $rules = array_merge($rules, $addRules);
                $messages = array_merge($messages, $addMessages);
            }

            if (isset($request->image)) {
                $addRules = [
                    'image' => 'mimes:jpeg,jpg,png',
                ];
                $addMessages = [];
                $rules = array_merge($rules, $addRules);
                $messages = array_merge($messages, $addMessages);
            }

            if (isset($request->location)) {
                $addRules = [
                    'location' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'country' => 'required',
                    'pincode' => 'required'
                ];
                $addMessages = [
                    'location.required' => 'This Field is required.',
                    'city.required' => 'This Field is required.',
                    'state.required' => 'This Field is required.',
                    'country.required' => 'This Field is required.',
                    'pincode.required' => 'This Field is required.',
                ];
                $rules = array_merge($rules, $addRules);
                $messages = array_merge($messages, $addMessages);
            }

            if (isset($request->fname)) {
                $addRules = [
                    'fname' => 'required',
                    'lname' => 'required'
                ];
                $addMessages = [
                    'fname.required' => 'This Field is required.',
                    'lname.required' => 'This Field is required.',
                ];
                $rules = array_merge($rules, $addRules);
                $messages = array_merge($messages, $addMessages);
            }

            $validator = \Validator::make($request->all(), $rules, $messages);
            $this->validate($request, $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'errors' => $validator]);
                die;
            }

            if (isset($request->new_email)) {
                if ($request->current_email != $user_details['email']) {
                    return response()->json(['status' => false, 'message' => 'Please check your current registered email.']);
                    die;
                } else {
                    $checkAlreadyExist = $this->model->where("email", "=", $request->new_email)->orWhere('new_requested_email', '=', $request->new_email)->first();
                    if (count($checkAlreadyExist) == 0) {
                        $emailVerCode = str_random(30);
                        $updateStatus = $this->model->where("id", $logged_in_user_id)->update(array('new_requested_email' => $request->new_email, 'new_requested_email_status' => 1, 'email_updation_verification_code' => $emailVerCode));
                        if ($updateStatus) {
                            $result = Mail::send('emails.update_email', array('user' => $user_details, 'emailVerCode' => $emailVerCode), function($message) use ($user_details) {
                                        $message->to($user_details['email'])->subject("Email updation request");
                                    }, true);

                            return response()->json(['status' => true, 'message' => 'We have sent an activation email to your current email. Please check.', 'new_email' => $request->new_email]);
                        } else {
                            return response()->json(['status' => false, 'message' => 'Email could not be updated. Please try again.']);
                        }
                    } else {
                        return response()->json(['status' => false, 'message' => 'Your new requested email already has been used. Please provide another.']);
                    }
                }
            }

            if (isset($request->new_password)) {
                if (!Hash::check($request->current_password, $user_details['password'])) {
                    return response()->json(['status' => false, 'message' => 'Your current password is wrong. Please check.']);
                    die;
                } else {
                    $request->new_password = Hash::make($request->new_password);
                    $updateStatus = $this->model->where("id", $logged_in_user_id)->update(array('password' => $request->new_password));
                    if ($updateStatus) {
                        return response()->json(['status' => true, 'message' => 'Password has been updated successfully.']);
                    } else {
                        return response()->json(['status' => false, 'message' => 'Password could not be updated. Please try again.']);
                    }
                }
            }

            if (isset($request->image)) {
                if (Input::file('image')) {
                    $image = Input::file('image');

                    if (!is_dir('upload_images/users/' . $logged_in_user_id)) {
                        File::makeDirectory('upload_images/users/' . $logged_in_user_id, 0777, true);
                    }
                    if (!is_dir('upload_images/users/30x30/' . $logged_in_user_id)) {
                        File::makeDirectory('upload_images/users/30x30/' . $logged_in_user_id, 0777, true);
                    }

                    $extension = $image->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;

                    $destinationPath = 'upload_images/users/' . $logged_in_user_id . '/';
                    $destinationPaththumb = 'upload_images/users/30x30/' . $logged_in_user_id . '/';


                    $image->move($destinationPath, $fileName);
                    image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                    $updated_data["image"] = $fileName;
                }

                $updateStatus = $this->model->where("id", $logged_in_user_id)->update($updated_data);
                return Redirect::back();
            }

            if (isset($request->location)) {
                $updateStatus = $this->model
                        ->where("id", $logged_in_user_id)
                        ->update(array(
                    'location' => $request->location,
                    'state' => $request->state,
                    'city' => $request->city,
                    'country' => $request->country,
                    'pincode' => $request->pincode,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude
                ));
                if ($updateStatus) {
                    return response()->json(['status' => true, 'message' => 'Address has been updated successfully.', 'new_name' => $request->name]);
                } else {
                    return response()->json(['status' => false, 'message' => 'Address could not be updated. Please try again.']);
                }
            }

            if (isset($request->fname)) {

                $updateStatus = $this->model
                        ->where("id", $logged_in_user_id)
                        ->update(array(
                    'fname' => $request->fname,
                    'lname' => $request->lname
                ));
                if ($updateStatus) {
                    return response()->json(['status' => true, 'message' => 'Name has been updated successfully.', 'fname' => $request->fname, 'lname' => $request->lname]);
                } else {
                    return response()->json(['status' => false, 'message' => 'Name could not be updated. Please try again.']);
                }
            }
        }

        $userMessageObj = new Message;
        $total_messages = $userMessageObj->where('receiver_id', '=', $logged_in_user_id)->where(function($q) use($logged_in_user_id) {
                    $q->where(['deleted_at' => 1])->OrwhereRaw("NOT FIND_IN_SET($logged_in_user_id,deleted_by)");
                })->count();

//count total number of views of his/her all classifieds
        $total_viewer = $userClassifiedObj->selectRaw("sum(count) as total_views")->where('user_id', '=', $logged_in_user_id)->first();


        $user_type = Auth::guard('web')->user()->seller_type;
        if ($user_type == 'business') {

            $membership = DB::table('membership_plan_users')->select('paypal_profile_id')->where(['user_id' => $logged_in_user_id])->orderBy('id', 'desc')->first();
            $pp_profileid = $membership->paypal_profile_id;
            if ($pp_profileid != '') {
                $provider = new ExpressCheckout;
                $pp_profile_response = $provider->getRecurringPaymentsProfileDetails($pp_profileid);
            } else {
                $pp_profile_response = '';
            }

            return view('front/users/profile', compact('allSubCategories', 'allComCategories', 'allSubCategoriesForMenu', 'user_total_classifieds', 'user_details', 'total_messages', 'total_viewer', 'pp_profile_response'));
        } else {
            return view('front/users/private/profile', compact('allSubCategories', 'allComCategories', 'allSubCategoriesForMenu', 'user_total_classifieds', 'user_details', 'total_messages', 'total_viewer'));
        }
    }

    /**
     * cancel_pp_profile
     * cancel PayPAl Profile
     *
     * @return void
     * @access public
     */
    public function cancel_pp_profile(Request $request) {
        $logged_in_user_id = Auth::guard('web')->user()->id;

        if (isset($request->cancel_pp)) {
            $profileid = $request->profileid;

            $provider = new ExpressCheckout;
            $pp_profile_response = $provider->cancelRecurringPaymentsProfile($profileid);


            if ($pp_profile_response['ACK'] == 'Success') {
                $values = array('paypal_profile_status' => 'Cancelled');
                DB::table('membership_plan_users')->where(['user_id' => $logged_in_user_id])->update($values);

                Session::flash('type', 'success');
                Session::flash('message', 'You membership profile has Successfully Updated.');

                return redirect('/user/profile');
            } else {


                Session::flash('alert-class', 'alert-warning');
                Session::flash('message', 'Something wrong, please try again.');

                return redirect('/user/profile');
            }
        }
    }

    public function update_pp_email(Request $request) {
        $logged_in_user_id = Auth::guard('web')->user()->id;

        $this->validate($request, [
            'paypal_email' => 'required|between:3,64|email',
        ]);
        $paypal_email = $request->paypal_email;

        if (isset($request->pp_email_submit)) {

            $updated_data = array(
                "paypal_email" => $paypal_email,
            );
            $updateStatus = $this->model->where("id", $logged_in_user_id)->update($updated_data);

            if ($updateStatus) {
                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'PayPal Email has been updated successfully.');
                return redirect('/user/profile');
            } else {
                return redirect('/user/profile');
            }
        }
    }

    /**
     * update_mobile
     * update_mobile
     *
     * @return void
     * @access public
     */
    public function update_mobile($mobile, $countrycode) {
        $logged_in_user_id = Auth::guard('web')->user()->id;
        $updated_data = array(
            "mobile_no" => $mobile,
            "phonecode" => $countrycode
        );
        $updateStatus = $this->model->where("id", $logged_in_user_id)->update($updated_data);

        if ($updateStatus) {

            return 1;
        } else {
            return 0;
        }
    }

    /**
     * update_uniquemobile
     * update_uniquemobile
     *
     * @return void
     * @access public
     */
    public function update_uniquemobile(Request $request) {
        $logged_in_user_id = $request->user_id;
        $mobile_no = $request->mobile_no;
        $updated_data = array(
            "mobile_no" => $request->mobile_no,
        );
        $updateStatus = $this->model->where('mobile_no', '=', $mobile_no)->count();

        if ($updateStatus) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * enterotp
     * enterotp
     *
     * @return void
     * @access public
     */
    public function enterotp(Request $request) {
//$url = 'http://api.ringcaptcha.com/2uja9e7e1yfefe8e7ymu/code/' . $request->type;
        $url = 'https://api.ringcaptcha.com/jele5e5uhi9i5ipiryqi/code/' . $request->type;
        $fields = array(
            'phone' => urlencode($request->countrycode . $request->mobile),
            'api_key' => urlencode('4b0e05b17a0c5425bfab4f83ad79a80060a73ec7'),
        );

//url-ify the data for the POST
        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');

//open connection
        $ch = curl_init();

//set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

//execute post
        $result = curl_exec($ch);

//close connection
        curl_close($ch);

        echo $result;
        die;
    }

    /**
     * checkotp
     * checkotp
     *
     * @return void
     * @access public
     */
    public function checkotp(Request $request) {
        $mobile = $request->mobile;
        $countrycode = $request->countrycode;
        $password = $request->mobileotp;

//$url = 'http://api.ringcaptcha.com/2uja9e7e1yfefe8e7ymu/verify';
        $url = 'https://api.ringcaptcha.com/jele5e5uhi9i5ipiryqi/verify';
        $fields = array(
            'phone' => urlencode($countrycode . $mobile),
            'code' => urlencode($password),
            'api_key' => urlencode('4b0e05b17a0c5425bfab4f83ad79a80060a73ec7'),
        );

//url-ify the data for the POST
        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');

//open connection
        $ch = curl_init();

//set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

//execute post
        $result = curl_exec($ch);

        $retData = json_decode($result, true);

        if (isset($this->request->data['setne']) && $retData['status'] == 'SUCCESS') {
            $this->Session->write('set_mobile', $mobile);
        }

//close connection
        curl_close($ch);
        if ($result) {
            $data = json_decode($result);

            if ($data->status == "SUCCESS") {
                $this->update_mobile($mobile, $countrycode);
                echo json_encode(array('status' => true));
                die();
            } else {
                echo json_encode(array('status' => false));
                die();
            }
        } else {
            echo json_encode(array('status' => false));
            die();
        }
    }

    /**
     * user_messages
     * user_messages
     *
     * @return void
     * @access public
     */
    public function user_messages() {
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);


        return view('front/users/messages', compact('allSubCategories', 'allComCategories', 'allSubCategoriesForMenu'));
    }

    /**
     * user_update_subscription
     * user_update_subscription
     *
     * @return void
     * @access public
     */
    public function user_update_subscription(Request $request) {
        if ($request->isMethod('post')) {

            $logged_in_user_id = Auth::guard('web')->user()->id;

            $updated_data["is_notification_active"] = (!isset($request->is_notification_active) && $request->is_notification_active != 1) ? 0 : 1;
            $updated_data["is_newsletter_active"] = (!isset($request->is_newsletter_active) && $request->is_newsletter_active != 1) ? 0 : 1;
            $updated_data["is_survey_active"] = (!isset($request->is_survey_active) && $request->is_survey_active != 1) ? 0 : 1;
            $updated_data["is_invites_active"] = (!isset($request->is_invites_active) && $request->is_invites_active != 1) ? 0 : 1;


            $updateStatus = $this->model->where("id", $logged_in_user_id)->update($updated_data);
            if ($updateStatus) {
                return response()->json(['status' => true, 'message' => 'Updated successfully.']);
            } else {
                return response()->json(['status' => false, 'message' => 'Could not be updated. Please try again.']);
            }
        }
    }

    /**
     * update_requested_email
     * update_requested_email
     *
     * @return void
     * @access public
     */
    public function update_requested_email($emailVerificationCode) {
        if (!$emailVerificationCode) {
            throw new InvalidConfirmationCodeException;
        }

        $userData = $this->model->where('email_updation_verification_code', '=', $emailVerificationCode)->first();

        if (!$userData) {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('message', 'Thanks, Your account has been activated successfully. Now, you can log in to your account.');
            return \Redirect('/')->withDanger('Your token has been expired.');
        } else {
            if ($userData->new_requested_email_status == 1 && !empty($userData->new_requested_email)) {
                $updated_data = array(
                    'email' => $userData->new_requested_email,
                    'email_updation_verification_code' => null,
                    'new_requested_email_status' => 0,
                    'new_requested_email' => null
                );
                $successMessage = "Your email has been updated successfully. Now you can login with your new email.";
                if (!empty($userData->social_id)) {
                    $updated_data['social_id'] = null;
                    $updated_data['login_type'] = null;
                    $successMessage = "Your email has been updated successfully. Please reset your password using forgot password.";
                }
                $data = $this->model
                        ->where('email_updation_verification_code', $emailVerificationCode)
                        ->update($updated_data);
                if ($data == 1) {
                    Session::flash('alert-class', 'alert-success');
                    Session::flash('message', 'Thanks, Your account has been activated successfully. Now, you can log into your account.');
                    Auth::guard('web')->logout();
                    return \Redirect('/')->withSuccess($successMessage);
                } else {
                    return \Redirect('/')->withDanger('Your email could not be updated. Please try again.');
                }
            } else {
                return \Redirect('/')->withDanger('Please make a request for change the email.');
            }
        }
    }

    /**
     * upd_vstr_cntr
     * upd_vstr_cntr
     *
     * @return void
     * @access public
     */
    public function upd_vstr_cntr() {
        $usrIpAddress = $_SERVER['REMOTE_ADDR'];
        if ($usrIpAddress) {
            $chkAlrdyExist = \DB::table('site_visitors')->where("ip_address", "=", $usrIpAddress)->first();
            if (!$chkAlrdyExist) {
                \DB::table('site_visitors')->insert(array('ip_address' => $usrIpAddress));
            }
        }
    }

    /**
     * ipaddr
     * ipaddr
     *
     * @return void
     * @access public
     */
    public function ipaddr() {
        dd($_SERVER);
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }
        dd($ipAddress);
    }

    /**
     * changepasswordapi
     * changepasswordapi
     *
     * @return response
     * @access public
     */
    public function changepasswordapi(Request $request) {
///
        if ($request->isMethod('post')) {
            $current_password = $request->current_password;
            $new_password = $request->new_password;
            $logged_in_user_id = $request->user_id;
            $user_details = $this->model->where('id', '=', $logged_in_user_id)->first();
            $blankvalue = array(
                '' => '',
            );
            if (empty($current_password)) {
                $result['status'] = 0;
                $result['msg'] = 'current_password Feild is Required.';
                $result['data'] = $blankvalue;

                echo json_encode($result);
                die;
            }
            if (empty($logged_in_user_id)) {
                $result['status'] = 0;
                $result['msg'] = 'User id is Required.';
                $result['data'] = $blankvalue;

                echo json_encode($result);
                die;
            }

            if (empty($new_password)) {
                $result['status'] = 0;
                $result['msg'] = 'new_password Feild is Required.';
                $result['data'] = $blankvalue;

                echo json_encode($result);
                die;
            }

            if (!empty($new_password)) {
                if (!Hash::check($current_password, $user_details['password'])) {
                    $result['status'] = 0;
                    $result['msg'] = 'Please check your current password.';
                    $result['data'] = $blankvalue;

                    echo json_encode($result);
                    die;
                } else {
                    $new_passwordenc = Hash::make($new_password);
                    $updateStatus = $this->model->where("id", $logged_in_user_id)->update(array('password' => $new_passwordenc));
                    $checkReqst = $this->model->where('id', '=', $logged_in_user_id)->first();
                    if ($checkReqst->image) {
                        $imgurl = URL::asset('upload_images/users/' . $checkReqst->id . '/' . $checkReqst->image);
                    } elseif ($checkReqst->avatar) {
                        $imgurl = $checkReqst->avatar;
                    } else {
                        $imgurl = URL::asset('plugins/front/img/profile-img-new.jpg');
                    }
                    if ($checkReqst->city) {
                        $location = $checkReqst->city;
                    } else {
                        $location = 'N/A';
                    }
                    if (empty($checkReqst->latitude) || empty($checkReqst->longitude)) {
                        $lat = '0.0';
                        $lng = '0.0';
                    } else {
                        $lat = $checkReqst->longitude;
                        $lng = $checkReqst->latitude;
                    }
                    if (!empty($checkReqst->mobile_no)) {
                        $mobileno = $checkReqst->mobile_no;
                    } else {
                        $mobileno = 'N/A';
                    }
                    $rowvalue = array(
                        'id' => $checkReqst->id,
                        'name' => $checkReqst->name,
                        'email' => $checkReqst->email,
                        'image' => $imgurl,
                        'mobile_no' => $mobileno,
                        'location' => $location,
                        'lat' => $lat,
                        'lng' => $lng,
                        'state' => $checkReqst->state,
                        'city' => $checkReqst->city,
                        'created_date' => date("d-m-Y", strtotime($checkReqst->created_at)),
                    );

                    if ($updateStatus) {
                        $result['status'] = 1;
                        $result['msg'] = 'Password has been updated successfully.';
                        $result['data'] = $rowvalue;
                        echo json_encode($result);
                        die;
                    } else {
                        $result['status'] = 0;
                        $result['msg'] = 'Password could not be updated. Please try again.';
                        $result['data'] = $blankvalue;

                        echo json_encode($result);
                        die;
                    }
                }
            }
        }
    }

    /**
     * changemobilenoapi
     * changemobilenoapi
     *
     * @return response
     * @access public
     */
    public function changemobilenoapi(Request $request) {
        if ($request->isMethod('post')) {

            $mobileno = $request->mobileno;
            $phonecode = $request->phonecode;
            $logged_in_user_id = $request->user_id;
            if (!empty($mobileno) && !empty($logged_in_user_id) && !empty($phonecode)) {
                $mobilenovalue = substr($mobileno, -10);
                $user_details = $this->model->where('mobile_no', '=', $mobilenovalue)->first();
                if (!empty($user_details)) {
                    $userid = $user_details['id'];
                    if ($logged_in_user_id == $userid) {
                        $updateStatus = $this->model->where("id", $logged_in_user_id)->update(array('mobile_no' => $mobilenovalue, 'phonecode' => $phonecode));
                        $result['status'] = 1;
                        $result['msg'] = 'Mobile no. has been updated successfully.';
                        echo json_encode($result);
                        die;
                    } else {
                        $result['status'] = 0;
                        $result['msg'] = 'Please check Mobile no. its already used';
                        $result['data'] = array();

                        echo json_encode($result);
                        die;
                    }
                } else {

                    $updateStatus = $this->model->where("id", $logged_in_user_id)->update(array('mobile_no' => $mobilenovalue, 'phonecode' => $phonecode));
                    $checkReqst = $this->model->where('id', '=', $logged_in_user_id)->first();
                    if ($checkReqst->image) {
                        $imgurl = URL::asset('upload_images/users/' . $checkReqst->id . '/' . $checkReqst->image);
                    } elseif ($checkReqst->avatar) {
                        $imgurl = $checkReqst->avatar;
                    } else {
                        $imgurl = URL::asset('plugins/front/img/profile-img-new.jpg');
                    }
                    if ($checkReqst->city) {
                        $location = $checkReqst->city;
                    } else {
                        $location = 'N/A';
                    }
                    if (empty($checkReqst->latitude) || empty($checkReqst->longitude)) {
                        $lat = '0.0';
                        $lng = '0.0';
                    } else {
                        $lat = $checkReqst->longitude;
                        $lng = $checkReqst->latitude;
                    }
                    if (!empty($checkReqst->mobile_no)) {
                        $mobilenov = $checkReqst->mobile_no;
                    } else {
                        $mobilenov = 'N/A';
                    }
                    $rowvalue = array(
                        'id' => $checkReqst->id,
                        'name' => $checkReqst->name,
                        'email' => $checkReqst->email,
                        'image' => $imgurl,
                        'mobile_no' => $mobilenov,
                        'location' => $location,
                        'lat' => $lat,
                        'lng' => $lng,
                        'state' => $checkReqst->state,
                        'city' => $checkReqst->city,
                        'created_date' => date("d-m-Y", strtotime($checkReqst->created_at)),
                    );
                    $result['status'] = 1;
                    $result['msg'] = 'Mobile no. has been updated successfully.';
                    $result['data'] = $rowvalue;
                    echo json_encode($result);
                    die;
                }
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Invalid Details.';
                $result['data'] = array();

                echo json_encode($result);
                die;
            }
        }
    }

    /**
     * changeemailapi
     * changeemailapi
     *
     * @return response
     * @access public
     */
    public function changeemailapi(Request $request) {

        if ($request->isMethod('post')) {
            $new_email = $request->email;
            $logged_in_user_id = $request->user_id;
            if (!empty($new_email) && !empty($logged_in_user_id)) {
                $user_details = $this->model->where('id', '=', $logged_in_user_id)->first();
                $checkAlreadyExist = $this->model->where("email", "=", $new_email)->orWhere('new_requested_email', '=', $new_email)->first();
                if (count($checkAlreadyExist) == 0) {
                    $emailVerCode = str_random(30);
                    $updateStatus = $this->model->where("id", $logged_in_user_id)->update(array('new_requested_email' => $new_email, 'new_requested_email_status' => 1, 'email_updation_verification_code' => $emailVerCode));
                    if ($updateStatus) {
                        $checkReqst = $this->model->where('id', '=', $logged_in_user_id)->first();
                        if ($checkReqst->image) {
                            $imgurl = URL::asset('upload_images/users/' . $checkReqst->id . '/' . $checkReqst->image);
                        } elseif ($checkReqst->avatar) {
                            $imgurl = $checkReqst->avatar;
                        } else {
                            $imgurl = URL::asset('plugins/front/img/profile-img-new.jpg');
                        }
                        if ($checkReqst->city) {
                            $location = $checkReqst->city;
                        } else {
                            $location = 'N/A';
                        }
                        if (empty($checkReqst->latitude) || empty($checkReqst->longitude)) {
                            $lat = '0.0';
                            $lng = '0.0';
                        } else {
                            $lat = $checkReqst->longitude;
                            $lng = $checkReqst->latitude;
                        }
                        if (!empty($checkReqst->mobile_no)) {
                            $mobileno = $checkReqst->mobile_no;
                        } else {
                            $mobileno = 'N/A';
                        }
                        $rowvalue = array(
                            'id' => $checkReqst->id,
                            'name' => $checkReqst->name,
                            'email' => $checkReqst->email,
                            'image' => $imgurl,
                            'mobile_no' => $mobileno,
                            'location' => $location,
                            'lat' => $lat,
                            'lng' => $lng,
                            'state' => $checkReqst->state,
                            'city' => $checkReqst->city,
                            'created_date' => date("d-m-Y", strtotime($checkReqst->created_at)),
                        );
                        $result = Mail::send('emails.update_email', array('user' => $user_details, 'emailVerCode' => $emailVerCode), function($message) use ($user_details) {
                                    $message->to($user_details['email'])->subject("Email updation request");
                                }, true);
                        $result['status'] = 1;
                        $result['msg'] = 'Check your mail. Please logout and verify your email';
                        $result['data'] = $rowvalue;
                        echo json_encode($result);
                        die;
                    } else {
                        $result['status'] = 0;
                        $result['msg'] = 'Email could not be updated. Please try again';
                        $result['data'] = array();

                        echo json_encode($result);
                        die;
                    }
                } else {
                    $result['status'] = 0;
                    $result['msg'] = 'Your new requested email already has been used. Please provide another.';
                    $result['data'] = array();

                    echo json_encode($result);
                    die;
                }
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Invalid Details.';
                $result['data'] = array();

                echo json_encode($result);
                die;
            }
        }
    }

    /**
     * changecontactaddressapi
     * changecontactaddressapi
     *
     * @return response
     * @access public
     */
    public function changecontactaddressapi(Request $request) {

        if ($request->isMethod('post')) {
            $location = $request->location;
            $state = $request->state;
            $city = $request->city;
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $logged_in_user_id = $request->user_id;
            if (!empty($location) && !empty($logged_in_user_id)) {

                $updatedarray = array(
                    'location' => $location,
                    'state' => $state,
                    'city' => $city,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                );
                $updateStatus = $this->model->where("id", $logged_in_user_id)->update($updatedarray);
                $checkReqst = $this->model->where('id', '=', $logged_in_user_id)->first();
                if ($checkReqst->image) {
                    $imgurl = URL::asset('upload_images/users/' . $checkReqst->id . '/' . $checkReqst->image);
                } elseif ($checkReqst->avatar) {
                    $imgurl = $checkReqst->avatar;
                } else {
                    $imgurl = URL::asset('plugins/front/img/profile-img-new.jpg');
                }
                if ($checkReqst->city) {
                    $location = $checkReqst->city;
                } else {
                    $location = 'N/A';
                }
                if (empty($checkReqst->latitude) || empty($checkReqst->longitude)) {
                    $lat = '0.0';
                    $lng = '0.0';
                } else {
                    $lat = $checkReqst->longitude;
                    $lng = $checkReqst->latitude;
                }
                if (!empty($checkReqst->mobile_no)) {
                    $mobileno = $checkReqst->mobile_no;
                } else {
                    $mobileno = 'N/A';
                }
                $rowvalue = array(
                    'id' => $checkReqst->id,
                    'name' => $checkReqst->name,
                    'email' => $checkReqst->email,
                    'image' => $imgurl,
                    'mobile_no' => $mobileno,
                    'location' => $location,
                    'lat' => $lat,
                    'lng' => $lng,
                    'state' => $checkReqst->state,
                    'city' => $checkReqst->city,
                    'created_date' => date("d-m-Y", strtotime($checkReqst->created_at)),
                );
                $result['status'] = 1;
                $result['msg'] = 'Your Location Updated Successfully.';
                $result['data'] = $rowvalue;

                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Invalid Details.';
                $result['data'] = array();

                echo json_encode($result);
                die;
            }
        }
    }

    /**
     * getuserdetail
     * getuserdetail
     *
     * @return response
     * @access public
     */
    public function getuserdetail(Request $request) {
        $userClassifiedObj = new Classified;
        $current_date = date('Y-m-d');
        if ($request->isMethod('post')) {

            $logged_in_user_id = $request->user_id;
            if (!empty($logged_in_user_id)) {
                $checkReqst = $this->model->where('id', '=', $logged_in_user_id)->first();
                $useraddcount = $userClassifiedObj
                                ->selectRaw('id as classifiedid')
                                ->where('user_id', '=', $checkReqst->id)
                                ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                                ->get()->count();
                if ($checkReqst->image) {
                    $imgurl = URL::asset('upload_images/users/' . $checkReqst->id . '/' . $checkReqst->image);
                } elseif ($checkReqst->avatar) {
                    $imgurl = $checkReqst->avatar;
                } else {
                    $imgurl = URL::asset('plugins/front/img/profile-img-new.jpg');
                }
                if ($checkReqst->city) {
                    $location = $checkReqst->city;
                    $state = $checkReqst->state;
                    $city = $checkReqst->city;
                } else {
                    $location = 'N/A';
                    $state = 'N/A';
                    $city = 'N/A';
                }
                if (empty($checkReqst->latitude) || empty($checkReqst->longitude)) {
                    $lat = '0.0';
                    $lng = '0.0';
                } else {
                    $lat = $checkReqst->longitude;
                    $lng = $checkReqst->latitude;
                }
                if (!empty($checkReqst->mobile_no)) {
                    $mobileno = $checkReqst->mobile_no;
                } else {
                    $mobileno = 'N/A';
                }
                $rowvalue = array(
                    'id' => $checkReqst->id,
                    'name' => $checkReqst->name,
                    'email' => $checkReqst->email,
                    'phonecode' => $checkReqst->phonecode,
                    'address' => $checkReqst->location,
                    'image' => $imgurl,
                    'mobile_no' => $mobileno,
                    'location' => $location,
                    'lat' => $lat,
                    'lng' => $lng,
                    'state' => $state,
                    'city' => $city,
                    'classifiedcount' => $useraddcount,
                    'created_date' => date("d-m-Y", strtotime($checkReqst->created_at)),
                );
                $result['status'] = 1;
                $result['msg'] = 'user details.';
                $result['data'] = $rowvalue;

                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Invalid Details.';
                $result['data'] = array();

                echo json_encode($result);
                die;
            }
        }
    }

    /**
     * changeprofileapi
     * changeprofileapi
     *
     * @return response
     * @access public
     */
    public function changeprofileapi(Request $request) {
        if ($request->isMethod('post')) {
            $image = $request->image;
            $logged_in_user_id = $request->user_id;
            if (!empty($image) && !empty($logged_in_user_id)) {

                if (Input::file()) {
                    $image = Input::file('image');

                    if (!is_dir('upload_images/users/' . $logged_in_user_id)) {
                        File::makeDirectory('upload_images/users/' . $logged_in_user_id, 0777, true);
                    }
                    if (!is_dir('upload_images/users/30x30/' . $logged_in_user_id)) {
                        File::makeDirectory('upload_images/users/30x30/' . $logged_in_user_id, 0777, true);
                    }

                    $extension = $image->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;

                    $destinationPath = 'upload_images/users/' . $logged_in_user_id . '/';
                    $destinationPaththumb = 'upload_images/users/30x30/' . $logged_in_user_id . '/';


                    $image->move($destinationPath, $fileName);
                    image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                    $updated_data["image"] = $fileName;
                }

                $updateStatus = $this->model->where("id", $logged_in_user_id)->update($updated_data);

                $checkReqst = $this->model->where('id', '=', $logged_in_user_id)->first();
                if ($checkReqst->image) {
                    $imgurl = URL::asset('upload_images/users/' . $checkReqst->id . '/' . $checkReqst->image);
                } elseif ($checkReqst->avatar) {
                    $imgurl = $checkReqst->avatar;
                } else {
                    $imgurl = URL::asset('plugins/front/img/profile-img-new.jpg');
                }
                if ($checkReqst->city) {
                    $location = $checkReqst->city;
                } else {
                    $location = 'N/A';
                }
                if (empty($checkReqst->latitude) || empty($checkReqst->longitude)) {
                    $lat = '0.0';
                    $lng = '0.0';
                } else {
                    $lat = $checkReqst->longitude;
                    $lng = $checkReqst->latitude;
                }
                if (!empty($checkReqst->mobile_no)) {
                    $mobilenov = $checkReqst->mobile_no;
                } else {
                    $mobilenov = 'N/A';
                }
                $rowvalue = array(
                    'id' => $checkReqst->id,
                    'name' => $checkReqst->name,
                    'email' => $checkReqst->email,
                    'image' => $imgurl,
                    'mobile_no' => $mobilenov,
                    'location' => $location,
                    'lat' => $lat,
                    'lng' => $lng,
                    'state' => $checkReqst->state,
                    'city' => $checkReqst->city,
                    'created_date' => date("d-m-Y", strtotime($checkReqst->created_at)),
                );
                $result['status'] = 1;
                $result['msg'] = 'Profile Update Successfully';
                $result['data'] = $rowvalue;
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Invalid Details.';
                $result['data'] = array();

                echo json_encode($result);
                die;
            }
        }
    }

    /**
     * usernotification
     * usernotification
     *
     * @return response
     * @access public
     */
    public function usernotification(Request $request) {
        $checkedid = $request->checkedId;
        if (!empty($checkedid)) {
            foreach ($checkedid as $key => $val) {
                $users = User::select('id', 'name', 'email', 'device_id', 'device_type', 'image', 'avatar')->where(['id' => $val])->first()->toarray();

                $device_id = $users['device_id'];
                $type = $users['device_type'];
                $message = $request->massage;
                $sender_id = '0';
                $classified_id = '0';
                $receiver_id = $users['id'];
                $chattype = 'promotional';
                $sendername = $users['name'];
                $messagetype = 'promotional';
                if ($users['image']) {
                    $imgurl = \URL::asset('upload_images/users/' . $users['id'] . '/' . $users['image']);
                } elseif ($users['avatar']) {
                    $imgurl = $users['avatar'];
                } else {
                    $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
                }
                if (!empty($users['device_id'])) {
                    //  dd('yes');
                    if ($type == 'Android') {
                        $this->simplePushNotificationA($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $messagetype);
                    } else {
                        $this->simplePushNotificationI($message, $device_id, $chattype, $sender_id, $classified_id, $receiver_id, $sendername, $type, $messagetype);
                    }
                } else {
                    $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $sendername, $messagetype, $imgurl);
                }
            }
        }
    }

    /**
     * simplePushNotificationA
     * simplePushNotificationA
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
        );

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


        return 1;
        exit;
    }

    /**
     * simplePushNotificationI
     * simplePushNotificationI
     *
     * @return response
     * @access public
     */
    public static function simplePushNotificationI($msg = NULL, $device_id = NULL, $type = NULL, $messagetype = NULL, $categoryid = NULL) {
        $passphrase = '12345';

        //$message = 'A push notification has been sent!';
        $message = $msg;


        ////////////////////////////////////////////////////////////////////////////////
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'Certificates.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
            return 0;

        $body['aps'] = array(
            'alert' => $message,
            'type' => $type,
            'massage' => $msg,
            'subject' => $messagetype,
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
     * simplePushNotificationW
     *
     * @return response
     * @access public
     */
    public static function simplePushNotificationW($msg = NULL, $device_id = NULL, $type = NULL, $senderId = NULL, $classified_id = NULL, $receiver_id = NULL, $sendername = NULL, $messagetype = NULL, $imageurl = NULL) {
        $redis = Redis::connection();
        $data1 = ['msg' => $msg, 's_id' => $senderId, 'r_id' => $receiver_id, 'classified_id' => $classified_id, 'name' => $sendername, 'image' => $imageurl, 'type' => $messagetype];
        $redis->publish('message', json_encode($data1));

        return 1;
        exit;
    }

    public function dashboard(Request $request) {

        $logged_in_user_id = Auth::guard('web')->user()->id;

        $user_details = $this->model->where('id', '=', $logged_in_user_id)->first();

        $user_type = Auth::guard('web')->user()->seller_type;

        
        $currentDate = date('Y-m-d');
        for ($i = 0; $i < 11; $i++) {
            $dateArray[] = date('Y-m-d', strtotime($currentDate . " -$i day"));
        }
        for ($i = 0; $i < 30; $i++) {
            $dateArrayMonth[] = date('Y-m-d', strtotime($currentDate . " -$i day"));
        }

        $ordermodel = new OrderDetail;
        $order = $ordermodel
                ->select(array('order_details.*', DB::Raw('DATE(created_at) day')))
                ->with(['orderDetailSeller', 'orders'])
                ->orderBy('id', 'desc')
                    ->where(['seller_id' => $logged_in_user_id])
                ->get();

        $order1 = $order->groupBy('order_status')->toArray();
        $order_results = [];
        foreach ($order1 as $key => $value) {
            $order_results[$key] = collect($value)->groupBy('day')->toArray();
        }

        if ($user_type == 'business') {

            $currentDate = date('Y-m-d');
            $memPlanUser = new MembershipPlanUser;
            $memPlanUser = $memPlanUser->where('start_date', '<=', $currentDate)
                            ->where('end_date', '>=', $currentDate)
                            ->where(['status' => 1, 'user_id' => Auth::guard('web')->user()->id])->first();

            return view('front/users/dashboard', compact('user_details', 'order_results', 'dateArray', 'dateArrayMonth', 'order'));
        } else {
            return view('front/users/private/dashboard', compact('user_details', 'order_results', 'dateArray', 'dateArrayMonth', 'order'));
        }
    }

    public function manageuser(Request $request) {

        $logged_in_user_id = Auth::guard('web')->user()->id;
        $user_details = $this->model->where('id', '=', $logged_in_user_id)->first();
        return view('front/users/manageuser', compact('user_details'));
    }

    //********************
    //** Get Orders of a customer
    //********************
    public function ordersindex() {
        $logged_in_user_id = Auth::guard('web')->user()->id;
        $user_details = $this->model->where('id', '=', $logged_in_user_id)->first();

        $ordermodel = new Order;
        $order = $ordermodel->with('orderDetail')->where(['user_id' => $logged_in_user_id])->orderBy('created_at', 'DESC')->get();




        $user_type = Auth::guard('web')->user()->seller_type;
        if ($user_type == 'business') {
            return view('front/orders/index', compact('user_details', 'order'));
        } else {
            return view('front/orders/private/index', compact('user_details', 'order'));
        }
    }

    public function ordersdetail(Request $request) {
        $logged_in_user_id = Auth::guard('web')->user()->id;
        $user_details = $this->model->where('id', '=', $logged_in_user_id)->first();
        $order_id = $request->id;
        $sub_order_id = $request->subId;

        if (isset($request->status_submit)) {
            $orderDetailmodel = new OrderDetail;
            $add = $orderDetailmodel->where(['id' => $sub_order_id])->update(['order_status' => $request->order_status]);
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Order Status has been updated');
        }

        if (isset($request->send_email)) {

            $email_content = $request->email_content;
            $data = array('content' => $email_content, 'seller_name' => $request->sender_name, 'seller_email' => $request->sender_email);
            $email_to = array($request->to_email, $request->sender_email);

            $result = Mail::send('emails.seller_to_customer', array('data' => $data), function($message) use ($email_to) {
                        $message->from('avinesh.mathur@planetwebsolution.com');
                        $message->to($email_to)->subject("Formee: Message from Seller");
                    }, true);
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Mail has send to the customer successfully.');
        }

        $ordermodel = new Order;
        $orderData = $ordermodel->with(['orderDetail' => function ($query) {
                        $query->with(['orderDetailSeller']);
                    }])->where(['id' => $order_id])->get();




        $user_type = Auth::guard('web')->user()->seller_type;
        if ($user_type == 'business') {
            return view('front/orders/inbox_detail_ui', compact('user_details', 'orderData', 'sub_order_id'));
        } else {
            return view('front/orders/private/inbox_detail_ui', compact('user_details', 'orderData', 'sub_order_id'));
        }
    }

    //********************
    //** Get Orders for Seller
    //********************
    public function salesindex() {
        $logged_in_user_id = Auth::guard('web')->user()->id;
        $user_details = $this->model->where('id', '=', $logged_in_user_id)->first();

        $ordermodel = new OrderDetail;
        $order = $ordermodel->with(['orderDetailSeller', 'orders'])->where(['seller_id' => $logged_in_user_id])->orderBy('created_at', 'DESC')->get();



        $user_type = Auth::guard('web')->user()->seller_type;
        if ($user_type == 'business') {
            return view('front/sales/index', compact('user_details', 'order'));
        } else {
            return view('front/sales/private/index', compact('user_details', 'order'));
        }
    }
	
    //********************
    //** Get Orders for Seller
    //********************
    public function salesindexfromAd(Request $request) {
        $logged_in_user_id = Auth::guard('web')->user()->id;
        $user_details = $this->model->where('id', '=', $logged_in_user_id)->first();
		
		$classified_id = $request->id;

        $ordermodel = new OrderDetail;
        $order = $ordermodel->with(['orderDetailSeller', 'orders'])->where(['classified_id' => $classified_id])->orderBy('created_at', 'DESC')->get();



        $user_type = Auth::guard('web')->user()->seller_type;
        if ($user_type == 'business') {
            return view('front/sales/index', compact('user_details', 'order'));
        } else {
            return view('front/sales/private/index', compact('user_details', 'order'));
        }
    }
	
	
    public function salesdetail(Request $request) {
        $logged_in_user_id = Auth::guard('web')->user()->id;
        $user_details = $this->model->where('id', '=', $logged_in_user_id)->first();
        $sub_order_id = $request->id;
        $order_id = $request->OrderId;

        if (isset($request->status_submit)) {
            $orderDetailmodel = new OrderDetail;
            $add = $orderDetailmodel->where(['id' => $sub_order_id])->update(['order_status' => $request->order_status]);
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Order Status has been updated');
        }

        if (isset($request->send_email)) {

            $email_content = $request->email_content;
            $data = array('content' => $email_content, 'seller_name' => $request->sender_name, 'seller_email' => $request->sender_email);
            $email_to = array($request->to_email, $request->sender_email);

            $result = Mail::send('emails.seller_to_customer', array('data' => $data), function($message) use ($email_to) {
                        $message->from('avinesh.mathur@planetwebsolution.com');
                        $message->to($email_to)->subject("Formee: Message from Seller");
                    }, true);
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Mail has send to the customer successfully.');
        }


        if (isset($request->confirm_pickup)) {

            $pickup_location = $request->pickup_location;
            $user_preferred_time = $request->user_preferred_time;
            $user_preferred_date = $request->user_preferred_date;

            $orderDetailmodel = new OrderDetail;
            $add = $orderDetailmodel->where(['id' => $sub_order_id])->update(['pickup_location' => $pickup_location, 'buyer_pick_time' => $user_preferred_time, 'buyer_pick_date' => $user_preferred_date]);

            $data = array('pickup_location' => $pickup_location, 'user_preferred_time' => $user_preferred_time, 'user_preferred_date' => $user_preferred_date, 'seller_name' => $request->sender_name, 'seller_email' => $request->sender_email, 'Order_id' => $order_id);

            $email_to = array($request->to_email, $request->sender_email);

            $result = Mail::send('emails.seller_pick_confirm', array('data' => $data), function($message) use ($email_to) {
                        $message->from('avinesh.mathur@planetwebsolution.com');
                        $message->to($email_to)->subject("Formee: Message from Seller");
                    }, true);
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Mail has send to the customer successfully.');
        }


        $ordermodel = new Order;
        $orderData = $ordermodel->with(['orderDetail' => function ($query) {
                        $query->with(['orderDetailSeller']);
                    }])->where(['id' => $order_id])->get();




        $user_type = Auth::guard('web')->user()->seller_type;
        if ($user_type == 'business') {
            return view('front/sales/inbox_detail_ui', compact('user_details', 'orderData', 'sub_order_id'));
        } else {
            return view('front/sales/private/inbox_detail_ui', compact('user_details', 'orderData', 'sub_order_id'));
        }
    }

}
