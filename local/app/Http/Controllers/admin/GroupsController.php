<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\Group;
use App\models\Category;
use App\models\User;
use App\models\Attribute;
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
//use App\models\Classes\PrayTime;
use Illuminate\Support\Facades\Paginator;
//use App\models\State;
use App\Url;
use DateTime;
use Cookie;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttributesController;
use App\Jobs\SendReminderEmail;
use LRedis;

class GroupsController extends Controller {

    public function __construct(Route $route, Request $request) {

        $this->viewName = 'groups';
        $this->modelTitle = 'Groups';
        $this->model = new Group;

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
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        $requestArr = Input::all();

        if (!empty($requestArr)) {
            $inputarr = Input::all();

            $result = Category::select(DB::raw(
                                    'groups.id as id,'
                                    . 'groups.title as title,'
                                    . 'groups.status as status,'
                                    . 'categories.name as category_name,'
                                    . 'child_cat.name as cat_c_name,'
                                    . 'categories.name as `aggregate`'))
                    ->rightjoin('groups', 'categories.id', '=', 'groups.parent_categoryid')
                    ->leftjoin('categories as child_cat', 'groups.category_id', '=', 'child_cat.id')
                    ->orderBy('id', 'DESC');

            if (isset($inputarr['status']) && $inputarr['status'] != '' && ($inputarr['status'] == 0 || $inputarr['status'] == 1)) {

                $result = $result->where('groups.status', '=', $inputarr['status']);
            } else {
                $result = $result->where(function($query) {
                    $query->where(['groups.status' => 0])->orwhere(['groups.status' => 1]);
                });
            }
            if (!empty($inputarr['title'])) {
                $result = $result->where('groups.title', 'LIKE', "%{$inputarr['title']}%");
            }
            if (!empty($requestArr["sort"]) && $requestArr["sort"] != "category_name") {
                $result = $result->orderBy($requestArr["sort"], $requestArr["direction"]);
            }

            if (!empty($inputarr['sort']) && $inputarr['sort'] == "category_name") {
                $result = ($inputarr['direction'] == "asc") ? $result->orderBy('category_name', 'ASC') : $result->orderBy('category_name', 'DESC');
            }

            $result = $result->paginate(10);
            $result->form_request = $requestArr;
        } else {
            $result = Category::select(DB::raw(
                                            'groups.id as id,'
                                            . 'groups.title as title,'
                                            . 'groups.status as status,'
                                            . 'groups.created_at as created_at,'
                                            . 'groups.updated_at as updated_at,'
                                            . 'categories.name as category_name,'
                                            . 'child_cat.name as cat_c_name,'
                                            . 'categories.name as `aggregate`'))
                            ->rightjoin('groups', 'categories.id', '=', 'groups.parent_categoryid')
                            ->leftjoin('categories as child_cat', 'groups.category_id', '=', 'child_cat.id')
                            ->orderBy('id', 'DESC')
                            ->where(function($q1) {
                                $q1->where('groups.status', '=', 1)
                                ->orwhere('groups.status', '=', 0);
                            })->paginate(10);

        }
        $result->setPath('')->appends(Input::query())->render();

        return view('admin/' . $this->viewName . '/index', compact('modelTitle', 'result', 'controllerName', 'actionName', 'viewName'));
    }

