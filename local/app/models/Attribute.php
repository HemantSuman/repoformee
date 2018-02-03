<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Attribute extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'display_name', 'p_attr_id', 'attributetype_id', 'description', 'size', 'measure_unit', 'required', 'searchable', 'attribute_value', 'metatitle', 'metadescription', 'status', 'icon', 'show_list'
    ];

    /**
     * The category that belong to the attribute.
     */
    public function categories() {
        return $this->belongsToMany('App\models\Category');
    }

    /**
     * The attribute_value_child that belong to the attribute.
     */
    public function attribute_value_child() {
        return $this->hasMany('App\models\AttributeValueChild');
    }

    /**
     * The attribute_value_child that belong to the attribute.
     */
    public function attribute_value() {
        return $this->hasMany('App\models\AttributeValue');
    }

    /**
     * The attribute_value_child that belong to the attribute.
     */
    public function attribute_value1() {
        return $this->hasMany('App\models\AttributeValue');
    }

    /**
     * The Classified that belong to the attribute.
     */
    public function attribute_classified() {
        return $this->belongsToMany('App\models\Classified');
    }
	
    public function attribute_groups() {
        return $this->belongsToMany('App\models\Group');
    }

    /**
     * The attributeType that belong to the attribute.
     */
    public function attributeType() {
        return $this->hasOne('App\models\AttributeType', 'id', 'attributetype_id');
    }

    /**
     * The attributeType that belong to the attribute.
     */
    public function sub_attributes() {
        return $this->hasMany('App\models\Attribute', 'p_attr_id', 'id');
    }

}    