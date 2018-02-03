<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
// use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'cpassword', 'fname', 'lname','name','social_id','login_type', 'seller_type','mobile_no','status','avatar','phonecode',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
     public function permission_role() {
        return $this->hasMany('\App\models\PermissionRole', 'role_id','role_id');
       
    }
    public function role_name() {
        return $this->belongsTo('\App\models\Role','role_id');
       
    }

    public function get_user_current_location() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://ip-api.com/json",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"user_id\"\r\n\r\n5\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"type\"\r\n\r\nyou2\r\n-----011000010111000001101001--",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: multipart/form-data; boundary=---011000010111000001101001",
            "postman-token: b1e39ff0-8a10-dee0-2a3b-84abcf18b0cf"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }
    
    public function user_classifieds() {
        return $this->hasMany('\App\models\Classified');
       
    }
	
     public function membership_user() {
        return $this->hasMany('\App\models\MembershipPlanUser', 'user_id');
       
    }
     
}
