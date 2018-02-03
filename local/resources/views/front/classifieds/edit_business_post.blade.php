@extends('front/layout/layout')
@section('content')
<style type="text/css">
    .form-row{ margin-bottom: 20px;}
    .submit-btn{ background: #ef4b23 none repeat scroll 0 0;
                 border-radius: 4px !important;
                 color: #ffffff;
                 cursor: pointer;
                 display: inline-block;border:none;box-shadow:none;

                 padding: 5px 10px;}
    .cancel-btn{background: #f3f3f3 none repeat scroll 0 0;
                border-radius: 4px;
                color: #ef4b23;
                cursor: pointer;
                display: inline-block;

                padding: 5px 10px;}
    .edit_formdate{
        width:48%;margin-right:8px;display:inline-block; float:left;

    }
    .edit_todate{
        width:48%;display:inline-block; float:left;
    }
    .edit_time{width: 48%;display:inline-block; margin-right:8px}
    .edit_time1{width: 48%;display:inline-block;}
    .font_edit{font-size:10px;margin-top:7px;}
</style>
<div id="middle" class="no-banner">
    <!-- breadcrumb section -->
    <section>
        <div id="breadcrumb-banner">
            <div class="container">  
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>              
                    <li class="active">Post an Ad</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- categories section -->
    <section class="dashboard-content">
        <div id="login-inner-section dashboardData">
            <div class="container">
                <div id="classified-post" class="classified-post">
                    <div class="title">
                        <h3> Edit Classified</h3>
                        <?php 
                        if (Auth::guard('web')->user()->seller_type == 'business') { ?>
                            <input type="hidden" value="{{ $memPlanUser[0]['number_image_upload'] }}" class="max_upload_img">
                        <?php } else { ?>
                            <input type="hidden" value="{{ $result->classified_ho_package_user->number_image_upload }}" class="max_upload_img">
                        <?php } ?>
                    </div>


                    <div id="rootwizard" >
                        {!! Form::model($result, array('action' => ["front\ClassifiedController@update_business_post", $result->id], 'files' => true, 'id'=>'submitFrmUpdate')) !!}

                        <div class="tab-content" >

                            <div class="tab-pane1" id="tab3">
                                <div class="classified-form">

                                    <input type="hidden" value="{{ $result->id }}" name="id">
