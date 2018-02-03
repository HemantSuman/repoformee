<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\OrderDetail as CURRENT_MODEL;
use App\models\Category;
use App\models\Classified;
use App\models\Order;
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

class OrdersController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'order_details';
        $this->viewName = 'orders';
        $this->modelTitle = 'Orders';
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
		$order = new Order;
		$orderData = $order->orderListing(['id' => $result->order_id]);
		$orderData = $orderData->toArray();
		 return view('admin/' . $this->viewName . '/edit', compact('orderData', 'modelTitle', 'controllerName', 'actionName', 'result', 'viewName'));
        
    }




}
