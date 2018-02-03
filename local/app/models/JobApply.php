<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class JobApply extends Authenticatable {

    use HasApiTokens,
        Notifiable;
 protected $table = 'apply_job';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $guarded = array('*');
    
        protected $fillable = [
        'id', 'classified_id', 'email', 'fname', 'lname', 'mobile', 'job_role_type', 'prev_job_title', 'prev_company',
            'prev_job_start','cover_letter','cover_letter_file','resume','resume_file','application_status'
    ];
	
	public function jobapply_answer() {
        return $this->hasMany('App\models\ApplyJobAnswer', 'apply_job_id');
    }



}
