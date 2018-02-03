<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    /**
     * The advertisement that belong to the category.
     */
    public function category() {
        return $this->belongsTo('App\models\Category');
    }

    /**
     * The advertisement that belong to the category.
     */
    public function sub_category() {
        return $this->belongsTo('App\models\Category', 'subcategory_id');
    }

    /**
     * The advertisement that belong to the category.
     */
    public function page() {
        return $this->belongsTo('App\models\Page');
    }

    /**
     * The advertisement that hasMany advertisement attachment.
     */
    public function advertisement_attachments() {
        return $this->hasMany('App\models\AdvertisementAttachment');
    }
    
    /**
     * get banners from front end
     */
    public function top_positions_ads($cond_for_top_banner) {
        $current_date = date('Y-m-d');
        $results['top_positions_ads'] = \DB::table('advertisements')
                        ->where("page_id", "=", 3)
                        ->where("banner_position", "=", "top")
                        ->where("status", "=", 1)
                        ->where($cond_for_top_banner)
                        ->Where(function ($query) use($current_date) {
                            $query->where(['is_default' => 1]);
                            $query->orwhere(function($q1) use($current_date) {
                                $q1->orwhereRaw(" is_default=0 and '$current_date' Between advertisements.start_date  and advertisements.end_date ");
                            });
                        })
                        ->orderBy('order_no', 'ASC')->get();
                        
        return $results;
    }
}
