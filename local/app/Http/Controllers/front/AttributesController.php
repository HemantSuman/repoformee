<?php

namespace App\Http\Controllers\front;

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
use App\models\MembershipPlanUser;
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

            if (isset($data['user_type']) && $data['user_type'] == 'private') {
                
                $class = new Classified;
                $class = $class->where([
                            'category_id' => $data['id'],
                            'user_id' => Auth::guard('web')->user()->id,
                    ])
                        ->where(function($q1) {
                            $q1->where(['status' => 1]);
                            $q1->orwhere(['status' => 2]);
                        })
                        ->get();
                if ($class->count() >= Redis::get('ad-posting-quantity-for-private-sellers')) {
                    return response()->json(['status' => false, 'message' => 'You uploaded maximum ads for this category.']);
                }
            } else if (isset($data['user_type']) && $data['user_type'] == 'business') {

                $mem_plan_user = new MembershipPlanUser;
                $mem_plan_user = $mem_plan_user->ListingAll(['id' => $data['membership_plan_user_id']]);
                
                $class = new Classified;
                $class = $class->where([
                            'membership_plan_user_id' => $data['membership_plan_user_id'],
                            'user_id' => Auth::guard('web')->user()->id,
                    ])
                        ->where(function($q1) {
                            $q1->where(['status' => 1]);
                            $q1->orwhere(['status' => 2]);
                        })
                        ->get();
                if ($class->count() >= $mem_plan_user[0]->job_post_count) {
                    return response()->json(['status' => false, 'message' => 'You uploaded maximum ads, please updrade your plan.']);
                }
            }

            $cat_obj = new Category;
            $request_category_data = $cat_obj->where(['id' => $data['id']])->first();
            if($request_category_data->pid == 0){
                $catid = $request_category_data->id;
            } else {
                $catid = $request_category_data->pid;
            }
            
            
            $template_arr = DB::table('templates')
                    ->leftJoin('category_template', 'templates.id', '=', 'category_template.template_id')
                    ->where('category_template.category_id', '=', $catid)
                    ->first();

            $data = Category::where("id", "=", $data['id'])
                            ->with(['attributes' => function ($query) {
                                    $query->select("id", "display_name", "attributetype_id", "attribute_value", "p_attr_id", "required", "size", "measure_unit", "icon")
                                    ->where(['p_attr_id' => 0, 'status' => 1, 'is_active' => 1])
                                    ->with(['attributeType' => function($q) {
                                            $q->select("id", "name", "slug");
                                        }]);
                                }])->select("id", "name", "is_sellable")->first();


            $childCatDetail = $data->toarray();
            unset($childCatDetail['attributes']);

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
                $newAttr[$value['id']]['icon'] = $value['icon'];
                $newAttr[$value['id']]['measure_unit'] = $value['measure_unit'];
                $newAttr[$value['id']]['p_attr_id'] = $value['p_attr_id'];
                $newAttr[$value['id']]['attribute_type']['name'] = $value['attributeType']['slug'];
                $newAttr[$value['id']]['attribute_type']['id'] = $value['attributeType']['id'];
            }
        }
        return response()->json(['status' => true, 'template_arr' => $template_arr, 'attributes' => $newAttr, 'childCatDetail' => $childCatDetail]);
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

}
