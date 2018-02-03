<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Session;
use Auth;

class Cart extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'cart';
    protected $fillable = [
        'id', 'user_id', 'created_at'
    ];

    /**
     * The cart has many classified .
     */
    public function cart_classified() {
        return $this->hasMany('App\models\Classified');
    }

    /**
     * The cart has many cart classified .
     */
    public function cart_hm_cart_classified() {
        return $this->hasMany('App\models\CartClassified');
    }
}
