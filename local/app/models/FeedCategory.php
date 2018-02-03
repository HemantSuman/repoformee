<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FeedCategory extends Model
{
    /**
     * The FeedCategory has many Feeds.
     */
    public function feeds() {
        return $this->hasMany('App\models\Feed');
    }
}
