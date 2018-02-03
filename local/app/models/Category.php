<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Category extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'pid', 'description', 'icon', 'image', 'belong_to_community', 'accessible_to_users', 'status', 'metakeyword', 'metadescription', 'feactured', 'overlay_position', 'price'
    ];

    /**
     * The attribute that belong to the category.
     */
    public function attributes() {
        return $this->belongsToMany('App\models\Attribute');
    }
    
    public function categorie_roles() {
        return $this->belongsToMany('App\models\Role');
    }

    public function getCategories($selectedCategories = null) {
        
        $categories = \App\models\Category::select('id', 'name AS text', 'pid')->where(['pid' => 0, 'status' => 1])->get();
        $categories = $this->addRelation($categories, $selectedCategories);
        return $categories;
    }
    
    public function getCategories_is_sellable($selectedCategories = null) {

        $categories = \App\models\Category::select('id', 'name AS text', 'pid')->where(['pid' => 0, 'status' => 1])->get();
        $categories = $this->addRelation_is_sellable($categories, $selectedCategories);
        return $categories;
    }
    
    protected function addRelation_is_sellable($categories, $selectedCategories) {
        $categories->map(function ($item, $key) use ($selectedCategories, $categories) {


            if (!empty($selectedCategories)) {

                if (in_array($item->id, $selectedCategories)) {
                    $item->checked = true;
                }
            }
            $sub = $this->selectChild_is_sellable($item->id, $selectedCategories);
            return $item = array_add($item, 'children', $sub);
        });

        return $categories;
    }
    
    protected function selectChild_is_sellable($id, $selectedCategories) {
        $categories = \App\models\Category::select('id', 'name AS text','icon', 'pid')->where(['pid' => $id, 'status' => 1,'is_sellable' => 1])->get();
        $categories->map(function ($item, $key) use ($selectedCategories) {


            if (!empty($selectedCategories)) {

                if (in_array($item->id, $selectedCategories)) {
                    $item->checked = true;
                }
            }
        });
        $categories = $this->addRelation_is_sellable($categories, null);
        return $categories;
    }

    protected function selectChild($id, $selectedCategories) {
        $categories = \App\models\Category::select('id', 'name AS text','icon', 'pid')->where(['pid' => $id, 'status' => 1])->get();

        $categories->map(function ($item, $key) use ($selectedCategories) {


            if (!empty($selectedCategories)) {

                if (in_array($item->id, $selectedCategories)) {
                    $item->checked = true;
                }
            }
        });

        $categories = $this->addRelation($categories, null);
        return $categories;
    }

    protected function addRelation($categories, $selectedCategories) {

        $categories->map(function ($item, $key) use ($selectedCategories) {


            if (!empty($selectedCategories)) {

                if (in_array($item->id, $selectedCategories)) {
                    $item->checked = true;
                }
            }
            $sub = $this->selectChild($item->id, $selectedCategories);
            return $item = array_add($item, 'children', $sub);
        });

        return $categories;
    }

    function categoryListing($where = array(), $method = '') {

        $where = array_merge($where, array('status' => 1));

        $categories = Category::where($where)->pluck("name", "id");
        return $categories;
    }

    function categoryListingFront($where = array()) {

        $where = array_merge($where, array('status' => 1));

        $categories = Category::where($where)->select(["name", "id", "image", "icon", "belong_to_community"])->get();
        return $categories;
    }
    
    function categoryValueFirst($where = array()) {

        $where = array_merge($where, array('status' => 1));

        $categories = Category::where($where)->select(["name", "id"])->first();
        return $categories;
    }

    public function categoryParent() {
        return $this->hasone('App\models\Category', 'id', 'pid');
    }
    
    public function categoryChilds() {
        return $this->hasMany('App\models\Category', 'pid', 'id');
    }
   
    public function category_hm_groups() {
        return $this->hasMany('App\models\Group', 'category_id');
    }

    public function getFrontCategories($selectedCategories = null) {

//        $categories = \App\models\Category::select('id', 'name AS text')->where(['pid' => 0, 'status' => 1, 'belong_to_community' => 0])->orderBy('order_no', 'ASC')->limit(10)->get();
        $categories = \App\models\Category::select('id', 'name AS text')->where(['pid' => 0, 'status' => 1])->orderBy('order_no', 'ASC')->get();
        $categories = $this->addRelation($categories, $selectedCategories);
        return $categories;
    }

    public function getFrontComCategories($selectedCategories = null) {

        $categories = \App\models\Category::select('id', 'name AS text','icon')->where(['pid' => 0, 'status' => 1, 'belong_to_community' => 1])->orderBy('order_no', 'ASC')->get();
        $categories = $this->addRelation($categories, $selectedCategories);
        return $categories;
    }

    public function getFrontinformationCategories($selectedCategories = null) {

        $categories = \App\models\Category::select('id', 'name AS text','icon')->where(['pid' => 0, 'status' => 1, 'show_on_info_area' => 1])->orderBy('order_no', 'ASC')->get();
        $categories = $this->addRelation($categories, $selectedCategories);
        return $categories;
    }

    public function getFrontCategoriesForMenu($selectedCategories = null) {

        $categories = \App\models\Category::select('id', 'name AS text','icon')->where(['pid' => 0, 'status' => 1, 'belong_to_community' => 0, 'show_on_info_area' => 0])->orderBy('order_no', 'ASC')->get();
        $categories = $this->addRelation($categories, $selectedCategories);
        return $categories;
    }

    public function getFrontCategoriesForMenuheader($selectedCategories = null) {

        $categories = \App\models\Category::select('id', 'name AS text','icon')->where(['pid' => 0, 'status' => 1, 'belong_to_community' => 0, 'show_on_info_area' => 0])->orderBy('order_no', 'ASC')->get();
        $categories = $this->addRelation($categories, $selectedCategories);
        return $categories;
    }

    public function getInformationAreaCategories($selectedCategories = null) {

        $categories = \App\models\Category::select('id', 'name AS text','icon')->where(['pid' => 0, 'status' => 1, 'show_on_info_area' => 1])->orderBy('order_no', 'ASC')->get();
        $categories = $this->addRelation($categories, $selectedCategories);
        return $categories;
    }

    public function getCategoriesForapi($selectedCategories = null) {
        $rooturl = \Request::root();
        $categories = \App\models\Category::select(DB::raw("id,name AS text,concat('$rooturl/upload_images/categories/icon/',id,'/',icon) imageurl"))->where(['pid' => 0, 'status' => 1, 'belong_to_community' => 0, 'show_on_info_area' => 0])->orderBy('order_no', 'ASC')->get();
        $categories = $this->addRelation($categories, $selectedCategories);


        return $categories;
    }

    public function getCategoriestabledataForapi($selectedCategories = null) {

        $categories = \App\models\Category::select(DB::raw("id,pid,name,icon,image,belong_to_community,show_on_info_area,status,created_at,accessible_to_users"))->get();
        return $categories;
    }

    public function getCategoriestabledataFornewinserted($timeinterval = null) {
        $datetimeFormat = 'Y-m-d H:i:s';
        $date = new \DateTime();
        $date->setTimestamp($timeinterval);
        $timeformat= $date->format($datetimeFormat);
        $categories = \App\models\Category::select(DB::raw("id,pid,name,icon,image,belong_to_community,show_on_info_area,status,created_at,accessible_to_users"))->where('created_at', '>=', $timeformat)->get();
        return $categories;
    }

    public function getCategoriestabledataForupdated($timeinterval = null) {
        $datetimeFormat = 'Y-m-d H:i:s';
        $date = new \DateTime();
        $date->setTimestamp($timeinterval);
        $timeformat= $date->format($datetimeFormat);
        $categories = \App\models\Category::select(DB::raw("id,pid,name,icon,image,belong_to_community,show_on_info_area,status,created_at"))->where('updated_at', '>=', $timeformat)->get();
        return $categories;
    }

    public function getCategoriestabledataFordeleted($timeinterval = null) {
        $datetimeFormat = 'Y-m-d H:i:s';
        $date = new \DateTime();
        $date->setTimestamp($timeinterval);
        $timeformat= $date->format($datetimeFormat);
        $categories = \DB::table('category_deleted')->select(DB::raw("id,category_id"))->where('created_at', '>=', $timeformat)->get();
        return $categories;
    }

    public function getSubCategoriesForapi($categorieid = null) {
        $rooturl = \Request::root();
        $categories = \App\models\Category::select(DB::raw("id,name AS text,concat('$rooturl/upload_images/categories/icon/',id,'/',icon) imageurl"))->where(['pid' => $categorieid, 'status' => 1,])->orderBy('order_no', 'ASC')->get();


        return $categories;
    }

    public function parentCategory_classifieds() {
        return $this->hasMany('App\models\Classified', 'parent_categoryid', 'id');
    }

    public function subCategory_classifieds() {
        return $this->hasMany('App\models\Classified', 'category_id', 'id');
    }

    public function getCategoriesWithClassifiedCount($selectedCategories = null) {
        $cur_date = date('Y-m-d');
        $categories = \App\models\Category::select('id', 'name AS text', 'icon')->with(['parentCategory_classifieds' => function($parentCategory_classifieds) use ($cur_date) {
                        $parentCategory_classifieds->where('status', '=', 1);
                        $parentCategory_classifieds->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ");
                    }])->where(['pid' => 0, 'status' => 1])->orderBy('order_no', 'ASC')->get();

        $categories = $this->addRelationForCatClassifiedCount($categories, $selectedCategories);
        return $categories;
    }
    public function getinformationCategoriesWithClassifiedCount($selectedCategories = null) {
        $cur_date = date('Y-m-d');
        $categories = \App\models\Category::select('id', 'name AS text')->with(['parentCategory_classifieds' => function($parentCategory_classifieds) use ($cur_date) {
                        $parentCategory_classifieds->where('status', '=', 1);
                        $parentCategory_classifieds->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ");
                    }])->orwhere('belong_to_community', '=', 1)->orwhere('show_on_info_area', '=', 1)->orderBy('order_no', 'ASC')->get();

        $categories = $this->addRelationForCatClassifiedCount($categories, $selectedCategories);
        return $categories;
    }

    protected function addRelationForCatClassifiedCount($categories, $selectedCategories) {

        $categories->map(function ($item, $key) use ($selectedCategories) {


            if (!empty($selectedCategories)) {

                if (in_array($item->id, $selectedCategories)) {
                    $item->checked = true;
                }
            }
            $sub = $this->selectChildCategoriesWithClassifiedCount($item->id, $selectedCategories);
            return $item = array_add($item, 'children', $sub);
        });

        return $categories;
    }

    protected function selectChildCategoriesWithClassifiedCount($id, $selectedCategories) {
        $cur_date = date('Y-m-d');
        $categories = \App\models\Category::select('id', 'name AS text', 'icon')->with(['subCategory_classifieds' => function($subCategory_classifieds)use ($cur_date) {
                        $subCategory_classifieds->where('status', '=', 1);
                        $subCategory_classifieds->whereRaw("'$cur_date' Between classifieds.start_date and classifieds.end_date ");
                    }])->where(['pid' => $id, 'status' => 1])->get();

        $categories->map(function ($item, $key) use ($selectedCategories) {


            if (!empty($selectedCategories)) {

                if (in_array($item->id, $selectedCategories)) {
                    $item->checked = true;
                }
            }
        });

        $categories = $this->addRelationForCatClassifiedCount($categories, null);
        return $categories;
    }

    public function classifieds() {
        return $this->hasMany('App\models\Classified');
    }

    public function saved_search() {
        return $this->hasMany('App\models\Classified');
    }

    public function most_posted_classified_category() {
        $catgryClassfdData = \App\models\Category::with('parentCategory_classifieds')->get();
        $ClassfdCountArray = array();
        foreach ($catgryClassfdData as $catgryClassfdDataKey => $catgryClassfdDataVal) {
            $ClassfdCountArray[] = array('category' => $catgryClassfdDataVal->name, 'total_classified' => $catgryClassfdDataVal->parentCategory_classifieds->count());
        }

        $knownColor = max(array_column($ClassfdCountArray, 'total_classified'));
        $knownKey = 'total_classified';
        $desiredKey = 'category';

        foreach ($ClassfdCountArray as $inner) {
            if ($inner[$knownKey] == $knownColor) {
                $result = $inner[$desiredKey];
                //or to get the whole inner array:
                $result = $inner;
                break;
            }
        }
        return $result;
    }

    public function most_viewed_classified_category() {
        $mvcc = \App\models\Category::with(['parentCategory_classifieds' => function($parCatClassfd) {
                        $parCatClassfd->select("id", "parent_categoryid", "category_id", "count");
                    }])->get();

        $mvccArr = array();
        foreach ($mvcc as $mvccKey => $mvccVal) {
            $total_views = 0;
            if (!empty($mvccVal->parentCategory_classifieds)) {
                foreach ($mvccVal->parentCategory_classifieds as $mvccpccKey => $mvccpccVal) {
                    $total_views += $mvccpccVal->count;
                }
                $mvccArr[$mvccKey] = array("total_views" => $total_views, "category" => $mvccVal->name);
            } else {
                $mvccArr[$mvccKey] = array("total_views" => $total_views, "category" => $mvccVal->name);
            }
        }

        $knownColor = max(array_column($mvccArr, 'total_views'));
        $knownKey = 'total_views';
        $desiredKey = 'category';

        foreach ($mvccArr as $inner) {
            if ($inner[$knownKey] == $knownColor) {
                $result = $inner[$desiredKey];
                //or to get the whole inner array:
                $result = $inner;
                break;
            }
        }
        return $result;
    }
    
     public function getaddclassifiedcategories($selectedCategories = null) {
        $categories = \App\models\Category::select('id', 'name', 'image', 'icon', 'show_static_attributes')->where(['pid' => 0, 'status' => 1, 'belong_to_community' => 0, 'show_on_info_area' => 0,'accessible_to_users'=>1])->orderBy('order_no', 'ASC')->get();
        $categories = $this->addRelation($categories, $selectedCategories);
        return $categories;
    }

    public function get_communities_categories() {
        $categories = \App\models\Category::select('id')->where(['pid' => 0, 'status' => 1, 'belong_to_community' => 1])->get();
        $filterCommunityCategories = array();
        foreach($categories as $categoriesKey => $categoriesValue) {
            $filterCommunityCategories[] = $categoriesValue['id'];
        }
        return $filterCommunityCategories;
    }

    public function get_info_categories($selectedCategories = null) {

        $categories = \App\models\Category::select('id')->where(['pid' => 0, 'status' => 1, 'show_on_info_area' => 1])->orderBy('order_no', 'ASC')->get();
        $filterInfoCategories = array();
        foreach($categories as $categoriesKey => $categoriesValue) {
            $filterInfoCategories[] = $categoriesValue['id'];
        }
        return $filterInfoCategories;
    }

    public function getFooterCategories($selectedCategories = null) {

        $categories = \App\models\Category::select('id', 'name', 'belong_to_community', 'show_on_info_area')->where(['pid' => 0, 'status' => 1])->orderBy('order_no', 'ASC')->limit(10)->get();
        return $categories;
    }

}
