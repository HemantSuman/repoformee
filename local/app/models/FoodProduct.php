<?php

namespace App\models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Input;
use File;
use Intervention\Image\Facades\Image as image1;
use Session;
use DB;

class FoodProduct extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The database fields.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'category_id', 'name', 'description', 'image', 'status', 'bar_code', 'ingredient', 'nutrition', 'metakeyword', 'metadescription', 'created_at', 'updated_at'
    ];

    /**
     * The foodProduct has many attributes.
     */
    public function food_product_attribute() {
        return $this->belongsToMany('App\models\Attribute', 'attribute_classified')->withPivot('attr_value', 'attr_type_id', 'attr_type_name');
    }

    /**
     * get list of product
     *
     * @param array $req  all conditions like where, order by and limit
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function Listing() {
        $requestArr = Input::all();
        if (!empty($requestArr)) {
            $results = new FoodProduct;
            if (isset($requestArr['status']) && $requestArr['status'] != '' && ($requestArr['status'] == 0 || $requestArr['status'] == 1)) {
                $results = $results->where(['status' => $requestArr['status']]);
            } else {
                $results = $results->where(function($q) {
                    $q->where(['status' => 1])
                            ->orwhere(['status' => 0]);
                });
            }
            if (!empty($requestArr['name'])) {
                $results = $results->where('name', 'LIKE', "%{$requestArr['name']}%");
            }
            if (!empty($requestArr['bar_code'])) {
                $results = $results->where('bar_code', 'LIKE', "%{$requestArr['bar_code']}%");
            }
            $results = $results->paginate(10);
        } else {
            $results = FoodProduct::where(function($q) {
                        $q->where(['status' => 1])
                                ->orwhere(['status' => 0]);
                    })->get();
        }

        return $results;
    }

    /**
     * get single result of product
     *
     * @param $id primary key
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function getFirstValue($id = null) {

        try {
            $results = FoodProduct::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            $results = $ex->getMessage();
        }
        return $results;
    }

    /**
     * save product
     *
     * @param array $request data
     *
     * @copyright  formee
     * @version    laravel 5.3
     * @link       http://formee.com.au/
     */
    public function saveAll($request) {

        $requestArr = Input::all();
        $exceptFields = ['_token', 'attr_ids','attr_type_id_multi', 'attr_type_name', 'parent_value_id', 'parent_attribute_id', 'attr_type_id', 'attr_value', 'attr_ids_multi', 'attr_value_multi', 'attr_type_name_multi'];

        $req = $this;
        foreach ($requestArr as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $req->$key = $value;
            }
        }
        if (!isset($request->status) && $request->status != 1) {
            $req->status = 0;
        }

        if (isset($request->attr_value_multi) && $request->attr_value_multi) {

            foreach ($request->attr_value_multi as $key => $value) {
                foreach ($value as $k => $v) {

                    $extra1[$v]["attribute_id"] = $key;
                    $extra1[$v]["attr_type_name"] = $request->attr_type_name_multi;
                    $extra1[$v]["attr_type_id"] = $request->attr_type_id_multi;
                    $extra1[$v]["attr_value"] = $v;
                }
            }
        } else {
            $extra1 = [];
        }

//for Radio
        if (isset($request->attr_value_radio) && $request->attr_value_radio) {

            foreach ($request->attr_value_radio as $key => $value) {
                foreach ($value as $k => $v) {

                    $extra2[$v]["attribute_id"] = $key;
                    $extra2[$v]["attr_type_name"] = $request->attr_type_name_radio;
                    $extra2[$v]["attr_type_id"] = $request->attr_type_id_radio;
                    $extra2[$v]["attr_value"] = $v;
                }
            }
            $extra1 = $extra1 + $extra2;
        }
