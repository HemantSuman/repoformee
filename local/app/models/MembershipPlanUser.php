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

class MembershipPlanUser extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The database fields.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'membership_plan_id', 'plan_name', 'plan_type', 'plan_price', 'start_date', 'end_date', 'discount_type', 'discount_value', 'is_job_post', 'job_post_count', 'is_featured_ads', 'featured_ads_type', 'featured_ads_count', 'is_video', 'is_youtube', 'is_premium', 'created_at', 'updated_at'
    ];


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

        $plan = new MembershipPlan;
        $result = $plan->getFirstValue($request->plan_id)->toArray();

        $requestArr = Input::all();
        $exceptFields = ['_token', 'created_at', 'updated_at', 'status', 'role_id', 'id','display_order'];

        $req = new self;
        $currentDate = date('Y-m-d');
        $selectedPlanRecord = self::where(['user_id' => Auth::guard('web')->user()->id, 'status' => 1])
                ->where('start_date', '<=', $currentDate)
                ->where('end_date', '>=', $currentDate)
                ->first();
        
        foreach ($result as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $req->$key = $value;
            }
        }
        
        if($selectedPlanRecord){
            $req->start_date = date('Y-m-d', strtotime('+1 days', strtotime($selectedPlanRecord['end_date'])));
        } else {
            $req->start_date = $currentDate;
        }

        $req->user_id = Auth::guard('web')->user()->id;
        $req->membership_plan_id = $request->plan_id;

        if ($req->plan_type == 'Yearly') {
            $req->end_date = date('Y-m-d', strtotime('-1 days', strtotime('+1 years', strtotime($req->start_date))));
        } else if ($req->plan_type == 'Monthly') {
            $req->end_date = date('Y-m-d', strtotime('-1 days', strtotime('+1 month', strtotime($req->start_date))));
        }

        if ((strtotime($result['start_date']) <= strtotime($currentDate)) && (strtotime($currentDate) <= strtotime($result['end_date']))) {
            $req->discount_type = $result['discount_type'];
            $req->discount_value = $result['discount_value'];

            if ($result['discount_type'] == 'Percentage') {
                $req->plan_price = ($result['plan_price'] * $result['discount_value']) / 100;
            } else if ($result['discount_type'] == 'Fix') {
                $req->plan_price = $result['plan_price'] - $result['discount_value'];
            }
        } else {
            $req->discount_type = '';
            $req->discount_value = '';
        }
        $role_id = $req->membership_plan_roles['id'];
        unset($req['membership_plan_roles']);
        $req->status = 1;
        $req->save();

        $lastid = $req->id;
        if ($lastid) {

            $users = new User;
            $userData = $users->findOrFail(Auth::guard('web')->user()->id);

            $userData->fname = $requestArr['fname'];
            $userData->lname = $requestArr['lname'];
            $userData->name = $requestArr['fname'] . ' ' . $requestArr['lname'];
            $userData->role_id = $role_id;
            $userData->business_name = $requestArr['business_name'];
            $userData->business_location = $requestArr['location'];
            $userData->business_lat = $requestArr['lat'];
            $userData->business_lng = $requestArr['lng'];
            $userData->business_state_id = $requestArr['statevalue'];
            $userData->business_city_id = $requestArr['subregion_id'];
            $userData->business_pincode = $requestArr['pincode'];

            $userData->save();

            return $req;
        } else {
            return false;
        }
    }

    function ListingAll($where = []) {
        $listing = self::where($where)->get();
        return $listing;
    }

}
