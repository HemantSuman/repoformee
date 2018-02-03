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
use Auth;

class PackageUser extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The database fields.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'classified_id', 'package_id', 'package_name', 'package_price', 'number_image_upload', 'duration', 'classified_type', 'created_at', 'updated_at','paypal_token','paypal_payer_id','paypal_transaction_id'
    ];


    /**
     * save record
     *
     * @param array $request data
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function saveAll($package_id, $classified_id) {

        $obj = new Package;
        $result = $obj->findOrFail($package_id)->toArray();
        $exceptFields = ['_token', 'created_at', 'updated_at', 'status', 'id', 'package_slug', 'package_discription'];

        $req = new self;

        foreach ($result as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $req->$key = $value;
            }
        }

        $req->user_id = Auth::guard('web')->user()->id;
        $req->package_id = $package_id;
        $req->classified_id = $classified_id;
        $req->save();

        return $req;
    }

    function ListingAll($where = []) {
        $listing = self::where($where)->get();
        return $listing;
    }

}
