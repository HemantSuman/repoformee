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
     * admin_login
     * admin_login
     *
     * @return void
     * @access public
     */
    public function admin_login() {
        $cookie = Cookie::get('coupon');

        return view('admin/users/login')->with('cookie', $cookie);
    }

    /**
     * admin_forgot
     * admin_forgot
     *
     * @return void
     * @access public
     */
    public function admin_forgot() {
        return view('admin/users/forgot');
    }

    /**
     * admin_registeruserlist
     * admin_registeruserlist
     *
     * @return void
     * @access public
     */
    public function admin_registeruserlist(Request $request) {
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
            $users = $data->where('role_id', '=', 0)->orderBy('id', 'DESC')->paginate(20);
        } else {
            $users = DB::table('users')->where('role_id', '=', 0)->orderBy('id', 'DESC')->paginate(20);
        }
        return view('admin/users/registerindex', compact('users', 'requestVal'));
    }

    /**
     * admin_business_users
     * admin_business_users
     *
     * @return void
     * @access public
     */
    public function admin_business_users(Request $request) {
        $requestArr = Input::all();
        $requestVal = array();
        $requestVal = '';
		$currentDate = date('Y-m-d');
        if (!empty($requestArr)) {

        } else {
			
			$users = $this->model
			->with(['membership_user'=>function($query){
				$query->orderBy('id','desc');
				}])
			->where(['seller_type' => 'business', 'status' => '1'])
			->orderBy('id', 'DESC')
			->paginate(20);
			
        }
        return view('admin/users/businessindex', compact('users'));
    }

    /**
     * admin_userlist
     * admin_userlist
     *
     * @return void
     * @access public
     */
    public function admin_userlist(Request $request) {

        $requestArr = Input::all();
        $requestVal = '';
        if (!empty($requestArr)) {
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, ['_token', 'form_search', 'page', 'sort', 'direction'])) {
                    $this->model = $this->model->where($key, 'LIKE', "%{$value}%");
                }
                $requestVal = $value;
            }


            $users = $this->model->with('role_name')->where('role_id', '!=', 0)->orderBy('id', 'DESC')->paginate(5);
        } else {
            $users = $this->model->with('role_name')->where('role_id', '!=', 0)->orderBy('id', 'DESC')->paginate(5);
        }

        return view('admin/users/adminuserindex', compact('users'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * admin_edit
     * admin_edit
     *
     * @return void
     * @access public
     */
    public function admin_edit($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        if (isset($id)) {
            $user = $this->model->with('role_name')->where('role_id', '!=', 0)->where('id', '=', $id)->first();

            $role = Role::pluck('name', 'id');
        }

        return view('admin/' . $this->viewName . '/edit_admin', compact('modelTitle', 'user', 'role', 'controllerName', 'actionName', 'viewName'));
    }

    /**
     * admin_update_user_status
     * admin_update_user_status
     *
     * @return void
     * @access public
     */
    public function admin_update_user_status(Request $request) {

        if ($request->isMethod('post')) {
            if ($request->state == "true") {
                $updated_data["status"] = 1;
            } else {
                $updated_data["status"] = 0;
            }
            \DB::table('users')->where("id", $request->id)->update($updated_data);
            if ($updated_data["status"] == 0) {

                \DB::table('classifieds')->where("user_id", $request->id)->where("status", 1)->update($updated_data);
            } else {
                \DB::table('classifieds')->where("user_id", $request->id)->where("status", 0)->update($updated_data);
            }
            $role_name = $request->role_name;
            if (!empty($role_name)) {
                $roles_name = $role_name;
            } else {
                $roles_name = '';
            }
            $email = $request->email;
            $userdata = array(
                "name" => $request->name,
                "rolename" => $roles_name,
            );
            if ($updated_data["status"] == 0) {
                $result = Mail::send('emails.user_deactive', array('userdata' => $userdata), function($message) use ($email) {
                            $message->from('avinesh.mathur@planetwebsolution.com');
                            $message->to($email)->subject(" User Status");
                        }, true);
            }

            if ($updated_data["status"] == 1) {
                $result = Mail::send('emails.user_active', array('userdata' => $userdata), function($message) use ($email) {
                            $message->from('avinesh.mathur@planetwebsolution.com');
                            $message->to($email)->subject(" User Status");
                        }, true);
            }
        }
    }

    /**
     * admin_adduser
     * admin_adduser
     *
     * @return void
     * @access public
     */
    public function admin_adduser(Request $request) {

        $role = Role::pluck('name', 'id');

        return view('admin/users.add', compact('role'));
    }

    /**
     * admin_add_register_user
     * admin_add_register_user
     *
     * @return void
     * @access public
     */
    public function admin_add_register_user(Request $request) {

        return view('admin/users.add_register');
    }

    /**
     * admin_logincheck
     * admin_logincheck
     *
     * @return void
     * @access public
     */
    public function admin_logincheck(Request $request) {

        $response = new Response;
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|between:3,64|email',
            'password' => 'required|between:6,20',
        ]);

        $email = $request->email;
        $password = $request->password;

        $remember = $request->has('remember_token') ? true : false;
        $row = $this->model->with('role_name')->where("email", '=', $email)->where('role_id', '!=', 0)->first();
        if (!empty($row)) {
            $row->active_role_name = $row->role_name->name;
            $row->save();
        }

        if (!empty($row)) {
            if ($row->status == 0) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', 'Your Account Is Not Active.');
                return \Redirect('/admin/login');
            } else {
                if (Auth::guard('admin')->attempt([
                            'email' => $email,
                            'password' => $password,
                                ], $remember))
                    ;
                else {
                    Session::flash('alert-class', 'alert-danger');
                    Session::flash('message', 'Invalid Email or password.');
                    return \Redirect('/admin/login');
                }

                if ($remember) {
                    return redirect('admin/dashboard')->withCookie(cookie('coupon', $input, 3600));
                } else {
                    return redirect('admin/dashboard');
                }
            }
        } else {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('message', 'Invalid Details.');
            return \Redirect('/admin/login');
        }
    }

    /**
     * admin_test
     * admin_test
     *
     * @return void
     * @access public
     */
    public function admin_test() {

        $result = User::with(["permission_role" => function ($detail) {
                        $detail->with("permission");
                    }])->with('role_name')->get();
        dd($result->toarray());
        $user = User::where('email', '=', $email)->first();
    }

    /**
     * admin_forgotcheck
     * admin_forgotcheck
     *
     * @return void
     * @access public
     */
    public function admin_forgotcheck(Request $request) {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|between:3,64|email',
        ]);
        $email = $request->email;
        $_token = $request->_token;

        $user = User::where('email', '=', $email)->first();


        if (!empty($user)) {

            $user2 = array(
                'name' => $user->name,
                'email' => $email,
                '_token' => $_token,
            );
            $user->_token = $_token;

            $user->save();

            $result = Mail::send('emails.forgotpassword', array('users' => $user2), function($message) {
                        $message->from('avinesh.mathur@planetwebsolution.com');
                        $message->to(Input::get('email'))->subject('forgot password link');
                    });
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Please Check Your Mail. Your Forgot Password Link sent Successfully.');
        } else {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('message', 'Please Check Your Email. This Email Does Not Exist ');
        }
        return view('/admin/users/forgot');
    }

    /**
     * admin_dashboard
     * admin_dashboard
     *
     * @return void
     * @access public
     */
    public function admin_dashboard() {
        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        $s_date = date("Y-m-d");
        $userClassifiedObj = new Classified;
        $userMessageObj = new Message;
        $queryobj = new Query;
        $logged_in_adminuser_id = Auth::guard('admin')->user()->id;

        $total_active_classifieds = $userClassifiedObj->where('status', '=', 1)->orwhere('classifieds.status', '=', 0)->orderBy('id', 'desc')->count();

        $total_messages = \DB::table("queries")->count();

        $unique_visitors = \DB::table('site_visitors')->count();
        $registered_user = \DB::table('users')->where('role_id', '=', 0)->count();
        $recentusers = $this->model->where('role_id', '=', 0)->orderBy('id', 'DESC')->paginate(5);
        $recentclassifids = Category::select(DB::raw(
                                        'classifieds.id as id,'
                                        . 'classifieds.title as title,'
                                        . 'classifieds.status as status,'
                                        . 'classifieds.featured_classified as featured_classified,'
                                        . 'classifieds.start_date as start_date,'
                                        . 'classifieds.created_at as created_at,'
                                        . 'categories.name as category_name,'
                                        . 'child_cat.name as cat_c_name,'
                                        . 'users.name as username,'
                                        . 'categories.name as `aggregate`'))
                        ->rightjoin('classifieds', 'categories.id', '=', 'classifieds.parent_categoryid')
                        ->leftjoin('categories as child_cat', 'classifieds.category_id', '=', 'child_cat.id')
                        ->leftjoin('users', 'classifieds.user_id', '=', 'users.id')
                        ->orderBy('id', 'DESC')
                        ->where(function($q1) {
                            $q1->where('classifieds.status', '=', 1)
                            ->orwhere('classifieds.status', '=', 0);
                        })->paginate(5);

        $recenqueries = $queryobj->orderBy('id', 'DESC')->paginate(5)->unique('email');

        return view('admin/users/index', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'total_active_classifieds', 'total_messages', 'unique_visitors', 'registered_user', 'recentclassifids', 'recenqueries', 'recentusers'));
    }

    /**
     * admin_verify
     * admin_verify
     *
     * @return void
     * @access public
     */
    public function admin_verify($confirmation_code) {


        return view('admin/users/set_forgot_password', compact('confirmation_code'));
    }

    /**
     * admin_verifycheck
     * admin_verifycheck
     *
     * @return void
     * @access public
     */
    public function admin_verifycheck(Request $request) {

        $this->validate($request, [
            'password' => 'required|between:6,20',
            'confirm_password' => 'required|same:password'
        ]);
        $confirmation_code = $request->confirmation_code;
        if (!$confirmation_code) {
            throw new InvalidConfirmationCodeException;
        }

        $password = $request->password;
        $password = Hash::make($password);

        DB::table('users')
                ->where('_token', $confirmation_code)
                ->update(['_token' => '', 'password' => $password]);


        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'Password updated successfully!');
        return redirect('/admin/login');
    }

    /**
     * admin_logout
     * admin_logout
     *
     * @return void
     * @access public
     */
    public function admin_logout() {

        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function api() {
        dd('yesssss');
    }

    /**
     * admin_createuser
     * admin_createuser
     *
     * @return void
     * @access public
     */
    public function admin_createuser(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:6,20',
            'mobile_no' => 'numeric|min:10',
            'role_id' => 'required',
                ], [
            'role_id.required' => 'Role Name is required.',
        ]);
        $requestArr = Input::all();
        $exceptFields = ['_token', 'password'];
        $data = new User();
        foreach ($requestArr as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $data->$key = $value;
            }
        }

