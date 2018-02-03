<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DB;
class SiteReport extends Model
{
    //
    public function getmostpostedclassified()
    {
        $data = DB::table('classifieds')
                    ->selectRaw('count(parent_categoryid) as data,categories.name as labels')
                    ->leftJoin('categories', 'classifieds.parent_categoryid', '=', 'categories.id')
                    ->where(['show_on_info_area' => 0,'belong_to_community' => 0])
                    ->groupby('parent_categoryid')
                    ->orderBy('data', 'Desc')
                    ->limit(5)
                    ->get();
        return $data;
        die();
    }
}
