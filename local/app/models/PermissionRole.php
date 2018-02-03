<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class PermissionRole extends Authenticatable
{
     use HasApiTokens, Notifiable;
protected $table = 'permission_role';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'permission_id','role_id'
    ];
  
    public function permission() {
        return $this->hasMany('App\models\Permission', 'id','permission_id');
       
    }
     /**
     * Get the attributr record associated with the attributr Type.
     */
    
}