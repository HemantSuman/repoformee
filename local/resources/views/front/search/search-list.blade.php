@extends('front/layout/layout')

@section('content')
<div id="middle">
    <!-- main banner section -->
    <section>
        <div id="main-banner">
            <div class="banner-carousel">
                @if(sizeof($top_positions_ads) > 0)
                @foreach($top_positions_ads as $top_ad_key => $top_single_ad)
                <a href="{!! Helper::show_url($top_single_ad->image_url) !!}" target="_blank">
                    <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$top_single_ad->image) !!}" alt="banner-img">
                </a>
                @endforeach
                @elseif(!empty($default_top_position_ad))
                <a href="{!! Helper::show_url($default_top_position_ad->image_url) !!}" target="_blank">
                    <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_top_position_ad->image) !!}" alt="banner-img">
                </a>
                @endif
            </div>
        </div>
    </section>

    <?php
    $itemname = isset($data['itemname']) ? $data['itemname'] : '';
    $city = isset($data['city']) ? $data['city'] : '';
    $lat = isset($data['lat']) ? $data['lat'] : 0;
    $lng = isset($data['lng']) ? $data['lng'] : 0;
    $km = isset($data['km']) ? $data['km'] : '';
    $cat_id = isset($data['cat_id']) ? $data['cat_id'] : '';
    $state = isset($data['usr_state']) ? $data['usr_state'] : '';
    $viewType = isset($data['viewType']) ? $data['viewType'] : 'list_view';
    //$city = isset($data['usr_city']) ? $data['usr_city'] : '';
    ?>

    <!-- breadcrumb section -->
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active"><?php
                        if (!empty($cat_id)) {
                            echo $result[0]['catname'];
                        } else {
                            echo "All Categories";
                        }
                        ?></li>
                </ol>
            </div>
        </div>
    </section>

    {!! Form::open(array('url' => '/search_classifiedsdata', 'class' => 'form', 'files' => true, 'id'=>'searchlistform', 'method'=>'GET')); !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="cat_id" id="cat_ids">
    <input type="hidden" name="city" id="citys " value="{{$city}}" >
    <input type="hidden" name="itemname" id="itemnames" value="{{$itemname}}">
    <input type="hidden" name="km" id="kms" value="{{$km}}">
    <input type="hidden" name="lat" id="lats" value="{{$lat}}">
    <input type="hidden" name="lng" id="lngs" value="{{$lng}}">
    <input type="hidden" name="minprice" id="minprice" value="">
    <input type="hidden" name="maxprice" id="maxprice" value="">
    <input type="hidden" name="dropdown" id="dropdowns" value="">
    <input type="hidden" name="parent_value_id" id="parent_value_id" value="">
    <input type="hidden" name="parent_attribute_id" id="parent_attribute_id" value="">
    <input type="hidden" name="attr_ids" id="attr_ids" value="">
    <input type="hidden" name="checkbox" id="checkboxs" value="">
    <input type="hidden" name="radio" id="radios" value="">
    <input type="hidden" name="state_id" id="states" class="usr-state">
    <input type="hidden" name="city_id" id="cities" class="usr-city">
    <input type="hidden" name="cat_name" id="cat_name" value="">
    <input type="hidden" name="order" id="orders" value="most_recent">
    <input type="hidden" name="list_view" id="list_view" value="<?php echo $viewType; ?>"> 
    <?php
    // dd($newAttrArr1);

    if (isset($newAttrArr1) && !empty($newAttrArr1)) {
        foreach ($newAttrArr1 as $key => $value) {
            if ($key == 'Multi-Select') {
                foreach ($value as $k => $val) {
                    echo "<input class='attr_" . $val[0]['attribute_id'] . "' type='hidden' name='dynamicattr[]' id='' value=''>";
                }
            } else {
                foreach ($value as $k => $val) {
                    echo "<input class='attr_" . $val[0]['attribute_id'] . "' type='hidden' name='dynamicattr[]' id='' value=''>";
                }
            }
        }
    }
    ?>
    {!! Form::close() !!}

    <!-- categories section -->
    <section>
        <div id="main-inner-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <!-- style in main-categories.scss file -->
                        <div id="left-section">
                            <div class="row">
                                <div class="col-sm-4 mobile-padd-0">
                                    <div class="refine-searchWrap">
                                        <h2>Refine Search</h2> 
                                        <form class="search-form hide">
                                            <a href="javascript:void(0)" class="clearfiltter"> Clear All</a>
                                            <ul id="tree1">

                                                <li><label>Keyword :</label> <label class="hidekey"> 
                                                        <span class="removekeyword "> X</span>

                                                    </label>
                                                    <input type="text" placeholder="keyword" class="input-text form-control searchkeyword" value="{{$itemname}}">
                                                </li>


                                                <li class="category "><label class="clearcategoryfiltter">All Categories</label> 
                                                    <ul>
                                                    @foreach($allCategoriesWithClassifiedCount as $parCatKey => $parCatvalue)  
                                                    @if(sizeof($parCatvalue->children) != 0)
                                                    
                                                        <li class="filtercategory {{ $parCatvalue->id == $cat_id ? " addcat active" : "" }}" value="{{$parCatvalue->id}}" <?php echo $parCatvalue->id == $cat_id ? ' selected="selected"' : ''; ?> >
                                                            <label> <span>{{$parCatvalue->text}}</span> ({{$parCatvalue->parentCategory_classifieds->count()}})</label>
                                                            @if(sizeof($parCatvalue->children) != 0)
                                                            <ul >

                                                                @foreach($parCatvalue->children as $subCatKey => $subCatdata)

                                                                <li class="filtercategory {{ $subCatdata->id == $cat_id ? "addsub active" : "" }}" value="{{$subCatdata->id}}" <?php echo $subCatdata->id == $cat_id ? ' selected="selected"' : ''; ?> >
                                                                    <label> <span>{{$subCatdata->text}}</span> ({{$subCatdata->subCategory_classifieds->count()}})</label></li>


                                                                @endforeach
                                                            </ul>
                                                            @endif
                                                        </li>

                                                    
                                                    @endif
                                                    @endforeach
                                                    </ul>
                                                    @if(!empty($allinformationCategorieCount))
                                                    <!--                                                    <ul>
                                                    
                                                                                                            <li class="cust-info branch"><i class="fa fa-minus test"></i><label> <span>ALL Information</span></label></li> 
                                                                                                            <ul>
                                                                                                                @foreach($allinformationCategorieCount as $otherComCatKey => $OtherComCatValue)
                                                    
                                                                                                                <li class="filtercategory {{ $OtherComCatValue->id == $cat_id ? " addcat active" : "" }}" value="{{$OtherComCatValue->id}}" <?php echo $OtherComCatValue->id == $cat_id ? ' selected="selected"' : ''; ?> >
                                                                                                                    <label> <span>{{$OtherComCatValue->text}}</span> ({{$OtherComCatValue->parentCategory_classifieds->count()}})</label>
                                                                                                                    @endforeach  
                                                                                                            </ul> 
                                                                                                        </ul>-->

                                                    @endif
                                                </li>
                                                <li class="place dynamicplace">
                                                    <label>Places</label>

                                                    @foreach($staterestult as $key => $value)  
                                                    <ul>
                                                        <li class="filterstate {{ $value->state_name == $state ? " addstate active" : "" }}" value="{{$value->satet_id}}">
                                                            <label>{{$value->state_name}} ({{$value->state_count}})</label>
                                                            @if(!empty($value->city))

                                                            @foreach($value->city as $key1 => $data)
                                                            <ul>
                                                                <li class="filtercity {{ $data['name'] == $city ? " addcity active" : "" }}" value="{{$data['city_ids']}}"><label>{{$data['name']}} ({{$data['city_counts']}})</label></li>

                                                            </ul>
                                                            @endforeach
                                                            @endif
                                                        </li>

                                                    </ul>
                                                    @endforeach
                                                </li>
                                                <li class="filter-togle price">
                                                    <h3>Price</h3>
                                                    <div class="row">
                                                        <div class="col-md-5 col-sm-5 col-xs-5 ">
                                                            <input type="text" placeholder="$min" value="0" class=" pricemin form-control">
                                                        </div>
                                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                                            <input type="text" placeholder="$max"  value="" class=" pricemax form-control">
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 col-xs-2 "> 
                                                            <input type='button' value='Go' class='btn pricefilter'>

                                                        </div>
                                                    </div>
                                                </li>


                                            </ul>
                                            <ul id="treeplace">

                                            </ul>
                                            <ul id="tree2">
                                                <?php
                                                //dd($newAttrArr1);

                                                if (!empty($cat_id) || !empty($dcatid)) {
                                                    if (isset($newAttrArr1) && !empty($newAttrArr1)) {
                                                        foreach ($newAttrArr1 as $key => $value) {
                                                            if ($key == 'Drop-Down') {
                                                                foreach ($value as $k => $val) {

                                                                    $options = '';
                                                                    $options .= "<option classified_filter_id='' attr_filter_id1='" . $val[0]['attribute_id'] . "' value=''> Select Option </option> ";
                                                                    $newArr = [];
                                                                    foreach ($val[0]['attr_AllValues'] as $k1 => $v1) {
                                                                        //  dd($val[0]['attr_AllValues']);
                                                                        if (isset($newAttrArrForValue[$k1]) && !empty($newAttrArrForValue[$k1])) {
                                                                            $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$k1];
                                                                            $classified_filter_id = json_encode($newArr);
                                                                        } else {
                                                                            $classified_filter_id = '';
                                                                        }
                                                                        $options .= "<option classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' value=" . $k1 . ">" . $v1 . "</option>";
                                                                    }
                                                                    ?>
                                                                    <li>
                                                                        <label>{{ $k }}</label>
                                                                        <ul>
                                                                            <li>
                                                                                <select attributeId="<?php echo $val[0]['attribute_id']; ?>" value="<?php echo $val[0]['attribute_id']; ?>" class='filterdrop classForOnChange'>

                                                                                    <?php echo $options; ?>
                                                                                </select>
                                                                            </li>                                                   
                                                                        </ul>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            if ($key == 'Multi-Select') {
                                                                foreach ($value as $k => $val) {
                                                                    $options = '';
                                                                    $newArr = [];
                                                                    foreach ($val[0]['attr_AllValues'] as $k1 => $v1) {
                                                                        if (isset($newAttrArrForValue[$k1]) && !empty($newAttrArrForValue[$k1])) {
                                                                            $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$k1];
                                                                            $classified_filter_id = json_encode($newArr);
                                                                        } else {
                                                                            $classified_filter_id = '';
                                                                        }
                                                                        $options .= "<input classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' type='checkbox' class ='filterchkbox dyCheckBox_" . $val[0]['attribute_id'] . "' value='" . $k1 . "'/> " . '<label>' . $v1 . '</label>' . " ";
                                                                    }
                                                                    ?>
                                                                    <li>
                                                                        <label>{{ $k }}</label>
                                                                        <ul>
                                                                            <li class="">
                                                                                <?php echo $options; ?>
                                                                            </li>                                                   
                                                                        </ul>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            if ($key == 'Radio-button') {
                                                                foreach ($value as $k => $val) {
                                                                    $options = '';
                                                                    $newArr = [];
                                                                    foreach ($val[0]['attr_AllValues'] as $k1 => $v1) {
                                                                        if (isset($newAttrArrForValue[$k1]) && !empty($newAttrArrForValue[$k1])) {
                                                                            $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$k1];
                                                                            $classified_filter_id = json_encode($newArr);
                                                                        } else {
                                                                            $classified_filter_id = '';
                                                                        }
                                                                        $options .= "<input type='radio' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "'  name='radio_" . $val[0]['attribute_id'] . "' class ='filterradio' value='" . $k1 . "'/> " . '<label>' . $v1 . '</label>' . " ";
                                                                    }
                                                                    ?>
                                                                    <li>
                                                                        <label>{{ $k }}</label>
                                                                        <ul>
                                                                            <li>
                                                                                <?php echo $options; ?>
                                                                            </li>                                                   

                                                                        </ul>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            if ($key == 'calendar') {
                                                                foreach ($value as $k => $val) {
                                                                    $options = '';
                                                                    $newArr = [];
                                                                    if (isset($val[0]['attr_AllValues']) && !empty($val[0]['attr_AllValues'])) {

                                                                        $rang_cal = array_values($val[0]['attr_AllValues']);
                                                                        $total = $rang_cal[1] - $rang_cal[0];

                                                                        for ($i = $rang_cal[0]; $i <= $rang_cal[1]; $i = $i + 100) {
                                                                            $cIdArr = [];
                                                                            foreach ($val as $k2 => $v2) {
                                                                                $minMax = explode(';', $v2['attr_value']);
                                                                                if ($i >= $minMax[0] && $i <= $minMax[1]) {
                                                                                    $cIdArr[] = $v2['classified_id'];
                                                                                }
                                                                            }
                                                                            $newArr[$val[0]['attribute_id']] = $cIdArr;
                                                                            $classified_filter_id = json_encode($newArr);
                                                                            //                                                                        if($i)
                                                                            $options .= "<option classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' value=" . $i . ">" . $i . "</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <li>
                                                                        <label>{{ $k }}</label>
                                                                        <ul>
                                                                            <li>
                                                                                <select value="<?php echo $val[0]['attribute_id']; ?>" class='filtercalanderdrop'>
                                                                                    <?php echo $options; ?>
                                                                                </select>
                                                                            </li>                                                   
                                                                        </ul>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            if ($key == 'Numeric') {
                                                                foreach ($value as $k => $val) {
                                                                    //                                                                dd($val);
                                                                    $options = '';
                                                                    $newArr = [];
                                                                    $newArr11 = [];
                                                                    foreach ($val as $k2 => $v2) {

                                                                        if (isset($newAttrArrForValue[$v2['attr_value']]) && !empty($newAttrArrForValue[$v2['attr_value']])) {
                                                                            $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$v2['attr_value']];
                                                                            $classified_filter_id = json_encode($newArr);
                                                                            $newArr11[$val[0]['attribute_id']][$v2['attr_value']] = $newAttrArrForValue[$v2['attr_value']];
                                                                            $classified_json_input = json_encode($newArr11);
                                                                        } else {
                                                                            $classified_filter_id = '';
                                                                            $classified_json_input = '';
                                                                        }
                                                                        //                                                                    dd($newArr11);
                                                                    }

                                                                    //                                                                dd($val[0]['attr_type_name']);
                                                                    if (isset($val[0]['attr_AllValues']) && !empty($val[0]['attr_AllValues'])) {
                                                                        $options .= "<input type='text'  classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' name='' ><input type='button' value='Go' class='go-btn numericfilter'>";
                                                                    }
                                                                    ?>
                                                                    <li>
                                                                        <label>{{ $k }}</label>
                                                                        <ul>
                                                                            <li>
                                                                                <?php echo $options; ?>
                                                                            </li>                                                   
                                                                        </ul>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            if ($key == 'Date') {
                                                                foreach ($value as $k => $val) {
                                                                    $options = '';
                                                                    $newArr = [];
                                                                    $newArr11 = [];
                                                                    foreach ($val as $k2 => $v2) {

                                                                        if (isset($newAttrArrForValue[$v2['attr_value']]) && !empty($newAttrArrForValue[$v2['attr_value']])) {
                                                                            $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$v2['attr_value']];
                                                                            $classified_filter_id = json_encode($newArr);
                                                                            $newArr11[$val[0]['attribute_id']][$v2['attr_value']] = $newAttrArrForValue[$v2['attr_value']];
                                                                            $classified_json_input = json_encode($newArr11);
                                                                        } else {
                                                                            $classified_filter_id = '';
                                                                            $classified_json_input = '';
                                                                        }
                                                                        //                                                                    dd($newArr11);
                                                                    }
                                                                    if (isset($val[0]['attr_AllValues']) && !empty($val[0]['attr_AllValues'])) {
                                                                        $options .= "<input type='text' classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' class='datepicker' name='' ><input type='button' value='Go' class='go-btn datefilter'>";
                                                                    }
                                                                    ?>
                                                                    <li>
                                                                        <label>{{ $k }}</label>
                                                                        <ul>
                                                                            <li>
                                                                                <?php echo $options; ?>
                                                                            </li>                                                   
                                                                        </ul>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            if ($key == 'Time') {
                                                                foreach ($value as $k => $val) {
                                                                    $options = '';
                                                                    $newArr = [];
                                                                    $newArr11 = [];
                                                                    foreach ($val as $k2 => $v2) {

                                                                        if (isset($newAttrArrForValue[$v2['attr_value']]) && !empty($newAttrArrForValue[$v2['attr_value']])) {
                                                                            $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$v2['attr_value']];
                                                                            $classified_filter_id = json_encode($newArr);
                                                                            $newArr11[$val[0]['attribute_id']][$v2['attr_value']] = $newAttrArrForValue[$v2['attr_value']];
                                                                            $classified_json_input = json_encode($newArr11);
                                                                        } else {
                                                                            $classified_filter_id = '';
                                                                            $classified_json_input = '';
                                                                        }
                                                                        //                                                                    dd($newArr11);
                                                                    }
                                                                    if (isset($val[0]['attr_AllValues']) && !empty($val[0]['attr_AllValues'])) {
                                                                        $options .= "<input placeholder='' classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' class='timepicker' type='text' ><input type='button' value='Go' class='go-btn timefilter'>";
                                                                        //                                                                    $options .= "<div class='input-group bootstrap-timepicker'><input placeholder='' classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' class='timepicker' type='text' ><div class='input-group-addon' ><i class='fa fa-clock-o'></i></div></div><input type='button' value='Go' class='go-btn timefilter'>";
                                                                    }
                                                                    ?>
                                                                    <li>
                                                                        <label>{{ $k }}</label>
                                                                        <ul>
                                                                            <li>
                                                                                <?php echo $options; ?>
                                                                            </li>                                                   
                                                                        </ul>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </form>

                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div id="list-view" class="listing-block">
                                        <div class="top-section">
                                            <div class="top-titile">
                                                <div class="title">
                                                    <h1 class="top-titile categoryheading"><?php
                                                        if (!empty($cat_id)) {
                                                            echo $result[0]['catname'];
                                                        } else {
                                                            echo "All Categories";
                                                        }
                                                        ?></h1>
                                                </div>
                                                <?php
                                                //&& !empty($lat) && !empty($lng)
                                                if (!empty($cat_id) && !empty($itemname)) {
                                                    ?>
                                                    <span class="savesearch-link"><a href="javascript:void(0)" class="svd-srch-btn">Save this Search</a></span>
                                                <?php } ?>
                                            </div>
                                            <!-- Premium Ads 22-->       
                                            <?php //dd($cond_premium_result) ?>    
                                            @if(isset($cond_premium_result) && count($cond_premium_result) != '0')

                                            <div class="ad-panel"><div class="owl-carousel owl-theme">
                                                    @foreach($cond_premium_result as $key => $val) 

                                                    <?php
                                                    $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val['title']);

                                                    $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val['classified_id'];
                                                    ?>

                                                    <div class="item"><div class="ad-block"> <img src="{!! asset('/upload_images/classified/'.$val['classified_id'].'/'.$val['name']) !!}" alt=""><?php /* ?><img src="{{ URL::asset('plugins/front/img/ad-banner.jpg') }}" /><?php */ ?>
                                                            <div class="ad-block-info">
                                                                <div class="ad-block-row"><span class="ad-block-span ad-block-span1"><img src="{{ URL::asset('plugins/front/img/icon-1.png') }}" /><span>
                                                                            @if($val['price'] > 0) {{ "$".$val['price']}} @endif</span></span></div>
                                                                <div class="ad-block-row"><span class="ad-block-span ad-block-span2">{{str_limit($val['title'],20)}}</span></div>
                                                                <a class="pinkButton" href="{{ $url }}">Find Out More</a> </div>
                                                            <div class="ad-block-star"> <span class="star-label">Premium  Advert</span> <span><i class="fa fa-star" aria-hidden="true"></i> </span> </div>
                                                        </div></div>
                                                    @endforeach

                                                </div></div>
                                            @endif


                                            <div class="top-filter">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <ul class="view-type">
                                                            <li class="grid_view ">
                                                                <a href="javascript:void(0)"></a>
                                                            </li>
                                                            <li class="list_view active ">
                                                                <a href="javascript:void(0)"></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="filters">
                                                            <span class="sortby">Sort by:</span>
                                                            <div class="sorting-options">
                                                                <!-- <select id="select-options-1">
                                                                    <option>By Date</option>
                                                                    <option>My Neighbour</option>
                                                                    <option>Court</option>
                                                                    <option>Dvara</option>
                                                                    <option>Shoudled</option>
                                                                </select> -->

                                                                <select id="select-options-1" class="sort-classified-listing">
                                                                    <option value="most_recent">Most Recent</option>
                                                                    <option value="title_asc">Name A to Z</option>
                                                                    <option value="title_desc">Name Z to A</option>
                                                                    <option value="price_htl">Price High to Low</option>
                                                                    <option value="price_lth">Price Low to High</option>
                                                                </select>
                                                            </div>
                                                            <span class="decending-img"><img src="{{ URL::asset('plugins/front/img/descending.png') }}" alt=""></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(isset($cond_featured_result) && count($cond_featured_result) != 0 && !$isParent)
                                        <!-- Add Featured listing-->
                                        <div class="car-search-listing search-result-list search-listing list-view">
                                            <div class="clearfix new-view-design">


                                                @foreach($cond_featured_result as $key => $val)
                                                <?php
                                                $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val->title);
                                                if ($val->btc == 1 || $val->sia == 1) {
                                                    $url = Request::root() . '/classified-detail/' . $encodetitle . '/' . $val->classified_id;
                                                } else {
                                                    $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val->classified_id;
                                                }
                                                ?>
                                                <div class="list-row">
                                                    <div class="clearfix">
                                                        <div class="col-md-3 col-sm-6 col-xs-6"> <a href="{{ $url }}" class="clearfix">
                                                                <div class="list-img"><div class="ad-block-star"> <span class="star-label">Featured Advert</span> <span><i class="fa fa-star" aria-hidden="true"></i> </span> </div>



                                                                    <?php /* <img src="{!! asset('/plugins/front/img/listing-img.jpg') !!}"> */ ?>
                                                                    <img src="{!! asset('/upload_images/classified/'.$val->classified_id.'/'.$val->name) !!}" alt="">
                                                                    <span class="tab-badge" title="{!! Helper::time_since(time() - strtotime($val->classified_created)).' ago' !!}">{!! Helper::time_since_for_classified(time() - strtotime($val->classified_created)) !!}</span> </div>
                                                            </a> </div>
                                                        <div class="list-rowContent"> <div class="wishlist-wrap"> @if(in_array($val->classified_id, $wishlistItems)) <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $val->classified_id }}">
                                                                <div class="heart"><i class="fa fa-heart"></i> <!--<img src="{{ URL::asset('plugins/front/img/icon-2.png') }}" />--></div>
                                                                </a> @else <a href="javascript:void(0)" class="wishlist-icon" data-id="{{ $val->classified_id }}">
                                                                    <div class="heart"> 
                                                                      <i class="fa fa-heart"></i> <!--<img src="{{ URL::asset('plugins/front/img/icon-2.png') }}" />--> </div>
                                                                </a> @endif</div> <div class="col-md-6 col-sm-6 col-xs-6 list-dataWrap"> <a href="{{ $url }}" class="clearfix">
                                                                    <div class="list-data">

                                                                        <span class="price">
                                                                            @if($val->price > 0) {{ "$".$val->price}} @endif
                                                                        </span>
                                                                        <h3>{{str_limit($val->title,20)}}</h3>
                                                                        <p>
                                                                            {{strip_tags(str_limit($val->description, 100))}}
                                                                        </p>

                                                                    </div>
                                                                </a> </div>
                                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                                <div class="list-right">

                                                                    <div class="location">
                                                                        @if(!empty($val->location))
                                                                        <?php $expSimLoc = explode(',', trim($val->location)); ?>
                                                                        <span class="classfd-location">{{ $val->city }}</span>
                                                                        @endif

                                                                        <span class="classfd-timeago">{!! Helper::time_since(time() - strtotime($val->classified_created)) !!} ago</span>
                                                                    </div>
                                                                </div>
                                                            </div></div>
                                                    </div>
                                                </div>

                                                @endforeach


                                            </div>
                                        </div>
                                        @endif
                                        <!-- style in class-fied grid.scss -->
                                        <!--<div class="search-listing search-result-list list-view">-->
                                        <div class="car-search-listing searchlistdata search-result-list search-listing list-view">
                                            <div class="clearfix new-view-design">
                                                <?php //echo count($result); ?>
                                                @if(count($result) != 0)
                                                @foreach($result as $key => $val)
                                                <?php
                                                $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $val->title);
                                                if ($val->btc == 1 || $val->sia == 1) {
                                                    $url = Request::root() . '/classified-detail/' . $encodetitle . '/' . $val->classified_id;
                                                } else {
                                                    $url = Request::root() . '/classifieds/' . $encodetitle . '/' . $val->classified_id;
                                                }
                                                ?>
                                                <div class="list-row">
                                                    <div class="clearfix">
                                                        <div class="col-md-3 col-sm-6 col-xs-6"> <a href="{{ $url }}" class="clearfix">
                                                                <div class="list-img">



                                                                    <?php /* <img src="{!! asset('/plugins/front/img/listing-img.jpg') !!}"> */ ?>
                                                                    <img src="{!! asset('/upload_images/classified/'.$val->classified_id.'/'.$val->name) !!}" alt="">
                                                                    <span class="tab-badge" title="{!! Helper::time_since(time() - strtotime($val->classified_created)).' ago' !!}">{!! Helper::time_since_for_classified(time() - strtotime($val->classified_created)) !!}</span> </div>
                                                            </a> </div>
                                                        <div class="list-rowContent"> <div class="wishlist-wrap"> @if(in_array($val->classified_id, $wishlistItems)) <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $val->classified_id }}">
                                                                <div class="heart"><i class="fa fa-heart"></i> <!--<img src="{{ URL::asset('plugins/front/img/icon-2.png') }}" />--></div>
                                                                </a> @else <a href="javascript:void(0)" class="wishlist-icon" data-id="{{ $val->classified_id }}">
                                                                    <div class="heart"> 
                                                                      <i class="fa fa-heart"></i> <!--<img src="{{ URL::asset('plugins/front/img/icon-2.png') }}" /> --></div>
                                                                </a> @endif</div> <div class="col-md-6 col-sm-6 col-xs-6 list-dataWrap"> <a href="{{ $url }}" class="clearfix">
                                                                    <div class="list-data">

                                                                        <span class="price">
                                                                            @if($val->price > 0) {{ "$".$val->price}} @endif
                                                                        </span>
                                                                        <h3>{{str_limit($val->title,20)}}</h3>
                                                                        <p>
                                                                            {{strip_tags(str_limit($val->description, 100))}}
                                                                        </p>

                                                                    </div>
                                                                </a> </div>
                                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                                <div class="list-right">

                                                                    <div class="location">
                                                                        @if(!empty($val->location))
                                                                        <?php $expSimLoc = explode(',', trim($val->location)); ?>
                                                                        <span class="classfd-location">{{ $val->city }}</span>
                                                                        @endif

                                                                        <span class="classfd-timeago">{!! Helper::time_since(time() - strtotime($val->classified_created)) !!} ago</span>
                                                                    </div>
                                                                </div>
                                                            </div></div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <div>No Record Found.</div>
                                                @endif
                                            </div>

                                            <div class="pagination-wrapper">
                                                <div class="pagination-wrapper-inner searchlist">
                                                    {!!$result->render()!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <!-- style in sidebar.scss file -->
                        @include('front/element/home_sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- categories section -->
    @if(sizeof($bottom_positions_ads) > 0)
    <section>
        <div id="feature-category">
            <div class="container">
                <div class="adv-banner">
                    @foreach($bottom_positions_ads as $bottom_ad_key => $bottom_single_ad)
                    <a href="{!! Helper::show_url($bottom_single_ad->image_url) !!}" target="_blank">
                        <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$bottom_single_ad->image) !!}" alt="banner-img">
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @elseif(!empty($default_bottom_position_ad))
    <section>
        <div id="feature-category">
            <div class="container">
                <div class="adv-banner">
                    <a href="{!! Helper::show_url($default_bottom_position_ad->image_url) !!}" target="_blank">
                        <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_bottom_position_ad->image) !!}" alt="banner-img">
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

</div>
@stop




@section('scripts')

<!-- save search popup -->
<div class="modal fade" tabindex="-1" role="dialog" id="SaveSearchModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content savesearchMdoalCont">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{ URL:: asset('/plugins/front/img/icons/close-btn.png') }}" alt="close-buton">
            </button>
            <div class="modal-body">
                <div class="savesearchData">
                    @if(!(Auth::guard('web')->user()))
                    <h4>Please login for perform this action</h4>
                    <a href="javascript:void(0)" class="sgn-in-btn-svd-srch">Click here for login</a>
                    @else
                    <h3>Saved Search Name</h3>

                    {!! Form::open(array("url" => "user/save-search", "role" => "form", 'class' => 'form-horizontal svd-srch-from', 'novalidate')) !!}

                    <?php $svdSrchUsrLoc = explode(',', trim($city)); ?>
                    <input type="text" name="name" value="Car in Melbourne" class="form-control svd-srch-frm-nm-fld">
                    <!-- <div class="savedvalue">
                        Car in Melbourne
                    </div> -->
                    <h4>Email these Search result: </h4>
                    <ul class="EmailTime">
                        <li>
                            {{ Form::radio('email_frequency', 1, true) }}
                            <label for="Amount">Immediately</label>
                        </li>
                        <li>
                            {{ Form::radio('email_frequency', 2, true) }}
                            <label for="Negotiable">Daily</label>
                        </li>
                        <li>
                            {{ Form::radio('email_frequency', 3, true) }}
                            <label for="Free">Weekely</label>
                        </li>
                        <li>
                            {{ Form::radio('email_frequency', 4, true) }}
                            <label for="Never">Never</label>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <button type="submit" class="btn orangebtn">Save This Search</button>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <button type="button" name="button" class="btn graybtn cancel-save-search">Cancel</button>
                        </div>
                    </div>

                    <input type="hidden" name="keyword" value="{{ $itemname }}">
                    <input type="hidden" name="city" value="{{ $city }}">
                    <input type="hidden" name="lat" value="{{ empty($lat)? '25.2744':$lat}}">
                    <input type="hidden" name="lng" value="{{ empty($lng)?'133.7751':$lng }}">
                    <input type="hidden" name="usr_state" value="{{ $state }}">
                    <input type="hidden" name="usr_city" value="{{ isset($svdSrchUsrLoc[0]) ? $svdSrchUsrLoc[0] : $city  }}">
                    <input type="hidden" name="usr_pcode" value="">
                    <input type="hidden" name="distance" value="{{ $km }}">
                    <input type="hidden" name="category_id" value="{{ $cat_id }}">
                    <input type="hidden" name="defaultlocation" value="{{ empty($lat) && empty($lng)? 1:0 }}">

                    {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- save search popup -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU?sensor=false"></script>
<script type="text/javascript">
setTimeout(
        function ()
        {
        $('.load').addClass('hide');
        $('.search-form').removeClass('hide');
        }, 2000);
$(function () {
getallclassified()
        $(".filtercategory.active").parent().parent().parent().siblings().hide();
$('.addcat').click();
setTimeout(function () {

$(".cust-info i.fa-minus").trigger('click');
}, 10);
//sub cat click
// if ($(".addsub").length > 0) {
//     $(".addsub").parents().closest("li").trigger("click").removeClass("active");
//     $(".addsub").addClass("active");
//     $('.category').trigger('click');
// }
if ($(".addsub").length > 0) {
$(".addsub").show();
$(".addsub").siblings().show();
//$(".addsub").parent().siblings('i').hasClass( "fa-plus" ).toggleClass("fa-minus")
}
if ($(".addstate").length > 0) {
$('.place').click();
}
if ($(".addcity").length > 0) {
$(".addcity").parents().closest("li").trigger("click").removeClass("active");
$(".addcity").addClass("active");
$('.place').trigger('click');
}

$('.category').trigger('click');
<?php if ($cat_id == '') { ?>
    //$('#tree2').treed({openedClass: 'fa fa-caret-down', closedClass: 'fa fa-caret-right'});  
    $('#tree2').treed({openedClass: 'fa fa-minus', closedClass: 'fa fa-plus'});
<?php } ?>
var selectVal = $(".custom-selectbox .selected");
//    var dataVal = $(".select-options li[data-id= '<?php echo $cat_id ?>'] a").html();
var dataVal = $(".header-search-category li[data-id= '<?php echo $cat_id ?>'] a img").attr('src');
var dataText = $(".header-search-category li[data-id= '<?php echo $cat_id ?>'] a").text();
console.log(dataVal);
//selectVal.html(dataVal);
selectVal.find('img').attr('src', dataVal);
selectVal.find('.selected-text').text(dataText);
//$('#amount').attr( 'datamin','1000');   
selectDropText();
toggleTopBarSelectBox();
});
$.fn.extend({
treed: function (o) {

var openedClass = 'fa-minus';
var closedClass = 'fa-plus';
if (typeof o != 'undefined') {
if (typeof o.openedClass != 'undefined') {
openedClass = o.openedClass;
}
if (typeof o.closedClass != 'undefined') {
closedClass = o.closedClass;
}
}
;
//initialize each of the top levels
var tree = $(this);
tree.addClass("tree");
tree.find('li').has("ul").each(function () {
var branch = $(this); //li with children ul
branch.prepend("<i class='indicator fa " + closedClass + "'></i>");
branch.addClass('branch');
branch.on('click', function (e) {
if (this == e.target) {
var icon = $(this).children('i:first');
icon.toggleClass(openedClass + " " + closedClass);
$(this).children().children().toggle();
}
})
        branch.children().children().toggle();
});
//fire event from the dynamically added icon
tree.find('.branch .indicator').each(function () {
$(this).on('click', function () {
$(this).closest('li').click();
});
});
//fire event to open branch if the li contains an anchor instead of text
tree.find('.branch>a').each(function () {
$(this).on('click', function (e) {
$(this).closest('li').click();
e.preventDefault();
});
});
//fire event to open branch if the li contains a button instead of text
tree.find('.branch>button').each(function () {
$(this).on('click', function (e) {
$(this).closest('li').click();
e.preventDefault();
});
});
}
});
//Initialization of treeviews

//$('#tree1').treed({openedClass: 'fa fa-caret-down', closedClass: 'fa fa-caret-right'});
$('#tree1').treed({openedClass: 'fa-minus', closedClass: 'fa-plus'});
$('#tree2').treed({openedClass: 'fa-minus', closedClass: 'fa-plus'});
function getallclassified(){
$.ajax({
url: root_url + '/get_all_classifieds',
        data: {
        "_token": $('meta[name="csrf-token"]').attr('content'),
        },
        //dataType: "html",
        method: "POST",
        cache: true,
        success: function (projects) {


        var projects = JSON.parse(projects);
        console.log(typeof projects);
        $("#project").autocomplete({
        minLength: 0,
                source: projects,
                focus: function (event, ui) {
                $("#project").val(ui.item.label);
                return false;
                },
                select: function (event, ui) {
                $("#project").val(ui.item.label);
                $("#project-id").val(ui.item.label);
                $("#project-description").html(ui.item.catname);
                var selectVal = $(".custom-selectbox .selected");
                var dataVal = $(".select-options li[data-id= " + ui.item.catid + "] a").html();
                selectVal.html(dataVal);
                $("#cat_id").val(ui.item.catid);
                //$("#project-icon").attr("src", "images/" + ui.item.icon);

                return false;
                }
        })
                .autocomplete("instance")._renderItem = function (ul, item) {
        if (item.sub_name == null)
        {
        item.sub_name = '';
        } else {
        item.sub_name = ', ' + item.sub_name;
        }
        return $("<li>")
                .append("<div><label>" + item.label + "</label><br><span class='values'>" + 'in ' + item.catname + item.sub_name + "</span></div>")
                .appendTo(ul);
        };
        }
});
}

$(document).ready(function () {
$('.cust-info i.fa-miuns').trigger("click");
// var locations = [];
// var msqData = <?php //echo json_encode($near_mosques)     ?>;
// $.each(msqData, function (key, value) {
//     locations[key] = [value.title, value.lat, value.lng, key + 1
//     ];
// });
// var usr_city_in_svd_srch_bx = usr_state_in_svd_srch_bx = null;
// var autocomplete = new google.maps.places.Autocomplete($(".locationfield")[0], {componentRestrictions: {country: "au"}});
// google.maps.event.addListener(autocomplete, 'place_changed', function () {
//     var place = autocomplete.getPlace();
//     var place = autocomplete.getPlace();
//     console.log(place);

//     $(".usr-state, .usr-city, .usr-pcode").val('');

//     for (var i = 0; i < place.address_components.length; i++) {
//         var addressType = place.address_components[i].types[0];
//         if (addressType == 'administrative_area_level_1') {
//             var state = place.address_components[i]['long_name'];
//             $('.usr-state').val(state);
//         }
//         if (addressType == 'locality') {
//             var city = place.address_components[i]['long_name'];
//             $('.usr-city').val(city);
//         }
//         if (addressType == 'postal_code') {
//             var gPostalCode = place.address_components[i]['short_name'];
//             $('.usr-pcode').val(gPostalCode);
//         }
//     }
// });
/*  var map = new google.maps.Map(document.getElementById('msq-near-map'), {
 zoom: 5,
 center: new google.maps.LatLng(<?php //echo $latitude;         ?>, <?php //echo $longitude;         ?>),
 mapTypeId: google.maps.MapTypeId.ROADMAP
 });
 var infowindow = new google.maps.InfoWindow();
 var marker, i;
 for (i = 0; i < locations.length; i++) {
 marker = new google.maps.Marker({
 position: new google.maps.LatLng(locations[i][1], locations[i][2]),
 map: map
 });
 
 google.maps.event.addListener(marker, 'click', (function (marker, i) {
 return function () {
 infowindow.setContent(locations[i][0]);
 infowindow.open(map, marker);
 }
 })(marker, i));
 }*/
$('.filter-togle > h3').siblings().css('display', 'none');
$('.filter-togle > ul > li:has( > ul)').addClass('inner-Catogory');
$('.filter-togle > h3').siblings().css('display', 'none');
$('.filter-togle > h3').click(function () {
$(this).siblings().slideToggle();
$(this).toggleClass("toggled");
});
$('.inner-Catogory > a').next().css('display', 'none');
$('.inner-Catogory > a').click(function () {
$(this).next().slideToggle();
$(this).toggleClass("toggled");
});
//$('.filter-togle > h3').click();




$(".savesearch-link a").click(function () {
$('#SaveSearchModal').modal('show');
});
$(".cancel-save-search").click(function (e) {
$('#SaveSearchModal').modal('hide');
})

        $("a.sgn-in-btn-svd-srch").click(function () {
$('#SaveSearchModal').modal('hide');
$('#login-modal').modal('show');
});
$(document).on("click", ".svd-srch-btn", function () {
var gtSrchKywrd = $(".srchd-clssfd-kywrd").val();
console.log(gtSrchKywrd)
        if (gtSrchKywrd != "") {
$(".svd-srch-frm-nm-fld").val(gtSrchKywrd + "<?php echo (isset($svdSrchUsrLoc[0]) && !empty($svdSrchUsrLoc[0])) ? ' in ' . $svdSrchUsrLoc[0] : null; ?>")
        }
})

        $(".svd-srch-from").submit(function (ev) {
ev.preventDefault()
        if (!$(".svd-srch-frm-nm-fld").val()) {
Notify.showNotification('Please provide a name for your search', 'error');
} else {
$.ajax({
url: $(this).attr("action"),
        data: $(this).serialize(),
        method: "POST",
        cache: false,
        success: function (response) {
        if (response.status) {
        $('#SaveSearchModal').modal('hide');
        Notify.showNotification(response.message, 'success');
        } else {
        Notify.showNotification(response.message, 'error');
        }
        }
});
}
return false;
});
<?php if (!empty($cat_id)) { ?>
    console.log($("[dataSelectionId=<?php echo $cat_id ?>]").text());
    $("#selectval").text($("[dataSelectionId=<?php echo $cat_id ?>]").text())
<?php } ?>




//sidebar prayer timing script startsssssssssssssssssssssssssssssssssssssssssssssssssssssssssss
var latitute1 = 0;
var longitude1 = 0;
getLocation();
get_today_prayer_timing(0, 0)
        get_classified_map( - 37.813628, 144.963058)

        function getLocation() {
        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, err);
        } else {
        //console.log("Geolocation is not supported by this browser.");
        }
        }
function err(position) {
get_today_prayer_timing(0, 0)
        get_classified_map( - 37.813628, 144.963058)
        latitute1 = 0;
longitude1 = 0;
}
function showPosition(position) {
var geocoder;
geocoder = new google.maps.Geocoder();
latitute1 = position.coords.latitude;
longitude1 = position.coords.longitude;
var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
$('.trending_classi').html('');
$('.recent_classi').html('');
geocoder.geocode(
        {'latLng': latlng},
        function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
        get_today_prayer_timing(position.coords.latitude, position.coords.longitude)
                get_classified_map(position.coords.latitude, position.coords.longitude)
        } else {
        console.log("address not found");
        }
        } else {
        console.log("Geocoder failed due to: " + status);
        }
        }
);
}
function get_today_prayer_timing(lat, lng) {
var cur_city = "";
var current_date = new Date();
var timezone = - (current_date.getTimezoneOffset())

        var c_timeStamp = new Date();
var c_date = c_timeStamp.getDate();
var c_month = c_timeStamp.getMonth();
var c_year = c_timeStamp.getFullYear();
var c_hour = c_timeStamp.getHours();
var c_minute = c_timeStamp.getMinutes();
var final_string = c_year + "-" + (c_month + 1) + "-" + c_date + " " + c_hour + ":" + c_minute;
if (lat != 0 && lng != 0) {
var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + lat + '%2C' + lng + '&language=en';
$.getJSON(GEOCODING).done(function(locationn) {

var lcnn = locationn.results[0].address_components

        for (var i = 0; i < lcnn.length; i++) {
var addressType = lcnn[i].types[0];
if (addressType == 'locality') {
cur_city = lcnn[i]['long_name'];
console.log(cur_city)
        }
}

$.ajax({
url: root_url + '/get_p_timing',
        data: {
        "_token": $('meta[name="csrf-token"]').attr('content'),
                "lat": lat,
                "lng": lng,
                "timezone": timezone,
                "cur_city": cur_city,
                "cur_time": final_string
        },
        dataType: "html",
        method: "POST",
        cache: true,
        success: function (response) {
        $(".p_timing_sidebar_blck").html(response);
        var curr_time = new Date();
        var get_curr_hour = curr_time.getHours();
        var get_curr_minute = curr_time.getMinutes();
        var exact_time_diff = '';
        if ($(".isTodayTiming").val() == 1) {
        var fffff = get_curr_hour + ":" + get_curr_minute;
        var diff = (new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60 / 60;
        var get_minute = (new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60;
        var get_hour = parseInt(get_minute / 60);
        var get_remain_min = (get_minute % 60);
        console.log(get_hour + " hour and " + get_remain_min + " minute left")

                if (get_hour == 0) {
        exact_time_diff = get_remain_min + " minute left";
        } else {
        exact_time_diff = get_hour + " hour and " + get_remain_min + " minute left";
        }
        $(".pt_time_left").text(exact_time_diff)

        } else {

        var fffff = get_curr_hour + ":" + get_curr_minute;
        var diff = (new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60 / 60;
        var get_minute = (new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60;
        var get_hour = parseInt(get_minute / 60);
        var get_remain_min = (get_minute % 60);
        console.log(get_hour + " hour and " + get_remain_min + " minute left")

                if (get_hour == 0) {
        exact_time_diff = get_remain_min + " minute left";
        } else {
        exact_time_diff = get_hour + " hour and " + get_remain_min + " minute left";
        }
        $(".pt_time_left").text(exact_time_diff)

        }
        }
})
        })
        } else {
$.ajax({
url: root_url + '/get_p_timing',
        data: {
        "_token": $('meta[name="csrf-token"]').attr('content'),
                "lat": lat,
                "lng": lng,
                "timezone": timezone,
                "cur_city": cur_city,
                "cur_time": final_string
        },
        dataType: "html",
        method: "POST",
        cache: true,
        success: function (response) {
        $(".p_timing_sidebar_blck").html(response);
        var curr_time = new Date();
        var get_curr_hour = curr_time.getHours();
        var get_curr_minute = curr_time.getMinutes();
        var exact_time_diff = '';
        if ($(".isTodayTiming").val() == 1) {
        var fffff = get_curr_hour + ":" + get_curr_minute;
        var diff = (new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60 / 60;
        var get_minute = (new Date("1970-1-1 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60;
        var get_hour = parseInt(get_minute / 60);
        var get_remain_min = (get_minute % 60);
        console.log(get_hour + " hour and " + get_remain_min + " minute left")

                if (get_hour == 0) {
        exact_time_diff = get_remain_min + " minute left";
        } else {
        exact_time_diff = get_hour + " hour and " + get_remain_min + " minute left";
        }
        $(".pt_time_left").text(exact_time_diff)

        } else {

        var fffff = get_curr_hour + ":" + get_curr_minute;
        var diff = (new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60 / 60;
        var get_minute = (new Date("1970-1-2 " + $(".upcmgTime").val()) - new Date("1970-1-1 " + fffff)) / 1000 / 60;
        var get_hour = parseInt(get_minute / 60);
        var get_remain_min = (get_minute % 60);
        console.log(get_hour + " hour and " + get_remain_min + " minute left")

                if (get_hour == 0) {
        exact_time_diff = get_remain_min + " minute left";
        } else {
        exact_time_diff = get_hour + " hour and " + get_remain_min + " minute left";
        }
        $(".pt_time_left").text(exact_time_diff)

        }
        }
})
        }
}
//sidebar prayer timing script endsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss

function get_classified_map(lat, lng) {
$.ajax({
url: root_url + '/get_c_map',
        data: {
        "_token": $('meta[name="csrf-token"]').attr('content'),
                "lat": lat,
                "lng": lng,
        },
        dataType: "json",
        method: "POST",
        cache: true,
        success: function (response) {
        // console.log(response)

        var locations = [];
        // var msqData = <?php //echo json_encode($near_mosques)     ?>;
        $.each(response, function (key, value) {
        locations[key] = [value.title, value.lat, value.lng, key + 1
        ];
        });
        var map = new google.maps.Map(document.getElementById('msq-near-map'), {
        zoom: 5,
                center: new google.maps.LatLng(lat, lng),
                mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
        });
        google.maps.event.addListener(marker, 'click', (function (marker, i) {
        return function () {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
        }
        })(marker, i));
        }
        }
})
        }


/*Ad slider*/
$('.ad-panel .owl-carousel').owlCarousel({
<?php if (isset($cond_premium_result) && count($cond_premium_result) > 1) { ?>
    loop:true,
<?php } else { ?>
    loop:false,
<?php } ?>
singleItem:true,
        margin:10,
        nav:false,
        smartSpeed : 1000,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        responsive:{

        0:{
        items:1
        }
        }
})
        /*/Ad slider*/

})
</script>
@stop 
