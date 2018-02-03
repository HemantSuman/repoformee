<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\Attribute;
use App\models\Category;
use App\models\City;
use App\models\Classified;
use App\models\AttributeType;
use App\models\AttributeCategory;
use App\models\AttributeValue;
use App\models\FoodProduct;
use App\models\Group;
use Hash;
use DB;
use Mail;
use App\Event;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use File;
use Intervention\Image\Facades\Image as image1;
use Illuminate\Support\Facades\Redis;
use DateTime;

class AttributesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->viewName = 'attributes';
        $this->modelTitle = 'Attribute';
        $this->model = new Attribute;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */public function admin_index($id = null) {
        //dd("here");
        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;


        $requestArr = Input::all();

        if (!empty($requestArr)) {

            $inputarr = Input::all();

            $result = $this->model->whereHas('categories', function($q)use ( $inputarr ) {
                        if (!empty($inputarr['cat_name'])) {
                            $q->where('name', 'like', "%{$inputarr['cat_name']}%");
                        }
                    })->with('categories');
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, ['_token', 'form_search', 'categoriesaction', 'page', 'sort', 'cat_name', 'direction'])) {
                    $result = $result->orderBy('id', 'DESC')->where($key, 'LIKE', "%{$value}%");
                }
            }

            if (!empty($id)) {
                $this->model = $this->model->where(['p_attr_id' => $id]);
                $requestId = $id;
            } else {
                $this->model = $this->model->where(['p_attr_id' => 0]);
                $requestId = '';
            }

            if (!empty($requestArr["sort"])) {
                $result = $this->model->orderBy($requestArr["sort"], $requestArr["direction"]);
            }

            $result = $result->with('attributeType')->paginate(10);
            $result->requestId = $requestId;
            $result->form_request = $requestArr;
        } else {

            if (!empty($id)) {
                $whr = ['p_attr_id' => $id];
                $requestId = $id;
            } else {
                $whr = ['p_attr_id' => 0];
                $requestId = '';
            }
            $result = $this->model->with('attributeType')->with('sub_attributes')->with('categories')->orderBy('id', 'DESC')->where($whr)->paginate(10);
            $result->requestId = $requestId;
        }
