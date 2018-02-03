<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Session;
use Auth;

class LeadEnquiry extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'phone', 'message', 'created_at', 'status', 'classified_id', 'receiver_id',
    ];

   

    public function leadenquiry_classifieds() {
        return $this->belongsTo('App\models\Classified', 'classified_id');
    }

}