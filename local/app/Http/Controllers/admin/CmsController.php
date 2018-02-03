<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Event;
use App\models\Cms;
use App\models\Query;
use Illuminate\Routing\Route;
use Session;
use Illuminate\Support\Facades\Paginator;
use Illuminate\Support\Facades\Redis;
use Mail;

class CmsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {
        $this->viewName = 'cms';
        $this->modelTitle = 'Cms';
        $this->model = new Cms;
    }

    /**
     * Admin index
     * indexing of all cms
     *
     * @return void
     * @access public
     */
    public function admin_list($id = null) {

        $data = $this->model->orderBy('id', 'Asc')->paginate(10);
        return view('admin/cms/index', compact('data'));
    }

   /**
     * Admin add
     * add cms
     *
     * @return void
     * @access public
     */
    public function admin_addcms() {


        $requestArr = Input::all();
        return view('admin/cms/add');
    }
    
    /**
     * Admin edit
     * edit cms
     *
     * @return void
     * @access public
     */
    public function admin_edit($id = null) {
        $data = $this->model->findOrFail($id);
        return view('admin/cms/edit', compact('data'));
    }
    /**
     * Admin create
     * create cms
     *
     * @return void
     * @access public
     */
    public function admin_create(Request $request) {


        $requestArr = Input::all();

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $data = new Cms();
        $exceptFields = ['_token'];

        foreach ($requestArr as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $data->$key = $value;
            }
        }
        $lstcategoryid = $data->save();
        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'Successfully submitted.');
        return Redirect::to('admin/cms');

    }

    /**
     * Admin update
     * add cms
     *
     * @return void
     * @access public
     */
    public function admin_update(Request $request, $id = null) {


        $requestArr = Input::all();
        //dd($requestArr);

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
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

        return Redirect::to('admin/cms');
    }

    /**
     * Admin delete
     * add cms
     *
     * @return void
     * @access public
     */
    public function admin_delete() {
        $data = Input::all();
        $id = $data['id'];

        if (!empty($id)) {

            $result = $this->model->findOrFail($id);

            $result->delete();
            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Successfully Deleted.');
            return response()->json(['status' => true, 'url' => 'cms']);
        }
    }

    /**
     * Admin check mobile
     * add cms
     *
     * @return void
     * @access public
     */
    public function commonaction(Request $request, $name = null) {
        if (!empty($name)) {
            if ($name == 'Contact-Us') {
                $nwName = $name;
                $result = $this->model->where('slug', '=', $nwName)->first();
                if ($request->isMethod('post')) {
                    $data = new Query;
                    $data->name = $mailingData["name"] = $request->name;
                    $data->type = $mailingData["type"] = $request->query_type;
                    $data->email = $mailingData["email"] = $request->email;
                    $data->contact_query = $mailingData["contact_query"] = $request->contact_query;
                    $data->status = 0;

                    if ($data->save()) {
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
            } else {
                $nwName = $name;
                $result = $this->model->where('slug', '=', "$nwName")->first();
                return view('front.cms', compact('result'));
            }
        }

    }
    
    
    /**
     * Admin contactcms on mobile
     * add contactcms
     *
     * @return void
     * @access public
     */
    public function commonactionmobile(Request $request, $name = null) {
        //dd($name);
        if (!empty($name)) {
            if ($name == 'Contact-Us') {
                return "wrong name";
                die();
            } else {
                $nwName = $name;
                $result = $this->model->where('slug', '=', "$nwName")->first();
                return view('front.mobilecms', compact('result'));
            }
        }

    }
    
     /**
     * Admin contactcms on mobile
     * add contactcms
     *
     * @return void
     * @access public
     */
    public function contactapi(Request $request) {
        $data = new Query;
        $data->name = $mailingData["name"] = $request->name;
        $data->type = $mailingData["type"] = $request->query_type;
        $data->email = $mailingData["email"] = $request->email;
        $data->contact_query = $mailingData["contact_query"] = $request->contact_query;
        $data->status = 0;
        if (!empty($data->name) && !empty($data->type) && !empty($data->contact_query)) {
            if ($data->save()) {
                $siteContactEmail = Redis::get('site-contact-email');
                $result = Mail::send('emails.contact_query_template_for_admin', array('mailingData' => $mailingData), function($message) use ($siteContactEmail) {
                            $message->to($siteContactEmail)->subject("Contact Query");
                        }, true);
                $result['status'] = 1;
                $result['msg'] = 'Saved successfully';
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
