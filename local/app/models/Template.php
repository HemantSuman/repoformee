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

class Template extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The database fields.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'template_name', 'template_slug', 'default_child_listing_slug', 'default_parent_listing_slug',
        'default_detail_slug', 'default_detail_preview_slug', 'template_type', 'is_price_range', 'is_inspection_date',
        'questions_answer', 'created_at', 'updated_at'
    ];

    public function template_categories() {
        return $this->belongsToMany('App\models\Category');
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
            if (!empty($requestArr['promocode'])) {
                $results = $results->where('promocode', 'LIKE', "%{$requestArr['promocode']}%");
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
            $results = self::findOrFail($id);
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
        $req->start_date = new \DateTime($request->start_date);
        $req->start_date = date_format($req->start_date, 'Y-m-d');
        
        $req->end_date = new \DateTime($request->end_date);
        $req->end_date = date_format($req->end_date, 'Y-m-d');
        
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
        $exceptFields = ['_token', 'category_id'];
        $req = self::findOrFail($id);
        foreach ($requestArr as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $req->$key = $value;
            }
        }
        $cat = $req->save();
        $req->template_categories()->sync($request->category_id);
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
    public function deleteAll($id) {
        $req = self::findOrFail($id);
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
        $req = self::findOrFail($id);
        $req->status = $request['status'];
        $req->save();
        $lastid = $req->id;

        return $req;
    }

}
