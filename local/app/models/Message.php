<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Session;
use Auth;

class Message extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'sender_id', 'receiver_id', 'massage', 'classified_id', 'created_at', 'subject', 'flag', 'read_status', 'deleted_by',
        'deleted_at', 'offer_price'
    ];

    public function messages_users() {
        
        if (Session::get('msg_flag') == 'sender_id') {
            return $this->belongsTo('App\models\User', 'receiver_id');
        } else if (Session::get('msg_flag') == 'receiver_id') {
            return $this->belongsTo('App\models\User', 'sender_id');
        }
    }

    public function messages_classifieds() {
        return $this->belongsTo('App\models\Classified', 'classified_id');
    }

}