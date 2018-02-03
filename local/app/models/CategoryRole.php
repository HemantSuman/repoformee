<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CategoryRole extends Model
{
    protected $table = 'category_role';
    
    protected $fillable = [
        'role_id', 'category_id', 'pid'
    ];
    
    public function categoryRole_category() {
        return $this->belongsTo('App\models\Category','category_id');
    }
}
