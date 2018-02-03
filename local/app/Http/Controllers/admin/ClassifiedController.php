<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\Classified;
use App\models\Category;
use App\models\ClassifiedImage;
use App\models\Message;
use App\models\User;
use App\models\Attribute;
use App\models\Wishlist;
use App\models\Report;
use App\models\FoodProduct;
use App\models\Advertisement;
use App\models\JobApply;
use App\models\Suburb;
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
use App\models\Classes\PrayTime;
use Illuminate\Support\Facades\Paginator;
use App\models\State;
use App\Url;
use DateTime;
use Cookie;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttributesController;
use App\Jobs\SendReminderEmail;
use LRedis;

class ClassifiedController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $auscountryid;

    public function __construct(Route $route, Request $request) {

        $this->viewName = 'classifieds';
        $this->modelTitle = 'Classified';
        $this->model = new Classified;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);

        $countryarr = DB::table('countries')->where('Country', 'Australia')->first();
    }

    /**
     * Admin index
     * indexing of all classifieds created by admin
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
                                    'classifieds.id as id,'
                                    . 'classifieds.title as title,'
                                    . 'classifieds.status as status,'
                                    . 'classifieds.featured_classified as featured_classified,'
                                    . 'classifieds.start_date as start_date,'
                                    . 'classifieds.created_at as created_at,'
                                    . 'categories.name as category_name,'
                                    . 'child_cat.name as cat_c_name,'
                                    . 'categories.name as `aggregate`'))
                    ->rightjoin('classifieds', 'categories.id', '=', 'classifieds.parent_categoryid')
                    ->leftjoin('categories as child_cat', 'classifieds.category_id', '=', 'child_cat.id')
                    ->orderBy('id', 'DESC');

            if (!empty($inputarr['name'])) {
                $result = $result->where('categories.name', 'LIKE', "%{$inputarr['name']}%");
            }
            if (isset($inputarr['status']) && $inputarr['status'] != '' && ($inputarr['status'] == 0 || $inputarr['status'] == 1)) {

                $result = $result->where('classifieds.status', '=', $inputarr['status']);
            } else {
                $result = $result->where(function($query) {
                    $query->where(['classifieds.status' => 0])->orwhere(['classifieds.status' => 1]);
                });
            }
            if (!empty($inputarr['title'])) {
                $result = $result->where('classifieds.title', 'LIKE', "%{$inputarr['title']}%");
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
                                            'classifieds.id as id,'
                                            . 'classifieds.title as title,'
                                            . 'classifieds.status as status,'
                                            . 'classifieds.featured_classified as featured_classified,'
                                            . 'classifieds.start_date as start_date,'
                                            . 'classifieds.created_at as created_at,'
                                            . 'categories.name as category_name,'
                                            . 'child_cat.name as cat_c_name,'
                                            . 'categories.name as `aggregate`'))
                            ->rightjoin('classifieds', 'categories.id', '=', 'classifieds.parent_categoryid')
                            ->leftjoin('categories as child_cat', 'classifieds.category_id', '=', 'child_cat.id')
                            ->orderBy('id', 'DESC')
                            ->where(function($q1) {
                                $q1->where('classifieds.status', '=', 1)
                                ->orwhere('classifieds.status', '=', 0);
                            })->paginate(10);
        }

        $result->setPath('')->appends(Input::query())->render();

        return view('admin/' . $this->viewName . '/index', compact('modelTitle', 'result', 'controllerName', 'actionName', 'viewName'));
    }

    /**
     * get_all_classifieds
     * get of all classifieds created by admin
     *
     * @return void
     * @access public
     */
    public function get_all_classifieds() {

        $current_date = date('Y-m-d');
        $data = Input::all();
        $result = Category::select(DB::raw(
                                'classifieds.title as label,'
                                . 'categories.name as catname,'
                                . 'categories.id as catid,'
                                . 'child_cat.name as sub_name,'
                                . 'child_cat.id as sub_id'))
                ->rightjoin('classifieds', 'categories.id', '=', 'classifieds.parent_categoryid')
                ->leftjoin('categories as child_cat', 'classifieds.category_id', '=', 'child_cat.id')
                ->where('classifieds.title', 'LIKE', "%{$data['text_data']}%")
                ->where(function($q1) {
                    $q1->where('classifieds.status', '=', 1);
                })
                ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                ->paginate(10);

        echo json_encode($result->toarray());
        die;
    }

    /**
     * get_all_classifieds
     * get of all classifieds api
     *
     * @return response
     * @access public
     */
    public function get_all_classifiedswithnameapi(Request $request) {
        $current_date = date('Y-m-d');
        $classifiedname = $request->name;
        if (!empty($classifiedname)) {
            $data = Category::select(DB::raw(
                                            'classifieds.title as title,'
                                            . 'categories.name as catname,'
                                            . 'categories.id as catid,'
                                            . 'child_cat.name as sub_name'))
                            ->rightjoin('classifieds', 'categories.id', '=', 'classifieds.parent_categoryid')
                            ->leftjoin('categories as child_cat', 'classifieds.category_id', '=', 'child_cat.id')
                            ->where(function($q1)use($classifiedname, $current_date) {
                                $q1->where('classifieds.status', '=', 1);
                                $q1->where('classifieds.title', 'LIKE', '%' . $classifiedname . '%');
                                $q1->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ");
                            })->paginate(10);
            $data = $data->toarray();
            $datavalues = $data['data'];
            if (!empty($datavalues)) {
                $result['status'] = 1;
                $result['data'] = $datavalues;
                $result['msg'] = 'Record Found';

                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'No Record Match';
                echo json_encode($result);
                die;
            }

            echo json_encode($result->toarray());
            die;
        } else {
            $result['status'] = 0;
            $result['msg'] = 'Invalid Details';
            echo json_encode($result);
            die;
        }
    }

    /**
     * get_all_classifiedssearchbynameapi
     * get of all get_all_classifiedssearchbynameapi
     *
     * @return response
     * @access public
     */
    public function get_all_classifiedssearchbynameapi(Request $request) {
        $rooturl = \Request::root();
        $current_date = date('Y-m-d');
        $classifiedname = $request->name;
        $loginid = $request->userid;
        $lat = $request->lat;
        $long = $request->lng;
        $lat = (int) $lat;
        $long = (int) $long;
        $km = 20;
        $conditions = array(
            array('classifieds.status', '=', 1),
        );
        $iscategory = true;
        $isParent = null;
        $conditions[] = array('classifieds.title', 'like', '%' . $classifiedname . '%');

        if (!empty($classifiedname)) {
            if (!empty($lat) && !empty($long)) {

                $data = $this->model
                        ->select(DB::raw("(SQRT(POW(69.1 * (lat - $lat), 2) +
                                POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) AS distance,"
                                        . "classifieds.id as classifiedid ,classifieds.title as title,classifieds.status,"
                                        . "classifieds.description as description,classifiedimage.name as name,classifieds.price,"
                                        . "UNIX_TIMESTAMP(classifieds.created_at)as createdtime,"
                                        . "concat('$rooturl/upload_images/classified/',classifieds.id,'/',classifiedimage.name) imageurl,"
                                        . "classifieds.city_id"))
                        ->leftJoin('categories', function($join) use ($isParent, $iscategory) {
                            if ($isParent) {
                                $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                            } elseif ($iscategory) {
                                $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                                $join->orOn('classifieds.category_id', '=', 'categories.id');
                            } else {
                                $join->on('classifieds.category_id', '=', 'categories.id');
                            }
                        })
                        ->whereRaw("(SQRT(POW(69.1 * (lat - $lat), 2) +
                                POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) < $km")
                        ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                        ->where($conditions)->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                        ->groupBy('classifieds.id')
                        ->with(['city_data' => function ($q3) {
                                $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                            },])
                        ->paginate(10);
            } else {
                $data = $this->model
                        ->selectRaw('classifieds.id as classifiedid ,classifieds.title as title,classifieds.status,'
                                . 'classifieds.description as description,classifiedimage.name as name,classifieds.price,UNIX_TIMESTAMP(classifieds.created_at)as createdtime,'
                                . 'concat("' . $rooturl . '/upload_images/classified/",classifieds.id,"/",classifiedimage.name) imageurl,classifieds.city_id')
                        ->leftJoin('categories', function($join) use ($isParent, $iscategory) {
                            if ($isParent) {
                                $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                            } elseif ($iscategory) {
                                $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                                $join->orOn('classifieds.category_id', '=', 'categories.id');
                            } else {
                                $join->on('classifieds.category_id', '=', 'categories.id');
                            }
                        })
                        ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                        ->where($conditions)
                        ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                        ->groupBy('classifieds.id')
                        ->with(['city_data' => function ($q3) {
                                $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                            },])
                        ->paginate(10);
            }


            $data = $data->toarray();

            $datavalues = $data['data'];
            $wishlistItems = array();
            if (!empty($datavalues)) {
                if (!empty($loginid)) {
                    $wishlistObj = new Wishlist;
                    $wishlistItems = $wishlistObj->where('user_id', '=', $loginid)->select('classified_id')->get()->toarray();
                }


                foreach ($wishlistItems as $key1 => $value1) {
                    $listarray[] = $value1['classified_id'];
                }
                foreach ($datavalues as $key => $value) {
                    if (!empty($listarray)) {
                        if (in_array($value['classifiedid'], $listarray)) {
                            $datavalues[$key]['wishlist'] = 1;
                        } else {
                            $datavalues[$key]['wishlist'] = 0;
                        }
                    } else {
                        $datavalues[$key]['wishlist'] = 0;
                    }
                    if (!empty($value['city_data']['CityId'])) {
                        $datavalues[$key]['location'] = $value['city_data']['City'];
                    } else {
                        $datavalues[$key]['location'] = 'N/A';
                        unset($value['city_data']);
                    }
                }
                $result['status'] = 1;
                $result['data'] = $datavalues;
                $result['msg'] = 'Record Found';

                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'No Record Match';
                echo json_encode($result);
                die;
            }

            echo json_encode($result->toarray());
            die;
        } else {
            $result['status'] = 0;
            $result['msg'] = 'Invalid Details';
            echo json_encode($result);
            die;
        }
    }

    /**
     * get_all_classifiedbyfilterapi
     * get of all get_all_classifiedbyfilterapi
     *
     * @return response
     * @access public
     */
    public function get_all_classifiedbyfilterapi(Request $request) {
        $task = new Category;
        $rooturl = \Request::root();
        $current_date = date('Y-m-d');
        $classifiedname = $request->name;
        $loginid = $request->userid;
        $categoryid = $request->categoryid;
        $lat = $request->lat;
        $long = $request->lng;
        $price = $request->price;
        $postwithin = $request->postwithin;
        $km = $request->distance;
        if (!empty($km)) {
            $km = $request->distance;
        } else {
            $km = 200;
        }

        $filterattributetype = array();
        $filterattributetypearr = array();
        $attributearr = array();
        $newdata = array();
        if ($request->all()['attributes']) {
            $attributesarr = json_decode($request->all()['attributes']);
        } else {

            $attributesarr = array();
        }
        if (!empty($attributesarr)) {
            foreach ($attributesarr as $attributesarrk => $value) {
                if (!empty($value->range)) {
                    $range = $value->range;
                } else {
                    $range = 0;
                }
                if (!empty($value->timerange)) {
                    $timerange = $value->timerange;
                } else {
                    $timerange = 0;
                }
                if (!empty($value->numberrange)) {
                    $numberrange = $value->numberrange;
                } else {
                    $numberrange = 0;
                }
                if (!empty($value->calanderrange)) {
                    $calanderrange = $value->calanderrange;
                } else {
                    $calanderrange = 0;
                }
                $filterattributetype[] = $value->attr_type_name;
                $filterattributetypearr[$attributesarrk] = array(
                    'attrid' => $attributesarrk,
                    'attrtype' => $value->attr_type_name,
                    'attrvalue' => $value->attr_value,
                    'range' => $range,
                    'timerange' => $timerange,
                    'numberrange' => $numberrange,
                    'calanderrange' => $calanderrange,
                );
                $value->attr_type_name;
            }
        }
        $conditions = array(
            array('classifieds.status', '=', 1),
        );
        $iscategory = null;
        $isParent = null;
        if (!empty($categoryid)) {
            //  dd('yes');
            $parentCategoryName = $task->select('name', 'pid')->where(['id' => $categoryid])->first();
            $isParent = $parentCategoryName->pid == 0 ? true : false;
            if ($isParent) {
                $conditions[] = array('classifieds.parent_categoryid', '=', $categoryid);
            } else {
                $conditions[] = array('categories.id', '=', $categoryid);
            }
        } else {
            $iscategory = true;
        }
        if (!empty($classifiedname)) {
            $conditions[] = array('classifieds.title', 'like', '%' . $classifiedname . '%');
        }
        if (!empty($price)) {
            $explodestore = explode(";", $price);

            $priceform = $explodestore[0];
            $priceto = $explodestore[1];
            $conditions[] = array('price', '>=', $priceform);
            $conditions[] = array('price', '<=', $priceto);
        }
        $timecheck = 0;
        if (!empty($postwithin)) {
            if ($postwithin == 1) {
                $hr = 24;
            } elseif ($postwithin == 7) {
                $hr = 7 * 24;
            } elseif ($postwithin == 30) {
                $hr = 30 * 24;
            } else {
                dd("wrongdeailspostwithin");
            }
            $timecheck = 1;
        }

        if (!empty($lat) && !empty($long)) {
            $data = $this->model
                    ->select(DB::raw("(SQRT(POW(69.1 * (lat - $lat), 2) +
                                POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) AS distance,"
                                    . "concat('$rooturl/upload_images/classified/',classifieds.id,'/',classifiedimage.name) imageurl,"
                                    . "group_concat(attribute_classified.attr_type_name) as typename,
                         group_concat(attribute_classified.attr_value) as attrvalue,
                         group_concat(attribute_classified.attribute_id)as attributeid,
                         categories.id,classifieds.id as classifiedid,classifieds.id as classified_id,classifieds.title as title,classifieds.description as description,
                         classifiedimage.name as name,classifieds.price,categories.name as catname,classifieds.location as location,
                         categories.belong_to_community as btc,categories.show_on_info_area as sia,classifieds.city_id,UNIX_TIMESTAMP(classifieds.created_at)as createdtime
                        "))
                    ->leftJoin('categories', function($join) use ($isParent, $iscategory) {
                        if ($isParent) {
                            $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                        } elseif ($iscategory) {
                            $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                            $join->orOn('classifieds.category_id', '=', 'categories.id');
                        } else {
                            $join->on('classifieds.category_id', '=', 'categories.id');
                        }
                    })
                    ->whereRaw("(SQRT(POW(69.1 * (lat - $lat), 2) +
                                POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) < $km")
                    ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                    ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                    ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                    ->where($conditions)->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date")
                    ->groupBy('classifieds.id')
                    ->with(['city_data' => function ($q3) {
                    $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                },]);
            if ($timecheck) {
                $data = $data->whereRaw("ROUND(time_to_sec((TIMEDIFF(NOW(), classifieds.created_at))) / 3600) BETWEEN 0 and '$hr'");
            }
            $data = $data->get();
        } else {
            $data = $this->model
                    ->selectRaw('group_concat(attribute_classified.attr_type_name) as typename,
                         group_concat(attribute_classified.attr_value) as attrvalue,
                         group_concat(attribute_classified.attribute_id)as attributeid,
                         categories.id,classifieds.id as classifiedid,classifieds.id as classified_id,classifieds.title as title,classifieds.description as description,
                         classifiedimage.name as name,classifieds.price,categories.name as catname,classifieds.location as location,
                         categories.belong_to_community as btc,categories.show_on_info_area as sia,
                        concat("' . $rooturl . '/upload_images/classified/",classifieds.id,"/",classifiedimage.name) imageurl,classifieds.city_id,UNIX_TIMESTAMP(classifieds.created_at)as createdtime')
                    ->leftJoin('categories', function($join) use ($isParent, $iscategory) {
                        if ($isParent) {
                            $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                        } elseif ($iscategory) {
                            $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                            $join->orOn('classifieds.category_id', '=', 'categories.id');
                        } else {
                            $join->on('classifieds.category_id', '=', 'categories.id');
                        }
                    })
                    ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                    ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                    ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                    ->where($conditions)->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date")
                    ->groupBy('classifieds.id')
                    ->with(['city_data' => function ($q3) {
                    $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                },]);
            if ($timecheck) {
                $data = $data->whereRaw("ROUND(time_to_sec((TIMEDIFF(NOW(), classifieds.created_at))) / 3600) BETWEEN 0 and '$hr'");
            }
            $data = $data->get();
        }
        $data = $data->toarray();
        foreach ($data as $key => $value) {
            if (!empty($filterattributetype)) {
                $attrtypes = explode(',', $value['typename']);
                foreach ($filterattributetype as $keya => $valuea) {
                    if (!in_array($valuea, $attrtypes)) {

                        unset($data[$key]);
                    }
                }
            }
        }
        if (!empty($filterattributetype)) {
            foreach ($data as $kesya => $valuea) {
                $attid = explode(',', $valuea['attributeid']);
                $atttype = explode(',', $valuea['typename']);
                $attvalue = explode(',', $valuea['attrvalue']);
                foreach ($attid as $keys => $values) {
                    $attributearr[$valuea['classified_id']][$values] = array(
                        'id' => $values,
                        'allvalue' => $valuea,
                        'type' => $atttype[$keys],
                        'value' => $attvalue[$keys],
                    );
                }
            }
        }

        if (!empty($attributearr)) {
            foreach ($attributearr as $in => $val) {
                foreach ($val as $keydata => $valuedata) {

                    foreach ($filterattributetypearr as $in1 => $val1) {

                        if ($in1 == $keydata) {
                            if ($val1['attrtype'] == 'Date') {
                                if ($val1['range'] == 0) {
                                    $searchdate = $val1['attrvalue'];
                                    $storedate = $valuedata['value'];
                                    $searchdatevalue = strtotime($searchdate);
                                    $storedatevalue = strtotime($storedate);
                                    if ($storedatevalue <= $searchdatevalue) {
                                        $newdata = $valuedata['allvalue'];
                                    } else {
                                        unset($attributearr[$in]);
                                    }
                                } else {

                                    $searchdate = $val1['attrvalue'];
                                    $storedate = $valuedata['value'];
                                    $explodestore = explode(";", $storedate);
                                    $fromstore = strtotime($explodestore[0]);
                                    $tostore = strtotime($explodestore[1]);
                                    $searchdatevalue = strtotime($searchdate);

                                    if (($searchdatevalue <= $tostore && $searchdatevalue >= $fromstore)) {
                                        $newdata = $valuedata['allvalue'];
                                    } else {
                                        unset($attributearr[$in]);
                                    }
                                }
                            } elseif ($val1['attrtype'] == 'Time') {
                                if ($val1['timerange'] == 0) {
                                    // dd('here');
                                    $searctime = $val1['attrvalue'];
                                    $storetime = $valuedata['value'];
                                    $searctimevalue = strtotime($searctime);
                                    $storetimevalue = strtotime($storetime);
                                    if ($storetimevalue <= $searctimevalue) {
                                        $newdata = $valuedata['allvalue'];
                                    } else {
                                        unset($attributearr[$in]);
                                    }
                                } else {

                                    $searctime = $val1['attrvalue'];
                                    $storetime = $valuedata['value'];
                                    $explodestore = explode(";", $storetime);
                                    $fromstore = strtotime($explodestore[0]);
                                    $tostore = strtotime($explodestore[1]);
                                    $searctimevalue = strtotime($searctime);
                                    if (($searctimevalue <= $tostore && $searctimevalue >= $fromstore)) {
                                        $newdata = $valuedata['allvalue'];
                                    } else {
                                        unset($attributearr[$in]);
                                    }
                                }
                            } elseif ($val1['attrtype'] == 'Numeric') {
                                if ($val1['numberrange'] == 0) {
                                    $searcnumber = $val1['attrvalue'];
                                    $storenumber = $valuedata['value'];

                                    if ($storenumber >= $searcnumber) {
                                        $newdata = $valuedata['allvalue'];
                                    } else {
                                        unset($attributearr[$in]);
                                    }
                                } else {

                                    $searcnumber = $val1['attrvalue'];
                                    $storenumber = $valuedata['value'];
                                    $explodestore = explode(";", $storenumber);
                                    $fromstore = $explodestore[0];
                                    $tostore = $explodestore[1];
                                    if (($searcnumber > $fromstore && $searcnumber <= $tostore)) {
                                        $newdata = $valuedata['allvalue'];
                                    } else {
                                        unset($attributearr[$in]);
                                    }
                                }
                            } elseif ($val1['attrtype'] == 'calendar') {
                                if ($val1['calanderrange'] == 0) {
                                    $searccalander = $val1['attrvalue'];
                                    $storecalander = $valuedata['value'];

                                    if ($storecalander >= $searccalander) {
                                        $newdata = $valuedata['allvalue'];
                                    } else {
                                        unset($attributearr[$in]);
                                    }
                                } else {

                                    $searccalander = $val1['attrvalue'];
                                    $storecalander = $valuedata['value'];
                                    $explodestore = explode(";", $storecalander);
                                    $fromstore = $explodestore[0];
                                    $tostore = $explodestore[1];
                                    if (($searccalander > $fromstore && $searccalander <= $tostore)) {
                                        $newdata = $valuedata['allvalue'];
                                    } else {
                                        unset($attributearr[$in]);
                                    }
                                }
                            } elseif ($val1['attrtype'] == 'Radio-button') {
                                $searchradio = $val1['attrvalue'];

                                $storeradio = $valuedata['value'];

                                if ($storeradio == $searchradio) {

                                    $newdata = $valuedata['allvalue'];
                                } else {
                                    unset($attributearr[$in]);
                                }
                            } elseif ($val1['attrtype'] == 'Multi-Select') {

                                $searchmultiselectvalue = $val1['attrvalue'];

                                $multiressult = $this->model
                                                ->selectRaw('
                         classifieds.id as classified_id ,attribute_classified.attribute_id,attribute_classified.classified_id,attribute_classified.attr_value')
                                                ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                                                ->where(['id' => $in, 'attr_type_name' => 'Multi-Select', 'attribute_id' => $in1])
                                                ->get()->toarray();
                                foreach ($multiressult as $m => $v) {
                                    $multipleidarr[] = $v['attr_value'];
                                }
                                $multipleflag = 0;
                                $searchmultiselectvalueexplode = explode(',', $searchmultiselectvalue);
                                foreach ($searchmultiselectvalueexplode as $keys => $values) {
                                    if (in_array($values, $multipleidarr)) {
                                        $multipleflag = 1;
                                    } else {
                                        $multipleflag = 0;
                                    }
                                }
                                if ($multipleflag == 1) {
                                    $newdata = $valuedata['allvalue'];
                                } else {
                                    unset($attributearr[$in]);
                                }
                            } elseif ($val1['attrtype'] == 'Drop-Down') {

                                $searchdrop = $val1['attrvalue'];

                                $storedrop = $valuedata['value'];

                                if ($storedrop == $searchdrop) {

                                    $newdata = $valuedata['allvalue'];
                                } else {
                                    unset($attributearr[$in]);
                                }
                            }
                        }
                    }
                }
                $newdata1[] = $newdata;
            }
        }
        if (!empty($newdata1)) {
            $data = $newdata1;
        }
        $datavalues = $data;

        if (!empty($datavalues)) {


            $wishlistItems = array();
            if ($loginid != 0) {

                $wishlistObj = new Wishlist;
                $wishlistItems = $wishlistObj->where('user_id', '=', $loginid)->select('classified_id')->get();
            }



            foreach ($wishlistItems as $key1 => $value1) {
                $listarray[] = $value1['classified_id'];
            }
            foreach ($datavalues as $key => $value) {
                if (!empty($listarray)) {
                    if (in_array($value['classifiedid'], $listarray)) {
                        $datavalues[$key]['wishlist'] = 1;
                    } else {
                        $datavalues[$key]['wishlist'] = 0;
                    }
                } else {
                    $datavalues[$key]['wishlist'] = 0;
                }
                if (!empty($value['city_data']['CityId'])) {
                    $datavalues[$key]['location'] = $value['city_data']['City'];
                } else {
                    $datavalues[$key]['location'] = 'N/A';
                    unset($value['city_data']);
                }
            }
            $result['status'] = 1;
            $result['data'] = $datavalues;
            $result['msg'] = 'Record Found';

            echo json_encode($result);
            die;
        } else {
            $result['status'] = 0;
            $result['msg'] = 'No Record Match';
            echo json_encode($result);
            die;
        }

        echo json_encode($result->toarray());
        die;
        $result['status'] = 0;
        $result['msg'] = 'Invalid Details';
        echo json_encode($result);
        die;
        //  }
    }

    /**
     * admin_approve
     * admin_approve classifieds 
     *
     * @return void
     * @access public
     */
    public function admin_approve($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;

        $viewName = $this->viewName;
        $controllerName = $this->controllerName;


        $requestArr = Input::all();

        if (!empty($requestArr)) {
            $inputarr = Input::all();

            $result = Category::select(DB::raw(
                                    'classifieds.id as id,'
                                    . 'classifieds.title as title,'
                                    . 'classifieds.status as status,'
                                    . 'classifieds.featured_classified as featured_classified,'
                                    . 'classifieds.start_date as start_date,'
                                    . 'categories.name as category_name,'
                                    . 'child_cat.name as cat_c_name,'
                                    . 'categories.name as `aggregate`'))
                    ->rightjoin('classifieds', 'categories.id', '=', 'classifieds.parent_categoryid')
                    ->leftjoin('categories as child_cat', 'classifieds.category_id', '=', 'child_cat.id')
                    ->where('classifieds.status', '=', 2);

            if (!empty($inputarr['name'])) {
                $result = $result->where('categories.name', 'LIKE', "%{$inputarr['name']}%");
            }

            if (!empty($inputarr['title'])) {
                $result = $result->where('classifieds.title', 'LIKE', "%{$inputarr['title']}%");
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
                                            'classifieds.id as id,'
                                            . 'classifieds.title as title,'
                                            . 'classifieds.status as status,'
                                            . 'classifieds.featured_classified as featured_classified,'
                                            . 'classifieds.start_date as start_date,'
                                            . 'categories.name as category_name,'
                                            . 'child_cat.name as cat_c_name,'
                                            . 'categories.name as `aggregate`'))
                            ->rightjoin('classifieds', 'categories.id', '=', 'classifieds.parent_categoryid')
                            ->leftjoin('categories as child_cat', 'classifieds.category_id', '=', 'child_cat.id')
                            ->orderBy('id', 'DESC')->where('classifieds.status', '=', 2)->paginate(10);
        }

        $result->setPath('')->appends(Input::query())->render();
        return view('admin/' . $this->viewName . '/approve', compact('modelTitle', 'result', 'controllerName', 'actionName', 'viewName'));
    }

    /**
     * admin_reject
     * admin_reject classifieds 
     *
     * @return void
     * @access public
     */
    public function admin_reject($id = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $requestArr = Input::all();

        if (!empty($requestArr)) {
            $inputarr = Input::all();

            $result = Category::select(DB::raw(
                                    'classifieds.id as id,'
                                    . 'classifieds.title as title,'
                                    . 'classifieds.status as status,'
                                    . 'classifieds.featured_classified as featured_classified,'
                                    . 'classifieds.start_date as start_date,'
                                    . 'categories.name as category_name,'
                                    . 'child_cat.name as cat_c_name,'
                                    . 'categories.name as `aggregate`'))
                    ->rightjoin('classifieds', 'categories.id', '=', 'classifieds.parent_categoryid')
                    ->leftjoin('categories as child_cat', 'classifieds.category_id', '=', 'child_cat.id')
                    ->where('classifieds.status', '=', 3);

            if (!empty($inputarr['name'])) {
                $result = $result->where('categories.name', 'LIKE', "%{$inputarr['name']}%");
            }

            if (!empty($inputarr['title'])) {
                $result = $result->where('classifieds.title', 'LIKE', "%{$inputarr['title']}%");
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
                                            'classifieds.id as id,'
                                            . 'classifieds.title as title,'
                                            . 'classifieds.status as status,'
                                            . 'classifieds.featured_classified as featured_classified,'
                                            . 'classifieds.start_date as start_date,'
                                            . 'categories.name as category_name,'
                                            . 'child_cat.name as cat_c_name,'
                                            . 'categories.name as `aggregate`'))
                            ->rightjoin('classifieds', 'categories.id', '=', 'classifieds.parent_categoryid')
                            ->leftjoin('categories as child_cat', 'classifieds.category_id', '=', 'child_cat.id')
                            ->orderBy('id', 'DESC')->where('classifieds.status', '=', 3)->paginate(10);
        }
        $result->setPath('')->appends(Input::query())->render();
        return view('admin/' . $this->viewName . '/reject', compact('modelTitle', 'result', 'controllerName', 'actionName', 'viewName'));
    }

    /**
     * admin_approved_submit
     * admin_approved_submit classifieds 
     *
     * @return void
     * @access public
     */
    public function admin_approved_submit() {

        $requestArr = Input::all();

        if (!empty($requestArr)) {

            if ($requestArr['status'] == 'Approve') {
                $data['status'] = 1;
            } else if ($requestArr['status'] == 'Reject') {
                $data['status'] = 3;
            } else {
                $data['status'] = 0;
            }

            $result = $this->model->where('id', $requestArr['classified_id'])->update($data);
        }

        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'Successfully updated.');
        return Redirect::to('admin/classifieds/approve');
    }

    /**
     * admin_approved_submitfromreject
     * admin_approved_submitfromreject classifieds 
     *
     * @return void
     * @access public
     */
    public function admin_approved_submitfromreject() {

        $requestArr = Input::all();

        if (!empty($requestArr)) {

            if ($requestArr['status'] == 'Approve') {
                $data['status'] = 1;
            } else if ($requestArr['status'] == 'Reject') {
                $data['status'] = 3;
            } else {
                $data['status'] = 0;
            }
            $result = $this->model->where('id', $requestArr['classified_id'])->update($data);
        }

        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'Successfully updated.');
        return Redirect::to('admin/classifieds/reject');
    }

    /**
     * frontchangestatusapi
     * frontchangestatusapi classifieds 
     *
     * @return response
     * @access public
     */
    public function frontchangestatusapi(Request $request) {

        if ($request->isMethod('post')) {
            $classifiedid = $request->id;
            $state = $request->state;
            if (!empty($classifiedid)) {
                if ($state == 1) {
                    $updated_data["status"] = 1;
                } else {
                    $updated_data["status"] = 0;
                }
                \DB::table('classifieds')->where('id', $classifiedid)->update($updated_data);
                $result['status'] = 1;
                $result['msg'] = 'Status Changed Successfully';

                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Invalid Details';
                echo json_encode($result);
                die;
            }
        }
    }

    /**
     * admin_add
     * admin_add classifieds 
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
        $state = DB::table('state')->where('country_id', 14)->pluck('name', 'id');
        $stateCode = DB::table('state')->where('country_id', 14)->pluck('id', 'code')->toarray();
        $cityCode = DB::table('cities')->where('CountryID', 14)->pluck('CityId', 'City')->toarray();
        return view('admin/' . $this->viewName . '/add', compact('modelTitle', 'controllerName', 'categories', 'state', 'actionName', 'classifiedSelected', 'viewName', 'BelongsToCommunities', 'stateCode', 'cityCode', 'showStaticAttributes', 'communities_informationarr'));
    }

    /**
     * admin_edit
     * admin_edit classifieds 
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
        $BelongsToCommunities = $category->where(['pid' => 0])->pluck('belong_to_community', 'id')->toArray();
        $showStaticAttributes = $category->where(['pid' => 0])->pluck('show_static_attributes', 'id')->toArray();
        $communities_information = $category->select('id', 'belong_to_community', 'show_on_info_area')->where(['pid' => 0])->get();
        $communities_informationarr = $communities_information->toArray();
        $state = DB::table('state')->where('country_id', 14)->pluck('name', 'id');

        $stateCode = DB::table('state')->where('country_id', 14)->pluck('id', 'code')->toarray();

        $result = false;
        if (isset($id)) {
            try {
                $result = $this->model->where('id', '=', $id)->with(['classified_attribute' => function ($query) {
                                $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'size', 'measure_unit');
                            }, 'classified_image'])->first();

                $subcategories = $category->categoryListing(['pid' => $result->parent_categoryid]);
                $suburb = DB::table('cities')->select('City')->where('CityId', '=', $result->city_id)->first();
                $statename = DB::table('state')->select('name')->where('id', '=', $result->state_id)->first();
                $checkCatIsBelToCommunity = DB::table('categories')->where('id', '=', $result->parent_categoryid)->first();
                $isCommunity = $checkCatIsBelToCommunity->belong_to_community == 1 ? "hide" : null;

                //get other attributes (not required)
                if ($result->category_id != 0) {
                    $data['id'] = $result->category_id;
                } else {
                    $data['id'] = $result->parent_categoryid;
                }
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

                $collection1 = collect($result->classified_attribute);
                $at_val_ids = $collection1->implode('attribute_id', ',');
                $at_val_idsArr = explode(',', $at_val_ids);
                $newAttrForUnsaved = [];
                foreach ($at_idsArr as $k1 => $v1) {
                    if (!in_array($k1, $at_val_idsArr)) {
                        $newAttrForUnsaved[$k1]['attribute_id'] = $v1[0]['attribute_id'];
                        $newAttrForUnsaved[$k1]['classified_id'] = $id;
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
                $result1['classified_attribute'] = $result1['classified_attribute'] + $newAttrForUnsaved;
                $multi_select = [];
                foreach ($result1['classified_attribute'] as $key => $value) {
                    $is_req = DB::table('attributes')->select('required')->where(['id' => $value['attribute_id']])->first();

                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] == 0) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $result1['classified_attribute'][$key]['attr_AllValues'] = $attr_AllValues->toArray();
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] != 0) {
                        $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $value['attribute_id'])->where('attribute_value_id', $value['parent_value_id'])->pluck('attribute_value', 'id');
                        $result1['classified_attribute'][$key]['attr_AllValues'] = $attr_AllValues->toArray();
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_name'] == 'Numeric') {
                        $attr_AllValuesNumeric = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $result1['classified_attribute'][$key]['attr_AllValuesNumeric'] = $attr_AllValuesNumeric->toarray();
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    } else
                    if ($value['attr_type_name'] == 'calendar') {
                        $attr_AllValuesCalendar = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $result1['classified_attribute'][$key]['attr_AllValuesNumeric'] = $attr_AllValuesCalendar->toarray();
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
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
                        $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                    }
                }
                if (isset($multi_select) && !empty($multi_select)) {
                    $result1['multi_select'] = $multi_select;
                }
            } catch (ModelNotFoundException $ex) {
                
            }
        }

        return view('admin/' . $this->viewName . '/edit', compact('modelTitle', 'classified', 'controllerName', 'actionName', 'categories', 'state', 'suburb', 'result', 'result1', 'viewName', 'subcategories', 'isCommunity', 'BelongsToCommunities', 'stateCode', 'statename', 'showStaticAttributes', 'communities_informationarr'));
    }

    /**
     * admin_view
     * admin_view classifieds 
     *
     * @return void
     * @access public
     */
    public function admin_view($id = null, $viewpage = null) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;
        $viewbutton = $viewpage;
        $category = new Category;
        $categories = $category->categoryListing(['pid' => 0]);

        $state = DB::table('state')->pluck('name', 'id');


        $result = false;
        if (isset($id)) {
            try {
                $result = $this->model->where('id', '=', $id)->with(['classified_attribute' => function ($query) {
                                $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name');
                            }, 'classified_image'])
                        ->with(['categoriesname' => function ($query1) {
                                $query1->select("id", 'belong_to_community');
                            }])
                        ->first();

                foreach ($result->classified_attribute as $k2 => $v2) {
                    if (in_array($v2['attr_type_id'], [4, 5, 7])) {
                        $res = DB::table('attribute_value')->select('values')->where('id', $v2['attr_value'])->first();
                        if (!empty($res->values)) {
                            $result->classified_attribute[$k2]['attr_AllValuesText'] = $res->values;
                        } else {
                            $result->classified_attribute[$k2]['attr_AllValuesText'] = '';
                        }
                    }
                }
                $subcategories = $category->categoryListing(['pid' => $result->parent_categoryid]);
                $suburb = DB::table('subregions')->where('region_id', $result->state_id)->pluck('name', 'id');
            } catch (ModelNotFoundException $ex) {
                
            }
        }
        return view('admin/' . $this->viewName . '/view', compact('modelTitle', 'classified', 'controllerName', 'actionName', 'categories', 'state', 'suburb', 'result', 'viewName', 'subcategories', 'viewbutton'));
    }

    /**
     * admin_create
     * admin_create classifieds 
     *
     * @return void
     * @access public
     */
    public function admin_create(Request $request) {


        $viewName = $this->viewName;
        if ($request->isMethod('post')) {

            $requestArr = Input::all();
            $input = Input::all();
            $requestArr = Input::all();
            $subregions_id = $requestArr['subregions_id'];
            $lat = $requestArr['lat'];
            $lng = $requestArr['lng'];
            if (!empty($subregions_id)) {
                $row = \DB::table('cities')->where("City", '=', $subregions_id)->first();

                if (!empty($row)) {
                    $city_id = $row->CityId;
                } else {
                    $attachmentData = array('City' => $subregions_id, 'Latitude' => $lat, 'Longitude' => $lng);
                    $insertcityid = \DB::table('cities')->insertGetId($attachmentData);
                    $city_id = $insertcityid;
                }
            }
            $rules = array(
                'title' => 'required|unique:classifieds',
                'parent_categoryid' => 'required',
                'location' => 'sometimes',
                'state_id' => 'sometimes',
                'pincode' => 'sometimes',
                'contact_name' => 'sometimes',
                'contact_email' => 'sometimes',
                'description' => 'required',
                'contact_mobile' => 'sometimes|alpha_dash|min:10',
                'product_code' => 'unique:classifieds',
            );


            $nbr = count(Input::file('image')) - 1;
            foreach (range(0, $nbr) as $index) {

                $rules['image.' . $index] = 'required|mimes:jpeg,png|max:3000';
            }
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {

                $messages = $validator->messages();
                return \Response::json($messages, 417);
            }

            $exceptFields = ['_token', 'attr_ids', 'withCommunty', 'withinformation'];
            $data = new Classified();
            foreach ($requestArr as $key => $value) {

                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }
            if (isset($request->category_id) && $request->category_id == '') {
                $data->category_id = 0;
            }

            if (isset($request->state_id) && $request->state_id == '') {
                $data->state_id = 0;
            }

            if (isset($request->subregions_id) && $request->subregions_id == '') {
                $data->subregions_id = 0;
            }

            if (isset($city_id)) {
                $data->city_id = $city_id;
            }
            if (!isset($request->featured_classified) && $request->featured_classified != 1) {
                $data->featured_classified = 0;
            }
            if (isset($request->start_date) && $request->start_date != '') {
                $request->start_date = new \DateTime($request->start_date);
                $data->start_date = $strt_date = date_format($request->start_date, 'Y-m-d');
            } else {
                $data->start_date = $strt_date = date("Y-m-d");
            }

            if (isset($request->end_date) && $request->end_date != '') {
                $request->end_date = new \DateTime($request->end_date);
                $data->end_date = date_format($request->end_date, 'Y-m-d');
            } else {

                if ($data->featured_classified == 0) {
                    $data->end_date = date("Y-m-d", strtotime($data->start_date . "+" . Redis::get('Unfeature-Classified-Day') . " day"));
                } else {
                    $data->end_date = date("Y-m-d", strtotime($data->start_date . "+" . Redis::get('Feature-Classified-Day') . " day"));
                }
            }
            if (isset($request->withCommunty) && $request->withCommunty == 1) {
                $data->end_date = '9999-01-01';
            }
            if (isset($request->withinformation) && $request->withinformation == 1) {
                $data->end_date = '9999-01-01';
            }

            if (isset($request->withCommunty) && $request->withCommunty == 1) {
                $data->price = 0;
            }

            $data->user_id = Auth::guard('admin')->user()->id;
//for multi-select - checkbox
            if (isset($request->attr_value_multi) && $request->attr_value_multi) {

                foreach ($request->attr_value_multi as $key => $value) {
                    foreach ($value as $k => $v) {

                        $extra1[$v]["attribute_id"] = $key;
                        $extra1[$v]["attr_type_name"] = $request->attr_type_name_multi;
                        $extra1[$v]["attr_type_id"] = $request->attr_type_id_multi;
                        $extra1[$v]["attr_value"] = $v;
                    }
                }
            } else {
                $extra1 = [];
            }

//for Radio
            if (isset($request->attr_value_radio) && $request->attr_value_radio) {

                foreach ($request->attr_value_radio as $key => $value) {
                    foreach ($value as $k => $v) {

                        $extra2[$v]["attribute_id"] = $key;
                        $extra2[$v]["attr_type_name"] = $request->attr_type_name_radio;
                        $extra2[$v]["attr_type_id"] = $request->attr_type_id_radio;
                        $extra2[$v]["attr_value"] = $v;
                    }
                }
                $extra1 = $extra1 + $extra2;
            }
//for Image Gallery
            if (Input::file('attr_value_image')) {
                if (isset($request->attr_value_image)) {
                    foreach ($request->attr_value_image as $key => $value) {
                        foreach ($value as $k => $v) {
                            $extension = $v->getClientOriginalExtension();
                            $ran = rand(11111, 99999);
                            $fileNameAttrTypeImageGallery[$key][] = $ran . '.' . $extension;

                            $extra3[$fileNameAttrTypeImageGallery[$key][$k]]["attribute_id"] = $key;
                            $extra3[$fileNameAttrTypeImageGallery[$key][$k]]["attr_type_name"] = $request->attr_type_name_image;
                            $extra3[$fileNameAttrTypeImageGallery[$key][$k]]["attr_type_id"] = $request->attr_type_id_image;
                            $extra3[$fileNameAttrTypeImageGallery[$key][$k]]["attr_value"] = $fileNameAttrTypeImageGallery[$key][$k];
                        }
                    }
                }
                $extra1 = $extra1 + $extra3;
            }
            if (isset($requestArr['attr_ids']) && !empty($requestArr['attr_ids'])) {

                foreach ($request->attr_type_name as $key => $value) {
                    if ($request->attr_value[$key] != '') {
                        $extra[$key]["attr_type_name"] = $value;
                        $extra[$key]["attr_type_id"] = $request->attr_type_id[$key];
                        $extra[$key]["attr_value"] = $request->attr_value[$key];
                        $extra[$key]["parent_value_id"] = $request->parent_value_id[$key];
                        $extra[$key]["parent_attribute_id"] = $request->parent_attribute_id[$key];

                        $requestArr1['attr_ids'][$key] = $requestArr['attr_ids'][$key];
                    }
                }
                $dataExtra = array_combine($requestArr1['attr_ids'], $extra);
            }
            //forVideo Type
            if (Input::file('attr_value_video')) {
                $attr_value_video = Input::file('attr_value_video');
                foreach ($attr_value_video as $key => $val) {
                    $extension = $val->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $VideoNameAttrType[] = $ran . '.' . $extension;
                    $extraVideo[$request->attr_ids_video[$key]]["attr_type_name"] = $request->attr_type_name_video[$key];
                    $extraVideo[$request->attr_ids_video[$key]]["attr_type_id"] = $request->attr_type_id_video[$key];
                    $extraVideo[$request->attr_ids_video[$key]]["attr_value"] = $VideoNameAttrType[$key];
                }
                if (isset($dataExtra) && !empty($dataExtra)) {
                    $dataExtra = $dataExtra + $extraVideo;
                } else {
                    $dataExtra = $extraVideo;
                }
            }

            $classified = $this->model->create($data->toArray());
            if (isset($dataExtra) && !empty($dataExtra)) {
                $classified->classified_attribute()->sync($dataExtra);
            }

            if (isset($extra1) && !empty($extra1)) {
                foreach ($extra1 as $ke => $val) {
                    $val['classified_id'] = $classified->id;
                    \DB::table('attribute_classified')->insert($val);
                }
            }
            $lastinstertid = $classified->id;
            if ($lastinstertid) {
                if (Input::file('image')) {
                    $image = Input::file('image');

                    $attachmentData = array();
                    if (!is_dir('upload_images/classified/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/30px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/30px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/950x530px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/950x530px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/285x217px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/285x217px/' . $lastinstertid, 0777, true);
                    }
                    foreach ($image as $key => $val) {



                        $destinationPath = 'upload_images/classified/' . $lastinstertid . '/';

                        $destinationPaththumb = 'upload_images/classified/30px/' . $lastinstertid . '/';
                        $destinationPaththumb1 = 'upload_images/classified/950x530px/' . $lastinstertid . '/';
                        $destinationPaththumb285x217px = 'upload_images/classified/285x217px/' . $lastinstertid . '/';
                        $extension = $val->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $fileName = $ran . '.' . $extension;

                        $val->move($destinationPath, $fileName);
                        image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                        image1::make($destinationPath . $fileName)->resize(950, 530)->save($destinationPaththumb1 . $fileName);
                        image1::make($destinationPath . $fileName)->resize(285, 217)->save($destinationPaththumb285x217px . $fileName);
                        $attachmentData[] = array('classified_id' => $lastinstertid, 'name' => $fileName);
                    }
                    \DB::table('classifiedimage')->insert($attachmentData);
                }

                //For Videotype attribute value
                if (Input::file('attr_value_video')) {
                    $attr_value_video = Input::file('attr_value_video');
                    foreach ($attr_value_video as $key => $val) {
                        File::makeDirectory('upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key], 0777, true);
                        $destinationPath = 'upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key] . '/';
                        $val->move($destinationPath, $VideoNameAttrType[$key]);
                    }
                }

//For ImagesGallery attribute value
                if (Input::file('attr_value_image')) {
                    $attr_value_images = Input::file('attr_value_image');

                    foreach ($attr_value_images as $key => $val) {
                        foreach ($val as $k => $v) {

                            if (!is_dir('upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key)) {
                                File::makeDirectory('upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key, 0777, true);
                            }
                            $destinationPath = 'upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key . '/';

                            $v->move($destinationPath, $fileNameAttrTypeImageGallery[$key][$k]);
                        }
                    }
                }

//function for mailing in saved srearch basis of immediately frequency
                if (isset($request->status) && $request->status == 1) {
                    if (isset($strt_date) && $strt_date == date("Y-m-d")) {
                        app('App\Http\Controllers\admin\SavedSearchesController')->mail_at_immediately_frequency($lastinstertid);
                    }
                }
            }

            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully submitted.');
            return response()->json(['status' => true, 'url' => 'classifieds']);
        }
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
            $input = Input::all();
            $id = $request->id;
            $this->validate($request, [
                'parent_categoryid' => 'required',
                'attr_value_video.*' => 'sometimes|required|max:50000',
                'location' => 'sometimes',
                'state_id' => 'sometimes',
                'pincode' => 'sometimes',
                'contact_name' => 'sometimes',
                'contact_email' => 'sometimes',
                'contact_mobile' => 'sometimes',
                'product_code' => 'unique:classifieds,product_code,' . $id,
            ]);


            $subregions_id = $request->subregions_id;
            $lat = $request['lat'];
            $lng = $request['lng'];
            if (!empty($subregions_id)) {

                $row = \DB::table('cities')->where("City", '=', $subregions_id)->first();
                if (!empty($row)) {
                    $city_id = $row->CityId;
                } else {
                    $attachmentData = array('City' => $subregions_id, 'Latitude' => $lat, 'Longitude' => $lng);
                    $insertcityid = \DB::table('cities')->insertGetId($attachmentData);
                    $city_id = $insertcityid;
                }
            }

            $saved_image = $this->model->where('id', '=', $id)->with('classified_image')->first();
            if (empty($saved_image->classified_image->toarray())) {
                $nbr = count(Input::file('image')) - 1;
                foreach (range(0, $nbr) as $index) {
                    $rules['image.' . $index] = 'required | mimes:jpeg,png|max:3000';
                }

                $validator = Validator::make($input, $rules);
                if ($validator->fails()) {

                    $messages = $validator->messages();
                    return \Response::json($messages, 417);
                }
            }

            if (Input::file('attr_value_video')) {
                $attr_value_video = Input::file('attr_value_video');

                $data = [];
                foreach ($attr_value_video as $key => $val) {
                    $extension = strtolower($val->getClientOriginalExtension());
                    if (!in_array($extension, ['wmv', 'mp4', 'mov'])) {
                        $data[$key] = ['status' => false, 'fields' => 'attr_value_video', 'message' => 'Invalid video type', 'keys' => $key];
                    }
                }
                if (!empty($data)) {
                    return response()->json(['data' => $data]);
                }
            }

            $requestArr = Input::all();

            $exceptFields = ['_token', 'attr_type_name', 'attr_type_id', 'attr_value', 'attr_ids', 'parent_value_id', 'parent_attribute_id', 'image', 'attr_ids_multi',
                'attr_value_multi', 'attr_type_id_multi', 'attr_type_name_multi', 'attr_type_name_file', 'attr_type_id_file',
                'attr_ids_file', 'attr_value_file_old', 'attr_value_file', 'hour', 'minute', 'meridian', 'attr_type_name_video',
                'attr_type_id_video', 'attr_ids_video', 'attr_value_video_old', 'attr_value_video',
                'attr_ids_radio', 'attr_value_radio', 'attr_type_id_radio', 'attr_type_name_radio', 'attr_type_name_image',
                'attr_type_name_image', 'attr_type_id_image', 'attr_ids_image', 'attr_value_image_old', 'attr_value_image', 'withCommunty', 'city', 'withinformation'];
            $data = $this->model->findOrFail($requestArr['id']);

            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if (isset($request->category_id) && $request->category_id == '') {
                $data->category_id = 0;
            }

            if (isset($request->state_id) && $request->state_id == '') {
                $data->state_id = 0;
            }

            if (isset($request->subregions_id) && $request->subregions_id == '') {
                $data->subregions_id = 0;
            }
            if (isset($city_id)) {
                $data->city_id = $city_id;
            }
            if (!isset($request->featured_classified) && $request->featured_classified != 1) {
                $data->featured_classified = 0;
            }

            if (isset($request->start_date) && $request->start_date != '') {
                $request->start_date = new \DateTime($request->start_date);
                $data->start_date = date_format($request->start_date, 'Y-m-d');
            } else {
                $data->start_date = date("Y-m-d");
            }


            if (isset($request->end_date) && $request->end_date != '') {
                $request->end_date = new \DateTime($request->end_date);
                $data->end_date = date_format($request->end_date, 'Y-m-d');
            } else {
                if ($data->featured_classified == 0) {
                    $data->end_date = date("Y-m-d", strtotime($data->start_date . "+" . Redis::get('Unfeature-Classified-Day') . " day"));
                } else {
                    $data->end_date = date("Y-m-d", strtotime($data->start_date . "+" . Redis::get('Feature-Classified-Day') . " day"));
                }
            }
            if (isset($request->withCommunty) && $request->withCommunty == 1) {
                $data->end_date = '9999-01-01';
            }
            if (isset($request->withinformation) && $request->withinformation == 1) {
                $data->end_date = '9999-01-01';
            }
            if (isset($request->withCommunty) && $request->withCommunty == 1) {
                $data->price = 0;
            }
            if (isset($request->description)) {
                $data->description = $request->description;
            }

            if (!isset($request->status) && $request->status != 1) {
                $data->status = 0;
            }
            $extra1 = [];
            $extra2 = [];
            $extra3 = [];
            $extra4 = [];
            $dataExtra = [];

            if (isset($request->attr_value_multi) && !empty($request->attr_value_multi)) {

                foreach ($request->attr_value_multi as $key => $value) {
                    foreach ($value as $k => $v) {

                        $extra1[$v]["attribute_id"] = $key;
                        $extra1[$v]["attr_type_name"] = $request->attr_type_name_multi;
                        $extra1[$v]["attr_type_id"] = $request->attr_type_id_multi;
                        $extra1[$v]["attr_value"] = $v;
                    }
                }
            } else {
                $extra1 = [];
            }

            if (isset($requestArr['attr_ids_radio']) && !empty($requestArr['attr_ids_radio'])) {
                if (isset($request->attr_value_radio)) {
                    foreach ($request->attr_value_radio as $key => $value) {
                        foreach ($value as $k => $v) {

                            $extra2[$v]["attribute_id"] = $key;
                            $extra2[$v]["attr_type_name"] = $request->attr_type_name_radio;
                            $extra2[$v]["attr_type_id"] = $request->attr_type_id_radio;
                            $extra2[$v]["attr_value"] = $v;
                        }
                    }
                }
                $extra1 = $extra1 + $extra2;
            }

            if (isset($request->attr_ids_image)) {
                foreach ($request->attr_ids_image as $key => $value) {

                    if (isset($request->attr_value_image[$value]) && (!empty($request->attr_value_image[$value]))) {
                        foreach ($request->attr_value_image[$value] as $k => $v) {
                            $extension = $v->getClientOriginalExtension();
                            $ran = rand(11111, 99999);
                            $fileNameAttrTypeImageGallery[$value][] = $ran . '.' . $extension;

                            $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attribute_id"] = $value;
                            $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attr_type_name"] = $request->attr_type_name_image;
                            $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attr_type_id"] = $request->attr_type_id_image;
                            $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attr_value"] = $fileNameAttrTypeImageGallery[$value][$k];
                        }
                        $extra1 = $extra1 + $extra3;
                    }
                    foreach ($request->attr_value_image_old[$value] as $k1 => $v1) {
                        $extra4[$v1]["attribute_id"] = $value;
                        $extra4[$v1]["attr_type_name"] = $request->attr_type_name_image;
                        $extra4[$v1]["attr_type_id"] = $request->attr_type_id_image;
                        $extra4[$v1]["attr_value"] = $v1;
                    }

                    $extra1 = $extra1 + $extra4;
                }
            }


            $requestArr1['attr_ids'] = [];
            $extra = [];
            if (isset($requestArr['attr_ids']) && !empty($requestArr['attr_ids'])) {
                foreach ($request->attr_type_name as $key => $value) {
                    if ($request->attr_value[$key] == ';') {
                        $request->attr_value[$key] = '';
                    }
                    $extra[$key]["attr_type_name"] = $value;
                    $extra[$key]["attr_type_id"] = $request->attr_type_id[$key];
                    $extra[$key]["attr_value"] = $request->attr_value[$key];
                    $extra[$key]["parent_value_id"] = $request->parent_value_id[$key];
                    $extra[$key]["parent_attribute_id"] = $request->parent_attribute_id[$key];

                    $requestArr1['attr_ids'][$key] = $requestArr['attr_ids'][$key];
                }

                $dataExtra = array_combine($requestArr1['attr_ids'], $extra);
            }

            //forVideo Type
            if (isset($request->attr_ids_video)) {
                foreach ($request->attr_ids_video as $key => $val) {
                    $attr_value_video = Input::file('attr_value_video');
                    if (isset($attr_value_video[$key])) {

                        $extension = $attr_value_video[$key]->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $VideoNameAttrType[$key] = $ran . '.' . $extension;
                        $extraVideo[$request->attr_ids_video[$key]]["attr_type_name"] = $request->attr_type_name_video[$key];
                        $extraVideo[$request->attr_ids_video[$key]]["attr_type_id"] = $request->attr_type_id_video[$key];
                        $extraVideo[$request->attr_ids_video[$key]]["attr_value"] = $VideoNameAttrType[$key];
                    } else if (isset($request->attr_value_video_old[$key]) && (!empty($request->attr_value_video_old[$key]))) {
                        $extraVideo[$request->attr_ids_video[$key]]["attr_type_name"] = $request->attr_type_name_video[$key];
                        $extraVideo[$request->attr_ids_video[$key]]["attr_type_id"] = $request->attr_type_id_video[$key];
                        $extraVideo[$request->attr_ids_video[$key]]["attr_value"] = $request->attr_value_video_old[$key];
                    }
                }
                if (isset($dataExtra) && !empty($dataExtra)) {
                    $dataExtra = $dataExtra + $extraVideo;
                } else {
                    $dataExtra = $extraVideo;
                }
            }

            $classified = $data->save();
            if (isset($dataExtra) && !empty($dataExtra)) {
                $data->classified_attribute()->sync($dataExtra);
            }


            foreach ($dataExtra as $k2 => $v2) {
                if ($v2['attr_value'] == '' || $v2['attr_value'] == 'on') {
                    DB::table('attribute_classified')->where('classified_id', '=', $requestArr['id'])->where('attribute_id', '=', $k2)->delete();
                }
            }
            DB::table('attribute_classified')->where('classified_id', '=', $requestArr['id'])->where('attr_type_name', '=', 'Multi-Select')->delete();
            DB::table('attribute_classified')->where('classified_id', '=', $requestArr['id'])->where('attr_type_name', '=', 'Radio-button')->delete();
            if (isset($extra1) && !empty($extra1)) {
                foreach ($extra1 as $ke => $val) {
                    $val['classified_id'] = $requestArr['id'];
                    \DB::table('attribute_classified')->insert($val);
                }
            }

            $lastinstertid = $requestArr['id'];

            if ($lastinstertid) {
                if (Input::file('image')) {

                    $image = Input::file('image');
                    $attachmentData = array();
                    if (!is_dir('upload_images/classified/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/' . $lastinstertid);
                        File::makeDirectory('upload_images/classified/30px/' . $lastinstertid);
                        File::makeDirectory('upload_images/classified/950x530px/' . $lastinstertid);
                        File::makeDirectory('upload_images/classified/285x217px/' . $lastinstertid);
                    }

                    foreach ($image as $key => $val) {

                        $destinationPath = 'upload_images/classified/' . $lastinstertid . '/';

                        $destinationPaththumb = 'upload_images/classified/30px/' . $lastinstertid . '/';
                        $destinationPaththumb1 = 'upload_images/classified/950x530px/' . $lastinstertid . '/';
                        $destinationPaththumb285x217px = 'upload_images/classified/285x217px/' . $lastinstertid . '/';
                        $extension = $val->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $fileName = $ran . '.' . $extension;

                        $val->move($destinationPath, $fileName);
                        image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                        image1::make($destinationPath . $fileName)->resize(950, 530)->save($destinationPaththumb1 . $fileName);
                        image1::make($destinationPath . $fileName)->resize(285, 217)->save($destinationPaththumb285x217px . $fileName);
                        $attachmentData[] = array('classified_id' => $lastinstertid, 'name' => $fileName);
                    }
                    \DB::table('classifiedimage')->insert($attachmentData);
                }

//For Filetype attribute value
                if (Input::file('attr_value_file')) {
                    $attr_value_file = Input::file('attr_value_file');
                    foreach ($attr_value_file as $key => $val) {

                        if (!is_dir('upload_images/attribute_values/file/' . $lastinstertid . '/' . $request->attr_ids_file[$key])) {
                            File::makeDirectory('upload_images/attribute_values/file/' . $lastinstertid . '/' . $request->attr_ids_file[$key], 0777, true);
                        }

                        $destinationPath = 'upload_images/attribute_values/file/' . $lastinstertid . '/' . $request->attr_ids_file[$key] . '/';

                        $val->move($destinationPath, $fileNameAttrType[$key]);
                    }
                }

//For Videotype attribute value
                if (Input::file('attr_value_video')) {
                    $attr_value_video = Input::file('attr_value_video');
                    foreach ($attr_value_video as $key => $val) {

                        if (!is_dir('upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key])) {
                            File::makeDirectory('upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key], 0777, true);
                        }

                        $destinationPath = 'upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key] . '/';

                        $val->move($destinationPath, $VideoNameAttrType[$key]);
                    }
                }

//For ImagesGallery attribute value
                if (Input::file('attr_value_image')) {
                    $attr_value_images = Input::file('attr_value_image');

                    foreach ($attr_value_images as $key => $val) {
                        foreach ($val as $k => $v) {

                            if (!is_dir('upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key)) {
                                File::makeDirectory('upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key, 0777, true);
                            }
                            $destinationPath = 'upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key . '/';

                            $v->move($destinationPath, $fileNameAttrTypeImageGallery[$key][$k]);
                        }
                    }
                }
            }
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully submitted.');
            return response()->json(['status' => true, 'url' => 'classifieds']);
        }
    }

    /**
     * admin_delete
     * admin_delete classifieds 
     *
     * @return response
     * @access public
     */
    public function admin_delete() {

        $viewName = $this->viewName;
        $data = Input::all();

        $id = $data['id'];
        if (!empty($id)) {

            try {
                $result = $this->model->findOrFail($id);

                $result->attributes_classified()->delete();

                $result->classified_image()->delete();
                \DB::table('notification')->where("classified_id", '=', $id)->delete();
                \DB::table('reports')->where("classified_id", '=', $id)->delete();

                $result->delete();
                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully Deleted.');

                return response()->json(['status' => true, 'url' => 'classifieds']);
            } catch (\Exception $ex) {

                return response()->json(['status' => false, 'url' => 'classifieds', 'message' => 'First delete all the bind attributes.']);
            }
        }
    }

    /**
     * deleteclassifiedapi
     * deleteclassifiedapi classifieds 
     *
     * @return response
     * @access public
     */
    public function deleteclassifiedapi(Request $request) {

        $id = $request->id;

        if (!empty($id)) {

            $data = $this->model->findOrFail($id);

            $data->attributes_classified()->delete();

            $data->classified_image()->delete();
            $data->delete();

            $result['status'] = 1;
            $result['msg'] = 'Delete successfully.';
            echo json_encode($result);
            die;
        } else {
            $result['status'] = 0;
            $result['msg'] = 'Invalid Details.';
            echo json_encode($result);
            die;
        }
    }

    /**
     * admin_delete_reject
     * admin_delete_reject classifieds 
     *
     * @return response
     * @access public
     */
    public function admin_delete_reject() {

        $viewName = $this->viewName;
        $data = Input::all();

        $id = $data['id'];
        if (!empty($id)) {

            try {
                $result = $this->model->findOrFail($id);

                $result->attributes_classified()->delete();

                $result->classified_image()->delete();
                $result->delete();
                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully Deleted.');

                return response()->json(['status' => true, 'url' => 'classifieds/reject']);
            } catch (\Exception $ex) {

                return response()->json(['status' => false, 'url' => 'classifieds/reject', 'message' => 'First delete all the bind attributes.']);
            }
        }
    }

    /**
     * admin_delete_approve
     * admin_delete_approve classifieds 
     *
     * @return response
     * @access public
     */
    public function admin_delete_approve() {

        $viewName = $this->viewName;
        $data = Input::all();

        $id = $data['id'];
        if (!empty($id)) {

            try {
                $result = $this->model->findOrFail($id);

                $result->attributes_classified()->delete();

                $result->classified_image()->delete();
                $result->delete();
                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully Deleted.');

                return response()->json(['status' => true, 'url' => 'classifieds/approve']);
            } catch (\Exception $ex) {

                return response()->json(['status' => false, 'url' => 'classifieds/approve', 'message' => 'First delete all the bind attributes.']);
            }
        }
    }

    /**
     * admin_multi_check_options
     * admin_multi_check_options classifieds 
     *
     * @return response
     * @access public
     */
    public function admin_multi_check_options() {

        $data = Input::all();

        if (!empty($data['checkedId'])) {
            foreach ($data['checkedId'] as $key => $value) {
                DB::table('classifieds')
                        ->where('id', $value)
                        ->update(['status' => $data['status']]);
            }
            return response()->json(['status' => true, 'url' => 'classifieds']);
        }
    }

    /**
     * admin_allregins
     * admin_allregins classifieds 
     *
     * @return response
     * @access public
     */
    public function admin_allregins() {

        $data = Input::all();

        if (isset($data['id'])) {

            $sub_regions = DB::table('subregions')
                            ->where('region_id', $data['id'])->pluck('name', 'id');

            return response()->json(['status' => true, 'sub_regions' => $sub_regions]);
        }
    }

    /**
     * admin_export_classified
     * admin_export_classified classifieds 
     *
     * @return response
     * @access public
     */
    public function admin_export_classified() {

        $data = $this->model->where('status', '=', 1)->orWhere('status', '=', 0)->orderBy('id', 'DESC')->with('categoriesname')->with('Subcategoriesname')->with('state')->with('subregion')->get();

        $headings = array(
            'ID',
            'Title',
            'Category',
            'Sub Category',
            'Location',
            'State',
            'Subregion',
            'Pincode',
            'Contact Name',
            'Contact Email',
            'Contact Mobile',
            'Website',
            'Description',
            'Featured Classified',
            'Start Date',
            'End Date',
            'Status'
        );

        $filename = 'classified_list_' . time() . '.csv';

        $csv_terminated = "\n";
        $csv_separator = ",";
        $csv_enclosed = '"';
        $csv_escaped = "\\";

        $schema_insert = '';

        foreach ($headings as $heading) {
            $l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, stripslashes($heading)) . $csv_enclosed;
            $schema_insert .= $l;
            $schema_insert .= $csv_separator;
        }
        $out = trim(substr($schema_insert, 0, -1));
        $out .= $csv_terminated;


        foreach ($data as $key => $single) {
            $schema_insert = '';

            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->id) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->title) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->categoriesname["name"]) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->subcategoriesname["name"]) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->location) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->state["name"]) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->subregion["name"]) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->pincode) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->contact_name) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->contact_email) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->contact_mobile) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->website) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, html_entity_decode(strip_tags($single->description))) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, ($single->featured_classified == 0 ? "No" : "Yes")) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, date('d-M-Y', strtotime($single->start_date))) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, date('d-M-Y', strtotime($single->end_date))) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, ($single->status == 0 ? "Inactive" : "Active")) . $csv_enclosed . $csv_separator;

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

    /**
     * admin_export_approve_classified
     * admin_export_approve_classified classifieds 
     *
     * @return response
     * @access public
     */
    public function admin_export_approve_classified() {


        $data = $this->model->where('status', '=', 2)->orderBy('id', 'DESC')->with('categoriesname')->with('Subcategoriesname')->with('state')->with('subregion')->get();

        $headings = array(
            'ID',
            'Title',
            'Category',
            'Sub Category',
            'Location',
            'State',
            'Subregion',
            'Pincode',
            'Contact Name',
            'Contact Email',
            'Contact Mobile',
            'Website',
            'Description',
            'Featured Classified',
            'Start Date',
            'End Date',
            'Status'
        );

        $filename = 'unapprove_classified_list_' . time() . '.csv';

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
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->title) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->categoriesname["name"]) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->subcategoriesname["name"]) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->location) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->state["name"]) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->subregion["name"]) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->pincode) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->contact_name) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->contact_email) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->contact_mobile) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $single->website) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, html_entity_decode(strip_tags($single->description))) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, ($single->featured_classified == 0 ? "No" : "Yes")) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, date('d-M-Y', strtotime($single->start_date))) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, date('d-M-Y', strtotime($single->end_date))) . $csv_enclosed . $csv_separator;
            $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, ($single->status == 0 ? "Inactive" : "Active")) . $csv_enclosed . $csv_separator;

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

    /**
     * admin_delete_attachment
     * admin_delete_attachment classifieds 
     *
     * @return response
     * @access public
     */
    public function admin_delete_attachment(Request $request) {

        if ($request->isMethod('post')) {
            $data = Input::all();
            $id = $data['id'];
            if (!empty($id)) {

                $row = \DB::table('classifiedimage')->where("id", '=', $id)->first();
                $deletedModel = new ClassifiedImage;
                $result = $deletedModel->findOrFail($id);
                if ($result->delete()) {
                    $destinationPath = '/upload_images/classified/' . $row->classified_id . '/' . $row->name . '/';
                    $thumbDestinationPath = '/upload_images/classified/30px/' . $row->classified_id . '/';
                    File::delete($destinationPath . '/' . $row->name);
                    File::delete($thumbDestinationPath . '/' . $row->name);
                    if (!File::exists($destinationPath . '/' . $row->name) && !File::exists($thumbDestinationPath . '/' . $row->name)) {
                        return response()->json(['status' => true]);
                    } else {
                        return response()->json(['status' => false]);
                    }
                }
            }
        }
    }

    /**
     * front_delete_attachmentapi
     * front_delete_attachmentapi classifieds 
     *
     * @return response
     * @access public
     */
    public function front_delete_attachmentapi(Request $request) {

        if ($request->isMethod('post')) {
            $data = Input::all();
            $id = $request->id;
            if (!empty($id)) {

                $row = \DB::table('classifiedimage')->where("id", '=', $id)->first();
                $deletedModel = new ClassifiedImage;
                $result = $deletedModel->findOrFail($id);
                if ($result->delete()) {
                    $destinationPath = '/upload_images/classified/' . $row->classified_id . '/' . $row->name . '/';
                    $thumbDestinationPath = '/upload_images/classified/30px/' . $row->classified_id . '/';
                    File::delete($destinationPath . '/' . $row->name);
                    File::delete($thumbDestinationPath . '/' . $row->name);
                    if (!File::exists($destinationPath . '/' . $row->name) && !File::exists($thumbDestinationPath . '/' . $row->name)) {
                        $resultdelete['status'] = 1;
                        $resultdelete['msg'] = 'Image Delete Successfully';
                        echo json_encode($resultdelete);
                        die;
                    } else {
                        $resultdelete['status'] = 0;
                        $resultdelete['msg'] = 'Please try again';
                        echo json_encode($resultdelete);
                        die;
                    }
                }
            } else {
                $resultdelete['status'] = 0;
                $resultdelete['msg'] = 'Invalid Details';
                echo json_encode($resultdelete);
                die;
            }
        }
    }

    /**
     * admin_delete_gallery
     * admin_delete_gallery classifieds 
     *
     * @return response
     * @access public
     */
    public function admin_delete_gallery(Request $request) {

        if ($request->isMethod('post')) {
            $data = Input::all();

            if (!empty($data)) {

                $row = \DB::table('attribute_classified')->where("classified_id", '=', $data['classified_id'])->where("attr_value", '=', $data['file_name'])->delete();
                if ($row) {
                    return response()->json(['status' => true]);
                } else {
                    return response()->json(['status' => false]);
                }
            }
        }
    }

    /**
     * get_classified_viewed
     * get_classified_viewed classifieds 
     *
     * @return void
     * @access public
     */
    public function get_classified_viewed(Request $request) {
        $current_date = date('Y-m-d');

        if ($request->isMethod('post')) {
            $data = Input::all();

            if (!empty($data)) {

                $hr = Redis::get('Trending-Classified-hours');
                $hr = 200;
                $distance = Redis::get('Default-Search-Radius');
                if ($data['lat'] == 0 && $data['lng'] == 0) {

                    $data = DB::select(DB::raw("select * ,c.created_at as classified_create,ci.name as imagename,ci.classified_id as classifiedid, SUBSTRING_INDEX(replace(c.location,' ',''),',',-1 ) country 
                                from `classifiedimage` ci join
                                (select *,max(id) id1
                                from `classifieds` 
                                group by id having `status` = 1 and `updated_at` >= DATE_SUB(NOW(), INTERVAL $hr HOUR)) c
                                on ci.classified_id=c.id1
                                join categories cat on cat.id = c.parent_categoryid
                                left join cities ct on c.city_id = ct.CityId
                                group by c.id1
                                having  (curdate() between c.start_date and c.end_date)
                                and cat.belong_to_community = 0
                                and cat.show_on_info_area = 0 
                                order by count desc
                                limit 10 offset $data[offset]"));
                } else {
                    $data = DB::select(DB::raw("select * ,c.created_at as classified_create,SUBSTRING_INDEX(replace(c.location,' ',''),',',-1 ) country 
                                from `classifiedimage` ci join
                                (select  *,max(id) id1,
                                (SQRT(POW(69.1 * (lat - $data[lat]), 2) + POW(69.1 * ($data[lng] - lng) * COS(lat / 57.3), 2)) * 1.609344 ) AS distance 
                                from `classifieds` 
                                group by id having `status` = 1 and `updated_at` >= DATE_SUB(NOW(), INTERVAL $hr HOUR) and distance < $distance) c
                                on ci.classified_id=c.id1
                                join categories cat on cat.id = c.parent_categoryid
                                left join cities ct on c.city_id = ct.CityId
                                group by c.id1
                                having (curdate() between c.start_date and c.end_date)
                                and cat.belong_to_community = 0
                                and cat.show_on_info_area = 0
                                order by count desc
                                limit 10 offset $data[offset]"));
                }


                if ($data) {

                    foreach ($data as $key => $value) {
                        $value->createtime = Helper::time_since_for_classified(time() - strtotime($value->classified_create));
                    }
                    return response()->json(['status' => true, 'data' => $data]);
                } else {
                    return response()->json(['status' => false]);
                }
            }
        }
    }

    /**
     * get_classified_viewedapi
     * get_classified_viewedapi classifieds 
     *
     * @return response
     * @access public
     */
    public function get_classified_viewedapi(Request $request) {
        $current_date = date('Y-m-d');
        $user_id = $request->user_id;
        $rooturl = \Request::root();
        if ($request->isMethod('post')) {
            $data = Input::all();
            if (!empty($data)) {

                $hr = Redis::get('Trending-Classified-hours');
                $distance = Redis::get('Default-Search-Radius');
                if ($data['lat'] == 0 && $data['lng'] == 0) {
                    $data = DB::select(DB::raw("select c.user_id,c.title,c.start_date,c.created_at,c.end_date,cat.belong_to_community,cat.show_on_info_area,"
                                            . "c.price,c.description,IF(c.lat = '','0.0',c.lat) lat,IF(c.lng = '','0.0',c.lng) lng,ct.City,ct.Latitude,ct.Longitude,c.city_id"
                                            . ",concat('$rooturl/upload_images/classified/',ci.classified_id,'/',ci.name) imageurl,ci.name as imagename,ci.classified_id as classifiedid, SUBSTRING_INDEX(replace(c.location,' ',''),',',-1 ) 
                                country,UNIX_TIMESTAMP(c.created_at)as createdtime,c.description 
                                from `classifiedimage` ci join
                                (select *,max(id) id1
                                from `classifieds` 
                                group by id having `status` = 1 and `updated_at` >= DATE_SUB(NOW(), INTERVAL $hr HOUR)) c
                                on ci.classified_id=c.id1
                                join categories cat on cat.id = c.parent_categoryid
                                left join cities ct on c.city_id = ct.CityId
                                group by c.id1
                                having  (curdate() between c.start_date and c.end_date)
                                and cat.belong_to_community = 0
                                and cat.show_on_info_area = 0 
                                order by count desc
                                "));
                } else {
                    $data = DB::select(DB::raw("select c.description,c.lat,c.lng,c.user_id,c.created_at,c.title,c.start_date,c.end_date,cat.belong_to_community,cat.show_on_info_area,"
                                            . "c.price,c.description,ct.City,ct.Latitude,ct.Longitude,c.city_id,"
                                            . "concat('$rooturl/upload_images/classified/',ci.classified_id,'/',ci.name) imageurl,ci.classified_id as classifiedid,SUBSTRING_INDEX(replace(c.location,' ',''),',',-1 ) country 
                                from `classifiedimage` ci join
                                (select  *,max(id) id1,
                                (SQRT(POW(69.1 * (lat - $data[lat]), 2) + POW(69.1 * ($data[lng] - lng) * COS(lat / 57.3), 2)) * 1.609344 ) AS distance 
                                from `classifieds` 
                                group by id having `status` = 1 and `updated_at` >= DATE_SUB(NOW(), INTERVAL $hr HOUR) and distance < $distance) c
                                on ci.classified_id=c.id1
                                join categories cat on cat.id = c.parent_categoryid
                                left join cities ct on c.city_id = ct.CityId
                                group by c.id1
                                having (curdate() between c.start_date and c.end_date)
                                 and cat.belong_to_community = 0
                                and cat.show_on_info_area = 0 
                                order by count desc
                               "));
                }
                $wishlistItems = array();
                if ($user_id != 0) {
                    $wishlistObj = new Wishlist;
                    $wishlistItems = $wishlistObj->where('user_id', '=', $user_id)->select('classified_id')->get()->toarray();
                }
                foreach ($wishlistItems as $key1 => $value1) {
                    $listarray[] = $value1['classified_id'];
                }
                foreach ($data as $key => $value) {
                    if (!empty($listarray)) {
                        if (in_array($value->classifiedid, $listarray)) {
                            $data[$key]->wishlist = 1;
                        } else {
                            $data[$key]->wishlist = 0;
                        }
                    } else {
                        $data[$key]->wishlist = 0;
                    }
                    if (!empty($value->City)) {
                        $value->location = $value->City;
                    } else {
                        $value->location = 'N/A';
                    }
                }
                if ($data) {

                    $cacheDuration = 300; // in seconds
                    // Client is told to cache these results for set duration
                    header('Cache-Control: public,max-age=' . $cacheDuration . ',must-revalidate');
                    header('Expires: ' . gmdate('D, d M Y H:i:s', ($_SERVER['REQUEST_TIME'] + $cacheDuration)) . ' GMT');
                    header('Last-modified: ' . gmdate('D, d M Y H:i:s', $_SERVER['REQUEST_TIME']) . ' GMT');

                    // Pragma header removed should the server happen to set it automatically
                    // Pragma headers can make browser misbehave and still ask data from server
                    header_remove('Pragma');


                    header('Content-Type: application/json', false);
                    $result['status'] = 1;
                    $result['data'] = $data;

                    echo json_encode($result);
                    die;
                } else {
                    $blankvalue = array(
                        '' => '',
                    );
                    return response()->json(['status' => 0, 'data' => array()]);
                }
            }
        }
    }

    /**
     * get_searchresult
     * get_searchresult classifieds 
     *
     * @return void
     * @access public
     */
    public function get_searchresult(Request $request) {
        $statemodel = new State;
        $userObj = new User;
        $current_date = date('Y-m-d');

        $data = Input::all();
        $data2 = Input::all();

        if (!empty($data)) {

//function to check the selected category is parent or not
            $task = new Category;
            $BelongsToCommunities = $task->pluck('pid', 'id')->toArray();
            $isParent = null;
            $iscategory = null;

            $allComCategories = $task->get_communities_categories();
            $allInfoCategories = $task->get_info_categories();
            if (!empty($data['cat_id']) && (in_array($data['cat_id'], $allComCategories) || in_array($data['cat_id'], $allInfoCategories))) {
                return redirect("classified_list/" . $data['cat_id']);
            }

            $conditions = array(
                array('classifieds.status', '=', 1),
            );
            $conditions[] = array('categories.belong_to_community', '!=', 1);
            $conditions[] = array('categories.show_on_info_area', '!=', 1);
            if (!empty($data['cat_id'])) {
                $isParent = $BelongsToCommunities[$data['cat_id']] == 0 ? true : false;
                if ($isParent) {
                    $conditions[] = array('classifieds.parent_categoryid', '=', $data['cat_id']);
                } else {
                    $conditions[] = array('categories.id', '=', $data['cat_id']);
                }
                $staterestult = $statemodel->getCategoriesWithClassifiedCount($data['cat_id']);
            } else {
                $iscategory = true;
                $staterestult = $statemodel->getclassifiedbystatecitycount();
            }


            if (!empty($data['itemname'])) {
                $conditions[] = array('classifieds.title', 'like', '%' . $data['itemname'] . '%');
            }
            if (!empty($data['city'])) {
                $conditions[] = array('classifieds.location', 'like', '%' . $data['city'] . '%');
            }


            if (!empty($data['order'])) {
                $order = $data['order'];
            } else {
                $order = 'asc';
            }
            $km = $data['km'];
            $lat = $data['lat'] ? $data['lat'] : 0;
            $long = $data['lng'] ? $data['lng'] : 0;

            if ($lat == '0' and $long == '0') {


                $cur_date = date('Y-m-d');

                $result = $this->model
                        ->selectRaw('categories.id,classifieds.id as classified_id ,classifieds.title as title,classifieds.description as description,classifiedimage.name as name,classifieds.price,categories.name as catname,classifieds.location as location,categories.belong_to_community as btc,categories.show_on_info_area as sia, classifieds.created_at as classified_created,cities.City as city')
                        ->leftJoin('categories', function($join) use ($isParent, $iscategory) {
                            if ($isParent) {
                                $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                            } elseif ($iscategory) {
                                $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                                $join->orOn('classifieds.category_id', '=', 'categories.id');
                            } else {
                                $join->on('classifieds.category_id', '=', 'categories.id');
                            }
                        })
                        ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                        ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                        ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                        ->leftJoin('cities', 'classifieds.city_id', '=', 'cities.CityId')
                        ->where($conditions)->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ")
                        ->groupBy('classifieds.id')
                        ->orderBy('classifieds.title', $order)
                        ->paginate(5);

//for all attributes
                $allresult = $this->model
                        ->selectRaw('categories.id,classifieds.id as classified_id ,classifieds.title as title,classifieds.description as description,classifiedimage.name as name,classifieds.price,categories.name as catname,classifieds.location as location')
                        ->leftJoin('categories', function($join) use ($isParent) {
                            if ($isParent) {
                                $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                            } else {
                                $join->on('classifieds.category_id', '=', 'categories.id');
                            }
                        })
                        ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                        ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                        ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                        ->where($conditions)->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ")
                        ->groupBy('classifieds.id')
                        ->orderBy('classifieds.title', $order)
                        ->get();
            } else {

                $cur_date = date('Y-m-d');
                $result = $this->model
                        ->select(DB::raw("(SQRT(POW(69.1 * (lat - $lat), 2) +
                                POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) AS distance, categories.id,classifieds.id as classified_id ,classifieds.title as title,classifieds.description as description,classifiedimage.name as name,classifieds.price,categories.name as catname,classifieds.location as location,categories.belong_to_community as btc,categories.show_on_info_area as sia, classifieds.created_at as classified_created,cities.City as city"))
                        ->leftJoin('categories', function($join) use ($isParent) {
                            if ($isParent) {
                                $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                            } else {
                                $join->on('classifieds.category_id', '=', 'categories.id');
                            }
                        })
                        ->whereRaw("(SQRT(POW(69.1 * (lat - $lat), 2) +
                                POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) < $km")
                        ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                        ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                        ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                        ->leftJoin('cities', 'classifieds.city_id', '=', 'cities.CityId')
                        ->where($conditions)->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ")
                        ->groupBy('classifieds.id')
                        ->orderBy('classifieds.title', $order)
                        ->paginate(5);
                //for all attribute
                $allresult = $this->model
                        ->select(DB::raw("(SQRT(POW(69.1 * (lat - $lat), 2) +
                                POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) AS distance, categories.id,classifieds.id as classified_id ,classifieds.title as title,classifieds.description as description,classifiedimage.name as name,classifieds.price,categories.name as catname,classifieds.location as location"))
                        ->leftJoin('categories', function($join) use ($isParent) {
                            if ($isParent) {
                                $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                            } else {
                                $join->on('classifieds.category_id', '=', 'categories.id');
                            }
                        })
                        ->whereRaw("(SQRT(POW(69.1 * (lat - $lat), 2) +
                                POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) < $km")
                        ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                        ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                        ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                        ->where($conditions)->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ")
                        ->groupBy('classifieds.id')
                        ->orderBy('classifieds.title', $order)
                        ->get();
            }


            foreach ($result as $key => $value) {
                $multiattribute = $this->model->where('id', '=', $value->classified_id)->with(['classified_attribute' => function ($query) {
                                $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon', 'display_name')
                                        ->where('attributes.show_list', '=', 1)
                                        ->where('attributes.status', '=', 1)
                                ;
                            }])->first()->toarray();

                $value->classified_attribute_main = $multiattribute['classified_attribute'];
            }

            $resultNewicon = $result->toarray();

            foreach ($resultNewicon['data'] as $key => $value) {
                if (!empty($value['classified_attribute_main'])) {
                    foreach ($value['classified_attribute_main'] as $in => $val) {
                        if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                            $resultNewicon['data'][$key]['classified_attribute_main'][$in]['selected'][] = $val['attr_value'];
                            $resultNewicon['data'][$key]['classified_attribute_main'][$in]['attribute_value'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                        } else
                        if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] == 0) {

                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $resultNewicon['data'][$key]['classified_attribute_main'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                        } else {
//$resultNew['data'][$key] = $value;
                        }
                    }
                }
            }

            $resultNew['data'] = $allresult->toarray();

            foreach ($resultNew['data'] as $key => $value) {
                $multiattribute1 = $this->model->where('id', '=', $value['classified_id'])->with(['classified_attribute' => function ($query) {
                                $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon', 'display_name')
                                        ->where('attributes.searchable', '=', 1)
                                        ->where('attributes.status', '=', 1)
                                ;
                            }])->first()->toarray();

                $resultNew['data'][$key]['classified_attribute'] = $multiattribute1['classified_attribute'];
            }

            $allattributearr = array();
            foreach ($resultNew['data'] as $key => $value) {

                if (!empty($value['classified_attribute'])) {
                    foreach ($value['classified_attribute'] as $in => $val) {

                        if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                            $resultNew['data'][$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                            $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                        } else
                        if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] == 0) {

                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $resultNew['data'][$key]['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                        } else
                        if (($val['attr_type_name'] == 'calendar') && (strpos($val['attr_value'], ';'))) {
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $resultNew['data'][$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                            $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                        } else
                        if (($val['attr_type_name'] == 'Numeric') && (strpos($val['attr_value'], ';'))) {
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                        } else
                        if (($val['attr_type_name'] == 'Date') && (strpos($val['attr_value'], ';'))) {
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                        } else
                        if (($val['attr_type_name'] == 'Time') && (strpos($val['attr_value'], ';'))) {
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                        } else {
                            unset($val);
                        }

                        if (isset($val) && !empty($val)) {
                            $allattributearr[$val['attr_type_name']][] = $val;
                        }
                    }
                }
            }


            if (isset($allattributearr) && !empty($allattributearr)) {
                foreach ($allattributearr as $key => $value) {
                    $stor_valueArray = [];
                    $stor_valueArrayDate = [];
                    foreach ($value as $k => $val) {

                        if ($key == 'Date') {

                            $newAttrArr[$key][] = $val;
                        } else {
                            if (!in_array($val['attr_value'], $stor_valueArray)) {

                                $stor_valueArray[] = $val['attr_value'];
                                $newAttrArr[$key][] = $val;
                            }
                        }
                        $newAttrArrForValue[$val['attr_value']][] = $val['classified_id'];
                    }
                }
            }
            if (!empty($newAttrArr)) {


                foreach ($newAttrArr as $key => $value) {
                    $stor_valueArray1 = [];
                    foreach ($value as $k => $val) {

                        if (!in_array($val['attribute_id'], $stor_valueArray1)) {
                            $stor_valueArray1[] = $val['attribute_id'];
                            $newAttrArr1[$key][$val['display_name']][] = $val;
                        } else {
                            $newAttrArr1[$key][$val['display_name']][] = $val;
                        }
                    }
                }
            }

            $task = new Category;

            $current_date = date("Y-m-d");
            $getTopAdCond = array(
                "page_id" => 3,
                "banner_position" => "top",
                "status" => 1
            );
            $getRightAdCond = array(
                "page_id" => 3,
                "banner_position" => "right",
                "status" => 1
            );
            $getBottomAdCond = array(
                "page_id" => 3,
                "banner_position" => "bottom",
                "status" => 1
            );
            if (!empty($data['cat_id'])) {
                $getTopAdCond["subcategory_id"] = $getRightAdCond["subcategory_id"] = $getBottomAdCond["subcategory_id"] = $data['cat_id'];
            }
            $top_positions_ads = \DB::table('advertisements')
                            ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                            ->where($getTopAdCond)
                            ->orderBy('order_no', 'ASC')->get();
            $right_positions_ads = \DB::table('advertisements')
                            ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                            ->where($getRightAdCond)
                            ->orderBy('order_no', 'ASC')->get();
            $bottom_positions_ads = \DB::table('advertisements')
                            ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                            ->where($getBottomAdCond)
                            ->orderBy('order_no', 'ASC')->get();

            $default_top_position_ad = \DB::table('advertisements')->where("page_id", "=", 3)->where("banner_position", "=", "top")->where("is_default", "=", 1)->where("status", "=", 1)->first();
            $default_right_position_ad = \DB::table('advertisements')->where("page_id", "=", 3)->where("banner_position", "=", "right")->where("is_default", "=", 1)->where("status", "=", 1)->first();
            $default_bottom_position_ad = \DB::table('advertisements')->where("page_id", "=", 3)->where("banner_position", "=", "bottom")->where("is_default", "=", 1)->where("status", "=", 1)->first();
            $selectedCategories = null;

            $selectedCategories = explode(',', $selectedCategories);
            $allSubCategories = $task->getFrontCategories($selectedCategories);
            $allComCategories = $task->getFrontComCategories($selectedCategories);
            $allinformationCategories = $task->getFrontinformationCategories($selectedCategories);
            $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);
            $informationAreaCategories = $task->getInformationAreaCategories($selectedCategories);

            $state = $this->getstatewithcount();


            $allCategoriesWithClassifiedCount = $task->getCategoriesWithClassifiedCount($selectedCategories);
            $allinformationCategorieCount = $task->getinformationCategoriesWithClassifiedCount($selectedCategories);


            $wishlistItems = array();
            if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
                $wishlistObj = new Wishlist;
                $wishlistItems = $wishlistObj->where('user_id', '=', Auth::guard('web')->user()->id)->pluck("classified_id", "id")->all();
            } elseif (Cookie::get('wishlistItems')) {
                $wishlistItems = Cookie::get('wishlistItems');
            }

            $result->setPath('search_classifiedsdata');
            return view('front/search/search-list', compact('top_positions_ads', 'allCategoriesWithClassifiedCount', 'right_positions_ads', 'bottom_positions_ads', 'default_top_position_ad', 'default_right_position_ad', 'default_bottom_position_ad', 'allSubCategories', 'result', 'allSubCategoriesForMenu', 'data', 'staterestult', 'newAttrArr1', 'resultNewicon', 'newAttrArrForValue', 'wishlistItems', 'allComCategories', 'informationAreaCategories', 'allinformationCategories', 'data2', 'allinformationCategorieCount'));
        }
    }

    /**
     * classified_listpage
     * classified_listpage classifieds 
     *
     * @return void
     * @access public
     */
    public function classified_listpage(Request $request, $id = null) {

        $id = $request->id;
        $request_form_data = $request->toArray();
        $current_date = date('Y-m-d');
        $is_search_filter = false;
        if (!$id) {
            $isParent = false;
            $isChild = false;
        } else {
            $cat_obj = new Category;
            $request_category_data = $cat_obj->where(['id' => $id])->first();

            if ($request_category_data->pid == 0) {
                $isParent = true;
                $isChild = false;
            } else {
                $isParent = false;
                $isChild = true;
            }
        }

        if ($id) {
            $catids[] = $id;
            $similarClass = $this->model->getSimilarAds($catids, $isParent);
            $similarClass = collect($similarClass)->take(3)->toArray();
        }

        $conditions = array(
            array('classifieds.status', '=', 1),
            array('classifieds.is_premium', '=', 0),
            array('classifieds.featured_classified', '=', 0),
        );

        $cond_premium = array(
            array('classifieds.is_premium', '=', 1),
            array('classifieds.status', '=', 1),
        );

        $cond_featured = array(
            array('classifieds.featured_classified', '=', 1),
            array('classifieds.status', '=', 1),
        );

        if (isset($request_form_data['itemname']) && $request_form_data['itemname'] != '') {
            $request_form_dataname = trim($request_form_data['itemname']);
            $conditions[] = array('classifieds.title', 'LIKE', "%{$request_form_data['itemname']}%");
            $cond_premium[] = array('classifieds.title', 'LIKE', "%{$request_form_data['itemname']}%");
            $cond_featured[] = array('classifieds.title', 'LIKE', "%{$request_form_data['itemname']}%");
        }
        if (isset($request_form_data['state_id']) && $request_form_data['state_id'] != '') {
            $conditions[] = array('classifieds.state_id', '=', $request_form_data['state_id']);
            $cond_premium[] = array('classifieds.state_id', '=', $request_form_data['state_id']);
            $cond_featured[] = array('classifieds.state_id', '=', $request_form_data['state_id']);
        }
        $cond_for_top_banner = [];
        if ($isParent) {
            $all_child_cat_arr = $cat_obj->where(['pid' => $id])->pluck('id')->toArray();

            $conditions[] = array('classifieds.parent_categoryid', '=', $id);
            $cond_premium[] = array('classifieds.parent_categoryid', '=', $id);
            $cond_premium[] = array('classifieds.is_premium_parent_cat', '=', 1);
            $cond_featured[] = array('classifieds.parent_categoryid', '=', $id);

            $cond_for_top_banner[] = array('category_id', '=', $id);
            $cond_for_top_banner[] = array('subcategory_id', '=', 0);


            $getCatForTemplate = $id;
        } else if ($isChild) {
            $all_child_cat_arr[] = $id;

            $conditions[] = array('categories.id', '=', $id);
            $cond_premium[] = array('categories.id', '=', $id);
            $cond_premium[] = array('classifieds.is_premium_sub_cat', '=', 1);
            $cond_featured[] = array('categories.id', '=', $id);

            $cond_for_top_banner[] = array('subcategory_id', '=', $id);

            $getCatForTemplate = $request_category_data->pid;
        } else {
            $all_child_cat_arr = [];

            $getCatForTemplate = false;
        }
        //*********Get template information *****************
        $template_arr = DB::table('templates')
                ->leftJoin('category_template', 'templates.id', '=', 'category_template.template_id')
                ->where('category_template.category_id', '=', $getCatForTemplate)
                ->first();

        $advertiesment = new Advertisement;
        $top_positions_ads = $advertiesment->top_positions_ads($cond_for_top_banner)['top_positions_ads'];
//        dd($top_positions_ads);
        //*********Get Premium listings only*****************
        $cond_premium_result = $this->model
                ->selectRaw('categories.id,classifieds.id as classified_id ,classifieds.title as title,
                        classifieds.description as description,classifiedimage.name as name,classifieds.price, 
                        categories.name as catname,classifieds.location as location, 
                        classifieds.parent_categoryid as parentcatid, classifieds.created_at as classified_created')
                ->leftJoin('categories', function($join) use ($isParent) {
                    if ($isParent) {
                        $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                    } else {
                        $join->on('classifieds.category_id', '=', 'categories.id');
                    }
                })
                ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                ->where($cond_premium)
                ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                ->groupBy('classifieds.id')
                ->limit(5)
                ->inRandomOrder()
                ->get();
        //for premium slider - attribute value require onlu for real estate category      
        if ($template_arr && $template_arr->template_slug == 'realestate') {
            foreach ($cond_premium_result as $key => $value) {
                $multiattribute = $this->model->where('id', '=', $value->classified_id)->with(['classified_attribute' => function ($query) {
                                $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon', 'show_list')
                                        ->where('attributes.show_list', '=', 1);
                            }])->first()->toarray();
                $value->classified_attribute = $multiattribute['classified_attribute'];
            }


            $cond_premium_result = $cond_premium_result->toArray();
            $cond_premium_result = $this->model->modifyClassifiedAttrWithValues($cond_premium_result);
        }

        //*********Get featured listings only*****************
        $cond_featured_result = $this->model
                ->with(['classified_hasmany_other', 'classified_users'])
                ->selectRaw('categories.id,classifieds.id as classified_id ,classifieds.title as title,
                        p_categories.id p_cat_id,p_categories.id p_cat_name,
                        classifieds.description as description,classifiedimage.name as name,classifieds.price,
                        categories.name as catname,classifieds.location as location,classifieds.featured_classified,
                        classifieds.parent_categoryid as parentcatid, classifieds.created_at as classified_created')
                ->leftJoin('categories', function($join) use ($isParent) {
                    if ($isParent) {
                        $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                    } else {
                        $join->on('classifieds.category_id', '=', 'categories.id');
                    }
                })
                ->leftJoin('categories as p_categories', 'classifieds.parent_categoryid', '=', 'p_categories.id')
                ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                ->where($cond_featured)
                ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                ->groupBy('classifieds.id')
                ->inRandomOrder()
                ->get();
        foreach ($cond_featured_result as $key => $value) {
            $multiattribute = $this->model->where('id', '=', $value->classified_id)->with(['classified_attribute' => function ($query) {
                            $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon', 'show_list')
                                    ->where('attributes.show_list', '=', 1);
                        }])->first()->toarray();
            $value->classified_attribute = $multiattribute['classified_attribute'];
        }


        $cond_featured_result = $cond_featured_result->sortBy('classified_id')->toArray();
        $cond_featured_result = $this->model->modifyClassifiedAttrWithValues($cond_featured_result);
        $result = $this->model
                ->with(['classified_hasmany_other', 'classified_users'])
                ->selectRaw('categories.id,classifieds.id as classified_id ,classifieds.title as title,
                        p_categories.id p_cat_id,p_categories.id p_cat_name,
                        classifieds.description as description,classifiedimage.name as name,classifieds.price,
                        categories.name as catname,classifieds.location as location,classifieds.featured_classified,
                        classifieds.parent_categoryid as parentcatid, classifieds.created_at as classified_created')
                ->leftJoin('categories', function($join) use ($isParent) {
                    if ($isParent) {
                        $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                    } else {
                        $join->on('classifieds.category_id', '=', 'categories.id');
                    }
                })
                ->leftJoin('categories as p_categories', 'classifieds.parent_categoryid', '=', 'p_categories.id')
                ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                ->where($conditions)
                ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                ->groupBy('classifieds.id')
                ->paginate(50);

        foreach ($result as $key => $value) {
            $multiattribute = $this->model->where('id', '=', $value->classified_id)->with(['classified_attribute' => function ($query) {
                            $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon', 'show_list', 'display_name', 'searchable')
                            ;
                        }])->first()->toarray();

            $value->classified_attribute = $multiattribute['classified_attribute'];
        }

        $result_with_sort = $result->sortByDesc('featured_classified')->toArray();

        $result_with_sort = $this->model->modifyClassifiedAttrWithValues($result_with_sort);


        //get all category  with child and clasified -- for sidebar
        $task = new Category;
        $allCategoriesWithClassifiedCount = $task->getCategoriesWithClassifiedCount();


        //accordian structure data for parent cat listing 
        if ($isParent) {

            $accordian_collection_array = Category::where(["pid" => $id, "status" => 1])
                            ->with(['subCategory_classifieds' => function($q1) {
                                    $q1->with(['classified_image'])->where(['status' => 1]);
                                }])->get();
            foreach ($accordian_collection_array as $key => $value) {
                $aa[$key] = collect($value->toArray()['sub_category_classifieds'])->sortByDesc('featured_classified')->toArray();
                $value->classifieds_sort_by = $aa[$key];
            }
        }
        //dynamic attribute for filter sidebar
        if (!empty($all_child_cat_arr)) {
            $data1 = Category::whereIn("id", $all_child_cat_arr)
                            ->with(['attributes' => function ($query) {
                                    $query->where(['status' => 1, 'is_active' => 1])
                                    ->with(['attributeType', 'attribute_value']);
                                }])->first()->toArray();

            foreach ($data1['attributes'] as $k11 => $v11) {
                $dynamic_attr[$v11['id']]['attribute_id'] = $v11['id'];
                $dynamic_attr[$v11['id']]['searchable'] = $v11['searchable'];
                $dynamic_attr[$v11['id']]['p_attr_id'] = $v11['p_attr_id'];
                $dynamic_attr[$v11['id']]['p_attr_id'] = $v11['p_attr_id'];
                $dynamic_attr[$v11['id']]['attr_type_name'] = $v11['attribute_type']['slug'];
                $dynamic_attr[$v11['id']]['display_name'] = $v11['display_name'];
                $dynamic_attr[$v11['id']]['icon'] = $v11['icon'];
                $dynamic_attr[$v11['id']]['attribute_value'] = collect($v11['attribute_value'])->pluck('values', 'id')->toArray();
            }
        } else {
            //this will use when search with no cate id
            foreach ($result_with_sort as $key => $value) {
                foreach ($value['classified_attribute'] as $k => $v) {
                    if (!empty($v['attribute_id'])) {
                        $dynamic_attr[$v['attribute_id']] = $v;
                    }
                }
            }
        }

        $task = new Category;
        $informationAreaCategories = $task->getInformationAreaCategories();
        return view('front/search/template_layout_child_listing', compact('cond_premium_result', 'cond_featured_result', 'result_with_sort', 'request_category_data', 'allCategoriesWithClassifiedCount', 'accordian_collection_array', 'dynamic_attr', 'template_arr', 'isParent', 'isChild', 'is_search_filter', 'request_form_data', 'similarClass', 'informationAreaCategories', 'top_positions_ads'));
    }

    /**
     * get_search_classifieds_filter
     * get_search_classifieds_filter classifieds list from static filter
     *
     * @return void
     * @access public
     */
    public function get_search_classifieds_filter(Request $request) {

        $current_date = date('Y-m-d');
        $rooturl = \Request::root();
        $isParent = false;
        $is_search_filter = true;

        $request_data_arr = $request->toArray();
        $categoryid = $request->cat_id;

        if (!empty($categoryid)) {
            $cat_obj = new Category;
            $request_category_data = $cat_obj->where(['id' => $categoryid])->first();
            $isParent = $request_category_data->pid == 0 ? true : false;

            $catids[] = $categoryid;
            $similarClass = $this->model->getSimilarAds($catids, $isParent);
            $similarClass = collect($similarClass)->take(3)->toArray();
        }


        //*********Get template information *****************

        if ($isParent) {
            $getCatForTemplate = $categoryid;

            $cond_for_top_banner[] = array('category_id', '=', $categoryid);
        } else {
            $getCatForTemplate = $request_category_data->pid;

            $cond_for_top_banner[] = array('subcategory_id', '=', $categoryid);
        }

        $template_arr = DB::table('templates')
                ->leftJoin('category_template', 'templates.id', '=', 'category_template.template_id')
                ->where('category_template.category_id', '=', $getCatForTemplate)
                ->first();

        $conditions = [['classifieds.status', '=', 1]];
        $conditions_or = [0];
        $conditions_numeric_no_range = [];
        $conditions_numeric_range = [];

        $advertiesment = new Advertisement;
        $top_positions_ads = $advertiesment->top_positions_ads($cond_for_top_banner)['top_positions_ads'];

        if ($request->suburbs_id != '') {
            $conditions[] = array('classifieds.suburbs_id', '=', $request->suburbs_id);
        }

        if ($request->posted_within != '') {

            $day_range = explode('-', $request->posted_within);

            $datesecond = date('Y-m-d', strtotime("-$day_range[0] day", strtotime($current_date)));
            $datefirst = date('Y-m-d', strtotime("-$day_range[1] day", strtotime($current_date)));

            $conditions[] = array('classifieds.start_date', '>=', $datefirst);
            $conditions[] = array('classifieds.start_date', '<=', $datesecond);
        }

        $iscategory = false;
        if (!empty($categoryid)) {
            if ($isParent) {
                $conditions[] = array('classifieds.parent_categoryid', '=', $categoryid);
            } else {
                $conditions[] = array('categories.id', '=', $categoryid);
            }
        } else {
            $iscategory = true;
        }
        if (isset($request_data_arr['attr_dy_arr'])) {
            foreach ($request_data_arr['attr_dy_arr'] as $key => $value) {
                foreach ($value as $k1 => $v1) {

                    if ($k1 == 'Drop-Down' && !empty($v1)) {

                        $conditions_or[] = $v1;
                    } else if ($k1 == 'Radio-button' && !empty($v1)) {

                        $conditions_or[] = $v1;
                    } else if ($k1 == 'Multi-Select' && !empty($v1)) {

                        foreach ($v1 as $k2 => $v2) {
                            $conditions_or[] = $v2;
                        }
                    } else if ($k1 == 'calendar' && !empty($v1)) {

                        $conditions_calendar[$key] = $v1;
                    } else if ($k1 == 'Numeric_range' && !empty($v1)) {
//                        if ($v1[0] != '' || $v1[1] != '') {
                        $conditions_numeric_range[$key] = $v1;
//                        }
                    } else if ($k1 == 'Numeric_no_range' && !empty($v1)) {
                        if ($v1[0] != '' || $v1[1] != '') {
                            $conditions_numeric_no_range[$key] = $v1;
                        }
                    }
                }
            }
        }
        $result_with_sort = $this->model
                ->with(['classified_hasmany_other', 'classified_users'])
                ->selectRaw(
                        'group_concat(attribute_classified.attr_type_name SEPARATOR "#@#") as typename,
                                group_concat(attribute_classified.attr_value SEPARATOR "#@#") as attrvalue,
                                group_concat(attribute_classified.attribute_id SEPARATOR "#@#")as attributeid,
                                p_categories.id p_cat_id,p_categories.id p_cat_name, classifieds.is_premium,
                                classifieds.is_premium_parent_cat, classifieds.is_premium_sub_cat,
                                categories.id,classifieds.id as classifiedid,classifieds.id as classified_id,classifieds.title as title,classifieds.description as description,
                                classifieds.featured_classified, classifieds.created_at as classified_created,
                         classifiedimage.name as name,classifieds.price,categories.name as catname,classifieds.location as location,
                         categories.belong_to_community as btc,categories.show_on_info_area as sia,
                        concat("' . $rooturl . '/upload_images/classified/",classifieds.id,"/",classifiedimage.name) imageurl,classifieds.city_id,UNIX_TIMESTAMP(classifieds.created_at)as createdtime')
                ->leftJoin('categories', function($join) use ($isParent, $iscategory) {
                    if ($isParent) {
                        $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                    } elseif ($iscategory) {
                        $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                        $join->orOn('classifieds.category_id', '=', 'categories.id');
                    } else {
                        $join->on('classifieds.category_id', '=', 'categories.id');
                    }
                })
                ->leftJoin('categories as p_categories', 'classifieds.parent_categoryid', '=', 'p_categories.id')
                ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                ->where($conditions)
                ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date")
                ->groupBy('classifieds.id')
        ;

        if ($request->order_by != '') {
            if ($request->order_by == 'title_asc') {

                $result_with_sort = $result_with_sort->orderBy('classifieds.title', 'ASC');
            } else if ($request->order_by == 'title_desc') {

                $result_with_sort = $result_with_sort->orderBy('classifieds.title', 'DESC');
            } else if ($request->order_by == 'price_htl') {

                $result_with_sort = $result_with_sort->orderBy('classifieds.price', 'DESC');
            } else if ($request->order_by == 'price_lth') {

                $result_with_sort = $result_with_sort->orderBy('classifieds.price', 'ASC');
            } else if ($request->order_by == 'most_recent') {

                $result_with_sort = $result_with_sort->orderBy('classifieds.id', 'DESC');
            }
        } else {
            $result_with_sort = $result_with_sort->orderBy('classifieds.id', 'DESC');
        }

        $result_with_sort = $result_with_sort->get()->toArray();
        foreach ($result_with_sort as $key => $value) {
            $multiattribute = $this->model->where('id', '=', $value['classified_id'])->with(['classified_attribute' => function ($query) {
                            $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon', 'show_list', 'display_name', 'searchable')
                            ;
                        }])->first()->toarray();
            $result_with_sort[$key]['classified_attribute'] = $multiattribute['classified_attribute'];
        }

        $result_with_sort = $this->model->modifyClassifiedAttrWithValues($result_with_sort);


        //make all attr unique value in saparete array with key  -- 'attrvalue_filter'
        foreach ($result_with_sort as $key => $values) {

            $typename = explode('#@#', $values['typename']);
            $attrvalue = explode('#@#', $values['attrvalue']);
            $attributeid = explode('#@#', $values['attributeid']);
            if (isset($typename)) {
                foreach ($typename as $k => $v) {
                    if (in_array($v, ['Drop-Down', 'Multi-Select', 'Radio-button'])) {
                        $result_with_sort[$key]['attrvalue_filter'][$attributeid[$k]] = $attrvalue[$k];
                    } else if ((in_array($v, ['calendar'])) && (strpos($attrvalue[$k], ';'))) {

                        $rang_cal = explode(';', $attrvalue[$k]);

                        $cal_saved_range = [];
                        for ($i = (int) $rang_cal[0]; (int) $i <= (int) $rang_cal[1]; $i = $i + 1) {
                            $cal_saved_range[] = $i;
                        }
                        $result_with_sort[$key]['attrvalue_filter_cal'][$attributeid[$k]] = $cal_saved_range;
//                    
                    } else if (in_array($v, ['Numeric'])) {

                        if (strpos($attrvalue[$k], ';')) {
                            $rang_num = explode(';', $attrvalue[$k]);
                            $result_with_sort[$key]['attrvalue_filter_num_range'][$attributeid[$k]][] = $rang_num[0];
                            $result_with_sort[$key]['attrvalue_filter_num_range'][$attributeid[$k]][] = $rang_num[1];
                        } else {
                            $result_with_sort[$key]['attrvalue_filter_num_no_range'][$attributeid[$k]] = $attrvalue[$k];
                        }
                    }
                }
            }
        }
        //now check all attr value condition (get by filter ) in attrvalue_filter array
        foreach ($result_with_sort as $key => $values) {
            if (!isset($values['attrvalue_filter'])) {
                $values['attrvalue_filter'] = [];
            }
            if (!isset($conditions_calendar)) {
                $conditions_calendar = [];
            }

            unset($conditions_or[0]);
            $containsAllValues = !array_diff($conditions_or, $values['attrvalue_filter']);
            if (!$containsAllValues) {
                unset($result_with_sort[$key]);
            } else {

                foreach ($conditions_calendar as $k2 => $v2) {
                    //if classified will not assign particular attribute than key value(attrvalue_filter_cal) will be empty
                    if (!isset($values['attrvalue_filter_cal'][$k2]) || empty($values['attrvalue_filter_cal'][$k2])) {

                        unset($result_with_sort[$key]);
                        continue;
                    } else if (!in_array($v2, $values['attrvalue_filter_cal'][$k2])) {

                        unset($result_with_sort[$key]);
                        continue;
                    }
                }

                foreach ($conditions_numeric_no_range as $k3 => $v4) {
                    //if classified will not assign particular attribute than key value(attrvalue_filter_cal) will be empty
                    if (!isset($values['attrvalue_filter_num_no_range'][$k3]) || empty($values['attrvalue_filter_num_no_range'][$k3])) {

                        unset($result_with_sort[$key]);
                        continue;
                    } else {

                        if (($v4[0] != '') && !($v4[0] <= $values['attrvalue_filter_num_no_range'][$k3])) {
                            unset($result_with_sort[$key]);
                            continue;
                        }

                        if (($v4[1] != '') && !($v4[1] >= $values['attrvalue_filter_num_no_range'][$k3])) {
                            unset($result_with_sort[$key]);
                            continue;
                        }
                    }
                }

                foreach ($conditions_numeric_range as $k3 => $v4) {

                    //if classified will not assign particular attribute than key value(attrvalue_filter_cal) will be empty
                    if (!isset($values['attrvalue_filter_num_range'][$k3]) || empty($values['attrvalue_filter_num_range'][$k3])) {

                        unset($result_with_sort[$key]);
                        continue;
                    } else {
                        if (!($values['attrvalue_filter_num_range'][$k3][0] <= $v4) || !($v4 <= $values['attrvalue_filter_num_range'][$k3][1])) {
                            unset($result_with_sort[$key]);
                            continue;
                        }
                    }
                }
            }
        }
        $cond_premium_result = collect($result_with_sort)->where('is_premium', 1)->toArray();
        shuffle($cond_premium_result);

        $cond_featured_result = collect($result_with_sort)->where('featured_classified', 1)->toArray();
        shuffle($cond_featured_result);

        foreach ($result_with_sort as $key => $value) {
            if ($value['is_premium'] == 1 || $value['featured_classified'] == 1) {
                unset($result_with_sort[$key]);
            }
        }
        if (isset($template_arr) && !empty($template_arr)) {

            $template_slug = $template_arr->default_child_listing_slug;
        } else {
            $template_slug = 'default_child_listing_all';
        }
        return view('front/search/' . $template_slug, compact('result_with_sort', 'request_category_data', 'isParent', 'template_arr', 'cond_premium_result', 'cond_featured_result', 'request_data_arr', 'is_search_filter', 'similarClass', 'top_positions_ads'));
    }

    /**
     * get_banner_on_cat_change
     * get_banner_on_cat_change get banners 
     *
     * @return void
     * @access public
     */
    public function get_banner_on_cat_change(Request $request) {

        $data = Input::all();
        $current_date = date('Y-m-d');
        
        $cat_obj = new Category;
        $request_category_data = $cat_obj->where(['id' => $data['cat_id']])->first();
        $isParent = $request_category_data->pid == 0 ? true : false;

        if ($isParent) {

            $cond_for_top_banner[] = array('category_id', '=', $data['cat_id']);
            $cond_for_top_banner[] = array('subcategory_id', '=', 0);
        } else {

            $cond_for_top_banner[] = array('subcategory_id', '=', $data['cat_id']);
        }

        $advertiesment = new Advertisement;
        $top_positions_ads = $advertiesment->top_positions_ads($cond_for_top_banner)['top_positions_ads'];
                        
        return response()->json(['top_positions_ads' => $top_positions_ads]);
//        print_r($top_positions_ads);
//        die;
    }

    /**
     * get_search_classifieds_filter_dynamic_attributes
     * get_search_classifieds_filter_dynamic_attributes classifieds list from attributes
     *
     * @return void
     * @access public
     */
    public function get_search_classifieds_filter_dynamic_attributes(Request $request) {


        $id = $request->cat_id;
        $current_date = date('Y-m-d');

        $cat_obj = new Category;
        $request_category_data = $cat_obj->where(['id' => $id])->first();

        $isParent = $request_category_data->pid == 0 ? true : false;

        if ($isParent) {
            $all_child_cat_arr = $cat_obj->where(['pid' => $id])->pluck('id')->toArray();
        } else {
            $all_child_cat_arr[] = $id;
        }


        //dynamic attribute for filter sidebar
        $data1 = Category::whereIn("id", $all_child_cat_arr)
                        ->with(['attributes' => function ($query) {
                                $query->where(['status' => 1, 'is_active' => 1])
                                ->with(['attributeType', 'attribute_value']);
                            }])->first()->toArray();

        foreach ($data1['attributes'] as $k11 => $v11) {
            $dynamic_attr[$v11['id']]['attribute_id'] = $v11['id'];
            $dynamic_attr[$v11['id']]['searchable'] = $v11['searchable'];
            $dynamic_attr[$v11['id']]['p_attr_id'] = $v11['p_attr_id'];
            $dynamic_attr[$v11['id']]['p_attr_id'] = $v11['p_attr_id'];
            $dynamic_attr[$v11['id']]['attr_type_name'] = $v11['attribute_type']['slug'];
            $dynamic_attr[$v11['id']]['display_name'] = $v11['display_name'];
            $dynamic_attr[$v11['id']]['icon'] = $v11['icon'];
            $dynamic_attr[$v11['id']]['attribute_value'] = collect($v11['attribute_value'])->pluck('values', 'id')->toArray();
        }
        return view('front/search/left_sidebar_dynamic_attributes', compact('dynamic_attr'));
    }

    /**
     * classified_listpageapi
     * classified_listpageapi classifieds 
     *
     * @return response
     * @access public
     */
    public function classified_listpageapi(Request $request) {
        $rooturl = \Request::root();
        $current_date = date('Y-m-d');
        $id = $request->id;
        $user_id = $request->user_id;
        if (!empty($id)) {
            $data['cat_id'] = $id;
//function to check the selected category is parent or not
            $task = new Category;
            $BelongsToCommunities = $task->pluck('pid', 'id')->toArray();
            $isParent = null;

            $conditions = array(
                array('classifieds.status', '=', 1),
            );

            if (!empty($id)) {
                $isParent = $BelongsToCommunities[$id] == 0 ? true : false;
                if ($isParent) {
                    $conditions[] = array('classifieds.parent_categoryid', '=', $id);
                } else {
                    $conditions[] = array('categories.id', '=', $id);
                }
            }
            if (!empty($data['order'])) {
                $order = $data['order'];
            } else {
                $order = 'asc';
            }
            $km = 500;
            $lat = 0;
            $long = 0;

            if ($lat == '0' and $long == '0') {

                $cur_date = date('Y-m-d');

                $data = $this->model
                        ->selectRaw('categories.id,classifieds.id as classifiedid ,classifieds.title as title,'
                                . 'classifieds.description as description,classifiedimage.name as name,classifieds.city_id,City as cityname,classifieds.price,UNIX_TIMESTAMP(classifieds.created_at)as createdtime,'
                                . 'categories.name as catname, if(classifieds.lat="","0.0",classifieds.lat) as lat,if(classifieds.lng="","0.0",classifieds.lng) as lng,classifieds.location as location,concat("' . $rooturl . '/upload_images/classified/",classifieds.id,"/",classifiedimage.name) imageurl')
                        ->leftJoin('cities', 'classifieds.city_id', '=', 'cities.CityId')
                        ->leftJoin('categories', function($join) use ($isParent) {
                            if ($isParent) {
                                $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                            } else {
                                $join->on('classifieds.category_id', '=', 'categories.id');
                            }
                        })
                        ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                        ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                        ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                        ->where($conditions)->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ")
                        ->groupBy('classifieds.id')
                        ->orderBy('classifieds.title', $order)
                        ->get();
            }

            $wishlistItems = array();
            if ($user_id != 0) {
                $wishlistObj = new Wishlist;
                $wishlistItems = $wishlistObj->where('user_id', '=', $user_id)->select('classified_id')->get()->toarray();
            }
            foreach ($wishlistItems as $key1 => $value1) {
                $listarray[] = $value1['classified_id'];
            }

            foreach ($data as $key => $value) {

                if (!empty($listarray)) {
                    if (in_array($value['classifiedid'], $listarray)) {
                        $data[$key]['wishlist'] = 1;
                    } else {
                        $data[$key]['wishlist'] = 0;
                    }
                } else {
                    $data[$key]['wishlist'] = 0;
                }
                if (!empty($value['cityname'])) {
                    $value['location'] = $value['cityname'];
                } else {
                    $value['location'] = 'N/A';
                }
            }
            if (count($data) > 0) {

                $result['status'] = 1;
                $result['data'] = $data;
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['data'] = array();
                $result['msg'] = 'no record found';
                echo json_encode($result);
                die;
            }
        }
    }

    /**
     * classified_listinformationpageapi
     * classified_listinformationpageapi classifieds 
     *
     * @return response
     * @access public
     */
    public function classified_listinformationpageapi(Request $request) {

        $rooturl = \Request::root();
        $current_date = date('Y-m-d');
        $id = $request->id;
        $user_id = $request->user_id;
        $lat = $request->lat;
        $long = $request->lng;
        if (!empty($id)) {
            $data['cat_id'] = $id;
//function to check the selected category is parent or not
            $task = new Category;
            $BelongsToCommunities = $task->pluck('pid', 'id')->toArray();
            $isParent = null;

            $conditions = array(
                array('classifieds.status', '=', 1),
            );

            if (!empty($id)) {
                $isParent = $BelongsToCommunities[$id] == 0 ? true : false;
                if ($isParent) {
                    $conditions[] = array('classifieds.parent_categoryid', '=', $id);
                } else {
                    $conditions[] = array('categories.id', '=', $id);
                }
            }
            if (!empty($data['order'])) {
                $order = $data['order'];
            } else {
                $order = 'asc';
            }
            $km = 10;

            if (!empty($lat) and ! empty($long)) {

                $cur_date = date('Y-m-d');
                $data = $this->model
                        ->select(DB::raw("(SQRT(POW(69.1 * (lat - $lat), 2) +
                                POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) AS distance, "
                                        . "categories.id,classifieds.id as classifiedid ,classifieds.title as title,"
                                        . "classifieds.description as description,classifiedimage.name as name,classifieds.city_id,City as cityname,classifieds.price,UNIX_TIMESTAMP(classifieds.created_at)as createdtime,"
                                        . "concat('$rooturl/upload_images/classified/',classifieds.id,'/',classifiedimage.name) imageurl,"
                                        . "categories.name as catname, if(classifieds.lat='','0.0',classifieds.lat) as lat,if(classifieds.lng='','0.0',classifieds.lng) as lng,classifieds.location as location"))
                        ->leftJoin('cities', 'classifieds.city_id', '=', 'cities.CityId')
                        ->leftJoin('categories', function($join) use ($isParent) {
                            if ($isParent) {
                                $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                            } else {
                                $join->on('classifieds.category_id', '=', 'categories.id');
                            }
                        })
                        ->whereRaw("(SQRT(POW(69.1 * (lat - $lat), 2) +
                                POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) < $km")
                        ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                        ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                        ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                        ->where($conditions)->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ")
                        ->groupBy('classifieds.id')
                        ->orderBy('classifieds.title', $order)
                        ->get();
                $data1 = $this->model
                        ->selectRaw('categories.id,classifieds.id as classifiedid ,classifieds.title as title,'
                                . 'classifieds.description as description,classifiedimage.name as name,classifieds.city_id,City as cityname,classifieds.price,UNIX_TIMESTAMP(classifieds.created_at)as createdtime,'
                                . 'categories.name as catname, if(classifieds.lat="","0.0",classifieds.lat) as lat,if(classifieds.lng="","0.0",classifieds.lng) as lng,classifieds.location as location,concat("' . $rooturl . '/upload_images/classified/",classifieds.id,"/",classifiedimage.name) imageurl')
                        ->leftJoin('cities', 'classifieds.city_id', '=', 'cities.CityId')
                        ->leftJoin('categories', function($join) use ($isParent) {
                            if ($isParent) {
                                $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                            } else {
                                $join->on('classifieds.category_id', '=', 'categories.id');
                            }
                        })
                        ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                        ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                        ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                        ->where($conditions)->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ")
                        ->Where('classifieds.lat', '=', '')
                        ->Where('classifieds.lng', '=', '')
                        ->groupBy('classifieds.id')
                        ->orderBy('classifieds.title', $order)
                        ->get();

                $wishlistItems = array();
                if ($user_id != 0) {
                    $wishlistObj = new Wishlist;
                    $wishlistItems = $wishlistObj->where('user_id', '=', $user_id)->select('classified_id')->get()->toarray();
                }
                foreach ($wishlistItems as $key1 => $value1) {
                    $listarray[] = $value1['classified_id'];
                }
                $classifiedtitle = array();
                foreach ($data as $key => $value) {

                    if (!empty($listarray)) {
                        if (in_array($value['classifiedid'], $listarray)) {
                            $data[$key]['wishlist'] = 1;
                        } else {
                            $data[$key]['wishlist'] = 0;
                        }
                    } else {
                        $data[$key]['wishlist'] = 0;
                    }
                    if (!empty($value['cityname'])) {
                        $value['location'] = $value['cityname'];
                    } else {
                        $value['location'] = 'N/A';
                        unset($value['cityname']);
                    }
                    $classifiedtitle[] = array(
                        'lat' => $value['lat'],
                        'lng' => $value['lng'],
                        'title' => $value['title'],
                        'type' => $value['catname'],
                    );
                }
                foreach ($data1 as $key => $value) {

                    if (!empty($listarray)) {
                        if (in_array($value['classifiedid'], $listarray)) {
                            $data1[$key]['wishlist'] = 1;
                        } else {
                            $data1[$key]['wishlist'] = 0;
                        }
                    } else {
                        $data1[$key]['wishlist'] = 0;
                    }
                    if (!empty($value['cityname'])) {
                        $value['location'] = $value['cityname'];
                    } else {
                        $value['location'] = 'N/A';
                        unset($value['cityname']);
                    }
                    $classifiedtitle1[] = array(
                        'lat' => $value['lat'],
                        'lng' => $value['lng'],
                        'title' => $value['title'],
                        'type' => $value['catname'],
                    );
                }
                if (!empty($data) || (!empty($data1))) {
                    $dataarray = $data->toarray();
                    $data1array = $data1->toarray();
                }
                if (!empty($data1array)) {

                    $combineboth = array_merge($dataarray, $data1array);
                } else {

                    $combineboth = $dataarray;
                }
                if (!empty($classifiedtitle1)) {

                    $classifiedtitle_combine = array_merge($classifiedtitle, $classifiedtitle1);
                } else {

                    $classifiedtitle_combine = $classifiedtitle;
                }
                $result['status'] = 1;
                $result['msg'] = 'record found';
                $result['data'] = $combineboth;
                $result['classifiedtitle'] = $classifiedtitle_combine;
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['data'] = array();
                $result['msg'] = 'Please enter correct location';
                echo json_encode($result);
                die;
            }
        } else {
            $result['status'] = 0;
            $result['msg'] = 'Invalid detail';
            $result['data'] = array();

            echo json_encode($result);
            die;
        }
    }

    /**
     * classified_list_allinformationpageapi
     * classified_list_allinformationpageapi classifieds 
     *
     * @return response
     * @access public
     */
    public function classified_list_allinformationpageapi(Request $request) {

        $rooturl = \Request::root();
        $current_date = date('Y-m-d');
        $id = $request->id;
        $user_id = $request->user_id;
        $lat = $request->lat;
        $long = $request->lng;
        $lat = (int) $lat;
        $long = (int) $long;
        $categoryname = Redis::get('Halal Products');

        $data['cat_id'] = $id;
//function to check the selected category is parent or not
        $task = new Category;
        $BelongsToCommunities = $task->pluck('pid', 'id')->toArray();
        $isParent = true;


        if (!empty($data['order'])) {
            $order = $data['order'];
        } else {
            $order = 'asc';
        }
        $km = 10;


        if (!empty($lat) and ! empty($long)) {

            $cur_date = date('Y-m-d');

            $data = DB::select("select (SQRT(POW(69.1 * (lat - $lat), 2) + POW(69.1 * ($long - lng) * 
                        COS(lat / 57.3), 2))) AS distance, categories.id,classifieds.id as classifiedid ,
                        classifieds.title as title,classifieds.description as description,classifiedimage.name as name,
                        classifieds.city_id,City as cityname,classifieds.price,UNIX_TIMESTAMP(classifieds.created_at)as 
                        createdtime,concat('$rooturl/upload_images/classified/',classifieds.id,'/',classifiedimage.name) imageurl,
                        categories.name as catname, if(classifieds.lat='','0.0',classifieds.lat) as lat,if(classifieds.lng='','0.0',
                        classifieds.lng) 
                        as lng,classifieds.location as location from `classifieds` 
                        left join `cities` on `classifieds`.`city_id` = `cities`.`CityId` 
                        left join `categories` on `classifieds`.`parent_categoryid` = `categories`.`id` 
                        left join `classifiedimage` on `classifieds`.`id` = `classifiedimage`.`classified_id` 
                        left join `attribute_classified` on `classifieds`.`id` = `attribute_classified`.`classified_id` 
                        left join `attributes` on `attribute_classified`.`attribute_id` = `attributes`.`id`
                       where ((SQRT(POW(69.1 * (lat - $lat), 2) +POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) 
                       < $km or  `classifieds`.`lat` = '')  
                       and (`classifieds`.`status` = 1 and categories.belong_to_community =1 or categories.show_on_info_area =1) and categories.name !='$categoryname' and '$cur_date' Between classifieds.start_date and classifieds.end_date  group by `classifieds`.`id` order by distance asc ");
            $wishlistItems = array();
            if ($user_id != 0) {
                $wishlistObj = new Wishlist;
                $wishlistItems = $wishlistObj->where('user_id', '=', $user_id)->select('classified_id')->get()->toarray();
            }
            foreach ($wishlistItems as $key1 => $value1) {
                $listarray[] = $value1['classified_id'];
            }

            foreach ($data as $key => $value) {

                if (!empty($listarray)) {
                    if (in_array($value->classifiedid, $listarray)) {
                        $value->wishlist = 1;
                    } else {
                        $value->wishlist = 0;
                    }
                } else {
                    $value->wishlist = 0;
                }
                if (!empty($value->cityname)) {
                    $value->location = $value->cityname;
                } else {
                    $value->location = 'N/A';
                    unset($value->cityname);
                }
                $classifiedtitle[] = array(
                    'lat' => $value->lat,
                    'lng' => $value->lng,
                    'title' => $value->title,
                    'type' => $value->catname,
                );
            }

            if (!empty($data)) {

                $result['status'] = 1;
                $result['msg'] = 'record found';
                $result['data'] = $data;
                $result['classifiedtitle'] = $classifiedtitle;
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['data'] = array();
                $result['msg'] = 'no record found';
                echo json_encode($result);
                die;
            }
        } else {

            $cur_date = date('Y-m-d');
            $data = DB::select(" select categories.id,classifieds.id as classifiedid,
                        classifieds.title as title,classifieds.description as description,classifiedimage.name as name,
                        classifieds.city_id,City as cityname,classifieds.price,UNIX_TIMESTAMP(classifieds.created_at)as 
                        createdtime,concat('$rooturl/upload_images/classified/',classifieds.id,'/',classifiedimage.name) imageurl,
                        categories.name as catname, if(classifieds.lat='','0.0',classifieds.lat) as lat,if(classifieds.lng='','0.0',
                        classifieds.lng) 
                        as lng,classifieds.location as location from `classifieds` 
                        left join `cities` on `classifieds`.`city_id` = `cities`.`CityId` 
                        left join `categories` on `classifieds`.`parent_categoryid` = `categories`.`id` 
                        left join `classifiedimage` on `classifieds`.`id` = `classifiedimage`.`classified_id` 
                        left join `attribute_classified` on `classifieds`.`id` = `attribute_classified`.`classified_id` 
                        left join `attributes` on `attribute_classified`.`attribute_id` = `attributes`.`id`
                       where (`classifieds`.`status` = 1 and categories.show_on_info_area =1 ) and categories.name != '$categoryname' 
                       and '$cur_date' Between classifieds.start_date and classifieds.end_date group by `classifieds`.`id` order by classifieds.title asc ");
            $wishlistItems = array();
            if ($user_id != 0) {
                $wishlistObj = new Wishlist;
                $wishlistItems = $wishlistObj->where('user_id', '=', $user_id)->select('classified_id')->get()->toarray();
            }
            foreach ($wishlistItems as $key1 => $value1) {
                $listarray[] = $value1['classified_id'];
            }

            foreach ($data as $key => $value) {

                if (!empty($listarray)) {
                    if (in_array($value->classifiedid, $listarray)) {
                        $value->wishlist = 1;
                    } else {
                        $value->wishlist = 0;
                    }
                } else {
                    $value->wishlist = 0;
                }
                if (!empty($value->cityname)) {
                    $value->location = $value->cityname;
                } else {
                    $value->location = 'N/A';
                    unset($value->cityname);
                }
                $classifiedtitle[] = array(
                    'lat' => 0.00,
                    'lng' => 0.00,
                    'title' => $value->title,
                    'type' => $value->catname,
                );
            }
            if (!empty($data)) {

                $result['status'] = 1;
                $result['msg'] = 'record found';
                $result['data'] = $data;
                $result['classifiedtitle'] = $classifiedtitle;
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['data'] = array();
                $result['msg'] = 'no record found';
                echo json_encode($result);
                die;
            }
        }
    }

    /**
     * halalproduct_listapi
     * halalproduct_listapi classifieds 
     *
     * @return response
     * @access public
     */
    public function halalproduct_listapi(Request $request) {
        $rooturl = \Request::root();
        $current_date = date('Y-m-d');
        $categoryname = Redis::get('Halal Products');
        $id = $request->id;
        $user_id = $request->user_id;
        $lat = $request->lat;
        $long = $request->lng;

        $data['cat_id'] = $id;
//function to check the selected category is parent or not
        $task = new Category;
        $BelongsToCommunities = $task->pluck('pid', 'id')->toArray();
        $isParent = true;

        if (!empty($data['order'])) {
            $order = $data['order'];
        } else {
            $order = 'asc';
        }
        $km = 10;

        if (empty($lat)and empty($long)) {
            $cur_date = date('Y-m-d');

            $data = DB::select(" select categories.id,classifieds.id as classifiedid,
                        classifieds.title as title,classifieds.description as description,classifiedimage.name as name,
                        classifieds.city_id,City as cityname,classifieds.price,UNIX_TIMESTAMP(classifieds.created_at)as 
                        createdtime,concat('$rooturl/upload_images/classified/',classifieds.id,'/',classifiedimage.name) imageurl,
                        categories.name as catname, if(classifieds.lat='','0.0',classifieds.lat) as lat,if(classifieds.lng='','0.0',
                        classifieds.lng) 
                        as lng,classifieds.location as location from `classifieds` 
                        left join `cities` on `classifieds`.`city_id` = `cities`.`CityId` 
                        left join `categories` on `classifieds`.`parent_categoryid` = `categories`.`id` 
                        left join `classifiedimage` on `classifieds`.`id` = `classifiedimage`.`classified_id` 
                        left join `attribute_classified` on `classifieds`.`id` = `attribute_classified`.`classified_id` 
                        left join `attributes` on `attribute_classified`.`attribute_id` = `attributes`.`id`
                       where (`classifieds`.`status` = 1 and  categories.show_on_info_area =1) and categories.name = '$categoryname' 
                       group by `classifieds`.`id` order by classifieds.title asc ");


            $wishlistItems = array();
            if ($user_id != 0) {
                $wishlistObj = new Wishlist;
                $wishlistItems = $wishlistObj->where('user_id', '=', $user_id)->select('classified_id')->get()->toarray();
            }
            foreach ($wishlistItems as $key1 => $value1) {
                $listarray[] = $value1['classified_id'];
            }

            foreach ($data as $key => $value) {

                if (!empty($listarray)) {
                    if (in_array($value->classifiedid, $listarray)) {
                        $value->wishlist = 1;
                    } else {
                        $value->wishlist = 0;
                    }
                } else {
                    $value->wishlist = 0;
                }
                if (!empty($value->cityname)) {
                    $value->location = $value->cityname;
                } else {
                    $value->location = 'N/A';
                    unset($value->cityname);
                }
            }
        } else {
            $data = DB::select("select (SQRT(POW(69.1 * (lat - $lat), 2) + POW(69.1 * ($long - lng) * 
                        COS(lat / 57.3), 2))) AS distance, categories.id,classifieds.id as classifiedid ,
                        classifieds.title as title,classifieds.description as description,classifiedimage.name as name,
                        classifieds.city_id,City as cityname,classifieds.price,UNIX_TIMESTAMP(classifieds.created_at)as 
                        createdtime,concat('$rooturl/upload_images/classified/',classifieds.id,'/',classifiedimage.name) imageurl,
                        categories.name as catname, if(classifieds.lat='','0.0',classifieds.lat) as lat,if(classifieds.lng='','0.0',
                        classifieds.lng) 
                        as lng,classifieds.location as location from `classifieds` 
                        left join `cities` on `classifieds`.`city_id` = `cities`.`CityId` 
                        left join `categories` on `classifieds`.`parent_categoryid` = `categories`.`id` 
                        left join `classifiedimage` on `classifieds`.`id` = `classifiedimage`.`classified_id` 
                        left join `attribute_classified` on `classifieds`.`id` = `attribute_classified`.`classified_id` 
                        left join `attributes` on `attribute_classified`.`attribute_id` = `attributes`.`id`
                       where ((SQRT(POW(69.1 * (lat - $lat), 2) +POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) 
                       < $km or  `classifieds`.`lat` = '')  
                       and (`classifieds`.`status` = 1 and categories.show_on_info_area =1) and categories.name = '$categoryname'
                       group by `classifieds`.`id` order by distance asc ");
            $wishlistItems = array();
            if ($user_id != 0) {
                $wishlistObj = new Wishlist;
                $wishlistItems = $wishlistObj->where('user_id', '=', $user_id)->select('classified_id')->get()->toarray();
            }
            foreach ($wishlistItems as $key1 => $value1) {
                $listarray[] = $value1['classified_id'];
            }

            foreach ($data as $key => $value) {

                if (!empty($listarray)) {
                    if (in_array($value->classifiedid, $listarray)) {
                        $value->wishlist = 1;
                    } else {
                        $value->wishlist = 0;
                    }
                } else {
                    $value->wishlist = 0;
                }
                if (!empty($value->cityname)) {
                    $value->location = $value->cityname;
                } else {
                    $value->location = 'N/A';
                    unset($value->cityname);
                }
            }
        }


        if (count($data) > 0) {

            $result['status'] = 1;
            $result['data'] = $data;
            echo json_encode($result);
            die;
        } else {
            $result['status'] = 0;
            $result['data'] = array();
            $result['msg'] = 'no record found';
            echo json_encode($result);
            die;
        }
    }

    /**
     * halalproduct_categoryname
     * halalproduct_categoryname classifieds 
     *
     * @return response
     * @access public
     */
    public function halalproduct_categoryname(Request $request) {
        $name = Redis::get('Halal Products');
        if (!empty($name)) {
            $result['status'] = 1;
            $result['data'] = $name;
            echo json_encode($result);
            die;
        } else {
            $result['status'] = 0;
            $result['msg'] = 'No Data Found';
            echo json_encode($result);
            die;
        }
    }

    /**
     * halalproduct_scanapi
     * halalproduct_scanapi classifieds 
     *
     * @return response
     * @access public
     */
    public function halalproduct_scanapi(Request $request) {
        $product_code = $request->product_code;
        $rooturl = \Request::root();
        $isParent = true;
        if (!empty($product_code)) {
            $data = $this->model
                    ->selectRaw('categories.id,classifieds.id as classifiedid ,classifieds.title as title,'
                            . 'classifieds.description as description,classifiedimage.name as name,classifieds.city_id,City as cityname,classifieds.price,UNIX_TIMESTAMP(classifieds.created_at)as createdtime,'
                            . 'categories.name as catname, if(classifieds.lat="","0.0",classifieds.lat) as lat,if(classifieds.lng="","0.0",classifieds.lng) as lng,classifieds.location as location,concat("' . $rooturl . '/upload_images/classified/",classifieds.id,"/",classifiedimage.name) imageurl')
                    ->leftJoin('cities', 'classifieds.city_id', '=', 'cities.CityId')
                    ->leftJoin('categories', function($join) use ($isParent) {
                        if ($isParent) {
                            $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                        } else {
                            $join->on('classifieds.category_id', '=', 'categories.id');
                        }
                    })
                    ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                    ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                    ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                    ->Where('classifieds.product_code', '=', $product_code)
                    ->first();
            if (count($data) > 0) {

                $result['status'] = 1;
                $result['result'] = $data;
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'no user existing record found';
                echo json_encode($result);
                die;
            }
        }
    }

    /**
     * getstatewithcount
     * getstatewithcount classifieds 
     *
     * @return response
     * @access public
     */
    public function getstatewithcount() {

        $state = DB::table('classifieds')
                ->selectRaw('classifieds.id,state.name, state.id,count(state.id) as count')
                ->leftJoin('state', 'classifieds.state_id', '=', 'state.id')
                ->Where('state.country_id', '=', 14)
                ->Where('classifieds.status', '=', 1)
                ->groupby('state.id')
                ->get();
        return $state;
        die();
    }

    /**
     * get_searchresultdata
     * get_searchresultdata classifieds 
     *
     * @return response
     * @access public
     */
    public function get_searchresultdata(Request $request) {



        $statemodel = new State;
        $current_date = date('Y-m-d');
        if ($request->isMethod('get')) {

            $data = Input::all();

            if (!empty($data)) {
//function to check the selected category is parent or not
                $task = new Category;
                $all_categories_obj = $task->pluck('pid', 'id')->toArray();
                $isParent = null;
                $iscategory = null;

                $conditions = array(
                    array('classifieds.status', '=', 1),
                );
                $conditions[] = array('categories.belong_to_community', '!=', 1);
                $conditions[] = array('categories.show_on_info_area', '==', 0);

                if (!empty($data['cat_id'])) {
                    $isParent = $all_categories_obj[$data['cat_id']] == 0 ? true : false;
                    $staterestult = $statemodel->getCategoriesWithClassifiedCount($data['cat_id']);
                    if ($isParent) {
                        $conditions[] = array('classifieds.parent_categoryid', '=', $data['cat_id']);
                    } else {
                        $conditions[] = array('categories.id', '=', $data['cat_id']);
                    }
                } else {
                    $iscategory = true;
                    $staterestult = $statemodel->getclassifiedbystatecitycount();
                }

                if (!empty($data['itemname'])) {
                    $conditions[] = array('classifieds.title', 'like', '%' . $data['itemname'] . '%');
                }

                if (!empty($data['state_id'])) {
                    $conditions[] = array('classifieds.state_id', '=', $data['state_id']);
                }
                if (!empty($data['city_id'])) {
                    $conditions[] = array('classifieds.city_id', '=', $data['city_id']);
                }
                if (!empty($data['city'])) {
                    $conditions[] = array('classifieds.location', 'like', '%' . $data['city'] . '%');
                }
                if (!empty($data['minprice']) || !empty($data['maxprice'])) {
                    $conditions[] = array('classifieds.price', '>=', $data['minprice']);
                    $conditions[] = array('classifieds.price', '<=', $data['maxprice']);
                }

                if (!empty($data['order'])) {
                    if ($data['order'] == "most_recent") {
                        $sortArr["field"] = "id";
                        $sortArr["sort"] = "desc";
                        $sortArr["val"] = "most_recent";
                    }
                    if ($data['order'] == "title_asc") {
                        $sortArr["field"] = "title";
                        $sortArr["sort"] = "asc";
                        $sortArr["val"] = "title_asc";
                    }
                    if ($data['order'] == "title_desc") {
                        $sortArr["field"] = "title";
                        $sortArr["sort"] = "desc";
                        $sortArr["val"] = "title_desc";
                    }
                    if ($data['order'] == "price_htl") {
                        $sortArr["field"] = "price";
                        $sortArr["sort"] = "desc";
                        $sortArr["val"] = "price_htl";
                    }
                    if ($data['order'] == "price_lth") {
                        $sortArr["field"] = "price";
                        $sortArr["sort"] = "asc";
                        $sortArr["val"] = "price_lth";
                    }
                } else {
                    $sortArr = array('field' => 'id', 'sort' => 'desc', 'val' => 'most_recent');
                }
                $km = $data['km'];
                $lat = $data['lat'] ? $data['lat'] : 0;
                $long = $data['lng'] ? $data['lng'] : 0;

                if ($lat == '0' and $long == '0') {

                    $cur_date = date('Y-m-d');

                    $result = $this->model
                                    ->selectRaw('categories.id,classifieds.id as classified_id ,classifieds.title as title,classifieds.description as description,classifiedimage.name as name,classifieds.price,categories.name as catname,classifieds.location as location,categories.belong_to_community as btc,categories.show_on_info_area as sia, classifieds.created_at as classified_created,cities.City as city')
                                    ->leftJoin('categories', function($join) use ($isParent, $iscategory) {
                                        if ($isParent) {
                                            $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                                        } elseif ($iscategory) {
                                            $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                                            $join->orOn('classifieds.category_id', '=', 'categories.id');
                                        } else {
                                            $join->on('classifieds.category_id', '=', 'categories.id');
                                        }
                                    })
                                    ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                                    ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                                    ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                                    ->leftJoin('cities', 'classifieds.city_id', '=', 'cities.CityId')
                                    ->where($conditions)->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ");

                    if (isset($data['dynamicattr'])) {
                        $darray = array_filter($data['dynamicattr'], function($value) {
                            return $value !== '';
                        });
                    }

                    $result = $result->groupBy('classifieds.id')
                            ->orderBy('classifieds.' . $sortArr['field'], $sortArr['sort'])
                            ->paginate(5);
                } else {
                    
                }


                $wishlistItems = array();
                if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
                    $wishlistObj = new Wishlist;
                    $wishlistItems = $wishlistObj->where('user_id', '=', Auth::guard('web')->user()->id)->pluck("classified_id", "id")->all();
                }

                if ($isParent) {
                    $template_type = '';
                } else {
                    $template_type = 'list';
                }

                $template_arr = DB::table('templates')->select('template_slug')
                                ->leftJoin('category_template', 'templates.id', '=', 'category_template.template_id')
                                ->where('category_template.category_id', '=', $data['cat_id'])
                                ->where('templates.template_type', '=', $template_type)
                                ->get()->toArray();

                if (isset($template_arr) && !empty($template_arr)) {
                    $template_slug = $template_arr[0]->template_slug;
                } else {
                    $template_slug = 'list';
                }

                return view('front/search/search-child-cat-' . $template_slug . '-list', ['result' => $result, /* 'resultNewicon' => $resultNewicon,'accordian_collection_array' => $accordian_collection_array,  */ 'wishlistItems' => $wishlistItems, 'staterestult' => $staterestult]);
            }
        }
    }

    /**
     * dynamicattribusteslist
     * dynamicattribusteslist classifieds 
     *
     * @return response
     * @access public
     */
    public function dynamicattribusteslist(Request $request) {

        $current_date = date('Y-m-d');
        if ($request->isMethod('get')) {

            $data = Input::all();

            if (!empty($data)) {

//function to check the selected category is parent or not
                $task = new Category;
                $BelongsToCommunities = $task->pluck('pid', 'id')->toArray();
                $isParent = null;

                $conditions = array(
                    array('classifieds.status', '=', 1),
                );

                if (!empty($data['cat_id'])) {
                    $isParent = $BelongsToCommunities[$data['cat_id']] == 0 ? true : false;
                    if ($isParent) {
                        $conditions[] = array('classifieds.parent_categoryid', '=', $data['cat_id']);
                    } else {
                        $conditions[] = array('categories.id', '=', $data['cat_id']);
                    }
                }
                if (!empty($data['itemname'])) {
                    $conditions[] = array('classifieds.title', 'like', '%' . $data['itemname'] . '%');
                }

                if (!empty($data['state_id'])) {
                    $conditions[] = array('classifieds.state_id', '=', $data['state_id']);
                }
                if (!empty($data['city_id'])) {
                    $conditions[] = array('classifieds.city_id', '=', $data['city_id']);
                }
                if (!empty($data['city'])) {
                    $conditions[] = array('classifieds.location', 'like', '%' . $data['city'] . '%');
                }


                if (!empty($data['order'])) {
                    $order = $data['order'];
                } else {
                    $order = 'asc';
                }
                $km = $data['km'];
                $lat = $data['lat'] ? $data['lat'] : 0;
                $long = $data['lng'] ? $data['lng'] : 0;

                if ($lat == '0' and $long == '0') {


                    $cur_date = date('Y-m-d');
                    $result = $this->model
                                    ->selectRaw('categories.id,classifieds.id as classified_id ,classifieds.title as title,classifieds.description as description,classifiedimage.name as name,classifieds.price,categories.name as catname,classifieds.location as location')
                                    ->leftJoin('categories', function($join) use ($isParent) {
                                        if ($isParent) {
                                            $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                                        } else {
                                            $join->on('classifieds.category_id', '=', 'categories.id');
                                        }
                                    })
                                    ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                                    ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                                    ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                                    ->where($conditions)->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ");

                    if (isset($data['dynamicattr'])) {
                        $darray = array_filter($data['dynamicattr']);
                    }


                    if (!empty($darray)) {

                        $darray = array_values($darray);

                        $darraycount = count($darray);
                        if ($darraycount == 1) {

                            $dcodearrays = json_decode($darray[0], true);
                            $lists = array();

                            foreach ($dcodearrays as $keys => $values) {
                                $valuesarr = implode(',', $values);
                            }
                            $charray = explode(',', $valuesarr);
                            $result = $result->whereIn('classifieds.id', $charray);
                        } else {
                            foreach ($darray as $keya => $valuea) {
                                $list = array();
                                $dcodearray = json_decode($valuea, true);
                                foreach ($dcodearray as $keyb => $valueb) {
                                    $values[$keyb] = $valueb;
                                }

                                $list[] = $values;
                            }

                            $intersect = call_user_func_array('array_intersect', $list[0]);
                            print_r($intersect);
//                      
                            if (!empty($intersect) && (count($intersect) > 0)) {
                                $result = $result->whereIn('classifieds.id', $intersect);
                            } else {

                                $result = $result->where('classifieds.id', '=', 0);
                            }
                        }
                    }

                    $result = $result->groupBy('classifieds.id')
                            ->orderBy('classifieds.title', $order)
                            ->get();
                } else {

                    $cur_date = date('Y-m-d');
                    $result = $this->model
                            ->select(DB::raw("(SQRT(POW(69.1 * (lat - $lat), 2) +
                                POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) AS distance, categories.id,classifieds.id as classified_id ,classifieds.title as title,classifieds.description as description,classifiedimage.name as name,classifieds.price,categories.name as catname,classifieds.location as location"))
                            ->leftJoin('categories', function($join) use ($isParent) {
                                if ($isParent) {
                                    $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                                } else {
                                    $join->on('classifieds.category_id', '=', 'categories.id');
                                }
                            })
                            ->whereRaw("(SQRT(POW(69.1 * (lat - $lat), 2) +
                                POW(69.1 * ($long - lng) * COS(lat / 57.3), 2))) < $km")
                            ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                            ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                            ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                            ->where($conditions)->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ")
                            ->groupBy('classifieds.id')
                            ->orderBy('classifieds.title', $order)
                            ->get();
                }


                $resultNew['data'] = $result->toarray();
                foreach ($resultNew['data'] as $key => $value) {
                    $multiattribute1 = $this->model->where('id', '=', $value['classified_id'])->with(['classified_attribute' => function ($query) {
                                    $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon', 'display_name')
                                            ->where('attributes.searchable', '=', 1)
                                            ->where('attributes.status', '=', 1)
                                    ;
                                }])->first()->toarray();

                    $resultNew['data'][$key]['classified_attribute'] = $multiattribute1['classified_attribute'];
                }

                $allattributearr = array();
                foreach ($resultNew['data'] as $key => $value) {

                    if (!empty($value['classified_attribute'])) {
                        foreach ($value['classified_attribute'] as $in => $val) {

                            if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                                $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                                $resultNew['data'][$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                                $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                                $val['attr_AllValues'] = $attr_AllValues->toArray();
                            } else
                            if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] == 0) {

                                $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                                $resultNew['data'][$key]['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                                $val['attr_AllValues'] = $attr_AllValues->toArray();
                            } else
                            if (($val['attr_type_name'] == 'calendar') && (strpos($val['attr_value'], ';'))) {
                                $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                                $resultNew['data'][$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                                $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                                $val['attr_AllValues'] = $attr_AllValues->toArray();
                            } else
                            if (($val['attr_type_name'] == 'Numeric') && (strpos($val['attr_value'], ';'))) {
                                $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                                $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                                $val['attr_AllValues'] = $attr_AllValues->toArray();
                            } else
                            if (($val['attr_type_name'] == 'Date') && (strpos($val['attr_value'], ';'))) {
                                $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                                $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                                $val['attr_AllValues'] = $attr_AllValues->toArray();
                            } else
                            if (($val['attr_type_name'] == 'Time') && (strpos($val['attr_value'], ';'))) {
                                $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                                $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                                $val['attr_AllValues'] = $attr_AllValues->toArray();
                            } else {
                                unset($val);
                            }

                            if (isset($val) && !empty($val)) {
                                $allattributearr[$val['attr_type_name']][] = $val;
                            }
                        }
                    }
                }

                if (isset($allattributearr) && !empty($allattributearr)) {
                    foreach ($allattributearr as $key => $value) {
                        $stor_valueArray = [];
                        $stor_valueArrayDate = [];
                        foreach ($value as $k => $val) {

                            if ($key == 'Date') {

                                $newAttrArr[$key][] = $val;
                            } else {
                                if (!in_array($val['attr_value'], $stor_valueArray)) {

                                    $stor_valueArray[] = $val['attr_value'];
                                    $newAttrArr[$key][] = $val;
                                }
                            }
                            $newAttrArrForValue[$val['attr_value']][] = $val['classified_id'];
                        }
                    }
                }




                if (!empty($newAttrArr)) {


                    foreach ($newAttrArr as $key => $value) {
                        $stor_valueArray1 = [];
                        foreach ($value as $k => $val) {

                            if (!in_array($val['attribute_id'], $stor_valueArray1)) {
                                $stor_valueArray1[] = $val['attribute_id'];
                                $newAttrArr1[$key][$val['display_name']][] = $val;
                            } else {
                                $newAttrArr1[$key][$val['display_name']][] = $val;
                            }
                        }
                    }
                }



                $wishlistItems = array();
                if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
                    $wishlistObj = new Wishlist;
                    $wishlistItems = $wishlistObj->where('user_id', '=', Auth::guard('web')->user()->id)->pluck("classified_id", "id")->all();
                }
                if (!empty($newAttrArr1)) {
                    $newAttrArr1 = $newAttrArr1;
                } else {
                    $newAttrArr1 = array();
                }

                if (!empty($newAttrArrForValue)) {
                    $newAttrArrForValue = $newAttrArrForValue;
                } else {
                    $newAttrArrForValue = array();
                }
                return view('front/search/dyanamicattribute', ['newAttrArr1' => $newAttrArr1, 'newAttrArrForValue' => $newAttrArrForValue, 'dcatid' => $data['cat_id']]);
            }
        }
    }

    /**
     * classifiedsellerinform
     * classifiedsellerinform classifieds 
     *
     * @return response
     * @access public
     */
    public function classifiedsellerinform(Request $request, $id = null) {
        $current_date = date('Y-m-d');
        if (isset($id) && !empty($id)) {

            $userExistingAdds = $this->model->where('user_id', '=', $id)
                            ->where('status', '=', 1)
                            ->with(['classified_attribute' => function ($query) {
                                    $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')
                                    ->where(['show_list' => 1]);
                                }, 'classified_users' => function ($q1) {
                                    $q1->select('id', 'name', 'email', 'location', 'image');
                                }, 'classified_image'])
                            ->whereRaw("'$current_date' Between start_date and end_date ")
                            ->orderby('id', 'desc')->paginate(5);

            $userlist = $userExistingAdds;
            $userExistingAdds = $userExistingAdds->toarray();

            foreach ($userExistingAdds['data'] as $key => $value) {



                if (!empty($value['classified_attribute'])) {
                    foreach ($value['classified_attribute'] as $in => $val) {
                        if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] == 0) {
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $userExistingAdds['data'][$key]['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                        }
                        if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] != 0) {
                            $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $val['attribute_id'])->where('attribute_value_id', $val['parent_value_id'])->pluck('attribute_value', 'id');
                            $userExistingAdds['data'][$key]['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                        }

                        if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $userExistingAdds['data'][$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                            $userExistingAdds['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        }
                    }
                }
            }
            $task = new Category;
            $current_date = date("Y-m-d");
            $top_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 1)->where("banner_position", "=", "top")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();
            $right_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 1)->where("banner_position", "=", "right")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();
            $bottom_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 1)->where("banner_position", "=", "bottom")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();

            $default_top_position_ad = \DB::table('advertisements')->where("page_id", "=", 1)->where("banner_position", "=", "top")->where("is_default", "=", 1)->where("status", "=", 1)->first();
            $default_right_position_ad = \DB::table('advertisements')->where("page_id", "=", 1)->where("banner_position", "=", "right")->where("is_default", "=", 1)->where("status", "=", 1)->first();
            $default_bottom_position_ad = \DB::table('advertisements')->where("page_id", "=", 1)->where("banner_position", "=", "bottom")->where("is_default", "=", 1)->where("status", "=", 1)->first();
            $selectedCategories = null;

            $selectedCategories = explode(',', $selectedCategories);
            $allSubCategories = $task->getFrontCategories($selectedCategories);
            $allComCategories = $task->getFrontComCategories($selectedCategories);
            $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

            $wishlistItems = array();
            if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
                $wishlistObj = new Wishlist;
                $wishlistItems = $wishlistObj->where('user_id', '=', Auth::guard('web')->user()->id)->pluck("classified_id", "id")->all();
            } elseif (Cookie::get('wishlistItems')) {
                $wishlistItems = Cookie::get('wishlistItems');
            }

            return view('front.classifieds.seller-profile', compact('top_positions_ads', 'allCategoriesWithClassifiedCount', 'right_positions_ads', 'bottom_positions_ads', 'default_top_position_ad', 'default_right_position_ad', 'default_bottom_position_ad', 'allSubCategories', 'allSubCategoriesForMenu', 'userExistingAdds', 'userlist', 'wishlistItems'));
        }
    }

    /**
     * classifieduserinformapi
     * classifieduserinformapi classifieds 
     *
     * @return response
     * @access public
     */
    public function classifieduserinformapi(Request $request) {
        $id = $request->user_id;
        $current_date = date('Y-m-d');
        $rooturl = \Request::root();
        $loginid = $request->id;
        // dd($loginid);
        if (($id > 0)) {

            $data = $this->model
                    ->selectRaw('classifieds.id as classifiedid ,classifieds.title as title,'
                            . 'classifieds.description as description,classifiedimage.name as name,classifieds.price,UNIX_TIMESTAMP(classifieds.created_at)as createdtime,'
                            . 'concat("' . $rooturl . '/upload_images/classified/",classifieds.id,"/",classifiedimage.name) imageurl,classifieds.city_id')
                    ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                    ->where('classifieds.user_id', '=', $id)->where(['classifieds.status' => 1])
                    ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                    ->groupBy('classifieds.id')
                    ->with(['city_data' => function ($q3) {
                            $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                        },])
                    ->get();
        }
        $wishlistItems = array();
        if ($id != 0) {
            $useraddcount = $this->model
                            ->selectRaw('id as classifiedid')
                            ->where('user_id', '=', $id)
                            ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                            ->get()->count();
            $userdetail = DB::table('users')
                    ->selectRaw('id,name,email,role_id,image,avatar,mobile_no,city,UNIX_TIMESTAMP(created_at)as createdtime,latitude,longitude')
                    ->where('id', '=', $id)
                    ->first();
        }
        if (!empty($loginid)) {
            $wishlistObj = new Wishlist;
            $wishlistItems = $wishlistObj->where('user_id', '=', $loginid)->select('classified_id')->get()->toarray();
        }


        foreach ($wishlistItems as $key1 => $value1) {
            $listarray[] = $value1['classified_id'];
        }
        foreach ($data as $key => $value) {
            if (!empty($listarray)) {
                if (in_array($value['classifiedid'], $listarray)) {
                    $data[$key]['wishlist'] = 1;
                } else {
                    $data[$key]['wishlist'] = 0;
                }
            } else {
                $data[$key]['wishlist'] = 0;
            }
            if (!empty($value->city_data->CityId)) {
                $data[$key]['location'] = $value->city_data->City;
            } else {
                $data[$key]['location'] = 'N/A';
                unset($value->city_data);
            }
        }

        if (!empty($userdetail->image)) {

            $imgurl = \URL::asset('upload_images/users/' . $userdetail->id . '/' . $userdetail->image);
            $userdetail->userimage = $imgurl;
            $userdetail->image = $imgurl;
        } elseif (!empty($userdetail->avatar) && ($userdetail->avatar != 'null')) {
            $imgurl = $userdetail->avatar;
            $userdetail->userimage = $imgurl;
            $userdetail->image = $imgurl;
        } else {

            $imgurl = \URL::asset('plugins/front/img/profile-img-new-header.jpg');
            $userdetail->userimage = $imgurl;
            $userdetail->image = $imgurl;
        }

        if (!empty($useraddcount)) {
            $userdetail->usercount = $useraddcount;
        } else {
            $userdetail->usercount = 0;
        }

        if (!empty($userdetail->city)) {

            $userdetail->city = $userdetail->city;
        } else {
            $userdetail->city = 'N/A';
        }
        if (!empty($userdetail)) {
            $userdetaildata = $userdetail;
        } else {
            $userdetaildata = array();
        }

        if (count($data) > 0) {

            $result['status'] = 1;
            $result['data'] = $data;
            $result['classified_users'] = $userdetaildata;
            echo json_encode($result);
            die;
        } else {
            $result['status'] = 1;
            $result['data'] = array();
            $result['classified_users'] = $userdetaildata;
            $result['msg'] = 'no user existing record found';
            echo json_encode($result);
            die;
        }
    }

    /**
     * getcitieswithcount
     * getcitieswithcount classifieds 
     *
     * @return response
     * @access public
     */
    public function getcitieswithcount($stateid) {
        $cur_date = date('Y-m-d');
        $city = DB::table('classifieds')
                ->selectRaw('classifieds.id,cities.CityId, cities.City,count(cities.CityId) as count')
                ->leftJoin('cities', 'classifieds.city_id', '=', 'cities.id')
                ->Where('cities.RegionID', '=', $stateid)
                ->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ")
                ->groupby('cities.city_id')
                ->get();
        return $city;
        die();
    }

    /**
     * get_classified_recent
     * get_classified_recent classifieds 
     *
     * @return response
     * @access public
     */
    public function get_classified_recent(Request $request) {
        $current_date = date('Y-m-d');
        if ($request->isMethod('post')) {
            $data = Input::all();

            if (!empty($data)) {

                $hr = Redis::get('Recent-Classified-hours');
                $distance = Redis::get('Default-Search-Radius');
                if ($data['lat'] == 0 && $data['lng'] == 0) {

                    $data = DB::select(DB::raw("select *,c.created_at as classified_create,ct.City,ct.Latitude,ct.Longitude,SUBSTRING_INDEX(replace(c.location,' ',''),',',-1 ) country from classifieds c 
                                join categories cat on cat.id = c.parent_categoryid
                                left join cities ct on c.city_id = ct.CityId
                                join  
                        (select * from classifiedimage group by classified_id) ci 
                        on c.id=ci.classified_id 
                        where c.status = 1
                        And (curdate() between c.start_date and c.end_date) 
                        and c.`created_at` >= DATE_SUB(NOW(), INTERVAL $hr HOUR) and cat.belong_to_community = 0
                        and cat.show_on_info_area = 0 order by c.created_at desc
                        limit 10 offset $data[offset]"));
                } else {
                    $data = DB::select(DB::raw(
                                            "select *,c.created_at as classified_create,ct.City,ct.Latitude,ct.Longitude,SUBSTRING_INDEX(replace(c.location,' ',''),',',-1 ) country,
                                (SQRT(POW(69.1 * (lat - $data[lat]), 2) + POW(69.1 * ($data[lng] - lng) * COS(lat / 57.3), 2)) * 1.609344) AS distance 
                                    from classifieds c 
join categories cat on cat.id = c.parent_categoryid
left join cities ct on c.city_id = ct.CityId
join 
                        (select * from classifiedimage group by classified_id) ci 
                        on c.id=ci.classified_id 
                        having c.`status` = 1  And (curdate() between c.start_date and c.end_date)
                        and distance < $distance 
                        and c.`created_at` >= DATE_SUB(NOW(), INTERVAL $hr HOUR) and cat.belong_to_community = 0
                        and cat.show_on_info_area = 0 order by c.created_at desc
                        limit 10 offset $data[offset]"));
                }

                if ($data) {
                    foreach ($data as $key => $value) {
                        $value->createtime = Helper::time_since_for_classified(time() - strtotime($value->classified_create));
                    }
                    return response()->json(['status' => true, 'data' => $data]);
                } else {
                    return response()->json(['status' => false]);
                }
            }
        }
    }

    /**
     * get_classified_recentapi
     * get_classified_recentapi classifieds 
     *
     * @return response
     * @access public
     */
    public function get_classified_recentapi(Request $request) {
        //die('a');
        $rooturl = \Request::root();
        $current_date = date('Y-m-d');
        $user_id = $request->user_id;
        if ($request->isMethod('post')) {
            $data = Input::all();


            if (!empty($data)) {

                $hr = Redis::get('Recent-Classified-hours');
                $distance = Redis::get('Default-Search-Radius');
                if ($data['lat'] == 0 && $data['lng'] == 0) {

                    $data = DB::select(DB::raw("select IF(c.lat = '','0.0',c.lat) lat,IF(c.lng = '','0.0',c.lng) lng,"
                                            . "c.user_id,c.title,c.start_date,c.end_date,cat.belong_to_community,cat.show_on_info_area,"
                                            . "c.price,c.description,c.created_at,ci.classified_id as classifiedid,ct.City,ct.Latitude,ct.Longitude,c.city_id,UNIX_TIMESTAMP(c.created_at)as createdtime,"
                                            . "concat('$rooturl/upload_images/classified/',ci.classified_id,'/',ci.name) imageurl,
                                                SUBSTRING_INDEX(replace(c.location,' ',''),',',-1 ) country from classifieds c 
                                join categories cat on cat.id = c.parent_categoryid
                                left join cities ct on c.city_id = ct.CityId
                                join  
                        (select * from classifiedimage group by classified_id) ci 
                        on c.id=ci.classified_id 
                        where c.status = 1
                        And (curdate() between c.start_date and c.end_date) 
                        and c.`created_at` >= DATE_SUB(NOW(), INTERVAL $hr HOUR) and cat.belong_to_community = 0
                        and cat.show_on_info_area = 0 order by c.created_at desc
                        "));
                } else {
                    $data = DB::select(DB::raw(
                                            "select c.lat,c.lng,c.user_id,c.title,c.start_date,c.end_date,cat.belong_to_community,cat.show_on_info_area,"
                                            . "c.price,c.description,c.created_at,ci.classified_id as classifiedid,ct.City,ct.Latitude,ct.Longitude,c.city_id,c.status,"
                                            . "concat('$rooturl/upload_images/classified/',ci.classified_id,'/',ci.name) imageurl,SUBSTRING_INDEX(replace(c.location,' ',''),',',-1 ) country,UNIX_TIMESTAMP(c.created_at)as createdtime,
                                (SQRT(POW(69.1 * (lat - $data[lat]), 2) + POW(69.1 * ($data[lng] - lng) * COS(lat / 57.3), 2)) * 1.609344) AS distance 
                                    from classifieds c 
join categories cat on cat.id = c.parent_categoryid
left join cities ct on c.city_id = ct.CityId
join 
                        (select * from classifiedimage group by classified_id) ci 
                        on c.id=ci.classified_id 
                        having c.`status` = 1  And (curdate() between c.start_date and c.end_date)
                        and distance < $distance 
                        and c.`created_at` >= DATE_SUB(NOW(), INTERVAL $hr HOUR) and cat.belong_to_community = 0
                        and cat.show_on_info_area = 0 order by c.created_at desc
                        "));
                }

                $wishlistItems = array();
                if ($user_id != 0) {
                    $wishlistObj = new Wishlist;
                    $wishlistItems = $wishlistObj->where('user_id', '=', $user_id)->select('classified_id')->get()->toarray();
                }
                foreach ($wishlistItems as $key1 => $value1) {
                    $listarray[] = $value1['classified_id'];
                }

                foreach ($data as $key => $value) {
                    if (!empty($listarray)) {
                        if (in_array($value->classifiedid, $listarray)) {
                            $data[$key]->wishlist = 1;
                        } else {
                            $data[$key]->wishlist = 0;
                        }
                    } else {
                        $data[$key]->wishlist = 0;
                    }
                    if (!empty($value->City)) {
                        $value->location = $value->City;
                    } else {
                        $value->location = 'N/A';
                    }
                }
                if ($data) {
                    $cacheDuration = 60; // in seconds
                    // Client is told to cache these results for set duration
//                                    
//
//                                    // Pragma header removed should the server happen to set it automatically
//                                    // Pragma headers can make browser misbehave and still ask data from server
                    header('Cache-Control: public, only-if-cached, max-stale=' . $cacheDuration . ',must-revalidate');
                    header('Expires: ' . gmdate('D, d M Y H:i:s', ($_SERVER['REQUEST_TIME'] + $cacheDuration)) . ' GMT');
                    header('Last-modified: ' . gmdate('D, d M Y H:i:s', $_SERVER['REQUEST_TIME']) . ' GMT');

                    // Pragma header removed should the server happen to set it automatically
                    // Pragma headers can make browser misbehave and still ask data from server
                    header_remove('Pragma');
                    header('Content-Type: application/json', false);
                    $result['status'] = 1;
                    $result['data'] = $data;

                    echo json_encode($result);
                    die;
                } else {
                    $blankvalue = array(
                        '' => '',
                    );
                    return response()->json(['status' => 0, 'data' => array(), 'msg' => 'Record Not Found']);
                }
            }
        }
    }

    /**
     * get_classified_recentapi1
     * get_classified_recentapi1 classifieds 
     *
     * @return response
     * @access public
     */
    public function get_classified_recentapi1(Request $request) {
        $rooturl = \Request::root();
        $current_date = date('Y-m-d');
        $user_id = $request->user_id;
        $data = Input::all();

        if (!empty($data)) {

            $hr = Redis::get('Recent-Classified-hours');
            $distance = Redis::get('Default-Search-Radius');
            if ($data['lat'] == 0 && $data['lng'] == 0) {

                $data = DB::select(DB::raw("select IF(c.lat = '','0.0',c.lat) lat,IF(c.lng = '','0.0',c.lng) lng,c.user_id,c.title,c.start_date,c.end_date,cat.belong_to_community,cat.show_on_info_area,c.price,c.created_at,ci.classified_id as classifiedid,concat('$rooturl/upload_images/classified/',ci.classified_id,'/',ci.name) imageurl,SUBSTRING_INDEX(replace(c.location,' ',''),',',-1 ) country from classifieds c 
                                join categories cat on cat.id = c.parent_categoryid
                                join  
                        (select * from classifiedimage group by classified_id) ci 
                        on c.id=ci.classified_id 
                        where c.status = 1
                        And (curdate() between c.start_date and c.end_date) 
                        and c.`created_at` >= DATE_SUB(NOW(), INTERVAL $hr HOUR) and cat.belong_to_community = 0
                        and cat.show_on_info_area = 0 order by c.created_at desc
                        "));
            } else {
                $data = DB::select(DB::raw(
                                        "select c.lat,c.lng,c.user_id,c.title,c.start_date,c.end_date,cat.belong_to_community,cat.show_on_info_area,c.price,c.created_at,ci.classified_id as classifiedid,concat('$rooturl/upload_images/classified/',ci.classified_id,'/',ci.name) imageurl,SUBSTRING_INDEX(replace(c.location,' ',''),',',-1 ) country,
                                (SQRT(POW(69.1 * (lat - $data[lat]), 2) + POW(69.1 * ($data[lng] - lng) * COS(lat / 57.3), 2)) * 1.609344) AS distance 
                                    from classifieds c 
join categories cat on cat.id = c.parent_categoryid                                     
join 
                        (select * from classifiedimage group by classified_id) ci 
                        on c.id=ci.classified_id 
                        having c.`status` = 1  And (curdate() between c.start_date and c.end_date)
                        and distance < $distance 
                        and c.`created_at` >= DATE_SUB(NOW(), INTERVAL $hr HOUR) and cat.belong_to_community = 0
                        and cat.show_on_info_area = 0 order by c.created_at desc
                        "));
            }

            $wishlistItems = array();
            if ($user_id != 0) {
                $wishlistObj = new Wishlist;
                $wishlistItems = $wishlistObj->where('user_id', '=', $user_id)->select('classified_id')->get()->toarray();
            }
            foreach ($wishlistItems as $key1 => $value1) {
                $listarray[] = $value1['classified_id'];
            }
            foreach ($data as $key => $value) {
                if (!empty($listarray)) {
                    if (in_array($value->classifiedid, $listarray)) {
                        $data[$key]->wishlist = 1;
                    } else {
                        $data[$key]->wishlist = 0;
                    }
                } else {
                    $data[$key]->wishlist = 0;
                }
            }
            if ($data) {
                $cacheDuration = 60; // in seconds
//                                    // Pragma header removed should the server happen to set it automatically
//                                    // Pragma headers can make browser misbehave and still ask data from server
                header('Cache-Control:max-age=60');
                header('Expires: ' . gmdate('D, d M Y H:i:s', ($_SERVER['REQUEST_TIME'] + $cacheDuration)) . ' GMT');
                header('Last-modified: ' . gmdate('D, d M Y H:i:s', $_SERVER['REQUEST_TIME']) . ' GMT');

                // Pragma header removed should the server happen to set it automatically
                // Pragma headers can make browser misbehave and still ask data from server
                header_remove('Pragma');
                header('Content-Type: application/json', false);
                $result['status'] = 1;
                $result['data'] = $data;

                echo json_encode($result);
                die;
            } else {
                $blankvalue = array(
                    '' => '',
                );
                return response()->json(['status' => 0, 'data' => array(), 'msg' => 'Record Not Found']);
            }
        }
        // }
    }

    /**
     *  classifiedcreateapi
     * classifiedcreateapi classifieds 
     *
     * @return response
     * @access public
     */
    public function classifiedcreateapi(Request $request) {

        if ($request->isMethod('post')) {

            $requestArr = Input::all();
            $loginid = $requestArr['user_id'];

            if ($request->all()['attributes']) {
                $attributesarr = json_decode($request->all()['attributes']);
            } else {
                $attributesarr = array();
            }
            $subregions_id = $request->subregions_id;
            $state_name = $request->state_id;
            if (!empty($state_name)) {
                $state_idarr = DB::table('state')->where('name', $state_name)->select('id', 'name')->first();
                $statesid = $state_idarr->id;
            } else {
                $statesid = 0;
            }
            $lat = $request->lat;
            $lng = $request->lng;
            $extra1 = [];
            $extra2 = [];
            if (!empty($subregions_id)) {
                $row = \DB::table('cities')->where("City", '=', $subregions_id)->first();

                if (!empty($row)) {
                    $city_id = $row->CityId;
                } else {
                    $attachmentData = array('City' => $subregions_id, 'Latitude' => $lat, 'Longitude' => $lng, 'RegionID' => $statesid);
                    $insertcityid = \DB::table('cities')->insertGetId($attachmentData);
                    $city_id = $insertcityid;
                }
            }
            $exceptFields = ['image', 'attributes'];
            $data = new Classified();
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            if (!empty($city_id)) {
                $data->city_id = $city_id;
            }
            $data->state_id = $statesid;
            if (isset($request->subregions_id) && $request->subregions_id == '') {
                $data->subregions_id = 0;
            }

            $data->status = 2;
            $data->user_id = $loginid;

            $data->start_date = date("Y-m-d");
            $data->end_date = date("Y-m-d", strtotime("+" . Redis::get('Unfeature-Classified-Day') . " day"));



            if (!empty($attributesarr)) {

                foreach ($attributesarr as $key => $value) {
                    if ($value->attr_type_id == 5) {
                        if (!empty($value->attr_value)) {
                            $valuearr = explode(',', $value->attr_value);
                            foreach ($valuearr as $keys => $values) {
                                $extra1[$values] = array(
                                    'attribute_id' => $key,
                                    'attr_type_name' => $value->attr_type_name,
                                    'attr_type_id' => $value->attr_type_id,
                                    'attr_value' => $values,
                                );
                            }
                        }
                        unset($attributesarr->$key);
                    }

                    //for Radio
                    if ($value->attr_type_id == 7) {
                        $extra2[$value->attr_value] = array(
                            'attribute_id' => $key,
                            'attr_type_name' => $value->attr_type_name,
                            'attr_type_id' => $value->attr_type_id,
                            'attr_value' => $value->attr_value,
                        );
                        unset($attributesarr->$key);
                    }
                    $attributes[$key] = array(
                        'attr_type_name' => $value->attr_type_name,
                        'attr_type_id' => $value->attr_type_id,
                        'attr_value' => $value->attr_value,
                        'parent_value_id' => $value->parent_value_id,
                        'attr_type_name' => $value->parent_attribute_id,
                    );
                }
                $extra1 = $extra1 + $extra2;
            }

            $classified = $this->model->create($data->toArray());
            if (!empty($attributesarr)) {
                $attributesarr = json_decode(json_encode($attributesarr), TRUE);
                $classified->classified_attribute()->sync($attributesarr);
            }
            if (!empty($extra1)) {
                foreach ($extra1 as $ke => $val) {
                    $val['classified_id'] = $classified->id;
                    \DB::table('attribute_classified')->insert($val);
                }
            }
            $lastinstertid = $classified->id;
            if ($lastinstertid) {
                if (Input::file()) {
                    $image = Input::file();
                    $attachmentData = array();
                    if (!is_dir('upload_images/classified/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/30px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/30px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/950x530px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/950x530px/' . $lastinstertid, 0777, true);
                    }
                    if (!is_dir('upload_images/classified/285x217px/' . $lastinstertid)) {
                        File::makeDirectory('upload_images/classified/285x217px/' . $lastinstertid, 0777, true);
                    }
                    foreach ($image as $key => $val) {



                        $destinationPath = 'upload_images/classified/' . $lastinstertid . '/';

                        $destinationPaththumb = 'upload_images/classified/30px/' . $lastinstertid . '/';
                        $destinationPaththumb150x100px = 'upload_images/classified/950x530px/' . $lastinstertid . '/';
                        $destinationPaththumb285x217px = 'upload_images/classified/285x217px/' . $lastinstertid . '/';
                        $extension = $val->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $fileName = $ran . '.' . $extension;

                        $val->move($destinationPath, $fileName);
                        image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                        image1::make($destinationPath . $fileName)->resize(950, 530)->save($destinationPaththumb150x100px . $fileName);
                        image1::make($destinationPath . $fileName)->resize(285, 217)->save($destinationPaththumb285x217px . $fileName);
                        $attachmentData[] = array('classified_id' => $lastinstertid, 'name' => $fileName);
                    }
                    \DB::table('classifiedimage')->insert($attachmentData);
                }
            }

            $result['status'] = 1;
            $result['msg'] = 'Classified created successfully.';

            echo json_encode($result);
            die;
        }
    }

    /**
     *  editclassified_api
     * editclassified_api classifieds 
     *
     * @return response
     * @access public
     */
    public function editclassified_api(Request $request) {
        $rooturl = \Request::root();
        $id = $request->id;
        $loginid = $request->user_id;
        $childCategoryName = [];

        $category = new Category;
        $BelongsToCommunities = $category->where(['pid' => 0])->pluck('belong_to_community', 'id')->toArray();

        $state = DB::table('state')->where('country_id', 14)->pluck('name', 'id');
        $stateCode = DB::table('state')->where('country_id', 14)->pluck('id', 'code')->toarray();
        $showStaticAttributes = $category->where(['pid' => 0])->pluck('show_static_attributes', 'id')->toArray();
        $result = false;

        if (!empty($id)) {

            $result = $this->model->where('id', '=', $id)->with(['classified_attribute' => function ($query) {
                            $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'size', 'measure_unit');
                        }, 'classified_image' => function($q2) use($rooturl) {
                            $q2->select(
                                    'id', 'classified_id', DB::raw('CONCAT("' . $rooturl . '","/upload_images/classified/",classified_id,"/",name) as image_url')
                            );
                        },
                    ])->first();


            $parentCategoryName = $category->select('name')->where(['id' => $result->parent_categoryid])->first()->toarray();


            $childCategoryName = $category->select('name')->where(['id' => $result->category_id])->first();
            if (!empty($result->parent_categoryid)) {
                $childCategoryName = Category::select('name', 'show_static_attributes')->where(['id' => $result->parent_categoryid])->first();
                $staticattribute = $childCategoryName->show_static_attributes;
            } else {
                $staticattribute = 0;
            }
            $suburb = DB::table('cities')->select('City')->where('CityId', '=', $result->city_id)->first();
            $statename = DB::table('state')->select('name')->where('id', '=', $result->state_id)->first();
            if (empty($statename)) {
                $result->state_id = "";
            } else {
                $result->state_id = $statename->name;
            }
            if (empty($suburb)) {
                $result->city_id = "";
            } else {
                $result->city_id = $suburb->City;
            }
            $checkCatIsBelToCommunity = DB::table('categories')->where('id', '=', $result->parent_categoryid)->first();
            $isCommunity = $checkCatIsBelToCommunity->belong_to_community == 1 ? "hide" : null;
            if ($result->category_id != 0) {
                $data['id'] = $result->category_id;
            } else {
                $data['id'] = $result->parent_categoryid;
            }
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
            $collection1 = collect($result->classified_attribute);
            $at_val_ids = $collection1->implode('attribute_id', ',');
            $at_val_idsArr = explode(',', $at_val_ids);
            $newAttrForUnsaved = [];
            foreach ($at_idsArr as $k1 => $v1) {
                if (!in_array($k1, $at_val_idsArr)) {
                    $newAttrForUnsaved[$k1]['attribute_id'] = $v1[0]['attribute_id'];
                    $newAttrForUnsaved[$k1]['classified_id'] = $id;
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
            $result1['classified_attribute'] = $result1['classified_attribute'] + $newAttrForUnsaved;
            $multi_select = [];
            foreach ($result1['classified_attribute'] as $key => $value) {
                $is_req = DB::table('attributes')->select('required')->where(['id' => $value['attribute_id']])->first();

                if ($value['attr_type_id'] == 4 && $value['parent_value_id'] == 0) {
                    $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                    $result1['classified_attribute'][$key]['attr_AllValues'] = $attr_AllValues->toArray();
                    $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                } else
                if ($value['attr_type_id'] == 4 && $value['parent_value_id'] != 0) {
                    $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $value['attribute_id'])->where('attribute_value_id', $value['parent_value_id'])->pluck('attribute_value', 'id');
                    $result1['classified_attribute'][$key]['attr_AllValues'] = $attr_AllValues->toArray();
                    $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                } else
                if ($value['attr_type_name'] == 'Numeric') {
                    $attr_AllValuesNumeric = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                    $result1['classified_attribute'][$key]['attr_AllValuesNumeric'] = $attr_AllValuesNumeric->toarray();
                    $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                } else
                if ($value['attr_type_name'] == 'calendar') {
                    $attr_AllValuesCalendar = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                    $result1['classified_attribute'][$key]['attr_AllValuesNumeric'] = $attr_AllValuesCalendar->toarray();
                    $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
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
                    $result1['classified_attribute'][$key]['is_required'] = $is_req->required;
                }
            }
            if (isset($multi_select) && !empty($multi_select)) {
                $result1['multi_select'] = $multi_select;
            }
            $attributearr = array();
            $attributearrMain = array();
            $attributearrMulti = array();
            $attributearrMain1 = array();
            foreach ($result1['classified_attribute'] as $key => $value) {

                if (in_array($value['attr_type_name'], ['text', 'Url', 'Email', 'textarea', 'calendar', 'Drop-Down', 'Color', 'Time', 'Date', 'Numeric'])) {
                    if (in_array($value['attr_type_name'], ["text"])) {
                        $attributearr['att_id'] = $value['attribute_id'];
                        $attributearr['att_name'] = $value['name'];
                        $attributearr['attr_type'] = 1;
                        $attributearr['attr_type_name'] = 'text';
                        $attributearr['validation'] = $value['is_required'];
                        $attributearr['value'] = array();
                        $attributearr['selectedvalue'] = $value['attr_value'];
                        $attributearr['size'] = $value['size'];
                        $attributearr['measure_unit'] = $value['measure_unit'];
                    } elseif (in_array($value['attr_type_name'], ["Color"])) {
                        $attributearr['att_id'] = $value['attribute_id'];
                        $attributearr['att_name'] = $value['name'];
                        $attributearr['attr_type'] = 12;
                        $attributearr['attr_type_name'] = 'Color';
                        $attributearr['validation'] = $value['is_required'];
                        $attributearr['value'] = array();
                        $attributearr['selectedvalue'] = $value['attr_value'];
                    } elseif (in_array($value['attr_type_name'], ["Url"])) {
                        $attributearr['att_id'] = $value['attribute_id'];
                        $attributearr['att_name'] = $value['name'];
                        $attributearr['attr_type'] = 9;
                        $attributearr['attr_type_name'] = 'Url';
                        $attributearr['validation'] = $value['is_required'];
                        $attributearr['value'] = array();
                        $attributearr['selectedvalue'] = $value['attr_value'];
                    } elseif (in_array($value['attr_type_name'], ["Email"])) {
                        $attributearr['att_id'] = $value['attribute_id'];
                        $attributearr['att_name'] = $value['name'];
                        $attributearr['attr_type'] = 3;
                        $attributearr['attr_type_name'] = 'Email';
                        $attributearr['validation'] = $value['is_required'];
                        $attributearr['value'] = array();
                        $attributearr['selectedvalue'] = $value['attr_value'];
                    } elseif (in_array($value['attr_type_name'], ["textarea"])) {
                        $attributearr['att_id'] = $value['attribute_id'];
                        $attributearr['att_name'] = $value['name'];
                        $attributearr['attr_type'] = 2;
                        $attributearr['attr_type_name'] = 'textarea';
                        $attributearr['validation'] = $value['is_required'];
                        $attributearr['value'] = array();
                        $attributearr['selectedvalue'] = $value['attr_value'];
                        $attributearr['size'] = $value['size'];
                        $attributearr['measure_unit'] = $value['measure_unit'];
                    } elseif (in_array($value['attr_type_name'], ["Drop-Down"])) {
                        $attributearr['att_id'] = $value['attribute_id'];
                        $attributearr['att_name'] = $value['name'];
                        $attributearr['attr_type'] = 4;
                        $attributearr['attr_type_name'] = 'Drop-Down';
                        $attributearr['validation'] = $value['is_required'];
                        $attributearr['p_attr_id'] = $value['p_attr_id'];
                        $attributearr['parent_value_id'] = $value['parent_value_id'];
                        foreach ($value['attr_AllValues'] as $val => $valuesdata) {
                            $valuearr[] = array(
                                'id' => $val,
                                'name' => $valuesdata,
                            );
                        }
                        $attributearr['value'] = $valuearr;
                        if (!empty($value['pivot'])) {
                            $attributearr['selectedvalue'] = $value['attr_value'];
                        } else {
                            $attributearr['selectedvalue'] = "";
                        }

                        unset($valuearr);
                    } elseif (in_array($value['attr_type_name'], ["Date"])) {
                        $attributearr['att_id'] = $value['attribute_id'];
                        $attributearr['att_name'] = $value['name'];
                        $attributearr['attr_type'] = 19;
                        $attributearr['attr_type_name'] = 'Date';
                        $attributearr['validation'] = $value['is_required'];
                        if (!empty($value['attr_value'])) {
                            if (strpos($value['attr_value'], ';') !== false) {
                                $daterange = 1;
                                $attributearr['range'] = $daterange;
                            } else {
                                $daterange = 0;
                                $attributearr['range'] = $daterange;
                            }
                        }
                        $attributearr['value'] = array();
                        $attributearr['selectedvalue'] = $value['attr_value'];
                    } elseif (in_array($value['attr_type_name'], ["Time"])) {
                        $attributearr['att_id'] = $value['attribute_id'];
                        $attributearr['att_name'] = $value['name'];
                        $attributearr['attr_type'] = 13;
                        $attributearr['attr_type_name'] = 'Time';
                        $attributearr['validation'] = $value['is_required'];
                        if (!empty($value['attr_value'])) {
                            if (strpos($value['attr_value'], ';') !== false) {
                                $timerange = 1;
                                $attributearr['range'] = $timerange;
                            } else {
                                $timerange = 0;
                                $attributearr['range'] = $timerange;
                            }
                        }
                        $attributearr['value'] = array();
                        $attributearr['selectedvalue'] = $value['attr_value'];
                    } elseif (in_array($value['attr_type_name'], ["Numeric"])) {
                        $attributearr['att_id'] = $value['attribute_id'];
                        $attributearr['att_name'] = $value['name'];
                        $attributearr['attr_type'] = 18;
                        $attributearr['attr_type_name'] = 'Numeric';
                        $attributearr['validation'] = $value['is_required'];
                        if (!empty($value['attr_AllValuesNumeric'])) {
                            $forIs = 0;
                            foreach ($value['attr_AllValuesNumeric'] as $vals => $valsdata) {

                                if ($forIs) {
                                    $value['attr_AllValuesNumeric']['max'] = $valsdata;
                                } else {
                                    $value['attr_AllValuesNumeric']['min'] = $valsdata;
                                }
                                $forIs++;
                                unset($value['attr_AllValuesNumeric'][$vals]);
                            }
                            $valudatanumber[] = $value['attr_AllValuesNumeric'];
                            $attributearr['value'] = $valudatanumber;
                            unset($valudatanumber);
                        } else {
                            $valuearrnumber[] = array(
                                'min' => 0,
                                'max' => 0,
                            );
                            $attributearr['value'] = $valuearrnumber;
                        }
                        if (strpos($value['attr_value'], ';') !== false) {
                            $isrange = 1;
                            $attributearr['range'] = $isrange;
                        } else {
                            $isrange = 0;
                            $attributearr['range'] = $isrange;
                        }
                        unset($valuearrnumber);
                        $attributearr['selectedvalue'] = $value['attr_value'];
                        $attributearr['size'] = $value['size'];
                        $attributearr['measure_unit'] = $value['measure_unit'];
                    } elseif (in_array($value['attr_type_name'], ["calendar"])) {
                        $attributearr['att_id'] = $value['attribute_id'];
                        $attributearr['att_name'] = $value['name'];
                        $attributearr['attr_type'] = 8;
                        $attributearr['attr_type_name'] = 'calendar';
                        $attributearr['validation'] = $value['is_required'];
                        if (!empty($value['attr_AllValuesNumeric'])) {
                            $forIs1 = 0;
                            foreach ($value['attr_AllValuesNumeric'] as $valc => $valcdata) {
                                if ($forIs1) {
                                    $value['attr_AllValuesNumeric']['max'] = $valcdata;
                                } else {
                                    $value['attr_AllValuesNumeric']['min'] = $valcdata;
                                }
                                $forIs1++;
                                unset($value['attr_AllValuesNumeric'][$valc]);
                            }
                            $valudata[] = $value['attr_AllValuesNumeric'];
                            $attributearr['value'] = $valudata;
                            unset($valudata);
                        } else {
                            $valuearrcalander[] = array(
                                'min' => 0,
                                'max' => 0,
                            );
                            $attributearr['value'] = $valuearrcalander;
                        }
                        if (strpos($value['attr_value'], ';') !== false) {
                            $iscalander = 1;
                            $attributearr['range'] = $iscalander;
                        } else {
                            $iscalander = 0;
                            $attributearr['range'] = $iscalander;
                        }

                        unset($valuearrcalander);
                        $attributearr['selectedvalue'] = $value['attr_value'];
                    }
                    if (!in_array($value['attr_type_name'], ['text', 'textarea', 'Numeric'])) {
                        unset($attributearr['size']);
                        unset($attributearr['measure_unit']);
                    }
                    $attributearrMain[] = $attributearr;
                }
            }


            if (!empty($result1['multi_select'])) {
                foreach ($result1['multi_select'] as $keys => $keysdata) {
                    $attributearr1['att_id'] = $keys;
                    $attributearr1['att_name'] = $keysdata['name'];
                    $attributearr1['attr_type'] = $keysdata['attr_type_id_multi'];
                    $attributearr1['attr_type_name'] = $keysdata['attr_type_name_multi'];
                    $attributearr1['validation'] = $keysdata['is_required'];
                    foreach ($keysdata['attribute_value'] as $valm => $valuesmdata) {
                        $valuearr[] = array(
                            'id' => $valm,
                            'name' => $valuesmdata,
                        );
                    }
                    $attributearr1['value'] = $valuearr;
                    if (!empty($keysdata['pivot']) || !empty($keysdata['selected'])) {
                        $attributearr1['selectedvalue'] = implode(',', $keysdata['selected']);
                    } else {
                        $attributearr1['selectedvalue'] = "";
                    }

                    unset($valuearr);
                    $attributearrMulti[] = $attributearr1;
                }
            }

            if (!empty($attributearrMulti)) {

                $attributearrMain1 = array_merge_recursive($attributearrMain, $attributearrMulti);
            } else {
                $attributearrMain1 = $attributearrMain;
            }
            $result = $result->toarray();
            $result['classified_attribute'] = $attributearrMain1;
            $resultedit['status'] = 1;
            $resultedit['data'] = $result;
            $resultedit['show_static_attributes'] = $staticattribute;
            echo json_encode($resultedit);
            die;
        } else {

            $resultedit['status'] = 0;
            $resultedit['msg'] = 'Invalid Details.';
            echo json_encode($resultedit);
            die;
        }
    }

    /**
     *  updateapi
     * updateapi classifieds 
     *
     * @return response
     * @access public
     */
    public function updateapi(Request $request) {
        if ($request->isMethod('post')) {
            $requestArr = Input::all();
            $id = $request->id;
            if (!empty($id)) {
                if ($request->all()['attributes']) {
                    $attributesarr = json_decode($request->all()['attributes']);
                } else {
                    $attributesarr = array();
                }
                $subregions_id = $request->subregions_id;
                $state_name = $request->state_id;
                $lat = $request->lat;
                $lng = $request->lng;
                if (!empty($subregions_id)) {
                    $row = \DB::table('cities')->where("City", '=', $subregions_id)->first();
                    if (!empty($row)) {
                        $city_id = $row->CityId;
                    } else {
                        $attachmentData = array('City' => $subregions_id, 'Latitude' => $lat, 'Longitude' => $lng);
                        $insertcityid = \DB::table('cities')->insertGetId($attachmentData);
                        $city_id = $insertcityid;
                    }
                }
                $state_name = $request->state_id;
                if (!empty($state_name)) {
                    $state_idarr = DB::table('state')->where('name', $state_name)->select('id', 'name')->first();
                    $statesid = $state_idarr->id;
                } else {
                    $statesid = 0;
                }

                $saved_image = $this->model->where('id', '=', $id)->with('classified_image')->first();
                $exceptFields = ['_token', 'attr_type_name', 'attr_type_id', 'attr_value', 'attr_ids', 'parent_value_id', 'parent_attribute_id', 'image', 'attr_ids_multi',
                    'attr_value_multi', 'attr_type_id_multi', 'attr_type_name_multi', 'attr_type_name_file', 'attr_type_id_file',
                    'attr_ids_file', 'attr_value_file_old', 'attr_value_file', 'hour', 'minute', 'meridian', 'attr_type_name_video',
                    'attr_type_id_video', 'attr_ids_video', 'attr_value_video_old', 'attr_value_video',
                    'attr_ids_radio', 'attr_value_radio', 'attr_type_id_radio', 'attr_type_name_radio', 'attr_type_name_image',
                    'attr_type_name_image', 'attr_type_id_image', 'attr_ids_image', 'attr_value_image_old', 'attr_value_image', 'withCommunty', 'city', 'attributes', 'image0', 'image1', 'image2', 'image3',
                    'image4', 'image5', 'image6', 'image7'];
                $data = $this->model->findOrFail($requestArr['id']);
                foreach ($requestArr as $key => $value) {
                    if (!in_array($key, $exceptFields)) {
                        $data->$key = $value;
                    }
                }

                if (isset($request->category_id) && $request->category_id == '') {
                    $data->category_id = 0;
                }

                if (isset($statesid)) {
                    $data->state_id = $statesid;
                }
                if (isset($city_id)) {
                    $data->city_id = $city_id;
                }

                if (isset($request->subregions_id) && $request->subregions_id == '') {
                    $data->subregions_id = 0;
                }

                if (!isset($request->featured_classified) && $request->featured_classified != 1) {
                    $data->featured_classified = 0;
                }

                if (isset($request->start_date) && $request->start_date != '') {
                    $request->start_date = new \DateTime($request->start_date);
                    $data->start_date = date_format($request->start_date, 'Y-m-d');
                } else {
                    $data->start_date = date("Y-m-d");
                }


                if (isset($request->end_date) && $request->end_date != '') {
                    $request->end_date = new \DateTime($request->end_date);
                    $data->end_date = date_format($request->end_date, 'Y-m-d');
                } else {
                    if ($data->featured_classified == 0) {
                        $data->end_date = date("Y-m-d", strtotime($data->start_date . "+" . Redis::get('Unfeature-Classified-Day') . " day"));
                    } else {
                        $data->end_date = date("Y-m-d", strtotime($data->start_date . "+" . Redis::get('Feature-Classified-Day') . " day"));
                    }
                }
                if (isset($request->withCommunty) && $request->withCommunty == 1) {
                    $data->end_date = '9999-01-01';
                }
                if (isset($request->withCommunty) && $request->withCommunty == 1) {
                    $data->price = 0;
                }
                if (isset($request->description)) {
                    $data->description = $request->description;
                }

                $data->status = 2;
                $extra1 = [];
                $extra2 = [];
                $extra3 = [];
                $extra4 = [];
                $dataExtra = [];

                if (!empty($attributesarr)) {

                    foreach ($attributesarr as $key => $value) {
                        if ($value->attr_type_id == 5) {
                            if (!empty($value->attr_value)) {
                                $valuearr = explode(',', $value->attr_value);
                                foreach ($valuearr as $keys => $values) {
                                    $extra1[$values] = array(
                                        'attribute_id' => $key,
                                        'attr_type_name' => $value->attr_type_name,
                                        'attr_type_id' => $value->attr_type_id,
                                        'attr_value' => $values,
                                    );
                                }
                            }
                            unset($attributesarr->$key);
                        }

                        //for Radio
                        if ($value->attr_type_id == 7) {
                            $extra2[$value->attr_value] = array(
                                'attribute_id' => $key,
                                'attr_type_name' => $value->attr_type_name,
                                'attr_type_id' => $value->attr_type_id,
                                'attr_value' => $value->attr_value,
                            );
                            unset($attributesarr->$key);
                        }
                        $attributes[$key] = array(
                            'attr_type_name' => $value->attr_type_name,
                            'attr_type_id' => $value->attr_type_id,
                            'attr_value' => $value->attr_value,
                            'parent_value_id' => $value->parent_value_id,
                            'attr_type_name' => $value->parent_attribute_id,
                        );
                    }
                    $extra1 = $extra1 + $extra2;
                }

                $classified = $data->save();
                if (!empty($attributesarr)) {
                    $attributesarr = json_decode(json_encode($attributesarr), TRUE);
                    $data->classified_attribute()->sync($attributesarr);

                    foreach ($attributesarr as $k2 => $v2) {
                        if ($v2['attr_value'] == '' || $v2['attr_value'] == 'on') {
                            DB::table('attribute_classified')->where('classified_id', '=', $requestArr['id'])->where('attribute_id', '=', $k2)->delete();
                        }
                    }
                }

                DB::table('attribute_classified')->where('classified_id', '=', $requestArr['id'])->where('attr_type_name', '=', 'Multi-Select')->delete();
                DB::table('attribute_classified')->where('classified_id', '=', $requestArr['id'])->where('attr_type_name', '=', 'Radio-button')->delete();
                if (!empty($extra1)) {
                    foreach ($extra1 as $ke => $val) {
                        $val['classified_id'] = $requestArr['id'];
                        \DB::table('attribute_classified')->insert($val);
                    }
                }
                $lastinstertid = $requestArr['id'];
//                    
                if ($lastinstertid) {
                    if (Input::file()) {

                        $image = Input::file();
                        $attachmentData = array();
                        if (!is_dir('upload_images/classified/' . $lastinstertid)) {
                            File::makeDirectory('upload_images/classified/' . $lastinstertid, 0777, true);
                        }
                        if (!is_dir('upload_images/classified/30px/' . $lastinstertid)) {
                            File::makeDirectory('upload_images/classified/30px/' . $lastinstertid, 0777, true);
                        }
                        if (!is_dir('upload_images/classified/950x530px/' . $lastinstertid)) {
                            File::makeDirectory('upload_images/classified/950x530px/' . $lastinstertid, 0777, true);
                        }
                        if (!is_dir('upload_images/classified/285x217px/' . $lastinstertid)) {
                            File::makeDirectory('upload_images/classified/285x217px/' . $lastinstertid, 0777, true);
                        }

                        foreach ($image as $key => $val) {

                            $destinationPath = 'upload_images/classified/' . $lastinstertid . '/';

                            $destinationPaththumb = 'upload_images/classified/30px/' . $lastinstertid . '/';
                            $destinationPaththumb1 = 'upload_images/classified/950x530px/' . $lastinstertid . '/';
                            $destinationPaththumb285x217px = 'upload_images/classified/285x217px/' . $lastinstertid . '/';
                            $extension = $val->getClientOriginalExtension();
                            $ran = rand(11111, 99999);
                            $fileName = $ran . '.' . $extension;

                            $val->move($destinationPath, $fileName);
                            image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                            image1::make($destinationPath . $fileName)->resize(950, 530)->save($destinationPaththumb1 . $fileName);
                            image1::make($destinationPath . $fileName)->resize(285, 217)->save($destinationPaththumb285x217px . $fileName);
                            $attachmentData[] = array('classified_id' => $lastinstertid, 'name' => $fileName);
                        }
                        \DB::table('classifiedimage')->insert($attachmentData);
                    }

//For ImagesGallery attribute value
                }
                $result['status'] = 1;
                $result['msg'] = 'Classified edit successfully.';

                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Invalid Details.';
                echo json_encode($result);
                die;
            }
        }
    }

    /**
     *  front classifieds food_list
     * update food_list 
     *
     * @return void
     * @access public
     */
    public function food_list(Request $request, $id = null) {
        $id = $request->id;

        $userObj = new User;
        $statemodel = new State;
        $this->model = new FoodProduct;
        $times = $inputs = $states = $suburbs = $near_mosques = array();
        $inputs = $requestArr = Input::all();
        $sortVar = array("field" => "id", "sort" => "desc", "val" => "most_recent");
        $conditions = array(
            array('food_products.status', '=', 1),
        );
        if (!empty($id)) {
            $task = new Category;
            $BelongsToCommunities = $task->pluck('pid', 'id')->toArray();
            $isParent = null;
            $show_static_attributes = $task->select('id', 'show_static_attributes')->where('id', '=', $id)->first();
            $categorieName = new Category;
            $cat_name = $categorieName->where('id', '=', $id)->first();

            $conditions[] = array('categories.id', '=', $id);


            $data = $this->model
                    ->selectRaw('categories.id,food_products.id as food_products_id ,food_products.name as title,food_products.description as description,food_products.image as image, food_products.created_at as food_products_created,categories.name as catname,categories.show_static_attributes as show_static_attributes')
                    ->leftJoin('categories', function($join) use ($isParent) {

                        $join->on('food_products.category_id', '=', 'categories.id');
                    })
                    ->leftJoin('attribute_classified', 'food_products.id', '=', 'attribute_classified.food_product_id')
                    ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                    ->where($conditions);

            if (!empty($requestArr)) {

                if (!empty($requestArr['keyword'])) {
                    $data = $data->where('food_products.name', 'LIKE', '%' . $requestArr['keyword'] . '%');
                }


                if (isset($requestArr['dynamicattr'])) {
                    $darray = array_filter($requestArr['dynamicattr'], function($value) {
                        return $value !== '';
                    });
                }

                if (!empty($darray)) {
                    $darray = array_values($darray);
                    $darraycount = count($darray);
                    if ($darraycount == 1) {
                        $dcodearrays = json_decode($darray[0], true);
                        $lists = array();
                        if ($dcodearrays == 0) {
                            $data = $data->where('food_products.id', '=', 0);
                        } else {
                            foreach ($dcodearrays as $keys => $values) {
                                if (!empty($keys)) {
                                    if (isset($requestArr['textattr']) && !empty($requestArr['textattr'])) {

                                        foreach ($requestArr['textattr'] as $textattrKey => $textattrVal) {
                                            $txtAttrArr = (array) json_decode($textattrVal);
                                            foreach ($txtAttrArr as $txtAttrArrKey => $txtAttrArrVal) {
                                                if ($txtAttrArrKey == $keys) {
                                                    $txtAttrValArr = (array) $txtAttrArrVal;
                                                    foreach ($txtAttrValArr as $txtAttrValArrKey => $txtAttrValArrVal) {
                                                        if ($txtAttrValArrKey == $values[0]) {
                                                            $valuesArr = array();
                                                            $data = $data->whereIn('food_products.id', $txtAttrValArrVal);
                                                        }
                                                    }
                                                } else {
                                                    $valuesarr = implode(',', $values);
                                                    $charray = explode(',', $valuesarr);
                                                    $data = $data->whereIn('food_products.id', $charray);
                                                }
                                            }
                                        }
                                    } else {
                                        $valuesarr = implode(',', $values);
                                        $charray = explode(',', $valuesarr);
                                        $data = $data->whereIn('food_products.id', $charray);
                                    }
                                }
                            }
                        }
                    } else {
                        foreach ($darray as $keya => $valuea) {
                            $list = array();
                            $dcodearray = json_decode($valuea, true);
                            foreach ($dcodearray as $keyb => $valueb) {
                                if (isset($requestArr['textattr']) && !empty($requestArr['textattr'])) {
                                    foreach ($requestArr['textattr'] as $textattrKey => $textattrVal) {
                                        $txtAttrArr = (array) json_decode($textattrVal);

                                        foreach ($txtAttrArr as $txtAttrArrKey => $txtAttrArrVal) {
                                            if ($txtAttrArrKey == $keyb) {
                                                $txtAttrValArr = (array) $txtAttrArrVal;
                                                foreach ($txtAttrValArr as $txtAttrValArrKey => $txtAttrValArrVal) {
                                                    if ($txtAttrValArrKey == $valueb[0]) {
                                                        $values[$keyb] = $txtAttrValArrVal;
                                                    }
                                                }
                                            } else {
                                                $values[$keyb] = $valueb;
                                            }
                                        }
                                    }
                                }

                                $values[$keyb] = $valueb;
                            }

                            $list[] = $values;
                        }
                        $intersect = call_user_func_array('array_intersect', $list[0]);
                        if (!empty($intersect) && (count($intersect) > 0)) {
                            $data = $data->whereIn('food_products.id', $intersect);
                        } else {
                            $data = $data->where('food_products.id', '=', 0);
                        }
                    }
                }
                if (isset($requestArr['sort'])) {
                    if ($requestArr['sort'] == "most_recent") {
                        $sortVar["field"] = "id";
                        $sortVar["sort"] = "desc";
                        $sortVar["val"] = "most_recent";
                    }
                    if ($requestArr['sort'] == "title_asc") {
                        $sortVar["field"] = "name";
                        $sortVar["sort"] = "asc";
                        $sortVar["val"] = "title_asc";
                    }
                    if ($requestArr['sort'] == "title_desc") {
                        $sortVar["field"] = "name";
                        $sortVar["sort"] = "desc";
                        $sortVar["val"] = "title_desc";
                    }
                }
            }


            $data = $data->groupBy('food_products.id')
                    ->orderBy('food_products.' . $sortVar['field'], $sortVar['sort'])
                    ->paginate(9);
        }

        $current_date = date("Y-m-d");
        //get the advertisements to show at front
        $top_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 3,
                            "banner_position" => "top",
                            "status" => 1,
                            "category_id" => $id
                        ])
                        ->orderBy('order_no', 'ASC')->get();
        $right_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 3,
                            "banner_position" => "right",
                            "status" => 1,
                            "category_id" => $id
                        ])
                        ->orderBy('order_no', 'ASC')->get();
        $bottom_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 3,
                            "banner_position" => "bottom",
                            "status" => 1,
                            "category_id" => $id
                        ])
                        ->orderBy('order_no', 'ASC')->get();

        $default_top_position_ad = \DB::table('advertisements')->where("page_id", "=", 3)->where("banner_position", "=", "top")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_right_position_ad = \DB::table('advertisements')->where("page_id", "=", 3)->where("banner_position", "=", "right")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_bottom_position_ad = \DB::table('advertisements')->where("page_id", "=", 3)->where("banner_position", "=", "bottom")->where("is_default", "=", 1)->where("status", "=", 1)->first();

        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        $states = \DB::table('state')->where(['country_id' => 14])->pluck('name', 'id')->all();
        //for dynamic category
        $cur_date = date('Y-m-d');
        $conditions1 = array();
        if (!empty($id)) {

            $conditions1[] = array('categories.id', '=', $id);
        }




        $result = $this->model
                ->selectRaw('categories.id,food_products.id as food_products_id ,food_products.name as title,food_products.description as description,food_products.image as image,categories.name as catname')
                ->leftJoin('categories', function($join) use ($isParent) {

                    $join->on('food_products.category_id', '=', 'categories.id');
                })
                ->leftJoin('attribute_classified', 'food_products.id', '=', 'attribute_classified.food_product_id')
                ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                ->where($conditions1);
        $result = $result->groupBy('food_products.id')
                ->get();

        $resultNew['data'] = $result->toarray();
        foreach ($resultNew['data'] as $key => $value) {
            $multiattribute1 = $this->model->where('id', '=', $value['food_products_id'])->with(['food_product_attribute' => function ($query) {
                            $query->select("attribute_id", 'food_product_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')
                                    ->where('attributes.status', '=', 1)
                            ;
                        }])->first()->toarray();
            $resultNew['data'][$key]['food_product_attribute'] = $multiattribute1['food_product_attribute'];
        }

        $allattributearr = array();
        foreach ($resultNew['data'] as $key => $value) {

            if (!empty($value['food_product_attribute'])) {
                foreach ($value['food_product_attribute'] as $in => $val) {

                    if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                        $resultNew['data'][$key]['food_product_attribute'][$in]['selected'][] = $val['attr_value'];
                        $resultNew['data'][$key]['food_product_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] == 0) {

                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                        $resultNew['data'][$key]['food_product_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] != 0) {
                        $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $val['attribute_id'])->where('attribute_value_id', $val['parent_value_id'])->pluck('attribute_value', 'id');
                        $resultNew['data'][$key]['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if (($val['attr_type_name'] == 'calendar') && (strpos($val['attr_value'], ';'))) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                        $resultNew['data'][$key]['food_product_attribute'][$in]['selected'][] = $val['attr_value'];
                        $resultNew['data'][$key]['food_product_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if (($val['attr_type_name'] == 'Numeric') && (strpos($val['attr_value'], ';'))) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                        $resultNew['data'][$key]['food_product_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if (($val['attr_type_name'] == 'Date') && (strpos($val['attr_value'], ';'))) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                        $resultNew['data'][$key]['food_product_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if (($val['attr_type_name'] == 'Time') && (strpos($val['attr_value'], ';'))) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                        $resultNew['data'][$key]['food_product_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else if (($val['attr_type_name'] == 'text')) {
                        $attr_AllValues = $val['attr_value'];

                        $resultNew['data'][$key]['food_product_attribute'][$in]['attribute_value'] = $attr_AllValues;
                        $val['attr_AllValues'] = $attr_AllValues;
                    } else {
                        unset($val);
                    }

                    if (isset($val) && !empty($val)) {
                        $allattributearr[$val['attr_type_name']][] = $val;
                    }
                }
            }
        }

        if (isset($allattributearr) && !empty($allattributearr)) {
            foreach ($allattributearr as $key => $value) {
                $stor_valueArray = [];
                $stor_valueArrayDate = [];
                foreach ($value as $k => $val) {

                    if ($key == 'Date') {

                        $newAttrArr[$key][] = $val;
                    } else {
                        if (!in_array($val['attr_value'], $stor_valueArray)) {

                            $stor_valueArray[] = $val['attr_value'];
                            $newAttrArr[$key][] = $val;
                        }
                    }
                    $newAttrArrForValue[$val['attr_value']][] = $val['food_product_id'];
                }
            }
        }


        if (!empty($newAttrArr)) {


            foreach ($newAttrArr as $key => $value) {
                $stor_valueArray1 = [];
                foreach ($value as $k => $val) {

                    if (!in_array($val['attribute_id'], $stor_valueArray1)) {
                        $stor_valueArray1[] = $val['attribute_id'];
                        $newAttrArr1[$key][$val['name']][] = $val;
                    } else {
                        $newAttrArr1[$key][$val['name']][] = $val;
                    }
                }
            }
        }

        $wishlistItems = array();
        if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
            $wishlistObj = new Wishlist;
            $wishlistItems = $wishlistObj->where('user_id', '=', Auth::guard('web')->user()->id)->pluck("classified_id", "id")->all();
        } elseif (Cookie::get('wishlistItems')) {
            $wishlistItems = Cookie::get('wishlistItems');
        }

        return view('front.classifieds.foodlisting', compact('top_positions_ads', 'right_positions_ads', 'bottom_positions_ads', 'default_top_position_ad', 'default_right_position_ad', 'default_bottom_position_ad', 'allSubCategories', 'prayer_timings', 'times', 'mosqueData', 'states', 'allComCategories', 'allSubCategoriesForMenu', 'sortVar', 'dataAttr', 'data', 'newAttrArr1', 'newAttrArrForValue', 'show_static_attributes', 'id', 'staterestult', 'wishlistItems'))->with('inputs', $inputs)->with('suburbs', $suburbs)->with('category_name', $cat_name->name);
    }

    /**
     *  front classifieds classified_list
     * update classified_list 
     *
     * @return void
     * @access public
     */
    public function classified_list(Request $request, $id = null) {
        $id = $request->id;

        $userObj = new User;
        $statemodel = new State;
        $times = $inputs = $states = $suburbs = $near_mosques = array();
        $inputs = $requestArr = Input::all();
        $sortVar = array("field" => "id", "sort" => "desc", "val" => "most_recent");
        $conditions = array(
            array('classifieds.status', '=', 1),
        );
        if (!empty($id)) {
            $task = new Category;
            $BelongsToCommunities = $task->pluck('pid', 'id')->toArray();
            $isParent = null;
            $show_static_attributes = $task->select('id', 'show_static_attributes')->where('id', '=', $id)->first();
            $categorieName = new Category;
            $cat_name = $categorieName->where('id', '=', $id)->first();
            $staterestult = $statemodel->getCategoriesWithClassifiedCount($id);

            $isParent = $BelongsToCommunities[$id] == 0 ? true : false;
            if ($isParent) {
                $conditions[] = array('classifieds.parent_categoryid', '=', $id);
            } else {
                $conditions[] = array('categories.id', '=', $id);
            }

            $data = $this->model
                    ->selectRaw('categories.id,classifieds.id as classified_id ,classifieds.title as title,classifieds.description as description,classifiedimage.name as name,classifieds.price,categories.name as catname,classifieds.location as location, classifieds.lat as lat, classifieds.lng as lng, categories.show_static_attributes as show_static_attributes')
                    ->leftJoin('categories', function($join) use ($isParent) {
                        if ($isParent) {
                            $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                        } else {
                            $join->on('classifieds.category_id', '=', 'categories.id');
                        }
                    })
                    ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                    ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                    ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                    ->where($conditions);

            if (!empty($requestArr)) {

                if (!empty($requestArr['keyword'])) {
                    $data = $data->where('classifieds.title', 'LIKE', '%' . $requestArr['keyword'] . '%');
                }

                if (isset($requestArr['state'])) {
                    if (!empty($requestArr['state'])) {
                        $data = $data->where(['classifieds.state_id' => $requestArr['state']]);
                        if (!empty($requestArr['suburb'])) {
                            $data = $data->where(['classifieds.city_id' => $requestArr['suburb']]);

                            $suburbs = \DB::table('cities')->where('RegionID', '=', $requestArr['state'])->pluck("City", "CityId");
                        }
                    }
                }

                if (isset($requestArr['dynamicattr'])) {
                    $darray = array_filter($requestArr['dynamicattr'], function($value) {
                        return $value !== '';
                    });
                }

                if (!empty($darray)) {
                    $darray = array_values($darray);
                    $darraycount = count($darray);
                    if ($darraycount == 1) {
                        $dcodearrays = json_decode($darray[0], true);
                        $lists = array();
                        if ($dcodearrays == 0) {
                            $data = $data->where('classifieds.id', '=', 0);
                        } else {
                            foreach ($dcodearrays as $keys => $values) {
                                if (!empty($keys)) {
                                    if (isset($requestArr['textattr']) && !empty($requestArr['textattr'])) {

                                        foreach ($requestArr['textattr'] as $textattrKey => $textattrVal) {
                                            $txtAttrArr = (array) json_decode($textattrVal);
                                            foreach ($txtAttrArr as $txtAttrArrKey => $txtAttrArrVal) {
                                                if ($txtAttrArrKey == $keys) {
                                                    $txtAttrValArr = (array) $txtAttrArrVal;
                                                    foreach ($txtAttrValArr as $txtAttrValArrKey => $txtAttrValArrVal) {
                                                        if ($txtAttrValArrKey == $values[0]) {
                                                            $valuesArr = array();
                                                            $data = $data->whereIn('classifieds.id', $txtAttrValArrVal);
                                                        }
                                                    }
                                                } else {
                                                    $valuesarr = implode(',', $values);
                                                    $charray = explode(',', $valuesarr);
                                                    $data = $data->whereIn('classifieds.id', $charray);
                                                }
                                            }
                                        }
                                    } else {
                                        $valuesarr = implode(',', $values);
                                        $charray = explode(',', $valuesarr);
                                        $data = $data->whereIn('classifieds.id', $charray);
                                    }
                                }
                            }
                        }
                    } else {
                        foreach ($darray as $keya => $valuea) {
                            $list = array();
                            $dcodearray = json_decode($valuea, true);
                            foreach ($dcodearray as $keyb => $valueb) {
                                if (isset($requestArr['textattr']) && !empty($requestArr['textattr'])) {
                                    foreach ($requestArr['textattr'] as $textattrKey => $textattrVal) {
                                        $txtAttrArr = (array) json_decode($textattrVal);

                                        foreach ($txtAttrArr as $txtAttrArrKey => $txtAttrArrVal) {
                                            if ($txtAttrArrKey == $keyb) {
                                                $txtAttrValArr = (array) $txtAttrArrVal;
                                                foreach ($txtAttrValArr as $txtAttrValArrKey => $txtAttrValArrVal) {
                                                    if ($txtAttrValArrKey == $valueb[0]) {
                                                        $values[$keyb] = $txtAttrValArrVal;
                                                    }
                                                }
                                            } else {
                                                $values[$keyb] = $valueb;
                                            }
                                        }
                                    }
                                }

                                $values[$keyb] = $valueb;
                            }

                            $list[] = $values;
                        }
                        $intersect = call_user_func_array('array_intersect', $list[0]);
                        if (!empty($intersect) && (count($intersect) > 0)) {
                            $data = $data->whereIn('classifieds.id', $intersect);
                        } else {
                            $data = $data->where('classifieds.id', '=', 0);
                        }
                    }
                }
                if (isset($requestArr['sort'])) {
                    if ($requestArr['sort'] == "most_recent") {
                        $sortVar["field"] = "id";
                        $sortVar["sort"] = "desc";
                        $sortVar["val"] = "most_recent";
                    }
                    if ($requestArr['sort'] == "title_asc") {
                        $sortVar["field"] = "title";
                        $sortVar["sort"] = "asc";
                        $sortVar["val"] = "title_asc";
                    }
                    if ($requestArr['sort'] == "title_desc") {
                        $sortVar["field"] = "title";
                        $sortVar["sort"] = "desc";
                        $sortVar["val"] = "title_desc";
                    }
                }
            }


            $data = $data->groupBy('classifieds.id')
                    ->orderBy('classifieds.' . $sortVar['field'], $sortVar['sort'])
                    ->paginate(9);
        }

        $current_date = date("Y-m-d");
        $top_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 3,
                            "banner_position" => "top",
                            "status" => 1,
                            "category_id" => $id
                        ])
                        ->orderBy('order_no', 'ASC')->get();
        $right_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 3,
                            "banner_position" => "right",
                            "status" => 1,
                            "category_id" => $id
                        ])
                        ->orderBy('order_no', 'ASC')->get();
        $bottom_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 3,
                            "banner_position" => "bottom",
                            "status" => 1,
                            "category_id" => $id
                        ])
                        ->orderBy('order_no', 'ASC')->get();

        $default_top_position_ad = \DB::table('advertisements')->where("page_id", "=", 3)->where("banner_position", "=", "top")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_right_position_ad = \DB::table('advertisements')->where("page_id", "=", 3)->where("banner_position", "=", "right")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_bottom_position_ad = \DB::table('advertisements')->where("page_id", "=", 3)->where("banner_position", "=", "bottom")->where("is_default", "=", 1)->where("status", "=", 1)->first();

        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        $states = \DB::table('state')->where(['country_id' => 14])->pluck('name', 'id')->all();
        //for dynamic category
        $cur_date = date('Y-m-d');
        $conditions1 = array();
        if (!empty($id)) {
            $isParent = $BelongsToCommunities[$id] == 0 ? true : false;
            if ($isParent) {
                $conditions1[] = array('classifieds.parent_categoryid', '=', $id);
            } else {
                $conditions1[] = array('categories.id', '=', $id);
            }
        }


        $result = $this->model
                ->selectRaw('categories.id,classifieds.id as classified_id ,classifieds.title as title,classifieds.description as description,classifiedimage.name as name,classifieds.price, classifieds.lat as lat, classifieds.lng as lng, categories.name as catname,classifieds.location as location')
                ->leftJoin('categories', function($join) use ($isParent) {
                    if ($isParent) {
                        $join->on('classifieds.parent_categoryid', '=', 'categories.id');
                    } else {
                        $join->on('classifieds.category_id', '=', 'categories.id');
                    }
                })
                ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                ->leftJoin('attribute_classified', 'classifieds.id', '=', 'attribute_classified.classified_id')
                ->leftJoin('attributes', 'attribute_classified.attribute_id', '=', 'attributes.id')
                ->where($conditions1);
        $result = $result->groupBy('classifieds.id')
                ->get();

        $resultNew['data'] = $result->toarray();
        foreach ($resultNew['data'] as $key => $value) {
            $multiattribute1 = $this->model->where('id', '=', $value['classified_id'])->with(['classified_attribute' => function ($query) {
                            $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')
                                    ->where('attributes.status', '=', 1)
                            ;
                        }])->first()->toarray();

            $resultNew['data'][$key]['classified_attribute'] = $multiattribute1['classified_attribute'];
        }

        $allattributearr = array();
        foreach ($resultNew['data'] as $key => $value) {

            if (!empty($value['classified_attribute'])) {
                foreach ($value['classified_attribute'] as $in => $val) {

                    if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                        $resultNew['data'][$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                        $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] == 0) {

                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                        $resultNew['data'][$key]['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] != 0) {
                        $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $val['attribute_id'])->where('attribute_value_id', $val['parent_value_id'])->pluck('attribute_value', 'id');
                        $resultNew['data'][$key]['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if (($val['attr_type_name'] == 'calendar') && (strpos($val['attr_value'], ';'))) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                        $resultNew['data'][$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                        $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if (($val['attr_type_name'] == 'Numeric') && (strpos($val['attr_value'], ';'))) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                        $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if (($val['attr_type_name'] == 'Date') && (strpos($val['attr_value'], ';'))) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                        $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if (($val['attr_type_name'] == 'Time') && (strpos($val['attr_value'], ';'))) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                        $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else if (($val['attr_type_name'] == 'text')) {
                        $attr_AllValues = $val['attr_value'];

                        $resultNew['data'][$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues;
                        $val['attr_AllValues'] = $attr_AllValues;
                    } else {
                        unset($val);
                    }

                    if (isset($val) && !empty($val)) {
                        $allattributearr[$val['attr_type_name']][] = $val;
                    }
                }
            }
        }

        if (isset($allattributearr) && !empty($allattributearr)) {
            foreach ($allattributearr as $key => $value) {
                $stor_valueArray = [];
                $stor_valueArrayDate = [];
                foreach ($value as $k => $val) {

                    if ($key == 'Date') {

                        $newAttrArr[$key][] = $val;
                    } else {
                        if (!in_array($val['attr_value'], $stor_valueArray)) {

                            $stor_valueArray[] = $val['attr_value'];
                            $newAttrArr[$key][] = $val;
                        }
                    }
                    $newAttrArrForValue[$val['attr_value']][] = $val['classified_id'];
                }
            }
        }


        if (!empty($newAttrArr)) {


            foreach ($newAttrArr as $key => $value) {
                $stor_valueArray1 = [];
                foreach ($value as $k => $val) {

                    if (!in_array($val['attribute_id'], $stor_valueArray1)) {
                        $stor_valueArray1[] = $val['attribute_id'];
                        $newAttrArr1[$key][$val['name']][] = $val;
                    } else {
                        $newAttrArr1[$key][$val['name']][] = $val;
                    }
                }
            }
        }

        $wishlistItems = array();
        if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
            $wishlistObj = new Wishlist;
            $wishlistItems = $wishlistObj->where('user_id', '=', Auth::guard('web')->user()->id)->pluck("classified_id", "id")->all();
        } elseif (Cookie::get('wishlistItems')) {
            $wishlistItems = Cookie::get('wishlistItems');
        }

        return view('front.classifieds.listing', compact('top_positions_ads', 'right_positions_ads', 'bottom_positions_ads', 'default_top_position_ad', 'default_right_position_ad', 'default_bottom_position_ad', 'allSubCategories', 'prayer_timings', 'times', 'mosqueData', 'states', 'allComCategories', 'allSubCategoriesForMenu', 'sortVar', 'dataAttr', 'data', 'newAttrArr1', 'newAttrArrForValue', 'show_static_attributes', 'id', 'staterestult', 'wishlistItems'))->with('inputs', $inputs)->with('suburbs', $suburbs)->with('category_name', $cat_name->name);
    }

    /**
     *  front classifieds food_detail
     * update food_detail 
     *
     * @return void
     * @access public
     */
    public function food_detail(Request $request) {
        $id = $request->id;

        $this->model = new FoodProduct;

        $userObj = new User;

        $actionName = $this->actionName;
        $controllerName = $this->controllerName;

        $times = $inputs = $states = $cities = $headData = array();
        $current_date = date("Y-m-d");

        if (!empty($id)) {
            $data = $this->model->where('id', '=', $id)->with(['food_product_attribute' => function ($query) {
                            $query->select("attribute_id", 'food_product_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'display_name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id');
                        },
                            ]
                    )
                    ->first();
//************Show restricted Ingredients*********************************
            $ingredients_arr = explode(",", $data['ingredient']);
            $final_ingredient = array();
            foreach ($ingredients_arr as $key => $value) {

                $restric_AllValues = DB::table('restricted_ingredients')->where('name', $value)->select('name', 'certification')->get()->toArray();

                if (count($restric_AllValues) > 0) {
                    $rescertification = $restric_AllValues[0]->certification;
                    $final_ingredient[] = ['ingredient' => $value, 'certiificate' => $rescertification];
                } else {
                    $final_ingredient[] = ['ingredient' => $value, 'certiificate' => ''];
                }
            }

            $multi_select = [];
            if (!empty($data['food_product_attribute'])) {
                foreach ($data['food_product_attribute'] as $key => $value) {
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] == 0) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValues = $attr_AllValues->toArray();
                    }
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] != 0) {
                        $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $value['attribute_id'])->where('attribute_value_id', $value['parent_value_id'])->pluck('attribute_value', 'id');
                        $value->attr_AllValues = $attr_AllValues->toArray();
                    }
                    if ($value['attr_type_name'] == 'Numeric') {
                        $attr_AllValuesNumeric = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValuesNumeric = $attr_AllValuesNumeric->toarray();
                    }
                    if ($value['attr_type_name'] == 'calendar') {
                        $attr_AllValuesCalendar = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValuesNumeric = $attr_AllValuesCalendar->toarray();
                    }
                    if ($value['attr_type_name'] == 'Multi-Select' || $value['attr_type_name'] == 'Radio-button') {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $multi_select[$value['attribute_id']]['attr_ids_multi'] = $value['attribute_id'];
                        $multi_select[$value['attribute_id']]['attr_type_name_multi'] = $value['attr_type_name'];
                        $multi_select[$value['attribute_id']]['name'] = $value['name'];
                        $multi_select[$value['attribute_id']]['display_name'] = $value['display_name'];
                        $multi_select[$value['attribute_id']]['attr_type_id_multi'] = $value['attr_type_id'];
                        $multi_select[$value['attribute_id']]['selected'][] = $value['attr_value'];
                        $multi_select[$value['attribute_id']]['attribute_value'] = $attr_AllValues->toArray();
                    }
                }
            }
            if (isset($multi_select) && !empty($multi_select)) {
                $data->multi_select = $multi_select;
            }
        }

//get the advertisements to show at front
        $top_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 2)->where("banner_position", "=", "top")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();
        $right_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 2,
                            "banner_position" => "right",
                            "status" => 1,
                            "category_id" => $data->parent_categoryid
                        ])
                        ->orderBy('order_no', 'ASC')->get();

        $bottom_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 2,
                            "banner_position" => "bottom",
                            "status" => 1,
                            "category_id" => $data->parent_categoryid
                        ])
                        ->orderBy('order_no', 'ASC')->get();

        $default_top_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "top")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_right_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "right")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_bottom_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "bottom")->where("is_default", "=", 1)->where("status", "=", 1)->first();


        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        return view('front.classifieds.fooddetail', compact('top_positions_ads', 'right_positions_ads', 'bottom_positions_ads', 'default_top_position_ad', 'default_right_position_ad', 'default_bottom_position_ad', 'allSubCategories', 'prayer_timings', 'times', 'data', 'times', 'allComCategories', 'allSubCategoriesForMenu', 'actionName', 'controllerName', 'final_ingredient'));
    }

    /**
     *  front classifieds classified_detail
     * update classified_detail 
     *
     * @return void
     * @access public
     */
    public function classified_detail(Request $request) {
        $id = $request->id;

        $userObj = new User;

        $actionName = $this->actionName;
        $controllerName = $this->controllerName;

        $times = $inputs = $states = $cities = $headData = array();
        $current_date = date("Y-m-d");

        if (!empty($id)) {
            $data = $this->model->where('id', '=', $id)->with(['classified_attribute' => function ($query) {
                            $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'display_name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id');
                        }, 'classified_users' => function ($q1) {
                            $q1->select('id', 'name', 'email', 'role_id');
                        }, 'classified_image'
                            ]
                    )
                    ->first();

            $multi_select = [];
            if (!empty($data['classified_attribute'])) {
                foreach ($data['classified_attribute'] as $key => $value) {
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] == 0) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValues = $attr_AllValues->toArray();
                    }
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] != 0) {
                        $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $value['attribute_id'])->where('attribute_value_id', $value['parent_value_id'])->pluck('attribute_value', 'id');
                        $value->attr_AllValues = $attr_AllValues->toArray();
                    }
                    if ($value['attr_type_name'] == 'Numeric') {
                        $attr_AllValuesNumeric = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValuesNumeric = $attr_AllValuesNumeric->toarray();
                    }
                    if ($value['attr_type_name'] == 'calendar') {
                        $attr_AllValuesCalendar = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValuesNumeric = $attr_AllValuesCalendar->toarray();
                    }
                    if ($value['attr_type_name'] == 'Multi-Select' || $value['attr_type_name'] == 'Radio-button') {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $multi_select[$value['attribute_id']]['attr_ids_multi'] = $value['attribute_id'];
                        $multi_select[$value['attribute_id']]['attr_type_name_multi'] = $value['attr_type_name'];
                        $multi_select[$value['attribute_id']]['name'] = $value['name'];
                        $multi_select[$value['attribute_id']]['display_name'] = $value['display_name'];
                        $multi_select[$value['attribute_id']]['attr_type_id_multi'] = $value['attr_type_id'];
                        $multi_select[$value['attribute_id']]['selected'][] = $value['attr_value'];
                        $multi_select[$value['attribute_id']]['attribute_value'] = $attr_AllValues->toArray();
                    }
                }
            }
            if (isset($multi_select) && !empty($multi_select)) {
                $data->multi_select = $multi_select;
            }

            $default_pt = \DB::table('prayer_timings')->select('id', 'name')->where('status', '=', 1)->where('is_default', '=', 1)->first();
            $prayTime = new PrayTime($default_pt->id);
            $date = strtotime(date("M-d-Y"));
            $endDate = strtotime(date("M-d-Y"));
            $latitude = $data->lat;
            $longitude = $data->lat;
            while ($date <= $endDate) {
                $day = date('M d', $date);
                $times[] = $prayTime->getPrayerTimes($date, $latitude, $longitude, 'auto');
                $date += 24 * 60 * 60;  // next day
            }
        }

