<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    /**
     * The wishlist that belong to the classified.
     */
    public function classified() {
        return $this->belongsTo('App\models\Classified');
    }
}
