@extends('front/layout/layout')
@section('content')
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
    <section>
        <div id="login-inner-section">
            <div class="container">
                <div id="classified-post" class="classified-post">
                    <div class="title">
                        Edit Classified
                    </div>

                    <div id="rootwizard" >


                        <div class="tab-content" >

                            <div class="tab-pane1" id="tab3">
                                <div class="classified-form">
                                    {!! Form::model($result, array('action' => ["ClassifiedController@update", $result->id], 'files' => true, 'id'=>'submitFrmUpdate')) !!}  
                                    <input type="hidden" value="{{ $result->id }}" name="id">
                                    <input type="hidden" name="parent_categoryid" class="parent_categoryid" >
                                    <input type="hidden" name="category_id" class="category_id" >
                                    <div class="form-row">
                                        <div class="col-sm-4">
                                            <label>Classified Title <span class="require">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="value-field">
                                                {!! Form::input('text', 'title', (isset($result->title))?$result->title:null, ['id' => 'title','class' => 'textRequired','placeholder'=>'Title Name']) !!}
                                                <div class="error-message">{{$errors->first('title')}}</div>
                                                                        <!--<span class="hint">100 characters left </span>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-4">
                                            <label>Selected Category/Subcategory</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="value-field select-category">
                                                <input type="hidden" value="{{$result->parent_categoryid}}" id="" name="parent_categoryid" />
                                                <input type="hidden" value="{{$result->category_id}}" id="" name="category_id" />
                                                <span class="pCatName"><?php echo ($parentCategoryName['name'] != '' ? $parentCategoryName['name'] : ''); ?></span><span class="cCatName"><?php echo (!empty($childCategoryName['name']) ? '/' . $childCategoryName['name'] : ''); ?></span>     
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="form-row" id="attrName">
                                        <?php $storAttrIds = []; ?>
                                        @foreach ($result1['classified_attribute'] as $val)
                                        @if(in_array($val['attr_type_name'],['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric']))
                                        <?php
                                        $childValueDiv = '';
                                        if ($val['attr_type_name'] == "Drop-Down" && $val['parent_value_id'] != 0) {
                                            $childValueDiv = "childValueDiv_{$val['parent_attribute_id']}";
                                        }
                                        ?>
                                        <div class="form-row {!!$childValueDiv!!}">
                                            <div class="col-sm-4">
                                                <label>{{ $val['name'] }}</label>
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
                                                        <textarea class="attr_value textRequired" is_required="{{$is_required}}"   name="attr_value[]">{{ $val['attr_value'] }}</textarea> 
                                                    <?php } else if ($input_type == "Drop-Down" && $val['parent_value_id'] == 0) { ?>

                                                        {!! Form::select('attr_value[]', $val['attr_AllValues'], $val['attr_value'], ['is_required'=>$is_required, 'placeholder' => 'select one', 'class' => 'form-row classForOnChange', 'attributeid' => $val['attribute_id']]) !!}

                                                    <?php } else if ($input_type == "Drop-Down" && $val['parent_value_id'] != 0) { ?>

                                                        {!! Form::select('attr_value[]', $val['attr_AllValues'], $val['attr_value'], ['is_required'=>$is_required,'class' => 'form-row']) !!}
                                                    <?php } else if ($input_type == "text") { ?>

                                                        <input type="text" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-row textRequired" name="attr_value[]">

                                                    <?php } else if ($input_type == "Url") { ?>

                                                        <input type="text" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-row textRequired urlValidation" name="attr_value[]">

                                                    <?php } else if ($input_type == "Number") { ?>

                                                        <input type="number" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-row textRequired" name="attr_value[]">

                                                    <?php } else if ($input_type == "Email") { ?>

                                                        <input type="text" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-row textRequired emailValidation" name="attr_value[]">

                                                        <?php
                                                    } else if ($input_type == "Numeric") {

                                                        if (strpos($val['attr_value'], ';')) {
                                                            ?>
                                                            <input type="text" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-row range_{{ $val['attribute_id'] }}" name="attr_value[]">
                                                        <?php } else { ?>
                                                            <input type="number" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-row textRequired singleNumber" name="attr_value[]">
                                                        <?php } ?>



                                                        <?php
                                                    } else if ($input_type == "calendar") {

                                                        if (strpos($val['attr_value'], ';')) {
                                                            ?>
                                                            <input type="text" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-row range_{{ $val['attribute_id'] }}" name="attr_value[]">
                                                        <?php } else { ?>
                                                            <input type="number" onkeypress="return isNumberKey(event)" is_required="{{$is_required}}" value="{{ $val['attr_value'] }}" class="attr_value form-row  singleNumber singlecalendar" name="attr_value[]">
                                                        <?php } ?>



                                                    <?php } else if ($input_type == "Color") { ?>
                                                        <div class="input-group my-colorpicker2 colorpicker-element" style="width: 24%;">
                                                            <input type="text" value="{{ $val['attr_value'] }}" is_required="{{$is_required}}" class="attr_value form-row textRequired" name="attr_value[]">
                                                            <div class="input-group-addon" style="width: 21%;">
                                                                <i></i>
                                                            </div>
                                                        </div>


                                                        <?php
                                                    } else if ($input_type == "Date") {

                                                        if (strpos($val['attr_value'], ';')) {
                                                            $dateVal = explode(';', $val['attr_value']);
                                                            ?>
                                                            <div class="input-group">
                                                                <input placeholder="From Date" is_required="{{$is_required}}" value="{{$dateVal[0]}}" attribute_id="{{ $val['attribute_id'] }}" class="datepicker from_date textRequired rangeDate fromDate_{{ $val['attribute_id'] }}" type="text" value="" style="margin-right:8px;">
                                                                <input placeholder="To Date" is_required="{{$is_required}}" value="{{$dateVal[1]}}" attribute_id="{{ $val['attribute_id'] }}" class="datepicker to_date textRequired toDate_{{ $val['attribute_id'] }}" type="text" value="">
                                                                <input type="hidden" value="{{ $val['attr_value'] }}" class="fronAndToDate_{{ $val['attribute_id'] }}" name="attr_value[]">
                                                            </div>
                                                        <?php } else if ($val['attr_value'] == 'on') { ?>

                                                            <div class="input-group">
                                                                <input placeholder="From Date" is_required="{{$is_required}}" value="" attribute_id="{{ $val['attribute_id'] }}" class="datepicker from_date textRequired rangeDate fromDate_{{ $val['attribute_id'] }}" type="text" value="" style="margin-right:8px;">
                                                                <input placeholder="To Date" is_required="{{$is_required}}" value="" attribute_id="{{ $val['attribute_id'] }}" class="datepicker to_date textRequired toDate_{{ $val['attribute_id'] }}" type="text" value="">
                                                                <input type="hidden" value="{{ $val['attr_value'] }}" class="fronAndToDate_{{ $val['attribute_id'] }}" name="attr_value[]">
                                                            </div>

                                                        <?php } else { ?>
                                                            <div class="input-group">
                                                                <input type="text" is_required="{{$is_required}}" value="{{ $val['attr_value'] }}" class="datepicker attr_value form-row textRequired singleDate_{{ $val['attribute_id'] }}" name="attr_value[]">
                                                            </div>
                                                        <?php } ?>


                                                        <?php
                                                    } else if ($input_type == "Time") {

                                                        if (strpos($val['attr_value'], ';')) {
                                                            $timeVal = explode(';', $val['attr_value']);
                                                            ?>

                                                            <div class="input-group bootstrap-timepicker" style="width: 24%;">
                                                                <input type="text" is_required="{{$is_required}}" value="{{ $timeVal[0] }}" attribute_id="{{ $val['attribute_id'] }}" class="timepicker timeRange attr_value from_time_{{ $val['attribute_id'] }} form-row textRequired" >
                                                                <div class="input-group-addon" style="width: 21%;">
                                                                    <i class="fa fa-clock-o"></i>
                                                                </div>
                                                            </div> </br>
                                                            <div class="input-group bootstrap-timepicker" style="width: 24%;">
                                                                <input type="text" is_required="{{$is_required}}" value="{{ $timeVal[1] }}" attribute_id="{{ $val['attribute_id'] }}" class="timepicker attr_value to_time_{{ $val['attribute_id'] }} form-row textRequired">
                                                                <div class="input-group-addon" style="width: 21%;">
                                                                    <i class="fa fa-clock-o"></i>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="attr_value[]" class="fromAndToTime_{{ $val['attribute_id'] }}" value="{{$val['attr_value']}}">
                                                        <?php } else if ($val['attr_value'] == 'on') {
                                                            ?> 
                                                            <div class="input-group bootstrap-timepicker" style="width: 24%;">
                                                                <input type="text" is_required="{{$is_required}}" value="" attribute_id="{{ $val['attribute_id'] }}" class="timepicker timeRange attr_value from_time_{{ $val['attribute_id'] }} form-row textRequired" >
                                                                <div class="input-group-addon" style="width: 21%;">
                                                                    <i class="fa fa-clock-o"></i>
                                                                </div>
                                                            </div> </br>
                                                            <div class="input-group bootstrap-timepicker" style="width: 24%;">
                                                                <input type="text" is_required="{{$is_required}}" value="" attribute_id="{{ $val['attribute_id'] }}" class="timepicker attr_value to_time_{{ $val['attribute_id'] }} form-row textRequired">
                                                                <div class="input-group-addon" style="width: 21%;">
                                                                    <i class="fa fa-clock-o"></i>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="attr_value[]" class="fromAndToTime_{{ $val['attribute_id'] }}" value="{{$val['attr_value']}}">
                                                        <?php } else { ?>
                                                            <div class="input-group bootstrap-timepicker" style="width: 24%;">
                                                                <input type="text" is_required="{{$is_required}}" value="{{ $val['attr_value'] }}" class="timepicker attr_value form-row textRequired" name="attr_value[]">
                                                                <div class="input-group-addon" style="width: 21%;">
                                                                    <i class="fa fa-clock-o"></i>
                                                                </div>
                                                            </div>
                                                        <?php } ?>


                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @endforeach

                                        <?php $storAttrIdsForImages = []; ?>
                                        @foreach ($result1['classified_attribute'] as $val)
                                        @if($val['attr_type_name'] == 'Image-Gallery')
                                        <?php
                                        if (in_array($val['attribute_id'], $storAttrIdsForImages)) {
                                            $storAttrIdsForImages[$val['attribute_id']][] = $val;
                                        } else {
                                            $storAttrIdsForImages[$val['attribute_id']][] = $val;
                                        }
                                        ?>
                                        @endif
                                        @endforeach
                                        <?php foreach ($storAttrIdsForImages as $key => $val) { ?>
                                            <!--<div class="col-md-12">-->
                                            <!-- USERS LIST -->
                                            <?php $is_required = $val[0]['is_required']; ?>
                                            <div class="box box-default form-row" style="border:none;">
                                                <div class="col-sm-4">
                                                    <label> {!! $val[0]['name'] !!}</label>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="col-sm-8">
                                                    <div class="value-field">
                                                        <ul class="users-list clearfix">
                                                            <?php foreach ($val as $k => $v) { ?>

                                                                <li class="liImageGallery1 advertisement_image" style="">
                                                                    <i classi_id="{{$v['classified_id']}}" file_name="{{$v['attr_value']}}" class="fa fa-close"></i>
                                                                    <img style="width: 50px;height:50px;" src="{!! asset("/upload_images/attribute_values/image-gallery/$v[classified_id]/$v[attribute_id]/$v[attr_value]") !!}" alt="" >
                                                                         <input type="hidden" is_required="{{ $is_required }}" value="{{$v['attr_value']}}" class="attr_value form-row cloneId_{{ $v['attribute_id'] }}" style="width:24%;" name="attr_value_image_old[{{$v['attribute_id']}}][]">

                                                                </li>
                                                            <?php } ?> 
                                                        </ul>
                                                        <!-- /.users-list -->
                                                    </div>
                                                </div>

                                                <div class="box box-default form-row" style="border:none;">
                                                    <div class="col-sm-4">
                                                        <label> &nbsp;</label>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="col-sm-8">
                                                        <div class="value-field">
                                                            <input type="hidden" value="{{ $val[0]['attr_type_name'] }}" name="attr_type_name_image">
                                                            <input type="hidden" value="{{ $val[0]['attr_type_id'] }}" name="attr_type_id_image">
                                                            <input type="hidden" value="{{ $val[0]['attribute_id'] }}" name="attr_ids_image[]">
                                                            <div class="input_repeat">
                                                                <div class="file-input">
                                                                    <input type="file" value="" class="attr_value image_field"  name="attr_value_image[{{$val[0]['attribute_id']}}][]">
                                                                    <span class="custom-label">Browse..</span>
                                                                    <a href="javascript:void(0)" class="remove-img"><i class="fa fa-close" aria-hidden="true"></i></a>
                                                                </div>
                                                            </div>
                                                            <br/> 
                                                            <span class="btn btn-default"><a forclonelink="{{ $val[0]['attribute_id'] }}" href="javascript:void(0)" onclick="add_imageGallery(this)">Add more image</a></span>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-body -->
                                                    <div class="box-footer" style="border:none;">

                                                    </div>
                                                    <!-- /.box-footer -->
                                                </div>
                                                <!--/.box -->
                                                <!--</div>-->
                                            <?php } ?>



                                            @if(isset($result['multi_select']) && !empty($result['multi_select']))
                                            @foreach ($result['multi_select'] as $val)
                                            <?php $is_required = $val['is_required']; ?>
                                            <div class="form-row divCheckBox">
                                                <div class="col-sm-4">
                                                    <label>{{ $val['name'] }}</label>
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

                                            @if(isset($result['Radio-button']) && !empty($result['Radio-button']))
                                            @foreach ($result['Radio-button'] as $val)
                                            <?php $is_required = $val['required']; ?>
                                            <div class="form-row ">
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
                                        <div class="form-row">
                                            <div class="col-sm-4">
                                                <label>Classified Description</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="value-field">
                                                    {!! Form::textarea('description', strip_tags($result->description), ['id' => '','class' => '','placeholder'=>'Description','rows'=>7]) !!}
                                                    <!--<span class="hint edit"> <i class="fa fa-pencil" aria-hidden="true"></i>Did you know it's FREE to edit your listing for the full duration of your ad?</span>-->
                                                    <div class="error-message">{{$errors->first('description')}}</div>
                                                    <!--<span class="hint">4000 characters left </span>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
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
                                        <div class="form-row">
                                            <div class="col-sm-4">
                                                <label>Contact Name <span class="require"></span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="value-field">
                                                    {!! Form::input('text', 'contact_name', null, ['id'=>'contact_name','class' => 'contact_name','placeholder'=>'Contact Name']) !!}
                                                    <div class="error-message">{{$errors->first('contact_name')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-sm-4">
                                                <label>Contact Email  <span class="require"></span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="value-field">
                                                    {!! Form::input('text', 'contact_email', null, ['id'=>'contact_email','class' => 'contact_email  emailValidation','placeholder'=>'Contact Email']) !!}
                                                    <span class="hint edit"> <i class="fa fa-pencil" aria-hidden="true"></i>Your email address will not be displayed.</span>
                                                    <div class="error-message">{{$errors->first('contact_email')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-sm-4">
                                                <label>Contact Mobile</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="value-field">
                                                    {!! Form::input('number', 'contact_mobile', null, ['id'=>'contact_mobile','class' => 'contact_mobile singleNumbernumeric','placeholder'=>'Contact Mobile','min'=>'0']) !!}
                                                    <div class="error-message">{{$errors->first('contact_mobile')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-sm-4">
                                                <label>Website</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="value-field">
                                                    {!! Form::input('text', 'website', null, ['id'=>'website','class' => 'website','placeholder'=>'Website']) !!}
                                                    <div class="error-message">{{$errors->first('website')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr> 
                                        <div class="form-row">
                                            <div class="col-sm-4">
                                                <label>Location <span class="require"></span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="value-field">
                                                    <input type="hidden" value="{{$result->lat}}" id="lat" name="lat" />
                                                    <input type="hidden" value="{{$result->lng}}" id="lng" name="lng" />
                                                    {!! Form::input('text', 'location', (isset($result->location))?$result->location:null, ['class' => '','placeholder'=>'Location Name','id'=>'address']) !!}
                                                    <span class="hint edit"> <i class="fa fa-map-marker" aria-hidden="true"></i>Your Location will not be displayed.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
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
                                        <div class="form-row">
                                            <div class="col-sm-4">

                                                <label>City</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="value-field">
                                                    <input type="hidden" value="{{(isset($suburb->City))?$suburb->City:null}}" class="form-control city" name="subregions_id"/>
                                                    {!! Form::input('text', 'city', (isset($suburb->City))?$suburb->City:null, ['id'=>'subregion_id','class' => 'form-control subregion_id city','placeholder'=>'Select City','readonly' => 'true']) !!}

                                                    <!--{!! Form::input('text', 'subregions_id', (!empty($suburb->City))?$suburb->City:'', ['id'=>'subregion_id','placeholder'=>'Select Suburb','readonly']) !!}-->

                                                    <div class="error-message">{{$errors->first('subregions_id')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-sm-4">
                                                <label>Pincode <span class="require"></span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="value-field">
                                                    {!! Form::input('text', 'pincode', null, ['id'=>'pincode','class' => 'pincode ','placeholder'=>'PinCode','readonly']) !!}
                                                    <div class="error-message">{{$errors->first('pincode')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-sm-4">
                                                <label>Price</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="value-field">
                                                    @if($result->price != 0 )
                                                    {!! Form::input('number', 'price', null, ['id'=>'price','class' => '','placeholder'=>'Price']) !!}
                                                    @else
                                                    {!! Form::input('number', 'price', '', ['id'=>'price','class' => '','placeholder'=>'Price']) !!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                         </div>
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
                                        <div class="form-row">
                                            <div class="col-sm-4">
                                                <label>&nbsp;</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="value-field">
                                                    <input type="submit" style="width: 250px;" name="" value="Submit" class="submit-btn">
                                                    <a href="{{ url('/user/classifieds') }}">Cancel</a>
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
<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU"></script>-->
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/colorpicker/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/ionslider/ion.rangeSlider.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/ionslider/ion.rangeSlider.skinNice.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/timepicker/bootstrap-timepicker.min.css') }}">
<script src="{{ URL::asset('plugins/admin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('plugins/admin/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ URL::asset('plugins/admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ URL::asset('plugins/front/js/post_classified.js') }}"></script>

<script>
<?php if (Session::has('message')) { ?>
                                                                Notify.showMessage('<?php echo Session::get('message'); ?>', 'success');
<?php } ?>

                                                            $("#submitFrmUpdate").submit(function (event) {

                                                                event.preventDefault();
                                                                var stepFirstRequired = true;
                                                                $('.errorMsg').each(function () {
                                                                    $(this).remove();
                                                                });
                                                                $('.textRequired').each(function (index, value) {

                                                                    if ((parseInt($(this).attr('is_required')) == 1) && ($(this).val() == '')) {
                                                                        stepFirstRequired = false;
                                                                        $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");
                                                                    }
                                                                });
                                                                $('.timeRange').each(function (index, value) {
                                                                    var thisObj = $(this);
                                                                    var attrId = thisObj.attr('attribute_id');
                                                                    var fromTime = thisObj.val().replace(':', '').replace(':', '');
                                                                    var toTime = $('.to_time_' + attrId).val().replace(':', '').replace(':', '');
                                                                    console.log(fromTime, typeof toTime, 'time');
                                                                    if ((fromTime == '') && (parseInt($(thisObj).attr('is_required')) == 1)) {

                                                                        stepFirstRequired = false;
                                                                        $(thisObj).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
                                                                    } else if ((toTime == '') && (parseInt($(thisObj).attr('is_required')) == 1)) {

                                                                        stepFirstRequired = false;
                                                                        $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
                                                                    } else if ((thisObj.val() != '') && ($('.to_time_' + attrId).val() == '')) {
                                                                        stepFirstRequired = false;
                                                                        $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
                                                                    } else if ((thisObj.val() == '') && ($('.to_time_' + attrId).val() != '')) {
                                                                        stepFirstRequired = false;
                                                                        $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
                                                                    } else if ((fromTime != '') && (toTime != '') && (parseInt(fromTime) >= parseInt(toTime))) {

                                                                        stepFirstRequired = false;
                                                                        $($(this)).parent().after("<p class='error-message errorMsg '>" + 'From value should not be greater or equal to To value' + "</p>");
                                                                    }
                                                                });
                                                                $('.rangeDate').each(function (index, value) {
                                                                    var thisObj = $(this);
                                                                    var attrId = thisObj.attr('attribute_id');
                                                                    var fromDate = new Date($(thisObj).val());
                                                                    var toDate = new Date($('.toDate_' + attrId).val());
                                                                    console.log(fromDate, toDate);
                                                                    if ((fromDate == 'Invalid Date') && (parseInt($(thisObj).attr('is_required')) == 1)) {

                                                                        stepFirstRequired = false;
                                                                        $(thisObj).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
                                                                    } else if ((toDate == 'Invalid Date') && (parseInt($(thisObj).attr('is_required')) == 1)) {

                                                                        stepFirstRequired = false;
                                                                        $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
                                                                    } else if ((fromDate != 'Invalid Date') && (toDate == 'Invalid Date')) {

                                                                        stepFirstRequired = false;
                                                                        $(thisObj).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
                                                                    } else if ((toDate != 'Invalid Date') && (fromDate == 'Invalid Date')) {

                                                                        stepFirstRequired = false;
                                                                        $(thisObj).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
                                                                    } else if ((fromDate != 'Invalid Date') && (toDate != 'Invalid Date') && (fromDate > toDate)) {

                                                                        stepFirstRequired = false;
                                                                        $($(this)).parent().after("<p class='error-message errorMsg '>" + 'From value should not be greater or equal to To value' + "</p>");
                                                                    }
                                                                });
//                                                                if ($('.singleNumber').val() && $('.singleNumber').val() < 0) {
//                                                                    $('.singleNumber').after("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");
//                                                                    return false;
//                                                                }
                                                                $('.singleNumber').each(function (index, value) {
                                                                    if ((parseInt($(this).attr('is_required')) == 1) && ($(this).val() == '') || ($(this).val() < 0)) {
                                                                        $($(this)).after("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");
//                                stepFirstRequired = false;
                                                                        return false;
                                                                    }

                                                                });
                                                                $('.singleNumbernumeric').each(function (index, value) {
                                                                    if (($(this).val() != '') && (($(this).val() < 0) || ($(this).val().length < 10))) {
                                                                        $($(this)).after("<p class='error-message errorMsg '>" + 'The mobile no must be at least 10 characters.' + "</p>");
                                                                        stepFirstRequired = false;
                                                                        return false;
                                                                    }

                                                                });
//                                                                if ((typeof $('.singlecalendar').val() != 'undefined') && (parseInt($('.singlecalendar').val().length) != 4)) {
//                                                                    $('.singlecalendar').after("<p class='error-message errorMsg '>" + 'Invalid year' + "</p>");
//                                                                    return false;
//                                                                }

//                                                                if ((parseInt($('.singlecalendar').attr('is_required')) == 1) && ($('.singlecalendar').val() == '')) {
//                                                                    $('.singlecalendar').after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
//                                                                    return false;
//                                                                } else if (($('.singlecalendar').val().length != 0) && (parseInt($('.singlecalendar').val().length) != 4)) {
//                                                                    $('.singlecalendar').after("<p class='error-message errorMsg '>" + 'Invalid year' + "</p>");
//                                                                    return false;
//                                                                }
                                                                if ((typeof $('.singlecalendar').val() != 'undefined') && (parseInt($('.singlecalendar').attr('is_required')) == 1) && ($('.singlecalendar').val() == '')) {
                                                                    $('.singlecalendar').after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
                                                                    return false;
                                                                } else if ((typeof $('.singlecalendar').val() != 'undefined') && ($('.singlecalendar').val() != '') && (parseInt($('.singlecalendar').val().length) != 4)) {
                                                                    //($('.singlecalendar').val() != '')
                                                                    $('.singlecalendar').after("<p class='error-message errorMsg '>" + 'Invalid year' + "</p>");
                                                                    return false;
                                                                }
                                                                if (stepFirstRequired) {
                                                                    var stepSecondRequired = true;
                                                                    $('.divCheckBox').each(function (index, value) {
                                                                        var parentEach = $(this);
                                                                        var singleCheckBox = false;
                                                                        $('.inputCheckBox', value).each(function (i, v) {
                                                                            var childEach = $(this);
                                                                            if (parseInt($(childEach).attr('is_required')) == 1) {
                                                                                if ($(this).is(':checked')) {
                                                                                    singleCheckBox = true;
                                                                                }
                                                                            } else {
                                                                                singleCheckBox = true;
                                                                            }
                                                                        });
                                                                        if (!singleCheckBox) {
                                                                            stepSecondRequired = false;
                                                                            $(parentEach).after("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");
                                                                        }

                                                                    });
                                                                } else {
                                                                    stepSecondRequired = false;
                                                                }

                                                                if (stepSecondRequired) {
                                                                    stepthirdRequired = true;
                                                                    if ($('.emailValidation').length) {
                                                                        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                                                                        $('.emailValidation').each(function (index, value) {
                                                                            if (($(this).val().length != 0) && (!regex.test($(this).val()))) {
                                                                                stepthirdRequired = false;
                                                                                $($(this)).after("<p class='error-message errorMsg '>" + 'Invalid Email!' + "</p>");
                                                                            }
                                                                        });
                                                                    }
                                                                } else {
                                                                    stepthirdRequired = false;
                                                                }

                                                                if (stepthirdRequired) {
                                                                    $.ajax({
                                                                        url: root_url + '/user/classifieds/update',
                                                                        type: "POST", // Type of request to be send, called as method
                                                                        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                                                        contentType: false, // The content type used when sending data to the server.
                                                                        cache: false, // To unable request pages to be cached
                                                                        processData: false, // To send DOMDocument or non processed data file it is set to false
                                                                        success: function (data)   // A function to be called if request succeeds
                                                                        {

                                                                            if (data.status) {
                                                                                window.location.href = root_url + '/user' + data.url;
                                                                            } else {
                                                                                $.each(data.data, function (index, value) {
                                                                                    if (value.fields == 'attr_value_video') {

                                                                                        $('.attr_value_video').each(function (i, v) {
                                                                                            if (i == value.keys) {
                                                                                                var videoClassInput = $(this);
                                                                                                $(videoClassInput).after("<p class='error-message errorMsg '>" + value.message + "</p>");
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            }
                                                                            //console.log('Suc', data);
                                                                        },
                                                                        error: function (data) {

                                                                            var dataObj = JSON.parse(data.responseText);
                                                                            $('.errorMsg').each(function () {
                                                                                $(this).remove();
                                                                            });
//                                        dataObj["attrName"] = Array();

                                                                            $.each(dataObj, function (index, value) {

                                                                                var res = index.split(".");
                                                                                if (res[0] == 'attr_value_video') {
                                                                                    $('.attr_value_video').each(function (i, v) {
                                                                                        var videoClassInput = $(this);
                                                                                        if (i == res[1]) {
                                                                                            var msgEdited = value[0].replace('attr_value_video.', 'attribute video ').replace(/\d+/g, '');
                                                                                            var msgEdited = value[0].replace('validation.uploaded', 'Invalid video type').replace(/\d+/g, '');
                                                                                            $(videoClassInput).after("<p class='error-message errorMsg '>" + msgEdited + "</p>");
                                                                                        }

                                                                                    });
                                                                                }

                                                                            });
                                                                            $.each(dataObj, function (index, value) {

                                                                                if (index == 'image.0') {
                                                                                    index = 'classifiedInputFile'
                                                                                    value = "Image required minimum 3 MB."
                                                                                }
                                                                                if (index == 'description') {
                                                                                    index = 'editor1'
                                                                                }
                                                                                if (index == 'start_date') {
                                                                                    index = 'start_date1'
                                                                                }
                                                                                if (index == 'end_date') {
                                                                                    index = 'end_date1'
                                                                                }
                                                                                Notify.showMessageOld(index, value);
                                                                            });
                                                                        }
                                                                    });
                                                                }
                                                            });
                                                            $(function () {
                                                                BelongsToCommunities = [$.parseJSON('<?php echo json_encode($BelongsToCommunities); ?>')];
                                                                $.each(BelongsToCommunities[0], function (index, val) {
                                                                    if (index == <?php echo $result->parent_categoryid; ?>) {

                                                                        if (val) {
                                                                            //                console.log("Yes");
                                                                            //                                        $('.classified-s-e-date').addClass('hide');
                                                                            $('#end_date1').hide();
                                                                            $('.priceClassDiv').hide();
                                                                            $('#withCommunty').val(1);
                                                                            $('.classifiedIsFeatured').hide();
                                                                            $('.featured_classified').attr('disabled', true);
                                                                        } else {
                                                                            //$('.classified-s-e-date').removeClass('hide');
                                                                            $('#end_date1').show();
                                                                            $('.priceClassDiv').show();
                                                                            $('#withCommunty').val(0);
                                                                            $('.classifiedIsFeatured').show();
                                                                            $('.featured_classified').attr('disabled', false);
                                                                            //                console.log("No");
                                                                        }
                                                                    }
                                                                });
                                                                showStaticAttributes = [$.parseJSON('<?php echo json_encode($showStaticAttributes); ?>')];
                                                                $.each(showStaticAttributes[0], function (index, val) {
                                                                    console.log(<?php echo $result->parent_categoryid; ?>);
                                                                    if (index == <?php echo $result->parent_categoryid; ?>) {
                                                                        if (val) {
                                                                            //$('.sttcAttrbts').addClass("hide");
                                                                            $('.sttcAttrbts').removeClass("hide");
                                                                        } else {
                                                                            $('.sttcAttrbts').addClass("hide");
                                                                            //$('.sttcAttrbts').removeClass("hide");
                                                                        }
                                                                    }
                                                                });
                                                                $('#end_date').val('<?php echo date('m/d/Y', strtotime($result->end_date)); ?>');
                                                                stateCode = [$.parseJSON('<?php echo json_encode($stateCode); ?>')];
                                                                console.log(stateCode);
                                                                stateCode = [$.parseJSON('<?php echo json_encode($stateCode); ?>')];
                                                                stateCode[0][''] = '';
                                                                var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {
                                                                   types: ['(cities)'],
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
                                                                    //console.log(place.address_components);
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
                                                                            Notify.showMessage("Image could not be deleted.", 'warning');
                                                                        }

                                                                    }

                                                                })
                                                                return false;
                                                            });
</script>


@stop



