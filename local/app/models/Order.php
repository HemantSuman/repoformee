<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Session;
use Auth;

class Order extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'orders';
    protected $fillable = [
        'id', 'user_id', 'created_at', 'order_subtotal','order_shipping','order_discount','order_grandtotal','transaction_status','order_status','customer_fname','customer_lname','customer_address1','customer_address2','customer_city','customer_state','customer_country','customer_postcode','customer_state'
    ];

    /**
     * The cart has many classified .
     */
    public function orderDetail() {
        return $this->hasMany('App\models\OrderDetail');
    }

    
    function orderListing($where = array()) {

        $results = self::where($where)->get();
        return $results;
    }

}
