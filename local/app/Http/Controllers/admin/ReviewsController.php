<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
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
use Illuminate\Support\Facades\Paginator;
use App\Url;
use DateTime;
use Cookie;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttributesController;
use App\Jobs\SendReminderEmail;
use LRedis;

class ReviewsController extends Controller {

    public function __construct(Route $route, Request $request) {

        $this->viewName = 'reviews';
        $this->modelTitle = 'Reviews';
        $this->model = new Review;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     * indexing of all Groups created by admin
     *
     * @return void
     * @access public
     */
    public function admin_index($id = null) {
        $modelTitle = $this->modelTitle;
        $viewName = $this->viewName;
        $result = $this->model->Listing();
        return view('admin/' . $this->viewName . '/index', compact('result', 'modelTitle', 'viewName'));
    }

    /**
     * admin_view
     * admin_view review
     *
     * @return void
     * @access public
     */
    public function admin_view($id = null) {

        $modelTitle = $this->modelTitle;
        $viewName = $this->viewName;
        $result = $this->model->DetailView($id);
        $controllerName = $this->controllerName;
        return view('admin/' . $this->viewName . '/view', compact('result', 'modelTitle', 'viewName', 'controllerName'));
    }

    /**
     * admin_update
     * admin_update classifieds 
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

            $requestArr = Input::all();
            $data = $this->model->findOrFail($requestArr['id']);

            $data->status = 1;

            $data->save();

            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully submitted.');
            return response()->json(['status' => true, 'url' => '/admin/' . $viewName]);
        }
    }

    /**
     * Admin delete
     * function for delete a product
     *
     * @return void
     * @access public
     */
    public function admin_delete() {

        $viewName = $this->viewName;
        $id = Input::all()['id'];

        $result = $this->model->deleteAll($id);
        $result->attributes_groups()->detach();
        if ($result) {
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully Deleted.');
            return response()->json(['status' => true, 'url' => $viewName]);
        } else {
            Session::flash('alert-class', 'alert-warning');
            Session::flash('message', 'Something wrong, please try again.');
            return response()->json(['status' => false, 'url' => $viewName]);
        }
    }

    /**
     * admin_multi_check_options
     * admin_multi_check_options product 
     *
     * @return response
     * @access public
     */
    public function admin_multi_check_options() {

        $data = Input::all();

        if (!empty($data['checkedId'])) {
            foreach ($data['checkedId'] as $key => $value) {
                $request = ['status' => $data['status']];
                $this->model->updateRequestValue($request, $value);
            }
            return response()->json(['status' => true, 'url' => $this->viewName]);
        }
    }

}
