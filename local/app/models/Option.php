<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Option extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'classified_id', 'question_id', 'option_value'
    ];

    /**
     * The category that belong to the attribute.
     */
    public function question_belongsto_class() {
        return $this->belongsTo('App\models\Classified');
    }
    
    public function option_belongsto_questions() {
        return $this->belongsTo('App\models\Question');
       
    }
    
}    