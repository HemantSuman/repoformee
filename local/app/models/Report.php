<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

	/**
     * The report that belong to the classified.
     */
    public function classified() {
        return $this->belongsTo('App\models\Classified');
    }

    /**
     * The report that belong to the user.
     */
    public function user() {
        return $this->belongsTo('App\models\User');
    }
}
