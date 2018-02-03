<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class ApplyJobAnswer extends Authenticatable {

    use HasApiTokens,
        Notifiable;
 protected $table = 'apply_job_answer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $guarded = array('*');
    
        protected $fillable = [
        'id', 'classified_id', 'customer_id', 'apply_job_id', 'question_id', 'answer'
    ];
	
	
	public function jobapply_answer_question() {
        return $this->belongsTo('App\models\Question','question_id');
    }



}
