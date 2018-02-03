<style>
    #classifiedInputFile {
        margin-top: 6px;
    }
    .thumbnail{

        height: 40px;
        margin: 10px; 
        float: left;
    }
    #clear{
        display:none;
    }
    #result {
        border: 4px dotted #cccccc;
        display: none;
        float: left;
        margin:0 auto;
        margin-top: 5px;
        width: 100%;
    }
</style>
@extends('admin/layout/common')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Classified
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/admin/classifieds') }}">{{$modelTitle}}</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!--column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>              
                </div>

                <!-- /.box-header -->
                <!-- form start -->    

                {!! Form::model($result, array('action' => ["admin\\$controllerName@admin_update", $result->id], 'files' => true, 'id'=>'submitFrm')) !!}
                <div class="box-body">
                    <div class="form-group">
                        <?php
                        $disablecat = 'disabled="disabled"';
                        // dd($result->toarray());
                        ?>
                        <label for="exampleInputEmail1">Title</label>                  
                        {!! Form::input('text', 'title', (isset($result->title))?$result->title:null, ['id' => 'title','class' => 'form-control textRequired','placeholder'=>'Title Name']) !!}
                        <div class="error-message">{{$errors->first('title')}}</div>
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Category</label> 
                        <input type="hidden" value="{{(isset($result->parent_categoryid))?$result->parent_categoryid:''}}" class="form-control city" name="parent_categoryid"/>

                        <!--                        {!! Form::input('text', '', (isset($statename->name))?$statename->name:null, ['id'=>'statevalue','class' => 'form-control statevalue','placeholder'=>'State','readonly' => 'true']) !!}-->
                        {!! Form::select('parent_categoryid', $categories, (isset($result->parent_categoryid))?$result->parent_categoryid:'', ['placeholder' => 'Select Category', 'class' => 'form-control textRequired', $disablecat,'id' => 'parent_categoryid']) !!}
                        <div class="error-message">{{$errors->first('parent_categoryid')}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select SubCategory</label> 
                        <input type="hidden" value="{{(($result->category_id) && $result->category_id != 0)?$result->category_id:''}}" class="form-control city" name="category_id"/>

                        {!! Form::select('category_id', $subcategories, (($result->category_id) && $result->category_id != 0)?$result->category_id:'', ['placeholder' => 'Select SubCategory','class' => 'form-control textRequired', 'is_required'=>0, $disablecat,'id' => 'sub_categories']) !!}
                        <div class="error-message subcategoryerror">{{$errors->first('category_id')}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Attributes</label>         
                        <div id="attrName" class="attr_value_single">
                            <?php
                            $storAttrIds = [];
                            //  dd(($result1['classified_attribute']));
                            ?>
                            @foreach ($result1['classified_attribute'] as $val)
                            @if(in_array($val['attr_type_name'],['text','Url','Email','textarea','calendar','Drop-Down','Color','Time','Date','Numeric']))
                            <?php
                            $childValueDiv = '';
                            if ($val['attr_type_name'] == "Drop-Down" && $val['parent_value_id'] != 0) {
                                $childValueDiv = "childValueDiv_{$val['parent_attribute_id']}";
                            }
                            ?>
                            <div class="form-group {!!$childValueDiv!!}">
                                <label>{{ $val['name'] }}</label>
                                <input type="hidden" value="{{ $val['attr_type_name'] }}" name="attr_type_name[]">
                                <input type="hidden" value="{{ $val['attr_type_id'] }}" name="attr_type_id[]">
                                <input type="hidden" value="{{ $val['attribute_id'] }}" name="attr_ids[]">
                                <input type="hidden" value="{{ $val['parent_value_id'] }}" name="parent_value_id[]">
                                <input type="hidden" value="{{ $val['parent_attribute_id'] }}" name="parent_attribute_id[]">
                                <?php
                                $input_type = $val['attr_type_name'];
                                $is_required = $val['is_required'];
                                $size = $val['size'];

                                if ($input_type == "textarea") {
                                    ?>
                                    <textarea class="attr_value form-control textRequired textsize" is_required="{{ $is_required }}" is_numlength="{{$size}}" name="attr_value[]">{{ $val['attr_value'] }}</textarea> 
                                <?php } else if ($input_type == "Drop-Down" && $val['parent_value_id'] == 0) {
                                    ?>

                                    {!! Form::select('attr_value[]', $val['attr_AllValues'], $val['attr_value'], ['is_required'=> $is_required , 'placeholder' => 'select one','class' => 'form-control classForOnChange textRequired', 'attributeid' => $val['attribute_id']]) !!}

                                <?php } else if ($input_type == "Drop-Down" && $val['parent_value_id'] != 0) { ?>

                                    {!! Form::select('attr_value[]', $val['attr_AllValues'], $val['attr_value'], ['is_required'=> $is_required ,'class' => 'form-control']) !!}
                                <?php } else if ($input_type == "text") { ?>

                                    <input type="text" value="{{ $val['attr_value'] }}" is_required="{{ $is_required }}" is_numlength="{{$size}}" class="attr_value form-control textRequired textsize" name="attr_value[]">

                                <?php } else if ($input_type == "Url") { ?>

                                    <input type="text" value="{{ $val['attr_value'] }}" is_required="{{ $is_required }}" class="attr_value form-control textRequired urlValidation" name="attr_value[]">

                                <?php } else if ($input_type == "Number") { ?>

                                    <input type="number" value="{{ $val['attr_value'] }}" is_required="{{ $is_required }}" class="attr_value form-control textRequired" name="attr_value[]">

                                <?php } else if ($input_type == "Email") { ?>

                                    <input type="text" value="{{ $val['attr_value'] }}" is_required="{{ $is_required }}" class="attr_value form-control textRequired emailValidation" name="attr_value[]">

                                    <?php
                                } else if ($input_type == "Numeric") {

                                    if (strpos($val['attr_value'], ';')) {
                                        ?>
                                        <input type="text" value="{{ $val['attr_value'] }}" is_required="{{ $is_required }}" is_numlength="{{$size}}" class="attr_value form-control range_{{ $val['attribute_id'] }}" name="attr_value[]">
                                    <?php } else { ?>
                                        <input type="number" value="{{ $val['attr_value'] }}" is_required="{{ $is_required }}" is_numlength="{{$size}}" class="attr_value form-control textRequired singleNumber" name="attr_value[]">
                                    <?php } ?>



                                    <?php
                                } else if ($input_type == "calendar") {

                                    if (strpos($val['attr_value'], ';')) {
                                        ?>
                                        <input type="text" value="{{ $val['attr_value'] }}" is_required="{{ $is_required }}" class="attr_value form-control range_{{ $val['attribute_id'] }}" name="attr_value[]">
                                    <?php } else { ?>
                                        <input type="number" onkeypress="return isNumberKey(event)" is_required="{{ $is_required }}" value="{{ $val['attr_value'] }}" class="attr_value form-control textRequired singleNumber singlecalendar" name="attr_value[]">
                                    <?php } ?>



                                <?php } else if ($input_type == "Color") { ?>
                                    <div class="input-group my-colorpicker2 colorpicker-element" style="width: 24%;">
                                        <input type="text" is_required="{{ $is_required }}" value="{{ $val['attr_value'] }}" class="attr_value form-control textRequired" name="attr_value[]">
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
                                            <input placeholder="From Date" is_required="{{ $is_required }}" value="{{$dateVal[0]}}" attribute_id="{{ $val['attribute_id'] }}" class="datepicker from_date  rangeDate fromDate_{{ $val['attribute_id'] }}" type="text" value="" style="margin-right:8px;">
                                            <input placeholder="To Date" is_required="{{ $is_required }}" value="{{$dateVal[1]}}" attribute_id="{{ $val['attribute_id'] }}" class="datepicker to_date  toDate_{{ $val['attribute_id'] }}" type="text" value="">
                                            <input type="hidden" value="{{ $val['attr_value'] }}" class="fronAndToDate_{{ $val['attribute_id'] }}" name="attr_value[]">
                                        </div>
                                    <?php } else if ($val['attr_value'] == 'on') {
                                        ?>
                                        <div class="input-group">
                                            <input placeholder="From Date" is_required="{{ $is_required }}" value="" attribute_id="{{ $val['attribute_id'] }}" class="datepicker from_date  rangeDate fromDate_{{ $val['attribute_id'] }}" type="text" value="" style="margin-right:8px;">
                                            <input placeholder="To Date" is_required="{{ $is_required }}" value="" attribute_id="{{ $val['attribute_id'] }}" class="datepicker to_date  toDate_{{ $val['attribute_id'] }}" type="text" value="">
                                            <input type="hidden" value="{{ $val['attr_value'] }}" class="fronAndToDate_{{ $val['attribute_id'] }}" name="attr_value[]">
                                        </div>
                                    <?php } else { ?>
                                        <div class="input-group">
                                            <input type="text" is_required="{{ $is_required }}" value="{{ $val['attr_value'] }}" class="datepicker attr_value form-control  singleDate_{{ $val['attribute_id'] }}" name="attr_value[]">
                                        </div>
                                    <?php } ?>


                                    <?php
                                } else if ($input_type == "Time") {

                                    if (strpos($val['attr_value'], ';')) {
                                        $timeVal = explode(';', $val['attr_value']);
                                        ?>

                                        <div class="input-group bootstrap-timepicker" style="width: 24%;">
                                            <input type="text" is_required="{{ $is_required }}" value="{{ $timeVal[0] }}" attribute_id="{{ $val['attribute_id'] }}" class="timepicker timeRange attr_value from_time_{{ $val['attribute_id'] }} form-control" >
                                            <div class="input-group-addon" style="width: 21%;">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div> </br>
                                        <div class="input-group bootstrap-timepicker" style="width: 24%;">
                                            <input type="text" is_required="{{ $is_required }}" value="{{ $timeVal[1] }}" attribute_id="{{ $val['attribute_id'] }}" class="timepicker attr_value to_time_{{ $val['attribute_id'] }} form-control">
                                            <div class="input-group-addon" style="width: 21%;">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                        <input type="hidden" name="attr_value[]" class="fromAndToTime_{{ $val['attribute_id'] }}" value="{{ $val['attr_value'] }}">
                                    <?php } else if ($val['attr_value'] == 'on') {
                                        ?>

                                        <div class="input-group bootstrap-timepicker" style="width: 24%;">
                                            <input type="text" is_required="{{ $is_required }}" value="" attribute_id="{{ $val['attribute_id'] }}" class="timepicker timeRange attr_value from_time_{{ $val['attribute_id'] }} form-control" >
                                            <div class="input-group-addon" style="width: 21%;">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div> </br>
                                        <div class="input-group bootstrap-timepicker" style="width: 24%;">
                                            <input type="text" is_required="{{ $is_required }}" value="" attribute_id="{{ $val['attribute_id'] }}" class="timepicker attr_value to_time_{{ $val['attribute_id'] }} form-control">
                                            <div class="input-group-addon" style="width: 21%;">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                        <input type="hidden" name="attr_value[]" class="fromAndToTime_{{ $val['attribute_id'] }}" value="{{ $val['attr_value'] }}">
                                    <?php } else { ?>
                                        <div class="input-group bootstrap-timepicker" style="width: 24%;">
                                            <input type="text" is_required="{{ $is_required }}" value="{{ $val['attr_value'] }}" class="timepicker attr_value form-control" name="attr_value[]">
                                            <div class="input-group-addon" style="width: 21%;">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    <?php } ?>


                                <?php } ?>
                            </div>
                            @endif

                            <?php /*
                              @if(in_array($val->attr_type_name,['File']))
                              <div class="form-group">
                              <?php
                              $input_type = $val->attr_type_name;
                              if ($input_type == "File") {
                              ?>

                              <label>{{ $val->name }}</label>
                              <input type="hidden" value="{{ $val->attr_type_name }}" name="attr_type_name_file[]">
                              <input type="hidden" value="{{ $val->attr_type_id }}" name="attr_type_id_file[]">
                              <input type="hidden" value="{{ $val->attribute_id }}" name="attr_ids_file[]">
                              <span><a href="{!! asset("/upload_images/attribute_values/file/$val->classified_id/$val->attribute_id/$val->attr_value") !!}">{!! asset("/upload_images/attribute_values/file/$val->classified_id/$val->attribute_id/$val->attr_value") !!}</a> </span>
                              <input type="file" value="" class="attr_value" style="width:24%;" name="attr_value_file[]">
                              <input type="hidden" value="{{$val->attr_value}}" class="attr_value form-control" style="width:24%;" name="attr_value_file_old[]">

                              <?php } ?>
                              </div>
                              @endif
                             */ ?>


                              @if(in_array($val['attr_type_name'],['Video']))
                              <div class="form-group">
                              <?php
                              $input_type = $val['attr_type_name'];
                              if ($input_type == "Video") {
                              ?>

                              <label>{{ $val['name'] }}</label>
                              <input type="hidden" value="{{ $val['attr_type_name'] }}" name="attr_type_name_video[]">
                              <input type="hidden" value="{{ $val['attr_type_id'] }}" name="attr_type_id_video[]">
                              <input type="hidden" value="{{ $val['attribute_id'] }}" name="attr_ids_video[]">
                              <span><a href="{!! asset("/upload_images/attribute_values/video/$val[classified_id]/$val[attribute_id]/$val[attr_value]") !!}">{!! $val['attr_value'] !!}</a> </span>
                              <input type="file" value="" class="attr_value_video attr_value videotypetxt" style="width:24%;" name="attr_value_video[]">
                              <input type="hidden" value="{{$val['attr_value']}}" class="attr_value form-control" style="width:24%;" name="attr_value_video_old[]">

                              <?php } ?>
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
                                <div class="box box-default" style="border:none;">
                                    <div class="box-footer" style="border: none;">
                                        <strong> {!! $val[0]['name'] !!}</strong>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body no-padding">
                                        <ul class="users-list clearfix">
                                            <?php foreach ($val as $k => $v) { ?>
                                                <li class="liImageGallery" style="">
                                                    <i classi_id="{{$v['classified_id']}}" file_name="{{$v['attr_value']}}" class="fa fa-close"></i>
                                                    <img style="width: 50px;height:50px;" src="{!! asset("/upload_images/attribute_values/image-gallery/$v[classified_id]/$v[attribute_id]/$v[attr_value]") !!}" alt="" >
                                                         <input type="hidden" is_required="{{ $is_required }}" value="{{$v['attr_value']}}" class="attr_value form-control cloneId_{{ $v['attribute_id'] }}" style="width:24%;" name="attr_value_image_old[{{$v['attribute_id']}}][]">

                                                </li>
                                            <?php } ?> 
                                        </ul>
                                        <!-- /.users-list -->
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer" style="border:none;">
                                        <input type="hidden" value="{{ $val[0]['attr_type_name'] }}" name="attr_type_name_image">
                                        <input type="hidden" value="{{ $val[0]['attr_type_id'] }}" name="attr_type_id_image">
                                        <input type="hidden" value="{{ $val[0]['attribute_id'] }}" name="attr_ids_image[]">
                                        <input type="file" value="" class="attr_value image_field" style="width:24%;margin-bottom:5px;" name="attr_value_image[{{$val[0]['attribute_id']}}][]">
                                        <span class="btn btn-default"><a forclonelink="{{ $val[0]['attribute_id'] }}" href="javascript:void(0)" onclick="add_imageGallery(this)">Add more image</a></span>
                                    </div>
                                    <!-- /.box-footer -->
                                </div>
                                <!--/.box -->
                                <!--</div>-->
                            <?php } ?>



                            @if(isset($result1['multi_select']) && !empty($result1['multi_select']))
                            @foreach ($result1['multi_select'] as $val)
                            <?php $is_required = $val['is_required']; ?>
                            <div class="form-group divCheckBox">
                                <label>{{ $val['name'] }}</label>
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
                            @endforeach
                            @endif

                            @if(isset($result1['Radio-button']) && !empty($result1['Radio-button']))
                            @foreach ($result1['Radio-button'] as $val)
                            <?php $is_required = $val['required']; ?>
                            <div class="form-group">
                                <label>{{ $val['name'] }}</label>
                                <input type="hidden" value="{{ $val['attr_type_name_radio'] }}" name="attr_type_name_radio">
                                <input type="hidden" value="{{ $val['attr_type_id_radio'] }}" name="attr_type_id_radio">
                                <input type="hidden" value="{{ $val['attr_ids_radio'] }}" name="attr_ids_radio[]">
                                @foreach ($val->attr_AllValues as $k1 => $v1)
                                <input type="radio" is_required="{{ $is_required }}" value="{{ $k1 }}" @if($k1 == $val->attr_value)checked @endif class="attr_value" name="attr_value_radio[]"> {{ $v1 }}
                                       @endforeach
                            </div>
                            @endforeach
                            @endif

                        </div>

                    </div>

                    <div class="form-group pricehide">
                        <label for="exampleInputEmail1">Price ($)</label>
                        {!! Form::input('number', 'price', (isset($result->price) && ($result->price != 0))?$result->price:'', ['id'=>'','class' => 'form-control','min' => 0,'placeholder'=>'Price']) !!}
                        <div class="error-message">{{$errors->first('price')}}</div>
                    </div> 

                    <div class="form-group product_code hide" id="editproductcode">
                        <label for="exampleInputEmail1">Product code</label>   

                        {!! Form::input('text', 'product_code', (isset($result->product_code))?$result->product_code:null, ['id' => 'product_code','class' => 'form-control product_code ', 'placeholder'=>'Product Code']) !!}
                        <div class="error-message">{{$errors->first('product_code')}}</div>
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Classified Description</label>                  
                        {!! Form::textarea('description', (isset($result->description))?$result->description:null, ['id' => 'editor1','class' => 'form-control','placeholder'=>' Classified Description','rows'=>7]) !!}

                        <div class="error-message">{{$errors->first('description')}}</div>
                    </div> 

                    <?php /*
                      <div class="form-group">
                      <label class="col-sm-2 control-label">Image Upload</label>
                      <div class="col-sm-10">
                      <input type="file" name="image[]" multiple id="classifiedInputFile">
                      @if(count(isset($result->classified_image)) > 0)
                      <output id="result" style="display: block">
                      @foreach($result->classified_image as $key => $single)
                      <div>
                      <img src="{!! asset('/upload_images/classified/30px/'.$result->id.'/'.$single['name']) !!}" title="preview image" class="thumbnail" />
                      </div>
                      @endforeach
                      </output>
                      @else
                      <output id="result"></output>
                      @endif
                      </div>
                      </div>
                     */ ?>


                    <!-- new -->
                    <div class="form-group">                         
                        <label class="col-sm-2 control-label">Upload Images</label>
                        <div class="col-sm-10">
                            <div class="input-append">
                                @foreach ($result->classified_image as $attachment => $single) 
                                <div class="advertisement_image" id="advertisement_image_<?php echo $single->id; ?>">
                                    <div class="default-delete">
                                        <a class="btn btn-default btn-close delete_image" href="{!! url('admin/classifieds/delete-attachment'); !!}" data-id="{!! $single->id !!}" title="Delete"><i class="fa fa-remove"></i></a>
                                    </div>
                                    <img src="{!! asset('/upload_images/classified/30px/'.$result->id.'/'.$single['name']) !!}" title="preview image" class="thumbnail" />

                                </div>
                                @endforeach
                                <br/>
                                <span class="more-images-button btn btn-default"><a href="javascript:void(0)" onclick="add_more()">Add more image</a></span>
                                <div class="more-images" id="more_images"></div>
                                <div id="classifiedInputFile"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">Location</label>      
                        <input type="hidden" value="0" id="withCommunty" name="withCommunty" />
                        <input type="hidden" value="0" id="withinformation" name="withinformation" />
                        <input type="hidden" value="{{$result->lat}}" id="lat" name="lat" />
                        <input type="hidden" value="{{$result->lng}}" id="lng" name="lng" />
                        {!! Form::input('text', 'location', (isset($result->location))?$result->location:null, ['class' => 'form-control staticattribute','placeholder'=>'Location Name','id'=>'address']) !!}
                        <div class="error-message">{{$errors->first('location')}}</div>
                    </div> 

                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">State</label>
                        {!! Form::input('text', '', (isset($statename->name))?$statename->name:null, ['id'=>'statevalue','class' => 'form-control statevalue staticattribute','placeholder'=>'State','readonly' => 'true']) !!}
                        {!! Form::select('state_id', $state, (isset($result->state_id))?$result->state_id:null, ['id' => 'stateid','placeholder' => 'Select State', 'class' => 'form-control ']) !!}
                        <div class="error-message">{{$errors->first('state_id')}}</div>
                    </div>
                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">City</label>   
                        <input type="hidden" value="{{(isset($suburb->City))?$suburb->City:null}}" class="form-control city" name="subregions_id"/>
                        {!! Form::input('text', 'city', (isset($suburb->City))?$suburb->City:null, ['id'=>'subregion_id','class' => 'form-control subregion_id city staticattribute','placeholder'=>'Select City','readonly' => 'true']) !!}

                        <div class="error-message">{{$errors->first('subregions_id')}}</div>
                    </div>
                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">PinCode</label>                  
                        {!! Form::input('text', 'pincode', (isset($result->pincode))?$result->pincode:null, ['id'=>'pincode','class' => 'form-control staticattribute ','placeholder'=>'PinCode','readonly' => 'true']) !!}
                        <div class="error-message">{{$errors->first('pincode')}}</div>
                    </div> 
                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">Contact Name</label>                  
                        {!! Form::input('text', 'contact_name', (isset($result->contact_name))?$result->contact_name:null, ['id'=>'contact_name','class' => 'form-control staticattribute ','placeholder'=>'Contact Name']) !!}
                        <div class="error-message">{{$errors->first('contact_name')}}</div>
                    </div> 
                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">Contact Email</label>                  
                        {!! Form::input('text', 'contact_email', (isset($result->contact_email))?$result->contact_email:null, ['id'=>'contact_email','class' => 'form-control  contact_email emailValidation staticattribute','placeholder'=>'Contact Email']) !!}
                        <div class="error-message">{{$errors->first('contact_email')}}</div>
                    </div> 
                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">Contact Mobile</label>                  
                        {!! Form::input('text', 'contact_mobile', (isset($result->contact_mobile))?$result->contact_mobile:null, ['id'=>'contact_mobile','class' => 'form-control contact_mobile  staticattribute','placeholder'=>'Contact Mobile','min'=>'0']) !!}
                        <div class="error-message">{{$errors->first('contact_mobile')}}</div>
                    </div>  
                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">Website</label>                  
                        {!! Form::input('text', 'website', (isset($result->website))?$result->website:null, ['id'=>'website','class' => 'form-control staticattribute','placeholder'=>'Website']) !!}
                        <div class="error-message">{{$errors->first('website')}}</div>
                    </div> 

                    <div class=" form-group classifiedIsFeatured sttcAttrbts isFeaturedCheckboxDiv">
                        <div class="checkbox1">
                            <label>

                                {!! Form::checkbox('featured_classified', '1', ($result  && $result->featured_classified != 0)? true:null, ['class' => 'featured_classified']) !!} Is Featured Classified

                            </label>
                        </div>
                    </div>
                    <div class=" form-group">
                        <div class="checkbox1">
                            <label>
                                {!! Form::checkbox('status', '1', ($result  && $result->status != 0)? true:null) !!}  Status
                            </label>
                        </div>
                    </div>
                    <div class="form-group classified-s-e-date sttcAttrbts">

                        <label class="pull-left"> Select Date:</label>
                        <div class="col-sm-5">
                            <div class="input-group date" id="start_date1">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="start_date" name="start_date" value="<?php echo (isset($result->start_date) ? date('m/d/Y', strtotime($result->start_date)) : null); ?>"  originalDate="<?php echo (isset($result->start_date) ? date('m-d-Y', strtotime($result->start_date)) : null); ?>" placeholder="Start Date" class="form-control datepicker startdate pull-right">
                            </div>
                        </div>

                        <div class="col-sm-5 <?php echo $isCommunity; ?>">
                            <div class="input-group date" id="end_date1">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="end_date" name="end_date" value="<?php echo (isset($result->end_date)) ? date('m/d/Y', strtotime($result->end_date)) : null ?>" placeholder="End Date" class="form-control enddate datepicker1 pull-right">
                            </div>
                        </div>


                        <!-- /.input group -->

                    </div>
                </div>
                <!-- /.box-body -->


                <div class="box-footer">
                    <input type="hidden" value="{{ $result->id }}" name="id">
                    <button type="submit" class="btn btn-primary">Submit</button> 
                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href="" onclick="javascript:history.go(-1);">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.box -->

    </div>
    <!--/.col -->        
    <!--</div>-->
    <!-- /.row -->
