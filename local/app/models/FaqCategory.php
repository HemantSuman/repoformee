<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    //
     public function faq() {
        return $this->hasMany('App\models\Faq');
       
    }
}
