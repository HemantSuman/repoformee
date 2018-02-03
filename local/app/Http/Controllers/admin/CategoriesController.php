<?php

namespace App\Http\Controllers\admin;

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
     * Admin index
     * indexing of all categories
     *
     * @return void
     * @access public
     */
    public function admin_indexmulti($selectedCategories = null) {
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);

        $allSubCategories = $task->getCategories($selectedCategories);
        echo $encodedata = json_encode($allSubCategories);
        die();
    }

    /**
     * Admin index
     * indexing of all categories with is sellable condition
     *
     * @return void
     * @access public
     */
    public function admin_categories_json_is_sellable($selectedCategories = null) {
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);

        $allSubCategories = $task->getCategories_is_sellable($selectedCategories);
        echo $encodedata = json_encode($allSubCategories);
        die();
    }

    /**
     * Admin index
     * indexing of all categories
     *
     * @return void
     * @access public
     */
    public function admin_indexmulti_cat($attr_id = null) {
        $data = DB::table('attributes as attr')->select('attr_cat.category_id', 'cat.pid')
                        ->leftJoin('attribute_category as attr_cat', function($query) {
                            $query->on('attr.id', '=', 'attr_cat.attribute_id');
                        })->leftJoin('categories as cat', function($query1) {
                    $query1->on('cat.id', '=', 'attr_cat.category_id');
                })->where(['attr.id' => $attr_id])->get();

        $collection = collect($data);
        $selectedCategory = $collection->implode('category_id', ',');
        $parent_catId = $collection->where('pid', 0);
        $parent_catId = $parent_catId->mapWithKeys(function ($item) {
            return [$item->category_id];
        });

        $child_catId = $collection->where('pid', '!=', 0);
        $child_catId = $child_catId->mapWithKeys(function ($item) {
            return [$item->category_id];
        });

        $task = new Category;
        $selectedCategory = explode(',', $selectedCategory);

        $allSubCategories = $task->getCategories($selectedCategory, $parent_catId, $child_catId);
        $encodedata['tree1'] = $allSubCategories;
        $encodedata['ids'] = $selectedCategory;
        echo json_encode($encodedata);
        die();
    }

    /**
     * Admin index
     * indexing of all categories
     *
     * @return void
     * @access public
     */
    public function admin_indexmulti1($id = null) {
        $task = new Category;

        return view('admin/categories/indexmulti');
    }

    /**
     * Admin index
     * indexing of all categories
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
                if (!in_array($key, ['_token', 'form_search', 'categoriesaction', 'page', 'sort', 'direction'])) {
                    $this->model = $this->model->where($key, 'LIKE', "%{$value}%");
                }
            }

            if (!empty($id)) {
                $this->model = $this->model->where(['pid' => $id]);
                $requestId = $id;
            } else {
                $this->model = $this->model->where(['pid' => 0]);
                $requestId = '';
            }

            if (!empty($requestArr["sort"])) {
                $this->model->orderBy($requestArr["sort"], $requestArr["direction"]);
            }

            $result = $this->model->orderBy('order_no', 'ASC')->orderBy('name', 'ASC')->orderBy('id', 'DESC')->paginate(10);
            $result->requestId = $requestId;
            $result->form_request = $requestArr;
        } else {

            if (!empty($id)) {
                $whr = ['pid' => $id];
                $requestId = $id;
            } else {
                $whr = ['pid' => 0];
                $requestId = '';
            }

            $result = $this->model->where($whr)->orderBy('order_no', 'ASC')->orderBy('name', 'ASC')->orderBy('id', 'DESC')->paginate(10);
            $result->requestId = $requestId;
        }
//        
        return view('admin/' . $this->viewName . '/index', compact('modelTitle', 'result', 'controllerName', 'actionName', 'viewName'));
    }

    public function admin_index_info($id = null) {

        $modelTitle = 'Information Category';
        $actionName = $this->actionName;
        $viewName = 'categories-info';
        $controllerName = $this->controllerName;


        $requestArr = Input::all();

        if (!empty($requestArr)) {
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, ['_token', 'form_search', 'categoriesaction', 'page', 'sort', 'direction'])) {
                    $this->model = $this->model->where($key, 'LIKE', "%{$value}%");
                }
            }

            if (!empty($id)) {
                $this->model = $this->model->where(['pid' => $id, 'show_on_info_area' => 1]);
                $requestId = $id;
            } else {
                $this->model = $this->model->where(['pid' => 0, 'show_on_info_area' => 1]);
                $requestId = '';
            }

            if (!empty($requestArr["sort"])) {
                $this->model->orderBy($requestArr["sort"], $requestArr["direction"]);
            }

            $result = $this->model->orderBy('id', 'DESC')->get();
            $result->requestId = $requestId;
            $result->form_request = $requestArr;
        } else {

            if (!empty($id)) {
                $whr = ['pid' => $id, 'show_on_info_area' => 1];
                $requestId = $id;
            } else {
                $whr = ['pid' => 0, 'show_on_info_area' => 1];
                $requestId = '';
            }

            $result = $this->model->where($whr)->orderBy('order_no', 'ASC')->orderBy('name', 'ASC')->orderBy('id', 'DESC')->get();
            $result->requestId = $requestId;
        }
//        
        return view('admin/' . $this->viewName . '/index-info', compact('modelTitle', 'result', 'controllerName', 'actionName', 'viewName'));
    }

    /**
     * Admin add
     * function for create a category
     *
     * @return void
     * @access public
     */
    public function admin_add($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $categories = $this->model->where(['status' => 1, 'pid' => 0, 'belong_to_community' => 0, 'show_on_info_area' => 0])->pluck("name", "id");
        if (isset($id)) {
            $categoriesSelected = $this->model->where(['id' => $id])->first();
        } else {
            $categoriesSelected = false;
        }

        return view('admin/' . $this->viewName . '/add', compact('modelTitle', 'categories', 'controllerName', 'actionName', 'categoriesSelected', 'viewName'));
    }

    /**
     * Admin add
     * function for create a Information category
     *
     * @return void
     * @access public
     */
    public function admin_add_info($id = null) {

        $modelTitle = 'Information Category';
        $actionName = $this->actionName;
        $viewName = 'categories-info';
        $controllerName = $this->controllerName;

        $categories = $this->model->where(['status' => 1, 'pid' => 0, 'belong_to_community' => 0, 'show_on_info_area' => 0])->pluck("name", "id");
        if (isset($id)) {
            $categoriesSelected = $this->model->where(['id' => $id])->first();
        } else {
            $categoriesSelected = false;
        }

        return view('admin/' . $this->viewName . '/add-info', compact('modelTitle', 'categories', 'controllerName', 'actionName', 'categoriesSelected', 'viewName'));
    }

    /**
     * Admin edit
     * function for edit a category
     *
     * @return void
     * @access public
     */
    public function admin_edit($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $result = false;
        if (isset($id)) {

            $categories = $this->model->where('id', '!=', $id)->where(['status' => 1, 'pid' => 0, 'belong_to_community' => 0, 'show_on_info_area' => 0])->pluck("name", "id");

            try {
                $result = $this->model->findOrFail($id);
                if ($result->pid == 0) {
                    $result->categoriesSelected = false;
                } else {
                    $result->categoriesSelected = $result->pid;
                }
            } catch (ModelNotFoundException $ex) {
            }
        }

        return view('admin/' . $this->viewName . '/edit', compact('modelTitle', 'categories', 'categoriesSelected', 'controllerName', 'actionName', 'result', 'viewName'));
    }

    public function admin_edit_info($id = null) {

        $modelTitle = 'Information Category';
        $actionName = $this->actionName;
        $viewName = 'categories-info';
        $controllerName = $this->controllerName;

        $result = false;
        if (isset($id)) {

            $categories = $this->model->where('id', '!=', $id)->where(['status' => 1, 'pid' => 0, 'belong_to_community' => 0, 'show_on_info_area' => 0])->pluck("name", "id");

            try {
                $result = $this->model->findOrFail($id);
                if ($result->pid == 0) {
                    $result->categoriesSelected = false;
                } else {
                    $result->categoriesSelected = $result->pid;
                }
            } catch (ModelNotFoundException $ex) {
            }
        }

        return view('admin/' . $this->viewName . '/edit-info', compact('modelTitle', 'categories', 'categoriesSelected', 'controllerName', 'actionName', 'result', 'viewName'));
    }

    /**
     * Admin add
     * function for create a category
     *
     * @return void
     * @access public
     */
    public function admin_create(Request $request, $id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        if ($request->isMethod('post')) {


            if (isset($request->is_child)) {
                $this->validate($request, [
                    'pid' => 'required',
                ]);
            }
            $this->validate($request, [
                'name' => 'required',
                'icon' => 'required|mimes:jpeg,jpg,png|dimensions:height=70',
                'image' => 'required|mimes:jpeg,jpg,png|dimensions:width=360,height=235',
                'description' => 'required',
            ]);



            $requestArr = Input::all();
            if ($request->com_info == 'Is belong to community') {
                $com = 1;
                $info = 0;
            } elseif ($request->com_info == 'Show On Information Area') {
                $com = 0;
                $info = 1;
            } else {
                $com = 0;
                $info = 0;
            }

            $exceptFields = ['_token', 'is_child', 'is_child_value', 'com_info', 'is_sellable'];
            if ($request->id) {
                $data = $this->model->findOrFail($id);
            } else {
                $data = new Category();
            }
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if ((!isset($request->is_child) && $request->is_child != 1 ) || (isset($request->pid) && $request->pid == 0)) {
                $data->pid = 0;
            }


            if (!isset($request->status) && $request->status != 1) {
                $data->status = 0;
            }


            if (!isset($request->accessible_to_users) && $request->accessible_to_users != 1) {
                $data->accessible_to_users = 0;
            }
            if (!isset($request->show_on_info_area) && $request->show_on_info_area != 1) {
                $data->show_on_info_area = 0;
            }
            if (!isset($request->is_sellable) && $request->is_sellable != 1) {
                $data->is_sellable = 0;
            }


            if (!isset($request->show_static_attributes) && $request->show_static_attributes != 1) {
                $data->show_static_attributes = 0;
            }
            if ($data->pid != 0) {
                $com = 0;
                $info = 0;
                $data->show_static_attributes = 0;
            }

            $updated_data = array(
                'belong_to_community' => $com,
                'show_on_info_area' => $info,
            );
            $countcategories = $this->model->where('pid', '=', 0)->count();

            $countcategoriesincrease = $countcategories + 1;
            $data->order_no = $countcategoriesincrease;

            $data->save();
            $lstcategoryid = $data->id;
            $this->model->where('id', $lstcategoryid)->update($updated_data);
            if ($lstcategoryid) {

                if (Input::file('icon')) {
                    $icon = Input::file('icon');

                    if (!is_dir('upload_images/categories/icon/' . $data->id)) {
                        File::makeDirectory('upload_images/categories/icon/' . $data->id, 0777, true);
                    }
                    if (!is_dir('upload_images/categories/icon/30px/' . $data->id)) {
                        File::makeDirectory('upload_images/categories/icon/30px/' . $data->id, 0777, true);
                    }
                    $destinationPath = 'upload_images/categories/icon/' . $data->id . '/';
                    $destinationPaththumb = 'upload_images/categories/icon/30px/' . $data->id . '/';

                    $extension = $icon->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;

                    $icon->move($destinationPath, $fileName);
                    image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);

                    $data->icon = $fileName;
                    $data->save();
                }

                if (Input::file('image')) {
                    $image = Input::file('image');
                    if (!is_dir('upload_images/categories/backgroundimage/' . $data->id)) {
                        File::makeDirectory('upload_images/categories/backgroundimage/' . $data->id, 0777, true);
                    }
                    if (!is_dir('upload_images/categories/backgroundimage/30px/' . $data->id)) {
                        File::makeDirectory('upload_images/categories/backgroundimage/30px/' . $data->id, 0777, true);
                    }

                    $destinationPath = 'upload_images/categories/backgroundimage/' . $data->id . '/';

                    $destinationPaththumb = 'upload_images/categories/backgroundimage/30px/' . $data->id . '/';
                    $extension = $image->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;

                    $image->move($destinationPath, $fileName);
                    image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                    $data->image = $fileName;
                    $data->save();
                }

                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully submitted.');
                if ($requestArr['is_child_value'] != 0) {
                    return Redirect::to('admin/' . $viewName . '/' . $requestArr['is_child_value']);
                } else {
                    return Redirect::to('admin/' . $viewName);
                }
            }
        }
    }

    /**
     * Admin add
     * function for create a Information category
     *
     * @return void
     * @access public
     */
    public function admin_create_info(Request $request, $id = null) {

        $modelTitle = 'Information Category';
        $actionName = $this->actionName;
        $viewName = 'categories-info';
        $controllerName = $this->controllerName;
        if ($request->isMethod('post')) {


            if (isset($request->is_child)) {
                $this->validate($request, [
                    'pid' => 'required',
                ]);
            }
            $this->validate($request, [
                'name' => 'required',
                'icon' => 'required|mimes:jpeg,jpg,png|dimensions:height=70',
                'image' => 'required|mimes:jpeg,jpg,png|dimensions:width=360,height=235',
                'description' => 'required',
            ]);



            $requestArr = Input::all();

            $com = 0;
            $info = 1; //show in information area
            $exceptFields = ['_token', 'is_child', 'is_child_value', 'com_info'];
            if ($request->id) {
                $data = $this->model->findOrFail($id);
            } else {
                $data = new Category();
            }
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if ((!isset($request->is_child) && $request->is_child != 1 ) || (isset($request->pid) && $request->pid == 0)) {
                $data->pid = 0;
            }


            if (!isset($request->status) && $request->status != 1) {
                $data->status = 0;
            }


            if (!isset($request->accessible_to_users) && $request->accessible_to_users != 1) {
                $data->accessible_to_users = 0;
            }
            if (!isset($request->show_on_info_area) && $request->show_on_info_area != 1) {
                $data->show_on_info_area = 0;
            }


            if (!isset($request->show_static_attributes) && $request->show_static_attributes != 1) {
                $data->show_static_attributes = 0;
            }

            $updated_data = array(
                'belong_to_community' => $com,
                'show_on_info_area' => $info,
            );
            $countcategories = $this->model->where('pid', '=', 0)->count();

            $countcategoriesincrease = $countcategories + 1;
            $data->order_no = $countcategoriesincrease;

            $data->save();
            $lstcategoryid = $data->id;
            $this->model->where('id', $lstcategoryid)->update($updated_data);
            if ($lstcategoryid) {

                if (Input::file('icon')) {
                    $icon = Input::file('icon');

                    if (!is_dir('upload_images/categories/icon/' . $data->id)) {
                        File::makeDirectory('upload_images/categories/icon/' . $data->id, 0777, true);
                    }
                    if (!is_dir('upload_images/categories/icon/30px/' . $data->id)) {
                        File::makeDirectory('upload_images/categories/icon/30px/' . $data->id, 0777, true);
                    }
                    $destinationPath = 'upload_images/categories/icon/' . $data->id . '/';
                    $destinationPaththumb = 'upload_images/categories/icon/30px/' . $data->id . '/';

                    $extension = $icon->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;

                    $icon->move($destinationPath, $fileName);
                    image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);

                    $data->icon = $fileName;
                    $data->save();
                }

                if (Input::file('image')) {
                    $image = Input::file('image');
                    if (!is_dir('upload_images/categories/backgroundimage/' . $data->id)) {
                        File::makeDirectory('upload_images/categories/backgroundimage/' . $data->id, 0777, true);
                    }
                    if (!is_dir('upload_images/categories/backgroundimage/30px/' . $data->id)) {
                        File::makeDirectory('upload_images/categories/backgroundimage/30px/' . $data->id, 0777, true);
                    }

                    $destinationPath = 'upload_images/categories/backgroundimage/' . $data->id . '/';

                    $destinationPaththumb = 'upload_images/categories/backgroundimage/30px/' . $data->id . '/';
                    $extension = $image->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;

                    $image->move($destinationPath, $fileName);
                    image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                    $data->image = $fileName;
                    $data->save();
                }

                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully submitted.');
                if ($requestArr['is_child_value'] != 0) {
                    return Redirect::to('admin/' . $viewName . '/' . $requestArr['is_child_value']);
                } else {
                    return Redirect::to('admin/' . $viewName);
                }
            }
        }
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

            if (isset($request->is_child)) {
                $this->validate($request, [
                    'pid' => 'required',
                ]);
            }
            $this->validate($request, [
                'name' => 'required',
                'icon' => 'sometimes|required|mimes:jpeg,jpg,png|dimensions:max=70',
                'image' => 'sometimes|required|mimes:jpeg,bmp,png|dimensions:width=360,height=235',
                'description' => 'required',
            ]);



            $requestArr = Input::all();


            if ($request->com_info == 'Is belong to community') {
                $com = 1;
                $info = 0;
            } elseif ($request->com_info == 'Show On Information Area') {
                $com = 0;
                $info = 1;
            } else {
                $com = 0;
                $info = 0;
            }
            if ($request->accessible_to_users == '1') {
            }

            $data = $this->model->findOrFail($id);
            if ($data->pid == 0) {
                $subcategory = $this->model->select('id')->where(['pid' => $id])->get();
                if (count($subcategory) > 0) {
                    foreach ($subcategory as $keys => $values) {
                        $updateaccessuserarr = array(
                            'accessible_to_users' => $request->accessible_to_users,
                        );
                        $this->model->where('id', $values->id)->update($updateaccessuserarr);
                    }
                }
            }
            $exceptFields = ['_token', 'is_child', 'is_child_value', 'com_info'];



            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if ((!isset($request->is_child) && $request->is_child != 1 ) || (isset($request->pid) && $request->pid == 0)) {
                $data->pid = 0;
            }

            if (!isset($request->status) && $request->status != 1) {
                $data->status = 0;
            }
            if (!isset($request->feactured) && $request->feactured != 1) {
                $data->feactured = 0;
            }

            if (!isset($request->accessible_to_users) && $request->accessible_to_users != 1) {
                $data->accessible_to_users = 0;
            }
            if (!isset($request->is_sellable) && $request->is_sellable != 1) {
                $data->is_sellable = 0;
            }

            if (!isset($request->show_static_attributes) && $request->show_static_attributes != 1) {
                $data->show_static_attributes = 0;
            }
            if ($data->pid != 0) {
                $com = 0;
                $info = 0;
            }
            $updated_data = array(
                'belong_to_community' => $com,
                'show_on_info_area' => $info,
            );

            $this->model->where('id', $id)->update($updated_data);
            if ($data->save()) {

                if (Input::file('icon')) {
                    $icon = Input::file('icon');
                    if (!is_dir('upload_images/categories/icon/30px/' . $data->id)) {
                        File::makeDirectory('upload_images/categories/icon/30px/' . $data->id, 0777, true);
                    }
                    $destinationPath = 'upload_images/categories/icon/' . $data->id . '/';
                    $destinationPaththumb = 'upload_images/categories/icon/30px/' . $data->id . '/';
                    $extension = $icon->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;
                    $icon->move($destinationPath, $fileName);
                    image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);

                    $data->icon = $fileName;
                    $data->save();
                }

                if (Input::file('image')) {
                    $image = Input::file('image');
                    if (!is_dir('upload_images/categories/backgroundimage/30px/' . $data->id)) {
                        File::makeDirectory('upload_images/categories/backgroundimage/30px/' . $data->id, 0777, true);
                    }

                    $destinationPath = 'upload_images/categories/backgroundimage/' . $data->id . '/';

                    $destinationPaththumb = 'upload_images/categories/backgroundimage/30px/' . $data->id . '/';
                    $extension = $image->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;

                    $image->move($destinationPath, $fileName);
                    image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                    $data->image = $fileName;
                    $data->save();
                }

                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully submitted.');
                if ($requestArr['is_child_value'] != 0) {
                    return Redirect::to('admin/' . $viewName . '/' . $requestArr['is_child_value']);
                } else {
                    return Redirect::to('admin/' . $viewName);
                }
            }
        }
    }

    /**
     * Admin update
     * function for update a Infomration category
     *
     * @return void
     * @access public
     */
    public function admin_update_info(Request $request, $id = null) {

        $modelTitle = 'Information Category';
        $actionName = $this->actionName;
        $viewName = 'categories-info';
        $controllerName = $this->controllerName;
        if ($request->isMethod('post')) {


            $this->validate($request, [
                'name' => 'required',
                'icon' => 'sometimes|required|mimes:jpeg,jpg,png|dimensions:max=70',
                'image' => 'sometimes|required|mimes:jpeg,bmp,png|dimensions:width=360,height=235',
                'description' => 'required',
            ]);

            $requestArr = Input::all();



            $com = 0;
            $info = 1; //Show On Information Area



            $data = $this->model->findOrFail($id);
            
            $exceptFields = ['_token', 'is_child', 'is_child_value', 'com_info'];



            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if ((!isset($request->is_child) && $request->is_child != 1 ) || (isset($request->pid) && $request->pid == 0)) {
                $data->pid = 0;
            }

            if (!isset($request->status) && $request->status != 1) {
                $data->status = 0;
            }
            if (!isset($request->feactured) && $request->feactured != 1) {
                $data->feactured = 0;
            }

            
            if (!isset($request->show_static_attributes) && $request->show_static_attributes != 1) {
                $data->show_static_attributes = 0;
            }
            
            $updated_data = array(
                'belong_to_community' => $com,
                'show_on_info_area' => $info,
            );

            $this->model->where('id', $id)->update($updated_data);
            if ($data->save()) {

                if (Input::file('icon')) {
                    $icon = Input::file('icon');
                    if (!is_dir('upload_images/categories/icon/30px/' . $data->id)) {
                        File::makeDirectory('upload_images/categories/icon/30px/' . $data->id, 0777, true);
                    }
                    $destinationPath = 'upload_images/categories/icon/' . $data->id . '/';
                    $destinationPaththumb = 'upload_images/categories/icon/30px/' . $data->id . '/';
                    $extension = $icon->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;
                    $icon->move($destinationPath, $fileName);
                    image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);

                    $data->icon = $fileName;
                    $data->save();
                }

                if (Input::file('image')) {
                    $image = Input::file('image');
                    if (!is_dir('upload_images/categories/backgroundimage/30px/' . $data->id)) {
                        File::makeDirectory('upload_images/categories/backgroundimage/30px/' . $data->id, 0777, true);
                    }

                    $destinationPath = 'upload_images/categories/backgroundimage/' . $data->id . '/';

                    $destinationPaththumb = 'upload_images/categories/backgroundimage/30px/' . $data->id . '/';
                    $extension = $image->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;

                    $image->move($destinationPath, $fileName);
                    image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                    $data->image = $fileName;
                    $data->save();
                }

                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully submitted.');
                if ($requestArr['is_child_value'] != 0) {
                    return Redirect::to('admin/' . $viewName . '/' . $requestArr['is_child_value']);
                } else {
                    return Redirect::to('admin/' . $viewName);
                }
            }
        }
    }

    /**
     * Admin delete
     * function for delete a category
     *
     * @return void
     * @access public
     */
    public function admin_delete() {

        $viewName = $this->viewName;
        $data = Input::all();
        $id = $data['id'];
        if (!empty($id)) {

            $existing_child = $this->model->where(['pid' => $id])->get();
            $existing_class = DB::table('classifieds')->where(function($q) use ($id) {
                        $q->where(['parent_categoryid' => $id])
                                ->orwhere(['category_id' => $id]);
                    })->first();
            if (isset($existing_child) && !empty($existing_child->toArray())) {


                return response()->json(['status' => false, 'url' => 'categories', 'message' => 'First delete all child categories relatd to this.']);
            } else if (isset($existing_class) && !empty($existing_class)) {


                return response()->json(['status' => false, 'url' => 'categories', 'message' => 'First delete all classifieds relatd to this.']);
            } else {

                try {
                    $result = $this->model->findOrFail($id);
                    $result->attributes()->delete();
                    $result->delete();
                    $deleteddata = array(
                        'category_id' => $id,
                        'created_at' => date('Y/m/d H:i:s'),
                    );
                    \DB::table('category_deleted')->insert($deleteddata);
                    Session::flash('alert-class', 'alert-success');
                    Session::flash('message', 'Successfully Deleted.');

                    return response()->json(['status' => true, 'url' => 'categories']);
                } catch (\Exception $ex) {

                    return response()->json(['status' => false, 'url' => 'categories', 'message' => 'First delete all the bind attributes.']);
                }
            }
        }

    }

    /**
     * Admin delete
     * function for delete a Information category
     *
     * @return void
     * @access public
     */
    public function admin_delete_info() {

        $viewName = 'categories-info';
        $data = Input::all();
        $id = $data['id'];
        if (!empty($id)) {

            $existing_child = $this->model->where(['pid' => $id])->get();
            $existing_class = DB::table('classifieds')->where(function($q) use ($id) {
                        $q->where(['parent_categoryid' => $id])
                                ->orwhere(['category_id' => $id]);
                    })->first();
            if (isset($existing_child) && !empty($existing_child->toArray())) {


                return response()->json(['status' => false, 'url' => 'categories', 'message' => 'First delete all child categories relatd to this.']);
            } else if (isset($existing_class) && !empty($existing_class)) {


                return response()->json(['status' => false, 'url' => 'categories', 'message' => 'First delete all classifieds relatd to this.']);
            } else {

                try {
                    $result = $this->model->findOrFail($id);
                    $result->attributes()->delete();
                    $result->delete();
                    $deleteddata = array(
                        'category_id' => $id,
                        'created_at' => date('Y/m/d H:i:s'),
                    );
                    \DB::table('category_deleted')->insert($deleteddata);
                    Session::flash('alert-class', 'alert-success');
                    Session::flash('message', 'Successfully Deleted.');

                    return response()->json(['status' => true, 'url' => 'categories-info']);
                } catch (\Exception $ex) {

                    return response()->json(['status' => false, 'url' => 'categories-info', 'message' => 'First delete all the bind attributes.']);
                }
            }
        }

    }

    /**
     * Admin multi checkbox
     * function for select checkbox
     *
     * @return void
     * @access public
     */
    public function admin_multi_check_options() {

        $data = Input::all();

        if (!empty($data['checkedId'])) {

            if (isset($data['parent_id'])) {
                $pid = '/' . $data['parent_id'];
            } else {
                $pid = '';
            }

            foreach ($data['checkedId'] as $key => $value) {
                DB::table('categories')
                        ->where('id', $value)
                        ->update(['status' => $data['status']]);
            }
            return response()->json(['status' => true, 'url' => "categories$pid"]);
        }
    }

    /**
     * Admin multi checkbox
     * function for select checkbox
     *
     * @return void
     * @access public
     */
    public function admin_multi_check_options_info() {

        $data = Input::all();

        if (!empty($data['checkedId'])) {

            if (isset($data['parent_id'])) {
                $pid = '/' . $data['parent_id'];
            } else {
                $pid = '';
            }

            foreach ($data['checkedId'] as $key => $value) {
                DB::table('categories')
                        ->where('id', $value)
                        ->update(['status' => $data['status']]);
            }
            return response()->json(['status' => true, 'url' => "categories-info$pid"]);
        }
    }

    /**
     * Admin all categoreis
     * function for get all categoris
     *
     * @return response
     * @access public
     */
    public function admin_allcategories() {

        $data = Input::all();
        $result = [];
        
        if(isset($data['class_type']) && $data['class_type'] == 'is_sellable'){
            $where = ['pid' => $data['id'], 'is_sellable' => 1];
        } else {
            $where = ['pid' => $data['id']];
        }
        
        if ($data['id'] != '') {
            $result = $this->model->categoryListing($where);
        }
        return response()->json(['status' => true, 'categories' => $result]);
    }

    /**
     * Admin category setorder
     * function for set cateogry order
     *
     * @return void
     * @access public
     */
    public function admin_set_order(Request $request) {

        if ($request->isMethod('post')) {
            $newArray = json_decode($request->data, TRUE);
            $status = true;
            $alreadyExistOrderNo = array();
            foreach ($newArray as $id => $value) {
                $checkParent = $this->model->where('id', '=', $id)->first();
                if ($checkParent->pid == 0) {
                    $checkExist = $this->model->where('order_no', '=', $value)->where('pid', '=', 0)->first();
                } else {
                    $checkExist = $this->model->where('order_no', '=', $value)->where('pid', '!=', 0)->first();
                }
                if (count($checkExist) == 1) {
                    $alreadyExistOrderNo[] = $value;
                } else {
                    $result = $this->model->where("id", $id)->update(array('order_no' => $value));
                    if (!$result) {
                        $status = false;
                    }
                }
            }
            if ($status) {
                if (count($alreadyExistOrderNo) > 0) {
                    Session::flash('alert-class', 'alert-warning');
                    Session::flash('message', 'Order number ' . implode(", ", $alreadyExistOrderNo) . ' already exists. Except this all others has been updated.');
                    return response()->json(['status' => true, 'message' => "Order no updated successfully."]);
                    die;
                } else {
                    Session::flash('alert-class', 'alert-success');
                    Session::flash('message', 'Order no updated successfully.');
                    return response()->json(['status' => true, 'message' => "Order no updated successfully."]);
                    die;
                }
            } else {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', 'Order no could not be updated. Please try again.');
                return response()->json(['status' => false, 'message' => "Order no could not be updated. Please try again."]);
                die;
            }
        }
    }

    /**
     * Admin category setorder
     * function for set cateogry order
     *
     * @return void
     * @access public
     */
    public function admin_setOrderSave(Request $request) {

        if ($request->isMethod('post')) {
            $item = $request->item;
            foreach ($item as $orderid => $value) {

                $tmp_orderid = $orderid + 1;
                $categories_id = $value;
                $result1 = $this->model->where("id", $categories_id)->update(array('order_no' => $tmp_orderid));

            }

            if (!$result1) {
                return response()->json(['status' => false, 'message' => "Order Not updated."]);
            } else {
                return response()->json(['status' => true, 'message' => "Order  updated successfully."]);
            }
        }
    }

    /**
     * Admin get category attributes
     * function for get category attributes
     *
     * @return void
     * @access public
     */
    public function admin_get_attributes($id = null) {


        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        if (isset($id) && $id != '') {
            $data = Category::where("id", "=", $id)
                            ->with(['attributes' => function ($query) {
                                    $query->select("id", "name", "attributetype_id", "attribute_value", 'status', 'show_type')
                                    ->with(['attributeType' => function($q) {
                                            $q->select("id", "name", "slug");
                                        }]);
                                }])->select("id", "name")->first();
        }
        return view('admin/' . $this->viewName . '/get_attribute', compact('modelTitle', 'result', 'controllerName', 'actionName', 'viewName', 'data'));
    }

    /**
     * Admin check community
     * function for change community
     *
     * @return void
     * @access public
     */
    public function check_is_community(Request $request) {
        if ($request->isMethod('post')) {
            $cData = $this->model->where('id', '=', $request->id)->first();
            if ($cData->belong_to_community == 1) {
                return response()->json(['status' => true]);
            }
            return response()->json(['status' => false]);
        }
    }

}
