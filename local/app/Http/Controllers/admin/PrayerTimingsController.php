<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\PrayerTiming;
use App\models\User;
use Hash;
use DB;
use Mail;
use App\Event;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Validator;
use App\Classes\PrayTime;

class PrayerTimingsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'prayer_timings';
        $this->viewName = 'prayer_timings';
        $this->modelTitle = 'PrayerTiming';
        $this->model = new PrayerTiming;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * Admin index
     * indexing of all prayer
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

            if (!empty($requestArr["sort"])) {
                $this->model = $this->model->orderBy($requestArr["sort"], $requestArr["direction"]);
            }

            $data = $this->model->paginate(10);
        } else {
            $data = $this->model->orderBy('id', 'DESC')->paginate(10);
        }

        $data->setPath('')->appends(Input::query())->render();
        return view('admin/' . $this->viewName . '/index', compact('modelTitle', 'controllerName', 'actionName', 'viewName', 'data', 'requestVal'));
    }

    /**
     * Admin Update Prayer Timing Default Status
     * 
     *
     * @return void
     * @access public
     */
    public function admin_update_default_status(Request $request) {

        if ($request->isMethod('post')) {
            if ($request->state == "true") {
                $updated_data["is_default"] = 1;
            } else {
                $updated_data["is_default"] = 0;
            }
            \DB::table('prayer_timings')->update(array('is_default' => 0));
            \DB::table('prayer_timings')->where("id", $request->id)->update($updated_data);
        }
    }

    /**
     * Admin Update Prayer Timing Status[Active / Inactive]
     * 
     *
     * @return void
     * @access public
     */
    public function admin_update_status(Request $request) {

        if ($request->isMethod('post')) {
            if ($request->state == "true") {
                $this->model->where("id", $request->id)->update(array("status" => 1));
                return response()->json(['status' => true, 'message' => "Status has been updated successfully."]);
                die;
            } else if ($this->check_status($request->id) == 0) {
                return response()->json(['status' => false, 'message' => "Cannot change the status. At least one method should be activated."]);
                die;
            } else {
                $this->model->where("id", $request->id)->update(array("status" => 0));
                return response()->json(['status' => true, 'message' => "Status has been updated successfully."]);
            }
        }
    }

}
