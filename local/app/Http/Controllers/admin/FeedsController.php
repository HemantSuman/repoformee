<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\Feed;
use App\models\FeedCategory;
use App\models\Category;
use App\models\User;
use App\Classes\PrayTime;
use Hash;
use DB;
use Mail;
use App\Event;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Validator;

class FeedsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'feeds';
        $this->viewName = 'feeds';
        $this->modelTitle = 'Feed';
        $this->model = new Feed;

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
    public function admin_index() {

    	$modelTitle = $this->modelTitle;
        $actionName = $this->actionName;
        $viewName = $this->viewName;
        $controllerName = $this->controllerName;

        $requestArr = Input::all();
        $requestVal = '';
        if (!empty($requestArr)) {
            foreach ($requestArr as $key => $value) {
                if (!in_array($key, ['_token', 'form_search', 'page', 'sort', 'direction'])) {
                    $this->model = $this->model->where($key, 'LIKE', "%{$value}%");
                }
                $requestVal = $value;
            }
            if(!empty($requestArr["sort"])) {
                $this->model = $this->model->orderBy($requestArr["sort"], $requestArr["direction"]);
            }
            $data = $this->model->orderBy('id','DESC')->paginate(10);
        } else {
            $data = $this->model->paginate(10);
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
                "url" => "required|"
            ], [
            	'url.regex' => 'Please provide a valid URL',
                'feed_category_id.required' => 'Please select a category.'
            ]);

        	$data = new \App\Feed;
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

        $feed_categories = \DB::table("feed_categories")->pluck("title", "id")->all();
        
        return view('admin/' . $this->viewName . '/add', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'feed_categories'));
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
            	->select("id", "feed_category_id", 'news_type', "title", "url", "status", "front_status", "created_at")
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

        $feed_categories = \DB::table("feed_categories")->pluck("title", "id")->all();

        return view('admin/' . $this->viewName . '/edit', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'data', 'feed_categories'));
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
     * Admin Update Feed Home Status
     * 
     *
     * @return void
     * @access public
     */
    public function admin_update_feed_home_status(Request $request) {

        if ($request->isMethod('post')) {
	    	if($request->state == "true") {
	    		$updated_data["front_status"] = 1;
	        } else {
	        	$updated_data["front_status"] = 0;
	        }
	        \DB::table('feeds')->where("id", $request->id)->update($updated_data);
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
     * News feed page at front
     *
     * @return void
     * @access public
     */
    public function index(Request $request) {
        
        
        $userObj = new User;

        $feactured_category = Category::where('pid', 0)->where('feactured', 1)->where("status", "=", 1)->orderBy('created_at', 'DESC')->get();
        $selectedCategories = null;
        $task = new Category;
        $selectedCategories = explode(',', $selectedCategories);
        $allSubCategories = $task->getFrontCategories($selectedCategories);
        $allComCategories = $task->getFrontComCategories($selectedCategories);
        $allSubCategoriesForMenu = $task->getFrontCategoriesForMenu($selectedCategories);

        if($request->isMethod('post')) {
            $feedCategoryObj = new FeedCategory;
            $data = $feedCategoryObj->with(["feeds" => function($feeds) {
                $feeds->where("status", "=", 1);
            }])->first();
            if(isset($request->fcid)) {
                $data = $feedCategoryObj->with(["feeds" => function($feeds) {
                    $feeds->where("status", "=", 1);
                }])->where("id", "=", $request->fcid)->first();
            }

            $feeds = array();
            foreach($data->feeds as $feedsKey => $feedsVal) {
                $newsFeeds = $this->model->get_feeds($feedsVal->url);

                $x = new \SimpleXmlElement($newsFeeds);
                $feedImage = $x->channel->image->url;
                $feedImageLink = $x->channel->image->link;
                foreach($x->channel->item as $entry) {
                    $feeds[] = array(
                        'news_type' => $feedsVal->news_type,
                        'title' => $entry->title,
                        'url' => $entry->link,
                        'description' => $entry->description,
                        'publish_date' => $entry->pubDate,
                        'image' => $feedImage,
                        'image_url' => $feedImageLink
                    );
                }
            }

            if(isset($request->keyword)) {
                foreach($feeds as $fdKey => $fdVal) {                    
                    if(!empty($request->keyword)) {
                        if (stripos($fdVal['title'], $request->keyword) === false) {
                            unset($feeds[$fdKey]);
                        }
                    }
                    
                }
            }
            
            return view('front/feeds/feeds_ui', compact('feeds'));
            die;
        }



        $feed_categories = \DB::table("feed_categories")->pluck("title", "id")->all();

        return view('front.feeds.index', compact('allSubCategories','feactured_category', 'allComCategories', 'allSubCategoriesForMenu', 'feed_categories', 'feeds', 'feedImage'));
    }
}
