<?php

namespace App\Http\Controllers\admin;

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


class NotificationController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->modelTitle = 'User';
        $this->model = new User;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function userlistnotification(Request $request) {
        $requestArr = Input::all();

        if (!empty($requestArr['status'])) {

            if ($requestArr["status"] == 'Android') {
                $data = DB::table('users')->where('device_type', '=', 'Android')->where('role_id', '=', 0);
            } else if ($requestArr["status"] == 'Iphone') {
                $data = DB::table('users')->where('device_type', '=', 'iphone')->where('role_id', '=', 0);
            } else if ($requestArr["status"] == 'Web') {

                $data = DB::table('users')->where('role_id', '=', 0)->where('device_type', '=', 'NA')->orWhere('device_type', '=', '');
            } else {
                $data = DB::table('users')->where('role_id', '=', 0);
            }

        }

        $users = $data->where('role_id', '=', 0)->orderBy('id', 'DESC')->get();
        return view('admin/users/notificationdata', compact('users', 'requestVal'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_notification(Request $request) {
        $requestArr = Input::all();
        $requestVal = array();
        $requestVal = '';
        if (!empty($requestArr)) {

            foreach ($requestArr as $key => $value) {
                if (!in_array($key, ['_token', 'form_search', 'page', 'sort', 'direction', 'status'])) {
                    $data = $this->model->where($key, 'LIKE', "%{$value}%");
                }
                $requestVal[$key] = $value;
            }
            if (!empty($requestArr['status'])) {

                if ($requestArr["status"] == 'Android') {
                    $data = DB::table('users')->where('device_type', '=', 'Android')->where('role_id', '=', 0);
                } else if ($requestArr["status"] == 'Iphone') {
                    $data = DB::table('users')->where('device_type', '=', 'iphone')->where('role_id', '=', 0);
                } else if ($requestArr["status"] == 'Web') {

                    $data = DB::table('users')->where('role_id', '=', 0)->where('device_type', '=', 'NA')->orWhere('device_type', '=', '');
                } else {
                    $data = DB::table('users')->where('role_id', '=', 0);
                }

            } else {
                $data = DB::table('users');
            }
            $users = $data->where('role_id', '=', 0)->orderBy('id', 'DESC')->paginate(20);
        } else {
            $users = DB::table('users')->where('role_id', '=', 0)->orderBy('id', 'DESC')->paginate(20);
        }
        return view('admin/users/notification', compact('users', 'requestVal'));
    }

    /**
     *  usernotification
     * usernotification
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
     *  usernotification
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
     *  simplePushNotificationAndroid
     * simplePushNotificationA
     *
     * @return response
     * @access public
     */
    public static function simplePushNotificationA($message = NULL, $device_id = NULL, $type = NULL, $sender_id = NULL, $categoryid = NULL, $receiver_id = NULL, $messagetype = NULL) {
        $registrationIds = array($device_id);
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
     *  simplePushNotificationiphone
     * simplePushNotificationiphone
     *
     * @return response
     * @access public
     */
    public static function simplePushNotificationI($msg = NULL, $device_id = NULL, $chattype = NULL, $sender_id = NULL, $categoryid = NULL, $receiver_id = NULL, $sendername = NULL, $type = NULL, $messagetype = NULL) {
        $passphrase = '12345';

        $message = $msg;


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
     *  simplePushNotificationwindow
     * simplePushNotificationwindow
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

}
