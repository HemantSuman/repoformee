<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\Package as CURRENT_MODEL;
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

class PackagesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'packages';
        $this->viewName = 'packages';
        $this->modelTitle = 'Package';
        $this->model = new CURRENT_MODEL;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     * indexing of all packages
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
     * Admin add
     * function for create a packages
     *
     * @return void
     * @access public
     */
    public function admin_add($id = null) {
        
    }

    /**
     * Admin create
     * function for create a product
     *
     * @return void
     * @access public
     */
    public function admin_create(Request $request) {
        
    }

    /**
     * Admin edit
     * function for edit a product
     *
     * @return void
     * @access public
     */
//    public function admin_edit($id = null) {
    public function admin_edit(CURRENT_MODEL $id) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        $result = $id;
        return view('admin/' . $this->viewName . '/edit', compact('modelTitle', 'controllerName', 'actionName', 'result', 'viewName'));
    }

    /**
     * Admin update
     * function for update a category
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
            $timestampStartDate = strtotime(Input::get('start_date'));
            $dateAfter = $timestampStartDate ? date("m/d/Y", $timestampStartDate - 86400) : 'date';

            $this->validate($request, [
                'package_name' => 'required|unique:packages,package_name,' . +$id,
                'package_discription' => 'required',
                'package_price' => 'required|Numeric',
                'number_image_upload' => 'required|Numeric',
                'duration' => 'required|Numeric',
                    ]);

            $result = $this->model->updateAll($request, $id);

            if ($result) {
                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully submitted.');
                return response()->json(['status' => true, 'url' => '/admin/' . $viewName]);
            } else {
                Session::flash('alert-class', 'alert-warning');
                Session::flash('message', 'Something wrong, please try again.');
                return response()->json(['status' => false, 'url' => '/admin/' . $viewName]);
            }
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