<!--                                    <input type="hidden" name="parent_categoryid" class="parent_categoryid" >
                                    <input type="hidden" name="category_id" class="category_id" >-->
                                    <div class="form-row row">
                                        <div class="col-sm-4">
                                            <label>Classified Title <span class="require">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="value-field step3row">
                                                {!! Form::input('text', 'title', (isset($result->title))?$result->title:null, ['id' => 'title', 'iderr'=>'title-text', 'class' => 'textRequired title form-control','placeholder'=>'Title Name']) !!}
                                                <p class="ad-error" id="title-text_error"></p>
                                                                        <!--<span class="hint">100 characters left </span>-->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row">
                                        <div class="col-sm-4">
                                            <label>Selected Category/Subcategory</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="value-field select-category">
                                                <input type="hidden" value="{{$result->parent_categoryid}}" id="" name="parent_categoryid" />
                                                <input type="hidden" value="{{$result->category_id}}" id="" name="category_id" />
                                                <span class="pCatName"><?php echo $result1['categoriesname']['name']; ?></span> / <span class="cCatName"><?php echo $result1['subcategoriesname']['name']; ?></span>     
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (Auth::guard('web')->user()->seller_type == 'business') { ?>
                                        <div class="form-row row" iderr="classified_type">
                                            <div class="col-sm-4">
                                                <label>Type Of Classified</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <input id="classified_type_normal" label_name="classified_type" name="classified_type" class="inputCheckBox" type="radio" is_required="1" value="normal">
                                                <label for="classified_type_normal">Normal</label>

                                                @if($memPlanUser[0]['is_premium_parent_cat'] == 1 || $memPlanUser[0]['is_premium_sub_cat'] == 1)
                                                <input {{($result['is_premium_parent_cat'] == 1 || $result['is_premium_sub_cat'] == 1)?'checked="checked"':''}} id="classified_type_premium" label_name="classified_type" name="classified_type" class="inputCheckBox" type="radio" is_required="1" value="premium">
                                                <label for="classified_type_premium">Premium</label>
                                                @endif

                                                @if($memPlanUser[0]['is_featured_ads'] == 1)
                                                <input {{($result['featured_classified'] == 1)?'checked="checked"':''}} id="classified_type_featured" label_name="classified_type" name="classified_type" class="inputCheckBox" type="radio" is_required="1" value="featured">
                                                <label for="classified_type_featured">Featured</label>
                                                @endif
                                            </div>

                                            <p class="ad-error" id="classified_type_error"></p>
                                            <span class="form-tag-line"></span>
                                        </div>
                                    <?php } ?>

                                    <!--########## Is iNSPECTION DATE -->
                                    <?php if (isset($template_arr) && $template_arr->is_inspection_date == 1) { ?>

                                        <?php
//                                        dd($result['classified_hasmany_other']->toArray());
                                        $saved_inspection_date = [];
                                        $saved_inspection_date_id[0] = '';
                                        $saved_inspection_date_id[1] = '';
                                        $saved_inspection_date_id[2] = '';
                                        if (isset($result['classified_hasmany_other']) && !empty($result['classified_hasmany_other'])) {

                                            foreach ($result['classified_hasmany_other'] as $key => $value) {
                                                if ($value['other_slug'] == 'is_inspection_date') {

                                                    $saved_inspection_date[] = $value['other_value'];
                                                    $saved_inspection_date_id[$key] = $value['id'];
                                                }
                                            }
                                        }
//                                        dd($saved_inspection_date[0]);
                                        ?>
                                        <div class="form-row row">
                                            <div class="col-sm-4">
                                                <label>Inspections Dates(Select 1 or more inspection dates)</label>
                                            </div>

                                            <div class="col-sm-8">
                                                <div class="value-field">
                                                    <input value="is_inspection_date" type="hidden" name="edit_other_value[is_inspection_date][1][title]" >
                                                    <input value="<?php echo $saved_inspection_date_id[0]; ?>" type="hidden" name="edit_other_value[is_inspection_date][1][id]" >
                                                    <input value="<?php echo (isset($saved_inspection_date[0]) ? $saved_inspection_date[0] : ''); ?>" class="form-control datepicker" type="text" name="edit_other_value[is_inspection_date][1][desc]" placeholder="Inspections Dates">
                                                    <p class="ad-error" id=""></p>
                                                </div>
                                                <br>
                                                <div class="value-field">
                                                    <input value="is_inspection_date" type="hidden" name="edit_other_value[is_inspection_date][2][title]" >
                                                    <input value="<?php echo $saved_inspection_date_id[1]; ?>" type="hidden" name="edit_other_value[is_inspection_date][2][id]" >
                                                    <input value="<?php echo (isset($saved_inspection_date[1]) ? $saved_inspection_date[1] : ''); ?>" class="form-control datepicker" type="text" name="edit_other_value[is_inspection_date][2][desc]" placeholder="Inspections Dates">
                                                    <p class="ad-error" id=""></p>
                                                </div>
                                                <br>
                                                <div class="value-field">
                                                    <input value="is_inspection_date" type="hidden" name="edit_other_value[is_inspection_date][3][title]" >
                                                    <input value="<?php echo $saved_inspection_date_id[2]; ?>" type="hidden" name="edit_other_value[is_inspection_date][3][id]" >
                                                    <input value="<?php echo (isset($saved_inspection_date[2]) ? $saved_inspection_date[2] : ''); ?>" class="form-control datepicker" type="text" name="edit_other_value[is_inspection_date][3][desc]" placeholder="Inspections Dates">
                                                    <p class="ad-error" id=""></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($result->subcategoriesname->is_sellable == 1) { ?>


                                        <div class="form-row row">
                                            <div class="col-sm-4">
                                                <label>Price</label>
                                            </div>

                                            <div class="col-sm-8">

                                                <input is_required="1" iderr="price" value="{{$result['price']}}" class="form-control textRequired price" type="number" name="price" placeholder="Price">
                                                <p class="ad-error" id="price_error"></p>
                                                <!--<span class="ad-form-price">AUD</span>-->
                                            </div>
                                        </div>

                                        <div class="form-row row" iderr="">
                                            <div class="col-sm-4">
                                                <label></label>
                                            </div>
                                            <div class="col-sm-8">

                                                <input {{($result['price_type'] == 'amount')?'checked="checked"':''}} id="" label_name="amount" name="price_type" class="" type="radio" is_required="0" value="amount">
                                                <label for="amount">Amount</label>

                                                <input {{($result['price_type'] == 'negotiable')?'checked="checked"':''}} id="" label_name="negotiable" name="price_type" class="" type="radio" is_required="0" value="negotiable">
                                                <label for="negotiable">Negotiable</label>

                                            </div>

                                            <p class="ad-error" id=""></p>
                                        </div>

                                        <div class="form-row row">
                                            <div class="col-sm-4">
                                                <label>Quantity</label>
                                            </div>

                                            <div class="col-sm-8">

                                                <input value="{{$result['quantity']}}" is_required="1" iderr="quantity" class="form-control textRequired quantity" type="number" name="quantity" placeholder="Quantity">
                                                <p class="ad-error" id="quantity_error"></p>
                                                <!--<span class="ad-form-price">AUD</span>-->
                                            </div>
                                        </div>
                                        <div class="form-row row">
                                            <div class="col-sm-4">
                                                <label>Minimum offer amount?</label>
                                            </div>

                                            <div class="col-sm-8">

                                                <input {{($result['min_offer_check'] == 1)?'checked="checked"':''}} is_required="0" iderr="" class="min_price_check" type="checkbox" name="min_offer_check" >
                                                <!--<p class="ad-error" id="quantity_error"></p>-->
                                                <!--<span class="ad-form-price">AUD</span>-->
                                            </div>
                                        </div>
                                        <div class="form-row row min_price_li" <?php echo ($result['min_offer_check'] == 1) ? 'style="display:block"' : 'style="display:none"' ?>>
                                            <div class="col-sm-4">
                                                <label>Set Minimum Price</label>
                                            </div>

                                            <div class="col-sm-8">

                                                <input value="{{($result['minimum_price'] != 0)?$result['minimum_price']:''}}" is_required="0" iderr="minimum_price" class="form-control textRequired" type="number" name="minimum_price" >
                                                <!--<p class="ad-error" id="quantity_error"></p>-->
                                                <!--<span class="ad-form-price">AUD</span>-->
                                            </div>
                                        </div>

                                        <div class="form-row row" iderr="">
                                            <div class="col-sm-4">
                                                <label>Condition</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <input {{($result['condition'] == 'used')?'checked="checked"':''}} id="" label_name="used" name="condition" class="" type="radio" is_required="0" value="used">
                                                <label for="used">Used</label>

                                                <input {{($result['condition'] == 'new')?'checked="checked"':''}} id="" label_name="new" name="condition" class="" type="radio" is_required="0" value="new">
                                                <label for="new">New</label>

                                            </div>

                                            <p class="ad-error" id=""></p>
                                        </div>

                                        <div class="form-row row">
                                            <div class="col-sm-4">
                                                <label><img src="{{ URL::asset("/plugins/front/img/pp.png")}}" alt='Paypal'></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input {{($result['pay_pal'] == 1)?'checked="checked"':''}} is_required="0" iderr="" class="paypal_check" type="checkbox" name="pay_pal" >
                                            </div>
                                        </div>

                                        <div class="form-row row">
                                            <div class="col-sm-4 --pickup-check">
                                                <label>PICK UP N’ PAY</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input {{($result['pic_n_pay'] == 1)?'checked="checked"':''}} is_required="0" iderr="" class="pic_n_pay_check" type="checkbox" name="pic_n_pay" >
                                            </div>
                                        </div>

                                        <div class="form-row row pic_n_pay_div" <?php echo ($result['pic_n_pay'] == 1) ? 'style="display:block"' : 'style="display:none"' ?>>
                                            <div class="col-sm-4">
                                                <label></label>
                                            </div>

                                            <div class="col-sm-8">

                                                <input value="{{$result['pick_address']}}" is_required="0" iderr="" class="form-control textRequired" type="text" name="pick_address" placeholder="Street No. & Street Name" > <br>
                                                <input value="{{$result['pick_city']}}" is_required="0" iderr="" class="form-control textRequired" type="text" name="pick_city" placeholder="City" > <br>
                                                <input value="{{$result['pick_state']}}" is_required="0" iderr="" class="form-control textRequired" type="text" name="pick_state" placeholder="State" > <br>
                                                <input value="{{$result['pick_zip']}}" is_required="0" iderr="" class="form-control textRequired" type="text" name="pick_zip" placeholder="ZIP Code" > <br>
                                            </div>
                                        </div>
                                        <div class="form-row row">
                                            <div class="col-sm-4">
                                                <label>Shipping</label>
                                            </div>

                                            <div class="col-sm-8">

                                                <input {{($result['shipping'] == 0)?'checked="checked"':''}} class="shipping_check" id="free" name="shipping" value="0" checked="checked" type="radio">
                                                <label for="free">Free</label>

                                                <input {{($result['shipping'] == 1)?'checked="checked"':''}} class="shipping_check" id="ship_value" name="shipping" type="radio" is_required="0" value="1">
                                                <label for="ship_value">Enter Shipping Amount</label>

                                                <div class="shipping_amount_div" <?php echo ($result['shipping'] == 1) ? 'style="display:block"' : 'style="display:none"' ?>>
                                                    <br>

                                                    <input value="{{$result['ship_name_1']}}" is_required="0" iderr="" class="form-control textRequired edit_formdate" type="text" name="ship_name_1" placeholder="Shipping Name" > 
                                                    <input value="{{($result['ship_amount_1'] == 0)?'':$result['ship_amount_1']}}" is_required="0" iderr="" class="form-control textRequired edit_formdate" type="text" name="ship_amount_1" placeholder="Price" > <br> <br>

                                                    <input value="{{$result['ship_name_2']}}" is_required="0" iderr="" class="form-control textRequired edit_formdate" type="text" name="ship_name_2" placeholder="Shipping Name" > 
                                                    <input value="{{($result['ship_amount_2'] == 0)?'':$result['ship_amount_2']}}" is_required="0" iderr="" class="form-control textRequired edit_formdate" type="text" name="ship_amount_2" placeholder="Price" > <br> <br>

                                                    <input value="{{$result['ship_name_3']}}" is_required="0" iderr="" class="form-control textRequired edit_formdate" type="text" name="ship_name_3" placeholder="Shipping Name" > 
                                                    <input value="{{($result['ship_amount_3'] == 0)?'':$result['ship_amount_3']}}" is_required="0" iderr="" class="form-control textRequired edit_formdate" type="text" name="ship_amount_3" placeholder="Price" > <br> <br>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>

                                    <div class="" id="attrName">

                                        <?php
                                        $storAttrIds = [];
                                        // dd($result1['classified_attribute']);
                                        ?>
                                        @foreach ($result1['classified_attribute'] as $val)
                                        @if(in_array($val['attr_type_name'],['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric']))
                                        <?php
                                        $childValueDiv = '';
                                        if ($val['attr_type_name'] == "Drop-Down" && $val['parent_value_id'] != 0) {
                                            $childValueDiv = "childValueDiv_{$val['parent_attribute_id']}";
                                        }
                                        ?>
                                        <div class="form-row row {!!$childValueDiv!!}">
                                            <div class="col-sm-4">
                                                <label>{{ $val['display_name'] }}</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="value-field">
                                                    <input type="hidden" value="{{ $val['attr_type_name'] }}" name="attr_type_name[]">
                                                    <input type="hidden" value="{{ $val['attr_type_id'] }}" name="attr_type_id[]">
                                                    <input type="hidden" value="{{ $val['attribute_id'] }}" name="attr_ids[]">
                                                    <input type="hidden" value="{{ $val['parent_value_id'] }}" name="parent_value_id[]">
                                                    <input type="hidden" value="{{ $val['parent_attribute_id'] }}" name="parent_attribute_id[]">
                                                    <?php
                                                    $input_type = $val['attr_type_name'];
                                                    $is_required = $val['is_required'];
                                                    if ($input_type == "textarea") {
                                                        ?>
                                                        <textarea class="attr_value textRequired form-control" is_required="{{$is_required}}"   name="attr_value[]">{{ $val['attr_value'] }}</textarea> 
                                                    <?php } else if ($input_type == "Drop-Down" && $val['parent_value_id'] == 0) { ?>

                                                        {!! Form::select('attr_value[]', $val['attr_AllValues'], $val['attr_value'], ['is_required'=>$is_required, 'placeholder' => 'select one', 'class' => 'form-control classForOnChange', 'attributeid' => $val['attribute_id']]) !!}

                                                    <?php } else if ($input_type == "Drop-Down" && $val['parent_value_id'] != 0) { ?>

                                                        {!! Form::select('attr_value[]', $val['attr_AllValues'], $val['attr_value'], ['is_required'=>$is_required,'class' => 'form-control']) !!}
                                                    <?php } else if ($input_type == "text") { ?>

                                                        <input type="text" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-control textRequired" name="attr_value[]">

                                                    <?php } else if ($input_type == "Url") { ?>

                                                        <input type="text" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-control textRequired urlValidation" name="attr_value[]">

                                                    <?php } else if ($input_type == "Number") { ?>

                                                        <input type="number" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-control textRequired" name="attr_value[]">

                                                    <?php } else if ($input_type == "Email") { ?>

                                                        <input type="text" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-control textRequired emailValidation" name="attr_value[]">

                                                        <?php
                                                    } else if ($input_type == "Numeric") {

                                                        if (strpos($val['attr_value'], ';')) {
                                                            ?>
                                                            <input type="text" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-control range_{{ $val['attribute_id'] }}" name="attr_value[]">
                                                        <?php } else { ?>
                                                            <input type="number" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-control textRequired singleNumber" name="attr_value[]">
                                                        <?php } ?>



                                                        <?php
                                                    } else if ($input_type == "calendar") {

                                                        if (strpos($val['attr_value'], ';')) {
                                                            ?>
                                                            <input type="text" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-control range_{{ $val['attribute_id'] }}" name="attr_value[]">
                                                        <?php } else { ?>
                                                            <input type="number" onkeypress="return isNumberKey(event)" is_required="{{$is_required}}" value="{{ $val['attr_value'] }}" class="attr_value form-control  singleNumber singlecalendar" name="attr_value[]">
                                                        <?php } ?>



                                                    <?php } else if ($input_type == "Color") { ?>
                                                        <div class="input-group my-colorpicker2 colorpicker-element" style="width: 100%;">
                                                            <input type="text" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-control textRequired" name="attr_value[]">
                                                            <div class="input-group-addon">
                                                                <i></i>
                                                            </div>
                                                        </div>


                                                        <?php
                                                    } else if ($input_type == "Date") {

                                                        if (strpos($val['attr_value'], ';')) {
                                                            $dateVal = explode(';', $val['attr_value']);
                                                            ?>
                                                            <div class="clearfix">
                                                                <input placeholder="From Date" is_required="{{$is_required}}" value="{{$dateVal[0]}}" attribute_id="{{ $val['attribute_id'] }}" class="datepicker from_date textRequired form-control rangeDate edit_formdate fromDate_{{ $val['attribute_id'] }}" type="text" value="">
                                                                <input placeholder="To Date" is_required="{{$is_required}}" value="{{$dateVal[1]}}" attribute_id="{{ $val['attribute_id'] }}" class="datepicker form-control to_date textRequired edit_todate toDate_{{ $val['attribute_id'] }}" type="text" value="">
                                                                <input type="hidden" value="{{ $val['attr_value'] }}" class="fronAndToDate_{{ $val['attribute_id'] }}" name="attr_value[]">
                                                            </div>
                                                        <?php } else if ($val['attr_value'] == 'on') { ?>

                                                            <div class="clearfix">
                                                                <input placeholder="From Date" is_required="{{$is_required}}" value="" attribute_id="{{ $val['attribute_id'] }}" class="datepicker from_date form-control textRequired rangeDate edit_formdate fromDate_{{ $val['attribute_id'] }}" type="text" value="">
                                                                <input placeholder="To Date" is_required="{{$is_required}}" value="" attribute_id="{{ $val['attribute_id'] }}" class="datepicker to_date  form-control textRequired edit_todate toDate_{{ $val['attribute_id'] }}" type="text" value="">
                                                                <input type="hidden" value="{{ $val['attr_value'] }}" class="fronAndToDate_{{ $val['attribute_id'] }}" name="attr_value[]">
                                                            </div>

                                                        <?php } else { ?>
                                                            <div class="">
                                                                <input type="text" is_required="{{$is_required}}" value="{{ $val['attr_value'] }}" class="datepicker attr_value form-control textRequired singleDate_{{ $val['attribute_id'] }}" name="attr_value[]">
                                                            </div>
                                                        <?php } ?>


                                                        <?php
                                                    } else if ($input_type == "Time") {

                                                        if (strpos($val['attr_value'], ';')) {
                                                            $timeVal = explode(';', $val['attr_value']);
                                                            ?>

                                                            <div class=" bootstrap-timepicker edit_time">
                                                                <input type="text" is_required="{{$is_required}}" value="{{ $timeVal[0] }}" attribute_id="{{ $val['attribute_id'] }}" class="timepicker timeRange attr_value from_time_{{ $val['attribute_id'] }} form-control textRequired" >
                                                                <!--<div class="input-group-addon" style="width: 21%;">
                                                                    <i class="fa fa-clock-o"></i>
                                                                </div>-->
                                                            </div>
                                                            <div class="bootstrap-timepicker edit_time1">
                                                                <input type="text" is_required="{{$is_required}}" value="{{ $timeVal[1] }}" attribute_id="{{ $val['attribute_id'] }}" class="timepicker attr_value to_time_{{ $val['attribute_id'] }} form-control textRequired">
                                                                <!--<div class="input-group-addon" style="width: 21%;">
                                                                    <i class="fa fa-clock-o"></i>
                                                                </div>-->
                                                            </div>
                                                            <input type="hidden" name="attr_value[]" class="fromAndToTime_{{ $val['attribute_id'] }}" value="{{$val['attr_value']}}">
                                                        <?php } else if ($val['attr_value'] == 'on') {
                                                            ?> 
                                                            <div class="bootstrap-timepicker edit_time1">
                                                                <input type="text" is_required="{{$is_required}}" value="" attribute_id="{{ $val['attribute_id'] }}" class="timepicker timeRange attr_value from_time_{{ $val['attribute_id'] }} form-control textRequired" >
                                                                <!--<div class="input-group-addon" style="width: 21%;">
                                                                    <i class="fa fa-clock-o"></i>
                                                                </div>-->
                                                            </div> 
                                                            <div class="bootstrap-timepicker edit_time1">
                                                                <input type="text" is_required="{{$is_required}}" value="" attribute_id="{{ $val['attribute_id'] }}" class="timepicker attr_value to_time_{{ $val['attribute_id'] }} form-control textRequired">
                                                                <!--<div class="input-group-addon" style="width: 21%;">
                                                                    <i class="fa fa-clock-o"></i>
                                                                </div>-->
                                                            </div>
                                                            <input type="hidden" name="attr_value[]" class="fromAndToTime_{{ $val['attribute_id'] }}" value="{{$val['attr_value']}}">
                                                        <?php } else { ?>
                                                            <div class="bootstrap-timepicker" style="width: 100%;">
                                                                <input type="text" is_required="{{$is_required}}" value="{{ $val['attr_value'] }}" class="timepicker attr_value form-control textRequired" name="attr_value[]">
                                                                <!-- <div class="input-group-addon" style="width: 21%;">
                                                                     <i class="fa fa-clock-o"></i>
                                                                 </div>-->
                                                            </div>
                                                        <?php } ?>


                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @if(in_array($val['attr_type_name'],['Video']))
                                        <div class="form-row row">
                                            <div class="col-sm-4">
                                                <label>{{ $val['display_name'] }}</label>
                                            </div>
                                            <?php
                                            $input_type = $val['attr_type_name'];
                                            if ($input_type == "Video") {
                                                ?>

                                                <div class="col-sm-8">
                                                    <input type="hidden" value="{{ $val['attr_type_name'] }}" name="attr_type_name_video[]">
                                                    <input type="hidden" value="{{ $val['attr_type_id'] }}" name="attr_type_id_video[]">
                                                    <input type="hidden" value="{{ $val['attribute_id'] }}" name="attr_ids_video[]">
                                                    <span><a href="{!! asset("/upload_images/attribute_values/video/$val[classified_id]/$val[attribute_id]/$val[attr_value]") !!}">{!! $val['attr_value'] !!}</a> </span>
                                                    <br>
                                                    <br>
                                                    <input type="file" value="" class="attr_value_video attr_value videotypetxt" name="attr_value_video[]">
                                                    <input type="hidden" value="{{$val['attr_value']}}" class="attr_value form-control" name="attr_value_video_old[]">
                                                </div>
                                            <?php } ?>
                                        </div>
                                        @endif

                                        @endforeach
                                    </div>


                                    @if(isset($result1['multi_select']) && !empty($result1['multi_select']))
                                    @foreach ($result1['multi_select'] as $val)
                                    <?php
                                    $is_required = $val['is_required'];
                                    //dd($result1['multi_select']);
                                    ?>
                                    <div class="form-row divCheckBox row">
                                        <div class="col-sm-4">
                                            <label>{{ $val['display_name'] }}</label>
                                        </div>
                                        <div class="col-sm-8">
                                            @if($val['attr_type_name_multi'] == 'Multi-Select')
                                            <input type="hidden" value="{{ $val['attr_type_name_multi'] }}" name="attr_type_name_multi">
                                            <input type="hidden" value="{{ $val['attr_type_id_multi'] }}" name="attr_type_id_multi">
                                            <input type="hidden" value="{{ $val['attr_ids_multi'] }}" name="attr_ids_multi[]">
                                            @foreach ($val['attribute_value'] as $k => $v)
                                            <input class="inputCheckBox" is_required="{{ $is_required }}" @if(in_array($k,$val['selected']))checked @endif name="attr_value_multi[{{ $val['attr_ids_multi'] }}][]" type="checkbox" value="{!!$k!!}"> {!! $v !!}
                                                   @endforeach
                                                   @endif    

                                                   @if($val['attr_type_name_multi'] == 'Radio-button')
                                                   <input type="hidden" value="{{ $val['attr_type_name_multi'] }}" name="attr_type_name_radio">
                                            <input type="hidden" value="{{ $val['attr_type_id_multi'] }}" name="attr_type_id_radio">
                                            <input type="hidden" value="{{ $val['attr_ids_multi'] }}" name="attr_ids_radio[]">
                                            @foreach ($val['attribute_value'] as $k1 => $v1)
                                            <input class="inputCheckBox" is_required="{{ $is_required }}" type="radio" value="{{ $k1 }}" @if($k1 == $val['selected'][0])checked @endif class="attr_value" name="attr_value_radio[{{ $val['attr_ids_multi'] }}][]"> {{ $v1 }}
                                                   @endforeach
                                                   @endif    
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif

                                    @if(isset($result1['Radio-button']) && !empty($result1['Radio-button']))
                                    @foreach ($result1['Radio-button'] as $val)
                                    <?php $is_required = $val['required']; ?>
                                    <div class="form-row row">
                                        <div class="col-sm-4">
                                            <label>{{ $val['name'] }}</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="hidden" value="{{ $val['attr_type_name_radio'] }}" name="attr_type_name_radio">
                                            <input type="hidden" value="{{ $val['attr_type_id_radio'] }}" name="attr_type_id_radio">
                                            <input type="hidden" value="{{ $val['attr_ids_radio'] }}" name="attr_ids_radio[]">
                                            @foreach ($val['attr_AllValues'] as $k1 => $v1)
                                            <input type="radio" is_required="{{ $is_required }}" value="{{ $k1 }}" @if($k1 == $val['attr_value'])checked @endif class="attr_value" name="attr_value_radio[]"> {{ $v1 }}
                                                   @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                <hr>
                                <div class="form-row row">
                                    <div class="col-sm-4">
                                        <label>Classified Description</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="value-field">
                                            {!! Form::textarea('description', strip_tags($result->description), ['id' => '','class' => 'form-control','placeholder'=>'Description','rows'=>7]) !!}
                                            <!--<span class="hint edit"> <i class="fa fa-pencil" aria-hidden="true"></i>Did you know it's FREE to edit your listing for the full duration of your ad?</span>-->
                                            <div class="error-message">{{$errors->first('description')}}</div>
                                            <!--<span class="hint">4000 characters left </span>-->
                                        </div>
                                    </div>
                                </div>
                                <?php /* ?>
                                  <div class="form-row row">
                                  <div class="col-sm-4">
                                  <label>Price</label>
                                  </div>
                                  <div class="col-sm-8">
                                  <div class="value-field">
                                  @if($result->price != 0 )
                                  {!! Form::input('number', 'price', null, ['id'=>'price','class' => 'form-control','placeholder'=>'Price (AUD)']) !!}
                                  @else
                                  {!! Form::input('number', 'price', '', ['id'=>'price','class' => 'form-control','placeholder'=>'Price (AUD)']) !!}
                                  @endif
                                  </div>
                                  </div>
                                  </div>
                                  <?php */ ?>
                                <div class="form-row form-row row">
                                    <div class="col-sm-4">
                                        <label>Upload Images  <span class="require">*</span>
                                            <!--<span class="hint">Ads with photos sell faster </span></label>-->
                                    </div>
                                    <div class="col-sm-8">
                                        @foreach ($result->classified_image as $attachment => $single) 
                                        <div class="advertisement_image" id="advertisement_image_<?php echo $single->id; ?>">
                                            <div class="default-delete">
                                                <a class="btn btn-default btn-close delete_image" href="{!! url('user/classifieds/delete-attachment'); !!}" data-id="{!! $single->id !!}" title="Delete"><i class="fa fa-remove"></i></a>
                                            </div>
                                            <img src="{!! asset('/upload_images/classified/30px/'.$result->id.'/'.$single['name']) !!}" title="preview image" class="thumbnail" />

                                        </div>
                                        @endforeach
                                        <div class="value-field">
                                            <div class="input-append">
                                                <div class="more-images" id="more_images">
                                                </div>
                                                <div id="classifiedInputFile"></div>
                                                <span class="more-images-button btn btn-default" style="margin-top: 11px;"><a href="javascript:void(0)" onclick="add_more()" >Add more image</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="sttcAttrbts">
                                    <div class="form-row row">
                                        <div class="col-sm-4">
                                            <label>Contact Name <span class="require"></span></label>
                                        </div>
                                        <div class="col-sm-8 form-row">
                                            <div class="value-field">
                                                {!! Form::input('text', 'contact_name', null, ['id'=>'contact_name ','class' => 'contact_name form-control','placeholder'=>'Contact Name']) !!}
                                                <div class="error-message">{{$errors->first('contact_name')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="col-sm-4">
                                            <label>Contact Email  <span class="require"></span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="value-field">
                                                {!! Form::input('text', 'contact_email', null, ['id'=>'contact_email','class' => 'contact_email  emailValidation form-control','placeholder'=>'Contact Email']) !!}
                                                <span class="hint edit font_edit"> <i class="fa fa-pencil" aria-hidden="true"></i>Your email address will not be displayed.</span>
                                                <div class="error-message">{{$errors->first('contact_email')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="col-sm-4">
                                            <label>Contact Mobile</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="value-field">
                                                {!! Form::input('text', 'contact_mobile', null, ['id'=>'contact_mobile','class' => 'contact_mobile form-control singleNumbernumeric','placeholder'=>'Contact Mobile','min'=>'0','readonly']) !!}
                                                <div class="error-message">{{$errors->first('contact_mobile')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="col-sm-4">
                                            <label>Website</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="value-field">
                                                {!! Form::input('text', 'website', null, ['id'=>'website','class' => 'website form-control','placeholder'=>'Website']) !!}
                                                <div class="error-message">{{$errors->first('website')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr> 
                                    <div class="form-row row">
                                        <div class="col-sm-4">
                                            <label>Location <span class="require"></span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="value-field">
                                                <input type="hidden" value="{{$result->lat}}" id="lat" name="lat" />
                                                <input type="hidden" value="{{$result->lng}}" id="lng" name="lng" />
                                                <input type="hidden" name="suburbs_id" id="suburbs_id" value="{{$result1['suburbs_id']}}">
                                                {!! Form::input('text', 'location', (isset($result->location))?$result->location:null, ['class' => 'form-control','placeholder'=>'Location Name','id'=>'address']) !!}
                                                <span class="hint edit font_edit"> <i class="fa fa-map-marker" aria-hidden="true"></i>Your Location will not be displayed.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="col-sm-4">
                                            <label>State <span class="require"></span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="value-field">

                                                {!! Form::input('text', '', (isset($statename->name))?$statename->name:null, ['id'=>'statevalue','class' => 'form-control statevalue','placeholder'=>'State','readonly' => 'true']) !!}

                                                {!! Form::select('state_id', $state, (isset($result->state_id))?$result->state_id:null, ['id' => 'stateid','placeholder' => 'Select State', 'class' => '', 'readonly']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="col-sm-4">

                                            <label>City</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="value-field">
                                                <input type="hidden" value="{{$result1['city']['City']}}" class="form-control city" name="subregions_id"/>
                                                {!! Form::input('text', 'city', $result1['city']['City'], ['id'=>'subregion_id','class' => 'form-control subregion_id city','placeholder'=>'Select City','readonly' => 'true']) !!}

                                                <div class="error-message">{{$errors->first('subregions_id')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="col-sm-4">
                                            <label>Pincode <span class="require"></span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="value-field">
                                                {!! Form::input('text', 'pincode', null, ['id'=>'pincode','class' => 'pincode form-control ','placeholder'=>'PinCode','readonly']) !!}
                                                <div class="error-message">{{$errors->first('pincode')}}</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!--########## Is Featured Content -->
                                <?php if ($result->subcategoriesname->is_sellable == 1) { ?>

                                    <?php $is_featuredstatus = true; ?>
                                    <?php if (isset($result['classified_hasmany_other']) && !empty($result['classified_hasmany_other'])) { ?>
                                        <div id="" class="additional_ul_li" style="">

                                            <?php
                                            $count_featuredstatus = 0;
                                            foreach ($result['classified_hasmany_other'] as $key => $value) {
                                                ?>
                                                <?php
                                                if ($value['other_slug'] == 'is_features') {
                                                    $count_featuredstatus++;
                                                    $is_featuredstatus = false;

                                                    if ($count_featuredstatus == 1) {
                                                        ?>
                                                        <h4 class='img-text-ad'><strong>Additional Feature Information</strong>
                                                            about the product.
                                                        </h4>
                                                    <?php } ?>
                                                    <div class="edit_others_div_border">

                                                        <a class="que-close-btn edit_others_close" others_id="{{$value['id']}}" href="javascript:void(0);">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                        <div class="form-row row">
                                                            <div class="col-sm-4">
                                                                <label>Title</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="value-field">
                                                                    <input name='edit_other_value[is_features][{{$value['id']}}][id]' type="hidden" value="{{$value['id']}}" >
                                                                    <input name='edit_other_value[is_features][{{$value['id']}}][image]' type="hidden" value="{{$value['image']}}" >
                                                                    <input name="edit_other_value[is_features][{{$value['id']}}][title]" class="form-control" value="{{$value['other_title']}}" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row row">
                                                            <div class="col-sm-4">
                                                                <label>Feature Image</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="value-field">
                                                                    <img style="width:14%;  border: 0px;" src="{!! asset('/upload_images/others/'.$value->image) !!}" title="" class="thumbnail" />
                                                                </div>
                                                                <div class="value-field">
                                                                    Change this image
                                                                    <input name='edit_other_value[is_features][{{$value['id']}}][edit_image]' class='form-control' type='file' >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row row">
                                                            <div class="col-sm-4">
                                                                <label>Description</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="value-field">
                                                                    <textarea name="edit_other_value[is_features][{{$value['id']}}][desc]" cols="68" rows="5" class="form-control">{{$value['other_value']}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>

                                    <div id="is_features_parent_div" class="additional_ul_li" style="">
                                        <?php if ($is_featuredstatus) { ?>
                                            <h4 class='img-text-ad'><strong>Additional Feature Information</strong>
                                                about the product.
                                            </h4>
                                        <?php } ?>
                                        <div id="is_features_div">


                                            <ul class='edit_featured_div' >

                                                <li class='no-ad-padding'>
                                                    <label>Title</label>
                                                    <input is_required='0' idErr='title_1' name='other_value[is_features][1][title]' class='form-control features_title_input textRequired_static' type='text' placeholder='Please type your title here' >
                                                    <p class='ad-error' id='title_1_error'></p>
                                                </li>

                                                <li class='no-ad-padding'>
                                                    <label>Feature Image</label>
                                                    <input is_required='0' idErr='is_feature_img_1' name='other_value[is_features][1][image]' class='form-control is_feature_img textRequired_static' type='file' >
                                                    <p class='ad-error' id='is_feature_img_1_error'></p>
                                                </li>

                                                <li class='no-ad-padding'>
                                                    <label>Description</label>
                                                    <textarea is_required='0' idErr='is_feature_desc_1' cols='68' rows='5' name='other_value[is_features][1][desc]' class='form-control is_feature_desc textRequired_static' ></textarea>
                                                    <p class='ad-error' id='is_feature_desc_1_error'></p>
                                                </li>

                                            </ul>

                                        </div>
                                        <ul class="ad-detail-form-sec">
                                            <li class="no-ad-padding">                        
                                                <a class="add_more_features" href="javascript:void(0);"><i class='fa fa-plus'></i>Add more</a>                       
                                            </li>
                                        </ul>
                                    </div>

                                    <!--########## For Demo And Guids #####-->
                                    <?php $is_demo_guids = true; ?>
                                    <?php if (isset($result['classified_hasmany_other']) && !empty($result['classified_hasmany_other'])) { ?>
                                        <div id="" class="additional_ul_li" style="">

                                            <?php
                                            $count_demo_guids = 0;
                                            foreach ($result['classified_hasmany_other'] as $key => $value) {
                                                ?>
                                                <?php
                                                if ($value['other_slug'] == 'demo_guides') {
                                                    $is_demo_guids = false;
                                                    $count_demo_guids++;

                                                    if ($count_demo_guids == 1) {
                                                        ?>
                                                        <h4 class='img-text-ad'><strong>Additional Information</strong>
                                                            about Demo and Guides.
                                                        </h4>
                                                    <?php } ?>
                                                    <div class="edit_others_div_border">

                                                        <a class="que-close-btn edit_others_close" others_id="{{$value['id']}}" href="javascript:void(0);">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                        <div class="form-row row">
                                                            <div class="col-sm-4">
                                                                <label>Title</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="value-field">
                                                                    <input name='edit_other_value[demo_guides][{{$value['id']}}][id]' type="hidden" value="{{$value['id']}}" >
                                                                    <input name='edit_other_value[demo_guides][{{$value['id']}}][image]' type="hidden" value="{{$value['image']}}" >
                                                                    <input name="edit_other_value[demo_guides][{{$value['id']}}][title]" class="form-control" value="{{$value['other_title']}}" >
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class='form-row row' >
                                                            <div class="col-sm-4">
                                                                <label>Content Type</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select is_required='0' name='edit_other_value[demo_guides][{{$value['id']}}][content_type]' class='form-control edit_demo_guides_content_type textRequired_static' >
                                                                    <option value=''>--Select--</option>
                                                                    <option <?php echo ($value['content_type'] == 'image') ? 'selected' : ''; ?> value='image'>Image</option>
                                                                    <option <?php echo ($value['content_type'] == 'url') ? 'selected' : ''; ?> value='url'>Url</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class='form-row row demo_guides_image_li' <?php if ($value['image'] != '') { ?> style="display: block;" <?php } else { ?> style="display: none;" <?php } ?>>
                                                            <div class="col-sm-4">
                                                                <label>Image</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="value-field">
                                                                    <img style="width:14%; border: 0px;" src="{!! asset('/upload_images/others/'.$value->image) !!}" title="" class="thumbnail" />
                                                                </div>
                                                                <div class="value-field">
                                                                    Change this image
                                                                    <input name='edit_other_value[demo_guides][{{$value['id']}}][edit_image]' class='form-control' type='file' >
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class='form-row row demo_guides_url_li' <?php if ($value['url'] != '') { ?> style="display: block;" <?php } else { ?> style="display: none;" <?php } ?>>
                                                            <div class="col-sm-4">
                                                                <label>Url</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input name='edit_other_value[demo_guides][{{$value['id']}}][url]' value="{{$value['url']}}" class='form-control' >
                                                            </div>
                                                        </div>

                                                        <div class="form-row row">
                                                            <div class="col-sm-4">
                                                                <label>Description</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="value-field">
                                                                    <textarea name='edit_other_value[demo_guides][{{$value['id']}}][desc]' cols="68" rows="5" class="form-control">{{$value['other_value']}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>

                                    <?php } ?>

                                    <div id="is_features_parent_div" class="additional_ul_li" style="">
                                        <?php if ($is_demo_guids) { ?>
                                            <h4 class='img-text-ad'><strong>Additional Information</strong>
                                                about Demo and Guides.
                                            </h4>
                                        <?php } ?>
                                        <div id="demo_guides_div">


                                            <ul class='edit_featured_div' >

                                                <li class='no-ad-padding'>
                                                    <label>Title</label>
                                                    <input is_required='0' idErr='demo_guides_title_1' name='other_value[demo_guides][1][title]' class='form-control demo_guides_title_input textRequired_static' type='text' placeholder='Please type your title here' >
                                                    <p class='ad-error' id='demo_guides_title_1_error'></p>
                                                </li>

                                                <li class='no-ad-padding'>
                                                    <label>Content Type</label>
                                                    <select is_required='0' idErr='demo_guides_content_type_1' name='other_value[demo_guides][1][content_type]' class='form-control demo_guides_content_type textRequired_static' >
                                                        <option value=''>--Select--</option>
                                                        <option value='image'>Image</option>
                                                        <option value='url'>Url</option>
                                                    </select>
                                                    <p class='ad-error' id='demo_guides_content_type_1_error'></p>
                                                </li>

                                                <li class='no-ad-padding  demo_guides_image_li' style='display:none;'>
                                                    <label>Image</label>
                                                    <input is_required='0' idErr='demo_guides_img_1' name='other_value[demo_guides][1][image]' class='form-control demo_guides_img textRequired_static' type='file' >
                                                    <p class='ad-error' id='demo_guides_img_1_error'></p>
                                                </li>

                                                <li class='no-ad-padding demo_guides_url_li' style='display:none;'>
                                                    <label>Url</label>
                                                    <input is_required='0' idErr='demo_guides_url_1' name='other_value[demo_guides][1][url]' class='form-control demo_guides_url textRequired_static' type='text' >
                                                    <p class='ad-error' id='demo_guides_url_1_error'></p>
                                                </li>

                                                <li class='no-ad-padding'>
                                                    <label>Description</label>
                                                    <textarea is_required='0' idErr='demo_guides_desc_1' cols='68' rows='5' name='other_value[demo_guides][1][desc]' class='form-control demo_guides_desc textRequired_static' ></textarea>
                                                    <p class='ad-error' id='demo_guides_desc_1_error'></p>
                                                </li>

                                            </ul>

                                        </div>
                                        <ul class="ad-detail-form-sec">
                                            <li class="no-ad-padding">                        
                                                <a class="add_more_demo_guides" href="javascript:void(0);"><i class='fa fa-plus'></i>Add more</a>                       
                                            </li>
                                        </ul>
                                    </div>

                                <?php } ?>


                                <!--########## Is questions answer -->
                                <?php if (isset($template_arr) && $template_arr->questions_answer == 1) { ?>
                                    <?php $questions_answer = true; ?>

                                    <?php
                                    if (isset($result['classified_hasmany_questions']) && !empty($result['classified_hasmany_questions'])) {
                                        $questions_answer = false;
                                        ?>
                                        <div id="" class="additional_ul_li" style="">
                                            <h4 class='img-text-ad'><strong>Additional Questions from the Employer</strong>
                                                You can add upto 5 additional questions.
                                            </h4>
                                            <?php foreach ($result['classified_hasmany_questions'] as $key => $value) { ?>

                                                <div class="edit_qes_ans_div_border">

                                                    <a class="que-close-btn edit_qes_ans_close" ques_id="{{$value['id']}}" href="javascript:void(0);">
                                                        <i class="fa fa-close"></i>
                                                    </a>

                                                    <div class="form-row row">
                                                        <div class="col-sm-4">
                                                            <label>Question</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="value-field">
                                                                <input name='edit_questions[{{$key}}][id]' type="hidden" value="{{$value['id']}}" >
                                                                <input name='edit_questions[{{$key}}][question]' type="text" class="form-control" value="{{$value['question']}}" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='form-row row'>
                                                        <div class="col-sm-4">
                                                            <label>Option Type</label>
                                                        </div>
                                                        <div class="col-sm-8" <?php echo $value['ans_type']; ?>>
                                                            <?php /*
                                                              <input <?php echo ($value['ans_type'] == 'dropdown') ? "checked" : ""; ?> value='dropdown' class='ans_type' name='edit_questions[{{$value['id']}}][ans_type]' type='radio' >Dropdown
                                                              <input <?php echo ($value['ans_type'] == 'radio') ? "checked" : ""; ?>  value='radio' class='ans_type' name='edit_questions[{{$value['id']}}][ans_type]' type='radio' >Radio Button
                                                              <input <?php echo ($value['ans_type'] == 'text') ? "checked" : ""; ?> value='text' class='ans_type' name='edit_questions[{{$value['id']}}][ans_type]' type='radio' >Textbox
                                                             * 
                                                             */ ?>
                                                            <input readonly="readonly" name="edit_questions[{{$key}}][ans_type]" class="form-control" value="{{$value['ans_type']}}" >
                                                        </div>
                                                    </div>

                                                    <?php if (!empty($value['question_hasmany_options'])) { ?>
                                                        <?php foreach ($value['question_hasmany_options'] as $k => $val) { ?>
                                                            <div class='form-row row'>
                                                                <div class="col-sm-4">
                                                                    <label><?php if ($k == 0) { ?>Options <?php } ?></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input name="edit_questions[{{$key}}][options][]" value="{{$val['option_value']}}" class='form-control' >
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                    <?php } ?>



                                    <div id="post-add" style="padding: 0px;">
                                        <div id="questions_answer_parent_div" class="additional_ul_li ad-detail-form">
                                            <?php if ($questions_answer) { ?>
                                                <h4 class='img-text-ad'><strong>Additional Questions from the Employer</strong>
                                                    You can add upto 5 additional questions.
                                                </h4>
                                            <?php } ?>
                                            <div id="questions_answer_div">
                                                <ul class='ad-detail-form-sec edit_featured_div' >

                                                    <li class='no-ad-padding buss-no-padd'>

                                                        <div class='row step3row'>
                                                            <div class='col-sm-4'>
                                                                <label>Question 1</label>                                    
                                                            </div>
                                                            <div class='col-sm-8'>                                                       
                                                                <input is_required='1' iderr='question_1' name='questions[1][question]' class='questions_input textRequired form-control' type='text' placeholder='Please type your question here' >
                                                                <p class='ad-error' id='question_1_error'></p>
                                                            </div>
                                                        </div>  
                                                    </li>

                                                    <li class='no-ad-padding buss-no-padd'>

                                                        <div class='row step3row'>
                                                            <div class='col-sm-4'>
                                                                <label class='ans_style11'>Answer Style:</label>                                                      
                                                            </div>
                                                            <div class='col-sm-8'>                                                       
                                                                <ul class='contact-surname ul_ans_style' iderr='ans_style_1'>
                                                                    <li><input is_required='1'  ques_no=1 id='ans_type_dropdown_1' value='dropdown' class='ans_type' radio_lable='dropdown' name='questions[1][ans_type]' type='radio' ><label for='ans_type_dropdown_1'>Dropdown</label></li>
                                                                    <li><input is_required='1'  ques_no=1 id='ans_type_radio_1' value='radio' class='ans_type' radio_lable='radio'  name='questions[1][ans_type]' type='radio' ><label for='ans_type_radio_1'>Radio Button</label></li>
                                                                    <li><input is_required='1'  ques_no=1 id='ans_type_text_1' value='text' class='ans_type' radio_lable='text'  name='questions[1][ans_type]' type='radio' ><label for='ans_type_text_1'>Textbox</label></li>
                                                                </ul>



                                                            </div>
                                                        </div>



                                                        <p class='ad-error' id='ans_style_1_error'></p>
                                                    </li>

                                                    <li class='no-ad-padding'>
                                                        <ul class='ad-detail-form-sec answer_input answer_input_1' >
                                                        </ul>
                                                    </li>
                                                    <li class='no-ad-padding'>
                                                        <a style='display:none;' ques_no=1 class='add_more_ans add_more_ans_1' href='javascript:void(0);' >
                                                            <i class='fa fa-plus'></i>Add Option
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                            <ul class="ad-detail-form-sec">
                                                <li class="no-ad-padding">                        
                                                    <a class="add_more_ques" href="javascript:void(0);"><i class='fa fa-plus'></i>Add Question</a>                       
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php } ?>


                                <?php /*
                                  @if($result->status == 0 || $result->status == 1)
                                  <div class="form-row">
                                  <div class="col-sm-4">
                                  <label>Status<span class="require">*</span></label>
                                  </div>
                                  <div class="col-sm-8">
                                  <div class="value-field">
                                  {!! Form::checkbox('status', '1', null, ['class' => 'status']) !!}
                                  <div class="error-message">{{$errors->first('contact_name')}}</div>
                                  </div>
                                  </div>
                                  </div>
                                  @else
                                  <input type="hidden" name="status" value="{{ $result->status }}" >
                                  @endif
                                 */ ?>
                                <hr> 
                                <div class="form-row row">
                                    <div class="col-sm-4">
                                        <label>&nbsp;</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="value-field">
                                            <input type="submit"  name="" value="Submit" class="submit-btn">
                                            <a href="{{ url('/user/classifieds') }}" class="cancel-btn">Cancel</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>

<!-- categories section -->
<section>
    <div id="feature-category">
        <div class="container">         
            <div class="adv-banner">
                <!-- advertisement iframe appears here in replacement of this banner -->
                <img src="{{ URL::asset('plugins/front/img/adv-banner.jpg') }}" alt="adv-banner.jpg">
            </div>
        </div>
    </div>
</section>
</div>

@stop

@section('scripts')
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/colorpicker/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/ionslider/ion.rangeSlider.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/ionslider/ion.rangeSlider.skinNice.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/timepicker/bootstrap-timepicker.min.css') }}">
<script src="{{ URL::asset('plugins/admin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('plugins/admin/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ URL::asset('plugins/admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ URL::asset('plugins/front/js/business_post_edit_classified.js') }}"></script>

<script>
<?php if (Session::has('message')) { ?>
                                                        Notify.showNotification('<?php echo Session::get('message'); ?>', 'success');
<?php } ?>


                                                    $(function () {
//                                                    

                                                        $('#end_date').val('<?php echo date('m/d/Y', strtotime($result->end_date)); ?>');
                                                        stateCode = [$.parseJSON('<?php echo json_encode($stateCode); ?>')];
                                                        stateCode[0][''] = '';
                                                        console.log(stateCode);
                                                        var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {
//                                                            types: ['(cities)'],
                                                            componentRestrictions: {country: "au"}});
                                                        google.maps.event.addListener(autocomplete, 'place_changed', function () {
                                                            var place = autocomplete.getPlace();
                                                            document.getElementById('lat').value = place.geometry.location.lat();
                                                            document.getElementById('lng').value = place.geometry.location.lng();
//                                        console.log(place.address_components);

                                                            var place = autocomplete.getPlace();
                                                            for (var i = 0; i < place.address_components.length; i++) {
                                                                var addressType = place.address_components[i].types[0];
//                                            console.log(addressType);
                                                                if (addressType == 'administrative_area_level_1') {
                                                                    var gStateId = place.address_components[i]['short_name'];
                                                                    var state = place.address_components[i]['long_name'];
                                                                    $('#stateid').val(stateCode[0][gStateId]);
                                                                    $('#statevalue').val(state);
                                                                    console.log(stateCode[0][gStateId]);
                                                                }
                                                                if (addressType == 'administrative_area_level_2') {
                                                                    var state2 = place.address_components[i]['long_name'];
                                                                }
                                                                if (addressType == 'locality') {
                                                                    var gCityCode = place.address_components[i]['long_name'];
                                                                    console.log(gCityCode);
                                                                    $('.city').val(gCityCode);
                                                                }
                                                                if (addressType == 'postal_code') {
                                                                    var gPostalCode = place.address_components[i]['short_name'];
                                                                    $('#pincode').val(gPostalCode);
                                                                }
                                                            }
                                                            var location_str = state + " " + state2 + " " + gCityCode;

                                                            $.ajax({
                                                                url: root_url + '/get_suburbs',
                                                                data: {
                                                                    "postal_code": gPostalCode, "location_str": location_str,
                                                                },
                                                                //dataType: "html",
                                                                method: "GET",
                                                                cache: true,
                                                                success: function (suburbId) {
                                                                    $('#suburbs_id').val(suburbId);
                                                                }
                                                            });


                                                        });
<?php
$classified_attribute = json_encode($result1['classified_attribute']);
?>

                                                        var classified_attribute = <?php echo $classified_attribute; ?>;

                                                        $.each(classified_attribute, function (index, value) {

                                                            if ((value['attr_type_name'] == 'Numeric' || value['attr_type_name'] == 'calendar') && (value['attr_value'].indexOf(';'))) {
                                                                var vv = value['attr_value'].split(';');
                                                                var aa = [];
                                                                $.each(value['attr_AllValuesNumeric'], function (i, v) {
                                                                    aa.push(v);
                                                                });
                                                                $(".range_" + value['attribute_id']).ionRangeSlider({
                                                                    min: aa[0],
                                                                    max: aa[1],
                                                                    from: vv[0],
                                                                    to: vv[1],
                                                                    type: 'double',
                                                                    step: 1,
                                                                    prefix: "",
                                                                    prettify: false,
                                                                    hasGrid: true
                                                                });
                                                            }

                                                        });
                                                    });
                                                    $(".my-colorpicker2").colorpicker();
                                                    $(".timepicker").timepicker({
                                                        showInputs: false,
                                                        showSeconds: true,
                                                        maxHours: 24,
                                                        showMeridian: false,
                                                        defaultTime: false,
                                                    });

//                                                        $(document).on('click', '#stateid', function(){
//                                                            alert();
//                                                           return false; 
//                                                        });



                                                    $("#stateid").css("display", "none");
                                                    $(document).on('click', '.liImageGallery1 i', function () {

                                                        var objThis = $(this);
                                                        if (!confirm("Are you sure?")) {
                                                            return false;
                                                        } else {
                                                            var classified_id = $(this).attr('classi_id');
                                                            var file_name = $(this).attr('file_name');
                                                            $.ajax({
                                                                url: root_url + '/user/classifieds/delete-image-gallery-front',
                                                                data: {
                                                                    "_token": $('meta[name="csrf-token"]').attr('content'),
                                                                    "classified_id": classified_id,
                                                                    "file_name": file_name,
                                                                },
                                                                //dataType: "html",
                                                                method: "POST",
                                                                cache: true,
                                                                success: function (response) {
                                                                    if (response.status) {
                                                                        objThis.parent('.liImageGallery1').remove();
                                                                    }
                                                                }
                                                            });
                                                        }
                                                    });
                                                    $(document).on('click', '.delete_image', function () {
                                                        if (!confirm('Are you sure you want to delete ?')) {
                                                            return false;
                                                        }
                                                        var id = $(this).attr('data-id');
                                                        $.ajax({
                                                            type: "POST",
                                                            url: $(this).attr('href'),
                                                            data: {
                                                                "_token": $('meta[name="csrf-token"]').attr('content'),
                                                                "id": id
                                                            },
                                                            success: function (response) {
                                                                if (response.status) {
                                                                    $('#advertisement_image_' + id).fadeOut(100);
                                                                    $('#advertisement_image_' + id).remove();
                                                                } else {
                                                                    Notify.showNotification("Image could not be deleted.", 'warning');
                                                                }

                                                            }

                                                        })
                                                        return false;
                                                    });
</script>


@stop



