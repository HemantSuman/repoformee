<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\Report;
use Hash;
use DB;
use Mail;
use App\Event;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Validator;

class ReportsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'reports';
        $this->viewName = 'reports';
        $this->modelTitle = 'Spam Reports';
        $this->model = new Report;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     * indexing of all feeds
     *
     * @return void
     * @access public
     */
    public function admin_index(Request $request) {

    	$modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $requestArr = Input::all();
        $requestVal = '';
        if (!empty($requestArr)) {
            $data = $this->model->orderBy('id','DESC')->paginate(10);
            
            if(isset($request->title)) {
                $requestVal = $title = $request->title;
                $data = $this->model->whereHas('classified', function($classified) use($title) {
                    $classified->where("title", "LIKE", "%{$title}%");
                    $classified->with(["classified_users" => function($classified_users) {
                        $classified_users->select("id", "name");
                    }]);
                    $classified->select("id", "user_id", "title", "status");
                })->with(["user" => function($user) {
                    $user->select("id", "name");
                }])->paginate(10);
            }
        } else {
            $data = $this->model->with(['classified' => function($classified) {
                    $classified->with(["classified_users" => function($classified_users) {
                        $classified_users->select("id", "name");
                    }]);
            		$classified->select("id", "user_id", "title", "status");
	            }])->with(["user" => function($user) {
                    $user->select("id", "name");
                }])->paginate(10);
        }
        
        $data->setPath('')->appends(Input::query())->render();
        return view('admin/' . $this->viewName . '/index', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'data', 'requestVal'));
    }

    /**
     * Admin create
     * function for create a feed
     *
     * @return void
     * @access public
     */
    public function admin_add(Request $request) {

    	$modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        if ($request->isMethod('post')) {

      		$regex = "/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/";
        	$this->validate($request, [
                'feed_category_id' => 'required',
                'news_type' => 'required',
                'title' => 'required',
                "url" => "required|regex:".$regex
            ], [
            	'url.regex' => 'Please provide a valid URL',
                'feed_category_id.required' => 'Please select a category.'
            ]);

        	$data = new \App\models\Feed;
        	$data->feed_category_id = Input::get('feed_category_id');
            $data->news_type = Input::get('news_type');
	        $data->title = Input::get('title');
	        $data->url = Input::get('url');
	        $data->status = Input::get('url');
	        if(Input::get('status')) {
	        	$data->status = 1;
	        } else {
	        	$data->status = 0;
	        }

	        if($data->save()) {
		    	return \Redirect('admin/feeds')->withSuccess( ' Feed has been added successfully.' );
		    } else {
		        return \Redirect('admin/feeds')->withDanger( ' Feed could not be saved. Please try again.' );
		    }  
        }
        
        return view('admin/' . $this->viewName . '/add', compact('modelTitle', 'controllerName', 'actionName', 'viewName'));
    }

    /**
     * Admin edit
     * function for edit any feed
     *
     * @return void
     * @access public
     */
    public function admin_edit($id = null, Request $request) {

        $modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        try {
            $data = Feed::where("id", "=", $id)
            	->select("id", "feed_category_id", "title", "url", "status", "front_status", "created_at")
            	->first();
        } catch (\Exception $e) {
            
        }

        if ($request->isMethod('post')) {

        	$this->validate($request, [
                'feed_category_id' => 'required',
                'news_type' => 'required',
                'title' => 'required',
                'url' => 'required',
            ]);

            $updated_data["feed_category_id"] = Input::get('feed_category_id');
            $updated_data["news_type"] = Input::get('news_type');
        	$updated_data["title"] = Input::get('title');
        	$updated_data["url"] = Input::get('url');
        	if (!isset($request->status) && $request->status != 1) {
                $updated_data["status"] = 0;
            } else {
            	$updated_data["status"] = 1;
            }

            try {
                \DB::table('feeds')->where("id", $id)->update($updated_data);

                return \Redirect('admin/feeds')->withSuccess( ' Feed has been updated successfully.' );
            } catch (\Exception $e) {
                return redirect('admin/feeds/edit/' . $id)->withDanger( ' Feed could not be saved. Please try again.' );
            }
        }

        return view('admin/' . $this->viewName . '/edit', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'data'));
    }

    /**
     * Admin delete
     * delete feeds
     *
     * @return void
     * @access public
     */
    public function admin_delete() {

        $viewName = $this->viewName;
        $data = Input::all();
        $id = $data['id'];

        if (!empty($id)) {
            
            $result = $this->model->findOrFail($id);

            $result->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully Deleted.');
            return response()->json(['status' => true, 'url' => 'feeds']);
        }
    }

    /**
     * Admin Multi Check Rows
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_multi_check_options() {

        $data = Input::all();
        if (!empty($data['checkedId'])) {
            foreach ($data['checkedId'] as $key => $value) {
                DB::table('feeds')
                        ->where('id', $value)
                        ->update(['status' => $data['status']]);
            }
            return response()->json(['status' => true, 'url' => 'feeds']);
        }
    }

     /**
     * Admin report
     * report
     *
     * @return void
     * @access public
     */
    public function report(Request $request) {
    	if ($request->isMethod('post')) {
            if(Auth::guard('web')->user()) {
                $checkAlreadyReport = $this->model
                    ->where("classified_id", "=", Input::get('classified_id'))
                    ->where("user_id", "=", Auth::guard('web')->user()->id)
                    ->first();
                if(count($checkAlreadyReport) == 0) {
                    $data = new \App\models\Report;
                    $data->classified_id = Input::get('classified_id');
                    $data->report_type = Input::get('report_type');
                    $data->comment = Input::get('comment');
                    $data->user_id = Auth::guard('web')->user()->id;
                    
                    if($data->save()) {
                        return response()->json(['status' => true, 'message' => ' Your  report has been successfully submitted.']);
                    } else {
                        return response()->json(['status' => false, 'message' => 'Failed. Please try again.']);
                    }
                } else {
                    return response()->json(['status' => false, 'message' => 'You have previously reported this ad.']);
                }
    		} else {
    			return response()->json(['status' => false, 'message' => 'You must be logged in to perform this action.']);
    		}
    		
    		
    	}
    }
    
     /**
     * reportclassifiedapi
     * reportclassifiedapi
     *
     * @return void
     * @access public
     */
    public function reportclassifiedapi(Request $request) {
    	if ($request->isMethod('post')) { 
            $loginid = $request->user_id;
            $classified_id = $request->classified_id;
            $report_type = $request->report_type;
            $comment = $request->comment;
            if(!empty($loginid) && !empty($classified_id) && !empty($report_type) && !empty($comment)) { 
                $checkAlreadyReport = $this->model
                    ->where("classified_id", "=", $classified_id)
                    ->where("user_id", "=", $loginid)
                    ->first();
                if(count($checkAlreadyReport) == 0) {
                    $data = new \App\models\Report;
                    $data->classified_id = $classified_id;
                    $data->report_type = $report_type;
                    $data->comment = $report_type;
                    $data->user_id = $loginid;
                    
                    if($data->save()) { 
                        $result['status'] = 1;
                        $result['msg'] = 'Reported Successful';
                        echo json_encode($result);
                        die;
                        
                    } else {
                        $result['status'] = 0;
                        $result['msg'] = 'Failed. Please try again.';
                        echo json_encode($result);
                        die;
                        
                    }
                } else {
                    $result['status'] = 0;
                        $result['msg'] = 'You have previously reported this ad.';
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
    }
}
