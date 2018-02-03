<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\Newsletter;
use App\models\NewsletterAttachment;
use App\models\SubscriberList;
use App\models\NewsletterSubscriber;
use App\models\NewsletterTemplate;
use Hash;
use DB;
use File;
use Mail;
use App\Event;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Validator;
use Illuminate\Console\Scheduling\Schedule;
use App\Events\SendNewsletter;

class NewslettersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'newsletters';
        $this->viewName = 'newsletters';
        $this->modelTitle = 'Newsletters';
        $this->model = new Newsletter;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     * indexing of all newsletters created by admin
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

            $data = $this->model->orderBy('id','DESC')->with(["newsletter_subscribers" => function ($detail) {
                    $detail->where("status", "=", 1);
                }])->paginate(10);
        } else {
            $data = $this->model->orderBy('id', 'DESC')->with(["newsletter_subscribers" => function ($detail) {
                    $detail->where("status", "=", 1);
                }])->paginate(10);
        }

        $data->setPath('')->appends(Input::query())->render();
    	return view('admin/' . $this->viewName . '/index', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'data', 'requestVal'));
    }

    /**
     * Admin create
     * function for create a newsletter
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
                'recipients' => 'required',
                'title' => 'required'
            ]);


            $data = new \App\models\Newsletter;
	        $data->title = Input::get('title');
	        $users = Input::get('recipients');

	        $data->recipients = $selected_subscribers = implode(",", Input::get('recipients'));
	        $data->body = Input::get('body');
            $data->type = (!empty(Input::get('is_default_template')) ? "html" : "plain");
	        $data->no_of_unsubscribers = 0;
            $data->is_default_template = $is_default_template = (Input::get('is_default_template')) ? 1 : 0;

            

            // getting all of the post data
		    $files = Input::file('images');
		    // Making counting of uploaded images
		    $file_count = count($files);
		    // start count how many uploaded
        	$filesArray = array();
            if($file_count > 0) {
                foreach($files as $file) {
                    $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                    $validator = Validator::make(array('file'=> $file), $rules);
                    if($validator->passes()) {
                        $destinationPath = 'upload_images/newsletters/';
                        $extension = $file->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $fileName = $ran . '.' . $extension;
                        $upload_success = $file->move($destinationPath, $fileName);
                        $filesArray[] = $fileName;
                    }
                }    
            }
            
            if(Input::get('timer')) {
                $data->timer = date("Y-m-d", strtotime(Input::get('timer')));  
                $successMessage = "Newsletter template has been saved successfully.";
            } else {
                // fired an event to send the newsletter to the users
                event(new SendNewsletter($is_default_template, Input::get('title'), Input::get('body'), $users, $filesArray));
                $successMessage = "Newsletter template has been sent to the users successfully.";
            }
            $data->no_of_reciepents = count($users);        	


		    if($data->save()) {
                $lastInsertId = $data->id;
                $this->saveNewsletterSubscriber($lastInsertId, $users);
                if($file_count > 0) {
                    $this->saveNewsletterAttachment($lastInsertId, $filesArray);
                }

		    	return \Redirect('admin/newsletters')->withSuccess( $successMessage );
		    } else {
		        return \Redirect('admin/newsletters')->withDanger( ' Please try again.' );
		    }
        }
        
        $all_subscribers = SubscriberList::where("status", "=", 1)->orderBy('id', 'DESC')->pluck('email', 'email')->all();
        
    	return view('admin/' . $this->viewName . '/create', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'all_subscribers'));
    }

    /**
     * Admin edit
     * function for edit any newsletter
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
            $data = Newsletter::where("id", "=", $id)
                ->with('newsletter_attachments')
                ->with(["newsletter_subscribers" => function ($detail) {
                    $detail->where("status", "=", 1);
                }])
                ->first();

            $previous_attachments = $data->newsletter_attachments;
        } catch (\Exception $e) {
            
        }

        if ($request->isMethod('post')) {
            
            $this->validate($request, [
                'recipients' => 'required',
                'title' => 'required'
            ], [
                
            ]);


            $updated_data['title'] = Input::get('title');
            $users = Input::get('recipients');

            $updated_data['recipients'] = $selected_subscribers = implode(",", Input::get('recipients'));
            $updated_data['body'] = Input::get('body');
            $updated_data['type'] = (!empty(Input::get('is_default_template')) ? "html" : "plain");
            $updated_data['no_of_unsubscribers'] = 0;
            
            // getting all of the post data
            $files = Input::file('images');
            // Making counting of uploaded images
            $file_count = count($files);
            // start count how many uploaded
            $newMergedFilesArray = $filesArray = array();
            if($file_count > 0) {
                foreach($files as $file) {
                    $rules = array('file' => 'required'); 
                    $validator = Validator::make(array('file'=> $file), $rules);
                    if($validator->passes()) {
                        $destinationPath = 'upload_images/newsletters/';
                        $extension = $file->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $fileName = $ran . '.' . $extension;
                        $upload_success = $file->move($destinationPath, $fileName);
                        $newMergedFilesArray[] = $filesArray[] = $fileName;
                    }
                }    
            }

            foreach($previous_attachments as $key => $single) {
                $newMergedFilesArray[] = $single["image"];
            }
            

            if(Input::get('timer')) {
                $updated_data['timer'] = date("Y-m-d", strtotime(Input::get('timer')));  
            } else {
                // fired an event to send the newsletter to the users
                event(new SendNewsletter(Input::get('is_default_template'), Input::get('title'), Input::get('body'), $users, $newMergedFilesArray));
                $successMessage = "Newsletter template has been sent to the users successfully.";
            }
            $updated_data['no_of_reciepents'] = count($users);

            try {
                \DB::table('newsletters')->where("id", $id)->update($updated_data);
                if($file_count > 0) {
                    $this->saveNewsletterAttachment($id, $filesArray);
                }
                return \Redirect('admin/newsletters')->withSuccess( ' Newsletter template has been saved successfully.' );
            } catch (\Exception $e) {
                dd($e);
                return redirect('admin/newsletters/edit/' . $id)->withDanger( ' Newsletter template could not be saved. Please try agin' );
            }
        }

        $all_subscribers = SubscriberList::where("status", "=", 1)->orderBy('id', 'DESC')->pluck('email', 'email')->all();

        return view('admin/' . $this->viewName . '/edit', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'all_subscribers', 'data'));
    }

    /**
     * Admin delete
     * delete newsletter
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
            return response()->json(['status' => true, 'url' => 'newsletters']);
        }
    }

    /**
     * Send Newsletter
     * function for send newsletter to users
     *
     * @return Number of mail delievered successfully
     * @access public
     */
    public function send_newsletter($template = null, $title = null, $body = null, $users = null, $filesArray = null) {
    	
        if(!empty($template)) {
            Mail::send('emails.'.$template, array('emails' => $users, 'body' => $body), function($message) use ($users, $filesArray, $title) {
                $message->from('avinesh.mathur@planetwebsolution.com');
                $message->to($users)->subject($title);
                
                foreach($filesArray as $file) {
                    $message->attach(asset("/upload_images/newsletters/".$file));
                }
            },true);    
        } else {
            // if any newsletter template not selected by the admin
            Mail::send('emails.demoNewsletter', array('emails' => $users, 'body' => $body), function($message) use ($users, $filesArray, $title) {
                $message->from('avinesh.mathur@planetwebsolution.com');
                $message->to($users)->subject($title);
                
                foreach($filesArray as $file) {
                    $message->attach(asset("/upload_images/newsletters/".$file));
                }
            },true);
        }
    	
        return ( count(Mail::failures()));
    }

    /**
     * Save Newsletter Attachment
     *
     * @return void
     * @access public
     */
    public function saveNewsletterAttachment($lastInsertId = null, $attachments = null) {
        
        foreach($attachments as $key => $image) {
            $attachmentData[] = array('newsletter_id' => $lastInsertId, 'image' => $image);
        }
        
        \DB::table('newsletter_attachments')->insert($attachmentData);
    }

    /**
     * Save Newsletter Subscibers
     *
     * @return void
     * @access public
     */
    public function saveNewsletterSubscriber($lastInsertId = null, $users = null) {
        
        foreach($users as $key => $email) {
            $subscriberData[] = array('newsletter_id' => $lastInsertId, 'email' => $email);
        }

        \DB::table('newsletter_subscribers')->insert($subscriberData);
    }

    /**
     * Send Newsletter
     * function for send newsletter to users using cron
     *
     * @return Number of mail delievered successfully
     * @access public
     */
    public function send_newsletter_using_cron() {

        $data = Newsletter::where("timer", "=", date('Y-m-d'))
                ->with('newsletter_attachments')
                ->get();

        
        if(count($data) > 0) {
            
            foreach($data as $single) {
                $is_default_template = $single->is_default_template;
                $title = $single->title;
                $body = $single->body;
                $users = explode(",",$single->recipients);
                $filesArray = array();
                foreach($single->newsletter_attachments as $key => $value) {
                    $filesArray[] = $value["image"];
                }

                // fired an event to send the newsletter to the users
                event(new SendNewsletter($is_default_template, $title, $body, $users, $filesArray));    
            }
        }

        die("");
    }

    /**
     * Load Newsletter Template
     * function for load newsletter template in editor after just select from newsletter template dropdown
     *
     * @return Number of mail delievered successfully
     * @access public
     */
    public function load_newsletter_template(Request $request) {

        if ($request->isMethod('post')) {
            $body = NewsletterTemplate::where("title", "=", $request->value)->first();
            echo $body->body; die;
        }
    }

    /**
     * Admin delete
     * delete feeds
     *
     * @return void
     * @access public
     */
    public function admin_delete_attachment(Request $request) {

        if ($request->isMethod('post')) {
            $data = Input::all();
            $id = $data['id'];
            if (!empty($id)) {
                
                $row = \DB::table('newsletter_attachments')->where("id", '=', $id)->first();
                $deletedModel = new NewsletterAttachment;
                $result = $deletedModel->findOrFail($id);
                if($result->delete()) {
                    $destinationPath = 'upload_images/newsletters/';
                    File::delete($destinationPath.'/'.$row->image);
                    if(!File::exists($destinationPath.'/'.$row->image)) {
                        return response()->json(['status' => true]);
                    } else {
                        return response()->json(['status' => false]);
                    }
                }
            }
        }
    }
}
