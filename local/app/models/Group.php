<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Group extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $guarded = array('*');

    protected $fillable = [
        'id', 'title', 'category_id', 'parent_categoryid', 'status','created_at','updated_at'
    ];

    public function attributes_groups() {
        return $this->belongsToMany('App\models\Attribute');
    }

    public function categoriesname() {
        return $this->belongsTo('App\models\Category', 'parent_categoryid');
    }

    public function Subcategoriesname() {
        return $this->belongsTo('App\models\Category', 'category_id');
    }

    public function get_groupscount() {
        $active = DB::table('groups')->where('status', '=', 1)->orWhere('status', '=', 0)->count();
        $groupscount = array(
            "active" => $active,
        );
        return $groupscount;
    }

    /**
     * delete product
     *
     * @param array $request data
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function deleteAll($id) {
        $req = self::findOrFail($id);
        $req->delete();
        $lastid = $req->id;
        return $req;
    }
    
    
    /**
     * update product
     *
     * @param array $request data
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function updateRequestValue($request, $id) {
        $req = self::findOrFail($id);
        $req->status = $request['status'];
        $req->save();
        $lastid = $req->id;

        return $req;
    }

}
