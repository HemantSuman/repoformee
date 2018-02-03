<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    /**
     * The query that has many query responds.
     */
    public function query_respond() {
        return $this->hasMany('App\models\QueryRespond');
    }

    /**
     * The query that has many query attcahments.
     */
    public function query_attachment() {
        return $this->hasMany('App\models\QueryAttachment');
    }

    public function get_unread_queries() {
        return $this->where(['status' => 0])->count();
    }
}
