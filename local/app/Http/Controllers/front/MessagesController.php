<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;
use Auth;
use App\models\Message;
use App\models\Category;
use App\models\Classified;
use App\models\User;
use App\models\LeadEnquiry; 
use App\models\JobApply;
use Hash;
use DB;
use Mail;
use App\Event;
use Illuminate\Routing\Route;
use Session;
use Log;
use Carbon\Carbon;
use Illuminate\Contracts\Mail\Mailer;
use App\Jobs\SendMakeAnOfferEmail;
use Illuminate\Support\Facades\URL;
use File;
use DateTime;

class MessagesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->model = new Message;
    }

    
    /**
     *  function for create new message
     * create
     *
     * @return void
     * @access public
     */
    public function create(Request $request) {

        if ($request->isMethod('post')) {
            $data = new Message();
            $classi = new Classified;

            $data->sender_id = Auth::guard('web')->user()->id;
            $sender_id = Auth::guard('web')->user()->id;
            $data->receiver_id = $request->receiver_id;
            $data->massage = $request->offer_message;
            $data->offer_price = $request->offer_price;
            $data->subject = "Make an Offer";
            $data->flag = "offer";
            $data->classified_id = $request->classified_id;

            $offer_price = $request->offer_price;
            $users = User::select('id', 'name', 'email', 'device_id', 'device_type')->where(['id' => $request->receiver_id])->first()->toarray();
            $classidata = $classi->select('id', 'price')->where(['id' => $request->classified_id])->first()->toarray();
            if (!empty($sender_id)) {
                $senders = User::select('id', 'name', 'email', 'device_id', 'device_type', 'image', 'avatar')->where(['id' => $sender_id])->first()->toarray();
            }
            //check same price duplicate
            $offerExist = $this->model->where(['sender_id' => Auth::guard('web')->user()->id,
                        'receiver_id' => $request->receiver_id,
                        'classified_id' => $request->classified_id,
                        'offer_price' => $request->offer_price,
                    ])->first();
            if (!empty($offerExist)) {
                return response()->json(['status' => false, 'message' => 'Same offer already exists.']);
            }
            if ($classidata['price'] < $data->offer_price) {
                return response()->json(['status' => false, 'message' => 'Please Enter Correct Price']);
            }
            if ($data->offer_price < 1) {
                return response()->json(['status' => false, 'message' => 'Please Enter Correct Price']);
            }

            $email = $users['email'];
            $userdata = array(
                "massage" => $data->massage,
                "name" => $users['name'],
                "UserEmail" => $users['email'],
                "AuthEmail" => Auth::guard('web')->user()->email,
                "AuthName" => Auth::guard('web')->user()->name
            );



            if ($this->model->create($data->toArray())) {

                $classi = new Classified;
                $classi->whereId($request->classified_id)->increment('offer_count');

                $device_id = $users['device_id'];
                $type = $users['device_type'];
                $message = "Hi there, I'd like to offer $$offer_price";
                $sender_id = Auth::guard('web')->user()->id;
                $classified_id = $data['classified_id'];
                $receiver_id = $data['receiver_id'];
                $messagetype = "offer";
                $sendername = $senders['name'];

                if ($senders['image']) {
                    $imgurl = \URL::asset('upload_images/users/' . $senders['id'] . '/' . $senders['image']);
                } elseif ($senders['avatar']) {
                    $imgurl = $senders['avatar'];
                } else {
                    $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
                }
                if (!empty($users['device_id'])) {

                    $chattype = 'chat';

                    if ($type == 'Android') {
                        $this->simplePushNotificationA($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $messagetype);
                    } else {
                        $this->simplePushNotificationI($message, $device_id, $chattype, $sender_id, $classified_id, $receiver_id, $sendername, $offer_price, $type, $messagetype);
                    }
                } else {
                    $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $sendername, $messagetype, $imgurl);
                }



                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false]);
            }
        }
    }

    /**
     *  function for createmessageoffermessageapi
     * createmessageoffermessageapi
     *
     * @return void
     * @access public
     */
    public function createmessageoffermessageapi(Request $request) {

        if ($request->isMethod('post')) {
            $data = new Message();
            $classi = new Classified;
            $sender_id = $request->user_id;
            $receiver_id = $request->classifieduser_id;
            $classified_id = $request->classifiedid;
            $offer_price = $request->offer_price;
            $loginemail = $request->loginemail;
            $loginusername = $request->loginusername;

            if (!empty($sender_id) && !empty($receiver_id) && !empty($classified_id) && !empty($offer_price) && !empty($loginemail) && !empty($loginusername)) {
                $data->sender_id = $sender_id;
                $data->receiver_id = $receiver_id;
                $data->massage = "Hi there, I'd like to offer $$offer_price";
                $data->offer_price = $offer_price;
                $data->subject = "Make an Offer";
                $data->flag = "offer";
                $data->classified_id = $classified_id;
                $messagetype = $data->flag;


                $classidata = $classi->select('id', 'price')->where(['id' => $classified_id])->first()->toarray();
                $users = User::select('id', 'name', 'email', 'device_id', 'device_type')->where(['id' => $receiver_id])->first()->toarray();
                $senders = User::select('id', 'name', 'email', 'device_id', 'device_type', 'image', 'avatar')->where(['id' => $sender_id])->first()->toarray();
                //check same price duplicate
                $offerExist = $this->model->where(['sender_id' => $sender_id,
                            'receiver_id' => $receiver_id,
                            'classified_id' => $classified_id,
                            'offer_price' => $offer_price,
                        ])->first();
                if (!empty($offerExist)) {
                    $result['status'] = 0;
                    $result['msg'] = 'Same offer value already exists.';
                    echo json_encode($result);
                    die;
                }
                if ($classidata['price'] < $offer_price) {
                    $result['status'] = 0;
                    $result['msg'] = 'Offer price not grater then existing price value';
                    echo json_encode($result);
                    die;
                }
                if ($offer_price < 1) {
                    $result['status'] = 0;
                    $result['msg'] = 'Offer price must be valid value';
                    echo json_encode($result);
                    die;
                }

                if ($this->model->create($data->toArray())) {
                    $classi = new Classified;
                    $classi->whereId($classified_id)->increment('offer_count');

                    $device_id = $users['device_id'];
                    $type = $users['device_type'];
                    $message = $data->massage;
                    $sender_id = $sender_id;
                    $classified_id = $classified_id;
                    $receiver_id = $receiver_id;
                    $chattype = 'chat';
                    $sendername = $senders['name'];

                    if ($senders['image']) {
                        $imgurl = \URL::asset('upload_images/users/' . $senders['id'] . '/' . $senders['image']);
                    } elseif ($senders['avatar']) {
                        $imgurl = $senders['avatar'];
                    } else {
                        $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
                    }
                    if (!empty($users['device_id'])) {
                        //  dd('yes');
                        if ($type == 'Android') {
                            $this->simplePushNotificationA($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $messagetype,$sendername);
                        } else {
                            $this->simplePushNotificationI($message, $device_id, $chattype, $sender_id, $classified_id, $receiver_id, $sendername, $type, $messagetype);
                        }
                    } else {
                        $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $sendername, $messagetype, $imgurl);
                    }

                    $result['status'] = 1;
                    $result['msg'] = 'Offer send Successfully.';
                    echo json_encode($result);
                    die;
                } else {
                    $result['status'] = 0;
                    $result['msg'] = 'Not send offer.';
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
    }

     /**
     *  function for getallnotificationapi
     * getallnotificationapi
     *
     * @return void
     * @access public
     */
    public function getallnotificationapi(Request $request) {
        $recever_id = $request->user_id;
        if (!empty($recever_id)) {
            $data = \DB::table('notification')
                            ->leftjoin('classifieds', 'classified_id', '=', 'classifieds.id')
                            ->leftjoin('users', 'sender_id', '=', 'users.id')
                            ->where(function($q1)use($recever_id) {
                                $q1->where('receiver_id', '=', $recever_id);
                            })->get();
            $data = $data->toarray();
            if (!empty($data)) {
                foreach ($data as $key => $value) {

                    $datavalues[] = array(
                        'sender_id' => $value->sender_id,
                        'receiver_id' => $value->receiver_id,
                        'subject' => $value->subject,
                        'massage' => $value->massage,
                        'classified_id' => $value->classified_id,
                        'offer_price' => $value->offer_price,
                        'title' => $value->title,
                        'sendername' => $value->name,
                        'createdtime' => strtotime($value->created_at) * 1000,
                    );
                }
                $result['status'] = 1;
                $result['data'] = $datavalues;
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'No Record Found.';
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
     *  function for getallnotification
     * getallnotification
     *
     * @return void
     * @access public
     */
    public function getallnotification(Request $request) {
        $recever_id = Auth::guard('web')->user()->id;
        if (!empty($recever_id)) {
            $data = \DB::table('notification')
                            ->select('notification.id as notid', 'notification.sender_id', 'notification.receiver_id', 'notification.subject', 'notification.massage', 'notification.deviceid', 'notification.classified_id', 'notification.offer_price', 'notification.created_at as notcreate', 'users.id as id', 'users.image as image', 'users.avatar as avatar', 'users.name as name')
                            ->leftjoin('classifieds', 'classified_id', '=', 'classifieds.id')
                            ->leftjoin('users', 'sender_id', '=', 'users.id')
                            ->orderBy('notid', 'DESC')
                            ->where(function($q1)use($recever_id) {
                                $q1->where('receiver_id', '=', $recever_id);
                            })->paginate(10);

            return view('front/messages/notification', compact('data'));
            
        }
    }


    /**
     *  index
     * indexing of all message 
     *
     * @return void
     * @access public
     */
    public function index(Request $request) {

        $selectedCategories = null;
        $categories = new Category;

        $allSubCategoriesForMenu = $categories->getFrontCategoriesForMenu($selectedCategories);
        $allComCategories = $categories->getFrontComCategories($selectedCategories);

        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $categories->getFrontCategories($selectedCategories);

        $userClassifiedObj = new Classified;
        $user_total_classifieds = $userClassifiedObj->where('user_id', '=', Auth::guard('web')->user()->id)->count();
        if (empty($user_total_classifieds)) {
            $user_total_classifieds = 0;
        }
        //count total number of views of his/her all classifieds
        $total_viewer = $userClassifiedObj->selectRaw("sum(count) as total_views")->where('user_id', '=', Auth::guard('web')->user()->id)->first();

        $msg_flag = 'receiver_id';
        $msg_flag_scond = 'sender_id';
        $index_type = 'inbox_index';

        if (isset($request->msg_flag)) {
            $msg_flag = $request->msg_flag;
        }
        if (isset($request->msg_flag_second)) {
            $msg_flag_scond = $request->msg_flag_second;
        }
        if (isset($request->index_type)) {
            $index_type = $request->index_type;
        }
        if ($request->isMethod('post')) {
            $data = Input::all();
            if (!empty($data)) {
                $msg_flag = $data['msg_flag'];
                $msg_flag_scond = $data['msg_flag_scond'];
            }
        }
        $logged_in_user_id = Auth::guard('web')->user()->id;
        $userObj = new User;
        $user_details = $userObj->where('id', '=', $logged_in_user_id)->first();
        
		
		$user_type = Auth::guard('web')->user()->seller_type;
		if($user_type == 'business'){
        	return view('front/messages/index', compact('allSubCategories', 'allSubCategoriesForMenu', 'allComCategories', 'msg_flag', 'msg_flag_scond', 'index_type', 'user_details', 'total_viewer', 'user_total_classifieds'));
		}else{
			return view('front/messages/private/index', compact('allSubCategories', 'allSubCategoriesForMenu', 'allComCategories', 'msg_flag', 'msg_flag_scond', 'index_type', 'user_details', 'total_viewer', 'user_total_classifieds'));
		}
    }
	
	
    /**
     *  index
     * indexing of all Jobs application 
     *
     * @return void
     * @access public
     */
    public function jobsindex(Request $request) {

        $selectedCategories = null;
        $categories = new Category;

        $allSubCategoriesForMenu = $categories->getFrontCategoriesForMenu($selectedCategories);
        $allComCategories = $categories->getFrontComCategories($selectedCategories);

        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $categories->getFrontCategories($selectedCategories);

        $userClassifiedObj = new Classified;
        $user_total_classifieds = $userClassifiedObj->where('user_id', '=', Auth::guard('web')->user()->id)->count();
        if (empty($user_total_classifieds)) {
            $user_total_classifieds = 0;
        }
        //count total number of views of his/her all classifieds
        $total_viewer = $userClassifiedObj->selectRaw("sum(count) as total_views")->where('user_id', '=', Auth::guard('web')->user()->id)->first();

        $msg_flag = 'receiver_id';
        $msg_flag_scond = 'sender_id';
        $index_type = 'inbox_index';

        if (isset($request->msg_flag)) {
            $msg_flag = $request->msg_flag;
        }
        if (isset($request->msg_flag_second)) {
            $msg_flag_scond = $request->msg_flag_second;
        }
        if (isset($request->index_type)) {
            $index_type = $request->index_type;
        }
        if ($request->isMethod('post')) {
            $data = Input::all();
            if (!empty($data)) {
                $msg_flag = $data['msg_flag'];
                $msg_flag_scond = $data['msg_flag_scond'];
            }
        }
        $logged_in_user_id = Auth::guard('web')->user()->id;
        $userObj = new User;
        $user_details = $userObj->where('id', '=', $logged_in_user_id)->first();
		
		
		$jobsObj = new JobApply;
		
		$result = $jobsObj->selectRaw('apply_job.*, classifieds.title')
		->leftjoin('classifieds', 'classifieds.id', '=', 'apply_job.classified_id')
		->where('receiver_id', '=', $logged_in_user_id)
		->groupBy('apply_job.id')
		->orderBy('created_at','desc')
		->paginate(10);
		

		
                
		$user_type = Auth::guard('web')->user()->seller_type;
		if($user_type == 'business'){
        	return view('front/jobapplication/index', compact('allSubCategories', 'allSubCategoriesForMenu', 'allComCategories', 'result', 'user_details', 'total_viewer', 'user_total_classifieds'));
		}else{
			return view('front/jobapplication/private/index', compact('allSubCategories', 'allSubCategoriesForMenu', 'allComCategories', 'result', 'user_details', 'total_viewer', 'user_total_classifieds'));
		}	
		
		
    }


    /**
     *  index
     * indexing of all Jobs application 
     *
     * @return void
     * @access public
     */
    public function jobsindexfromAd(Request $request) {

        $selectedCategories = null;
        $categories = new Category;

        $allSubCategoriesForMenu = $categories->getFrontCategoriesForMenu($selectedCategories);
        $allComCategories = $categories->getFrontComCategories($selectedCategories);

        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $categories->getFrontCategories($selectedCategories);

        $userClassifiedObj = new Classified;
        $user_total_classifieds = $userClassifiedObj->where('user_id', '=', Auth::guard('web')->user()->id)->count();
        if (empty($user_total_classifieds)) {
            $user_total_classifieds = 0;
        }
        //count total number of views of his/her all classifieds
        $total_viewer = $userClassifiedObj->selectRaw("sum(count) as total_views")->where('user_id', '=', Auth::guard('web')->user()->id)->first();

        $msg_flag = 'receiver_id';
        $msg_flag_scond = 'sender_id';
        $index_type = 'inbox_index';

        if (isset($request->msg_flag)) {
            $msg_flag = $request->msg_flag;
        }
        if (isset($request->msg_flag_second)) {
            $msg_flag_scond = $request->msg_flag_second;
        }
        if (isset($request->index_type)) {
            $index_type = $request->index_type;
        }
        if ($request->isMethod('post')) {
            $data = Input::all();
            if (!empty($data)) {
                $msg_flag = $data['msg_flag'];
                $msg_flag_scond = $data['msg_flag_scond'];
            }
        }
        $logged_in_user_id = Auth::guard('web')->user()->id;
        $userObj = new User;
        $user_details = $userObj->where('id', '=', $logged_in_user_id)->first();
		
		
		$jobsObj = new JobApply;
		
		$result = $jobsObj->selectRaw('apply_job.*, classifieds.title')
		->leftjoin('classifieds', 'classifieds.id', '=', 'apply_job.classified_id')
		->where('classified_id', '=', $request->id)
		->groupBy('apply_job.id')
		->orderBy('created_at','desc')
		->paginate(10);
		
		
		$user_type = Auth::guard('web')->user()->seller_type;
		if($user_type == 'business'){
        	return view('front/jobapplication/index', compact('allSubCategories', 'allSubCategoriesForMenu', 'allComCategories', 'result', 'user_details', 'total_viewer', 'user_total_classifieds'));
		}else{
			return view('front/jobapplication/private/index', compact('allSubCategories', 'allSubCategoriesForMenu', 'allComCategories', 'result', 'user_details', 'total_viewer', 'user_total_classifieds'));
		}	
		
		
    }


    /**
     *  details
     * detail of Job applications message 
     *
     * @return void
     * @access public
     */
    public function jobsdetail(Request $request) {
        $selectedCategories = null;
        $categories = new Category;

        $allSubCategoriesForMenu = $categories->getFrontCategoriesForMenu($selectedCategories);
        $allComCategories = $categories->getFrontComCategories($selectedCategories);

        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $categories->getFrontCategories($selectedCategories);

        $userClassifiedObj = new Classified;
        $user_total_classifieds = $userClassifiedObj->where('user_id', '=', Auth::guard('web')->user()->id)->count();
        if (empty($user_total_classifieds)) {
            $user_total_classifieds = 0;
        }
        //count total number of views of his/her all classifieds
        $total_viewer = $userClassifiedObj->selectRaw("sum(count) as total_views")->where('user_id', '=', Auth::guard('web')->user()->id)->first();

        $msg_flag = 'receiver_id';
        $msg_flag_scond = 'sender_id';
        $index_type = 'inbox_index';

        if (isset($request->msg_flag)) {
            $msg_flag = $request->msg_flag;
        }
        if (isset($request->msg_flag_second)) {
            $msg_flag_scond = $request->msg_flag_second;
        }
        if (isset($request->index_type)) {
            $index_type = $request->index_type;
        }
		
		 $logged_in_user_id = Auth::guard('web')->user()->id;
		 
		if(isset($request->apply_job_id)){
			$request->id = $request->apply_job_id;
			DB::table('apply_job')
			->where('id', $request->apply_job_id)  // find your user by their email
			->limit(1)  // optional - to ensure only one record is updated.
			->update(array('application_status' => $request->application_status, 'sendmsg'=>$request->sendmag));
			
			
			 $sender_id = $logged_in_user_id;
			$receiver_id = $request->employer_id;
			$classified_id = $request->classifiedid;
			$massagedata = $request->sendmag;
			 $messagetype = 'user-message';
            $users = User::select('id', 'name', 'email', 'device_id', 'device_type')->where(['id' => $receiver_id])->first()->toarray();
            $senders = User::select('id', 'name', 'email', 'device_id', 'device_type', 'image', 'avatar')->where(['id' => $sender_id])->first()->toarray();

            $device_id = $users['device_id'];
            $type = $users['device_type'];
            $message = $massagedata;
            $sender_id = $sender_id;
            $classified_id = $classified_id;
            $receiver_id = $receiver_id;
			$sendername = $senders['name'];
			
			$chattype = 'user-message';
           

            if ($senders['image']) {
                $imgurl = \URL::asset('upload_images/users/' . $senders['id'] . '/' . $senders['image']);
            } elseif ($senders['avatar']) {
                $imgurl = $senders['avatar'];
            } else {
                $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
            }
            if (!empty($users['device_id'])) {
                if ($type == 'Android') {
                    $this->simplePushNotificationA($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $messagetype, $sendername);
                } else {
                    $this->simplePushNotificationI($message, $device_id, $chattype, $sender_id, $classified_id, $receiver_id, $sendername, $type, $messagetype);
                }
            } else {
                $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $sendername, $messagetype, $imgurl);
            }
			
			Session::flash('message', 'Successfully submitted.');
			 	
		}
       
        $userObj = new User;
        $user_details = $userObj->where('id', '=', $logged_in_user_id)->first();
		
		$jobsObj = new JobApply;
		$result = $jobsObj->selectRaw('apply_job.*, classifieds.title')
		->with(['jobapply_answer'=>function ($query) {
			$query->with(['jobapply_answer_question']);
		}])
		->leftjoin('classifieds', 'classifieds.id', '=', 'apply_job.classified_id')
		->where('apply_job.id', '=', $request->id)
		->get();
		                
		
		$user_type = Auth::guard('web')->user()->seller_type;
		if($user_type == 'business'){
        	return view('front/jobapplication/inbox_detail_ui', compact('allSubCategories', 'allSubCategoriesForMenu', 'allComCategories', 'result', 'user_details', 'total_viewer', 'user_total_classifieds'));
		}else{
			return view('front/jobapplication/private/inbox_detail_ui', compact('allSubCategories', 'allSubCategoriesForMenu', 'allComCategories', 'result', 'user_details', 'total_viewer', 'user_total_classifieds'));
		}
		
		
    }
	
    /**
     *  index
     * indexing of all Leads message 
     *
     * @return void
     * @access public
     */
    public function leadsindex(Request $request) {

        $selectedCategories = null;
        $categories = new Category;

        $allSubCategoriesForMenu = $categories->getFrontCategoriesForMenu($selectedCategories);
        $allComCategories = $categories->getFrontComCategories($selectedCategories);

        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $categories->getFrontCategories($selectedCategories);

        $userClassifiedObj = new Classified;
        $user_total_classifieds = $userClassifiedObj->where('user_id', '=', Auth::guard('web')->user()->id)->count();
        if (empty($user_total_classifieds)) {
            $user_total_classifieds = 0;
        }
        //count total number of views of his/her all classifieds
        $total_viewer = $userClassifiedObj->selectRaw("sum(count) as total_views")->where('user_id', '=', Auth::guard('web')->user()->id)->first();

        $msg_flag = 'receiver_id';
        $msg_flag_scond = 'sender_id';
        $index_type = 'inbox_index';

        if (isset($request->msg_flag)) {
            $msg_flag = $request->msg_flag;
        }
        if (isset($request->msg_flag_second)) {
            $msg_flag_scond = $request->msg_flag_second;
        }
        if (isset($request->index_type)) {
            $index_type = $request->index_type;
        }
        if ($request->isMethod('post')) {
            $data = Input::all();
            if (!empty($data)) {
                $msg_flag = $data['msg_flag'];
                $msg_flag_scond = $data['msg_flag_scond'];
            }
        }
        $logged_in_user_id = Auth::guard('web')->user()->id;
        $userObj = new User;
        $user_details = $userObj->where('id', '=', $logged_in_user_id)->first();
		
		
		$leadsObj = new LeadEnquiry;
		
		$result = $leadsObj->selectRaw('lead_enquiries.*, classifieds.title')
		->leftjoin('classifieds', 'classifieds.id', '=', 'lead_enquiries.classified_id')
		->where('receiver_id', '=', $logged_in_user_id)
		->groupBy('lead_enquiries.id')
		->orderBy('created_at','desc')
		->paginate(10);
		
		$user_type = Auth::guard('web')->user()->seller_type;
		if($user_type == 'business'){
        	return view('front/leads/index', compact('allSubCategories', 'allSubCategoriesForMenu', 'allComCategories', 'result', 'user_details', 'total_viewer', 'user_total_classifieds'));
		}else{
			return view('front/leads/private/index', compact('allSubCategories', 'allSubCategoriesForMenu', 'allComCategories', 'result', 'user_details', 'total_viewer', 'user_total_classifieds'));
		}
		
    }


    /**
     *  details
     * detail of Leads message 
     *
     * @return void
     * @access public
     */
    public function leadsdetail(Request $request) {

        $selectedCategories = null;
        $categories = new Category;

        $allSubCategoriesForMenu = $categories->getFrontCategoriesForMenu($selectedCategories);
        $allComCategories = $categories->getFrontComCategories($selectedCategories);

        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $categories->getFrontCategories($selectedCategories);

        $userClassifiedObj = new Classified;
        $user_total_classifieds = $userClassifiedObj->where('user_id', '=', Auth::guard('web')->user()->id)->count();
        if (empty($user_total_classifieds)) {
            $user_total_classifieds = 0;
        }
        //count total number of views of his/her all classifieds
        $total_viewer = $userClassifiedObj->selectRaw("sum(count) as total_views")->where('user_id', '=', Auth::guard('web')->user()->id)->first();

        $msg_flag = 'receiver_id';
        $msg_flag_scond = 'sender_id';
        $index_type = 'inbox_index';

        if (isset($request->msg_flag)) {
            $msg_flag = $request->msg_flag;
        }
        if (isset($request->msg_flag_second)) {
            $msg_flag_scond = $request->msg_flag_second;
        }
        if (isset($request->index_type)) {
            $index_type = $request->index_type;
        }
        
        $logged_in_user_id = Auth::guard('web')->user()->id;
        $userObj = new User;
        $user_details = $userObj->where('id', '=', $logged_in_user_id)->first();
		
		if(isset($request->save_leads)){
			DB::table('lead_enquiries')->where(['id'=>$request->id])->update(['status' => $request->lead_status, 'lead_content'=>$request->lead_notes]);
		}
		
		$result = DB::select("select e.*, c.title from lead_enquiries e  
		left join classifieds c on e.classified_id=c.id 
		where e.id = '".$request->id."' 
		order by e.created_at desc");
		
                
		$user_type = Auth::guard('web')->user()->seller_type;
		if($user_type == 'business'){
        	return view('front/leads/inbox_detail_ui', compact('allSubCategories', 'allSubCategoriesForMenu', 'allComCategories', 'result', 'user_details', 'total_viewer', 'user_total_classifieds'));
		}else{
			return view('front/leads/private/inbox_detail_ui', compact('allSubCategories', 'allSubCategoriesForMenu', 'allComCategories', 'result', 'user_details', 'total_viewer', 'user_total_classifieds'));
		}
		
		
    }
     /**
     *  all_message
     * indexing of all message 
     *
     * @return void
     * @access public
     */
    public function all_message(Request $request) {
        Session::set('msg_flag', $request->msg_flag);
        $msg_flag = $request->msg_flag;
        $msg_flag_scond = $request->msg_flag_second;
        $index_type = $request->index_type;

        $result = $this->model;
        $authUserId = Auth::guard('web')->user()->id;
        $orderBy = " ";
        $where = " 1=1 ";
        $condition = " 1=1 ";
        $where1 = "";
        $limit = 100;
        $page = $request->page_no_value;
        $start_from = ($page - 1) * $limit;


        if (isset($request->readUnread) && $request->readUnread != '') {
            $where .= " AND read_status =   $request->readUnread ";
        }
        if (isset($request->title) && $request->title != '') {
            $condition .= " and c.title like'%$request->title%'";
        }
        if (isset($request->shortBy) && $request->shortBy != '') {
            $orderBy .= " order by m.id $request->shortBy ";
        } else {
            $orderBy .= " order by m.id desc ";
        }
        if ($request->index_type == 'archive_index') {
            $where .= " AND (deleted_at = 0 AND find_in_set($authUserId, deleted_by) ) ";

            $result = DB::select("select  
                (select count(id) from messages where (sender_id=m.sender_id and receiver_id=m.receiver_id and classified_id = m.classified_id) or (receiver_id=m.sender_id and sender_id=m.receiver_id and classified_id = m.classified_id )) counter,
                c.id classified_id, ci.name as image_name,u.name,u.image,u.email, u.id second_user_id,m.massage,m.subject,n.max_id msg_id,m.created_at msg_time,c.title
                from (
                select max(id) max_id, if(sender_id=$authUserId,receiver_id,sender_id) id2 from `messages`"
                            . " where $where group by id2,classified_id 
                ) n
                left join messages m on n.max_id=m.id
                left join users u on n.id2=u.id
                left join classifieds c on m.classified_id=c.id
                left join 
                (SELECT * FROM `classifiedimage` group by classified_id) ci
                on c.id=ci.classified_id where $condition $orderBy LIMIT $start_from, $limit");



            $result_count = DB::select("select count(m.id) count_id 
                from (
                select max(id) max_id, if(sender_id=$authUserId,receiver_id,sender_id) id2 from `messages`"
                            . " where $where group by id2,classified_id 
                ) n
                left join messages m on n.max_id=m.id
                left join users u on n.id2=u.id
                left join classifieds c on m.classified_id=c.id
                left join 
                (SELECT * FROM `classifiedimage` group by classified_id) ci
                on c.id=ci.classified_id ");

            $total_pages = ceil($result_count[0]->count_id / $limit);
            $totalRecord = $result_count[0]->count_id;
        } else {


            if ($request->msg_flag == 'sender_id') {
                $where1 .= " find_in_set(" . $authUserId . ",s_list) > 0 AND c.user_id != $authUserId";
            } else {
                $where1 .= " find_in_set(" . $authUserId . ",r_list) > 0 AND c.user_id = $authUserId";
            }


            $where1 .= " and deleted_at = 1";
            if (isset($request->title) && $request->title != '') {
                $where1 .= " and c.title like'%$request->title%'";
            }
            $result = DB::select("select *,c.id classified_id,s_list,r_list,ci.name as image_name,u.name,u.image,u.email, u.id second_user_id,m.massage,m.subject,m.read_status,n.max_id msg_id,m.created_at msg_time,c.title from (SELECT receiver_id, max(id) "
                            . "max_id,if(receiver_id = $authUserId , sender_id, receiver_id) id2,sender_id,group_concat(distinct sender_id) s_list,group_concat(distinct receiver_id) r_list from `messages`"
                            . "group by id2,classified_id 
                ) n
                left join messages m on n.max_id=m.id
                left join users u on n.id2=u.id
                left join classifieds c on m.classified_id=c.id
                left join 
                (SELECT * FROM `classifiedimage` group by classified_id) ci
                on c.id=ci.classified_id where $where1 $orderBy LIMIT $start_from, $limit ");



            $result_count = DB::select("select count(m.id) count_id
                from (
                select max(id) max_id, if($request->msg_flag=$authUserId,$request->msg_flag_second,$request->msg_flag) id2 from `messages`"
                            . " where $where group by id2,classified_id
                ) n
                left join messages m on n.max_id=m.id
                left join users u on n.id2=u.id
                left join classifieds c on m.classified_id=c.id
                left join 
                (SELECT * FROM `classifiedimage` group by classified_id) ci
                on c.id=ci.classified_id ");

            $total_pages = ceil($result_count[0]->count_id / $limit);
            $totalRecord = $result_count[0]->count_id;
        }
        
		
$user_type = Auth::guard('web')->user()->seller_type;
		if($user_type == 'business'){
        	return view('front/messages/inbox_ui', compact('result', 'total_pages', 'msg_flag', 'msg_flag_scond', 'index_type', 'totalRecord', 'page'));
		}else{
			return view('front/messages/private/inbox_ui', compact('result', 'total_pages', 'msg_flag', 'msg_flag_scond', 'index_type', 'totalRecord', 'page'));
		}
		
		die;
    }

     /**
     *  all_message_chat
     * all_message_chat 
     *
     * @return void
     * @access public
     */
    public function all_message_chat() {
        $data = Input::all();

        $authUserId = Auth::guard('web')->user()->id;
        $result = DB::select("select $authUserId authUserId,c1.massage,c1.id,c1.subject,c1.classified_id,c1.created_at,
             c1.sender_id,u.name user_name,u.id user_id,c2.name image_name,c.title,c.price,c.description,cty.City as city_name,c.count,c.parent_categoryid,ct.name as category_name,u.image user_image, 
             if(CURDATE() = DATE_FORMAT(c1.created_at,'%y-%m-%d'), DATE_FORMAT(c1.created_at,'%H:%i'), DATE_FORMAT(c1.created_at,'%y-%m-%d') )   time from 
             ( select *, if(sender_id = $authUserId, receiver_id, sender_id) userid_data from `messages` where (`classified_id` = $data[classifiedId]) and

((`sender_id` = $authUserId and `receiver_id` = $data[second_user_id]) or (`sender_id` = $data[second_user_id] and `receiver_id` = $authUserId))) c1
left join users u on c1.userid_data = u.id 
left join classifieds c on c1.classified_id=c.id
left join categories ct on ct.id=c.parent_categoryid
left join cities cty on cty.CityId = c.city_id
left join (SELECT * FROM `classifiedimage` group by classified_id) c2
on c.id=c2.classified_id
");

        $readBy = $this->model;
        $readBy->where(['classified_id' => $data['classifiedId'], 'receiver_id' => $authUserId, 'sender_id' => $data['second_user_id']])->update(['read_status' => 1]);
        

$user_type = Auth::guard('web')->user()->seller_type;
		if($user_type == 'business'){
        	return view('front/messages/inbox_detail_ui', compact('result'));
		}else{
			return view('front/messages/private/inbox_detail_ui', compact('result'));
		}
				
		
        die;
    }

     /**
     *  sendallsellerchat
     * sendallsellerchat
     *
     * @return void
     * @access public
     */
    public function sendallsellerchat(Request $request) {
        $index_type = 'inbox_index';
        $rooturl = \Request::root();
        $result = $this->model;
        $authUserId = $request->user_id;
        $msg_flag = $request->msg_type;
        $msg_flag_scond = $request->msg_flag_scond;
        $orderBy = " ";
        $where = " 1=1 ";
        $where1 = "";
        if ($msg_flag == 'receiver_id') {
            $where1 .= " find_in_set(" . $authUserId . ",r_list) > 0 AND c.user_id = $authUserId";
        } else {
            $where1 .= " find_in_set(" . $authUserId . ",s_list) > 0 AND c.user_id != $authUserId";
        }

        if (!empty($msg_flag) && !empty($authUserId)) {

            if (isset($request->readUnread) && $request->readUnread != '') {
                $where .= " AND read_status =   $request->readUnread ";
            }
            if (isset($request->shortBy) && $request->shortBy != '') {
                $orderBy .= " order by m.id $request->shortBy ";
            } else {
                $orderBy .= " order by m.id desc ";
            }

            if ($index_type == 'archive_index') {
                $where .= " AND (deleted_at = 0 AND find_in_set($authUserId, deleted_by) ) ";

                $result = DB::select("select  
                (select count(id) from messages where (sender_id=m.sender_id and receiver_id=m.receiver_id and classified_id = m.classified_id) or (receiver_id=m.sender_id and sender_id=m.receiver_id and classified_id = m.classified_id )) counter,
                c.id classified_id, ci.name as image_name,u.name,u.image,u.email, u.id second_user_id,m.massage,m.subject,n.max_id msg_id,m.created_at msg_time,c.title
                from (
                select max(id) max_id, if(sender_id=$authUserId,receiver_id,sender_id) id2 from `messages`"
                                . " where $where group by id2,classified_id 
                ) n
                left join messages m on n.max_id=m.id
                left join users u on n.id2=u.id
                left join classifieds c on m.classified_id=c.id
                left join 
                (SELECT * FROM `classifiedimage` group by classified_id) ci
                on c.id=ci.classified_id $orderBy ");

                $result_count = DB::select("select count(m.id) count_id 
                from (
                select max(id) max_id, if(sender_id=$authUserId,receiver_id,sender_id) id2 from `messages`"
                                . " where $where group by id2,classified_id 
                ) n
                left join messages m on n.max_id=m.id
                left join users u on n.id2=u.id
                left join classifieds c on m.classified_id=c.id
                left join 
                (SELECT * FROM `classifiedimage` group by classified_id) ci
                on c.id=ci.classified_id ");

                $total_pages = ceil($result_count[0]->count_id / $limit);
                $totalRecord = $result_count[0]->count_id;
            } else {

                $where .= " AND $msg_flag=$authUserId AND (deleted_at = 1 OR NOT find_in_set($authUserId, deleted_by) )";


                $data = DB::select("select *,c.id classified_id,s_list,r_list,ci.name as image_name,u.name,u.image,u.email, u.id second_user_id,m.massage,m.subject,m.read_status,n.max_id msg_id,m.created_at msg_time,c.title from (SELECT receiver_id, max(id) "
                                . "max_id,if(receiver_id = $authUserId , sender_id, receiver_id) id2,sender_id,group_concat(distinct sender_id) s_list,group_concat(distinct receiver_id) r_list from `messages`"
                                . "group by id2,classified_id 
                ) n
                left join messages m on n.max_id=m.id
                left join users u on n.id2=u.id
                left join classifieds c on m.classified_id=c.id
                left join 
                (SELECT * FROM `classifiedimage` group by classified_id) ci
                on c.id=ci.classified_id where $where1 $orderBy");
            }
            if (count($data) > 0) {

                foreach ($data as $key => $value) {


                    if ($value->image) {
                        $imgurl = URL::asset('upload_images/users/' . $value->second_user_id . '/' . $value->image);
                    } elseif ($value->avatar) {
                        $imgurl = $value->avatar;
                    } else {
                        $imgurl = URL::asset('plugins/front/img/profile-img-new.jpg');
                    }
                    $sellerdata[] = array(
                        'name' => $value->name,
                        'classified_id' => $value->classified_id,
                        'classifieduser_id' => $value->second_user_id,
                        'massage' => $value->massage,
                        'msg_time' => strtotime($value->msg_time),
                        'profileimage' => $imgurl,
                        'classified_title' => $value->title,
                        'classified_price' => $value->price,
                        'classified_image' => $rooturl . '/upload_images/classified/' . $value->classified_id . '/' . $value->image_name,
                    );
                }

                $result['status'] = 1;
                $result['data'] = $sellerdata;
                $result['msg'] = 'Data Available';
                echo json_encode($result);
                die;
            } else {

                $result['status'] = 0;
                $result['msg'] = 'No Data Available';
                $result['data'] = array();
                echo json_encode($result);
                die;
            }

        } else {
            $result['status'] = 0;
            $result['msg'] = 'Invalid Details';
            $result['data'] = array();
            echo json_encode($result);
            die;
        }
    }
     /**
     *  sendallchatconversion
     * sendallchatconversion
     *
     * @return void
     * @access public
     */
    public function sendallchatconversion(Request $request) {
        $rooturl = \Request::root();
        $authUserId = $request->user_id;
        $classifiedId = $request->classifiedId;
        $second_user_id = $request->chatuser_id;
        $id = $request->id;
        if ($id > 0)
            $cond = "and `id`< $id";
        else
            $cond = "";
        $limit = $request->limit;
        if (!empty($limit))
            $limit=$limit;
        else
            $limit = 10;
        
        if (!empty($authUserId) && !empty($classifiedId) && !empty($second_user_id)) {
            $data = DB::select("select $authUserId authUserId,c1.massage,c1.id,c1.subject,c1.classified_id,c1.created_at,
             c1.sender_id,u.name user_name,u.id user_id,u.city,u.image,u.avatar,c2.name image_name,c.title,c.price,
             if(CURDATE() = DATE_FORMAT(c1.created_at,'%y-%m-%d'), DATE_FORMAT(c1.created_at,'%H:%i'), DATE_FORMAT(c1.created_at,'%y-%m-%d') )   time from 
             ( select *, if(sender_id = $authUserId, receiver_id, sender_id) userid_data from `messages` where (`classified_id` = $classifiedId) and

((`sender_id` = $authUserId and `receiver_id` = $second_user_id) or (`sender_id` = $second_user_id and `receiver_id` = $authUserId)) $cond order by `id` Desc limit $limit ) c1
left join users u on c1.userid_data = u.id 
left join classifieds c on c1.classified_id=c.id
left join (SELECT * FROM `classifiedimage` group by classified_id) c2
on c.id=c2.classified_id
");
           $data=array_reverse($data);

            $readBy = $this->model;
            $readBy->where(['classified_id' => $classifiedId, 'receiver_id' => $authUserId, 'sender_id' => $second_user_id])->update(['read_status' => 1]);
            if (count($data) > 0) {
                foreach ($data as $key => $value) {

                    $sellerdata[] = array(
                        'id'=>$value->id,
                        'userid' => $value->sender_id,
                        'massage' => $value->massage,
                        'msg_time' => strtotime($value->created_at),
                    );
                    if ($value->image) {
                        $imgurl = URL::asset('upload_images/users/' . $second_user_id . '/' . $value->image);
                    } elseif ($value->avatar) {
                        $imgurl = $value->avatar;
                    } else {
                        $imgurl = URL::asset('plugins/front/img/profile-img-new.jpg');
                    }
                    $classifiedarray = array(
                        'classified_id' => $value->classified_id,
                        'classified_title' => $value->title,
                        'classified_price' => $value->price,
                        'classified_image' => $rooturl . '/upload_images/classified/' . $value->classified_id . '/' . $value->image_name,
                        'chatuser_id' => $second_user_id,
                        'chatusername' => $value->user_name,
                        'profileimage' => $imgurl,
                    );
                }
                $result['status'] = 1;
                $result['data'] = $sellerdata;
                $result['classifieddetail'] = $classifiedarray;
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 1;
                $result['msg'] = 'No Data Available';
                $result['data'] = array();
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

     /**
     *  count_for_tabs
     * count_for_tabs
     *
     * @return response
     * @access public
     */
    public function count_for_tabs(Request $request) {

        $result = $this->model;
        $authUserId = Auth::guard('web')->user()->id;
        $where = " 1=1 ";

        $result_count_archive = DB::select("select count(m.id) count_id 
                from (
                select max(id) max_id, if(sender_id=$authUserId,receiver_id,sender_id) id2 from `messages`"
                        . " where (deleted_at = 0 AND find_in_set($authUserId, deleted_by) ) group by id2,classified_id 
                ) n
                left join messages m on n.max_id=m.id
                left join users u on n.id2=u.id
                left join classifieds c on m.classified_id=c.id
                left join 
                (SELECT * FROM `classifiedimage` group by classified_id) ci
                on c.id=ci.classified_id ");

        $totalRecordArchive = $result_count_archive[0]->count_id;

        $result_count_inbox = DB::select("select count(m.id) count_id
                from (
                select max(id) max_id, if(receiver_id=$authUserId,sender_id,receiver_id) id2 from `messages`"
                        . " where read_status=0 AND receiver_id=$authUserId AND (deleted_at = 1 OR NOT find_in_set($authUserId, deleted_by) ) group by id2,classified_id
                ) n
                left join messages m on n.max_id=m.id
                left join users u on n.id2=u.id
                left join classifieds c on m.classified_id=c.id
                left join 
                (SELECT * FROM `classifiedimage` group by classified_id) ci
                on c.id=ci.classified_id ");
        $totalRecordInbox = $result_count_inbox[0]->count_id;

        $result_count_sent = DB::select("select count(m.id) count_id
                from (
                select max(id) max_id, if(sender_id=$authUserId,receiver_id,sender_id) id2 from `messages`"
                        . " where sender_id=$authUserId AND (deleted_at = 1 OR NOT find_in_set($authUserId, deleted_by) ) group by id2,classified_id
                ) n
                left join messages m on n.max_id=m.id
                left join users u on n.id2=u.id
                left join classifieds c on m.classified_id=c.id
                left join 
                (SELECT * FROM `classifiedimage` group by classified_id) ci
                on c.id=ci.classified_id ");

        $totalRecordSent = $result_count_sent[0]->count_id;
        return response()->json(['status' => true, 'totalRecordArchive' => $totalRecordArchive, 'totalRecordInbox' => $totalRecordInbox, 'totalRecordSent' => $totalRecordSent]);
    }

     /**
     *  send_message_chat
     * send_message_chat
     *
     * @return response
     * @access public
     */
    public function send_message_chat() {
        $data = Input::all();
        $dataArray = $this->model;
        $dataArray->sender_id = $data['sender_id'];
        $dataArray->receiver_id = $data['receiver_id'];
        $dataArray->classified_id = $data['classifiedId'];
        $dataArray->massage = $data['textareaMessageChat'];
        $dataArray->flag = 'chat';
        $dataArray->subject = 'Make an Offer';
        $offer_price = NULL;

        $result = $dataArray->create($dataArray->toarray());
        if ($result->id) {
            $users = User::select('id', 'name', 'email', 'device_id', 'device_type')->where(['id' => $data['receiver_id']])->first()->toarray();
            if (!empty($data['sender_id'])) {
                $senders = User::select('id', 'name', 'email', 'device_id', 'device_type', 'image', 'avatar')->where(['id' => $data['sender_id']])->first()->toarray();
            }

            $device_id = $users['device_id'];
            $type = $users['device_type'];
            $message = $data['textareaMessageChat'];
            $sender_id = $data['sender_id'];
            $classified_id = $data['classifiedId'];
            $receiver_id = $data['receiver_id'];
            $messagetype = 'chat';


            $chattype = 'chat';
            $sendername = $senders['name'];

            if ($senders['image']) {
                $imgurl = \URL::asset('upload_images/users/' . $senders['id'] . '/' . $senders['image']);
            } elseif ($senders['avatar']) {
                $imgurl = $senders['avatar'];
            } else {
                $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
            }
            if (!empty($users['device_id'])) {

                if ($type == 'Android') {
                    $this->simplePushNotificationA($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $messagetype,$sendername);
                } else {
                    $this->simplePushNotificationI($message, $device_id, $chattype, $sender_id, $classified_id, $receiver_id, $sendername, $offer_price, $type, $messagetype);
                }
            } else {
                $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $sendername, $messagetype, $imgurl);
            }
            return response()->json(['status' => true, 'result' => $result]);
        } else {
            return response()->json(['status' => false, 'result' => '']);
        }
    }

    /**
     *  chatmessageapi
     * chatmessageapi
     *
     * @return response
     * @access public
     */
    public function chatmessageapi(Request $request) {

        $offer_price = NULL;
        if ($request->isMethod('post')) {

            $sender_id = $request->user_id;
            $receiver_id = $request->chatuser_id;
            $classified_id = $request->classifiedid;
            $message = $request->message;


            if (!empty($sender_id) && !empty($receiver_id) && !empty($classified_id) && !empty($message)) {
                $dataArray = $this->model;
                $dataArray->sender_id = $sender_id;
                $dataArray->receiver_id = $receiver_id;
                $dataArray->classified_id = $classified_id;
                $dataArray->massage = $message;
                $dataArray->flag = 'chat';
                $dataArray->subject = 'Make an Offer';
                $messagetype = 'chat';
                $data = $dataArray->create($dataArray->toarray());
                $now = new DateTime();
                $now->format('Y-m-d H:i:s');
                $currentdatetime = $now->getTimestamp();
                if ($data->id) {
                    $senmessage = array(
                        'userid' => $sender_id,
                        'massage' => $message,
                        'msg_time' => $currentdatetime,
                    );

                    $users = User::select('id', 'name', 'email', 'device_id', 'device_type')->where(['id' => $receiver_id])->first()->toarray();
                    $senders = User::select('id', 'name', 'email', 'device_id', 'device_type', 'image', 'avatar')->where(['id' => $sender_id])->first()->toarray();



                    $device_id = $users['device_id'];
                    $type = $users['device_type'];
                    $message = $message;
                    $sender_id = $sender_id;
                    $classified_id = $classified_id;
                    $receiver_id = $receiver_id;



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
                            $this->simplePushNotificationA($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $messagetype,$sendername);
                        } else {
                            $this->simplePushNotificationI($message, $device_id, $chattype, $sender_id, $classified_id, $receiver_id, $sendername, $offer_price, $type, $messagetype);
                        }
                    } else {
                        $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $sendername, $messagetype, $imgurl);
                    }
                    $result['status'] = 1;
                    $result['chatmessage'] = $senmessage;
                    $result['msg'] = 'Message sent successfully.';

                    echo json_encode($result);
                    die;
                } else {
                    $result['status'] = 0;
                    $result['msg'] = 'Message Not sent.';
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
    }

     /**
     *  delete_message_check
     * delete_message_check
     *
     * @return response
     * @access public
     */
    public function delete_message_check() {
        $data = Input::all();

        if ($data['index_type'] == 'archive_index') {
            $deleted_at = 2;
        } else {
            $deleted_at = 0;
        }
        foreach ($data['msg_id'] as $key => $value) {
            $dataArray = $this->model->select('id', 'sender_id', 'receiver_id', 'classified_id')->where(['id' => $value])->first()->toarray();
            $authId = Auth::guard('web')->user()->id;

            $result = $this->model->select(DB::update("update messages set deleted_at = $deleted_at, deleted_by = concat(deleted_by,if(deleted_by='','',','),$authId) "
                            . " where classified_id = " . $dataArray['classified_id'] . " "
                            . " and ((sender_id = " . $dataArray['sender_id'] . " and receiver_id = " . $dataArray['receiver_id'] . ") "
                            . "or (receiver_id = " . $dataArray['sender_id'] . " and sender_id = " . $dataArray['receiver_id'] . "))"));
        }
    }

    /**
     *  deletenomsg
     * deletenomsg
     *
     * @return response
     * @access public
     */
    public function deletenomsg(Request $request) {


        $data = Input::all();

        $id = $data['id'];

        if (!empty($id)) {

            \DB::table('notification')->delete($id);

            return response()->json(['status' => true, 'url' => 'messages/allnotifications']);
        }

    }
     /**
     *  simplePushNotificationAndroid
     * simplePushNotificationA
     *
     * @return response
     * @access public
     */
    public static function simplePushNotificationA($message = NULL, $device_id = NULL, $type = NULL, $senderId = NULL, $classified_id = NULL, $receiver_id = NULL, $messagetype = NULL,$sendername=NULL) {

        $registrationIds = array($device_id);

        // prep the bundle
        $msg = array
            (
            'message' => $message,
            'sender_id' => $senderId,
            'classified_id' => $classified_id,
            'chatuser_id' => $receiver_id,
            'subject' => $messagetype,
                 'senderName' => $sendername,
        );

        $attachmentData[] = array(
            'sender_id' => $senderId,
            'receiver_id' => $receiver_id,
            'massage' => $message,
            'classified_id' => $classified_id,
            'deviceid' => $device_id,
            'devicename' => $type,
            'subject' => $messagetype,
        );
        \DB::table('notification')->insert($attachmentData);
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
            return 0;
        else
            return 1;
        exit;
    }
    
     /**
     *  test
     * test
     *
     * @return response
     * @access public
     */
    public function testpuchiphone(Request $request) {
        $sender_id = $request->user_id;
        $receiver_id = $request->chatuser_id;
        $classified_id = $request->classifiedid;
        $message = $request->message;
        $device_id = 'fd2d289a9083509d80a6120456d92bb32b1301be5eec24b296400aefd3fdba56';
        $type = 'abc';

        $this->simplePushNotificationI($message, $device_id, $type, $sender_id, $classified_id, $receiver_id);
    }
 /**
     *  simplePushNotificationiphone
     * simplePushNotificationiphone
     *
     * @return response
     * @access public
     */
    
    public static function simplePushNotificationI($msg = NULL, $device_id = NULL, $type = NULL, $senderId = NULL, $classified_id = NULL, $receiver_id = NULL, $sendername = NULL, $offermessage = NULL, $deivicetype = NULL, $messagetype = NULL) {
        $now = new DateTime();
        $now->format('Y-m-d H:i:s');
        $currentdatetime = $now->getTimestamp();
        $passphrase = '12345';

        if (!empty($offermessage)) {
            $message = $sendername . ' has offered you!';
        } else {
            $message = $sendername . ' has sent a message!';
        }
        $attachmentData[] = array(
            'sender_id' => $senderId,
            'receiver_id' => $receiver_id,
            'massage' => $msg,
            'classified_id' => $classified_id,
            'deviceid' => $device_id,
            'devicename' => $deivicetype,
            'subject' => $messagetype,
        );
        \DB::table('notification')->insert($attachmentData);
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'Certificates.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

         $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
            return 0;

        $body['aps'] = array(
            'alert' => $message,
            'type' => $type,
            'sender_id' => $senderId,
            'massage' => $msg,
            'classified_id' => $classified_id,
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
     *  simplePushNotificationwindow
     * simplePushNotificationwindow
     *
     * @return response
     * @access public
     */
    public static function simplePushNotificationW($msg = NULL, $device_id = NULL, $type = NULL, $senderId = NULL, $classified_id = NULL, $receiver_id = NULL, $sendername = NULL, $messagetype = NULL, $imageurl = NULL) {
        $now = new DateTime();
        $now->format('Y-m-d H:i:s');
        $currentdatetime = $now->getTimestamp();

        $redis = Redis::connection();
        $data = ['msg' => $msg, 's_id' => $senderId, 'r_id' => $receiver_id, 'classified_id' => $classified_id, 'name' => $sendername, 'image' => $imageurl, 'type' => $messagetype, 'time' => $currentdatetime];
        $redis->publish('message', json_encode($data));



        $message = $sendername . ' has sent a message!';
        $attachmentData[] = array(
            'sender_id' => $senderId,
            'receiver_id' => $receiver_id,
            'massage' => $msg,
            'classified_id' => $classified_id,
            'deviceid' => '',
            'devicename' => 'web',
            'subject' => $messagetype,
        );
        $result = \DB::table('notification')->insert($attachmentData);

        if (!$result)
            return 0;
        else
            return 1;
        exit;
    }

     /**
     *  test
     * test
     *
     * @return response
     * @access public
     */
    public static function simplePushNotificationW1($msg = NULL, $device_id = NULL, $type = NULL, $senderId = NULL, $classified_id = NULL, $receiver_id = NULL, $sendername = NULL, $messagetype = NULL, $imageurl = NULL) {
        $now = new DateTime();
        $now->format('Y-m-d H:i:s');
        $currentdatetime = $now->getTimestamp();

        $redis = Redis::connection();
        $data = ['msg' => $msg, 's_id' => $senderId, 'r_id' => $receiver_id, 'classified_id' => $classified_id, 'name' => $sendername, 'image' => $imageurl, 'type' => $messagetype];
        $redis->publish('message', json_encode($data));



        $message = $sendername . ' has sent a message!';

        return 1;
        exit;
    }

}
