<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    
    protected $fillable = [
        'CityId', 'CountryID', 'RegionID', 'City', 'Latitude', 'Longitude', 'TimeZone', 'DmaId', 'County', 'Code'
    ];
    
    public function city_hasmany_suburbs() {
        return $this->hasMany('App\models\Suburb','city_id', 'CityId');
    }
    
    public function city_hasmany_classifieds() {
        return $this->hasMany('App\models\Classified','city_id', 'CityId');
    }
    
}
