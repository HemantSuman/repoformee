<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Role extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name','role_type','role_slug','seller_type','is_merchant', 'add_date','status'
    ];

    public function permission_role() {
        return $this->hasMany('App\models\PermissionRole');
    }

    public function role_membership_plans() {
        return $this->hasMany('App\models\MembershipPlan');
    }

    public function role_categories() {
        return $this->belongsToMany('App\models\Category')->withPivot('pid');
    }

    function Listing($where = []) {

        $listing = self::where($where)->pluck("name", "id");
        return $listing;
    }

    function ListingAll($where = []) {

        $listing = self::where($where)->get();
        return $listing;
    }
}
