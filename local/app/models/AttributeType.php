<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AttributeType extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'slug','status'
    ];
    
    
     /**
     * Get the attributr record associated with the attributr Type.
     */
    public function attribute()
    {
        return $this->belongsTo('App\models\Attribute', 'id','attributetype_id');
    }
    
}
