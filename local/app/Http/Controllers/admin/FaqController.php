<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Event;
use App\models\Faq;
use App\models\FaqCategory;
use Illuminate\Routing\Route;
use Session;
use Illuminate\Support\Facades\Paginator;

class FaqController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {
        $this->viewName = 'Faq';
        $this->modelTitle = 'Faq';
        $this->model = new Faq;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function faqlist($id = null) {
        $data = $this->model->with('faq_categories')->orderBy('id', 'Asc')->paginate(10);
        return view('admin/faq/faqlist', compact('data'));
    }

    /**
     * Admin add faqlist
     * add faq
     *
     * @return void
     * @access public
     */
    public function addfaqlist() {
        $category = new FaqCategory;
        
        $faq_categoryid = $category->pluck('name', 'id');
        
        return view('admin/faq/addfaq', compact('faq_categoryid'));
    }
 /**
     * Admin editfaqlist
     *editfaqlist
     *
     * @return void
     * @access public
     */
    public function editfaqlist($id = null) {
        $category = new FaqCategory;
        $data = $this->model->findOrFail($id);
        $faq_categoryid = $category->pluck('name', 'id');
        return view('admin/faq/faqeditlist', compact('data','faq_categoryid'));
    }
    
    /**
     * Admin createfaqlist
     *createfaqlist
     *
     * @return void
     * @access public
     */
    public function createfaqlist(Request $request) {

        
        $requestArr = Input::all();

        $this->validate($request, [
            'faq_category_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
           
        ]);
        $data = new Faq();
        $exceptFields = ['_token'];

        foreach ($requestArr as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $data->$key = $value;
            }
        }
        $lstcategoryid = $data->save();
        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'Successfully submitted.');
        return Redirect::to('admin/faqlist');

    }

    /**
     * Admin updatefaqlist
     *updatefaqlist
     *
     * @return void
     * @access public
     */
    public function updatefaqlist(Request $request, $id = null) {


        $requestArr = Input::all();

        $this->validate($request, [
            'faq_category_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
           
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

         return Redirect::to('admin/faqlist');
    }

    /**
     * Admin admin_delete
     *admin_delete
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
            return response()->json(['status' => true, 'url' => 'faqlist']);
        }
    }
    
    
    /**
     * Admin getallfaqdatafront
     *getallfaqdatafront
     *
     * @return void
     * @access public
     */
    public function getallfaqdatafront(Request $request) {
       $category = new FaqCategory;
        $data = $category->with('faq')->orderBy('id', 'Asc')->get();
        return view('front.faq', compact('data'));
        
    }

}
