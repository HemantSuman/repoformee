<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\Classified;
use App\models\Category;
use App\models\ClassifiedImage;
use App\models\Message;
use App\models\User;
use App\models\Attribute;
use App\models\Wishlist;
use App\models\Report;
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
use App\Classes\PrayTime;
use Illuminate\Support\Facades\Paginator;
use App\models\State;
use App\Url;
use DateTime;
use Cookie;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttributesController;
use App\Jobs\SendReminderEmail;
use LRedis;

class chatController extends Controller {

    /**
     * send message
     * send chat message
     *
     * @return response
     * @access public
     */
    public function sendMessage() {


        $redis = LRedis::connection();
        $data = Input::all();
        $data = ['msg' => $data['msg'], 's_id' => $data['s_id'], 'r_id' => $data['r_id'], 'classified_id' => $data['classified_id'], 'name' => '', image => ''];
        $redis->publish('message', json_encode($data));


        return response()->json($data);
    }

    public function testchat() {
        return view('front.classifieds.testchat');
    }

}
