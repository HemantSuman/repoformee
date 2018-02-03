<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Cms extends Model
{
    public function get_allcms() {
        $cmsdata = DB::table('cms')->get();
        return $cmsdata;
    }
    //
}
