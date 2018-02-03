<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\SubscriberList;
use Hash;
use DB;
use Mail;
use App\Event;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;


class SubscriberListsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'subscriber_lists';
        $this->viewName = 'subscriber_lists';
        $this->modelTitle = 'Subscriber List';
        $this->model = new SubscriberList;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     * indexing of all subscribers
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
        $requestVal = '';
        if (!empty($requestArr)) {
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, ['_token', 'form_search', 'page', 'sort', 'direction'])) {
                    $this->model = $this->model->where($key, 'LIKE', "%{$value}%");
                }
                $requestVal = $value;
            }
            if(!empty($requestArr["sort"])) {
                $this->model = $this->model->orderBy($requestArr["sort"], $requestArr["direction"]);
            }
            $data = $this->model->orderBy('id','DESC')->paginate(10);
        } else {
            $data = $this->model->paginate(10);
        }
        
        $data->setPath('')->appends(Input::query())->render();
    	return view('admin/' . $this->viewName . '/index', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'data'));
    }

    /**
     * Admin delete
     * delete subscriber
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
            return response()->json(['status' => true, 'url' => 'subscriber-lists']);
        }
    }

    /**
     * Unscribe
     * Unsubscribe the user when he/she clicks on the unsubscribe link
     *
     * @return void
     * @access public
     */
    public function unsubscribe($token = null) {
        //die("kk");
        
        $data = SubscriberList::where("token", "=", $token)
                    ->first();
        $email = $data->email;

        $update_status['status'] = 0;
        if (!empty($token)) {
            
            $this->model->where("token", $token)->update($update_status);
            DB::table('newsletter_subscribers')
                    ->where('email', $email)
                    ->update(['status' => 0]);
            return redirect('')->withSuccess("You are successfully unsubscribed.");
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
                DB::table('subscriber_lists')
                        ->where('id', $value)
                        ->update(['status' => $data['status']]);
            }
            return response()->json(['status' => true, 'url' => 'subscriber-lists']);
        }
    }

    /**
     * Admin Update Subscriber Status[Active / Inactive]
     * 
     *
     * @return void
     * @access public
     */
    public function admin_update_status(Request $request) {

        if ($request->isMethod('post')) {
            if($request->state == "true") {
                $updated_data["status"] = 1;
            } else {
                $updated_data["status"] = 0;
            }
            \DB::table('subscriber_lists')->where("id", $request->id)->update($updated_data);
        }
    }

    /**
     * subscribe
     * function for save subscribed user
     *
     * @return void
     * @access public
     */
    public function subscribe(Request $request) {
        if ($request->isMethod('post')) {

            $rules = [
                'email' => 'required | email | unique:subscriber_lists'
            ];
            $messages = [
                'email.required' => 'Please enter your email.',
                'email.email' => 'Please provide a valid email.',
                'email.unique' => 'You are already subscribed with us.'
            ];


            $validator = \Validator::make($request->all(), $rules, $messages);
            $this->validate($request, $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator]);
                die;
            }

            $data = new \App\models\SubscriberList;
            $data->email = Input::get('email');
            $data->status = 1;
            $data->token = str_random(60);
            
            if($data->save()) {
                return response()->json(['status' => true, 'message' => 'Thanks, you are successfully subscribed.']);
                die;
            } else {
                return response()->json(['status' => false, 'message' => 'Please try again.']);
                die;
            }
        }
    }
}
