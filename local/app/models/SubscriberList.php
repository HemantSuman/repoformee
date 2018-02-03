<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class SubscriberList extends Model
{
    //
     public function get_subscribercount() {
        $active = DB::table('subscriber_lists')->where('status', '=', 1)->count();
        
        $subscribercount=array(
                "active"=>$active,
                );
        return $subscribercount;
    }
}
