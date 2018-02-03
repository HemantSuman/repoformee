<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\Category;
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

class CategoriesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->viewName = 'categories';
        $this->modelTitle = 'Category';
        $this->model = new Category;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    

    /**
     * Admin frontcateogories
     * function for get front categories
     *
     * @return void
     * @access public
     */
    public function admin_allcategoriesfront() {

        $data = Input::all();
        $result = [];
        if ($data['id'] != '') {
            $result = $this->model->categoryListingFront(['pid' => $data['id'], 'belong_to_community' => 0]);
        }
        return response()->json(['status' => true, 'categories' => $result]);
    }

   

}
