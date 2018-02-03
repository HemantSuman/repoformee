<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Review extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    protected $table = 'reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $guarded = array('*');

    protected $fillable = [
        'classified_id', 'user_id', 'review', 'rating'
    ];

    /**
     * The classified Belongs To attributes.
     */
    public function reviews_bt_classified() {
        return $this->belongsTo('App\models\Classified', 'classified_id');
    }

    public function reviews_bt_users() {
        return $this->belongsTo('App\models\User', 'user_id');
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
            if (!empty($requestArr['review'])) {
                $results = $results->where('review', 'LIKE', "%{$requestArr['review']}%");
            }
            if (!empty($requestArr['rating'])) {
                $results = $results->where(['rating' => $requestArr['rating']]);
            }
            $results = $results->orderBy('id', 'desc')->paginate(100);
        } else {
            $results = self::where(function($q) {
                        $q->where(['status' => 1])
                                ->orwhere(['status' => 0]);
                    })->with(['reviews_bt_classified', 'reviews_bt_users'])->orderBy('id', 'desc')->paginate(100);
        }

        return $results;
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

    /**
     * get detail of product
     *
     * @param array $req  all conditions like where, order by and limit
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function DetailView($id) {

        DB::enableQueryLog();

        $results = self::where(function($q) {
                            $q->where(['status' => 1])
                            ->orwhere(['status' => 0]);
                        })->where(['id' => $id])
                        ->with(['reviews_bt_classified', 'reviews_bt_users'])->orderBy('id', 'desc')->first();

        return $results;
    }

}