</section>
<!-- /.content -->	

@stop

@section('scripts')

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU"></script>
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/colorpicker/bootstrap-colorpicker.min.css') }}" />
<script src="{{ URL::asset('plugins/admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/timepicker/bootstrap-timepicker.min.css') }}" />
<script src="{{ URL::asset('plugins/admin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script>

                        $(function () {
                            var p_category_name = $("option:selected", '#parent_categoryid').text();
                            var name = '<?php echo Redis::get('Halal Products'); ?>'
                            //console.log(name);
                            p_category_name = p_category_name.trim();
                            name = name.trim();
                            if (p_category_name == name)
                            {
                                $('#editproductcode').removeClass('hide');
                            }
                            BelongsToCommunities = [$.parseJSON('<?php echo json_encode($BelongsToCommunities); ?>')];
                            showStaticAttributes = [$.parseJSON('<?php echo json_encode($showStaticAttributes); ?>')];
                            showStaticAttributes = [$.parseJSON('<?php echo json_encode($showStaticAttributes); ?>')];
                            communities_informationarr = [$.parseJSON('<?php echo json_encode($communities_informationarr); ?>')];
                            $.each(BelongsToCommunities[0], function (index, val) {
                                if (index == <?php echo $result1['parent_categoryid']; ?>) {

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

                            $.each(showStaticAttributes[0], function (index, val) {
                                if (index == <?php echo $result1['parent_categoryid']; ?>) {
                                    if (val) {
                                        //$('.sttcAttrbts').addClass("hide");
                                        $('.sttcAttrbts').removeClass("hide");
                                        $('.staticattribute').addClass("staticattributevalidation");
                                    } else {
                                        $('.sttcAttrbts').addClass("hide");
                                        $('.staticattribute').removeClass("staticattributevalidation");

                                        //$('.sttcAttrbts').removeClass("hide");
                                    }
                                }
                            });

                            $.each(communities_informationarr[0], function (index, val) {
                                if (val['id'] == <?php echo $result1['parent_categoryid']; ?>) {

                                    if (val['belong_to_community'] == 1 || val['show_on_info_area'] == 1) {
                                        $('#sub_categories').attr("is_required", "0");
                                        $(".isFeaturedCheckboxDiv").hide()
                                    } else {
                                        $('#sub_categories').attr("is_required", "1");
                                        //$(".isFeaturedCheckboxDiv").show()
                                    }
                                }
                            });


                            $('#end_date').val('<?php echo date('m/d/Y', strtotime($result1['end_date'])); ?>');
                            stateCode = [$.parseJSON('<?php echo json_encode($stateCode); ?>')];
<?php /*
  foreach ($result->classified_attribute as $val) {

  if (($val['attr_type_name'] == 'Numeric' || $val['attr_type_name'] == 'calendar') && (strpos($val['attr_value'], ';'))) {

  $vv = explode(';', $val['attr_value']);
  $aa = array_values($val['attr_AllValuesNumeric']);
  //        dd($val['attribute_id']);
  ?>
  $(".range_" + {{ $val['attribute_id'] }}).ionRangeSlider({
  min: {{$aa[0]}},
  max: {{$aa[1]}},
  from: {{ $vv[0] }},
  to: {{ $vv[1] }},
  type: 'double',
  step: 1,
  prefix: "",
  prettify: false,
  hasGrid: true
  });
  <?php
  }

  if (($val['attr_type_name'] == 'Date')) {
  if ((strpos($val['attr_value'], ';'))) {
  $vv = explode(';', $val['attr_value']);
  ?>
  $(".fromDate_{{ $val['attribute_id'] }}").datepicker("update", '{{$vv[0]}}');
  $(".toDate_{{ $val['attribute_id'] }}").datepicker("update", '{{$vv[1]}}');
  <?php } else {
  ?>
  $(".singleDate_{{ $val['attribute_id'] }}").datepicker("update", '{{$val['attr_value']}}');
  <?php
  }
  }
  } */
?>
                        });
                        jQuery(document).ready(function () {
                            //var html = '<div style="margin: 5px 0 5px 0;" id="image_0"><div class="img_id_0"></div><div class="file-label"><input type="file" onchange="" id="img_id_0" value="" class="addedInput blue image_field textRequired" name="image[0]"></div></div>';
                            //jQuery('#more_images').append(html);
                        });
//                                var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});
//                                google.maps.event.addListener(autocomplete, 'place_changed', function () {
//                                var place = autocomplete.getPlace();
//                                        document.getElementById('lat').value = place.geometry.location.lat();
//                                        document.getElementById('lng').value = place.geometry.location.lng();
//                                        console.log(place.address_components);
//                                });


                        /* For hide Start Date picker */
                        var p_category_name = $("option:selected", '#parent_categoryid').val();
                        if (p_category_name.length > 0)
                        {
                            BelongsToCommunities = [$.parseJSON('<?php echo json_encode($BelongsToCommunities); ?>')];
                            communities_informationarr = [$.parseJSON('<?php echo json_encode($communities_informationarr); ?>')];
                            var flags = 0;

                            $.each(BelongsToCommunities[0], function (index, val) {
                                if (p_category_name == index && val == 1)
                                {
                                    flags = 1;
                                }
                            })

                            $.each(communities_informationarr[0], function (index, val) {
                                if (val.id == p_category_name && val.show_on_info_area == 1)
                                {
                                    flags = 1;
                                }
                            })

                            if (flags == 1)
                            {
                                $(".classified-s-e-date").hide();
                                $(".classified-s-e-date").css({"display": "none"});
                                $(".pricehide").hide();
                                            $(".pricehide").css({"display": "none"});
                            } else if (flags == 0)
                            {
                                $(".classified-s-e-date").show();
                                $(".classified-s-e-date").css({"display": "block"});
                                $(".pricehide").show();
                                            $(".pricehide").css({"display": "block"});
                            }
                        }

                        $("#parent_categoryid").on("change", function () {
                            var p_category_name = $("option:selected", '#parent_categoryid').val();
                            BelongsToCommunities = [$.parseJSON('<?php echo json_encode($BelongsToCommunities); ?>')];
                            communities_informationarr = [$.parseJSON('<?php echo json_encode($communities_informationarr); ?>')];
                            var flags = 0;

                            $.each(BelongsToCommunities[0], function (index, val) {
                                if (p_category_name == index && val == 1)
                                {
                                    flags = 1;
                                }
                            })

                            $.each(communities_informationarr[0], function (index, val) {
                                if (val.id == p_category_name && val.show_on_info_area == 1)
                                {
                                    flags = 1;
                                }
                            })

                            if (flags == 1)
                            {
                                $(".classified-s-e-date").hide();
                                $(".classified-s-e-date").css({"display": "none"});
                                $(".pricehide").hide();
                                            $(".pricehide").css({"display": "none"});
                            } else if (flags == 0)
                            {
                                $(".classified-s-e-date").show();
                                $(".classified-s-e-date").css({"display": "block"});
                                $(".pricehide").show();
                                            $(".pricehide").css({"display": "block"});
                            }

                            //var p_category_name = $('#parent_categoryid').text();

                        })

                        /* Hide Start Date picker */




                        $(function () {
                            stateCode = [$.parseJSON('<?php echo json_encode($stateCode); ?>')];
                            stateCode[0][''] = '';
                        });
                        var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {
                            types: [],
                            componentRestrictions: {country: "au"}});
                        google.maps.event.addListener(autocomplete, 'place_changed', function () {
                            var place = autocomplete.getPlace();
                            document.getElementById('lat').value = place.geometry.location.lat();
                            document.getElementById('lng').value = place.geometry.location.lng();
                            //console.log(place.address_components);

                            var place = autocomplete.getPlace();
                            for (var i = 0; i < place.address_components.length; i++) {
                                var addressType = place.address_components[i].types[0];
//                                            console.log(addressType);
                                if (addressType == 'administrative_area_level_1') {
                                    var gStateId = place.address_components[i]['short_name'];
                                    var state = place.address_components[i]['long_name'];
                                    $('#stateid').val(stateCode[0][gStateId]);
                                    $('#statevalue').val(state);
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
                        $(document).on("change", "#classifiedInputFile", function (event) {
                            var files = event.target.files; //FileList object
                            var output = document.getElementById("result");
                            for (var i = 0; i < files.length; i++) {
                                var file = files[i];
                                //Only pics
                                if (file.type.match('image.*')) {
                                    if (this.files[0].size < 2097152) {
                                        var picReader = new FileReader();
                                        picReader.addEventListener("load", function (event) {
                                            var picFile = event.target;
                                            var div = document.createElement("div");
                                            div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                                                    "title='preview image'/>";
                                            output.insertBefore(div, null);
                                        });
                                        //Read the image
                                        $('#clear, #result').show();
                                        picReader.readAsDataURL(file);
                                    } else {
                                        alert("Image Size is too big. Minimum size is 2MB.");
                                        $(this).val("");
                                    }
                                } else {
                                    alert("You can only upload image file.");
                                    $(this).val("");
                                }
                            }
                        });
                        $("#submitFrm").submit(function (event) {
//console.log($('#submitFrm').serialize());

                            //$("#editor1").text($(".cke_wysiwyg_frame").contents().find("body p").html());
                            console.log($(".cke_wysiwyg_frame").contents().find("body p").html())
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

                            $('.staticattributevalidation').each(function (index, value) {

                                //if ((parseInt($(this).attr('is_required')) == 1) && ($(this).val() == '')) {
                                if (($(this).val() == '')) {
                                    stepFirstRequired = false;
                                    $($(this)).after("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");
//                                                Notify.showMessageForClass(index, 'value');
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
//                        if ($('.singleNumber').val() && $('.singleNumber').val() < 0) {
//                                $('.singleNumber').after("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");
//                                return false;
//                        }
                            var f = 0;
                            $('.singleNumber').each(function (index, value) {
                                if ((parseInt($(this).attr('is_required')) == 1) && ($(this).val() == '') || ($(this).val() < 0)) {
                                    $($(this)).after("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");
//                                stepFirstRequired = false;
                                    // return false;
                                    f = 1;
                                }

                                if ($(this).attr('is_numlength') > 0)
                                {
                                    //console.log('yes');
                                    if ($(this).val().length > parseInt($(this).attr('is_numlength'))) {
                                        $($(this)).after("<p class='error-message errorMsg '>" + 'Maximum ' + parseInt($(this).attr('is_numlength')) + ' Characters are allowed' + "</p>");
                                        stepFirstRequired = false;
                                        f = 1;
                                        // return false;
                                    }
                                }

                            });

                            $('.textsize').each(function (index, value) {
                                //alert("yes");
                                if ($(this).attr('is_numlength') > 0)
                                {
                                    console.log($(this).attr('is_numlength'));
                                    if ($(this).val().length > parseInt($(this).attr('is_numlength'))) {
                                        $($(this)).after("<p class='error-message errorMsg '>" + 'Maximum ' + parseInt($(this).attr('is_numlength')) + ' Characters are allowed' + "</p>");
                                        stepFirstRequired = false;
                                        f = 1;
                                        // return false;
                                    }
                                }


                            });
                            if (f)
                            {
                                return false;
                            }

                            $('.singleNumbernumeric').each(function (index, value) {
                                if (($(this).val() != '') && (($(this).val() < 0) || ($(this).val().length < 10))) {
                                    $($(this)).after("<p class='error-message errorMsg '>" + 'The mobile no must be at least 10 characters.' + "</p>");
                                    stepFirstRequired = false;
                                    return false;
                                }

                            });
//                                if ((typeof $('.singlecalendar').val() != 'undefined') && (parseInt($('.singlecalendar').val().length) != 4)) {
//                        $('.singlecalendar').after("<p class='error-message errorMsg '>" + 'Invalid year' + "</p>");
//                                return false;
//                        }
                            ///console.log($('.singlecalendar').val(), typeof $('.singlecalendar').val());
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
                                        if ($(this).val() != '')
                                        {
                                            if (!regex.test($(this).val())) {
                                                stepthirdRequired = false;
                                                $($(this)).after("<p class='error-message errorMsg '>" + 'Invalid Email!' + "</p>");
                                            }
                                        }
                                    });
                                }
                            } else {
                                stepthirdRequired = false;
                            }
//                             stepthirdRequired = false;
                            if (stepthirdRequired) {
                                $.ajax({
                                    url: root_url + '/admin/classifieds/update',
                                    type: "POST", // Type of request to be send, called as method
                                    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                    contentType: false, // The content type used when sending data to the server.
                                    cache: false, // To unable request pages to be cached
                                    processData: false, // To send DOMDocument or non processed data file it is set to false
                                    success: function (data)   // A function to be called if request succeeds
                                    {

                                        if (data.status) {
                                           window.location.href = root_url + '/admin/' + data.url;
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
                        var count = 0;
                        function add_more(str) {
                            var html = '<div style="margin-top: 5px;" id="image_' + count + '"><div class="img_id_' + count + '"></div><input type="file" id="img_id_' + count + '" value="" class="addedInput blue image_field textRequired" name="image[' + count + ']"><a href="javascript:void(0)" onclick="remove_image(' + count + ')" class="remove-img">X</a></div>';
                            jQuery('#more_images').append(html);
                            count++;
                        }
                        function remove_image(strrm) {
                            //if (count > 1) {
                            jQuery('#image_' + strrm + '').remove();
                            //count--;
                            //}
                        }

                        function isNumberKey(evt) {
                            var charCode = (evt.which) ? evt.which : event.keyCode
                            if (charCode > 31 && (charCode < 48 || charCode > 57))
                                return false;
                            return true;
                        }
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
                        $('body').on('focus', ".datepicker", function () {
                            $(this).datepicker();
                        });
                        function add_imageGallery(thisObj) {
                            var cloneId = $(thisObj).attr('forclonelink');
                            var html = '<div class="input_repeat"><input type="file" value="" class="attr_value textRequired image_field cloneId_' + cloneId + '" style="width: 24%;margin-bottom:5px;" name="attr_value_image[' + cloneId + '][]"><i class="fa fa-close"></i></div>';
                            $(thisObj).parent().before(html);
                        }
                        $(document).on("change", ".videotypetxt", function (event) {
                            var ext = $(this).val().split('.').pop().toLowerCase();
                            if ($.inArray(ext, ['mpeg', 'mp4', 'mov', 'wmv']) == -1) {
                                Notify.showMessage("Please select a valid video type, mp4,mov,wmv", 'warning');
                                $(this).val("");
                                //return false;
                            }
                        });
                        //         $(document).on("change", ".image_field", function (event) {
                        // var ext = $(this).val().split('.').pop().toLowerCase();
                        //         if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == - 1) {
                        // Notify.showMessage("Please select a valid image.", 'warning');
                        //         $(this).val("");
                        //         //return false;
                        // }
                        // });

                        $(document).on("change", ".image_field", function (event) {
                            if (typeof (FileReader) != "undefined") {
                                var dvPreview = $("." + $(this).attr('id'));
                                dvPreview.html("");
                                dvPreview.removeAttr("");
                                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                                $($(this)[0].files).each(function () {
                                    var file = $(this);
                                    var ext = file[0].name.split('.').pop().toLowerCase();
                                    if($.inArray(ext, ['gif','png','jpg','jpeg']) != -1) {
                                        dvPreview.css({
                                            'height': '110px',
                                            'width': '110px',
                                            'border': '1px solid black',
                                            'padding': '4px',
                                            'margin-bottom': '3px'
                                        });
                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                            var img = $("<img />");
                                            img.attr("style", "height:100px;width: 100px");
                                            img.attr("margin-bottom", "4px");
                                            img.attr("src", e.target.result);
                                            dvPreview.append(img);
                                        }
                                        reader.readAsDataURL(file[0]);
                                    } else {
                                        Notify.showMessage("Image must have an extension of .jpeg, .jpg, or .png", 'warning');
                                        dvPreview.html("");
                                        return false;
                                    }
                                });
                            } else {
                                alert("This browser does not support HTML5 FileReader.");
                            }
                        });
                        $(".my-colorpicker2").colorpicker();
                        $(".timepicker").timepicker({
                            showInputs: false,
                            showSeconds: true,
                            maxHours: 24,
                            showMeridian: false,
                            defaultTime: false,
                        });
                        $('.datetimepicker2').datetimepicker();
                        $(function () {
                            var originaldate = $('#start_date').attr('originaldate');
                            //$('.datepicker').datepicker('update', originaldate);
                        });
                        $(function () {



                        });
                        $('#start_date').datepicker({minDate: 0}).on("input change", function (e) {
                            if ($('.featured_classified').is(":checked"))
                            {

                                var day = parseInt(Feacture_Classified_Day);
                            } else
                            {
                                //var day = 60;
                                var day = parseInt(Unfeacture_Classified_Day);
                            }

                            var date2 = $('#start_date').datepicker('getDate');
                            var rMax = new Date(date2.getFullYear(), date2.getMonth(), date2.getDate() + day);
                            //alert(rMax);
//    $('#end_date').datepicker('setDate', rMax);
                            var strDateTime = (rMax.getMonth() + 1) + "/" + rMax.getDate() + "/" + rMax.getFullYear();
                            if (strDateTime != 'NaN/NaN/NaN') {
                                $('#end_date').val(strDateTime);
                            } else {
                                $('#end_date').val('');
                            }

                        });
                        $("#stateid").css("display", "none");

<?php
$classified_attribute = json_encode($result1['classified_attribute']);
?>

                        var classified_attribute = <?php echo $classified_attribute; ?>

                        $.each(classified_attribute, function (index, value) {

                            if ((value['attr_type_name'] == 'Numeric' || value['attr_type_name'] == 'calendar') && (value['attr_value'].indexOf(';'))) {
                                var vv = value['attr_value'].split(';');
                                var aa = [];
                                $.each(value['attr_AllValuesNumeric'], function (i, v) {
                                    aa.push(v);
                                });
                                console.log(aa);
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

//            if (value['attr_type_name'] == 'Date') {
//                
//                if(value['attr_value'].indexOf(';') != -1){
//                    var vv = value['attr_value'].split(';');
//                    $(".fromDate_"+value['attribute_id']).datepicker("update", vv[0]);
//                    $(".toDate_"+value['attribute_id']).datepicker("update", vv[1]);
//
//                } else {
//                    console.log(value['attribute_id']);
//                    $(".singleDate_"+value['attribute_id']).datepicker("update", value['attr_value']);
//                }
//            }
                        });
</script>
@stop