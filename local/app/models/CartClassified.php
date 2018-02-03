<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Session;
use Auth;

class CartClassified extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'cart_classified';
    protected $fillable = [
        'id', 'classified_id', 'cart_id', 'qty', 'ship_name', 'ship_cost', 'created_at', 'updated_at'
    ];
    
    /**
     * The cart classified has one classified.
     */
    public function cart_bt_cart_classified() {
        return $this->belongsTo('App\models\Classified','classified_id');
    }

}
