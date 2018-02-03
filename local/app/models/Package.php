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

class Package extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The database fields.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'package_name', 'package_discription', 'package_price', 'status', 'created_at', 'updated_at'
    ];

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

        $results = self::where(function($q) {
                    $q->where(['status' => 1])
                            ->orwhere(['status' => 0]);
                })->get();
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

        if (!isset($request->status) && $request->status != 1) {
            $req->status = 0;
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
