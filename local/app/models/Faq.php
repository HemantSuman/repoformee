<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    //
     public function faq_categories() {
        return $this->belongsTo('App\models\FaqCategory', 'faq_category_id');
       
    }
}
