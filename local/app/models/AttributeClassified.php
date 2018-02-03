<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class AttributeClassified extends Authenticatable
{
    use HasApiTokens, Notifiable;
protected $table = 'attribute_classified';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attribute_id','classified_id','food_product_id', 'attr_value','attr_type_id','attr_type_name','parent_value_id','parent_attribute_id'
    ];
    
    
     /**
     * Get the attributr record associated with the attributr Type.
     */
    
    
}