//check whether email is requested by other person to for updation or not
        $checkReqst = $this->model->where("new_requested_email", "=", $request->email)->first();
        if ($checkReqst) {
            return Redirect::back()->withInput()->withDanger('Can not use the email. Email already requested by someone for update. Please provide another.');
        }

        $roledata = Role::where("id", "=", Input::get('role_id'))->first();

        $rolename = $roledata->name;
        $data->status = 1;
        $data->password = Hash::make(Input::get('password'));

        if ($data->save()) {
            $email = Input::get('email');
            $userdata = array(
                "name" => Input::get('name'),
                "email" => Input::get('email'),
                "password" => Input::get('password'),
                "rolename" => $rolename,
            );
            $result = Mail::send('emails.admin_registeration', array('userdata' => $userdata), function($message) use ($email) {
                        $message->from('avinesh.mathur@planetwebsolution.com');
                        $message->to($email)->subject(" Admin User Registration");
                    }, true);
// }

            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'User added successfully.');

            return Redirect::to('/admin/admin_user/');
        } else {
            return Redirect::back()->withDanger('User could not be added. Please try again.');
        }
    }

    /**
     * admin_changeemail
     * admin_changeemail
     *
     * @return void
     * @access public
     */
    public function admin_changeemail(Request $request) {

        $this->validate($request, [
            'new_email' => 'required|email',
        ]);
        $requestArr = Input::all();
        $new_email = $request->new_email;
        $logged_in_user_id = $request->user_id;
        $checkReqst = $this->model->where("email", "=", $new_email)->orWhere('new_requested_email', '=', $new_email)->first();
        if ($checkReqst) {
            Session::flash('alert-class', 'alert-danger alert-dismissible');
            Session::flash('message', 'Can not use the email. Email already requested by someone for update. Please provide another..');
            return Redirect::to('admin/settings');
        } else {

            $updateStatus = $this->model->where("id", $logged_in_user_id)->update(array('email' => $new_email));
            Session::flash('alert-class', 'alert-success alert-dismissible');
            Session::flash('message', 'Successfully submitted.');
            return Redirect::to('admin/settings');
        }
    }

    /**
     * admin_changpassword
     * admin_changpassword
     *
     * @return void
     * @access public
     */
    public function admin_changpassword(Request $request) {

        $this->validate($request, [
            'new_password' => 'required|between:6,20',
            'confirm_new_password' => 'required|same:new_password'
        ]);
        $requestArr = Input::all();

        $current_password = $request->current_password;
        $checkcurrentpassword = $request->checkcurrentpassword;
        $logged_in_user_id = $request->user_id;
        $new_password = $request->new_password;
        if (!Hash::check($current_password, $checkcurrentpassword)) {
            Session::flash('alert-class', 'alert-danger alert-dismissible');
            Session::flash('message', 'Please check your current password');
            return Redirect::to('admin/settings');
        } else {
            $new_passwordenc = Hash::make($new_password);
            $updateStatus = $this->model->where("id", $logged_in_user_id)->update(array('password' => $new_passwordenc));
            Session::flash('alert-class', 'alert-success alert-dismissible');
            Session::flash('message', 'Successfully Updated.');
            return Redirect::to('admin/settings');
        }
    }

    /**
     * admin_create_register_user
     * admin_create_register_user
     *
     * @return void
     * @access public
     */
    public function admin_create_register_user(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile_no' => 'alpha_dash|min:10',
            'password' => 'required|between:6,20',
        ]);



        $requestArr = Input::all();
        $exceptFields = ['_token', 'password'];
        $data = new User();
        foreach ($requestArr as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $data->$key = $value;
            }
        }
        $password = Input::get('password');
        $data->password = Hash::make(Input::get('password'));
