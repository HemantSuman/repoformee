<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\MembershipPlan;
use App\models\Role;
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

class MembershipPlansController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'membership_plans';
        $this->viewName = 'membership_plans';
        $this->modelTitle = 'Membership Plan';
        $this->model = new MembershipPlan;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     * indexing of all MembershipPlans
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
     * function for create a MembershipPlans
     *
     * @return void
     * @access public
     */
    public function admin_add($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $roles = new Role();
        $roles = $roles->Listing(['role_type' => 'front']);

        return view('admin/' . $this->viewName . '/add', compact('roles', 'modelTitle', 'controllerName', 'actionName', 'viewName'));
    }

    /**
     * Admin create
     * function for create a product
     *
     * @return void
     * @access public
     */
    public function admin_create(Request $request) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        if ($request->isMethod('post')) {
            $timestampStartDate = strtotime(Input::get('start_date'));
            $dateAfter = $timestampStartDate ? date("m/d/Y", $timestampStartDate - 86400) : 'date';
            $this->validate($request, [
                'plan_name' => 'required|unique:membership_plans',
                'plan_type' => 'required',
                'role_id' => 'required',
                'plan_price' => 'required|numeric',
                'display_order' => 'integer|between:1,3',
                'job_post_count' => 'required_if:is_job_post,==,1|numeric|min:1',
                'number_image_upload' => 'sometimes|integer|min:5',
                'featured_ads_type' => 'required_if:is_featured_ads,==,1',
                'featured_ads_count' => 'required_if:is_featured_ads,==,1|numeric|min:1',
                    ], [
                'job_post_count.required_if' => 'No. of Job Posts is required.',
                'job_post_count.numeric' => 'No. of Job Posts should be numeric.',
                'job_post_count.min' => 'Minimum 1 No. of Job Posts is required.',
                'featured_ads_type.required_if' => 'Featured Ads Type is required.',
                'featured_ads_count.required_if' => 'Featured Ads is required.',
                'featured_ads_count.numeric' => 'Featured Ads should be numeric.',
                'featured_ads_count.min' => 'Minimum 1 Featured Ads is required.',
            ]);
            $countWithRole = $this->model->where(['role_id' => $request['role_id']])->count();
            if ($countWithRole >= 3) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', 'You have already added maximum plans for this user type.');
                return response()->json(['status' => false, 'url' => '/admin/' . $viewName]);
            }
            $result = $this->model->saveAll($request);

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
     * Admin edit
     * function for edit a product
     *
     * @return void
     * @access public
     */
    public function admin_edit($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        $result = $this->model->getFirstValue($id);
        $roles = new Role();
        $roles = $roles->Listing(['role_type' => 'front']);
        return view('admin/' . $this->viewName . '/edit', compact('roles', 'modelTitle', 'controllerName', 'actionName', 'result', 'viewName'));
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

            $this->validate($request, [
                'plan_name' => 'required|unique:membership_plans,plan_name,' . $id,
                'plan_type' => 'required',
                'role_id' => 'required',
                'plan_price' => 'required',
                'display_order' => 'integer|between:1,3',
                'number_image_upload' => 'sometimes|integer|min:5',
                'job_post_count' => 'required_if:is_job_post,==,1|numeric|min:1',
                'featured_ads_type' => 'required_if:is_featured_ads,==,1',
                'featured_ads_count' => 'required_if:is_featured_ads,==,1|numeric|min:1',
                    ], [
                'job_post_count.required_if' => 'No. of Job Posts is required.',
                'job_post_count.numeric' => 'No. of Job Posts should be numeric.',
                'job_post_count.min' => 'Minimum 1 No. of Job Posts is required.',
                'featured_ads_type.required_if' => 'Featured Ads Type is required.',
                'featured_ads_count.required_if' => 'Featured Ads is required.',
                'featured_ads_count.numeric' => 'Featured Ads should be numeric.',
                'featured_ads_count.min' => 'Minimum 1 Featured Ads is required.',
            ]);
            $countWithRole = $this->model->where('id', '!=', $id)->where(['role_id' => $request['role_id']])->count();
            if ($countWithRole >= 3) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', 'You have already added maximum plans for this user type.');
                return response()->json(['status' => false, 'url' => '/admin/' . $viewName]);
            }
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

        $viewName = $this->viewName;
        $id = Input::all()['id'];
        $request = ['status' => 2];

        $result = $this->model->deleteAll($request, $id);
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
