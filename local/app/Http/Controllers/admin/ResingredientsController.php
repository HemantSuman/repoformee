<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\RestrictedIngredient;
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

class ResingredientsController extends Controller {
	
	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'restricted_ingredients';
        $this->viewName = 'resingredients';
        $this->modelTitle = 'Restricted Ingredients';
        $this->model = new RestrictedIngredient;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }
	
	    /**
     * Admin index
     * indexing of all ingredients
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

        if (!empty($requestArr)) {
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, ['_token', 'form_search', 'page', 'sort', 'direction'])) {
                    $this->model = $this->model->where($key, 'LIKE', "%{$value}%");
                }
            }

           
                $this->model = $this->model->where(['pid' => 0]);
                $requestId = '';
           

            if (!empty($requestArr["sort"])) {
                $this->model->orderBy($requestArr["sort"], $requestArr["direction"]);
            }

            $result = $this->model->orderBy('id', 'DESC')->get();
            $result->requestId = $requestId;
            $result->form_request = $requestArr;
        } else {

           
                $requestId = '';
           

			 $result = $this->model->orderBy('id', 'ASC')->orderBy('name', 'ASC')->orderBy('id', 'DESC')->get();
            $result->requestId = $requestId;
        }
//        
        return view('admin/' . $this->viewName . '/index', compact('modelTitle', 'result', 'controllerName', 'actionName', 'viewName'));
    }
	
}