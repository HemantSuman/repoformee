<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\SiteReport;
use App\models\Category;
use App\models\Classified;
use App\models\SavedSearch;
use Hash;
use DB;
use Mail;
use App\Event;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Validator;
use App\Helpers\Helper;

class SiteReportsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'site_reports';
        $this->viewName = 'site_reports';
        $this->modelTitle = 'Report Manager';
        $this->model = new SiteReport;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     *
     * @return void
     * @access public
     */
    public function admin_index(Request $request) {
        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $categoryObj = new Category;
        $most_posted_classified_category = $categoryObj->most_posted_classified_category();
        $most_viewed_classified_category = $categoryObj->most_viewed_classified_category();
        $unique_visitors = \DB::table('site_visitors')->count();

        $categories = $categoryObj->categoryListing(['pid' => 0]);
        $BelongsToCommunities = $categoryObj->where(['pid' => 0])->pluck('belong_to_community', 'id')->toArray();

        $data = array();
        $requestData = array();
        if ($request->isMethod('post')) {
            $requestData = $request->all();
            $this->validate($request, [
                'report_type' => 'required',
                'parent_category_id' => 'sometimes',
                'start_date' => 'sometimes',
                'end_date' => 'sometimes',
                    ], [
                'parent_category_id.required' => 'The category field is required.',
                'start_date.less_than' => 'The Start Date should be less than End Date.',
            ]);

            $classifiedObj = new Classified;
            if (!empty($request->report_duration)) {
                    $duration = $request->report_duration;
                }
            if ($request->report_type == 'AnalyticsofEachCategory') {
                $conditions = array(
                    array('parent_categoryid', $request->parent_category_id)
                );
                if (!empty($request->subcategory_id)) {
                    $conditions[] = array('category_id', $request->subcategory_id);
                }
                
                if ($duration == 'Daily') {
                    $data = $classifiedObj
                            ->where($conditions)
                            ->where("start_date", "=",  date("Y-m-d"))
                            ->with(["Subcategoriesname" => function($classified_subCategory) {
                                    $classified_subCategory->select('id', 'name');
                                }])->with(["categoriesname" => function($classified_category) {
                                    $classified_category->select("id", "name");
                                }])
                            ->paginate(10);
                } elseif ($duration == 'weekly') {
                    $data = $classifiedObj
                            ->where($conditions)
                            ->whereBetween('start_date', [date('Y-m-d', strtotime("-7 days")), date("Y-m-d")])
                            ->with(["Subcategoriesname" => function($classified_subCategory) {
                                    $classified_subCategory->select('id', 'name');
                                }])->with(["categoriesname" => function($classified_category) {
                                    $classified_category->select("id", "name");
                                }])
                            ->paginate(10);
                } elseif ($duration == 'Monthly') {
                    $data = $classifiedObj
                            ->where($conditions)
                            ->whereBetween('start_date', [date('Y-m-d', strtotime("-30 days")), date("Y-m-d")])
                            ->with(["Subcategoriesname" => function($classified_subCategory) {
                                    $classified_subCategory->select('id', 'name');
                                }])->with(["categoriesname" => function($classified_category) {
                                    $classified_category->select("id", "name");
                                }])
                            ->paginate(10);
                } else {
                    $data = $classifiedObj
                            ->where($conditions)
                            ->where("start_date", ">=", date("Y-m-d", strtotime($request->start_date)))
                            ->where("start_date", "<=", date("Y-m-d", strtotime($request->end_date)))
                            ->with(["Subcategoriesname" => function($classified_subCategory) {
                                    $classified_subCategory->select('id', 'name');
                                }])->with(["categoriesname" => function($classified_category) {
                                    $classified_category->select("id", "name");
                                }])
                            ->paginate(10);
                }


                return view('admin/site_reports/filtered_data', compact('data'));
                die;
            } elseif ($request->report_type == 'MostPostedClassifiedCategory') {
                if ($duration == 'Daily')
                {
                 $data = DB::table('classifieds')
                        ->selectRaw('title,count(parent_categoryid) as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                        ->where(['show_on_info_area' => 0, 'belong_to_community' => 0])
                       ->where("start_date", "=",  date("Y-m-d"))
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(10)
                        ->get();   
                 
                } 
                elseif ($duration == 'weekly')
                {
                   $data = DB::table('classifieds')
                        ->selectRaw('title,count(parent_categoryid) as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                        ->where(['show_on_info_area' => 0, 'belong_to_community' => 0])
                         ->whereBetween('start_date', [date('Y-m-d', strtotime("-7 days")), date("Y-m-d")])
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(10)
                        ->get(); 
                }
                elseif ($duration == 'Monthly')
                {
                    $data = DB::table('classifieds')
                        ->selectRaw('title,count(parent_categoryid) as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                        ->where(['show_on_info_area' => 0, 'belong_to_community' => 0])
                         ->whereBetween('start_date', [date('Y-m-d', strtotime("-30 days")), date("Y-m-d")])
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(10)
                        ->get();
                }
                else
                {
                    $data = DB::table('classifieds')
                        ->selectRaw('title,count(parent_categoryid) as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                        ->where(['show_on_info_area' => 0, 'belong_to_community' => 0])
                        ->where("start_date", ">=", date("Y-m-d", strtotime($request->start_date)))
                        ->where("start_date", "<=", date("Y-m-d", strtotime($request->end_date)))
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(10)
                        ->get();
                }
                

                return view('admin/site_reports/report_data', compact('data'));
                die;
            } elseif ($request->report_type == 'Analyticsofsavesearch') { 
                
                if ($duration == 'Daily')
                {
                 $data = DB::table('saved_searches')
                        ->selectRaw('keyword,categories.name as name,count(keyword) as total,category_id,is_category_parent')
                        ->leftJoin('categories', 'saved_searches.category_id', '=', 'categories.id')
                         ->whereDate("saved_searches.created_at", "=",  date("Y-m-d"))
                        ->groupby('keyword')
                        ->orderBy('total', 'Desc')
                        ->limit(10)
                        ->get();   
                } 
                elseif ($duration == 'weekly')
                {
                  $data = DB::table('saved_searches')
                        ->selectRaw('keyword,categories.name as name,count(keyword) as total,category_id,is_category_parent')
                        ->leftJoin('categories', 'saved_searches.category_id', '=', 'categories.id')
                           ->whereBetween('saved_searches.created_at', [date('Y-m-d', strtotime("-7 days")), date("Y-m-d")])
                        ->groupby('keyword')
                        ->orderBy('total', 'Desc')
                        ->limit(10)
                        ->get();  
                }
                elseif ($duration == 'Monthly')
                {
                 $data = DB::table('saved_searches')
                        ->selectRaw('keyword,categories.name as name,count(keyword) as total,category_id,is_category_parent')
                        ->leftJoin('categories', 'saved_searches.category_id', '=', 'categories.id')
                          ->whereBetween('saved_searches.created_at', [date('Y-m-d', strtotime("-30 days")), date("Y-m-d")])
                        ->groupby('keyword')
                        ->orderBy('total', 'Desc')
                        ->limit(10)
                        ->get();   
                }
                else
                {
                 $data = DB::table('saved_searches')
                        ->selectRaw('keyword,categories.name as name,count(keyword) as total,category_id,is_category_parent')
                        ->leftJoin('categories', 'saved_searches.category_id', '=', 'categories.id')
                        ->whereDate('saved_searches.created_at', ">=", date("Y-m-d", strtotime($request->start_date)))
                        ->whereDate('saved_searches.created_at', "<=", date("Y-m-d", strtotime($request->end_date)))
                        ->groupby('keyword')
                        ->orderBy('total', 'Desc')
                        ->limit(10)
                        ->get();   
                }
                

                return view('admin/site_reports/report_data_search', compact('data'));
                die;
            } else { 
              
                if ($duration == 'Daily')
                {
                  $data = DB::table('classifieds')
                        ->selectRaw('title,count as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                           ->where("start_date", "=",  date("Y-m-d"))
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(10)
                        ->get();  
                } 
                elseif ($duration == 'weekly')
                {
                  $data = DB::table('classifieds')
                        ->selectRaw('title,count as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                          ->whereBetween('start_date', [date('Y-m-d', strtotime("-7 days")), date("Y-m-d")])
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(10)
                        ->get();  
                }
                elseif ($duration == 'Monthly')
                {
                    $data = DB::table('classifieds')
                        ->selectRaw('title,count as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                            ->whereBetween('start_date', [date('Y-m-d', strtotime("-30 days")), date("Y-m-d")])
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(10)
                        ->get();
                }
                else
                {
                  $data = DB::table('classifieds')
                        ->selectRaw('title,count as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                        ->where("start_date", ">=", date("Y-m-d", strtotime($request->start_date)))
                        ->where("start_date", "<=", date("Y-m-d", strtotime($request->end_date)))
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(10)
                        ->get();  
                }
                
                return view('admin/site_reports/report_data_view', compact('data'));
                die;
            }
        }

        return view('admin/' . $this->viewName . '/index', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'most_posted_classified_category', 'most_viewed_classified_category', 'unique_visitors', 'categories', 'BelongsToCommunities', 'data', 'requestData'));
    }

   /**
     * Admin getreportdata
     * indexing of all getreportdata created by admin
     *
     * @return void
     * @access public
     */
    public function getreportdata(Request $request) {
        $requestData = $request->all();
        $this->validate($request, [
            'report_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
                ], [
            'parent_category_id.required' => 'The category field is required.',
            'start_date.less_than' => 'The Start Date should be less than End Date.',
        ]);
        if ($request->report_type == 'MostPostedClassifiedCategory') {
            $data = DB::table('classifieds')
                    ->selectRaw('title,count(parent_categoryid) as total,parent_categoryid,categories.name')
                    ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                    ->where(['show_on_info_area' => 0, 'belong_to_community' => 0])
                    ->where("start_date", ">=", date("Y-m-d", strtotime($request->start_date)))
                    ->where("start_date", "<=", date("Y-m-d", strtotime($request->end_date)))
                    ->groupby('parent_categoryid')
                    ->orderBy('total', 'Desc')
                    ->limit(10)
                    ->get();

            return view('admin/site_reports/report_data', compact('data'));
            die;
        } else {
            $data = DB::table('classifieds')
                    ->selectRaw('title,count as total,parent_categoryid,categories.name')
                    ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                    ->where("start_date", ">=", date("Y-m-d", strtotime($request->start_date)))
                    ->where("start_date", "<=", date("Y-m-d", strtotime($request->end_date)))
                    ->groupby('parent_categoryid')
                    ->orderBy('total', 'Desc')
                    ->limit(10)
                    ->get();
            return view('admin/site_reports/report_data_view', compact('data'));
            die;
        }
    }
    
     /**
     * Admin generatereportcategorypost
     * indexing of all generatereportcategorypost created by admin
     *
     * @return void
     * @access public
     */
     public function generatereportcategorypost(Request $request) {
        $requestData = $request->all();
        $duration=$request->duration;
         if ($duration == 'Daily')
                {
                 $data = DB::table('classifieds')
                        ->selectRaw('title,count(parent_categoryid) as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                        ->where(['show_on_info_area' => 0, 'belong_to_community' => 0])
                       ->where("start_date", "=",  date("Y-m-d"))
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(10)
                        ->get();   
                 
                } 
                elseif ($duration == 'weekly')
                {
                   $data = DB::table('classifieds')
                        ->selectRaw('title,count(parent_categoryid) as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                        ->where(['show_on_info_area' => 0, 'belong_to_community' => 0])
                         ->whereBetween('start_date', [date('Y-m-d', strtotime("-7 days")), date("Y-m-d")])
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(5)
                        ->get(); 
                }
                elseif ($duration == 'Monthly')
                {
                    $data = DB::table('classifieds')
                        ->selectRaw('title,count(parent_categoryid) as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                        ->where(['show_on_info_area' => 0, 'belong_to_community' => 0])
                         ->whereBetween('start_date', [date('Y-m-d', strtotime("-30 days")), date("Y-m-d")])
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(5)
                        ->get();
                } 
                else
                {
                    $data = DB::table('classifieds')
                        ->selectRaw('title,count(parent_categoryid) as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                        ->where(['show_on_info_area' => 0, 'belong_to_community' => 0])
                        ->where("start_date", ">=", date("Y-m-d", strtotime($request->start_date)))
                        ->where("start_date", "<=", date("Y-m-d", strtotime($request->end_date)))
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(5)
                        ->get();
                }
               
                return json_encode($data);
                die();
                
    }
    
     /**
     * Admin generatereportcategoryview
     * indexing of all generatereportcategoryview created by admin
     *
     * @return void
     * @access public
     */
    public function generatereportcategoryview(Request $request){
        $requestData = $request->all();
        $duration=$request->duration;
        
        if ($duration == 'Daily')
                {
                  $data = DB::table('classifieds')
                        ->selectRaw('title,count as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                           ->where("start_date", "=",  date("Y-m-d"))
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(5)
                        ->get();  
                } 
                elseif ($duration == 'weekly')
                {
                  $data = DB::table('classifieds')
                        ->selectRaw('title,count as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                          ->whereBetween('start_date', [date('Y-m-d', strtotime("-7 days")), date("Y-m-d")])
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(5)
                        ->get();  
                }
                elseif ($duration == 'Monthly')
                {
                    $data = DB::table('classifieds')
                        ->selectRaw('title,count as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                            ->whereBetween('start_date', [date('Y-m-d', strtotime("-30 days")), date("Y-m-d")])
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(5)
                        ->get();
                }
                else
                {
                  $data = DB::table('classifieds')
                        ->selectRaw('title,count as total,parent_categoryid,categories.name')
                        ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                        ->where("start_date", ">=", date("Y-m-d", strtotime($request->start_date)))
                        ->where("start_date", "<=", date("Y-m-d", strtotime($request->end_date)))
                        ->groupby('parent_categoryid')
                        ->orderBy('total', 'Desc')
                        ->limit(5)
                        ->get();  
                }
                 return json_encode($data);
                die();
    }

}