    /**
     * admin_add
     * admin_add groups 
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

        $categories = $category->categoryListing(['pid' => 0]);
        $BelongsToCommunities = $category->where(['pid' => 0])->pluck('belong_to_community', 'id')->toArray();
        $showStaticAttributes = $category->where(['pid' => 0])->pluck('show_static_attributes', 'id')->toArray();
        $communities_information = $category->select('id', 'belong_to_community', 'show_on_info_area')->where(['pid' => 0])->get();
        $communities_informationarr = $communities_information->toArray();

        $other_saved_attr = \DB::table('attribute_group')->get();
        $collection2 = collect($other_saved_attr);
        $other_saved_attr_arr = $collection2->keyBy('attribute_id');
        $other_saved_attr_ids = array_keys($other_saved_attr_arr->toArray());

        return view('admin/' . $this->viewName . '/add', compact('modelTitle', 'controllerName', 'categories', 'actionName', 'viewName', 'other_saved_attr_ids'));
    }

    /**
     * admin_create
     * admin_create groups 
     *
     * @return void
     * @access public
     */
    public function admin_create(Request $request) {


        $viewName = $this->viewName;
        if ($request->isMethod('post')) {

            $requestArr = Input::all();


            $this->validate($request, [
                'title' => 'required|unique:groups',
                'parent_categoryid' => 'required',
                'category_id' => 'required',
                'attr_ids' => 'required',
                    ], [
                'parent_categoryid.required' => 'The Parent category field is required.',
                'category_id.required' => 'The Child category field is required.',
                'attr_ids.required' => 'The Attributes is required.',
            ]);


            $exceptFields = ['_token'];
            $data = new Group();
            foreach ($requestArr as $key => $value) {

                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            $groups = $this->model->create($data->toArray());
            $groups->attributes_groups()->sync($data->attr_ids);

            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully submitted.');
            return response()->json(['status' => true, 'url' => '/admin/groups']);
        }
    }

    /**
     * admin_edit
     * admin_edit groups 
     *
     * @return void
     * @access public
     */
    public function admin_edit($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $category = new Category;
        $categories = $category->categoryListing(['pid' => 0]);

        $result = false;
        if (isset($id)) {
            try {
                $result = $this->model->where('id', '=', $id)->with(['attributes_groups' => function ($query) {
                                $query->select("attribute_id", 'group_id', "display_name", "name");
                            }])->first();

                $subcategories = $category->categoryListing(['pid' => $result->parent_categoryid]);
                $data['id'] = $result->category_id;

                $all_attributes = Category::where("id", "=", $data['id'])
                                ->with(['attributes' => function ($query) {
                                        $query->select("id as attribute_id", "name", "display_name", "attributetype_id", "required as is_required", "attributetype_id as attr_type_id", "attribute_value as attr_value", "p_attr_id")
                                        ->where(['status' => 1, 'is_active' => 1])
                                        ->with(['attributeType' => function($q) {
                                                $q->select("id", "name", "slug");
                                            }]);
                                    }])->select("id")->first();

                $collection1 = collect($result->attributes_groups);
                $saved_attr_ids_arr = $collection1->keyBy('attribute_id');
                $saved_attr_ids = array_keys($saved_attr_ids_arr->toArray());
                
                $other_saved_attr = $this->model->where('id', '!=', $id)->where('category_id', '=', $result->category_id )
                        ->with(['attributes_groups'])->get();
                
                if (!empty($other_saved_attr->toArray())) {
                    foreach ($other_saved_attr as $key => $value) {
                        if (!empty($value->attributes_groups)) {

                            foreach ($value->attributes_groups as $k1 => $v1) {

                                $other_saved_attr_ids1[] = $v1['id'];
                            }
                        } else {
                            $other_saved_attr_ids1 = [];
                        }
                    }
                } else {
                    $other_saved_attr_ids1 = [];
                }
                
//                
                $collection3 = collect($other_saved_attr_ids1);
                $other_saved_attr_ids = $collection3->diff($saved_attr_ids);
                $other_saved_attr_ids = array_values($other_saved_attr_ids->toArray());
            } catch (ModelNotFoundException $ex) {
                
            }
        }

        return view('admin/' . $this->viewName . '/edit', compact('modelTitle', 'classified', 'controllerName', 'actionName', 'categories', 'result', 'viewName', 'subcategories', 'all_attributes', 'saved_attr_ids','other_saved_attr_ids'));
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

            $this->validate($request, [
                'title' => 'required|unique:groups,title,' . $id,
                'parent_categoryid' => 'required',
                'category_id' => 'required',
                    ], [
                'parent_categoryid.required' => 'The Parent category field is required.',
                'category_id.required' => 'The Child category field is required.',
                'attr_ids.required' => 'The Attributes is required.',
            ]);


            $requestArr = Input::all();


            $exceptFields = ['_token', 'parent_cat_id', 'child_cat_id', 'attributes_groups_saved', 'other_saved_attr_ids', 'attr_ids'];
            $data = $this->model->findOrFail($requestArr['id']);

            $atte_ids = $requestArr['attr_ids'];

            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if (!isset($request->status) && $request->status != 1) {
                $data->status = 0;
            }

            $groups = $data->save();
            $data->attributes_groups()->sync($atte_ids);




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