//        
        $result->setPath('')->appends(Input::query())->render();
        return view('admin/' . $this->viewName . '/index', compact('modelTitle', 'result', 'controllerName', 'actionName', 'viewName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function admin_add($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $attributes = $this->model->get();
        $attributes = $this->model->where(['p_attr_id' => 0])->pluck("name", "id");
        $attribut_type = AttributeType::where(['status' => 1])->orderBy('name', 'ASC')->pluck('name', 'id');
        if (isset($id)) {
            $attributesSelected = $this->model->where(['id' => $id])->first();
        } else {
            $attributesSelected = false;
        }

        return view('admin/' . $this->viewName . '/add', compact('attribut_type', 'modelTitle', 'attributes', 'controllerName', 'actionName', 'attributesSelected', 'viewName'));
    }

    /**
     * Admin edit
     * function for edit any attribute
     *
     * @return void
     * @access public
     */
    public function admin_edit($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        $attribut_type = AttributeType::where(['status' => 1])->orderBy('name', 'ASC')->pluck('name', 'id');
        $result = false;
        if (isset($id)) {
            $attributes = $this->model->where('id', '!=', $id)->where(['p_attr_id' => 0, 'attributetype_id' => 4])->pluck("name", "id");
            try {
                $result = $this->model->with(['categories' => function($query) {
                                $query->where('is_active', 1);
                            }])->findOrFail($id);
                if ($result->p_attr_id == 0) {
                    $result->attributesSelected = false;
                } else {
                    $result->attributesSelected = $result->p_attr_id;
                }
            } catch (ModelNotFoundException $ex) {
                
            }
        }
        if ($result->p_attr_id != 0) {
            $catForParentAttr = DB::table('attribute_category')->select('category_id')->where(['attribute_id' => $result->p_attr_id])->get();
            $newone = $catForParentAttr->toarray() + $result['categories']->toarray();
            foreach ($newone as $k => $v) {
                $categoriesSelected[] = $v->category_id;
            }
            $categoriesSelected = implode(',', $categoriesSelected);
        } else {
            $collection = collect($result['categories']);
            $categoriesSelected = $collection->implode('id', ',');
        }


        $old_cat = DB::table('attribute_category')->where(['attribute_id' => $id])->get();
        $old_cat = $old_cat->implode('category_id', ',');

        if (isset($result->attributetype_id)) {
            if ($result->attributetype_id == 4 && $result->p_attr_id != 0) {
                $value_child = DB::table('attribute_value_child')
                        ->select('attribute_value_child.id as id', 'attribute_value_child.attribute_id as attribute_id', 'attribute_value_child.attribute_value as attribute_value', 'attribute_value.values as values', 'attribute_value_child.attribute_value_id as attribute_value_id')
                        ->where('attribute_value_child.attribute_id', $result->id)
                        ->join('attribute_value', function ($join) {
                            $join->on('attribute_value_child.attribute_value_id', '=', 'attribute_value.id');
                        })
                        ->get();

                $collection = collect($value_child);
                $grouped = $collection->groupBy('attribute_value_id');

                foreach ($grouped->toarray() as $k3 => $v3) {
                    $with_comma = $grouped[$k3]->implode('attribute_value', ',');
                    $attr_val_grouped[$k3]['all_attribute_value'] = $with_comma;
                    $attr_val_grouped[$k3]['attribute_id'] = $v3[0]->attribute_id;
                    $attr_val_grouped[$k3]['values'] = $v3[0]->values;
                    $attr_val_grouped[$k3]['attribute_value_id'] = $v3[0]->attribute_value_id;
                }
                if (isset($attr_val_grouped)) {
                    $result->value_child = $attr_val_grouped;
                }
            }
        }

        return view('admin/' . $this->viewName . '/edit', compact('attribut_type', 'modelTitle', 'attributes', 'attributesSelected', 'categoriesSelected', 'controllerName', 'actionName', 'result', 'viewName', 'old_cat'));
    }

    /**
     * Admin create
     * function for create any attribute
     *
     * @return void
     * @access public
     */
    public function admin_create(Request $request, $id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
//        
        if ($request->isMethod('post')) {
            if (in_array($request->attributetype_id, [5, 7])) {
                $attributetype_id = $request->attributetype_id;
            } else if (in_array($request->attributetype_id, [4]) && ($request->is_child != 1)) {
                $attributetype_id = $request->attributetype_id;
            } else {
                $attributetype_id = false;
            }
            $this->validate($request, [
                'name' => 'required|unique:attributes|max:255',
                'category_id' => 'required',
                'icon' => 'mimes:jpeg,jpg,png|dimensions:height=70',
                'p_attr_id' => 'required_if:is_child,==,1',
                'attributetype_id' => 'required',
                'min' => 'sometimes|required',
                'max' => 'sometimes|required',
                'attribute_value' => "required_if:attributetype_id,==,$attributetype_id",
                'display_name' => 'required',], [
                'category_id.required' => 'category is required.',
                'p_attr_id.required_if' => 'Parent Attribute is required.',
                'attribute_value.required_if' => 'Attribute Value is required.',
            ]);

            $customMessage = [
                'max' => "Your old password doesn't match",
            ];

            $requestArr = Input::all();
            $category_id[] = explode(',', $requestArr['category_id']);

            $exceptFields = ['_token', 'is_child', 'category_id', 'is_child_value'];
            if ($request->id) {
                $data = $this->model->findOrFail($id);
            } else {
                $data = new Attribute();
            }

            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if ((!isset($request->is_child) && $request->is_child != 1 ) || (isset($request->p_attr_id) && $request->p_attr_id == 0)) {
                $data->p_attr_id = 0;
            }

            if (!isset($request->status) && $request->status != 1) {
                $data->status = 0;
            }

            if (!isset($request->required) && $request->required != 1) {
                $data->required = 0;
            }
            if (!isset($request->searchable) && $request->searchable != 1) {
                $data->searchable = 0;
            }

            if (!isset($request->show_list) && $request->show_list != 1) {
                $data->show_list = 0;
            }

            if (isset($request->attributetype_id) && (in_array($request->attributetype_id, [5, 7]))) {
                $data->attribute_value = preg_replace('/\s+/', '', rtrim($data->attribute_value, ','));
                $attrValueArray = explode(',', $data->attribute_value);
            } else if (isset($request->attributetype_id) && (in_array($request->attributetype_id, [4]))) {

                if ((isset($request->is_child) && $request->is_child = 'on')) {
                    $data->attribute_value = '';
                    foreach ($data->child_attr_val as $key => $val) {
                        $valArray1 = explode(',', preg_replace('/\s+/', '', rtrim($val[0], ',')));
                        $attrChildValueArray[$key] = $valArray1;
                    }
//                    
                } else {
                    $data->attribute_value = preg_replace('/\s+/', '', rtrim($data->attribute_value, ','));
                    $attrValueArray = explode(',', $data->attribute_value);
                }
            } else if (isset($request->attributetype_id) && (in_array($request->attributetype_id, [18, 8]))) {

                if (isset($request->is_range) && $request->is_range == 'on') {

                    $min = $data->min;
                    $max = $data->max;
                    $data->attribute_value = "$min,$max";
                    $attrValueArray[] = $min;
                    $attrValueArray[] = $max;
                }
            } else if (isset($request->attributetype_id) && (in_array($request->attributetype_id, [19]))) {
                if (isset($request->is_range) && $request->is_range == 'on') {

                    $data->attribute_value = $request->is_range;
                    $attrValueArray[] = $request->is_range;
                }
            } else if (isset($request->attributetype_id) && (in_array($request->attributetype_id, [13]))) {
                if (isset($request->is_range) && $request->is_range == 'on') {

                    $data->attribute_value = $request->is_range;
                    $attrValueArray[] = $request->is_range;
                }
            } else {
                $data->attribute_value = '';
            }

            $category = $this->model->create($data->toArray());
            $category->categories()->sync($category_id[0]);

            if (!empty($category->id)) {
                if (Input::file('icon')) {
                    $data = $this->model->findOrFail($category->id);

                    $icon = Input::file('icon');

                    if (!is_dir('upload_images/attributes/' . $category->id)) {
                        File::makeDirectory('upload_images/attributes/' . $category->id, 0777, true, true);
                    }
                    if (!is_dir('upload_images/attributes/30px/' . $category->id)) {
                        File::makeDirectory('upload_images/attributes/30px/' . $category->id, 0777, true, true);
                    }
                    $destinationPath = 'upload_images/attributes/' . $category->id . '/';
                    $destinationPaththumb = 'upload_images/attributes/30px/' . $category->id . '/';

                    $extension = $icon->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;
                    $icon->move($destinationPath, $fileName);
                    image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);

                    $data->icon = $fileName;
                    $data->save();
                }
            }

            if (!empty($attrValueArray)) {
                $valuesData = [];
                foreach ($attrValueArray as $key => $val) {
                    $valuesData['attribute_id'] = $category->id;
                    $valuesData['values'] = $val;
                    \DB::table('attribute_value')->insert($valuesData);
                }
            }
            if (!empty($attrChildValueArray)) {
                $valuesData = [];
                foreach ($attrChildValueArray as $k1 => $v1) {
                    foreach ($v1 as $k2 => $v2) {
                        $valuesData['attribute_id'] = $category->id;
                        $valuesData['attribute_parent_id'] = $data->p_attr_id;
                        $valuesData['attribute_value'] = $v2;
                        $valuesData['attribute_value_id'] = $k1;
                        \DB::table('attribute_value_child')->insert($valuesData);
                    }
                }
            }



            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully submitted.');
            return response()->json(['status' => true, 'url' => 'attributes']);
        }
    }

    /**
     * Admin edit
     * function for update any attribute
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
            $name = $request->name;

            $this->validate($request, [

                'name' => 'required|unique:attributes,name,' . $id,
                'category_id' => 'required',
                'icon' => 'mimes:jpeg,jpg,png|dimensions:height=70',
                'p_attr_id' => 'required_if:is_child,==,1',
                'attribute_value' => 'sometimes|required',
                'attributetype_id' => 'required',
                'display_name' => 'required',
                    ], [
                'p_attr_id.required_if' => 'Parent Attribute is required.',
                'attribute_value.required' => 'Attribute Value is required.',
            ]);

            $requestArr = Input::all();
            $category_id[] = explode(',', $requestArr['category_id']);
            $category_id_old[] = explode(',', $requestArr['category_id_old']);
            $exceptFields = ['_token', 'is_child', 'category_id', 'is_child_value', 'is_range', 'min', 'max',
                'child_attr_val', 'child_attr_name', 'old_p_attr_id', 'category_id_old'];

            $data = $this->model->findOrFail($id);

            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if ((!isset($request->is_child) && $request->is_child != 1 ) || (isset($request->p_attr_id) && $request->p_attr_id == 0)) {
                $data->p_attr_id = 0;
            }

            if (!isset($request->status) && $request->status != 1) {
                $data->status = 0;
            }

            if (!isset($request->required) && $request->required != 1) {
                $data->required = 0;
            }
            if (!isset($request->searchable) && $request->searchable != 1) {
                $data->searchable = 0;
            }

            if (!isset($request->show_list) && $request->show_list != 1) {
                $data->show_list = 0;
            }
            if (isset($request->attributetype_id) && (in_array($request->attributetype_id, [5, 7]))) {
                $data->attribute_value = rtrim($data->attribute_value, ',');
                $attrValueArray = explode(',', $data->attribute_value);
            } else if (isset($request->attributetype_id) && (in_array($request->attributetype_id, [4]))) {

                if (isset($request->child_attr_val) && !empty($request->child_attr_val)) {
                    foreach ($request->child_attr_val as $k => $v) {
                        $attrValueChildArray[$k] = explode(',', rtrim($v[0]));
                    }
                } else {
                    $data->attribute_value = rtrim($data->attribute_value, ',');
                    $attrValueArray = explode(',', $data->attribute_value);
                }
            } else if (isset($request->attributetype_id) && (in_array($request->attributetype_id, [18, 8]))) {

                if (isset($request->is_range) && $request->is_range == 'on') {

                    $min = $request->min;
                    $max = $request->max;
                    $data->attribute_value = "$min,$max";
                    $attrValueArray[] = $min;
                    $attrValueArray[] = $max;
                }
            } else if (isset($request->attributetype_id) && (in_array($request->attributetype_id, [19]))) {

                if (isset($request->is_range) && $request->is_range == 'on') {

                    $data->attribute_value = $request->is_range;
                    $attrValueArray[] = $request->is_range;
                } else {
                    $data->attribute_value = '';
                    $attrValueArray = [];
                }
            } else if (isset($request->attributetype_id) && (in_array($request->attributetype_id, [13]))) {

                if (isset($request->is_range) && $request->is_range == 'on') {

                    $data->attribute_value = $request->is_range;
                    $attrValueArray[] = $request->is_range;
                } else {
                    $data->attribute_value = '';
                    $attrValueArray = [];
                }
            } else {
                $data->attribute_value = '';
            }
            
            $data->save();
            if ($data->status == 0) {
                $data->where(['p_attr_id' => $id])->update(['status' => 0]);
            }
            foreach ($category_id[0] as $key => $val) {
                if (!in_array($val, $category_id_old[0])) {
                    DB::table('attribute_category')->insert(['category_id' => $val, 'attribute_id' => $id]);
                }
            }

            $existCat = array_diff($category_id_old[0], $category_id[0]);
            foreach ($existCat as $key => $val) {
                DB::table('attribute_category')->where(['category_id' => $val, 'attribute_id' => $id])->update(['is_active' => 0]);
            }

            $existCatDeactive = array_intersect($category_id[0], $category_id_old[0]);
            foreach ($existCatDeactive as $key => $val) {
                DB::table('attribute_category')->where(['category_id' => $val, 'attribute_id' => $id])->update(['is_active' => 1]);
            }

            $updateid = $id;
            if (!empty($updateid)) {
                if (Input::file('icon')) {
                    $data = $this->model->findOrFail($updateid);

                    $icon = Input::file('icon');
                    if (!is_dir('upload_images/attributes/' . $updateid)) {
                        File::makeDirectory('upload_images/attributes/' . $updateid);
                    }
                    if (!is_dir('upload_images/attributes/30px/' . $updateid)) {
                        File::makeDirectory('upload_images/attributes/30px/' . $updateid);
                    }

                    $destinationPath = 'upload_images/attributes/' . $updateid . '/';
                    $destinationPaththumb = 'upload_images/attributes/30px/' . $updateid . '/';

                    $extension = $icon->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;
                    $icon->move($destinationPath, $fileName);
                    image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);

                    $data->icon = $fileName;
                    $data->save();
                }
            }
            //delete from attribute_value_child if parnt attr or type has changed 
            if (($request->old_p_attr_id != $request->p_attr_id) || ($request->attributetype_id != 4)) {
                DB::table('attribute_value_child')->where('attribute_id', $data->id)->delete();
            }
            if (!empty($attrValueArray)) {
                $valuesData = [];
                $notExistId = [];
                $existingId = [];
                foreach ($attrValueArray as $key => $val) {
                    $valuesData['attribute_id'] = $data->id;
                    $valuesData['values'] = $val;
                    $dataValue = AttributeValue::where('values', $val)->where('attribute_id', $data->id)->first();
//                    dd($dataValue);
                    if (empty($dataValue)) {
                        $notExistId[$key]['attribute_id'] = $data->id;
                        $notExistId[$key]['values'] = $val;
                        $classified = AttributeValue::insert(['attribute_id' => $data->id, 'values' => $val]);
                        $notExistId[$key]['id'] = DB::getPdo()->lastInsertId();
                    } else {
                        $existingId[$key]['id'] = $dataValue->id;
                        $existingId[$key]['attribute_id'] = $data->id;
                        $existingId[$key]['values'] = $val;
                    }

                }
                $allValidValues = array_merge($existingId, $notExistId);
                $collection1 = collect($allValidValues);
                $allNewIdsArray = explode(',', $collection1->implode('id', ','));
//                
                $allValuesArray = AttributeValue::where('attribute_id', $data->id)->get();

                $collection = collect($allValuesArray);
                $allExistingIdsArray = explode(',', $collection->implode('id', ','));
                $idsForDelete = array_diff($allExistingIdsArray, $allNewIdsArray);
                AttributeValue::destroy($idsForDelete);
            } else {
                AttributeValue::where('attribute_id', $data->id)->delete();
            }

            if (!empty($attrValueChildArray)) {
                foreach ($attrValueChildArray as $val_id => $values) {
                    $notExistId1 = [];
                    $existingId1 = [];

                    foreach ($values as $k => $valuesname) {
                        $dataValue1 = DB::table('attribute_value_child')->where('attribute_value', $valuesname)->where('attribute_value_id', $val_id)->first();

                        if (isset($dataValue1)) {
                            $existingId1[$k]['attribute_id'] = $data->id;
                            $existingId1[$k]['attribute_value_id'] = $val_id;
                            $existingId1[$k]['values'] = $valuesname;
                            $existingId1[$k]['id'] = $dataValue1->id;
                        } else {
                            $notExistId1[$k]['attribute_id'] = $data->id;
                            $notExistId1[$k]['attribute_parent_id'] = $data->p_attr_id;
                            $notExistId1[$k]['attribute_value_id'] = $val_id;
                            $notExistId1[$k]['attribute_value'] = $valuesname;
                            DB::table('attribute_value_child')->insert($notExistId1[$k]);
                            $notExistId1[$k]['id'] = DB::getPdo()->lastInsertId();
                        }
                    }
                    $allValidValues1 = array_merge($existingId1, $notExistId1);
                    $collection2 = collect($allValidValues1);
                    $allNewIdsArray1 = explode(',', $collection2->implode('id', ','));

                    $allValuesArray1 = DB::table('attribute_value_child')->where('attribute_id', $data->id)->where('attribute_value_id', $val_id)->get();

                    $collection1 = collect($allValuesArray1);
                    $allExistingIdsArray1 = explode(',', $collection1->implode('id', ','));
                    $idsForDelete = array_diff($allExistingIdsArray1, $allNewIdsArray1);
                    if (!empty($idsForDelete)) {
                        DB::table('attribute_value_child')->delete($idsForDelete);
                    }
                }
            }

            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully submitted.');
            return response()->json(['status' => true, 'url' => 'attributes']);
        }
    }

    /**
     * Admin edit
     * function for delete any attribute
     *
     * @return void
     * @access public
     */
    public function admin_delete() {

        $viewName = $this->viewName;
        $data = Input::all();
        $id = $data['id'];

        if (!empty($id)) {

            $existing_child = $this->model->where(['p_attr_id' => $id])->get();

            if (!empty($existing_child->toArray())) {

                return response()->json(['status' => false, 'url' => 'attributes', 'message' => 'First delete all child attributes relatd to this.']);
            } else {

                $existing_classi = DB::table('attribute_classified')->where(['attribute_id' => $id])->get();
                if (empty($existing_classi->toarray())) {
                    $result = $this->model->findOrFail($id);
                    $result->attribute_value()->delete();
                    $result->attribute_value_child()->delete();
                    $result->categories()->detach();
                    $result->delete();

                    Session::flash('alert-class', 'alert-success');
                    Session::flash('message', 'Successfully Deleted.');
                    return response()->json(['status' => true, 'url' => 'attributes']);
                } else {

                    return response()->json(['status' => false, 'url' => 'attributes', 'message' => 'First delete all the bind classifieds.']);
                }
            }
        }

    }

    /**
     * Admin edit
     * function for upate attribute status
     *
     * @return void
     * @access public
     */
    public function admin_showvalue(Request $request) {
        if ($request->id) {
            if ($request->state == 1) {
                $updated_data["show_type"] = 1;
            } else {
                $updated_data["show_type"] = 2;
            }
            \DB::table('attributes')->where("id", $request->id)->update($updated_data);
        }
    }

    /**
     * Admin csv
     * function for import any attribute
     *
     * @return void
     * @access public
     */
    public function admin_import_csv() {


        $dataField = Input::file();
        $newAttr = [];

        $zipDestination = 'upload_images/sample_file/temp_file/';
        $zipfile = Input::file('zip_upload');
        $extension = $zipfile->getClientOriginalExtension();
        $fileName = 'images' . $extension;
        $zipSource = $zipDestination . $fileName;
        $zipfile->move($zipDestination, $fileName);
        system("unzip -qd " . $zipDestination . " " . $zipSource);
        unlink($zipSource);
        $allImagesName = scandir($zipDestination);
        $allImagesName = array_diff($allImagesName, array('.', '..'));


        if (isset($dataField['zip_upload'])) {
            $zipfile = Input::file('zip_upload');
        }

        if (isset($dataField['csv_upload'])) {
            $file = Input::file('csv_upload');
            $filename = $file->getClientOriginalName();
            $filename1 = $file->getPathName();

            $cat_ids = explode('_', $filename);
            $cat_id = $cat_ids[0];

            $cat_detail = DB::table('categories')->where(['id' => $cat_id])->first();
            if ($cat_detail->pid != 0) {
                $cate_p_id = $cat_detail->pid;
                $cate_c_id = $cat_detail->id;
            } else {
                $cate_p_id = $cat_detail->id;
                $cate_c_id = 0;
            }

            $dataResult = Category::where("id", "=", $cat_id)->with(['attributes' => function ($query) {
                            $query->select("id", "name", "attributetype_id", "attribute_value", "required", "p_attr_id")->with(['attributeType' => function($q) {
                                    $q->select("id", "name", "slug", "status");
                                }]);
                        }])->select("id", "name", "belong_to_community")->where(['status' => 1])->first();
            $defaultFields = ['title', 'description', 'location', 'contact_name', 'contact_email',
                'contact_mobile', 'price', 'images', 'website', 'featured_classified', 'start_date', 'status'];

            $defaultFieldsWithArray = [
                'title' => ['attrName' => 'title', 'required' => 1],
                'description' => ['attrName' => 'description', 'required' => 0],
                'location' => ['attrName' => 'location', 'required' => 1],
                'contact_name' => ['attrName' => 'contact_name', 'required' => 1],
                'contact_email' => ['attrName' => 'contact_email', 'required' => 1],
                'contact_mobile' => ['attrName' => 'contact_mobile', 'required' => 1],
                'price' => ['attrName' => 'price', 'required' => 0],
                'images' => ['attrName' => 'images', 'required' => 1],
                'website' => ['attrName' => 'website', 'required' => 0],
                'featured_classified' => ['attrName' => 'featured_classified', 'required' => 0],
                'start_date' => ['attrName' => 'start_date', 'required' => 0],
                'status' => ['attrName' => 'status', 'required' => 0]
            ];
            if (!empty($dataResult['attributes'])) {

                $attrValues = [];
                $attrValuesWithArray = [];
                $attrValuesForSimilarColumn = [];

                foreach ($dataResult->attributes as $key => $value) {
                    if ($value->attributeType->status == 0) {
                        continue;
                    }
                    $value['required'] = 1;
                    $attrValuesWithArray[$value['name']]['attribute_id'] = $value['id'];
                    if ($value->attributeType->slug == 'Numeric') {
                        $attrValues[] = $value['name'];
                        $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                        $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                        $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                        $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;
                        $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                        $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                        if (strpos($value->attribute_value, ',')) {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (' . str_replace(',', ';', $value['attribute_value']) . ')';
                            $attrValuesWithArray[$value['name']]['original_range'] = $value['attribute_value'];
                        } else {
                            $attrValuesForSimilarColumn[] = $value['name'];
                            $attrValuesWithArray[$value['name']]['original_range'] = '';
                        }
                    } else if ($value->attributeType->slug == 'calendar') {
                        $attrValues[] = $value['name'];
                        $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                        $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                        $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                        $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;
                        $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                        $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                        if (strpos($value->attribute_value, ',')) {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (' . $value['attribute_value'] . ')';
                            $attrValuesWithArray[$value['name']]['original_range'] = $value['attribute_value'];
                        } else {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (YYYY)';
                            $attrValuesWithArray[$value['name']]['original_range'] = '';
                        }
                    } else if ($value->attributeType->slug == 'Date') {
                        $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                        $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                        $attrValues[] = $value['name'];
                        $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                        $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;
                        $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                        $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                        if ($value->attribute_value == 'on') {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (MM-DD-YYYY;MM-DD-YYYY)';
                            $attrValuesWithArray[$value['name']]['original_range'] = '1700-01-01;9999-01-01';
                        } else {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (MM-DD-YYYY)';
                            $attrValuesWithArray[$value['name']]['original_range'] = '';
                        }
                    } else if ($value->attributeType->slug == 'Time') {
                        $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                        $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                        $attrValues[] = $value['name'];
                        $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                        $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;
                        $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                        $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                        if ($value->attribute_value == 'on') {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (HH:MM:SS;HH:MM:SS)';
                            $attrValuesWithArray[$value['name']]['original_range'] = '00:00:00;24:00:00';
                        } else {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (HH:MM:SS)';
                            $attrValuesWithArray[$value['name']]['original_range'] = '';
                        }
                    } else if ($value->attributeType->slug == 'Drop-Down') {

                        $attrValuesForSimilarColumn[] = $value['name'];
                        $attrValues[] = $value['name'];
                        $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                        $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                        $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                        $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;

                        $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                        if ($value->p_attr_id == 0) {
                            $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['id'])->pluck('values', 'id')->toarray();
                        } else {
                            $attrValuesWithArray[$value['name']]['parent_attribute_id'] = $value->p_attr_id;
                            $attr_AllValues = DB::table('attribute_value_child')->where(['attribute_parent_id' => $value['p_attr_id']])->get()->toarray();
                            $collection = collect($attr_AllValues);
                            $attr_AllValues = $collection->keyBy('attribute_value')->toarray();
                        }

                        $attrValuesWithArray[$value['name']]['original_range'] = $attr_AllValues;
                    } else if (in_array($value->attributeType->slug, ['Multi-Select', 'Radio-button'])) {
                        $attrValuesForSimilarColumn[] = $value['name'];
                        $attrValues[] = $value['name'];
                        $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                        $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                        $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                        $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;
                        $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                        $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['id'])->pluck('values', 'id')->toarray();
                        $attrValuesWithArray[$value['name']]['original_range'] = $attr_AllValues;
                    } else {
                        $attrValuesForSimilarColumn[] = $value['name'];
                        $attrValues[] = $value['name'];
                        $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                        $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                        $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                        $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;
                        $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                        $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                        $attrValuesWithArray[$value['name']]['original_range'] = $value['attribute_value'];
                    }
                }
            } else {
                $attrValues = [];
            }
            $allCsvFieldsWithArray = array_merge($defaultFieldsWithArray, $attrValuesWithArray);
            $allCsvFields = array_merge($defaultFields, $attrValues);
            $allCsvFieldsForCmpare = array_merge($defaultFields, $attrValuesForSimilarColumn);

            $handle = fopen($filename1, "r");
            $count = 0;
            $errorMsg = "";
            $headersFromFile = [];
            $dataArray = [];
            $saveFieldsInDb = [];
            $saveImageFieldsInDb = [];
            $returnValueArr = [];
            $returnValueArrForMulti = [];
            $staorAllTitleValue = [];

            while ($data = fgetcsv($handle, $argLinelength = 5000, ',', '"')) {
                if ($count == 0) {

                    if (!empty(array_diff($allCsvFieldsForCmpare, $data))) {
                        $errorMsg .= 'Something is wrong, please generate sample file again and upload!';
                        break;
                    }
                    $count++;
                    continue;
                }

                $count++;
                $dataArray = [];
                foreach ($allCsvFields as $key => $val) {
                    $dataArray[$val] = $allCsvFieldsWithArray[$val];
                    $dataArray[$val]['csvValue'] = $data[$key];
                    if (in_array($val, $defaultFields)) {
                        $saveFieldsInDb[$count][$val] = $data[$key];
                    } else {
                        $attrValuesWithArray[$val]['attr_value'] = $data[$key];
                    }
                }
                $contiForReq = false;
                foreach ($dataArray as $key => $value) {
                    if (($value['required'] == 1) && ($value['csvValue'] == '')) {
                        $errorMsg .= "Required Field " . $key . " in row no. " . ($count) . "<br/>";
                        $contiForReq = true;
                    }
                }
                if ($contiForReq) {
                    continue;
                }
                //For title
                $title = $this->getIdByName($dataArray['title']['csvValue'], 'classifieds', 'title', 'id');
                if (!$title['error']) {
                    $errorMsg .= "Title name Already exist in database in row no. " . ($count) . "<br/>";
                } else {
                    if (in_array($dataArray['title']['csvValue'], $staorAllTitleValue)) {
                        $errorMsg .= "Title name duplicate in row no. " . ($count) . "<br/>";
                    } else {
                        $staorAllTitleValue[] = $dataArray['title']['csvValue'];
                    }
                }

                //for Location
                $returnArr = $this->getDetailLocation($dataArray['location']['csvValue']);
                if ($returnArr == false) {
                    $errorMsg .= "Invalid location in row no. " . ($count) . "<br/>";
                }
                $saveFieldsInDb[$count]['state_id'] = $returnArr['state'];
                $saveFieldsInDb[$count]['city_id'] = $returnArr['city'];
                $saveFieldsInDb[$count]['pincode'] = $returnArr['pincode'];
                $saveFieldsInDb[$count]['lat'] = $returnArr['lat'];
                $saveFieldsInDb[$count]['lng'] = $returnArr['lng'];
                $saveFieldsInDb[$count]['location'] = $dataArray['location']['csvValue'];

                //For contact_email
                if (!filter_var($dataArray['contact_email']['csvValue'], FILTER_VALIDATE_EMAIL)) {
                    $errorMsg .= "Invalid contact email in row no. " . ($count) . "<br/>";
                }

                //For contact_mobile
                if (!is_int($dataArray['contact_mobile']['csvValue']) && ((int) $dataArray['contact_mobile']['csvValue'] == 0) && strlen($dataArray['contact_mobile']['csvValue']) != 10) {
                    $errorMsg .= "contact_mobile must be number and at least 10 characters in row no. " . ($count) . "<br/>";
                }

                //For price
                if ($dataArray['price']['csvValue'] != '' && !is_numeric($dataArray['price']['csvValue'])) {
                    $errorMsg .= "price must be number in row no. " . ($count) . "<br/>";
                }


                //For website
                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $dataArray['website']['csvValue'])) {
                    $errorMsg .= "Invalid website in row no. " . ($count) . "<br/>";
                }

                //For images
                if (strpos($dataArray['images']['csvValue'], ';') === false) {

                    if (!in_array($dataArray['images']['csvValue'], $allImagesName)) {
                        $errorMsg .= "Images name not fount in zip in row no. " . ($count) . "<br/>";
                    } else {

                        $saveImageFieldsInDb[$count]['images'][] = $dataArray['images']['csvValue'];
                        unset($saveFieldsInDb[$count]['images']);
                    }
                } else {
                    $allImg = explode(';', $dataArray['images']['csvValue']);
                    foreach ($allImg as $key => $val) {
                        if (!in_array($val, $allImagesName)) {
                            $errorMsg .= "Images name not fount in zip in row no. " . ($count) . "<br/>";
                        } else {
                            $saveImageFieldsInDb[$count]['images'] = $allImg;
                            unset($saveFieldsInDb[$count]['images']);
                        }
                    }
                }

                //For start date
                if ($dataArray['start_date']['csvValue'] != '') {

                    $dataArray['start_date']['csvValue'] = str_replace('/', '-', $dataArray['start_date']['csvValue']);
                    if (preg_match("/^(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])\-\d{4}$/", $dataArray['start_date']['csvValue'])) {
                        $pieces123 = explode("-", $dataArray['start_date']['csvValue']);
                        $requestDate = $pieces123[2] . '-' . $pieces123[0] . '-' . $pieces123[1];
                        $saveFieldsInDb[$count]['start_date'] = $requestDate;
                    } else {
                        $errorMsg .= "Invalid Start date in row no. " . ($count) . " (MM-DD-YYYY)<br/>";
                    }
                } else {
                    $saveFieldsInDb[$count]['start_date'] = date('Y-m-d');
                }
                //For featured_classified
                $dataArray['featured_classified']['csvValue'] = (int) $dataArray['featured_classified']['csvValue'];
                if (($dataArray['featured_classified']['csvValue'] != 0) && ($dataArray['featured_classified']['csvValue'] != 1)) {
                    $errorMsg .= "Invalid featured_classified in row no. " . ($count) . " <br/>";
                } else {
                    $saveFieldsInDb[$count]['featured_classified'] = $dataArray['featured_classified']['csvValue'];
                }

                //For end date
                if ($saveFieldsInDb[$count]['featured_classified'] == 1) {
                    $saveFieldsInDb[$count]['end_date'] = date("Y-m-d", strtotime($saveFieldsInDb[$count]['start_date'] . "+" . Redis::get('Feature-Classified-Day') . " day"));
                } else {
                    $saveFieldsInDb[$count]['end_date'] = date("Y-m-d", strtotime($saveFieldsInDb[$count]['start_date'] . "+" . Redis::get('Unfeature-Classified-Day') . " day"));
                }
                if ($dataResult->belong_to_community == 1) {
                    $saveFieldsInDb[$count]['end_date'] = '9999-01-01';
                }

                //For category ids
                $saveFieldsInDb[$count]['parent_categoryid'] = $cate_p_id;
                $saveFieldsInDb[$count]['category_id'] = $cate_c_id;

                //For status
                $saveFieldsInDb[$count]['status'] = (int) $dataArray['status']['csvValue'];
                //For user id
                $saveFieldsInDb[$count]['user_id'] = Auth::guard('admin')->user()->id;
                //Start for Dynamic attributes

                foreach ($attrValuesWithArray as $key => $value) {
                    if ($value['required'] == 0 && $value['attr_value'] == '') {
                        continue;
                    }
                    $value['attr_value'] = preg_replace('/\s+/', '', $value['attr_value']);
                    $returnValueArr[$count][$value['attribute_id']]['attr_type_name'] = $value['attr_type_name'];
                    $returnValueArr[$count][$value['attribute_id']]['attr_type_id'] = $value['attr_type_id'];
                    $returnValueArr[$count][$value['attribute_id']]['parent_value_id'] = 0;
                    $returnValueArr[$count][$value['attribute_id']]['parent_attribute_id'] = 0;

                    if ($value['attr_type_name'] == 'calendar') {
                        if ($value['original_range'] != '') {
                            $rangVal = explode(',', $value['original_range']);
                            $attrRang = explode(';', $value['attr_value']);
                            if ((strpos($value['attr_value'], ';') === false) || ($attrRang[0] > $attrRang[1]) || ($attrRang[0] < $rangVal[0]) || ($attrRang[1] > $rangVal[1])) {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                            }
                        } else {
                            $value['attr_value'] = (int) $value['attr_value'];
                            if (strlen($value['attr_value']) != 4) {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                            }
                        }
                    } else if ($value['attr_type_name'] == 'Numeric') {
                        if ($value['original_range'] != '') {
                            $rangVal = explode(',', $value['original_range']);
                            $attrRang = explode(';', $value['attr_value']);
                            if ((strpos($value['attr_value'], ';') === false) || (!preg_match("/^[1-9]\d*$/", $attrRang[0])) || (!preg_match("/^[1-9]\d*$/", $attrRang[1])) || ($attrRang[0] > $attrRang[1]) || ($attrRang[0] < (int) $rangVal[0]) || ($attrRang[1] > (int) $rangVal[1])) {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                            }
                        } else {
                            if (!preg_match("/^[1-9]\d*$/", $value['attr_value'])) {
                                $errorMsg .= "Invalid == value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                            }
                        }
                    } else if ($value['attr_type_name'] == 'Time') {
                        if ($value['original_range'] != '') {
                            $rangVal = explode(';', $value['original_range']);
                            $attrRang = explode(';', $value['attr_value']);
                            if ((strpos($value['attr_value'], ';') === false) || (!preg_match("/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/", $attrRang[0])) || (!preg_match("/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/", $attrRang[1])) || (new DateTime($attrRang[0]) > new DateTime($attrRang[1])) || (new DateTime($attrRang[0]) < new DateTime($rangVal[0])) || (new DateTime($attrRang[1]) > new DateTime($rangVal[1]))) {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                            }
                        } else {
                            if (!preg_match("/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/", $value['attr_value'])) {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                            }
                        }
                    } else if ($value['attr_type_name'] == 'Date') {
                        if ($value['original_range'] != '') {
                            $rangVal = explode(';', $value['original_range']);
                            $attrRang = explode(';', $value['attr_value']);
                            $attrRang[0] = str_replace('/', '-', $attrRang[0]);
                            $attrRang[1] = str_replace('/', '-', $attrRang[1]);
                            if ((strpos($value['attr_value'], ';') === false) || (!preg_match("/^(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])\-\d{4}$/", $attrRang[0])) || (!preg_match("/^(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])\-\d{4}$/", $attrRang[1]))) {

                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $pieces = explode("-", $attrRang[0]);
                                $attrRang[0] = $pieces[2] . '-' . $pieces[0] . '-' . $pieces[1];
                                $pieces22 = explode("-", $attrRang[1]);
                                $attrRang[1] = $pieces22[2] . '-' . $pieces22[0] . '-' . $pieces22[1];

                                if (($attrRang[0] > $attrRang[1]) || ($attrRang[0] < $rangVal[0])) {
                                    $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                                } else {
                                    $returnValueArr[$count][$value['attribute_id']]['attr_value'] = str_replace('-', '/', $value['attr_value']);
                                }
                            }
                        } else {
                            $value['attr_value'] = str_replace('/', '-', $value['attr_value']);
                            if (!preg_match("/^(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])\-\d{4}$/", $value['attr_value'])) {
                                $errorMsg .= "Invalid 1111value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = str_replace('-', '/', $value['attr_value']);
                            }
                        }
                    } else if (in_array($value['attr_type_name'], ['Drop-Down'])) {
                        if ($value['parent_attribute_id'] == 0) {
                            if (!empty($value['original_range']) && (trim($value['attr_value']) != '') && !in_array(trim($value['attr_value']), $value['original_range'])) {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {

                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = array_search($value['attr_value'], $value['original_range']);
                            }
                        } else {
                            $parentValueId = $returnValueArr[$count][$value['parent_attribute_id']]['attr_value'];
                            if ((!empty($value['original_range'][$value['attr_value']])) && ($value['original_range'][$value['attr_value']]->attribute_value_id == $parentValueId)) {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['original_range'][$value['attr_value']]->id;
                                $returnValueArr[$count][$value['attribute_id']]['parent_value_id'] = $value['original_range'][$value['attr_value']]->attribute_value_id;
                                $returnValueArr[$count][$value['attribute_id']]['parent_attribute_id'] = $value['parent_attribute_id'];
                            } else {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            }
                        }
                    } else if (in_array($value['attr_type_name'], ['Radio-button'])) {
                        if ((!empty($value['original_range']) != '') && (trim($value['attr_value']) != '') && !in_array(trim($value['attr_value']), $value['original_range'])) {
                            $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                        } else {
                            $returnValueArr[$count][$value['attribute_id']]['attr_value'] = array_search($value['attr_value'], $value['original_range']);
                        }
                    } else if (in_array($value['attr_type_name'], ['Multi-Select'])) {
                        $multiArrVal = [];
                        $multiArrVal = explode(';', preg_replace('/\s+/', '', rtrim($value['attr_value'], ',')));
                        if (count(array_unique($multiArrVal)) < count($multiArrVal)) {
                            $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                        } else {
                            foreach ($multiArrVal as $k1 => $v1) {
                                if (!in_array($v1, $value['original_range'])) {
                                    $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                                } else {
                                    $attrValMulti = array_search($v1, $value['original_range']);
                                    $returnValueArrForMulti[$count][$attrValMulti]['attr_value'] = $attrValMulti;
                                    $returnValueArrForMulti[$count][$attrValMulti]['attribute_id'] = $value['attribute_id'];
                                    $returnValueArrForMulti[$count][$attrValMulti]['attr_type_name'] = $value['attr_type_name'];
                                    $returnValueArrForMulti[$count][$attrValMulti]['attr_type_id'] = $value['attr_type_id'];
                                    unset($returnValueArr[$count][$value['attribute_id']]);
                                }
                            }
                        }
                    } else if (in_array($value['attr_type_name'], ['Image-Gallery'])) {

                        if (strpos($value['attr_value'], ';') === false) {

                            if (!in_array($value['attr_value'], $allImagesName)) {
                                $errorMsg .= "Images name not found for $value[attrName] in zip in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArrForMulti[$count][$value['attr_value']]['attribute_id'] = $value['attribute_id'];
                                $returnValueArrForMulti[$count][$value['attr_value']]['attr_type_name'] = $value['attr_type_name'];
                                $returnValueArrForMulti[$count][$value['attr_value']]['attr_type_id'] = $value['attr_type_id'];
                                $returnValueArrForMulti[$count][$value['attr_value']]['attr_value'] = $value['attr_value'];

                                $returnValueArrForImage[$count][$value['attribute_id']][] = $value['attr_value'];
                                unset($returnValueArr[$count][$value['attribute_id']]);
                            }
                        } else {
                            $allImg = explode(';', $dataArray['images']['csvValue']);
                            foreach ($allImg as $key => $val) {
                                if (!in_array($val, $allImagesName)) {
                                    $errorMsg .= "Images name not found for $value[attrName] in zip in row no. " . ($count) . "<br/>";
                                } else {
                                    $returnValueArrForMulti[$count][$val]['attribute_id'] = $value['attribute_id'];
                                    $returnValueArrForMulti[$count][$val]['attr_type_name'] = $value['attr_type_name'];
                                    $returnValueArrForMulti[$count][$val]['attr_type_id'] = $value['attr_type_id'];
                                    $returnValueArrForMulti[$count][$val]['attr_value'] = $val;

                                    $returnValueArrForImage[$count][$value['attribute_id']][] = $val;
                                    unset($returnValueArr[$count][$value['attribute_id']]);
                                }
                            }
                        }
                    } else if ($value['attr_type_name'] == 'Email') {

                        if (!filter_var($value['attr_value'], FILTER_VALIDATE_EMAIL)) {
                            $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                        } else {

                            $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                        }
                    } else if ($value['attr_type_name'] == 'Url') {

                        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $value['attr_value'])) {
                            $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                        } else {

                            $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                        }
                    } else if ($value['attr_type_name'] == 'Color') {

                        if (!preg_match('/#([a-fA-F0-9]{3}){1,2}\b/', $value['attr_value'])) {
                            $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                        } else {

                            $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                        }
                    } else {
                        $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                    }
                }
                continue;




                //For Attr value from csv
                if (!empty($attrValues)) {
                    foreach ($attrValues as $index => $attrname) {
                        $attr_value[$index]['attr_value'] = $dataArray[$count][$attrname];
                        $attr_value[$index]['attr_type_id'] = $attrType_id[$index];
                        $attr_value[$index]['attr_type_name'] = $attrSlugName[$index];
                    }
                }
                $dataExtra = array_combine($attr_ids, $attr_value);
                $dataExtraArray[$count] = $dataExtra;
            }


            if (empty($errorMsg)) {

                $dataForSave = new Classified();
                foreach ($saveFieldsInDb as $k => $v) {
                    $classified = $dataForSave->create($v);
                    if (isset($returnValueArr[$k]) && !empty($returnValueArr[$k])) {
                        $classified->classified_attribute()->sync($returnValueArr[$k]);
                    }
                    if (isset($returnValueArrForMulti[$k]) && !empty($returnValueArrForMulti[$k])) {
                        foreach ($returnValueArrForMulti[$k] as $ke => $val) {
                            $val['classified_id'] = $classified->id;
                            \DB::table('attribute_classified')->insert($val);
                        }
                    }
                    if (!empty($saveImageFieldsInDb)) {

                        $attachmentData = array();
                        if (!is_dir('upload_images/classified/' . $classified->id)) {
                            File::makeDirectory('upload_images/classified/' . $classified->id, 0777, true);
                        }
                        if (!is_dir('upload_images/classified/30px/' . $classified->id)) {
                            File::makeDirectory('upload_images/classified/30px/' . $classified->id, 0777, true);
                        }
                        if (!is_dir('upload_images/classified/950x530px/' . $classified->id)) {
                            File::makeDirectory('upload_images/classified/950x530px/' . $classified->id, 0777, true);
                        }
                        foreach ($saveImageFieldsInDb[$k]['images'] as $key => $val) {
                            $destinationPath = 'upload_images/sample_file/temp_file/';
                            $destinationoriginal = 'upload_images/classified/' . $classified->id . '/';
                            $destinationPaththumb = 'upload_images/classified/30px/' . $classified->id . '/';
                            $destinationPaththumb1 = 'upload_images/classified/950x530px/' . $classified->id . '/';
                            $fileName = $val;
                            image1::make($destinationPath . $fileName)->save($destinationoriginal . $fileName);
                            image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                            image1::make($destinationPath . $fileName)->resize(950, 530)->save($destinationPaththumb1 . $fileName);
                            $attachmentData[] = array('classified_id' => $classified->id, 'name' => $fileName);
                        }
                        \DB::table('classifiedimage')->insert($attachmentData);
                    }
                    if (!empty($returnValueArrForImage)) {

                        foreach ($returnValueArrForImage as $key => $val) {

                            foreach ($val as $k => $v) {
                                foreach ($v as $k3 => $v3) {
//                                            dd($k);
                                    if (!is_dir('upload_images/attribute_values/image-gallery/' . $classified->id . '/' . $k)) {
                                        File::makeDirectory('upload_images/attribute_values/image-gallery/' . $classified->id . '/' . $k, 0777, true);
                                    }
                                    $destinationPath = 'upload_images/sample_file/temp_file/';
                                    $destinationoriginal = 'upload_images/attribute_values/image-gallery/' . $classified->id . '/' . $k . '/';
                                    $fileName = $v3;
                                    image1::make($destinationPath . $fileName)->save($destinationoriginal . $fileName);
                                }
                            }
                        }
                    }
                }

                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully Updated.');
                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false, 'message' => $errorMsg]);
            }
        }
    }

    /**
     * Admin csv
     * function for import food products
     *
     * @return void
     * @access public
     */
    public function admin_import_csv_food() {


        $dataField = Input::file();
        $newAttr = [];

        $zipDestination = 'upload_images/sample_file/temp_file/';
        $zipfile = Input::file('zip_upload');
        $extension = $zipfile->getClientOriginalExtension();
        $fileName = 'images' . $extension;
        $zipSource = $zipDestination . $fileName;
        $zipfile->move($zipDestination, $fileName);
        system("unzip -qd " . $zipDestination . " " . $zipSource);
        unlink($zipSource);
        $allImagesName = scandir($zipDestination);
        $allImagesName = array_diff($allImagesName, array('.', '..'));



        if (isset($dataField['zip_upload'])) {
            $zipfile = Input::file('zip_upload');
        }

        if (isset($dataField['csv_upload'])) {
            $file = Input::file('csv_upload');
            $filename = $file->getClientOriginalName();
            $filename1 = $file->getPathName();

            $cat_ids = explode('_', $filename);
            $cat_id = $cat_ids[0];

            $cat_detail = DB::table('categories')->where(['id' => $cat_id])->first();
            if ($cat_detail->pid != 0) {
                $cate_p_id = $cat_detail->pid;
                $cate_c_id = $cat_detail->id;
            } else {
                $cate_p_id = $cat_detail->id;
                $cate_c_id = 0;
            }

            $dataResult = Category::where("id", "=", $cat_id)->with(['attributes' => function ($query) {
                            $query->select("id", "name", "attributetype_id", "attribute_value", "required", "p_attr_id")->with(['attributeType' => function($q) {
                                    $q->select("id", "name", "slug", "status");
                                }]);
                        }])->select("id", "name", "belong_to_community")->where(['status' => 1])->first();
            $defaultFields = ['name', 'description', 'ingredient', 'bar_code', 'nutrition','image',
                'metakeyword', 'metadescription', 'status'];

            $defaultFieldsWithArray = [
                'name' => ['attrName' => 'name', 'required' => 1],
                'description' => ['attrName' => 'description', 'required' => 0],
                'ingredient' => ['attrName' => 'Ingredient', 'required' => 1],
                'bar_code' => ['attrName' => 'bar_code', 'required' => 1],
                'nutrition' => ['attrName' => 'nutrition', 'required' => 1],
                'image' => ['attrName' => 'image', 'required' => 1],
                'metakeyword' => ['attrName' => 'metakeyword', 'required' => 0],
                'metadescription' => ['attrName' => 'metadescription', 'required' => 0],
                'status' => ['attrName' => 'status', 'required' => 0]
            ];
            if (!empty($dataResult['attributes'])) {

                $attrValues = [];
                $attrValuesWithArray = [];
                $attrValuesForSimilarColumn = [];

                foreach ($dataResult->attributes as $key => $value) {
                    if ($value->attributeType->status == 0) {
                        continue;
                    }
                    $value['required'] = 1;
                    if ($value->attributeType->slug == 'Numeric') {
                        $attrValues[] = $value['name'];
                        $attrValuesWithArray[$value['name']]['attribute_id'] = $value['id'];
                        $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                        $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                        $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                        $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;
                        $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                        $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                        if (strpos($value->attribute_value, ',')) {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (' . str_replace(',', ';', $value['attribute_value']) . ')';
                            $attrValuesWithArray[$value['name']]['original_range'] = $value['attribute_value'];
                        } else {
                            $attrValuesForSimilarColumn[] = $value['name'];
                            $attrValuesWithArray[$value['name']]['original_range'] = '';
                        }
                    } else if ($value->attributeType->slug == 'calendar') {
                        $attrValues[] = $value['name'];
                        $attrValuesWithArray[$value['name']]['attribute_id'] = $value['id'];
                        $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                        $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                        $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                        $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;
                        $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                        $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                        if (strpos($value->attribute_value, ',')) {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (' . $value['attribute_value'] . ')';
                            $attrValuesWithArray[$value['name']]['original_range'] = $value['attribute_value'];
                        } else {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (YYYY)';
                            $attrValuesWithArray[$value['name']]['original_range'] = '';
                        }
                    } else if ($value->attributeType->slug == 'Date') {
                        $attrValuesWithArray[$value['name']]['attribute_id'] = $value['id'];
                        $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                        $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                        $attrValues[] = $value['name'];
                        $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                        $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;
                        $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                        $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                        if ($value->attribute_value == 'on') {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (MM-DD-YYYY;MM-DD-YYYY)';
                            $attrValuesWithArray[$value['name']]['original_range'] = '1700-01-01;9999-01-01';
                        } else {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (MM-DD-YYYY)';
                            $attrValuesWithArray[$value['name']]['original_range'] = '';
                        }
                    } else if ($value->attributeType->slug == 'Time') {
                        $attrValuesWithArray[$value['name']]['attribute_id'] = $value['id'];
                        $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                        $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                        $attrValues[] = $value['name'];
                        $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                        $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;
                        $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                        $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                        if ($value->attribute_value == 'on') {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (HH:MM:SS;HH:MM:SS)';
                            $attrValuesWithArray[$value['name']]['original_range'] = '00:00:00;24:00:00';
                        } else {
                            $attrValuesForSimilarColumn[] = $value['name'] . ' (HH:MM:SS)';
                            $attrValuesWithArray[$value['name']]['original_range'] = '';
                        }
                    } else if ($value->attributeType->slug == 'Drop-Down') {
                        
                        $attrValuesForSimilarColumn[] = $value['name'];
                        $attrValues[] = $value['name'];
                        $attrValuesWithArray[$value['name']]['attribute_id'] = $value['id'];
                        $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                        $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                        $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                        $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;

                        $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                        if ($value->p_attr_id == 0) {
                            $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['id'])->pluck('values', 'id')->toarray();
                        } else {
                            $attrValuesWithArray[$value['name']]['parent_attribute_id'] = $value->p_attr_id;
                            $attr_AllValues = DB::table('attribute_value_child')->where(['attribute_parent_id' => $value['p_attr_id']])->get()->toarray();
                            $collection = collect($attr_AllValues);
                            $attr_AllValues = $collection->keyBy('attribute_value')->toarray();
                        }

                        $attrValuesWithArray[$value['name']]['original_range'] = $attr_AllValues;
                    } else if (in_array($value->attributeType->slug, ['Multi-Select', 'Radio-button'])) {
                        $attrValuesForSimilarColumn[] = $value['name'];
                        $attrValues[] = $value['name'];
                        $attrValuesWithArray[$value['name']]['attribute_id'] = $value['id'];
                        $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                        $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                        $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                        $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;
                        $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                        $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['id'])->pluck('values', 'id')->toarray();
                        $attrValuesWithArray[$value['name']]['original_range'] = $attr_AllValues;
                    } else {
                        
                        if ($value->attributeType->slug != 'Video') {
                            $value->attributeType->slug;
                            $attrValuesForSimilarColumn[] = $value['name'];
                            $attrValues[] = $value['name'];
                            $attrValuesWithArray[$value['name']]['attribute_id'] = $value['id'];
                            $attrValuesWithArray[$value['name']]['attrName'] = $value['name'];
                            $attrValuesWithArray[$value['name']]['required'] = $value['required'];
                            $attrValuesWithArray[$value['name']]['attr_type_name'] = $value->attributeType->slug;
                            $attrValuesWithArray[$value['name']]['parent_value_id'] = 0;
                            $attrValuesWithArray[$value['name']]['parent_attribute_id'] = 0;
                            $attrValuesWithArray[$value['name']]['attr_type_id'] = $value->attributeType->id;
                            $attrValuesWithArray[$value['name']]['original_range'] = $value['attribute_value'];
                        }
                    }
                }
            } else {
                $attrValues = [];
            }
            $allCsvFieldsWithArray = array_merge($defaultFieldsWithArray, $attrValuesWithArray);
            $allCsvFields = array_merge($defaultFields, $attrValues);
            $allCsvFieldsForCmpare = array_merge($defaultFields, $attrValuesForSimilarColumn);

            $handle = fopen($filename1, "r");
            $count = 0;
            $errorMsg = "";
            $headersFromFile = [];
            $dataArray = [];
            $saveFieldsInDb = [];
            $saveImageFieldsInDb = [];
            $returnValueArr = [];
            $returnValueArrForMulti = [];
            $staorAllTitleValue = [];
            $staorAllBarCodeValue = [];

            while ($data = fgetcsv($handle, $argLinelength = 5000, ',', '"')) {
                if ($count == 0) {

                    if (!empty(array_diff($allCsvFieldsForCmpare, $data))) {
                        $errorMsg .= 'Something is wrong, please generate sample file again and upload!';
                        break;
                    }
                    $count++;
                    continue;
                }

                $count++;
                $dataArray = [];
                foreach ($allCsvFields as $key => $val) {
                    $dataArray[$val] = $allCsvFieldsWithArray[$val];
                    $dataArray[$val]['csvValue'] = $data[$key];
                    if (in_array($val, $defaultFields)) {
                        $saveFieldsInDb[$count][$val] = $data[$key];
                    } else {
                        $attrValuesWithArray[$val]['attr_value'] = $data[$key];
                    }
                }
                $contiForReq = false;
                foreach ($dataArray as $key => $value) {
                    if (($value['required'] == 1) && ($value['csvValue'] == '')) {
                        $errorMsg .= "Required Field " . $key . " in row no. " . ($count) . "<br/>";
                        $contiForReq = true;
                    }
                }
                if ($contiForReq) {
                    continue;
                }
                //For name
                $title = $this->getIdByName($dataArray['name']['csvValue'], 'food_products', 'name', 'id');
                if (!$title['error']) {
                    $errorMsg .= "Title name Already exist in database in row no. " . ($count) . "<br/>";
                } else {
                    if (in_array($dataArray['name']['csvValue'], $staorAllTitleValue)) {
                        $errorMsg .= "Title name duplicate in row no. " . ($count) . "<br/>";
                    } else {
                        $staorAllTitleValue[] = $dataArray['name']['csvValue'];
                    }
                }
                //For bar code
                $bar_code = $this->getIdByName($dataArray['bar_code']['csvValue'], 'food_products', 'bar_code', 'id');
                if (!$bar_code['error']) {
                    $errorMsg .= "Bar Code Already exist in database in row no. " . ($count) . "<br/>";
                } else {
                    if (in_array($dataArray['bar_code']['csvValue'], $staorAllBarCodeValue)) {
                        $errorMsg .= "Bar Code duplicate in row no. " . ($count) . "<br/>";
                    } else {
                        $staorAllBarCodeValue[] = $dataArray['bar_code']['csvValue'];
                    }
                }

                    if (!in_array($dataArray['image']['csvValue'], $allImagesName)) {
                        $errorMsg .= "Images name not fount in zip in row no. " . ($count) . "<br/>";
                    } else {

                        $saveImageFieldsInDb[$count]['image'][] = $dataArray['image']['csvValue'];
                    }
                    
                //For category ids
                $saveFieldsInDb[$count]['category_id'] = $cat_id;

                //For status
                $saveFieldsInDb[$count]['status'] = (int) $dataArray['status']['csvValue'];
                //For user id
                foreach ($attrValuesWithArray as $key => $value) {
                    if ($value['required'] == 0 && $value['attr_value'] == '') {
                        continue;
                    }
                    $value['attr_value'] = preg_replace('/\s+/', '', $value['attr_value']);
                    $returnValueArr[$count][$value['attribute_id']]['attr_type_name'] = $value['attr_type_name'];
                    $returnValueArr[$count][$value['attribute_id']]['attr_type_id'] = $value['attr_type_id'];
                    $returnValueArr[$count][$value['attribute_id']]['parent_value_id'] = 0;
                    $returnValueArr[$count][$value['attribute_id']]['parent_attribute_id'] = 0;

                    if ($value['attr_type_name'] == 'calendar') {
                        if ($value['original_range'] != '') {
                            $rangVal = explode(',', $value['original_range']);
                            $attrRang = explode(';', $value['attr_value']);
                            if ((strpos($value['attr_value'], ';') === false) || ($attrRang[0] > $attrRang[1]) || ($attrRang[0] < $rangVal[0]) || ($attrRang[1] > $rangVal[1])) {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                            }
                        } else {
                            $value['attr_value'] = (int) $value['attr_value'];
                            if (strlen($value['attr_value']) != 4) {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                            }
                        }
                    } else if ($value['attr_type_name'] == 'Numeric') {
                        if ($value['original_range'] != '') {
                            $rangVal = explode(',', $value['original_range']);
                            $attrRang = explode(';', $value['attr_value']);
                            if ((strpos($value['attr_value'], ';') === false) || (!preg_match("/^[1-9]\d*$/", $attrRang[0])) || (!preg_match("/^[1-9]\d*$/", $attrRang[1])) || ($attrRang[0] > $attrRang[1]) || ($attrRang[0] < (int) $rangVal[0]) || ($attrRang[1] > (int) $rangVal[1])) {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                            }
                        } else {
                            if (!preg_match("/^[1-9]\d*$/", $value['attr_value'])) {
                                $errorMsg .= "Invalid == value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                            }
                        }
                    } else if ($value['attr_type_name'] == 'Time') {
                        if ($value['original_range'] != '') {
                            $rangVal = explode(';', $value['original_range']);
                            $attrRang = explode(';', $value['attr_value']);
                            if ((strpos($value['attr_value'], ';') === false) || (!preg_match("/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/", $attrRang[0])) || (!preg_match("/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/", $attrRang[1])) || (new DateTime($attrRang[0]) > new DateTime($attrRang[1])) || (new DateTime($attrRang[0]) < new DateTime($rangVal[0])) || (new DateTime($attrRang[1]) > new DateTime($rangVal[1]))) {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                            }
                        } else {
                            if (!preg_match("/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/", $value['attr_value'])) {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                            }
                        }
                    } else if ($value['attr_type_name'] == 'Date') {
                        if ($value['original_range'] != '') {
                            $rangVal = explode(';', $value['original_range']);
                            $attrRang = explode(';', $value['attr_value']);
                            $attrRang[0] = str_replace('/', '-', $attrRang[0]);
                            $attrRang[1] = str_replace('/', '-', $attrRang[1]);
                            if ((strpos($value['attr_value'], ';') === false) || (!preg_match("/^(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])\-\d{4}$/", $attrRang[0])) || (!preg_match("/^(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])\-\d{4}$/", $attrRang[1]))) {

                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $pieces = explode("-", $attrRang[0]);
                                $attrRang[0] = $pieces[2] . '-' . $pieces[0] . '-' . $pieces[1];
                                $pieces22 = explode("-", $attrRang[1]);
                                $attrRang[1] = $pieces22[2] . '-' . $pieces22[0] . '-' . $pieces22[1];

                                if (($attrRang[0] > $attrRang[1]) || ($attrRang[0] < $rangVal[0])) {
                                    $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                                } else {
                                    $returnValueArr[$count][$value['attribute_id']]['attr_value'] = str_replace('-', '/', $value['attr_value']);
                                }
                            }
                        } else {
                            $value['attr_value'] = str_replace('/', '-', $value['attr_value']);
                            if (!preg_match("/^(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])\-\d{4}$/", $value['attr_value'])) {
                                $errorMsg .= "Invalid 1111value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = str_replace('-', '/', $value['attr_value']);
                            }
                        }
                    } else if (in_array($value['attr_type_name'], ['Drop-Down'])) {
                        if ($value['parent_attribute_id'] == 0) {
                            if (!empty($value['original_range']) && (trim($value['attr_value']) != '') && !in_array(trim($value['attr_value']), $value['original_range'])) {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            } else {

                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = array_search($value['attr_value'], $value['original_range']);
                            }
                        } else {
                            $parentValueId = $returnValueArr[$count][$value['parent_attribute_id']]['attr_value'];
                            if ((!empty($value['original_range'][$value['attr_value']])) && ($value['original_range'][$value['attr_value']]->attribute_value_id == $parentValueId)) {
                                $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['original_range'][$value['attr_value']]->id;
                                $returnValueArr[$count][$value['attribute_id']]['parent_value_id'] = $value['original_range'][$value['attr_value']]->attribute_value_id;
                                $returnValueArr[$count][$value['attribute_id']]['parent_attribute_id'] = $value['parent_attribute_id'];
                            } else {
                                $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                            }
                        }
                    } else if (in_array($value['attr_type_name'], ['Radio-button'])) {
                        if ((!empty($value['original_range']) != '') && (trim($value['attr_value']) != '') && !in_array(trim($value['attr_value']), $value['original_range'])) {
                            $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                        } else {
                            $returnValueArr[$count][$value['attribute_id']]['attr_value'] = array_search($value['attr_value'], $value['original_range']);
                        }
                    } else if (in_array($value['attr_type_name'], ['Multi-Select'])) {
                        $multiArrVal = [];
                        $multiArrVal = explode(';', preg_replace('/\s+/', '', rtrim($value['attr_value'], ',')));
                        if (count(array_unique($multiArrVal)) < count($multiArrVal)) {
                            $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                        } else {
                            foreach ($multiArrVal as $k1 => $v1) {
                                if (!in_array($v1, $value['original_range'])) {
                                    $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                                } else {
                                    $attrValMulti = array_search($v1, $value['original_range']);
                                    $returnValueArrForMulti[$count][$attrValMulti]['attr_value'] = $attrValMulti;
                                    $returnValueArrForMulti[$count][$attrValMulti]['attribute_id'] = $value['attribute_id'];
                                    $returnValueArrForMulti[$count][$attrValMulti]['attr_type_name'] = $value['attr_type_name'];
                                    $returnValueArrForMulti[$count][$attrValMulti]['attr_type_id'] = $value['attr_type_id'];
                                    unset($returnValueArr[$count][$value['attribute_id']]);
                                }
                            }
                        }
                    } else if (in_array($value['attr_type_name'], ['Image-Gallery'])) {


                    } else if ($value['attr_type_name'] == 'Email') {

                        if (!filter_var($value['attr_value'], FILTER_VALIDATE_EMAIL)) {
                            $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                        } else {

                            $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                        }
                    } else if ($value['attr_type_name'] == 'Url') {

                        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $value['attr_value'])) {
                            $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                        } else {

                            $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                        }
                    } else if ($value['attr_type_name'] == 'Color') {

                        if (!preg_match('/#([a-fA-F0-9]{3}){1,2}\b/', $value['attr_value'])) {
                            $errorMsg .= "Invalid value $value[attrName] in row no. " . ($count) . "<br/>";
                        } else {

                            $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                        }
                    } else {
                        $returnValueArr[$count][$value['attribute_id']]['attr_value'] = $value['attr_value'];
                    }
                }
                continue;




                //For Attr value from csv
                if (!empty($attrValues)) {
                    foreach ($attrValues as $index => $attrname) {
                        $attr_value[$index]['attr_value'] = $dataArray[$count][$attrname];
                        $attr_value[$index]['attr_type_id'] = $attrType_id[$index];
                        $attr_value[$index]['attr_type_name'] = $attrSlugName[$index];
                    }
                }
                $dataExtra = array_combine($attr_ids, $attr_value);
                $dataExtraArray[$count] = $dataExtra;
            }


            if (empty($errorMsg)) {

                $dataForSave = new FoodProduct();
                foreach ($saveFieldsInDb as $k => $v) {
                    $classified = $dataForSave->create($v);
                    if (isset($returnValueArr[$k]) && !empty($returnValueArr[$k])) {
                        $classified->food_product_attribute()->sync($returnValueArr[$k]);
                    }
                    if (isset($returnValueArrForMulti[$k]) && !empty($returnValueArrForMulti[$k])) {
                        foreach ($returnValueArrForMulti[$k] as $ke => $val) {
                            $val['food_product_id'] = $classified->id;
                            \DB::table('attribute_classified')->insert($val);
                        }
                    }
                    if (!empty($saveImageFieldsInDb)) {

                        $attachmentData = array();
                        if (!is_dir('upload_images/food_products/backgroundimage/' . $classified->id)) {
                            File::makeDirectory('upload_images/food_products/backgroundimage/' . $classified->id, 0777, true);
                        }
                        if (!is_dir('upload_images/food_products/backgroundimage/30px/' . $classified->id)) {
                            File::makeDirectory('upload_images/food_products/backgroundimage/30px/' . $classified->id, 0777, true);
                        }
                        if (!is_dir('upload_images/food_products/backgroundimage/950x530px/' . $classified->id)) {
                            File::makeDirectory('upload_images/food_products/backgroundimage/950x530px/' . $classified->id, 0777, true);
                        }
                        foreach ($saveImageFieldsInDb[$k]['image'] as $key => $val) {
                            $destinationPath = 'upload_images/sample_file/temp_file/';
                            $destinationoriginal = 'upload_images/food_products/backgroundimage/' . $classified->id . '/';
                            $destinationPaththumb = 'upload_images/food_products/backgroundimage/30px/' . $classified->id . '/';
                            $destinationPaththumb1 = 'upload_images/food_products/backgroundimage/950x530px/' . $classified->id . '/';
                            $fileName = $val;
                            image1::make($destinationPath . $fileName)->save($destinationoriginal . $fileName);
                            image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                            image1::make($destinationPath . $fileName)->resize(950, 530)->save($destinationPaththumb1 . $fileName);
                        }
                    }
                }

                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully Updated.');
                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false, 'message' => $errorMsg]);
            }
        }
    }

    /**
     * get attribute
     * function for get any attribute by name
     *
     * @return void
     * @access public
     */
    public function getIdByName($name, $tableName, $columnName, $returnId) {

        $data = DB::table($tableName)->where([$columnName => $name])->first();
        if (!empty($data)) {
            $returnArray['id'] = $data->$returnId;
            $returnArray['error'] = false;
        } else {
            $returnArray['error'] = true;
        }
        return $returnArray;
    }

    /**
     * getlocation
     * function for getlocation
     *
     * @return $response
     * @access public
     */
    public function getDetailLocation($address = null) {

        $curl = curl_init();
        $address = str_replace(' ', ',', $address);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://maps.googleapis.com/maps/api/geocode/json?address=$address",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: a762c1f0-232c-5a43-2477-4df7142a3b7f"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $response = json_decode($response);
        $addArrRturn = ['state' => '', 'city' => '', 'pincode' => '', 'lat' => '', 'lng' => ''];
        if (empty($response->results)) {
            return $addArrRturn['status'] = false;
        }
        foreach ($response->results[0]->address_components as $key => $value) {
            $addressType = $value->types[0];

            if ($addressType == 'country' && ($value->long_name != 'Australia')) {
                return $addArrRturn['status'] = false;
            }

            if ($addressType == 'administrative_area_level_1') {
                $addArrRturn['state'] = $value->long_name;
            }

            if ($addressType == 'locality') {
                $addArrRturn['city'] = $value->long_name;
            }

            if ($addressType == 'postal_code') {
                $addArrRturn['pincode'] = $value->short_name;
            }
        }
        $addArrRturn['lat'] = $response->results[0]->geometry->location->lat;
        $addArrRturn['lng'] = $response->results[0]->geometry->location->lng;

        if (($addArrRturn['state'] == '') || ($addArrRturn['city'] == '') || ($addArrRturn['pincode'] == '') || ($addArrRturn['lat'] == '') || ($addArrRturn['lng'] == '')) {
            return $addArrRturn['status'] = false;
        }

        $stateDb = DB::table('state')->where(['name' => $addArrRturn['state'], 'country_id' => 14])->first();

        if ($stateDb == null) {
            $addArrRturn['state'] = '';
            $addArrRturn['status'] = false;
        } else {
            $addArrRturn['state'] = $stateDb->id;
            $addArrRturn['status'] = true;
        }

        $cityDb = DB::table('cities')->where(['City' => $addArrRturn['city'], 'CountryID' => 14])->first();
        if ($cityDb == null) {
            $city = [];
            $city = ['CountryID' => 14, 'City' => $addArrRturn['city'], 'Latitude' => $addArrRturn['lat'], 'Longitude' => $addArrRturn['lng']];
            $result = City::create($city);
            $addArrRturn['city'] = $result->id;
            $addArrRturn['status'] = true;
        } else {
            $addArrRturn['status'] = true;
            $addArrRturn['city'] = $cityDb->CityId;
        }

        if (($addArrRturn['state'] == '') || ($addArrRturn['city'] == '') || ($addArrRturn['pincode'] == '') || ($addArrRturn['lat'] == '') || ($addArrRturn['lng'] == '')) {
            return $addArrRturn['status'] = false;
        }
        if ($err) {
            return false;
        } else {
            return $addArrRturn;
        }
    }

    /**
     * check all attribute
     * function for multiplecheck
     *
     * @return response
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
                DB::table('attributes')
                        ->where('id', $value)
                        ->update(['status' => $data['status']]);
            }
            return response()->json(['status' => true, 'url' => "attributes$pid"]);
        }
    }

    /**
     * generate csv
     * function for csv
     *
     * @return void
     * @access public
     */
    public function admin_generate_csv() {

        $data = Input::all();
        $newAttr = [];

        if ($data['child_categories'] != '') {
            $data['id'] = $data['child_categories'];
        } else {
            $data['id'] = $data['p_categories'];
        }

        if (isset($data['id']) && $data['id'] != '') {

            $data = Category::where("id", "=", $data['id'])->with(['attributes' => function ($query) {
                            $query->select("id", "name", "attributetype_id", "attribute_value")->with(['attributeType' => function($q) {
                                    $q->select("id", "name", "slug", "status");
                                }]);
                        }])->select("id", "name")->where(['status' => 1])->first();

            $defaultFields = ['title', 'description', 'location', 'contact_name', 'contact_email',
                'contact_mobile', 'price', 'images', 'website', 'featured_classified', 'start_date', 'status'];
            if (!empty($data['attributes'])) {

                $attrValues = [];
                foreach ($data->attributes as $key => $value) {
                    if ($value->attributeType->status == 0) {
                        continue;
                    }

                    if ($value->attributeType->slug == 'Numeric') {
                        if (strpos($value->attribute_value, ',')) {
                            $attrValues[] = $value['name'] . ' (' . str_replace(',', ';', $value['attribute_value']) . ')';
                        } else {
                            $attrValues[] = $value['name'];
                        }
                    } else if ($value->attributeType->slug == 'calendar') {
                        if (strpos($value->attribute_value, ',')) {
                            $attrValues[] = $value['name'] . ' (' . $value['attribute_value'] . ')';
                        } else {
                            $attrValues[] = $value['name'] . ' (YYYY)';
                        }
                    } else if ($value->attributeType->slug == 'Date') {
                        if ($value->attribute_value == 'on') {
                            $attrValues[] = $value['name'] . ' (MM-DD-YYYY;MM-DD-YYYY)';
                        } else {
                            $attrValues[] = $value['name'] . ' (MM-DD-YYYY)';
                        }
                    } else if ($value->attributeType->slug == 'Time') {
                        if ($value->attribute_value == 'on') {
                            $attrValues[] = $value['name'] . ' (HH:MM:SS;HH:MM:SS)';
                        } else {
                            $attrValues[] = $value['name'] . ' (HH:MM:SS)';
                        }
                    } else {
                        $attrValues[] = $value['name'];
                    }
                }
            } else {
                $attrValues = [];
            }
            $allCsvFields = array_merge($defaultFields, $attrValues);
            $filename = $data['id'] . '_' . time() . '.csv';
            $destination_file = 'upload_images/sample_file/original_csv/original_csv.csv';
            $newfile = 'upload_images/sample_file/sample_files/' . $filename;
            if (copy($destination_file, $newfile)) {
                $tempFile = fopen($newfile, "w");
                fputcsv($tempFile, $allCsvFields);
                @chmod($newfile, 777);
                $status = true;
            } else {
                $status = false;
            }
        } else {
            $status = false;
        }


        $this->downloadfile($allCsvFields, $filename);

    }

    /**
     * generate csv for food category
     * function for csv
     *
     * @return void
     * @access public
     */
    public function admin_generate_csv_food() {

        $data = Category::where("id", "=", 138)->with(['attributes' => function ($query) {
                        $query->select("id", "name", "attributetype_id", "attribute_value")->with(['attributeType' => function($q) {
                                $q->select("id", "name", "slug", "status");
//                                            $q->where(['status' => 1]);
                            }]);
                    }])->select("id", "name")->where(['status' => 1])->first();

        $defaultFields = ['name', 'description', 'ingredient', 'bar_code', 'nutrition', 'image',
            'metakeyword', 'metadescription', 'status'];
        if (!empty($data['attributes'])) {

            $attrValues = [];
            foreach ($data->attributes as $key => $value) {
                if ($value->attributeType->status == 0) {
                    continue;
                }

                if ($value->attributeType->slug == 'Numeric') {
                    if (strpos($value->attribute_value, ',')) {
                        $attrValues[] = $value['name'] . ' (' . str_replace(',', ';', $value['attribute_value']) . ')';
                    } else {
                        $attrValues[] = $value['name'];
                    }
                } else if ($value->attributeType->slug == 'calendar') {
                    if (strpos($value->attribute_value, ',')) {
                        $attrValues[] = $value['name'] . ' (' . $value['attribute_value'] . ')';
                    } else {
                        $attrValues[] = $value['name'] . ' (YYYY)';
                    }
                } else if ($value->attributeType->slug == 'Date') {
                    if ($value->attribute_value == 'on') {
                        $attrValues[] = $value['name'] . ' (MM-DD-YYYY;MM-DD-YYYY)';
                    } else {
                        $attrValues[] = $value['name'] . ' (MM-DD-YYYY)';
                    }
                } else if ($value->attributeType->slug == 'Time') {
                    if ($value->attribute_value == 'on') {
                        $attrValues[] = $value['name'] . ' (HH:MM:SS;HH:MM:SS)';
                    } else {
                        $attrValues[] = $value['name'] . ' (HH:MM:SS)';
                    }
                } else {
                    if ($value->attributeType->slug != 'Video') {
                        $attrValues[] = $value['name'];
                    }
                }
            }
        } else {
            $attrValues = [];
        }
        $allCsvFields = array_merge($defaultFields, $attrValues);
//        dd($allCsvFields);
        $filename = $data['id'] . '_' . time() . '.csv';
        $destination_file = 'upload_images/sample_file/original_csv/original_csv.csv';
        $newfile = 'upload_images/sample_file/sample_files/' . $filename;
        if (copy($destination_file, $newfile)) {
            $tempFile = fopen($newfile, "w");
            fputcsv($tempFile, $allCsvFields);
            @chmod($newfile, 777);
            $status = true;
        } else {
            $status = false;
        }


        $this->downloadfile($allCsvFields, $filename);

    }

    /**
     * download csv
     * function for csv
     *
     * @return void
     * @access public
     */
    public function downloadfile($allCsvFields, $filename) {
        $csv_terminated = "\n";
        $csv_separator = ",";
        $csv_enclosed = '"';
        $csv_escaped = "\\";

        $schema_insert = '';

        foreach ($allCsvFields as $heading) {
            $l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, stripslashes($heading)) . $csv_enclosed;
            $schema_insert .= $l;
            $schema_insert .= $csv_separator;
        } // end for
        $out = trim(substr($schema_insert, 0, -1));
        $out .= $csv_terminated;


        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Length: " . strlen($out));
        header("Content-type: text/x-csv");
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=$filename");
        echo $out;
        exit;
    }

    /**
     * get all attriutes
     * function get attributes
     *
     * @return response
     * @access public
     */
    public function admin_allattributes() {

        $data = Input::all();
        $newAttr = [];
        if (isset($data['id']) && $data['id'] != '') {
            $data = Category::where("id", "=", $data['id'])
                            ->with(['attributes' => function ($query) {
                                    $query->select("id", "display_name", "attributetype_id", "attribute_value", "p_attr_id", "required", "size", "measure_unit")
                                    ->where(['p_attr_id' => 0, 'status' => 1, 'is_active' => 1])
                                    ->with(['attributeType' => function($q) {
                                            $q->select("id", "name", "slug");
                                        }]);
                                }])->select("id", "name", "pid")->first();

            foreach ($data->attributes->toarray() as $k => $v) {
                $allAttrValue = AttributeValue::where('attribute_id', $v['id'])->pluck('values', 'id');

                if (!empty($allAttrValue->toarray())) {
                    $newAttr[$v['id']]['attribute_value_multi'] = $allAttrValue->toarray();
                } else {
                    $newAttr[$v['id']]['attribute_value_multi'] = [];
                }
            }
            foreach ($data->attributes as $key => $value) {

                $newAttr[$value['id']]['attribute_name'] = ucwords($value['display_name']);
                $newAttr[$value['id']]['required'] = $value['required'];
                $newAttr[$value['id']]['size'] = $value['size'];
                $newAttr[$value['id']]['measure_unit'] = $value['measure_unit'];
                $newAttr[$value['id']]['p_attr_id'] = $value['p_attr_id'];
                $newAttr[$value['id']]['attribute_type']['name'] = $value['attributeType']['slug'];
                $newAttr[$value['id']]['attribute_type']['id'] = $value['attributeType']['id'];
            }

            if ($data->pid != 0) {
                $attrGroup = Group::where(['category_id' => $data['id']])->with(['attributes_groups'])->get();
                if (!empty($attrGroup->toArray())) {
                    foreach ($attrGroup as $key => $value) {
                        if (!empty($value->attributes_groups)) {

                            foreach ($value->attributes_groups as $k1 => $v1) {

                                $other_saved_attr_ids[] = $v1['id'];
                            }
                        } else {
                            $other_saved_attr_ids = [];
                        }
                    }
                } else {
                    $other_saved_attr_ids = [];
                }
            } else {
                $other_saved_attr_ids = [];
            }
        }

        return response()->json(['status' => true, 'attributes' => $newAttr, 'other_saved_attr_ids' => $other_saved_attr_ids]);
    }

    /**
     * get all attriutes for api
     * function for csv
     *
     * @return response
     * @access public
     */
    public function showallattributeapi(Request $request) {
        $categoryid = $request->categoryid;
        $filter = $request->filter;
        $newAttr = [];
        if ($filter == 1) {
            $conditions = array('p_attr_id' => 0, 'status' => 1, 'is_active' => 1, 'searchable' => 1);
        } else {
            $conditions = array('p_attr_id' => 0, 'status' => 1, 'is_active' => 1);
        }

        if ($categoryid != '') {
            $data = Category::where("id", "=", $categoryid)
                            ->with(['attributes' => function ($query)use($conditions) {
                                    $query->select("id", "name", "attributetype_id", "attribute_value", "p_attr_id", "required", "size", "measure_unit", "display_name")
                                    ->where($conditions)
                                    ->with(['attributeType' => function($q) {
                                            $q->select("id", "name", "slug");
                                        }]);
                                }])->select("id", "name", "show_static_attributes", "pid")->first();
            $pid = $data->pid;
            if (!empty($pid)) {
                $childCategoryName = Category::select('name', 'show_static_attributes')->where(['id' => $pid])->first();
                $staticattribute = $childCategoryName->show_static_attributes;
            } else {
                $staticattribute = $data->show_static_attributes;
            }
            foreach ($data->attributes->toarray() as $k => $v) {
                $allAttrValue = AttributeValue::where('attribute_id', $v['id'])->pluck('values', 'id');

                if (!empty($allAttrValue->toarray())) {
                    $newAttr[$v['id']]['attribute_value_multi'] = $allAttrValue->toarray();
                } else {
                    $newAttr[$v['id']]['attribute_value_multi'] = [];
                }
            }
            foreach ($data->attributes as $key => $value) {

                $newAttr[$value['id']]['attribute_name'] = $value['name'];
                $newAttr[$value['id']]['display_name'] = $value['display_name'];
                $newAttr[$value['id']]['required'] = $value['required'];
                $newAttr[$value['id']]['size'] = $value['size'];
                $newAttr[$value['id']]['measure_unit'] = $value['measure_unit'];
                $newAttr[$value['id']]['p_attr_id'] = $value['p_attr_id'];
                $newAttr[$value['id']]['attribute_type']['name'] = $value['attributeType']['slug'];
                $newAttr[$value['id']]['attribute_type']['id'] = $value['attributeType']['id'];
            }
            $attributearr = array();
            $attributearrMain = array();

            foreach ($newAttr as $key => $value) {
                if (in_array($value['attribute_type']['name'], ['text', 'Url', 'Email', 'textarea', 'calendar', 'Drop-Down', 'Color', 'Time', 'Date', 'Numeric', 'Radio-button', 'Multi-Select'])) {
                    if (in_array($value['attribute_type']['name'], ["text"])) {
//                                                       
                        $attributearr['att_id'] = $key;
                        $attributearr['att_name'] = $value['display_name'];
                        $attributearr['attr_type'] = 1;
                        $attributearr['attr_type_name'] = 'text';
                        $attributearr['size'] = $value['size'];
                        $attributearr['measure_unit'] = $value['measure_unit'];
                        $attributearr['validation'] = $value['required'];
                        $attributearr['value'] = array();
                    } elseif (in_array($value['attribute_type']['name'], ["Color"])) {
                        $attributearr['att_id'] = $key;
                        $attributearr['att_name'] = $value['display_name'];
                        $attributearr['attr_type'] = 12;
                        $attributearr['attr_type_name'] = 'Color';
                        $attributearr['validation'] = $value['required'];
                        $attributearr['value'] = array();
                    } elseif (in_array($value['attribute_type']['name'], ["Url"])) {
                        $attributearr['att_id'] = $key;
                        $attributearr['att_name'] = $value['display_name'];
                        $attributearr['attr_type'] = 9;
                        $attributearr['attr_type_name'] = 'Url';
                        $attributearr['validation'] = $value['required'];
                        $attributearr['value'] = array();
                    } elseif (in_array($value['attribute_type']['name'], ["Email"])) {
                        $attributearr['att_id'] = $key;
                        $attributearr['att_name'] = $value['display_name'];
                        $attributearr['attr_type'] = 3;
                        $attributearr['attr_type_name'] = 'Email';
                        $attributearr['validation'] = $value['required'];
                        $attributearr['value'] = array();
                    } elseif (in_array($value['attribute_type']['name'], ["textarea"])) {
                        $attributearr['att_id'] = $key;
                        $attributearr['att_name'] = $value['display_name'];
                        $attributearr['attr_type'] = 2;
                        $attributearr['attr_type_name'] = 'textarea';
                        $attributearr['size'] = $value['size'];
                        $attributearr['measure_unit'] = $value['measure_unit'];
                        $attributearr['validation'] = $value['required'];
                        $attributearr['value'] = array();
                    } elseif (in_array($value['attribute_type']['name'], ["Drop-Down"])) {
                        $attributearr['att_id'] = $key;
                        $attributearr['att_name'] = $value['display_name'];
                        $attributearr['attr_type'] = 4;
                        $attributearr['attr_type_name'] = 'Drop-Down';
                        $attributearr['validation'] = $value['required'];
                        foreach ($value['attribute_value_multi'] as $val => $valuesdata) {
                            $valuearr[] = array(
                                'id' => $val,
                                'name' => $valuesdata,
                            );
                        }
                        $attributearr['value'] = $valuearr;
                        unset($valuearr);
                    } elseif (in_array($value['attribute_type']['name'], ["Radio-button"])) {
                        $attributearr['att_id'] = $key;
                        $attributearr['att_name'] = $value['display_name'];
                        $attributearr['attr_type'] = 7;
                        $attributearr['attr_type_name'] = 'Radio-button';
                        $attributearr['validation'] = $value['required'];
                        foreach ($value['attribute_value_multi'] as $val => $valuesdata) {
                            $valuearrradio[] = array(
                                'id' => $val,
                                'name' => $valuesdata,
                            );
                        }
                        $attributearr['value'] = $valuearrradio;
                        unset($valuearrradio);
                    } elseif (in_array($value['attribute_type']['name'], ["Multi-Select"])) {
                        $attributearr['att_id'] = $key;
                        $attributearr['att_name'] = $value['display_name'];
                        $attributearr['attr_type'] = 5;
                        $attributearr['attr_type_name'] = 'Multi-Select';
                        $attributearr['validation'] = $value['required'];
                        foreach ($value['attribute_value_multi'] as $val => $valuesdata) {
                            $valuearrmulti[] = array(
                                'id' => $val,
                                'name' => $valuesdata,
                            );
                        }
                        $attributearr['value'] = $valuearrmulti;
                        unset($valuearrmulti);
                    } elseif (in_array($value['attribute_type']['name'], ["Date"])) {
                        $attributearr['att_id'] = $key;
                        $attributearr['att_name'] = $value['display_name'];
                        $attributearr['attr_type'] = 19;
                        $attributearr['attr_type_name'] = 'Date';
                        $attributearr['validation'] = $value['required'];
                        if (!empty($value['attribute_value_multi'])) {
                            $isrange = 1;
                            $attributearr['range'] = $isrange;
                        } else {
                            $isrange = 0;
                            $attributearr['range'] = $isrange;
                        }
                        $attributearr['value'] = array();
                    } elseif (in_array($value['attribute_type']['name'], ["Time"])) {
                        $attributearr['att_id'] = $key;
                        $attributearr['att_name'] = $value['display_name'];
                        $attributearr['attr_type'] = 13;
                        $attributearr['attr_type_name'] = 'Time';
                        $attributearr['validation'] = $value['required'];
                        if (!empty($value['attribute_value_multi'])) {
                            $isrange = 1;
                            $attributearr['timerange'] = $isrange;
                        } else {
                            $isrange = 0;
                            $attributearr['timerange'] = $isrange;
                        }
                        $attributearr['value'] = array();
                    } elseif (in_array($value['attribute_type']['name'], ["Numeric"])) {
                        $attributearr['att_id'] = $key;
                        $attributearr['att_name'] = $value['display_name'];
                        $attributearr['attr_type'] = 18;
                        $attributearr['attr_type_name'] = 'Numeric';
                        $attributearr['size'] = $value['size'];
                        $attributearr['measure_unit'] = $value['measure_unit'];
                        $attributearr['validation'] = $value['required'];
                        if (!empty($value['attribute_value_multi'])) {
                            $valuearrnumber[] = array(
                                'min' => min($value['attribute_value_multi']),
                                'max' => max($value['attribute_value_multi']),
                            );
                            $attributearr['value'] = $valuearrnumber;
                            $attributearr['numberrange'] = 1;
                        } else {
                            $valuearrnumber[] = array(
                                'min' => 0,
                                'max' => 0,
                            );
                            $attributearr['value'] = $valuearrnumber;
                            $attributearr['numberrange'] = 0;
                        }
                        unset($valuearrnumber);
                    } elseif (in_array($value['attribute_type']['name'], ["calendar"])) {
                        $attributearr['att_id'] = $key;
                        $attributearr['att_name'] = $value['display_name'];
                        $attributearr['attr_type'] = 8;
                        $attributearr['attr_type_name'] = 'calendar';
                        $attributearr['validation'] = $value['required'];
                        if (!empty($value['attribute_value_multi'])) {
                            $valuearrcalander[] = array(
                                'min' => min($value['attribute_value_multi']),
                                'max' => max($value['attribute_value_multi']),
                            );
                            $attributearr['value'] = $valuearrcalander;
                            $attributearr['calanderrange'] = 1;
                        } else {
                            $valuearrcalander[] = array(
                                'min' => 0,
                                'max' => 0,
                            );
                            $attributearr['value'] = $valuearrcalander;
                            $attributearr['calanderrange'] = 0;
                        }
                        unset($valuearrcalander);
                    }

                    if (!in_array($value['attribute_type']['name'], ['text', 'textarea', 'Numeric'])) {
                        unset($attributearr['size']);
                        unset($attributearr['measure_unit']);
                    }

                    $attributearrMain[] = $attributearr;
                    unset($attributearr['range']);
                    unset($attributearr['timerange']);
                }
            }
            $result['status'] = 1;
            $result['show_static_attributes'] = $staticattribute;
            $result['attributes'] = $attributearrMain;
            echo json_encode($result);
            die;
        }
        $result['status'] = 0;
        $result['msg'] = 'No Attributes';
        $result['data'] = array();
        echo json_encode($result);
        die;
    }

    /**
     * get all childattriutes
     * function get childattributes
     *
     * @return response
     * @access public
     */
    public function showallchildattributesapi(Request $request) {

        $attribute_id = $request->attribute_id;
        $attributeValueid = $request->attributeValueid;
        if (!empty($attribute_id) && !empty($attribute_id)) {
            $data = DB::table('attribute_value_child')
                            ->select('attributes.name', 'attributes.display_name', 'attributes.required', 'attribute_value_child.id', 'attribute_value_child.attribute_id', 'attribute_value_child.attribute_parent_id', 'attribute_value_child.attribute_value_id', 'attribute_value_child.attribute_value')
                            ->leftJoin('attributes', function($attr) {
                                $attr->on('attribute_value_child.attribute_id', '=', 'attributes.id');
                            })
                            ->where(['attribute_parent_id' => $attribute_id, 'attribute_value_id' => $attributeValueid, 'status' => 1])->get();
            $data = $data->groupBy('attribute_id');
            $attributearr = array();
            $valuearr = array();
            foreach ($data as $val => $valuesdata) {
                foreach ($valuesdata as $value => $attr) {
                    $attributearr['att_id'] = $attr->attribute_id;
                    $attributearr['att_name'] = $attr->display_name;
                    $attributearr['attr_type'] = 4;
                    $attributearr['attr_type_name'] = 'Drop-Down';
                    $attributearr['validation'] = $attr->required;
                    $valuearr[] = array(
                        'id' => $attr->id,
                        'name' => $attr->attribute_value,
                        'attribute_parent_id' => $attr->attribute_parent_id,
                        'attribute_value_id' => $attr->attribute_value_id,
                    );
                }
            }
            $attributearr['value'] = $valuearr;
            unset($valuearr);
            $data = $data->toarray();
            if (!empty($data)) {
                $result['status'] = 1;
                $result['data'] = $attributearr;
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'No data found';

                echo json_encode($result);
                die;
            }
        } else {
            $result['status'] = 0;
            $result['msg'] = 'Invalid Details';

            echo json_encode($result);
            die;
        }
    }

    /**
     * get all parentattriutes
     * function get attributes
     *
     * @return response
     * @access public
     */
    public function admin_allparrentattributevalues() {

        $data = Input::all();
        if (isset($data['attribute_id']) && $data['attribute_id'] != '') {
            $data = DB::table('attribute_value')->where('attribute_id', $data['attribute_id'])->pluck('values', 'id');
        }
        return response()->json(['status' => true, 'attribute_values' => $data->toarray()]);
    }

    /**
     * get all child attriutes
     * function get child attributes
     *
     * @return response
     * @access public
     */
    public function admin_allchildattributes() {

        $data = Input::all();

        $result = DB::table('attribute_value_child')
                        ->select('attributes.display_name', 'attributes.required', 'attribute_value_child.id', 'attribute_value_child.attribute_id', 'attribute_value_child.attribute_parent_id', 'attribute_value_child.attribute_value_id', 'attribute_value_child.attribute_value')
                        ->leftJoin('attributes', function($attr) {
                            $attr->on('attribute_value_child.attribute_id', '=', 'attributes.id');
                        })
                        ->where(['attribute_parent_id' => $data['attribute_id'], 'attribute_value_id' => $data['attributeValueid'], 'status' => 1])->get();
        $result = $result->groupBy('attribute_id');
        return response()->json(['status' => true, 'attributes' => $result]);
    }

    /**
     * get category
     * function get category
     *
     * @return void
     * @access public
     */
    public function admin_categorydetail($id = null, $categories = null) {
        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $this->model = $this->model->with('categories')->where(['id' => $id]);

        $data = $this->model->get();
        $result = $data[0]['categories'];
        return view('admin/' . $this->viewName . '/categories', compact('modelTitle', 'result', 'controllerName', 'actionName', 'viewName'));
    }

    /**
     * get all attriutes list
     * function get attributes list
     *
     * @return response
     * @access public
     */
    public function admin_attr_list() {
        $data = Input::all();

        $this->model = $this->model->where(['p_attr_id' => $data['id'], 'attributetype_id' => 4]);
        $result = $this->model->pluck('name', 'id');
        return ['status' => 1, 'results' => $result];
    }

    public function testcon() {
        $data = \Input::all();

        $this->model = $this->model->where(['p_attr_id' => $data['id'], 'attributetype_id' => 4]);
        $result = $this->model->pluck('name', 'id');
        return ['status' => 1, 'results' => $result];
    }

    /**
     * update attriutes status
     * function update status
     *
     * @return response
     * @access public
     */
    public function admin_update_attribute_status(Request $request) {

        if ($request->isMethod('post')) {
            if ($request->state == "true") {
                $updated_data["status"] = 1;
            } else {
                $updated_data["status"] = 0;
            }
            \DB::table('attributes')->where("id", $request->id)->update($updated_data);
            if ($updated_data["status"] == 0) {
                \DB::table('attributes')->where(['p_attr_id' => $request->id])->update(['status' => 0]);
            }
        }
    }

}
