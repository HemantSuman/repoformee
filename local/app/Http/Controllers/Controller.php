<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function get_near_mosques($latitude, $longitude) {
        $mosqData = DB::select(DB::raw("(select *, categories.id,classifieds.id as classified_id ,classifieds.title as title,classifieds.description as description 
            , SQRT(POW(69.1 * (lat - $latitude), 2) + POW(69.1 * ($longitude - lng) * COS(lat / 57.3), 2)) AS distance 
            from `classifieds` 
            left join categories 
            on classifieds.parent_categoryid = categories.id
            group by classifieds.title
            HAVING distance < 150 and
            categories.belong_to_community = 1 and
            categories.status = 1 and 
            classifieds.status = 1
            ORDER BY distance ASC)"));
        return $mosqData;
    }
}
