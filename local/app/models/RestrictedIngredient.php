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

class RestrictedIngredient extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The database fields.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'certification', 'status', 'created_at', 'updated_at'
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
        if (!empty($requestArr)) {
            $results = new RestrictedIngredient;
            if (isset($requestArr['status']) && $requestArr['status'] != '' && ($requestArr['status'] == 0 || $requestArr['status'] == 1)) {
                $results = $results->where(['status' => $requestArr['status']]);
            } else {
                $results = $results->where(function($q) {
                    $q->where(['status' => 1])
                            ->orwhere(['status' => 0]);
                });
            }
            if (!empty($requestArr['name'])) {
                $results = $results->where('name', 'LIKE', "%{$requestArr['name']}%");
            }
            if (!empty($requestArr['bar_code'])) {
                $results = $results->where('bar_code', 'LIKE', "%{$requestArr['bar_code']}%");
            }
            $results = $results->paginate(10);
        } else {
            $results = RestrictedIngredient::where(function($q) {
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
            $results = RestrictedIngredient::findOrFail($id);
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

        $req = new RestrictedIngredient();
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
            if (Input::file('image')) {
                $image = Input::file('image');
                if (!is_dir('upload_images/food_products/backgroundimage/' . $req->id)) {
                    File::makeDirectory('upload_images/food_products/backgroundimage/' . $req->id, 0777, true);
                }
                if (!is_dir('upload_images/food_products/backgroundimage/30px/' . $req->id)) {
                    File::makeDirectory('upload_images/food_products/backgroundimage/30px/' . $req->id, 0777, true);
                }

                $destinationPath = 'upload_images/food_products/backgroundimage/' . $req->id . '/';

                $destinationPaththumb = 'upload_images/food_products/backgroundimage/30px/' . $req->id . '/';
                $extension = $image->getClientOriginalExtension();
                $ran = rand(11111, 99999);
                $fileName = $ran . '.' . $extension;

                $image->move($destinationPath, $fileName);
                image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                $req->image = $fileName;
                $req->save();
            }
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

        $req = RestrictedIngredient::findOrFail($id);
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
            if (Input::file('image')) {
                $image = Input::file('image');
                if (!is_dir('upload_images/food_products/backgroundimage/' . $req->id)) {
                    File::makeDirectory('upload_images/food_products/backgroundimage/' . $req->id, 0777, true);
                }
                if (!is_dir('upload_images/food_products/backgroundimage/30px/' . $req->id)) {
                    File::makeDirectory('upload_images/food_products/backgroundimage/30px/' . $req->id, 0777, true);
                }

                $destinationPath = 'upload_images/food_products/backgroundimage/' . $req->id . '/';

                $destinationPaththumb = 'upload_images/food_products/backgroundimage/30px/' . $req->id . '/';
                $extension = $image->getClientOriginalExtension();
                $ran = rand(11111, 99999);
                $fileName = $ran . '.' . $extension;

                $image->move($destinationPath, $fileName);
                image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                $req->image = $fileName;
                $req->save();
            }
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
    public function updateRequestValue($request, $id) {
        $req = RestrictedIngredient::findOrFail($id);
        $req->status = $request['status'];
        $req->save();
        $lastid = $req->id;

        return $req;
    }

}