<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SavedSearch extends Model
{
    /**
     * The saved search that belong to the category.
     */
    public function category() {
        return $this->belongsTo('App\models\Category');
    }

    /**
     * The saved search that belong to the user.
     */
    public function user() {
        return $this->belongsTo('App\models\User');
    }
}
