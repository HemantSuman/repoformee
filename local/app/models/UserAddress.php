<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Session;
use Auth;

class UserAddress extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_address';
    protected $fillable = [
        'id', 'user_id', 'fname', 'lname', 'address_1', 'address_2', 'city', 'state', 'country', 'postalcode', 'created_at', 'updated_at'
    ];
    


}
