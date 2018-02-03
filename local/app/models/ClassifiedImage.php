<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class ClassifiedImage extends Authenticatable
{
    use HasApiTokens, Notifiable;
protected $table = 'classifiedimage';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'classified_id'
    ];
    
    
     /**
     * Get the attributr record associated with the attributr Type.
     */
    
    
}
