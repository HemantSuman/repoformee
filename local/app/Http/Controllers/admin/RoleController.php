<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\models\Role;
use App\models\Permission;
use DB;
use Illuminate\Routing\Route;
use Session;
use Redirect;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Route $route, Request $request) {

        $this->viewName = 'roles';
        $this->modelTitle = 'Role';
        $this->model = new Role;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     * indexing of all role created by admin
     *
     * @return void
     * @access public
     */
    public function index(Request $request) {
        $requestArr = Input::all();
        $requestVal = '';
        if (!empty($requestArr)) {
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, ['_token', 'form_search', 'page', 'sort', 'direction'])) {
                    $this->model = $this->model->where($key, 'LIKE', "%{$value}%");
                }
                $requestVal = $value;
            }
            $roles = Role::with(["permission_role" => function ($detail) {
                            $detail->with("permission");
                        }]);
            if (!empty($inputarr['name'])) {
                $result = $result->where('roles.name', 'LIKE', "%{$inputarr['name']}%");
            }

            $roles = $this->model->where(['role_type' => 'admin'])->orderBy('id', 'DESC')->paginate(5);
        } else {
            $roles = Role::with(["permission_role" => function ($detail) {
                            $detail->with("permission");
                        }])->where(['role_type' => 'admin'])->orderBy('id', 'DESC')->paginate(5);
        }



        return view('admin/roles/index', compact('roles'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create() {

        $permission = Permission::get();


        $permissions = $permission->toarray();
        return view('admin/roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = new Role();
        $role->name = $request->input('name');
        $role->add_date = date('Y-m-d');
        $role->save();

        foreach ($request->input('permission') as $key => $value) {
            $attachmentData[] = array('permission_id' => $value, 'role_id' => $role->id);
        }
        \DB::table('permission_role')->insert($attachmentData);

        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'Role created successfully.');

        return Redirect::to('/admin/roles/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function show($id) {
        $role = Role::find($id);
        $rolePermissions = Permission::join("permission_role", "permission_role.permission_id", "=", "permissions.id")
                ->where("permission_role.role_id", $id)
                ->get();

        return view('admin/roles/show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function edit($id) {
        $role = Role::find($id);

        $permission = Permission::get();
        $rolePermissions = DB::table("permission_role")->where("permission_role.role_id", $id)
                ->pluck('permission_role.permission_id', 'permission_role.permission_id');
        return view('admin/roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $this->validate($request, [
            'permission' => 'required',
        ]);
        $requestArr = Input::all();
        $exceptFields = ['_token', 'permission', 'main'];
        $role = Role::find($id);
        foreach ($requestArr as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $role->$key = $value;
            }
        }
        $role->save();

        DB::table("permission_role")->where("permission_role.role_id", $id)
                ->delete();
        //dd($request->input('permission'));
        foreach ($request->input('permission') as $key => $value) {
            $attachmentData[] = array('permission_id' => $value, 'role_id' => $role->id);
            //$role->attachPermission($value);
        }
        \DB::table('permission_role')->insert($attachmentData);
        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'Role updated successfully.');

        return Redirect::to('/admin/roles/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return void
     */
    public function destroy($id) {

        $result = Role::find($id);

        $result->permission_role()->delete();
        $result->delete();
        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'Role deleted successfully.');

        return Redirect::to('/admin/roles/');
    }

    /**
     * Admin corporates
     * indexing of all corporate users
     *
     * @return void
     * @access public
     */
    public function corporates(Request $request) {
        $requestArr = Input::all();
        $requestVal = '';
        if (!empty($requestArr)) {
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, ['_token', 'form_search', 'page', 'sort', 'direction'])) {
                    $this->model = $this->model->where($key, 'LIKE', "%{$value}%");
                }
                $requestVal = $value;
            }

            $roles = $this->model->where(['role_type' => 'front', 'seller_type' => 'business'])->orderBy('id', 'DESC')->paginate(5);
        } else {
            $roles = Role::where(['role_type' => 'front', 'seller_type' => 'business'])->orderBy('id', 'DESC')->paginate(5);
        }



        return view('admin/roles/corporates', compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the add form for creating a new corporate type.
     *
     * @return void
     */
    public function add_corporate() {

        $modelTitle = $this->modelTitle;
        $viewName = $this->viewName;

        return view('admin/' . $this->viewName . '/add_corporate', compact('modelTitle', 'viewName'));
    }

    /**
     * Admin create
     * function for create a corporate user type
     *
     * @return void
     * @access public
     */
    public function create_corporate(Request $request) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        if ($request->isMethod('post')) {

            $category_id = explode(',', $request->category_id);

            $this->validate($request, [
                'name' => 'required|unique:roles',  
				'role_slug' => 'required',
                'category_id' => 'required',
                    ], [
                'name.required' => 'Name is required.',
				'role_slug.required' => 'Role Slug is required.',
                'category_id.required' => 'Category is required.',
                'name.unique' => 'Name already exist, try another one.',
            ]);

           

            $requestArr = Input::all();
            $exceptFields = ['_token', 'category_id','pid'];

            $data = new Role();
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }
            
            $pid = explode(',', $request->pid);
            $cat_id = [];
            foreach($category_id as $key => $value){
               $cat_id[$value]['pid'] = $pid[$key]; 
            }
            
            $data->role_type = 'front';
            $data->role_slug = $request->role_slug;
            $data->seller_type = 'business';
            $data->add_date = date('Y-m-d HH:mm:ss');

            if (!isset($request->status) && $request->status != 1) {
                $data->status = 0;
            }
            if (!isset($request->is_merchant) && $request->is_merchant != 1) {
                $data->is_merchant = 0;
            }
            $result = $this->model->create($data->toArray());
            $result->role_categories()->sync($cat_id);

            if ($result) {
                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully submitted.');
                return response()->json(['status' => true, 'url' => '/admin/corporates']);
            } else {
                Session::flash('alert-class', 'alert-warning');
                Session::flash('message', 'Something wrong, please try again.');
                return response()->json(['status' => false, 'url' => '/admin/corporates']);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function edit_corporate($id) {
        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $result = Role::where(['id' => $id, 'role_type' => 'front', 'seller_type' => 'business'])->with(['role_categories'])->first();
        $categoriesSelected = $result->role_categories->pluck('id')->implode(',');
        $pid = $result->role_categories->pluck('pid')->implode(',');
        return view('admin/roles.edit_corporate', compact('result', 'viewName', 'controllerName', 'categoriesSelected','pid'));
    }

    /**
     * Show the form for Update the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function corporate_update(Request $request, $id = null) {
        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        if ($request->isMethod('post')) {

            $requestArr = Input::all();

            $this->validate($request, [
                'name' => 'required|unique:roles,name,'.+$id,
                'category_id' => 'required',
                    ], [
                'name.required' => 'Name is required.',
                'category_id.required' => 'Category is required.',
                'name.unique' => 'Name already exist, try another one.',
            ]);

            $exceptFields = ['_token', 'category_id','old_category_id','pid'];
            $role = Role::find($id);
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $role->$key = $value;
                }
            }
            $category_id = explode(',', $request->category_id);
            $pid = explode(',', $request->pid);
            $cat_id = [];
            foreach($category_id as $key => $value){
               $cat_id[$value]['pid'] = $pid[$key]; 
            }
            if (!isset($request->status) && $request->status != 1) {
                $role->status = 0;
            }
            if ($request->is_merchant != 'on') {
                $role->is_merchant = 0;
            } else {
                $role->is_merchant = 1;
            }
            $result = $role->save();
            $role->role_categories()->sync($cat_id);
            

            if ($result) {
                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully submitted.');
                return response()->json(['status' => true, 'url' => '/admin/corporates']);
            } else {
                Session::flash('alert-class', 'alert-warning');
                Session::flash('message', 'Something wrong, please try again.');
                return response()->json(['status' => false, 'url' => '/admin/corporates']);
            }
        }

    }

}
