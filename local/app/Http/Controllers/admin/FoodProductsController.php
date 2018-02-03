<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\FoodProduct;
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

class FoodProductsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'food_products';
        $this->viewName = 'food_products';
        $this->modelTitle = 'Food Product';
        $this->model = new FoodProduct;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     * indexing of all food categories
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
     * function for create a food product
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
        $categories = $category->categoryValueFirst(['show_on_info_area' => 2]);
        return view('admin/' . $this->viewName . '/add', compact('categories', 'modelTitle', 'controllerName', 'actionName', 'viewName'));
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

            $this->validate($request, [
                'name' => 'required|unique:food_products',
                'image' => 'sometimes|mimes:jpeg,jpg,png|dimensions:width=360,height=235',
                'description' => 'required',
                'ingredient' => 'required',
                'bar_code' => 'required|unique:food_products',
                'nutrition' => 'required',
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

        $result = false;
        if (isset($id)) {
            try {
                $result = $this->model->where('id', '=', $id)->with(['food_product_attribute' => function ($query) {
                                $query->select("attribute_id", 'food_product_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'size', 'measure_unit');
                            }])->first();

                $data['id'] = $result->category_id;
                $data = Category::where("id", "=", $data['id'])
                                ->with(['attributes' => function ($query) {
                                        $query->select("id as attribute_id", "name", "attributetype_id", "required as is_required", "attributetype_id as attr_type_id", "attribute_value as attr_value", "p_attr_id", "required", "size", "measure_unit")
                                        ->where(['p_attr_id' => 0, 'status' => 1, 'is_active' => 1])
                                        ->with(['attributeType' => function($q) {
                                                $q->select("id", "name", "slug");
                                            }]);
                                    }])->select("id")->first();

                $collection = collect($data->attributes->toArray());
                $at_idsArr = $collection->groupBy('attribute_id');

                $collection1 = collect($result->food_product_attribute);
                $at_val_ids = $collection1->implode('attribute_id', ',');
                $at_val_idsArr = explode(',', $at_val_ids);
                $newAttrForUnsaved = [];
                foreach ($at_idsArr as $k1 => $v1) {
                    if (!in_array($k1, $at_val_idsArr)) {
                        $newAttrForUnsaved[$k1]['attribute_id'] = $v1[0]['attribute_id'];
                        $newAttrForUnsaved[$k1]['food_product_id'] = $id;
                        $newAttrForUnsaved[$k1]['attr_value'] = $v1[0]['attr_value'];
                        $newAttrForUnsaved[$k1]['attr_type_id'] = $v1[0]['attr_type_id'];
                        $newAttrForUnsaved[$k1]['attr_type_name'] = $v1[0]['attribute_type']['slug'];
                        $newAttrForUnsaved[$k1]['name'] = $v1[0]['name'];
                        $newAttrForUnsaved[$k1]['p_attr_id'] = $v1[0]['p_attr_id'];
                        $newAttrForUnsaved[$k1]['parent_value_id'] = 0;
                        $newAttrForUnsaved[$k1]['parent_attribute_id'] = 0;
                        $newAttrForUnsaved[$k1]['is_required'] = $v1[0]['is_required'];
                        $newAttrForUnsaved[$k1]['size'] = $v1[0]['size'];
                        $newAttrForUnsaved[$k1]['measure_unit'] = $v1[0]['measure_unit'];
                    }
                }
                $result1 = $result->toArray();
                $result1['food_product_attribute'] = $result1['food_product_attribute'] + $newAttrForUnsaved;
                $multi_select = [];
                foreach ($result1['food_product_attribute'] as $key => $value) {
                    $is_req = DB::table('attributes')->select('required')->where(['id' => $value['attribute_id']])->first();

                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] == 0) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $result1['food_product_attribute'][$key]['attr_AllValues'] = $attr_AllValues->toArray();
                        $result1['food_product_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] != 0) {
                        $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $value['attribute_id'])->where('attribute_value_id', $value['parent_value_id'])->pluck('attribute_value', 'id');
                        $result1['food_product_attribute'][$key]['attr_AllValues'] = $attr_AllValues->toArray();
                        $result1['food_product_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_name'] == 'Numeric') {
                        $attr_AllValuesNumeric = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $result1['food_product_attribute'][$key]['attr_AllValuesNumeric'] = $attr_AllValuesNumeric->toarray();
                        $result1['food_product_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_name'] == 'calendar') {
                        $attr_AllValuesCalendar = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $result1['food_product_attribute'][$key]['attr_AllValuesNumeric'] = $attr_AllValuesCalendar->toarray();
                        $result1['food_product_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_name'] == 'Multi-Select' || $value['attr_type_name'] == 'Radio-button') {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $multi_select[$value['attribute_id']]['attr_ids_multi'] = $value['attribute_id'];
                        $multi_select[$value['attribute_id']]['attr_type_name_multi'] = $value['attr_type_name'];
                        $multi_select[$value['attribute_id']]['name'] = $value['name'];
                        $multi_select[$value['attribute_id']]['attr_type_id_multi'] = $value['attr_type_id'];
                        $multi_select[$value['attribute_id']]['selected'][] = $value['attr_value'];
                        $multi_select[$value['attribute_id']]['attribute_value'] = $attr_AllValues->toArray();
                        $multi_select[$value['attribute_id']]['is_required'] = $is_req->required;
                    } else {
                        $result1['food_product_attribute'][$key]['is_required'] = $is_req->required;
                    }
                }
                if (isset($multi_select) && !empty($multi_select)) {
                    $result1['multi_select'] = $multi_select;
                }
            } catch (ModelNotFoundException $ex) {
                
            }
        }
        return view('admin/' . $this->viewName . '/edit', compact('modelTitle', 'classified', 'controllerName', 'actionName', 'result', 'result1', 'viewName'));
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
                'name' => 'required|unique:food_products,name,' . +$id,
                'image' => 'sometimes|required|mimes:jpeg,bmp,png|dimensions:width=360,height=235',
                'description' => 'required',
                'attr_value_video.*' => 'sometimes|required|max:50000',
                'ingredient' => 'required',
                'bar_code' => 'required|unique:food_products,bar_code,' . +$id,
                'nutrition' => 'required',
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

        $viewName = $this->viewName;
        $id = Input::all()['id'];
        $request = ['status' => 2];

        $result = $this->model->updateRequestValue($request, $id);
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

    /**
     * food_product_list
     * food_product_list product 
     *
     * @return response
     * @access public
     */
    public function food_product_list() {

        $data = Input::all();
        $product_name = $data['product_name'];

        if (!empty($product_name)) {
            $results = DB::table('food_products')
                    ->where('name', 'LIKE', "%{$product_name}%")
                    ->get();
            $names = $results->pluck('name');

            return response()->json(['status' => true, 'names' => $names, 'results' => $results]);
        }
    }

    /**
     * food_product_list
     * food_product_list product 
     *
     * @return response
     * @access public
     */
    public function food_product_detail() {

        $data = Input::all();
        $name = $data['name'];
        $bar_code = $data['bar_code'];

        if (!empty($bar_code)) {
            $results = $this->model
                    ->where(['bar_code' => $bar_code])
                    ->first();
        } else {
            $results = $this->model
                    ->where('name', 'LIKE', "%{$name}%")
                    ->first();
        }

        return response()->json(['status' => true, 'results' => $results]);
    }

    /**
     * admin_export_food
     * admin_export_food food products 
     *
     * @return response
     * @access public
     */
    public function admin_export_food() {

        $data = $this->model->where('status', '=', 1)
                ->orWhere('status', '=', 0)
                ->orderBy('id', 'DESC')
                ->with(['food_product_attribute' => function ($query) {
                        $query->select("attribute_id", 'food_product_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'size', 'measure_unit');
                    }])
                ->get();
        foreach ($data as $k => $result1) {
            foreach ($result1['food_product_attribute'] as $key => $value) {
                $is_req = DB::table('attributes')->select('required')->where(['id' => $value['attribute_id']])->first();

                if ($value['attr_type_id'] == 4 && $value['parent_value_id'] == 0) {
                    $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                    $result1['food_product_attribute'][$key]['attr_AllValues'] = $attr_AllValues->toArray();
                    $result1['food_product_attribute'][$key]['is_required'] = $is_req->required;
                } else
                if ($value['attr_type_name'] == 'Numeric') {
                    $attr_AllValuesNumeric = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                    $result1['food_product_attribute'][$key]['attr_AllValuesNumeric'] = $attr_AllValuesNumeric->toarray();
                    $result1['food_product_attribute'][$key]['is_required'] = $is_req->required;
                } else
                if ($value['attr_type_name'] == 'calendar') {
                    $attr_AllValuesCalendar = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                    $result1['food_product_attribute'][$key]['attr_AllValuesNumeric'] = $attr_AllValuesCalendar->toarray();
                    $result1['food_product_attribute'][$key]['is_required'] = $is_req->required;
                } else
                if ($value['attr_type_name'] == 'Multi-Select' || $value['attr_type_name'] == 'Radio-button') {
                    $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                    $multi_select['attr_ids_multi'] = $value['attribute_id'];
                    $multi_select['attr_type_name_multi'] = $value['attr_type_name'];
                    $multi_select['name'] = $value['name'];
                    $multi_select['attr_type_id_multi'] = $value['attr_type_id'];
                    $multi_select['selected'][] = $value['attr_value'];
                    $multi_select['attribute_value'] = $attr_AllValues->toArray();
                    $multi_select['is_required'] = $is_req->required;

                    $result1['food_product_attribute'][$key]['multi_select'] = $multi_select;
                } else {
                    $result1['food_product_attribute'][$key]['is_required'] = $is_req->required;
                }

            }
            $result1['food_product_attribute1'] = collect($result1['food_product_attribute'])->groupBy('attribute_id')->toArray();
            foreach ($result1['food_product_attribute1'] as $k1 => $v1) {
                $headingAttValue = [];
                foreach ($v1 as $k2 => $v2) {

                    $headingText[$k1] = $v2['name'];
                    $headingAtt[$result1['id']][$k1]['heading'] = $v2['name'];

                    if ($v2['attr_type_name'] == 'Multi-Select' || $v2['attr_type_name'] == 'Radio-button') {

                        $headingAttValue[] = $v2['multi_select']['attribute_value'][$v2['attr_value']];
                        $headingAtt[$result1['id']][$k1]['value'] = implode(',', $headingAttValue);
                    } else if ($v2['attr_type_name'] == 'Drop-Down' && $v2['parent_value_id'] == 0) {

                        $headingAtt[$result1['id']][$k1]['value'] = $v2['attr_AllValues'][$v2['attr_value']];
                    } else {
                        $headingAtt[$result1['id']][$k1]['value'] = $v2['attr_value'];
                    }
                    $headingAttWithOrder[$result1['id']] = collect($headingAtt[$result1['id']])->groupBy('heading')->toArray();
                }
            }
        }

        $arrWithOrder = array_values($headingText);
        $headings = array(
            'ID',
            'Title',
            'Description',
            'Ingredient',
            'Bar Code',
            'Nutrition',
            'Meta Tags',
            'Meta Description',
            'Status'
        );
        $headings = $headings + $headingText;

        $filename = 'foodproduct_list_' . time() . '.csv';

        $csv_terminated = "\n";
        $csv_separator = ",";
        $csv_enclosed = '"';
        $csv_escaped = "\\";

        $schema_insert = '';

        foreach ($headings as $heading) {
            $l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, stripslashes($heading)) . $csv_enclosed;
            $schema_insert .= $l;
            $schema_insert .= $csv_separator;
        } // end for
        $out = trim(substr($schema_insert, 0, -1));
        $out .= $csv_terminated;


        foreach ($data as $key => $single) {
            $schema_insert = '';

            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->id) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->name) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->description) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->ingredient) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->bar_code) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->nutrition) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->metakeyword) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->metadescription) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, ($single->status == 0 ? "Inactive" : "Active")) . $csv_enclosed . $csv_separator;
            $orderCount = 0;
            foreach ($arrWithOrder as $k3 => $v3) {

                if (isset($headingAttWithOrder[$single->id][$v3])) {

                    $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $headingAttWithOrder[$single->id][$v3][0]['value']) . $csv_enclosed . $csv_separator;
                } else {

                    $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, '') . $csv_enclosed . $csv_separator;
                }
                $orderCount++;
            }

            $out .= $schema_insert;
            $out .= $csv_terminated;
        }


        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Length: " . strlen($out));
// Output to browser with appropriate mime type, you choose ;)
        header("Content-type: text/x-csv");
        header("Content-Disposition: attachment; filename=$filename");
        echo $out;
        exit;
    }

}
