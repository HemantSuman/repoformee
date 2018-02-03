<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Classified extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    protected $table = 'classifieds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $guarded = array('*');

    protected $fillable = [
        'id', 'title', 'category_id', 'package_user_id', 'membership_plan_user_id', 'location', 'state_id', 'suburbs_id', 'subregions_id', 'pincode', 'contact_name', 'contact_email',
        'contact_mobile', 'website', 'description', 'featured_classified', 'lat', 'lng', 'contact_title', 'price_to', 'quantity',
        'start_date', 'city_id', 'end_date', 'parent_categoryid', 'status', 'price', 'user_id', 'count', 'offer_count', 'product_code',
        'is_premium_parent_cat', 'is_premium_sub_cat', 'price_type', 'min_offer_check', 'minimum_price', 'condition', 'pay_pal', 'pic_n_pay', 'pick_address',
        'pick_city', 'pick_country', 'pick_state', 'pick_zip', 'shipping', 'ship_name_1', 'ship_name_2', 'ship_name_3', 'ship_amount_1',
        'ship_amount_2', 'ship_amount_3', 'product_description', 'pick_lat', 'pick_lng', 'is_premium'
    ];

    /**
     * The classified hasmany attributes.
     */
    public function classified_attribute() {
        return $this->belongsToMany('App\models\Attribute')->withPivot('attr_value', 'attr_type_id', 'attr_type_name');
    }

    /**
     * The classified hasmany Images.
     */
    public function classified_image() {
        return $this->hasMany('App\models\ClassifiedImage');
    }

    public function classified_ho_package_user() {
        return $this->hasOne('App\models\PackageUser');
    }

    public function classified_hm_reviews() {
        return $this->hasMany('App\models\Review');
    }

    public function attributes_classified() {
        return $this->hasMany('App\models\AttributeClassified');
    }

    public function classified_hasmany_other() {
        return $this->hasMany('App\models\ClassifiedOther');
    }

    public function classified_hasmany_questions() {
        return $this->hasMany('App\models\Question');
    }

    function classifiedListing($where = array()) {

        $results = self::where($where)->pluck("title", "id");
        return $results;
    }

    public function categoriesname() {
        return $this->belongsTo('App\models\Category', 'parent_categoryid');
    }

    public function Subcategoriesname() {
        return $this->belongsTo('App\models\Category', 'category_id');
    }

    public function state() {
        return $this->belongsTo('App\models\State');
    }

    public function subregion() {
        return $this->belongsTo('App\models\Subregion', 'subregions_id');
    }

    public function city() {
        return $this->belongsTo('App\models\City', 'city_id', 'CityId');
    }

    public function city_data() {
        return $this->belongsTo('App\models\City', 'city_id', 'CityId');
    }

    public function get_classifidscount() {
        $active = DB::table('classifieds')->where('status', '=', 1)->orWhere('status', '=', 0)->count();
        $approved = DB::table('classifieds')->where('status', '=', 2)->count();
        $reject = DB::table('classifieds')->where('status', '=', 3)->count();
        $classifdscount = array(
            "active" => $active,
            "approved" => $approved,
            "reject" => $reject,
        );
        return $classifdscount;
    }

    public function classified_users() {
        return $this->belongsTo('App\models\User', 'user_id');
    }

    public function modifyClassifiedAttrWithValues($result_with_sort) {

        foreach ($result_with_sort as $key => $value) {

            if (!empty($value['classified_attribute'])) {
                foreach ($value['classified_attribute'] as $in => $val) {

                    if ($val['attr_type_name'] == 'Multi-Select' || $val['attr_type_name'] == 'Radio-button') {

                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');

                        $result_with_sort[$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                        $result_with_sort[$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if ($val['attr_type_name'] == 'Drop-Down' && $val['parent_value_id'] == 0) {

                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                        $result_with_sort[$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if (($val['attr_type_name'] == 'calendar') && (strpos($val['attr_value'], ';'))) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
                        $result_with_sort[$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                        $result_with_sort[$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if (($val['attr_type_name'] == 'Numeric') && (strpos($val['attr_value'], ';'))) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
//                            $resultNew[$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                        $result_with_sort[$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if (($val['attr_type_name'] == 'Date') && (strpos($val['attr_value'], ';'))) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
//                            $resultNew[$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                        $result_with_sort[$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else
                    if (($val['attr_type_name'] == 'Time') && (strpos($val['attr_value'], ';'))) {
                        $attr_AllValues = DB::table('attribute_value')->where('attribute_id', $val['attribute_id'])->pluck('values', 'id');
//                            $resultNew[$key]['classified_attribute'][$in]['selected'][] = $val['attr_value'];
                        $result_with_sort[$key]['classified_attribute'][$in]['attribute_value'] = $attr_AllValues->toArray();
                        $val['attr_AllValues'] = $attr_AllValues->toArray();
                    } else {
                        unset($val);
                    }
                }
            }
        }
        return $result_with_sort;
    }

    public function getSimilarAds($catids, $isparent) {
        
        $current_date = date('Y-m-d');
        
        if($isparent){
            $cat_forien_key = 'parent_categoryid';
        } else {
            $cat_forien_key = 'category_id';
        }
        
        $similarClass = new Classified;
        $similarClass = $similarClass
                        ->with(['classified_image', 'Subcategoriesname'])
                        ->where(['status' => 1])
                        ->whereIn($cat_forien_key, $catids)
                        ->whereRaw("'$current_date' Between classifieds.start_date and classifieds.end_date ")
                        ->get()->toArray();

        shuffle($similarClass);
        return $similarClass;
    }

}