//check whether email is requested by other person to for updation or not
        $checkReqst = $this->model->where("new_requested_email", "=", $request->email)->first();
        if ($checkReqst) {
            return Redirect::back()->withInput()->withDanger('Can not use the email. Email already requested by someone for update. Please provide another.');
        }

        $data->status = 1;
        if ($data->save()) {
            $email = Input::get('email');
            $rolename = '';
            $userdata = array(
                "name" => Input::get('name'),
                "email" => Input::get('email'),
                "password" => $password,
                "rolename" => $rolename,
            );

            $result = Mail::send('emails.admin_registeration', array('userdata' => $userdata), function($message) use ($email) {
                        $message->from('avinesh.mathur@planetwebsolution.com');
                        $message->to($email)->subject("User Registration");
                    }, true);
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Add Register User successfully.');
            return Redirect::to('/admin/register_user/');
        } else {
            return Redirect::back()->withDanger('User could not be added. Please try again.');
        }
    }

    /**
     * admin_update
     * admin_update
     *
     * @return void
     * @access public
     */
    public function admin_update(Request $request, $id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        if ($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'required',
                'mobile_no' => 'alpha_dash|min:10',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'sometimes|between:6,20',
                'role_id' => 'required',
                    ], [
                'role_id.required' => 'Role Name is required.',
            ]);



            $requestArr = Input::all();
            $exceptFields = ['_token', 'password'];

            $data = $this->model->findOrFail($id);
            $checkReqst = $this->model->where("new_requested_email", "=", $request->email)->first();
            if ($checkReqst) {
                Session::flash('alert-class', 'alert-danger alert-dismissible');
                Session::flash('message', 'Can not use the email. Email already requested by someone for update. Please provide another..');
                return Redirect::to('/admin/admin_user/');
            }
            $password_edit = 0;
            $password = '';
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }
            if (isset($request->password)) {
                $newpassword = $request->password;
                $oldpassword = $data->password;
                if ($newpassword == $oldpassword) {

                    $data->password = $oldpassword;
                    $password = '';
                } else {
                    $password_edit = 1;
                    $data->password = Hash::make($newpassword);
                    $password = $newpassword;
                }
            }

            if (!isset($request->status) && $request->status != 1) {
                $data->status = 0;
            }

            $data->save();
            if ($password_edit == 1) {
                $email = Input::get('email');
                $userdata = array(
                    "name" => Input::get('name'),
                    "password" => $password,
                );

                $result = Mail::send('emails.admin_updateregisteration', array('userdata' => $userdata), function($message) use ($email) {
                            $message->from('avinesh.mathur@planetwebsolution.com');
                            $message->to($email)->subject(" Admin Registration");
                        }, true);
            }

            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully submitted.');
            return Redirect::to('/admin/admin_user/');
        }
    }

    /**
     * adminregister_update
     * adminregister_update
     *
     * @return void
     * @access public
     */
    public function adminregister_update(Request $request, $id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'required',
                'password' => 'sometimes',
                'email' => 'required|email|unique:users,email,' . $id,
                'mobile_no' => 'alpha_dash|min:10',
            ]);



            $requestArr = Input::all();
            $exceptFields = ['_token', 'password'];

            $data = $this->model->findOrFail($id);
            $password_edit = 0;
            $password = '';

            $checkReqst = $this->model->where("new_requested_email", "=", $request->email)->first();
            if ($checkReqst) {
                Session::flash('alert-class', 'alert-danger alert-dismissible');
                Session::flash('message', 'Can not use the email. Email already requested by someone for update. Please provide another..');
                return Redirect::to('/admin/register_user/');
            }
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if (isset($request->password)) {
                $newpassword = $request->password;
                $oldpassword = $data->password;
                if ($newpassword == $oldpassword) {

                    $data->password = $oldpassword;
                    $password = '';
                } else {
                    $password_edit = 1;
                    $password = $newpassword;
                    $data->password = Hash::make($newpassword);
                }
            }
            if (!isset($request->status) && $request->status != 1) {
                $data->status = 0;
            }
            $data->save();
            if ($password_edit == 1) {
                $email = Input::get('email');
                $userdata = array(
                    "name" => Input::get('name'),
                    "password" => $password,
                );

                $result = Mail::send('emails.admin_updateregisteration', array('userdata' => $userdata), function($message) use ($email) {
                            $message->from('avinesh.mathur@planetwebsolution.com');
                            $message->to($email)->subject(" Update Registration");
                        }, true);
            }

            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully submitted.');
            return Redirect::to('/admin/register_user/');
        }
    }
    
    
    public function adminbusiness_update(Request $request, $id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required',
                'password' => 'sometimes',
                'email' => 'required|email|unique:users,email,' . $id,
                'mobile_no' => 'alpha_dash|min:10',
            ]);

            $requestArr = Input::all();
            $exceptFields = ['_token', 'password'];

            $data = $this->model->findOrFail($id);
            $password_edit = 0;
            $password = '';

            $checkReqst = $this->model->where("new_requested_email", "=", $request->email)->first();
            if ($checkReqst) {
                Session::flash('alert-class', 'alert-danger alert-dismissible');
                Session::flash('message', 'Can not use the email. Email already requested by someone for update. Please provide another..');
                return Redirect::to('/admin/business_user/');
            }
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if (isset($request->password)) {
                $newpassword = $request->password;
                $oldpassword = $data->password;
                if ($newpassword == $oldpassword) {

                    $data->password = $oldpassword;
                    $password = '';
                } else {
                    $password_edit = 1;
                    $password = $newpassword;
                    $data->password = Hash::make($newpassword);
                }
            }
            if (!isset($request->status) && $request->status != 1) {
                $data->status = 0;
            }
            $data->save();
            if ($password_edit == 1) {
                $email = Input::get('email');
                $userdata = array(
                    "name" => Input::get('name'),
                    "password" => $password,
                );

                $result = Mail::send('emails.admin_updateregisteration', array('userdata' => $userdata), function($message) use ($email) {
                            $message->from('avinesh.mathur@planetwebsolution.com');
                            $message->to($email)->subject(" Update Registration");
                        }, true);
            }

            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully submitted.');
            return Redirect::to('/admin/business_users/');
        }
    }

    /**
     * admin_delete
     * admin_delete
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
            $classi = DB::table('classifieds')->where(['user_id' => $id])->first();
            if (!empty($classi)) {
                Session::flash('alert-class', 'alert-warning');
                Session::flash('message', 'First delete all the classifieds of this user.');
                return response()->json(['status' => true, 'url' => 'admin_user']);
            }

            $result->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully Deleted.');
            return response()->json(['status' => true, 'url' => 'admin_user']);
        }
    }

    /**
     * admin_delete_registeruser
     * admin_delete_registeruser
     *
     * @return response
     * @access public
     */
    public function admin_delete_registeruser() {

        $viewName = $this->viewName;
        $data = Input::all();
        $id = $data['id'];

        if (!empty($id)) {

            $result = $this->model->findOrFail($id);

            $classi = DB::table('classifieds')->where(['user_id' => $id])->first();
            if (!empty($classi)) {
                Session::flash('alert-class', 'alert-warning');
                Session::flash('message', 'First delete all the classifieds of this user.');
                return response()->json(['status' => true, 'url' => 'register_user']);
            }

            $result->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully Deleted.');
            return response()->json(['status' => true, 'url' => 'register_user']);
        }
    }

    /**
     * register_edit
     * register_edit
     *
     * @return void
     * @access public
     */
    public function register_edit($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
//dd($id);
        if (isset($id)) {
            $user = $this->model->where('role_id', '=', 0)->where('id', '=', $id)->first();

            $role = Role::pluck('name', 'id');
        }

        return view('admin/' . $this->viewName . '/edit_register', compact('modelTitle', 'user', 'role', 'controllerName', 'actionName', 'viewName'));
    }

    /**
     * register_edit
     * register_edit
     *
     * @return void
     * @access public
     */
    public function business_edit($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        if (isset($id)) {
            $user = $this->model
			->with(['membership_user'=>function($query){
				$query->orderBy('id','desc');
				}])
			->where(['seller_type' => 'business'])->where('id', '=', $id)->first();
        }
		
		$membership_plan = $user->membership_user->toArray();
		if(isset($membership_plan) && count($membership_plan) > 0){
			$membership_plan_data = $membership_plan[0];
				$pp_profileid = $membership_plan_data['paypal_profile_id'] ;
					if($pp_profileid != ''){
						$provider = new ExpressCheckout; 
						$pp_profile_response = $provider->getRecurringPaymentsProfileDetails($pp_profileid);
					}else{
						$pp_profile_response = '';	
					}
		}else{
			$pp_profile_response = '';
		}
		
        return view('admin/' . $this->viewName . '/edit_business', compact('modelTitle', 'user', 'controllerName', 'actionName', 'viewName', 'pp_profile_response'));
    }

    /**
     * admin_business_plans
     * function for get plans of user
     *
     * @return void
     * @access public
     */
    public function admin_business_plans($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        
        $membership = new MembershipPlanUser;
        $result = $membership->where(['status' => 1, 'user_id' => $id])->orderBy('id','desc')->get();
        return view('admin/' . $this->viewName . '/business_plans', compact('modelTitle', 'controllerName', 'actionName', 'result', 'viewName'));
    }
	
	
	
 /**
     * cancel_pp_profile
     * cancel PayPAl Profile
     *
     * @return void
     * @access public
     */
	public function cancel_pp_profile(Request $request){
		$user_id = $request->userid;
		
		
		if (isset($request->cancel_pp)){
			$profileid = $request->profileid;
			
				$provider = new ExpressCheckout; 
				$pp_profile_response = $provider->cancelRecurringPaymentsProfile($profileid);
				
				
				if($pp_profile_response['ACK'] == 'Success'){
					$values = array('paypal_profile_status'=>'Cancelled');
					DB::table('membership_plan_users')->where(['user_id'=>$user_id])->update($values);
					
				Session::flash('type', 'success');
            	Session::flash('message', 'You membership profile has Successfully Updated.');

					return redirect("/admin/users/business_edit/$user_id");
			
				}else{
					
						
				Session::flash('alert-class', 'alert-warning');
            	Session::flash('message', 'Something wrong, please try again.');

				return redirect("/admin/users/business_edit/$user_id");
					
				}
			
		}
		
	}
}
