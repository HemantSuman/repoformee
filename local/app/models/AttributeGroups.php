<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class AttributeGroups extends Authenticatable
{
    use HasApiTokens, Notifiable;
protected $table = 'attribute_group';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attribute_id','group_id'
    ];
    
    
     /**
     * Get the attributr record associated with the attributr Type.
     */
    
    
}
