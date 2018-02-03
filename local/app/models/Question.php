<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Question extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'classified_id', 'question', 'ans_type'
    ];

    /**
     * The category that belong to the attribute.
     */
    public function question_belongsto_class() {
        return $this->belongsTo('App\models\Classified');
    }
    
     public function question_hasmany_options() {
        return $this->hasMany('App\models\Option');
       
    }

}    