//get the advertisements to show at front
        $top_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 2)->where("banner_position", "=", "top")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();
        $right_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 2,
                            "banner_position" => "right",
                            "status" => 1,
                            "category_id" => $data->parent_categoryid
                        ])
                        ->orderBy('order_no', 'ASC')->get();

        $bottom_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 2,
                            "banner_position" => "bottom",
                            "status" => 1,
                            "category_id" => $data->parent_categoryid
                        ])
                        ->orderBy('order_no', 'ASC')->get();

        $default_top_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "top")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_right_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "right")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_bottom_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "bottom")->where("is_default", "=", 1)->where("status", "=", 1)->first();

        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        return view('front.classifieds.detail', compact('top_positions_ads', 'right_positions_ads', 'bottom_positions_ads', 'default_top_position_ad', 'default_right_position_ad', 'default_bottom_position_ad', 'allSubCategories', 'prayer_timings', 'times', 'data', 'times', 'allComCategories', 'allSubCategoriesForMenu', 'actionName', 'controllerName'));
    }

    /**
     *  front classifieds increase_count
     * increase_count classified 
     *
     * @return response
     * @access public
     */
    public function increase_count() {
        $data = Input::all();
        $this->model->whereId($data['classified_id'])->increment('count');
    }

    /**
     *  send_msg_api
     * send_msg_api classified 
     *
     * @return response
     * @access public
     */
    public function send_msg_api(Request $request) {
        $sender_id = $request->user_id;
        $receiver_id = $request->classifieduser_id;
        $classified_id = $request->classifiedid;
        $massagedata = $request->massage;
        $loginemail = $request->loginemail;
        $loginusername = $request->loginusername;


        if (!empty($sender_id) && !empty($receiver_id) && !empty($classified_id) && !empty($massagedata)) {
//                                            
            $dataArray = new Message;
            $dataArray->sender_id = $sender_id;
            $dataArray->receiver_id = $receiver_id;
            $dataArray->classified_id = $classified_id;
            $dataArray->massage = $massagedata;
            $dataArray->flag = 'user-message';
            $dataArray->subject = 'chat';

            $messagetype = 'chat';
            $resultdata = $dataArray->create($dataArray->toarray());

            if ($resultdata) {
                $result['status'] = 1;
                $result['msg'] = 'Message Sent Successfully';
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Message Not Sent';
                echo json_encode($result);
                die;
            }
        }
    }

    /**
     *  send_msg_apioffline
     * send_msg_apioffline classified 
     *
     * @return response
     * @access public
     */
    public function send_msg_apioffline(Request $request) {


        $sender_id = $request->user_id;
        $receiver_id = $request->classifieduser_id;
        $classified_id = $request->classifiedid;
        $massagedata = $request->massage;
        $loginemail = $request->loginemail;
        $loginusername = $request->loginusername;


        if (!empty($sender_id) && !empty($receiver_id) && !empty($classified_id) && !empty($massagedata)) {

//                                            
            $dataArray = new Message;
            $dataArray->sender_id = $sender_id;
            $dataArray->receiver_id = $receiver_id;
            $dataArray->classified_id = $classified_id;
            $dataArray->massage = $massagedata;
            $dataArray->flag = 'user-message';
            $dataArray->subject = 'User message';

            $messagetype = 'chat';
            $users = User::select('id', 'name', 'email', 'device_id', 'device_type')->where(['id' => $receiver_id])->first()->toarray();
            $senders = User::select('id', 'name', 'email', 'device_id', 'device_type', 'image', 'avatar')->where(['id' => $sender_id])->first()->toarray();

            $device_id = $users['device_id'];
            $type = $users['device_type'];
            $message = $massagedata;
            $sender_id = $sender_id;
            $classified_id = $classified_id;
            $receiver_id = $receiver_id;


            $chattype = 'chat';
            $sendername = $senders['name'];

            if ($senders['image']) {
                $imgurl = \URL::asset('upload_images/users/' . $senders['id'] . '/' . $senders['image']);
            } elseif ($senders['avatar']) {
                $imgurl = $senders['avatar'];
            } else {
                $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
            }
            if (!empty($users['device_id'])) {
                if ($type == 'Android') {
                    $this->simplePushNotificationA($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $messagetype, $sendername);
                } else {
                    $this->simplePushNotificationI($message, $device_id, $chattype, $sender_id, $classified_id, $receiver_id, $sendername, $type, $messagetype);
                }
            } else {
                $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $sendername, $messagetype, $imgurl);
            }
            if ($users['device_id']) {
                $result['status'] = 1;
                $result['msg'] = 'Message Sent Successfully offline';
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Message Not Sent';
                echo json_encode($result);
                die;
            }
        }
    }

    /**
     *  front send_msg_api_message
     * send_msg_api_message classified
     *
     * @return response
     * @access public
     */
    public function send_msg_api_message(Request $request) {

        $sender_id = $request->user_id;
        $receiver_id = $request->classifieduser_id;
        $classified_id = $request->classifiedid;
        $massagedata = $request->massage;
        $loginemail = $request->loginemail;
        $loginusername = $request->loginusername;


        if (!empty($sender_id) && !empty($receiver_id) && !empty($classified_id) && !empty($massagedata)) {
            $dataArray = new Message;
            $dataArray->sender_id = $sender_id;
            $dataArray->receiver_id = $receiver_id;
            $dataArray->classified_id = $classified_id;
            $dataArray->massage = $massagedata;
            $dataArray->flag = 'user-message';
            $dataArray->subject = 'User message';

            $messagetype = 'User message';
            $resultdata = $dataArray->create($dataArray->toarray());


            $users = User::select('id', 'name', 'email', 'device_id', 'device_type')->where(['id' => $receiver_id])->first()->toarray();
            $senders = User::select('id', 'name', 'email', 'device_id', 'device_type', 'image', 'avatar')->where(['id' => $sender_id])->first()->toarray();

            $device_id = $users['device_id'];
            $type = $users['device_type'];
            $message = $massagedata;
            $sender_id = $sender_id;
            $classified_id = $classified_id;
            $receiver_id = $receiver_id;
            $messagetype = 'user-message';


            $chattype = 'chat';
            $sendername = $senders['name'];

            if ($senders['image']) {
                $imgurl = \URL::asset('upload_images/users/' . $senders['id'] . '/' . $senders['image']);
            } elseif ($senders['avatar']) {
                $imgurl = $senders['avatar'];
            } else {
                $imgurl = \URL::asset('plugins/front/img/profile-img-new.jpg');
            }
            if (!empty($users['device_id'])) {
                if ($type == 'Android') {
                    $this->simplePushNotificationA($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $messagetype, $sendername);
                } else {
                    $this->simplePushNotificationI($message, $device_id, $chattype, $sender_id, $classified_id, $receiver_id, $sendername, $type, $messagetype);
                }
            } else {
                $this->simplePushNotificationW($message, $device_id, $type, $sender_id, $classified_id, $receiver_id, $sendername, $messagetype, $imgurl);
            }
            if ($resultdata) {
                $result['status'] = 1;
                $result['msg'] = 'Message Sent Successfully';
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Message Not Sent';
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

    public function job_apply_post(Request $request) {


        $actionName = $this->actionName;
        $viewName = 'job_apply';
        $controllerName = $this->controllerName;
        $this->model = new JobApply;

        if ($request->isMethod('POST')) {

            $this->validate($request, [
                'fname' => 'required',
                'applicant_email' => 'required',
            ]);

            $requestArr = Input::all();

            $exceptFields = ['_token', 'send-job-app', 'coverfile', 'resumefile', 'ans'];
            $data = new JobApply();
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, $exceptFields)) {
                    $data->$key = $value;
                }
            }

            $data->save();
            $lstcategoryid = $data->id;
            if ($lstcategoryid) {

                if (Input::file('coverfile')) {
                    $icon = Input::file('coverfile');

                    if (!is_dir('upload_images/jobs/coverletters/' . $data->id)) {
                        File::makeDirectory('upload_images/jobs/coverletters/' . $data->id, 0777, true);
                    }

                    $destinationPath = 'upload_images/jobs/coverletters/' . $data->id . '/';


                    $extension = $icon->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;

                    $icon->move($destinationPath, $fileName);


                    $data->cover_letter_file = $fileName;
                    $data->save();
                }

                if (Input::file('resumefile')) {
                    $image = Input::file('resumefile');
                    if (!is_dir('upload_images/jobs/resume/' . $data->id)) {
                        File::makeDirectory('upload_images/jobs/resume/' . $data->id, 0777, true);
                    }


                    $destinationPath = 'upload_images/jobs/resume/' . $data->id . '/';
                    $extension = $image->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $fileName = $ran . '.' . $extension;

                    $image->move($destinationPath, $fileName);
                    $data->resume_file = $fileName;
                    $data->save();
                }

                if (count($request->ans) > 0) {

                    foreach ($request->ans as $key => $value) {
                        $row = array(
                            'customer_id' => $request->customer_id,
                            'classified_id' => $request->classified_id,
                            'apply_job_id' => $lstcategoryid,
                            'question_id' => $key,
                            'answer' => $value
                        );
                        DB::table('apply_job_answer')->insert($row);
                    }
                }

                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Successfully submitted.');

                return Redirect::to('classifieds-job/job-apply/' . $request->classified_id);
            }
        }
    }

    /**
     *  front Job-apply
     * job_apply classified
     *
     * @return void
     * @access public
     */
    public function job_apply(Request $request) {
        //dd($id);  
        $id = $request->id;
        $current_date = date('Y-m-d');
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        $result = false;

        $getAllCommunInformCategorIDArray = array();

        if (isset($id)) {
            try {
                $result = $this->model->where('id', '=', $id)->with(['classified_hasmany_questions' => function($q4) {
                                $q4->with(['question_hasmany_options']);
                            }, 'classified_hasmany_other', 'classified_attribute' => function ($query) {
                                $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'display_name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'show_list', 'icon');
                            }, 'classified_users' => function ($q1) {
                                $q1->select('id', 'name', 'email', 'role_id');
                            }, 'classified_image'
                            , 'city' => function($q3) {
                                $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                            },
                        ])->first();

                $multi_select = [];
                foreach ($result['classified_attribute'] as $key => $value) {
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] == 0) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValues = $attr_AllValues->toArray();
                    }
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] != 0) {
                        $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $value['attribute_id'])->where('attribute_value_id', $value['parent_value_id'])->pluck('attribute_value', 'id');
                        $value->attr_AllValues = $attr_AllValues->toArray();
                    }
                    if ($value['attr_type_name'] == 'Numeric') {
                        $attr_AllValuesNumeric = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValuesNumeric = $attr_AllValuesNumeric->toarray();
                    }
                    if ($value['attr_type_name'] == 'calendar') {
                        $attr_AllValuesCalendar = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValuesNumeric = $attr_AllValuesCalendar->toarray();
                    }
                    if ($value['attr_type_name'] == 'Multi-Select' || $value['attr_type_name'] == 'Radio-button') {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $multi_select[$value['attribute_id']]['attr_ids_multi'] = $value['attribute_id'];
                        $multi_select[$value['attribute_id']]['attr_type_name_multi'] = $value['attr_type_name'];
                        $multi_select[$value['attribute_id']]['name'] = $value['name'];
                        $multi_select[$value['attribute_id']]['attr_type_id_multi'] = $value['attr_type_id'];
                        $multi_select[$value['attribute_id']]['selected'][] = $value['attr_value'];
                        $multi_select[$value['attribute_id']]['attribute_value'] = $attr_AllValues->toArray();
                    }
                }
                if (isset($multi_select) && !empty($multi_select)) {
                    $result->multi_select = $multi_select;
                }
            } catch (ModelNotFoundException $ex) {
                
            }
        }
        if (isset($result->user_id) && !empty($result->user_id)) {
            $getAllCommunInformCategorID = \DB::table('categories')->select("id")->where([
                        "belong_to_community" => 1
                    ])->orWhere(["show_on_info_area" => 1])->get();

            foreach ($getAllCommunInformCategorID as $getAllCommunInformCategorIDKey => $getAllCommunInformCategorIDValue) {
                $getAllCommunInformCategorIDArray[] = $getAllCommunInformCategorIDValue->id;
            }
            $userExistingAdds = $this->model->where('user_id', '=', $result->user_id)->where(['status' => 1])
                            ->where('id', '!=', $id)
                            ->with(['classified_attribute' => function ($query) {
                                    $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'display_name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')
                                    ->where(['show_list' => 1]);
                                }, 'classified_users' => function ($q1) {
                                    $q1->select('id', 'name', 'email');
                                }, 'classified_image'
                                , 'city' => function($q3) {
                                    $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                                },
                                'categoriesname' => function($q4) {
                                    $q4->select('name', 'id');
                                }
                            ])->orderby('id', 'desc')
                            ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")->limit(2)->get();
            $totalUserExistingAdds = $this->model->where('user_id', '=', $result->user_id)->where(['status' => 1])
                            ->where('id', '!=', $id)
                            ->with(['classified_attribute' => function ($query) {
                                    $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'display_name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')
                                    ->where(['show_list' => 1]);
                                }, 'classified_users' => function ($q1) {
                                    $q1->select('id', 'name', 'email');
                                }, 'classified_image'])->orderby('id', 'desc')
                            ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")->count();

            $userExistingAdds = $userExistingAdds->toarray();
            foreach ($userExistingAdds as $key => $value) {



                if (!empty($value['classified_attribute'])) {
                    foreach ($value['classified_attribute'] as $in => $val) {
                        if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] == 0) {
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $userExistingAdds[$key]['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                        }
                        if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] != 0) {
                            $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $val['attribute_id'])->where('attribute_value_id', $val['parent_value_id'])->pluck('attribute_value', 'id');
                            $userExistingAdds[$key]['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                        }

                        if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                            $userExistingAdds[$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                            $userExistingAdds[$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        }
                    }
                }
            }
        }
        if (isset($result->parent_categoryid) && !empty($result->parent_categoryid)) {
            if (!empty(Auth::guard('web')->user())) {
                $logginid = Auth::guard('web')->user()->id;
            }
            if (!empty($logginid)) {
                $usercondition = array(
                    array('id', '!=', $id),
                    array('user_id', '!=', $logginid),
                );
            } else {
                $usercondition = array(
                    array('id', '!=', $id),
                );
            }

            $similarAdds = $this->model->where('parent_categoryid', '=', $result->parent_categoryid)->where('user_id', '!=', $result->user_id)->where(['status' => 1])
                            ->where($usercondition)
                            ->with(['classified_attribute' => function ($query) {
                                    $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')
                                    ->where(['show_list' => 1]);
                                }, 'classified_users' => function ($q1) {
                                    $q1->select('id', 'name', 'email');
                                }, 'city' => function($q3) {
                                    $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                                },
                                'classified_image'])->orderby('id', 'desc')
                            ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                            ->limit(3)->get();

            $similarAdds = $similarAdds->toarray();
            foreach ($similarAdds as $key => $value) {
                if (!empty($value['classified_attribute'])) {
                    foreach ($value['classified_attribute'] as $in => $val) {
                        if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                            $similarAdds[$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                            $similarAdds[$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        }
                    }
                }
            }
        }

        $wishlistItems = array();
        if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
            $wishlistObj = new Wishlist;
            $wishlistItems = $wishlistObj->where('user_id', '=', Auth::guard('web')->user()->id)->pluck("classified_id", "id")->all();
        } elseif (Cookie::get('wishlistItems')) {
            $wishlistItems = Cookie::get('wishlistItems');
        }

        $current_date = date("Y-m-d");
        $top_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 2)->where("banner_position", "=", "top")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();

        $right_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 2,
                            "banner_position" => "right",
                            "status" => 1,
                            "category_id" => $result->parent_categoryid,
                            "subcategory_id" => $result->category_id
                        ])
                        ->orderBy('order_no', 'ASC')->get();
        $bottom_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 2,
                            "banner_position" => "bottom",
                            "status" => 1,
                            "category_id" => $result->parent_categoryid,
                            "subcategory_id" => $result->category_id
                        ])
                        ->orderBy('order_no', 'ASC')->get();

        $default_top_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "top")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_right_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "right")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_bottom_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "bottom")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);


        //********Get the template of this category***

        $template_slug = 'job-apply';

        return view('front.classifieds.' . $template_slug, compact('top_positions_ads', 'allSubCategoriesForMenu', 'right_positions_ads', 'bottom_positions_ads', 'default_top_position_ad', 'default_right_position_ad', 'default_bottom_position_ad', 'allSubCategories', 'result', 'allComCategories', 'allSubCategoriesForMenu', 'userExistingAdds', 'similarAdds', 'wishlistItems', 'totalUserExistingAdds', 'getAllCommunInformCategorIDArray'));
    }

    /**
     *  front Job-login
     * job_login classified
     *
     * @return void
     * @access public
     */
    public function job_login(Request $request) {
        $id = $request->id;
        $current_date = date('Y-m-d');
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        $result = false;

        $getAllCommunInformCategorIDArray = array();

        if (isset($id)) {
            try {
                $result = $this->model->where('id', '=', $id)->with(['classified_hasmany_other', 'classified_attribute' => function ($query) {
                                $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'display_name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'show_list', 'icon');
                            }, 'classified_users' => function ($q1) {
                                $q1->select('id', 'name', 'email', 'role_id');
                            }, 'classified_image'
                            , 'city' => function($q3) {
                                $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                            },
                        ])->first();

                $multi_select = [];
                foreach ($result['classified_attribute'] as $key => $value) {
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] == 0) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValues = $attr_AllValues->toArray();
                    }
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] != 0) {
                        $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $value['attribute_id'])->where('attribute_value_id', $value['parent_value_id'])->pluck('attribute_value', 'id');
                        $value->attr_AllValues = $attr_AllValues->toArray();
                    }
                    if ($value['attr_type_name'] == 'Numeric') {
                        $attr_AllValuesNumeric = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValuesNumeric = $attr_AllValuesNumeric->toarray();
                    }
                    if ($value['attr_type_name'] == 'calendar') {
                        $attr_AllValuesCalendar = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValuesNumeric = $attr_AllValuesCalendar->toarray();
                    }
                    if ($value['attr_type_name'] == 'Multi-Select' || $value['attr_type_name'] == 'Radio-button') {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $multi_select[$value['attribute_id']]['attr_ids_multi'] = $value['attribute_id'];
                        $multi_select[$value['attribute_id']]['attr_type_name_multi'] = $value['attr_type_name'];
                        $multi_select[$value['attribute_id']]['name'] = $value['name'];
                        $multi_select[$value['attribute_id']]['attr_type_id_multi'] = $value['attr_type_id'];
                        $multi_select[$value['attribute_id']]['selected'][] = $value['attr_value'];
                        $multi_select[$value['attribute_id']]['attribute_value'] = $attr_AllValues->toArray();
                    }
                }
                if (isset($multi_select) && !empty($multi_select)) {
                    $result->multi_select = $multi_select;
                }
            } catch (ModelNotFoundException $ex) {
                
            }
        }
        if (isset($result->user_id) && !empty($result->user_id)) {
            $getAllCommunInformCategorID = \DB::table('categories')->select("id")->where([
                        "belong_to_community" => 1
                    ])->orWhere(["show_on_info_area" => 1])->get();

            foreach ($getAllCommunInformCategorID as $getAllCommunInformCategorIDKey => $getAllCommunInformCategorIDValue) {
                $getAllCommunInformCategorIDArray[] = $getAllCommunInformCategorIDValue->id;
            }
            $userExistingAdds = $this->model->where('user_id', '=', $result->user_id)->where(['status' => 1])
                            ->where('id', '!=', $id)
                            ->with(['classified_attribute' => function ($query) {
                                    $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'display_name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')
                                    ->where(['show_list' => 1]);
                                }, 'classified_users' => function ($q1) {
                                    $q1->select('id', 'name', 'email');
                                }, 'classified_image'
                                , 'city' => function($q3) {
                                    $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                                },
                                'categoriesname' => function($q4) {
                                    $q4->select('name', 'id');
                                }
                            ])->orderby('id', 'desc')
                            ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")->limit(2)->get();
            $totalUserExistingAdds = $this->model->where('user_id', '=', $result->user_id)->where(['status' => 1])
                            ->where('id', '!=', $id)
                            ->with(['classified_attribute' => function ($query) {
                                    $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'display_name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')
                                    ->where(['show_list' => 1]);
                                }, 'classified_users' => function ($q1) {
                                    $q1->select('id', 'name', 'email');
                                }, 'classified_image'])->orderby('id', 'desc')
                            ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")->count();

            $userExistingAdds = $userExistingAdds->toarray();
            foreach ($userExistingAdds as $key => $value) {



                if (!empty($value['classified_attribute'])) {
                    foreach ($value['classified_attribute'] as $in => $val) {
                        //                                dd($val);
                        if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] == 0) {
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $userExistingAdds[$key]['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                        }
                        if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] != 0) {
                            $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $val['attribute_id'])->where('attribute_value_id', $val['parent_value_id'])->pluck('attribute_value', 'id');
                            $userExistingAdds[$key]['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                        }

                        if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                            $userExistingAdds[$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                            $userExistingAdds[$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        }
                    }
                }
            }
        }
        if (isset($result->parent_categoryid) && !empty($result->parent_categoryid)) {
            if (!empty(Auth::guard('web')->user())) {
                $logginid = Auth::guard('web')->user()->id;
            }
            if (!empty($logginid)) {
                $usercondition = array(
                    array('id', '!=', $id),
                    array('user_id', '!=', $logginid),
                );
            } else {
                $usercondition = array(
                    array('id', '!=', $id),
                );
            }

            $similarAdds = $this->model->where('parent_categoryid', '=', $result->parent_categoryid)->where('user_id', '!=', $result->user_id)->where(['status' => 1])
                            ->where($usercondition)
                            ->with(['classified_attribute' => function ($query) {
                                    $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')
                                    ->where(['show_list' => 1]);
                                }, 'classified_users' => function ($q1) {
                                    $q1->select('id', 'name', 'email');
                                }, 'city' => function($q3) {
                                    $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                                },
                                'classified_image'])->orderby('id', 'desc')
                            ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                            ->limit(3)->get();

            $similarAdds = $similarAdds->toarray();
            foreach ($similarAdds as $key => $value) {
                if (!empty($value['classified_attribute'])) {
                    foreach ($value['classified_attribute'] as $in => $val) {
                        if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                            $similarAdds[$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                            $similarAdds[$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        }
                    }
                }
            }
        }

        $wishlistItems = array();
        if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
            $wishlistObj = new Wishlist;
            $wishlistItems = $wishlistObj->where('user_id', '=', Auth::guard('web')->user()->id)->pluck("classified_id", "id")->all();
        } elseif (Cookie::get('wishlistItems')) {
            $wishlistItems = Cookie::get('wishlistItems');
        }

        $current_date = date("Y-m-d");
        $top_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 2)->where("banner_position", "=", "top")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();

        $right_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 2,
                            "banner_position" => "right",
                            "status" => 1,
                            "category_id" => $result->parent_categoryid,
                            "subcategory_id" => $result->category_id
                        ])
                        ->orderBy('order_no', 'ASC')->get();
        $bottom_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 2,
                            "banner_position" => "bottom",
                            "status" => 1,
                            "category_id" => $result->parent_categoryid,
                            "subcategory_id" => $result->category_id
                        ])
                        ->orderBy('order_no', 'ASC')->get();

        $default_top_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "top")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_right_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "right")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_bottom_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "bottom")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);


        //********Get the template of this category***

        $template_slug = 'job-login';

        return view('front.classifieds.' . $template_slug, compact('top_positions_ads', 'allSubCategoriesForMenu', 'right_positions_ads', 'bottom_positions_ads', 'default_top_position_ad', 'default_right_position_ad', 'default_bottom_position_ad', 'allSubCategories', 'result', 'allComCategories', 'allSubCategoriesForMenu', 'userExistingAdds', 'similarAdds', 'wishlistItems', 'totalUserExistingAdds', 'getAllCommunInformCategorIDArray'));
    }

    /**
     *  front classified_item
     * classified_item classified
     *
     * @return void
     * @access public
     */
    public function classified_item_222(Request $request) {
        $id = $request->id;
        $current_date = date('Y-m-d');
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        $result = false;

        $getAllCommunInformCategorIDArray = array();

        if (isset($id)) {
            try {
                $result = $this->model->where('id', '=', $id)->with(['classified_hasmany_other', 'classified_attribute' => function ($query) {
                                $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'display_name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'show_list', 'icon');
                            }, 'classified_users' => function ($q1) {
                                $q1->select('id', 'name', 'email', 'role_id');
                            }, 'classified_image'
                            , 'city' => function($q3) {
                                $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                            },
                        ])->first();

                $multi_select = [];
                foreach ($result['classified_attribute'] as $key => $value) {
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] == 0) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValues = $attr_AllValues->toArray();
                    }
                    if ($value['attr_type_id'] == 4 && $value['parent_value_id'] != 0) {
                        $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $value['attribute_id'])->where('attribute_value_id', $value['parent_value_id'])->pluck('attribute_value', 'id');
                        $value->attr_AllValues = $attr_AllValues->toArray();
                    }
                    if ($value['attr_type_name'] == 'Numeric') {
                        $attr_AllValuesNumeric = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValuesNumeric = $attr_AllValuesNumeric->toarray();
                    }
                    if ($value['attr_type_name'] == 'calendar') {
                        $attr_AllValuesCalendar = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $value->attr_AllValuesNumeric = $attr_AllValuesCalendar->toarray();
                    }
                    if ($value['attr_type_name'] == 'Multi-Select' || $value['attr_type_name'] == 'Radio-button') {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                        $multi_select[$value['attribute_id']]['attr_ids_multi'] = $value['attribute_id'];
                        $multi_select[$value['attribute_id']]['attr_type_name_multi'] = $value['attr_type_name'];
                        $multi_select[$value['attribute_id']]['name'] = $value['name'];
                        $multi_select[$value['attribute_id']]['attr_type_id_multi'] = $value['attr_type_id'];
                        $multi_select[$value['attribute_id']]['selected'][] = $value['attr_value'];
                        $multi_select[$value['attribute_id']]['attribute_value'] = $attr_AllValues->toArray();
                    }
                }
                if (isset($multi_select) && !empty($multi_select)) {
                    $result->multi_select = $multi_select;
                }
            } catch (ModelNotFoundException $ex) {
                
            }
        }
        if (isset($result->user_id) && !empty($result->user_id)) {
            $getAllCommunInformCategorID = \DB::table('categories')->select("id")->where([
                        "belong_to_community" => 1
                    ])->orWhere(["show_on_info_area" => 1])->get();

            foreach ($getAllCommunInformCategorID as $getAllCommunInformCategorIDKey => $getAllCommunInformCategorIDValue) {
                $getAllCommunInformCategorIDArray[] = $getAllCommunInformCategorIDValue->id;
            }
            $userExistingAdds = $this->model->where('user_id', '=', $result->user_id)->where(['status' => 1])
                            ->where('id', '!=', $id)
                            ->with(['classified_attribute' => function ($query) {
                                    $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'display_name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')
                                    ->where(['show_list' => 1]);
                                }, 'classified_users' => function ($q1) {
                                    $q1->select('id', 'name', 'email');
                                }, 'classified_image'
                                , 'city' => function($q3) {
                                    $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                                },
                                'categoriesname' => function($q4) {
                                    $q4->select('name', 'id');
                                }
                            ])->orderby('id', 'desc')
                            ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")->limit(2)->get();
            $totalUserExistingAdds = $this->model->where('user_id', '=', $result->user_id)->where(['status' => 1])
                            ->where('id', '!=', $id)
                            ->with(['classified_attribute' => function ($query) {
                                    $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'display_name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')
                                    ->where(['show_list' => 1]);
                                }, 'classified_users' => function ($q1) {
                                    $q1->select('id', 'name', 'email');
                                }, 'classified_image'])->orderby('id', 'desc')
                            ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")->count();

            $userExistingAdds = $userExistingAdds->toarray();
            foreach ($userExistingAdds as $key => $value) {


                if (!empty($value['classified_attribute'])) {
                    foreach ($value['classified_attribute'] as $in => $val) {
                        if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] == 0) {
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $userExistingAdds[$key]['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                        }
                        if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] != 0) {
                            $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $val['attribute_id'])->where('attribute_value_id', $val['parent_value_id'])->pluck('attribute_value', 'id');
                            $userExistingAdds[$key]['classified_attribute'][$in]['attr_AllValues'] = $attr_AllValues->toArray();
                        }

                        if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                            $userExistingAdds[$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                            $userExistingAdds[$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        }
                    }
                }
            }
        }
        if (isset($result->parent_categoryid) && !empty($result->parent_categoryid)) {
            if (!empty(Auth::guard('web')->user())) {
                $logginid = Auth::guard('web')->user()->id;
            }
            if (!empty($logginid)) {
                $usercondition = array(
                    array('id', '!=', $id),
                    array('user_id', '!=', $logginid),
                );
            } else {
                $usercondition = array(
                    array('id', '!=', $id),
                );
            }

            $similarAdds = $this->model->where('parent_categoryid', '=', $result->parent_categoryid)->where('user_id', '!=', $result->user_id)->where(['status' => 1])
                            ->where($usercondition)
                            ->with(['classified_attribute' => function ($query) {
                                    $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')
                                    ->where(['show_list' => 1]);
                                }, 'classified_users' => function ($q1) {
                                    $q1->select('id', 'name', 'email');
                                }, 'city' => function($q3) {
                                    $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                                },
                                'classified_image'])->orderby('id', 'desc')
                            ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                            ->limit(3)->get();

            $similarAdds = $similarAdds->toarray();
            foreach ($similarAdds as $key => $value) {
                if (!empty($value['classified_attribute'])) {
                    foreach ($value['classified_attribute'] as $in => $val) {
                        if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                            $similarAdds[$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                            $similarAdds[$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        }
                    }
                }
            }
        }

        $wishlistItems = array();
        if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
            $wishlistObj = new Wishlist;
            $wishlistItems = $wishlistObj->where('user_id', '=', Auth::guard('web')->user()->id)->pluck("classified_id", "id")->all();
        } elseif (Cookie::get('wishlistItems')) {
            $wishlistItems = Cookie::get('wishlistItems');
        }

        $current_date = date("Y-m-d");
        $top_positions_ads = \DB::table('advertisements')->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")->where("page_id", "=", 2)->where("banner_position", "=", "top")->where("status", "=", 1)->orderBy('order_no', 'ASC')->get();

        $right_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 2,
                            "banner_position" => "right",
                            "status" => 1,
                            "category_id" => $result->parent_categoryid,
                            "subcategory_id" => $result->category_id
                        ])
                        ->orderBy('order_no', 'ASC')->get();
        $bottom_positions_ads = \DB::table('advertisements')
                        ->whereRaw(" '$current_date' Between advertisements.start_date  and advertisements.end_date ")
                        ->where([
                            "page_id" => 2,
                            "banner_position" => "bottom",
                            "status" => 1,
                            "category_id" => $result->parent_categoryid,
                            "subcategory_id" => $result->category_id
                        ])
                        ->orderBy('order_no', 'ASC')->get();

        $default_top_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "top")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_right_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "right")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $default_bottom_position_ad = \DB::table('advertisements')->where("page_id", "=", 2)->where("banner_position", "=", "bottom")->where("is_default", "=", 1)->where("status", "=", 1)->first();
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);


        //********Get the template of this category***
        $catid = $result->category_id;
        $template_arr = DB::table('templates')->select('template_slug')
                        ->leftJoin('category_template', 'templates.id', '=', 'category_template.template_id')
                        ->where('category_template.category_id', '=', $catid)
                        ->where('templates.template_type', '=', 'detail')
                        ->get()->toArray();

        if (isset($template_arr) && !empty($template_arr)) {
            $template_slug = $template_arr[0]->template_slug;
        } else {
            $template_slug = 'item';
        }
        //*********Sensis search*****************************
        if ($template_slug == 'realestate') {
            $sensis_results_restaurants = $this->sensis_search("Restaurants", $result->location);
            $sensis_results_bars = $this->sensis_search("Bars", $result->location);
            $sensis_results_allschool = $this->sensis_search("School", $result->location);
            $sensis_results_preschool = $this->sensis_search("School", $result->location, 27189);
            $sensis_results_secschool = $this->sensis_search("School", $result->location, 24082);
            $sensis_results_otherschool = $this->sensis_search("", $result->location, 43664);
        } else {
            $sensis_results_restaurants = array();
            $sensis_results_bars = array();
            $sensis_results_allschool = array();
            $sensis_results_preschool = array();
            $sensis_results_secschool = array();
            $sensis_results_otherschool = array();
        }
        //**************************************************************

        return view('front.classifieds.' . $template_slug, compact('top_positions_ads', 'allSubCategoriesForMenu', 'right_positions_ads', 'bottom_positions_ads', 'default_top_position_ad', 'default_right_position_ad', 'default_bottom_position_ad', 'allSubCategories', 'result', 'allComCategories', 'allSubCategoriesForMenu', 'userExistingAdds', 'similarAdds', 'wishlistItems', 'totalUserExistingAdds', 'getAllCommunInformCategorIDArray', 'sensis_results_restaurants', 'sensis_results_bars', 'sensis_results_allschool', 'sensis_results_preschool', 'sensis_results_otherschool', 'sensis_results_secschool'));
    }

    public function classified_item(Request $request) {
        $id = $request->id;
        $current_date = date('Y-m-d');
        //increse view count 
        DB::table('classifieds')->whereId($id)->increment('count');

        $result = false;


        if (isset($id)) {
            try {
                $result = $this->model->where('id', '=', $id)->with(['classified_hasmany_other',
                            'classified_attribute' => function ($query) {
                                $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'display_name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'show_list', 'icon');
                            },
                            'classified_users' => function ($q1) {
                                $q1->select('id', 'name', 'email', 'role_id');
                            },
                            'Subcategoriesname' => function($q5) {
                                $q5->with(['category_hm_groups' => function ($q6) {
                                        $q6->with(['attributes_groups']);
                                    }]);
                            },
                            'classified_image',
                            'classified_hm_reviews' => function($q4) {
                                $q4->where(['status' => 1])->with(['reviews_bt_users']);
                            },
                            'city' => function($q3) {
                                $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                            },
                        ])->first();
                $multi_select = [];
                $attrValueForGroup = [];

                if (!empty($result['classified_attribute'])) {
                    foreach ($result['classified_attribute'] as $in => $val) {

                        if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                            $result['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                            $attrValueForGroup[$val['attribute_id']] = $val->toArray();
                        } else
                        if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] == 0) {
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $result['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                            $attrValueForGroup[$val['attribute_id']] = $val->toArray();
                        } else
                        if (($val['attr_type_name'] == 'calendar') && (strpos($val['attr_value'], ';'))) {
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $result['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                            $attrValueForGroup[$val['attribute_id']] = $val->toArray();
                        } else
                        if (($val['attr_type_name'] == 'Numeric') && (strpos($val['attr_value'], ';'))) {
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $result['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                            $attrValueForGroup[$val['attribute_id']] = $val->toArray();
                        } else
                        if (($val['attr_type_name'] == 'Date') && (strpos($val['attr_value'], ';'))) {
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $result['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                            $attrValueForGroup[$val['attribute_id']] = $val->toArray();
                        } else
                        if (($val['attr_type_name'] == 'Time') && (strpos($val['attr_value'], ';'))) {
                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                            $result['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                            $val['attr_AllValues'] = $attr_AllValues->toArray();
                            $attrValueForGroup[$val['attribute_id']] = $val->toArray();
                        } else {
                            $attrValueForGroup[$val['attribute_id']] = $val->toArray();
                            unset($val);
                        }
                    }
                }
            } catch (ModelNotFoundException $ex) {
                
            }
        }

        if (isset($result->parent_categoryid) && !empty($result->parent_categoryid)) {
            if (!empty(Auth::guard('web')->user())) {
                $logginid = Auth::guard('web')->user()->id;
            }
            if (!empty($logginid)) {
                $usercondition = array(
                    array('id', '!=', $id),
                    array('user_id', '!=', $logginid),
                );
            } else {
                $usercondition = array(
                    array('id', '!=', $id),
                );
            }
            $similarAdds = $this->model->where('parent_categoryid', '=', $result->parent_categoryid)->where('user_id', '!=', $result->user_id)->where(['status' => 1])
                            ->where($usercondition)
                            ->with(['classified_attribute' => function ($query) {
                                    $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'icon')
                                    ->where(['show_list' => 1]);
                                }, 'classified_users' => function ($q1) {
                                    $q1->select('id', 'name', 'email');
                                }, 'city' => function($q3) {
                                    $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                                },
                                'classified_image'])->orderby('id', 'desc')
                            ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                            ->limit(3)->get();

            $similarAdds = $similarAdds->toarray();
            foreach ($similarAdds as $key => $value) {
                if (!empty($value['classified_attribute'])) {
                    foreach ($value['classified_attribute'] as $in => $val) {
                        if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                            $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                            $similarAdds[$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                            $similarAdds[$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        }
                    }
                }
            }
        }

        $wishlistItems = array();
        if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
            $wishlistObj = new Wishlist;
            $wishlistItems = $wishlistObj->where('user_id', '=', Auth::guard('web')->user()->id)->pluck("classified_id", "id")->all();
        } elseif (Cookie::get('wishlistItems')) {
            $wishlistItems = Cookie::get('wishlistItems');
        }

        //********Get the template of this category***

        if (isset($result->subcategoriesname) && $result->subcategoriesname->is_sellable == 1) {
            $template_slug = 'detail_page_is_sellable_template';
        } else {
            $catid = $result->parent_categoryid;
            $template_arr = DB::table('templates')
                    ->leftJoin('category_template', 'templates.id', '=', 'category_template.template_id')
                    ->where('category_template.category_id', '=', $catid)
                    ->first();

            $template_slug = $template_arr->default_detail_slug;
        }

        //all Attributes
        $all_attr = $result->classified_attribute->groupBy('attribute_id')->toArray();

        //*********Sensis search*****************************
        if ($template_slug == 'default_detail_realestate') {
            $sensis_results_restaurants = $this->sensis_search("Restaurants", $result->location);
            $sensis_results_bars = $this->sensis_search("Bars", $result->location);
            $sensis_results_allschool = $this->sensis_search("School", $result->location);
            $sensis_results_preschool = $this->sensis_search("School", $result->location, 27189);
            $sensis_results_secschool = $this->sensis_search("School", $result->location, 24082);
            $sensis_results_otherschool = $this->sensis_search("", $result->location, 43664);
        } else {
            $sensis_results_restaurants = array();
            $sensis_results_bars = array();
            $sensis_results_allschool = array();
            $sensis_results_preschool = array();
            $sensis_results_secschool = array();
            $sensis_results_otherschool = array();
        }
        //**************************************************************

        return view('front.classifieds.' . $template_slug, compact('result', 'similarAdds', 'wishlistItems', 'sensis_results_restaurants', 'sensis_results_bars', 'sensis_results_allschool', 'sensis_results_preschool', 'sensis_results_otherschool', 'sensis_results_secschool', 'attrValueForGroup', 'all_attr'));
    }

    /**
     *  classified_detailpageapi
     * classified_detailpageapi classified
     *
     * @return response
     * @access public
     */
    public function classified_detailpageapi(Request $request) {
        $rooturl = \Request::root();
        $current_date = date('Y-m-d');
        $id = $request->id;
        $user_id = $request->user_id;
        $result = false;
        if (!empty($id)) {

            $data = $this->model->selectRaw('id,title,location,user_id,description,price,DATE_FORMAT(created_at,"%d/%m/%Y") AS createdtime,count,city_id,parent_categoryid,description')->where('id', '=', $id)->with(
                            ['classified_attribute' => function ($query) {
                                    $query->select("attribute_id", 'classified_id', 'attr_value', 'attr_type_id', 'attr_type_name', 'name', 'p_attr_id', 'parent_value_id', 'parent_attribute_id', 'display_name');
                                }, 'classified_users' => function ($q1) {
                                    $q1->select('id', 'name', 'email', 'role_id', 'image', 'avatar', 'mobile_no', 'phonecode');
                                }, 'classified_image' => function($q2) use($rooturl) {
                                    $q2->select(
                                            'classified_id', DB::raw('CONCAT("' . $rooturl . '","/upload_images/classified/",classified_id,"/",name) as full_name')
                                    );
                                }, 'city' => function($q3) {
                                    $q3->select('CityId', 'City', 'Latitude', 'Longitude');
                                },
                                'categoriesname' => function($q4) {
                                    $q4->select('name', 'id');
                                }
                    ])->first();
            //for specification
            $multi_select = [];
            foreach ($data['classified_attribute'] as $key => $value) {
                if ($value['attr_type_id'] == 4 && $value['parent_value_id'] == 0) {
                    $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                    $value->attr_AllValues = $attr_AllValues->toArray();
                }
                if ($value['attr_type_id'] == 4 && $value['parent_value_id'] != 0) {
                    $attr_AllValues = DB::table('attribute_value_child')->where('attribute_id', $value['attribute_id'])->where('attribute_value_id', $value['parent_value_id'])->pluck('attribute_value', 'id');
                    $value->attr_AllValues = $attr_AllValues->toArray();
                }
                if ($value['attr_type_name'] == 'Numeric') {
                    $attr_AllValuesNumeric = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                    $value->attr_AllValuesNumeric = $attr_AllValuesNumeric->toarray();
                }
                if ($value['attr_type_name'] == 'calendar') {
                    $attr_AllValuesCalendar = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                    $value->attr_AllValuesNumeric = $attr_AllValuesCalendar->toarray();
                }
                if ($value['attr_type_name'] == 'Multi-Select' || $value['attr_type_name'] == 'Radio-button') {
                    $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $value['attribute_id'])->pluck('values', 'id');
                    $multi_select[$value['attribute_id']]['attr_ids_multi'] = $value['attribute_id'];
                    $multi_select[$value['attribute_id']]['attr_type_name_multi'] = $value['attr_type_name'];
                    $multi_select[$value['attribute_id']]['name'] = $value['name'];
                    $multi_select[$value['attribute_id']]['display_name'] = $value['display_name'];
                    $multi_select[$value['attribute_id']]['attr_type_id_multi'] = $value['attr_type_id'];
                    $multi_select[$value['attribute_id']]['selected'][] = $value['attr_value'];
                    $multi_select[$value['attribute_id']]['attribute_value'] = $attr_AllValues->toArray();
                }
            }
            if (!empty($multi_select)) {
                $data->multi_select = $multi_select;
            }
            $spicificationarr = array();
            $spicificationarrMain = array();
            foreach ($data->classified_attribute as $key => $value) {
                if (in_array($value->attr_type_name, ['text', 'Url', 'Email', 'textarea', 'calendar', 'Drop-Down', 'Color', 'Time', 'Date', 'Numeric', 'Radio-button'])) {
                    if (in_array($value->attr_type_name, ["Drop-Down"])) {
                        $spicificationarr['key'] = $value->display_name;
                        $spicificationarr['value'] = $value->attr_AllValues[$value->attr_value];
                        $spicificationarr['type'] = $value->attr_type_name;
                    } elseif (in_array($value->attr_type_name, ["Radio-button"])) {
                        $spicificationarr['key'] = $value->display_name;
                        $spicificationarr['value'] = $data->multi_select[$value['attribute_id']]['attribute_value'][$data->multi_select[$value['attribute_id']]['selected'][0]];
                        $spicificationarr['type'] = $value->attr_type_name;
                    } elseif (in_array($value->attr_type_name, ["calendar", "Date", "Time"])) {
                        $spicificationarr['key'] = $value->display_name;
                        $spicificationarr['value'] = str_replace(';', ' - ', $value->attr_value);
                        $spicificationarr['type'] = $value->attr_type_name;
                    } elseif (in_array($value->attr_type_name, ["Color"])) {
                        $spicificationarr['key'] = $value->display_name;
                        $spicificationarr['value'] = $value->attr_value;
                        $spicificationarr['type'] = $value->attr_type_name;
                    } else {
                        $spicificationarr['key'] = $value->display_name;
                        $spicificationarr['value'] = $value->attr_value;
                        $spicificationarr['type'] = $value->attr_type_name;
                    }
                    $spicificationarrMain[] = $spicificationarr;
                }
            }
            if (!empty($data->multi_select)) {
                foreach ($data->multi_select as $key => $value) {
                    if (in_array($value['attr_type_name_multi'], ['Multi-Select'])) {
                        $spicificationarr1['key'] = $value['display_name'];
                        $spicificationarr1['type'] = $value['attr_type_name_multi'];
                        foreach ($value['selected'] as $k => $v) {
                            $spicificationarr1['value'][] = $value['attribute_value'][$v];
                        }
                        $spicificationarr1['value'] = implode(',', $spicificationarr1['value']);
                    }
                }
                if (!empty($spicificationarr1)) {
                    $spicificationarrMain[] = $spicificationarr1;
                }
            }
            //end specification
            if (count($user_id) > 0) {
                $usercondition = array(
                    array('classifieds.id', '!=', $id),
                    array('user_id', '!=', $user_id),
                );
            } else {
                $usercondition = array(
                    array('classifieds.id', '!=', $id),
                );
            }

            //for smiller adds 
            if (!empty($data['parent_categoryid'])) {
                $similarAdds = $this->model
                        ->selectRaw('classifieds.id as classifiedid ,classifieds.title as title,city_id,'
                                . 'classifieds.description as description,classifiedimage.name as name,classifieds.price,UNIX_TIMESTAMP(classifieds.created_at)as createdtime,'
                                . 'concat("' . $rooturl . '/upload_images/classified/",classifieds.id,"/",classifiedimage.name) imageurl')
                        ->leftJoin('classifiedimage', 'classifieds.id', '=', 'classifiedimage.classified_id')
                        ->where('classifieds.parent_categoryid', '=', $data['parent_categoryid'])->where('user_id', '!=', $data['classified_users']->id)->where(['status' => 1])
                        ->where($usercondition)
                        ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                        ->with(
                                ['city' => function ($query) {
                                        $query->select('CityId', 'City', 'Latitude', 'Longitude');
                                    }])
                        ->groupBy('classifieds.id')
                        ->get();
//                                                               
            }
            $this->model->whereId($id)->increment('count');
            $similarAddsarrdata = $similarAdds->toarray();
            if (!empty($similarAddsarrdata)) {
                $similarAddsarr = $similarAddsarrdata;
            } else {
                $similarAddsarr = array();
            }
            //for smiller
            //forusercount
            $useraddcount = $this->model
                            ->selectRaw('id as classifiedid')
                            ->where('user_id', '=', $data['classified_users']->id)
                            ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                            ->get()->count();
            $wishlistItems = array();
            if ($user_id != 0) {
                $wishlistObj = new Wishlist;
                $wishlistItems = $wishlistObj->where('user_id', '=', $user_id)->select('classified_id')->get()->toarray();
            }
            foreach ($wishlistItems as $key1 => $value1) {
                $listarray[] = $value1['classified_id'];
            }
            if (!empty($similarAddsarr)) {
                foreach ($similarAddsarr as $keys => $values) {
                    if (!empty($listarray)) {
                        if (in_array($values['classifiedid'], $listarray)) {
                            $similarAddsarr[$keys]['wishlist'] = 1;
                        } else {
                            $similarAddsarr[$keys]['wishlist'] = 0;
                        }
                    } else {
                        $similarAddsarr[$keys]['wishlist'] = 0;
                    }
                    if (empty($values['city'])) {
                        $similarAddsarr[$keys]['location'] = 'N/A';
                    } else {
                        $similarAddsarr[$keys]['location'] = $values['city']['City'];
                    }
                }
            }
            if (!empty($listarray)) {
                if (in_array($data['id'], $listarray)) {
                    $data['wishlist'] = 1;
                    $data['classifiedid'] = $data->id;
                } else {
                    $data['wishlist'] = 0;
                    $data['classifiedid'] = $data->id;
                }
            } else {
                $data['wishlist'] = 0;
                $data['classifiedid'] = $data->id;
            }
            $data['socialurl'] = $rooturl . '/classifieds/' . $data->id;
            if (!empty($data['classified_users']->image)) {
                $imgurl = \URL::asset('upload_images/users/' . $data['classified_users']->id . '/' . $data['classified_users']->image);
                $data['classified_users']->userimage = $imgurl;
                $data['classified_users']->image = $imgurl;
            } elseif (!empty($data['classified_users']->avatar)) {
                $imgurl = $data['classified_users']->avatar;
                $data['classified_users']->userimage = $imgurl;
                $data['classified_users']->image = $imgurl;
            } else {
                $imgurl = \URL::asset('plugins/front/img/profile-img-new-header.jpg');
                $data['classified_users']->userimage = $imgurl;
                $data['classified_users']->image = $imgurl;
            }
            if (!empty($data['city']->City)) {
                $data['location'] = $data['city']->City;
            } else {
                $data['location'] = 'N/A';
                unset($data['city']);
            }
            if (!empty($useraddcount)) {
                $data['usercount'] = $useraddcount;
            } else {
                $data['usercount'] = 0;
            }
            if (!empty($data['categoriesname']->name)) {
                $data['categoriesname']->text = $data['categoriesname']->name;
            }

            $spicificationarrdata = array();
            if (!empty($spicificationarrMain)) {
                $spicificationarrdata = $spicificationarrMain;
            } else {
                $spicificationarrdata = array();
            }
            if (count($data) > 0) {
                unset($data['multi_select']);
                unset($data['classified_attribute']);
                $result['status'] = 1;
                $result['data'] = $data;
                $result['spicification'] = $spicificationarrdata;
                $result['similaradd'] = $similarAddsarr;
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['data'] = array();
                $result['similaradd'] = $similarAddsarr;
                $result['msg'] = 'no record found';
                echo json_encode($result);
                die;
            }
        }
    }

    /**
     *  deactivate_classified
     * deactivate_classified classified
     *
     * @return response
     * @access public
     */
    public function deactivate_classified($id = null) {
        if (!empty($id)) {
            $this->model->where('id', $id)->update(['status' => 0]);

            $dataSendInMail = $this->model
                            ->with(["categoriesname", "Subcategoriesname", "classified_users"
                            ])
                            ->where("id", "=", $id)->first();

            $classfiedOwnerEmail = $dataSendInMail->classified_users['email'];
            $result = Mail::send('emails.classified_deactive_mail_template', array('dataSendInMail' => $dataSendInMail), function($message) use ($classfiedOwnerEmail) {
                        $message->from('avinesh.mathur@planetwebsolution.com');
                        $message->to($classfiedOwnerEmail)->subject("Classified Deactivation");
                    }, true);

            return redirect()->back()->withSuccess(' Classified deactivated successfully.');
        }
    }

    /**
     *  activate_classified
     * activate_classified classified
     *
     * @return response
     * @access public
     */
    public function activate_classified(Request $request) {
        $classified_id = $request->clId;
        $spmRprtId = $request->spmRptId;
        if (!empty($classified_id) && !empty($spmRprtId)) {

            $this->model->where('id', $classified_id)->update(['status' => 1]);
            $reportObj = new Report;
            $result = $reportObj->findOrFail($spmRprtId);
            if ($result->delete()) {
                $dataSendInMail = $this->model
                                ->with(["categoriesname", "Subcategoriesname", "classified_users"
                                ])
                                ->where("id", "=", $classified_id)->first();
                $classfiedOwnerEmail = $dataSendInMail->classified_users['email'];

                $mailResult = Mail::send('emails.classified_activate_mail_template', array('dataSendInMail' => $dataSendInMail), function($message) use ($classfiedOwnerEmail) {
                            $message->to($classfiedOwnerEmail)->subject("Classified Activation");
                        }, true);

                return redirect()->back()->withSuccess(' Classified activated successfully.');
            } else {
                return redirect()->back()->withDanger(' Please try again.');
            }
        }
    }

    /**
     *  deactive_classifieds_cron
     * deactive_classifieds_cron classified
     *
     * @return response
     * @access public
     */
    public function deactive_classifieds_cron() {
        $data = DB::select(DB::raw("select cl.id as classId from classifieds as cl left join categories as ca on cl.category_id=ca.id or cl.parent_categoryid=ca.id where ca.belong_to_community!=1 and cl.end_date < '2016-11-29' and cl.status=1 group by cl.id"));

        if ($data) {
            foreach ($data as $dataKey => $dataVal) {
                $this->model->where("id", "=", $dataVal->classId)->update(array("status" => 0));
            }
        }
        dd("Check");
    }

    /**
     *  getallcityapi
     * getallcityapi 
     *
     * @return response
     * @access public
     */
    public function getallcityapi() {

        $countryarr1 = DB::table('countries')->where('Country', 'Australia')->first();
        $countryidaus1 = $countryarr1->CountryId;
        $cityCode = DB::table('cities')->where('CountryID', $countryidaus1)->select('CityId', 'City', 'Latitude', 'Longitude')->get();
        $result['status'] = 1;
        $result['data'] = $cityCode;
        echo json_encode($result);
        die;
    }

    /**
     *  getcategoriestableforapi
     * getcategoriestableforapi 
     *
     * @return response
     * @access public
     */
    public function getcategoriestableforapi(Request $request) {
        $task = new Category;
        $rooturl = \Request::root();
        $timeinterval = $request->timeinterval;
        $now = new DateTime();
        $now->format('Y-m-d H:i:s');
        $currentdatetime = $now->getTimestamp();
        $halalcategory = Redis::get('Halal Products');
        if (!empty($halalcategory)) {
            $halalcategory = $halalcategory;
        } else {
            $halalcategory = '';
        }
        if ($timeinterval == 0) {
            $categoryarr = $task->getCategoriestabledataForapi();
            $result['iconurl'] = $rooturl . '/upload_images/categories/icon/';
            $result['halalcategory'] = $halalcategory;
            $result['currentdatetime'] = $currentdatetime;
            $result['status'] = 1;
            $result['newinsertcategories'] = $categoryarr;
            $result['updatedcategories'] = array();
            $result['deletedcategories'] = array();
        } else {
            $newinserted = $task->getCategoriestabledataFornewinserted($timeinterval);

            $result['iconurl'] = $rooturl . '/upload_images/categories/icon/';
            $result['halalcategory'] = $halalcategory;
            $result['currentdatetime'] = $currentdatetime;
            $result['status'] = 1;
            $result['newinsertcategories'] = $newinserted;

            $updated = $task->getCategoriestabledataForupdated($timeinterval);
            $result['updatedcategories'] = $updated;

            $deleted = $task->getCategoriestabledataFordeleted($timeinterval);
            $result['deletedcategories'] = $deleted;
        }



        echo json_encode($result);
        die;
    }

    /**
     *  getclassifiedtableforapi
     * getclassifiedtableforapi 
     *
     * @return response
     * @access public
     */
    public function getclassifiedtableforapi(Request $request) {
        $task = new Category;
        $rooturl = \Request::root();
        $timeinterval = $request->timeinterval;
        $now = new DateTime();
        $now->format('Y-m-d H:i:s');
        $currentdatetime = $now->getTimestamp();
        if ($timeinterval == 0) {
            $categoryarr = $task->getCategoriestabledataForapi();
            $result['iconurl'] = $rooturl . '/upload_images/categories/icon/';
            $result['currentdatetime'] = $currentdatetime;
            $result['status'] = 1;
            $result['newinsertcategories'] = $categoryarr;
            $result['updatedcategories'] = array();
            $result['deletedcategories'] = array();
        } else {
            $newinserted = $task->getCategoriestabledataFornewinserted($timeinterval);

            $result['iconurl'] = $rooturl . '/upload_images/categories/icon/';
            $result['currentdatetime'] = $currentdatetime;
            $result['status'] = 1;
            $result['newinsertcategories'] = $newinserted;

            $updated = $task->getCategoriestabledataForupdated($timeinterval);
            $result['updatedcategories'] = $updated;

            $deleted = $task->getCategoriestabledataFordeleted($timeinterval);
            $result['deletedcategories'] = $deleted;
        }



        echo json_encode($result);
        die;
    }

    /**
     *  getcategoriesforapi
     * getcategoriesforapi 
     *
     * @return response
     * @access public
     */
    public function getcategoriesforapi() {
        $task = new Category;
        $categoryarr = $task->getCategoriesForapi();
        $result['status'] = 1;
        $result['data'] = $categoryarr;

        echo json_encode($result);
        die;
    }

    /**
     *  getsubcategoriesforapi
     * getsubcategoriesforapi 
     *
     * @return response
     * @access public
     */
    public function getsubcategoriesforapi(Request $request) {
        $categoryid = $request->categoryid;
        $task = new Category;
        $categoryarr = $task->getSubCategoriesForapi($categoryid);
        $result['status'] = 1;
        $result['data'] = $categoryarr;

        echo json_encode($result);
        die;
    }

    /**
     *  addwishlist
     * addwishlist 
     *
     * @return response
     * @access public
     */
    public function addwishlist(Request $request) {
        $classifiedid = $request->classifiedid;
        $user_id = $request->user_id;

        if (!empty($classifiedid) && (!empty($user_id))) {
            $wishlistObj = new Wishlist;
            $userObj = new User;
            $insertedWishlistData = array();
            $checkAlreadyExist = $wishlistObj->where('classified_id', '=', $classifiedid)->where('user_id', '=', $user_id)->first();
            if (count($checkAlreadyExist) == 0) {
                $insertedWishlistData[] = array('user_id' => $user_id, 'classified_id' => $classifiedid);
            }
            $checkUserExist = $userObj->where('id', '=', $user_id)->first();
            if (count($checkUserExist) == 0) {
                $result['status'] = 0;
                $result['msg'] = 'User Id Not Exist';
                $result['data'] = array();
                echo json_encode($result);
                die;
            }
            if (!empty($insertedWishlistData)) {
                $wishlistObj->insert($insertedWishlistData);
                $result['status'] = 1;
                $result['msg'] = 'wishlist add successfully';
                $result['data'] = array();
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Already Exist';
                $result['data'] = array();
                echo json_encode($result);
                die;
            }
        } else {
            $result['status'] = 0;
            $result['msg'] = 'Invalid Details';
            $result['data'] = array();
            echo json_encode($result);
            die;
        }
    }

    /**
     *  addwishlistmultiple
     * addwishlistmultiple 
     *
     * @return response
     * @access public
     */
    public function addwishlistmultiple(Request $request) {
        $classifiedid = $request->classifiedid;
        $user_id = $request->user_id;

        if (!empty($classifiedid) && (!empty($user_id))) {
            $classifiediddata = explode(',', $classifiedid);
            $wishlistObj = new Wishlist;
            $userObj = new User;
            $insertedWishlistData = array();

            foreach ($classifiediddata as $wsKey => $clId) {
                $checkAlreadyExist = $wishlistObj->where('classified_id', '=', $clId)->where('user_id', '=', $user_id)->first();
                if (count($checkAlreadyExist) == 0) {
                    $insertedWishlistData[] = array('user_id' => $user_id, 'classified_id' => $clId);
                }
            }


            $checkUserExist = $userObj->where('id', '=', $user_id)->first();
            if (count($checkUserExist) == 0) {
                $result['status'] = 0;
                $result['msg'] = 'User Id Not Exist';
                $result['data'] = array();
                echo json_encode($result);
                die;
            }
            if (!empty($insertedWishlistData)) {
                $wishlistObj->insert($insertedWishlistData);
                $result['status'] = 1;
                $result['msg'] = 'wishlist add successfully';
                $result['data'] = array();
                echo json_encode($result);
                die;
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Already Exist';
                $result['data'] = array();
                echo json_encode($result);
                die;
            }
        } else {
            $result['status'] = 0;
            $result['msg'] = 'Invalid Details';
            $result['data'] = array();
            echo json_encode($result);
            die;
        }
    }

    /**
     *  removewishlist
     * removewishlist 
     *
     * @return response
     * @access public
     */
    public function removewishlist(Request $request) {
        $classifiedid = $request->classifiedid;
        $user_id = $request->user_id;

        if (!empty($classifiedid) && (!empty($user_id))) {
            $wishlistObj = new Wishlist;
            $userObj = new User;
            $insertedWishlistData = array();
            $checkAlreadyExist = $wishlistObj->where('classified_id', '=', $classifiedid)->where('user_id', '=', $user_id)->first();
            $checkUserExist = $userObj->where('id', '=', $user_id)->first();
            if (count($checkUserExist) == 0) {
                $result['status'] = 0;
                $result['msg'] = 'User Id Not Exist';
                $result['data'] = array();
                echo json_encode($result);
                die;
            }
            if (empty($checkAlreadyExist)) {
                $result['status'] = 0;
                $result['msg'] = 'Classified Not Exist';
                $result['data'] = array();
                echo json_encode($result);
                die;
            } else {
                $wishlistObj->where('user_id', '=', $user_id)->where('classified_id', '=', $classifiedid)->delete();
                $result['status'] = 1;
                $result['msg'] = 'wishlist Remove successfully';
                $result['data'] = array();
                echo json_encode($result);
                die;
            }
        } else {
            $result['status'] = 0;
            $result['msg'] = 'Invalid Details';
            $result['data'] = array();
            echo json_encode($result);
            die;
        }
    }

    /**
     *  classifiedssharing
     * classifiedssharing 
     *
     * @return response
     * @access public
     */
    public function classifiedssharing(Request $request, $id = null) {
        die($id);
        $iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
        $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
        $iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
        $Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
        $webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");

        //do something with this information
        if ($iPod || $iPhone) {
            //browser reported as an iPhone/iPod touch -- do something here
            header("Location: Formee://text=" . $id);
            die();
        } else if ($iPad) {
            //browser reported as an iPad -- do something here
            header("Location: Formee://text=" . $id);
            die();
        } else if ($Android) {
            //browser reported as an Android device -- do something here
            header("Location: Formee://text=" . $id);
            die();
        } else {
            header("Location: Formee://text=" . $id);
            exit;
        }
    }

    /**
     *  simplePushNotificationA
     * simplePushNotificationA 
     *
     * @return response
     * @access public
     */
    public static function simplePushNotificationA($message = NULL, $device_id = NULL, $type = NULL, $senderId = NULL, $classified_id = NULL, $receiver_id = NULL, $messagetype = NULL, $sendername = NULL) {

        $registrationIds = array($device_id);

        // prep the bundle
        $msg = array
            (
            'message' => $message,
            'sender_id' => $senderId,
            'classified_id' => $classified_id,
            'chatuser_id' => $receiver_id,
            'subject' => $messagetype,
            'senderName' => $sendername,
        );
        $attachmentData[] = array(
            'sender_id' => $senderId,
            'receiver_id' => $receiver_id,
            'massage' => $message,
            'classified_id' => $classified_id,
            'deviceid' => $device_id,
            'devicename' => $type,
            'subject' => $messagetype,
        );
        \DB::table('notification')->insert($attachmentData);
        $fields = array
            (
            'registration_ids' => $registrationIds,
            'data' => $msg
        );

        $headers = array
            (
            // 'Authorization: key=' . API_ACCESS_KEY,
            'Authorization: key=AIzaSyA1nkpUUbZ8PeysERRCcVVD3ap46KwPykw',
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        if (!$result)
            return 0;
        else
            return 1;
        exit;
    }

    /**
     *  simplePushNotificationI
     * simplePushNotificationI 
     *
     * @return response
     * @access public
     */
    public static function simplePushNotificationI($msg = NULL, $device_id = NULL, $type = NULL, $senderId = NULL, $classified_id = NULL, $receiver_id = NULL, $sendername = NULL, $deivicetype = NULL, $messagetype = NULL) {
        $now = new DateTime();
        $now->format('Y-m-d H:i:s');
        $currentdatetime = $now->getTimestamp();
        $passphrase = '12345';

        $message = $sendername . ' has sent a message!';
        $attachmentData[] = array(
            'sender_id' => $senderId,
            'receiver_id' => $receiver_id,
            'massage' => $msg,
            'classified_id' => $classified_id,
            'deviceid' => $device_id,
            'devicename' => $deivicetype,
            'subject' => $messagetype,
            'created_at' => $currentdatetime,
        );
        \DB::table('notification')->insert($attachmentData);

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'Certificates.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
            return 0;

        $body['aps'] = array(
            'alert' => $message,
            'type' => $type,
            'sender_id' => $senderId,
            'massage' => $msg,
            'classified_id' => $classified_id,
            'msg_time' => $currentdatetime,
            'sound' => 'default'
        );

        $payload = json_encode($body);
        $msg = chr(0) . pack('n', 32) . pack('H*', $device_id) . pack('n', strlen($payload)) . $payload;
        $result = fwrite($fp, $msg, strlen($msg));


        echo json_encode($result);
        die();
        //dd();
        if (!$result)
            return 0;
        else
            return 1;

        fclose($fp);
        exit;
    }

    /**
     *  simplePushNotificationW
     * simplePushNotificationW 
     *
     * @return response
     * @access public
     */
    public static function simplePushNotificationW($msg = NULL, $device_id = NULL, $type = NULL, $senderId = NULL, $classified_id = NULL, $receiver_id = NULL, $sendername = NULL, $messagetype = NULL, $imageurl = NULL) {
        $now = new DateTime();
        $now->format('Y-m-d H:i:s');
        $currentdatetime = $now->getTimestamp();

        $redis = Redis::connection();
        $data = ['msg' => $msg, 's_id' => $senderId, 'r_id' => $receiver_id, 'classified_id' => $classified_id, 'name' => $sendername, 'image' => $imageurl, 'type' => $messagetype, 'time' => $currentdatetime];
        $redis->publish('message', json_encode($data));



        $message = $sendername . ' has sent a message!';
        $attachmentData[] = array(
            'sender_id' => $senderId,
            'receiver_id' => $receiver_id,
            'massage' => $msg,
            'classified_id' => $classified_id,
            'deviceid' => '',
            'devicename' => 'web',
            'subject' => $messagetype,
        );
        $result = \DB::table('notification')->insert($attachmentData);

        if (!$result)
            return 0;
        else
            return 1;
        exit;
    }

    /**
     *  admin_attributes
     * admin_attributes 
     *
     * @return response
     * @access public
     */
    public function admin_attributes() {

        $data = Input::all();

        $records = Attribute::where(['p_attr_id' => $data['id'], 'attributetype_id' => 4]);

        $result = Attribute::pluck('name', 'id');
        return response()->json(['status' => 1, 'results' => $result]);
    }

    /**
     *  admin_allparrentattributevalues
     * admin_allparrentattributevalues 
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
     *  pushchk
     * pushchk 
     *
     * @return response
     * @access public
     */
    public function pushchk() {
        $options = array(
            'cluster' => 'ap2',
            'encrypted' => true
        );
        $pusher = new \App\library\Pusher(
                '5ec22bd5d75c400eeb67', '9a7e1e37f26c008e0f67', '338448', $options
        );

        $data['message'] = 'hello world';
        $pusher->trigger('my-channel', 'u_1', $data);
        return view('front.classifieds.pusherchk');
    }

    /**
     *  get_c_map
     * get_c_map 
     *
     * @return response
     * @access public
     */
    public function get_c_map(Request $request) {
        $latitude = $request->lat;
        $longitude = $request->lng;

        if (!$latitude && !$latitude) {
            $latitude = -37.813628;
            $longitude = 144.963058;
        }


        $mosqData = DB::select(DB::raw("(select *, categories.id,classifieds.id as classified_id ,classifieds.title as title,classifieds.description as description
                                                                , SQRT(POW(69.1 * (lat - ($latitude)), 2) + POW(69.1 * ($longitude - lng) * COS(lat / 57.3), 2)) AS distance
                                                                from `classifieds`
                                                                left join categories
                                                                on classifieds.parent_categoryid = categories.id
                                                                group by classifieds.title 
                                                                HAVING distance < 150 and
                                                                classifieds.parent_categoryid = 33 and 
                                                                classifieds.status = 1 
                                                                ORDER BY distance ASC)"));
        echo json_encode($mosqData);
        die;
    }

    /**
     * Admin all classified
     * function for get all categoris
     *
     * @return response
     * @access public
     */
    public function admin_allclassified() {

        $data = Input::all();
        $result = [];
        if ($data['id'] != '') {
            $result = $this->model->classifiedListing(['category_id' => $data['id'], 'status' => 1]);
        }
        return response()->json(['status' => true, 'results' => $result]);
    }

    /**
     * from front get suburbs detail with ajax call
     * function get_suburbs_for_filter
     *
     * @return response
     * @access public
     */
    public function get_suburbs_for_filter() {

        $data = Input::all();

        $suburubmodel = new Suburb;
        $subrestult = $suburubmodel->select('id', 'suburb', 'postcode', DB::raw('concat(suburb, " " , postcode, " ", state) as value'))
                ->where(function($q1) use($data) {
                    $q1->where('suburb', 'LIKE', '%' . $data['text_data'] . '%')
                    ->orwhere('postcode', 'LIKE', '%' . $data['text_data'] . '%');
                })
                ->limit(50)
                ->get();

        return response()->json(['status' => true, 'results' => $subrestult]);
    }

    /**
     * comman function for call sessis api
     * function sensis_search
     *
     * @return response
     * @access public
     */
    function sensis_search($query, $location, $categoryid = 0) {

        # put your API key here
        $apikey = "ef4j3tvjk2nvjy77s4mzty25";

        # location of the search API endpoint
        //$endpoint = "http://api.sensis.com.au/v1/test/search";
        $endpoint = "http://api.sensis.com.au/v1/prod/search";

        # construct a URL with the query string, escaping any special characters.
        if ($categoryid != 0) {
            $url = $endpoint . "?key=" . $apikey .
                    "&query=" . urlencode($query) .
                    "&location=" . urlencode($location) .
                    "&categoryId=" . urlencode($categoryid);
        } else {
            $url = $endpoint . "?key=" . $apikey .
                    "&query=" . urlencode($query) .
                    "&location=" . urlencode($location);
        }
        # call the endpoint
        $response = $this->file_get_contents_curl($url);

        # ensure we actually got a response back         
        if (!$response) {
            throw new Exception("Error calling API ($http_response_header[0])");
        }

        # convert the response message to an associative array
        $result = json_decode($response, true);
        # grab the response code
        $code = $result["code"];

        # ensure successful status code
        if ($code == 200) { # success
            return $result;
        } else {
            // throw new Exception("API returned error: " . 
            //  $result["message"] . ", code: " . $result["code"]);
        }
    }

    /**
     * call from front via ajax
     * function get_sensis_search
     *
     * @return response
     * @access public
     */
    function get_sensis_search() {
        $data = Input::all();
        $sensis_results_restaurants = $this->sensis_search($data['query'], $data['location']);

        return response()->json(['status' => true, 'results' => $sensis_results_restaurants]);
    }

    /**
     * listing of information category list from sensis api
     * function information_list
     *
     * @return response
     * @access public
     */
    function file_get_contents_curl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

}
