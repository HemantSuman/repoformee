<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class ClassifiedOther extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    protected $table = 'classified_other';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $guarded = array('*');

    protected $fillable = [
        'classified_id', 'other_title', 'other_slug', 'other_value','image','url','content_type'
    ];

    /**
     * The classified hasmany attributes.
     */
    public function classifiedother_classified() {
        return $this->belongsTo('App\models\Classified')->withPivot('other_title', 'other_slug', 'other_value');
    }

}
