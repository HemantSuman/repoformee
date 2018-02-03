<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Input;
use File;
use Intervention\Image\Facades\Image as image1;
use Session;
use DB;

class MembershipPlan extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The database fields.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'plan_name', 'plan_type', 'role_id', 'plan_price', 'start_date', 'end_date', 'display_order', 'is_job_post',
        'job_post_count', 'is_featured_ads', 'featured_ads_type', 'featured_ads_count', 'is_video', 'is_youtube',
        'number_image_upload', 'is_premium_parent_cat', 'is_premium_sub_cat', 'created_at', 'updated_at'
    ];

    public function membership_plan_roles() {
        return $this->belongsTo('App\models\Role', 'role_id');
    }

    /**
     * get list of product
     *
     * @param array $req  all conditions like where, order by and limit
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function Listing() {

        DB::enableQueryLog();
        $requestArr = Input::all();
        if (!empty($requestArr)) {
            $results = new self();
            if (isset($requestArr['status']) && $requestArr['status'] != '' && ($requestArr['status'] == 0 || $requestArr['status'] == 1)) {
                $results = $results->where(['status' => $requestArr['status']]);
            } else {
                $results = $results->where(function($q) {
                    $q->where(['status' => 1])
                            ->orwhere(['status' => 0]);
                });
            }
            if (!empty($requestArr['plan_name'])) {
                $results = $results->where('plan_name', 'LIKE', "%{$requestArr['plan_name']}%");
            }
            $results = $results->paginate(10);
        } else {
            $results = self::where(function($q) {
                        $q->where(['status' => 1])
                                ->orwhere(['status' => 0]);
                    })->get();
        }

        return $results;
    }

    /**
     * get single result of product
     *
     * @param $id primary key
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function getFirstValue($id = null) {

        try {
            $results = self::with(['membership_plan_roles'])->findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            $results = $ex->getMessage();
        }
        return $results;
    }

    /**
     * save product
     *
     * @param array $request data
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function saveAll($request) {

        $requestArr = Input::all();
        $exceptFields = ['_token'];

        $req = new self;
        foreach ($requestArr as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $req->$key = $value;
            }
        }
        if (!empty($requestArr['start_date'])) {
            $req->start_date = new \DateTime($request->start_date);
            $req->start_date = date_format($req->start_date, 'Y-m-d');
        } else {
            $req->start_date = '0000-00-00';
        }

        if (!empty($requestArr['end_date'])) {
            $req->end_date = new \DateTime($request->end_date);
            $req->end_date = date_format($req->end_date, 'Y-m-d');
        } else {
            $req->end_date = '0000-00-00';
        }
        if (isset($request->display_order) && $request->display_order == '') {
            $req->display_order = 1;
        }
        $req->save();
        $lastid = $req->id;
        if ($lastid) {
            return $req;
        } else {
            return false;
        }
    }

    /**
     * update product
     *
     * @param array $request data
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function updateAll($request, $id) {

        $requestArr = Input::all();
        $exceptFields = ['_token'];
        $req = self::findOrFail($id);
        foreach ($requestArr as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $req->$key = $value;
            }
        }
        
        if (!empty($requestArr['start_date'])) {
            $req->start_date = new \DateTime($request->start_date);
            $req->start_date = date_format($req->start_date, 'Y-m-d');
        } else {
            $req->start_date = '0000-00-00';
        }

        if (!empty($requestArr['end_date'])) {
            $req->end_date = new \DateTime($request->end_date);
            $req->end_date = date_format($req->end_date, 'Y-m-d');
        } else {
            $req->end_date = '0000-00-00';
        }
        
        if (!isset($request->is_job_post) && $request->is_job_post != 1) {
            $req->is_job_post = 0;
            $req->job_post_count = 0;
        }
        if (!isset($request->is_featured_ads) && $request->is_featured_ads != 1) {
            $req->is_featured_ads = 0;
            $req->featured_ads_count = 0;
            $req->featured_ads_type = '';
        }
        if (!isset($request->status) && $request->status != 1) {
            $req->status = 0;
        }
        if (!isset($request->is_video) && $request->is_video != 1) {
            $req->is_video = 0;
        }
        if (!isset($request->is_youtube) && $request->is_youtube != 1) {
            $req->is_youtube = 0;
        }
        if (!isset($request->is_premium_parent_cat) && $request->is_premium_parent_cat != 1) {
            $req->is_premium_parent_cat = 0;
        }
        if (!isset($request->is_premium_sub_cat) && $request->is_premium_sub_cat != 1) {
            $req->is_premium_sub_cat = 0;
        }
        if (isset($request->display_order) && $request->display_order == '') {
            $req->display_order = 1;
        }
//        dd($req);
        $req->save();
        $lastid = $req->id;
        if ($lastid) {

            return $req;
        } else {
            return false;
        }
    }

    /**
     * delete product
     *
     * @param array $request data
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function deleteAll($request, $id) {
//        dd($id);
        $req = self::findOrFail($id);
        $req->status = $request['status'];
        $req->delete();
        $lastid = $req->id;

        return $req;
    }

    /**
     * update product
     *
     * @param array $request data
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function updateRequestValue($request, $id) {
//        dd($id);
        $req = self::findOrFail($id);
        $req->status = $request['status'];
        $req->save();
        $lastid = $req->id;

        return $req;
    }

    function ListingAll($where = []) {

        $listing = self::where($where)->get();
        return $listing;
    }

}
