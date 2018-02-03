<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\Query;
use App\models\QueryRespond;
use Hash;
use DB;
use Mail;
use App\Event;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Validator;
use App\Helpers\Helper;

class QueriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'queries';
        $this->viewName = 'queries';
        $this->modelTitle = 'Query';
        $this->model = new Query;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     * indexing of all queries posted by the users
     *
     * @return void
     * @access public
     */
    public function admin_index($id = null) {
        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $requestArr = Input::all();
        $requestVal = '';
        if (!empty($requestArr)) {
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, ['_token', 'form_search', 'page'])) {
                    $this->model = $this->model->where($key, 'LIKE', "%{$value}%");
                }
                $requestVal = $value;
            }
            if(!empty($requestArr["type"])) {
                $this->model->where("type", "=", $requestArr["type"]);
            }

            $data = $this->model->orderBy('id','DESC')->get()->unique('email');
        } else {
            $data = $this->model->orderBy('id', 'desc')->get()->unique('email');
        }
        
        return view('admin/' . $this->viewName . '/index', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'data', 'requestVal'));
    }

    /**
     * Admin Chat
     * Chat between admin and selected user
     *
     * @return void
     * @access public
     */
    public function admin_chat($id = null, Request $request) {
        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $requestArr = Input::all();
        $requestVal = '';
        
        $email = $this->model->where('id', '=', $id)->select("email")->first();
        $data = $this->model->where('email', '=', $email->email)->with('query_respond')->get();

        $this->model->where('email', $email->email)->update(['status' => 1]);
        return view('admin/' . $this->viewName . '/chat', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'data'));
    }

    /**
     * Admin Chat
     * Chat between admin and selected user
     *
     * @return void
     * @access public
     */
    public function admin_query_respond(Request $request) {
        
        //dd($request->all());
        $this->validate($request, [
            'respond' => 'required'
        ], [
            'respond.required' => 'This field cannot be left blank.'
        ]);

        $data = new \App\models\QueryRespond;
        $data->query_id = $query_id = Input::get('query_id');
        $data->respond = $query_response = Input::get('respond');

        if($data->save()) {
            $recieverEmail = $this->model->where('id', '=', $query_id)->first();
            Mail::send('emails.contact_query_response_template_for_user', array('query_response' => $query_response), function($message) use ($recieverEmail) {
                            $message->to($recieverEmail->email)->subject("Query Response");
                        }, true);

            return \Redirect('admin/queries/chat/' . $query_id);
            return \Redirect::back();
        } else {
            return \Redirect('admin/queries/chat/' . $query_id)->withDanger( ' Please try again.' );
        }
    }
}
