<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\PromoCode as CURRENT_MODEL;
use App\models\Category;
use App\models\Classified;
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

class PromoCodesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'promo_codes';
        $this->viewName = 'promo_codes';
        $this->modelTitle = 'Promo Code';
        $this->model = new CURRENT_MODEL;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index -- admin_index
     * indexing of all PromoCode
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
     * function for add screen for a new PromoCode
     *
     * @return void
     * @access public
     */
    public function admin_add($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $category = new Category;
        $categories = $category->categoryListing(['pid' => 0, 'show_on_info_area' => 0]);

        return view('admin/' . $this->viewName . '/add', compact('categories', 'modelTitle', 'controllerName', 'actionName', 'viewName'));
    }

    /**
     * Admin create
     * function for create new PromoCode
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
                'parent_categoryid' => 'required',
                'category_id' => 'required',
                'classified_id' => 'required',
                'start_date' => 'required|date|date_format:m/d/Y',
                'end_date' => 'required|date|date_format:m/d/Y|after:' . $dateAfter,
                'discount_type' => 'required',
                'discount_value' => 'required|Numeric|Min:1',
                'promocode' => 'required|unique:promo_codes',
                    ], [
                'parent_categoryid.required' => 'Parent Category is required.',
                'category_id.required' => 'Child Category is required.',
                'classified_id.required' => 'Product is required.',
                'end_date.after' => 'End Date should be grater from Start Date',
            ]);

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
     * function for edit screen of existing PromoCode 
     *
     * @return void
     * @access public
     */
    public function admin_edit(CURRENT_MODEL $id) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        $result = $id;
        $category = new Category;
        $classifieds = new Classified;
        $categories = $category->categoryListing(['pid' => 0, 'show_on_info_area' => 0]);
        $sub_categories = $category->categoryListing(['pid' => $result->parent_categoryid, 'show_on_info_area' => 0]);
        $classifieds = $classifieds->classifiedListing(['category_id' => $result->category_id]);
        return view('admin/' . $this->viewName . '/edit', compact('categories', 'sub_categories', 'classifieds', 'modelTitle', 'controllerName', 'actionName', 'result', 'viewName'));
    }

    /**
     * Admin update
     * function for update the Record
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
                'parent_categoryid' => 'required',
                'category_id' => 'required',
                'classified_id' => 'required',
                'start_date' => 'required|date|date_format:m/d/Y',
                'end_date' => 'required|date|date_format:m/d/Y|after:' . $dateAfter,
                'discount_type' => 'required',
                'discount_value' => 'required|Numeric|Min:1',
                'promocode' => 'required|unique:promo_codes,promocode,' . +$id,
                    ], [
                'parent_categoryid.required' => 'Parent Category is required.',
                'category_id.required' => 'Child Category is required.',
                'classified_id.required' => 'Product is required.',
                'end_date.after' => 'End Date should be grater from Start Date',
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
     * function for delete a Record
     *
     * @return void
     * @access public
     */
    public function admin_delete() {

        $viewName = $this->viewName;
        $id = Input::all()['id'];

        $result = $this->model->deleteAll($id);
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
     * function for change status of multiple records
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

    /**
     * apply_promo
     * function for check promo codes for apply
     *
     * @return response
     * @access public
     */
    public function apply_promo() {

        $data = Input::all();
        $currentDate = date('Y-m-d');
        $promocodes = new CURRENT_MODEL;

        $promocodes = $promocodes
                        ->where('start_date', '<=', $currentDate)
                        ->where('end_date', '>=', $currentDate)
                        ->where(['promocode' => $data['promocode'], 'status' => 1])->first();
        if($promocodes){
            return response()->json(['status' => true, 'promocodes' => $promocodes]);
        } else {
            return response()->json(['status' => false]);
        }
        
        
    }

}
