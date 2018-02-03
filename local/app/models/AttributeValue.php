<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model {

    protected $table = 'attribute_value';

    protected $fillable = [
        'id', 'attribute_id', 'values'
    ];

    
}