//for Image Gallery
        if (Input::file('attr_value_image')) {
            if (isset($request->attr_value_image)) {
                foreach ($request->attr_value_image as $key => $value) {
                    foreach ($value as $k => $v) {
                        $extension = $v->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $fileNameAttrTypeImageGallery[$key][] = $ran . '.' . $extension;

                        $extra3[$fileNameAttrTypeImageGallery[$key][$k]]["attribute_id"] = $key;
                        $extra3[$fileNameAttrTypeImageGallery[$key][$k]]["attr_type_name"] = $request->attr_type_name_image;
                        $extra3[$fileNameAttrTypeImageGallery[$key][$k]]["attr_type_id"] = $request->attr_type_id_image;
                        $extra3[$fileNameAttrTypeImageGallery[$key][$k]]["attr_value"] = $fileNameAttrTypeImageGallery[$key][$k];
                    }
                }
            }
            $extra1 = $extra1 + $extra3;
        }
        if (isset($requestArr['attr_ids']) && !empty($requestArr['attr_ids'])) {

            foreach ($request->attr_type_name as $key => $value) {
                if ($request->attr_value[$key] != '') {
                    $extra[$key]["attr_type_name"] = $value;
                    $extra[$key]["attr_type_id"] = $request->attr_type_id[$key];
                    $extra[$key]["attr_value"] = $request->attr_value[$key];
                    $extra[$key]["parent_value_id"] = $request->parent_value_id[$key];
                    $extra[$key]["parent_attribute_id"] = $request->parent_attribute_id[$key];

                    $requestArr1['attr_ids'][$key] = $requestArr['attr_ids'][$key];
                }
            }
            $dataExtra = array_combine($requestArr1['attr_ids'], $extra);
        }

        //forVideo Type
        if (Input::file('attr_value_video')) {
            $attr_value_video = Input::file('attr_value_video');
            foreach ($attr_value_video as $key => $val) {
                $extension = $val->getClientOriginalExtension();
                $ran = rand(11111, 99999);
                $VideoNameAttrType[] = $ran . '.' . $extension;
                $extraVideo[$request->attr_ids_video[$key]]["attr_type_name"] = $request->attr_type_name_video[$key];
                $extraVideo[$request->attr_ids_video[$key]]["attr_type_id"] = $request->attr_type_id_video[$key];
                $extraVideo[$request->attr_ids_video[$key]]["attr_value"] = $VideoNameAttrType[$key];
            }
            if (isset($dataExtra) && !empty($dataExtra)) {
                $dataExtra = $dataExtra + $extraVideo;
            } else {
                $dataExtra = $extraVideo;
            }
        }
        $savedValues = $this->create($req->toArray());
        if (isset($dataExtra) && !empty($dataExtra)) {
            $savedValues->food_product_attribute()->sync($dataExtra);
        }
        if (isset($extra1) && !empty($extra1)) {
            foreach ($extra1 as $ke => $val) {
                $val['food_product_id'] = $savedValues->id;
                \DB::table('attribute_classified')->insert($val);
            }
        }
        $lastinstertid = $savedValues->id;
        if ($lastinstertid) {
            if (Input::file('image')) {
                $image = Input::file('image');
                if (!is_dir('upload_images/food_products/backgroundimage/' . $lastinstertid)) {
                    File::makeDirectory('upload_images/food_products/backgroundimage/' . $lastinstertid, 0777, true);
                }
                if (!is_dir('upload_images/food_products/backgroundimage/30px/' . $lastinstertid)) {
                    File::makeDirectory('upload_images/food_products/backgroundimage/30px/' . $lastinstertid, 0777, true);
                }

                $destinationPath = 'upload_images/food_products/backgroundimage/' . $lastinstertid . '/';

                $destinationPaththumb = 'upload_images/food_products/backgroundimage/30px/' . $lastinstertid . '/';
                $extension = $image->getClientOriginalExtension();
                $ran = rand(11111, 99999);
                $fileName = $ran . '.' . $extension;

                $image->move($destinationPath, $fileName);
                image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                $req->image = $fileName;
                $req->save();
            }

            //For ImagesGallery attribute value
            if (Input::file('attr_value_image')) {
                $attr_value_images = Input::file('attr_value_image');

                foreach ($attr_value_images as $key => $val) {
                    foreach ($val as $k => $v) {

                        if (!is_dir('upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key)) {
                            File::makeDirectory('upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key, 0777, true);
                        }
                        $destinationPath = 'upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key . '/';

                        $v->move($destinationPath, $fileNameAttrTypeImageGallery[$key][$k]);
                    }
                }
            }

            //For Videotype attribute value
            if (Input::file('attr_value_video')) {
                $attr_value_video = Input::file('attr_value_video');
                foreach ($attr_value_video as $key => $val) {
                    File::makeDirectory('upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key], 0777, true);
                    $destinationPath = 'upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key] . '/';
                    $val->move($destinationPath, $VideoNameAttrType[$key]);
                }
            }

            return $req;
        } else {
            return false;
        }
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
    public function updateAll($request, $id) {

        $requestArr = Input::all();
        $exceptFields = ['_token', 'attr_type_name', 'attr_type_id', 'attr_value', 'attr_ids', 'parent_value_id', 'parent_attribute_id', 'image', 'attr_ids_multi',
            'attr_value_multi', 'attr_type_id_multi', 'attr_type_name_multi', 'attr_type_name_file', 'attr_type_id_file',
            'attr_ids_file', 'attr_value_file_old', 'attr_value_file', 'hour', 'minute', 'meridian', 'attr_type_name_video',
            'attr_type_id_video', 'attr_ids_video', 'attr_value_video_old', 'attr_value_video',
            'attr_ids_radio', 'attr_value_radio', 'attr_type_id_radio', 'attr_type_name_radio', 'attr_type_name_image',
            'attr_type_name_image', 'attr_type_id_image', 'attr_ids_image', 'attr_value_image_old', 'attr_value_image', 'withCommunty', 'city', 'withinformation'];

        $data = FoodProduct::findOrFail($id);
        foreach ($requestArr as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $data->$key = $value;
            }
        }
        if (!isset($request->status) && $request->status != 1) {
            $data->status = 0;
        }


        $extra1 = [];
        $extra2 = [];
        $extra3 = [];
        $extra4 = [];
        $dataExtra = [];

        if (isset($request->attr_value_multi) && !empty($request->attr_value_multi)) {

            foreach ($request->attr_value_multi as $key => $value) {
                foreach ($value as $k => $v) {

                    $extra1[$v]["attribute_id"] = $key;
                    $extra1[$v]["attr_type_name"] = $request->attr_type_name_multi;
                    $extra1[$v]["attr_type_id"] = $request->attr_type_id_multi;
                    $extra1[$v]["attr_value"] = $v;
                }
            }
        } else {
            $extra1 = [];
        }

        if (isset($requestArr['attr_ids_radio']) && !empty($requestArr['attr_ids_radio'])) {
            if (isset($request->attr_value_radio)) {
                foreach ($request->attr_value_radio as $key => $value) {
                    foreach ($value as $k => $v) {

                        $extra2[$v]["attribute_id"] = $key;
                        $extra2[$v]["attr_type_name"] = $request->attr_type_name_radio;
                        $extra2[$v]["attr_type_id"] = $request->attr_type_id_radio;
                        $extra2[$v]["attr_value"] = $v;
                    }
                }
            }
            $extra1 = $extra1 + $extra2;
        }

        if (isset($request->attr_ids_image)) {
            foreach ($request->attr_ids_image as $key => $value) {

                if (isset($request->attr_value_image[$value]) && (!empty($request->attr_value_image[$value]))) {
                    foreach ($request->attr_value_image[$value] as $k => $v) {
                        $extension = $v->getClientOriginalExtension();
                        $ran = rand(11111, 99999);
                        $fileNameAttrTypeImageGallery[$value][] = $ran . '.' . $extension;

                        $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attribute_id"] = $value;
                        $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attr_type_name"] = $request->attr_type_name_image;
                        $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attr_type_id"] = $request->attr_type_id_image;
                        $extra3[$fileNameAttrTypeImageGallery[$value][$k]]["attr_value"] = $fileNameAttrTypeImageGallery[$value][$k];
                    }
                    $extra1 = $extra1 + $extra3;
                }
                foreach ($request->attr_value_image_old[$value] as $k1 => $v1) {
                    $extra4[$v1]["attribute_id"] = $value;
                    $extra4[$v1]["attr_type_name"] = $request->attr_type_name_image;
                    $extra4[$v1]["attr_type_id"] = $request->attr_type_id_image;
                    $extra4[$v1]["attr_value"] = $v1;
                }

                $extra1 = $extra1 + $extra4;
            }
        }
        $requestArr1['attr_ids'] = [];
        $extra = [];
        if (isset($requestArr['attr_ids']) && !empty($requestArr['attr_ids'])) {
            foreach ($request->attr_type_name as $key => $value) {
                if ($request->attr_value[$key] == ';') {
                    $request->attr_value[$key] = '';
                }
                $extra[$key]["attr_type_name"] = $value;
                $extra[$key]["attr_type_id"] = $request->attr_type_id[$key];
                $extra[$key]["attr_value"] = $request->attr_value[$key];
                $extra[$key]["parent_value_id"] = $request->parent_value_id[$key];
                $extra[$key]["parent_attribute_id"] = $request->parent_attribute_id[$key];

                $requestArr1['attr_ids'][$key] = $requestArr['attr_ids'][$key];
            }

            $dataExtra = array_combine($requestArr1['attr_ids'], $extra);
        }

        //forVideo Type
        if (isset($request->attr_ids_video)) {
            foreach ($request->attr_ids_video as $key => $val) {
                $attr_value_video = Input::file('attr_value_video');
                if (isset($attr_value_video[$key])) {

                    $extension = $attr_value_video[$key]->getClientOriginalExtension();
                    $ran = rand(11111, 99999);
                    $VideoNameAttrType[$key] = $ran . '.' . $extension;
                    $extraVideo[$request->attr_ids_video[$key]]["attr_type_name"] = $request->attr_type_name_video[$key];
                    $extraVideo[$request->attr_ids_video[$key]]["attr_type_id"] = $request->attr_type_id_video[$key];
                    $extraVideo[$request->attr_ids_video[$key]]["attr_value"] = $VideoNameAttrType[$key];
                } else if (isset($request->attr_value_video_old[$key]) && (!empty($request->attr_value_video_old[$key]))) {
                    $extraVideo[$request->attr_ids_video[$key]]["attr_type_name"] = $request->attr_type_name_video[$key];
                    $extraVideo[$request->attr_ids_video[$key]]["attr_type_id"] = $request->attr_type_id_video[$key];
                    $extraVideo[$request->attr_ids_video[$key]]["attr_value"] = $request->attr_value_video_old[$key];
                }
            }
            if (isset($dataExtra) && !empty($dataExtra)) {
                $dataExtra = $dataExtra + $extraVideo;
            } else {
                $dataExtra = $extraVideo;
            }
        }

        $savedValues = $data->save();
        if (isset($dataExtra) && !empty($dataExtra)) {
            $data->food_product_attribute()->sync($dataExtra);
        }
        foreach ($dataExtra as $k2 => $v2) {
            if ($v2['attr_value'] == '' || $v2['attr_value'] == 'on') {
                DB::table('attribute_classified')->where('food_product_id', '=', $id)->where('attribute_id', '=', $k2)->delete();
            }
        }
        DB::table('attribute_classified')->where('food_product_id', '=', $id)->where('attr_type_name', '=', 'Multi-Select')->delete();
        DB::table('attribute_classified')->where('food_product_id', '=', $id)->where('attr_type_name', '=', 'Radio-button')->delete();
        if (isset($extra1) && !empty($extra1)) {
            foreach ($extra1 as $ke => $val) {
                $val['food_product_id'] = $id;
                \DB::table('attribute_classified')->insert($val);
            }
        }
        $lastinstertid = $id;

        if ($lastinstertid) {
            if (Input::file('image')) {
                $image = Input::file('image');
                if (!is_dir('upload_images/food_products/backgroundimage/' . $data->id)) {
                    File::makeDirectory('upload_images/food_products/backgroundimage/' . $data->id, 0777, true);
                }
                if (!is_dir('upload_images/food_products/backgroundimage/30px/' . $data->id)) {
                    File::makeDirectory('upload_images/food_products/backgroundimage/30px/' . $data->id, 0777, true);
                }

                $destinationPath = 'upload_images/food_products/backgroundimage/' . $data->id . '/';

                $destinationPaththumb = 'upload_images/food_products/backgroundimage/30px/' . $data->id . '/';
                $extension = $image->getClientOriginalExtension();
                $ran = rand(11111, 99999);
                $fileName = $ran . '.' . $extension;

                $image->move($destinationPath, $fileName);
                image1::make($destinationPath . $fileName)->resize(30, 30)->save($destinationPaththumb . $fileName);
                $data->image = $fileName;
                $data->save();
            }

//For Filetype attribute value
            if (Input::file('attr_value_file')) {
                $attr_value_file = Input::file('attr_value_file');
                foreach ($attr_value_file as $key => $val) {

                    if (!is_dir('upload_images/attribute_values/file/' . $lastinstertid . '/' . $request->attr_ids_file[$key])) {
                        File::makeDirectory('upload_images/attribute_values/file/' . $lastinstertid . '/' . $request->attr_ids_file[$key], 0777, true);
                    }

                    $destinationPath = 'upload_images/attribute_values/file/' . $lastinstertid . '/' . $request->attr_ids_file[$key] . '/';

                    $val->move($destinationPath, $fileNameAttrType[$key]);
                }
            }

//For Videotype attribute value
            if (Input::file('attr_value_video')) {
                $attr_value_video = Input::file('attr_value_video');
                foreach ($attr_value_video as $key => $val) {

                    if (!is_dir('upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key])) {
                        File::makeDirectory('upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key], 0777, true);
                    }

                    $destinationPath = 'upload_images/attribute_values/video/' . $lastinstertid . '/' . $request->attr_ids_video[$key] . '/';
                    $val->move($destinationPath, $VideoNameAttrType[$key]);
                }
            }

//For ImagesGallery attribute value
            if (Input::file('attr_value_image')) {
                $attr_value_images = Input::file('attr_value_image');

                foreach ($attr_value_images as $key => $val) {
                    foreach ($val as $k => $v) {

                        if (!is_dir('upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key)) {
                            File::makeDirectory('upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key, 0777, true);
                        }
                        $destinationPath = 'upload_images/attribute_values/image-gallery/' . $lastinstertid . '/' . $key . '/';

                        $v->move($destinationPath, $fileNameAttrTypeImageGallery[$key][$k]);
                    }
                }
            }
            return $data;
        } else {
            return false;
        }
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
        $req = FoodProduct::findOrFail($id);
        $req->status = $request['status'];
        $req->save();
        $lastid = $req->id;

        return $req;
    }

    function ListingAll($where = []) {

        $listing = self::where($where)->get();
        return $listing;
    }
    
}
