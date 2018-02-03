<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Event;
use App\models\FaqCategory;
use Illuminate\Routing\Route;
use Session;
use DB;
use Illuminate\Support\Facades\Paginator;

class FaqcategoryController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {
        $this->viewName = 'FaqCategory';
        $this->modelTitle = 'FaqCategory';
        $this->model = new FaqCategory;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function faqcategorylist($id = null) {
       
        $data = $this->model->orderBy('id', 'Asc')->paginate(10);
        
        return view('admin/faq/faqcategory', compact('data'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addfaqcategory() {

        return view('admin/faq/addcategory');
    }

   /**
     * Admin editfaqcategorye
     * editfaqcategory
     *
     * @return void
     * @access public
     */
    public function editfaqcategory($id = null) {
        $data = $this->model->findOrFail($id);
        return view('admin/faq/faqeditcategory', compact('data'));
    }

    /**
     * Admin createfaqcategory
     * createfaqcategory
     *
     * @return void
     * @access public
     */
    public function createfaqcategory(Request $request) {


        $requestArr = Input::all();

        $this->validate($request, [
              'name' => 'required|unique:faq_categories,name',
           
           
        ]);
        $data = new FaqCategory();
        $exceptFields = ['_token'];

        foreach ($requestArr as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $data->$key = $value;
            }
        }
        $lstcategoryid = $data->save();
        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'Successfully submitted.');
        return Redirect::to('admin/faqcategorylist');

    }

    /**
     * Admin updatefaqcategory
     * updatefaqcategory
     *
     * @return void
     * @access public
     */
    public function updatefaqcategory(Request $request, $id = null) {


        $requestArr = Input::all();

         $this->validate($request, [
            'name' => 'required',
           
        ]);

        $requestArr = Input::all();
        $exceptFields = ['_token'];

        $data = $this->model->findOrFail($id);
        foreach ($requestArr as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $data->$key = $value;
            }
        }
        $data->save();
        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'Successfully submitted.');

         return Redirect::to('admin/faqcategorylist');
    }

    /**
     * Admin delete faqcategory
     * delete faqcategory
     *
     * @return void
     * @access public
     */
    public function admin_delete() {
        $data = Input::all();
        $id = $data['id'];

        if (!empty($id)) {

            $result = $this->model->findOrFail($id);
            $classi = DB::table('faqs')->where(['faq_category_id' => $id])->first();
            if (!empty($classi)) {
                Session::flash('alert-class', 'alert-warning');
                Session::flash('message', 'First delete all the Question of this Category.');
                return response()->json(['status' => true, 'url' => 'faqcategorylist']);
            }

            $result->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully Deleted.');
            return response()->json(['status' => true, 'url' => 'faqcategorylist']);
        }
    }

    
    /**
     * Admin commonaction
     * commonaction
     *
     * @return void
     * @access public
     */
    public function commonaction(Request $request, $name = null) {
        if (!empty($name)) {
            if($name=='Contact-Us')
            {
                $nwName = str_replace("-"," ",$name);
                $result = $this->model->where('title', '=', $nwName)->first();
                if ($request->isMethod('post')) {
            $data = new Query;
            $data->name = $mailingData["name"] = $request->name;
            $data->type = $mailingData["type"] =  $request->query_type;
            $data->email = $mailingData["email"] =  $request->email;
            $data->contact_query = $mailingData["contact_query"] =  $request->contact_query;
            $data->status = 0;

            if($data->save()) {
                $siteContactEmail = Redis::get('site-contact-email');
                $result = Mail::send('emails.contact_query_template_for_admin', array('mailingData' => $mailingData), function($message) use ($siteContactEmail) {
                        $message->to($siteContactEmail)->subject("Contact Query");
                    }, true);
                return Redirect::back()->withSuccess("Saved successfully.");
            } else {
                return Redirect::back()->withDanger("Could not be saved. Please try again.");
            }

        }

        return view('front.contact_us', compact('result'));
            }
            else
            {
                $nwName = str_replace("-"," ",$name);
               $result = $this->model->where('title', '=', "$nwName")->first();
               return view('front.cms', compact('result'));
            }
           
            
        }
        
        
    }

}
