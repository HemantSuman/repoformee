<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AttributeValueChild extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'attribute_value_child';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','attribute_id', 'attribute_parent_id','attribute_value_id','attribute_value'
    ];
    
    
    
}
