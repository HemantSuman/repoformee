<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Illuminate\Support\Facades\Input;
use Auth;
use Hash;
use File;
use DB;
use Mail;
use App\Event;
use App\models\Wishlist;
use App\models\Category;
use App\models\Cart;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Validator;
use Cookie;

class WishlistsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'wishlists';
        $this->viewName = 'wishlists';
        $this->modelTitle = 'Wishlist';
        $this->model = new Wishlist;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Add item in wishlist
     *
     * @return void
     */
    public function add_to_wishlist(Request $request) {
        if ($request->isMethod('post')) {
            //dd($request->all());
            if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
                $data = new Wishlist;
                if ($request->action == "add") {
                    $data->user_id = Auth::guard('web')->user()->id;
                    $data->classified_id = $request->clid;
                    $checkAlreadyExist = $this->model->where('classified_id', '=', $data->classified_id)->where('user_id', '=', Auth::guard('web')->user()->id)->first();
                    if(empty($checkAlreadyExist))
                    {
                    $data->save();    
                    }
                    
                } else if ($request->action == "del") {
                    $data->where('classified_id', $request->clid)->delete();
                }
            } else {
                $wishlistItemArray = null;
                if ($request->action == "add") {
                    if (Cookie::get('wishlistItems')) {
                        $wishlistItemArray = Cookie::get('wishlistItems');
                        if (!in_array($request->clid, $wishlistItemArray)) {
                            $wishlistItemArray[] = (int)$request->clid;
                        }
                    } else {
                        $wishlistItemArray[] = (int)$request->clid;
                    }
                } else if ($request->action == "del") {
                    if (Cookie::get('wishlistItems')) {
                        $wishlistItemArray = Cookie::get('wishlistItems');
                        //remove wishlist id from cookie array
                        if (($key = array_search($request->clid, $wishlistItemArray)) !== false) {
                            unset($wishlistItemArray[$key]);
                        }
                    }
                }
                Cookie::queue('wishlistItems', $wishlistItemArray, 3600);
            }
        }
    }


    /**
     * Add item in wishlist from Cart
     *
     * @return void
     */
    public function add_to_wishlist_cart(Request $request) {
        if ($request->isMethod('post')) {
            if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
                $data = new Wishlist;
                if ($request->action == "add") {
                    $data->user_id = Auth::guard('web')->user()->id;
                    $data->classified_id = $request->clid;
					$data->classified_type = 'cart';
                    $checkAlreadyExist = $this->model->where('classified_id', '=', $data->classified_id)->where('user_id', '=', Auth::guard('web')->user()->id)->first();
                    if(empty($checkAlreadyExist))
                    {
                    $data->save();    
                    }
					//*********Remove from cart***
					$cartmodel = new Cart;
					$cart = $cartmodel->where('user_id', '=', Auth::guard('web')->user()->id)->first();
					if(isset($cart) && !empty($cart)){
						$cart_id = $cart->id;
						DB::table('cart_classified')->where(['classified_id' => $data->classified_id, 'cart_id' => $cart_id])->delete();
					
					}
					
						
						
					//****************************
                    
                }
            } else {
                $wishlistItemArray = null;
                if ($request->action == "add") {
                    if (Cookie::get('wishlistItems')) {
                        $wishlistItemArray = Cookie::get('wishlistItems');
                        if (!in_array($request->clid, $wishlistItemArray)) {
                            $wishlistItemArray[] = (int)$request->clid;
                        }
                    } else {
                        $wishlistItemArray[] = (int)$request->clid;
                    }
                } else if ($request->action == "del") {
                    if (Cookie::get('wishlistItems')) {
                        $wishlistItemArray = Cookie::get('wishlistItems');
                        //remove wishlist id from cookie array
                        if (($key = array_search($request->clid, $wishlistItemArray)) !== false) {
                            unset($wishlistItemArray[$key]);
                        }
                    }
                }
                Cookie::queue('wishlistItems', $wishlistItemArray, 3600);
            }
        }
    }
	
	
	/***************
	remove cart items from wishlist.
	//***************/
	public function removeitem_wishlist(Request $request) {
		
		$classified_id = $request->id;
		if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
			$userid = Auth::guard('web')->user()->id;
			
			DB::table('wishlists')->where(['classified_id' => $classified_id, 'user_id' => $userid])->delete();
			
			
		}
		return Redirect::to('cart');
		
	}
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index() {
        $logged_in_user_id = Auth::guard('web')->user()->id;

        $current_date = date("Y-m-d");
        $top_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 1)->where("banner_position", "=", "top")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();
        $bottom_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 1)->where("banner_position", "=", "bottom")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();

        $default_top_position_ad = \DB::table('advertisements')->where("page_id", "=", 1)->where("banner_position", "=", "top")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_right_position_ad = \DB::table('advertisements')->where("page_id", "=", 1)->where("banner_position", "=", "right")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_bottom_position_ad = \DB::table('advertisements')->where("page_id", "=", 1)->where("banner_position", "=", "bottom")->where("is_default", "=", 1)->where("status", "=", 1)->first();

        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        $wishlistItems = $this->model
                        ->with(['classified' => function($classified) use($current_date) {
                                $classified->select("id", "title", "location", "description", "price","start_date","end_date", "created_at","city_id")->whereRaw("'$current_date' Between start_date and end_date");
                                $classified->with("classified_image");
                                $classified->with("city");
                                $classified->with(["classified_attribute" => function($classifiedAttribute) {
                                        $classifiedAttribute->select('attribute_id', 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')->where(['show_list' => 1]);
                                    }]);
                                    }])->where('user_id', '=', $logged_in_user_id)->orderBy('id', 'DESC')->get();

                        $wishlistItems = $wishlistItems->toarray();
                        foreach ($wishlistItems as $wishlistItemsKey => $wishlistItemsVal) {
                            if (!empty($wishlistItemsVal['classified']['classified_attribute'])) {
                                foreach ($wishlistItemsVal['classified']['classified_attribute'] as $in => $val) {
                                    if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] == 0) {
                                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                                        $wishlistItems[$wishlistItemsKey]['classified']['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                                    }
                                    if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] != 0) {
                                        $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $val['attribute_id'])->where('attribute_value_id', $val['parent_value_id'])->pluck('attribute_value', 'id');
                                        $wishlistItems[$wishlistItemsKey]['classified']['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                                    }

                                    if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                                        $wishlistItems[$wishlistItemsKey]['classified']['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                                        $wishlistItems[$wishlistItemsKey]['classified']['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                                    }
                                }
                            }
                        }

                        return view('front/' . $this->viewName . '/index', compact('wishlistItems', 'top_positions_ads', 'bottom_positions_ads', 'default_top_position_ad', 'default_bottom_position_ad', 'allSubCategories', 'allComCategories', 'allSubCategoriesForMenu'));
                    }
                    
 /**
     * allwishclassifiedlistapi
     *
     * @return response
     */
                    public function allwishclassifiedlistapi(Request $request) { 
                        
                        $logged_in_user_id = $request->user_id;
                        $rooturl = \Request::root();
                        $current_date = date("Y-m-d");

                        $data = $this->model
                                        ->select("id", "user_id", "classified_id")->with(['classified' => function($classified) {
                                        $classified->selectRaw('id,id as classifiedid,title,location,description,price,UNIX_TIMESTAMP(classifieds.created_at)as createdtime,city_id,City as cityname')
                                                ->leftJoin('cities', 'city_id', '=', 'cities.CityId');
                                        $classified->with("classified_image");
                                    }])->where('user_id', '=', $logged_in_user_id)->orderBy('id', 'DESC')->get();

                                    
                                    foreach ($data as $key => $value) {
                            $value->title= $value->classified->title;           
                            $value->classifiedid= $value->classified->classifiedid;           
                            $value->location= $value->classified->location;           
                            $value->description= $value->classified->description;           
                            $value->price= $value->classified->price;           
                            $value->createdtime= $value->classified->createdtime;           
                            $value->city_id= $value->classified->city_id;           
                            $value->cityname= $value->classified->cityname;           
                            $value->wishlist= 1;
                            $imagename = $value->classified->classified_image[0]['name'];
                           $value->imageurl = "$rooturl" . '/upload_images/classified/' . "$value->classified_id" . '/' . "$imagename";
                            if (!empty($value->cityname)) {
                                $value->location = $value->classified->cityname;
                            } else {
                                $value->location = 'N/A';
                            }
                            unset($value->classified);
                        }
                        
                        if (count($data) > 0) {

                            $result['status'] = 1;
                            $result['data'] = $data;
                            echo json_encode($result);
                            die;
                        } else {
                            $result['status'] = 0;
                            $result['data'] = array();
                            $result['msg'] = 'No record found';
                            echo json_encode($result);
                            die;
                        }
                    }

                }
                