<style>
    .error-message{color:#dd4b39;}
    .message{color:rgb(60, 141, 188);}
    .sel-box{
        position:relative;
    }

    #myselect{display:block; width:100%; /*height:20px;*/ border:1px solid #d2d6de; padding:5px; overflow: hidden; } .toc-odd{position:absolute; top:32px; background:#fff; width:100%; display:none; border:1px solid #999; z-index: 9; max-height: 187px; overflow: auto; } .toc-odd li{padding:5px 10px; border-bottom:1px solid #999; list-style: none; } .toc-odd li:hover{background: #f4f4f4; } .toc-odd li a{text-decoration:none; display: block; color: #181818; } .toc-odd li a span {display: inline-block; width: 15px; height: 15px; float: right; margin-top: 2px; }
</style>
@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit {{ $modelTitle}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/admin/food_products') }}">{{$modelTitle}}</a></li>
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

                {!! Form::model($result, ["action" => ["admin\\$controllerName@admin_update", $result->id], 'files' => true, "id"=>"submitFrm"]) !!}	
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>                  
                        {!! Form::input('text', 'name', null, ['class' => 'form-control textRequired', 'id'=>'name', 'is_required'=>1, 'placeholder'=>'Product Name']) !!}
                        <div id="name_error" class="error-message">{{$errors->first('name')}}</div>
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1">Attributes</label>         
                        <div id="attrName" class="attr_value_single">
                            <?php
                            $storAttrIds = [];
                            //  dd(($result1['food_product_attribute']));
                            ?>
                            @foreach ($result1['food_product_attribute'] as $val)
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

                            @if(in_array($val['attr_type_name'],['Video']))
                            <div class="form-group">
                                <?php $is_required = $val['is_required']; ?>
                                <?php
                                $input_type = $val['attr_type_name'];
                                if ($input_type == "Video") {
                                    ?>
                                    <label>{{ $val['name'] }}</label>
                                    <input type="hidden" value="{{ $val['attr_type_name'] }}" name="attr_type_name_video[]">
                                    <input type="hidden" value="{{ $val['attr_type_id'] }}" name="attr_type_id_video[]">
                                    <input type="hidden" value="{{ $val['attribute_id'] }}" name="attr_ids_video[]">
                                    <span><a href="{!! asset("/upload_images/attribute_values/video/$val[food_product_id]/$val[attribute_id]/$val[attr_value]") !!}">{!! $val['attr_value'] !!}</a> </span>
                                    <input type="file" is_required="{{ $is_required }}" attr_id_v="{{ $val['attribute_id'] }}" value="" class="attr_value_video attr_value  videotypetxt" style="width:24%;" name="attr_value_video[]">
                                    <input type="hidden" value="{{$val['attr_value']}}" class="attr_value form-control oldVideoAttr_{{ $val['attribute_id'] }}" style="width:24%;" name="attr_value_video_old[]">
                                <?php } ?>
                            </div>
                            @endif

                            @endforeach

                            <?php $storAttrIdsForImages = []; ?>
                            @foreach ($result1['food_product_attribute'] as $val)
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

                    <div class="row upload-img-row">
                        <div class="col-md-4 text-center">
                            <label for="exampleInputFile">Product Image</label>
                            <div class="form-group">
                                @if(isset($result->image))
                                <div class="img-holder text-center" id="catImagePreview">
                                    {{ Html::image(asset('/upload_images/food_products/backgroundimage/30px/'.$result->id.'/'.$result->image), 'alt', array( 'width' => 70, 'height' => 70, 'class' => 'img-responsive cat_img' )) }}
                                </div>
                                @endif
                                <div class="browse-this">
                                    <div id="catImagePreview"></div>
                                    {!!Form::file('image', ['class' => 'category_image'])!!}

                                </div>
                                  <!--<p class="help-block">Example block-level help text here.</p>-->
                                <div id="image" class="error-message">{{$errors->first('image')}}</div>
                                <span class="message">  Image size should be of 360x235px.</span>
                            </div> 
                        </div>
                    </div> <!--/row-->

                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>                  
                        {!! Form::textarea('description', null, ['id' => 'editor1','class' => 'form-control','placeholder'=>'Description','rows'=>7]) !!}
                        <div id="description_error" class="error-message">{{$errors->first('description')}}</div>
                    </div> 

                    
                    <div class="form-group com_info">
                        <label>Ingredient </label>     
                        {!! Form::textarea('ingredient', null, ['id' => 'ingredient','class' => 'form-control textRequired','placeholder'=>'Ingredient','rows'=>7]) !!}
                        <div id="ingredient_error" class="error-message">{{$errors->first('ingredient')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Bar Code</label>                  
                        {!! Form::text('bar_code', null, ['class' => 'form-control textRequired', 'id'=>'bar_code' ,'placeholder'=>'Bar Code']) !!}
                        <div id="bar_code_error" class="error-message">{{$errors->first('bar_code')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nutrition</label>         
                        {!! Form::textarea('nutrition', null, ['id' => 'nutrition','class' => 'form-control textRequired','placeholder'=>'Nutrition','rows'=>7]) !!}
                        <div id="nutrition_error" class="error-message">{{$errors->first('nutrition')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Tags</label>                  
                        {!! Form::text('metakeyword', null, ['class' => 'form-control','placeholder'=>'Meta Tags']) !!}
                        <div class="error-message">{{$errors->first('metakeyword')}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Description</label>                  
                        {!! Form::textarea('metadescription', null, ['class' => 'form-control','placeholder'=>'Meta Description','rows'=>7]) !!}
                        <div class="error-message">{{$errors->first('metadescription')}}</div>
                    </div>

                    <div class="checkbox bike-category">
                        <label>
                            {!! Form::checkbox('status', '1', null) !!} Active
                        </label>
                    </div>


                </div>
                <!-- /.box-body -->


                <div class="box-footer">

                    <button type="submit" class="btn btn-primary">Submit</button> 
                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href='{!! url("admin/$viewName"); !!}'>Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.box -->

        </div>
        <!--/.col -->        
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->	

@stop

@section('scripts')
<script>
    $(document).on("change", ".category_image", function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = $("#catImagePreview");
            dvPreview.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                if (regex.test(file[0].name.toLowerCase())) {
                    dvPreview.css({
                        'height': '80px',
                        'width': '80px',
                        'border': '1px solid black',
                        'padding': '4px',
                        'margin-bottom': '3px'
                    });
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = $("<img />");
                        img.attr("style", "height:70px;width: 70px");
                        img.attr("margin-bottom", "4px");
                        img.attr("src", e.target.result);
                        dvPreview.append(img);
                    }
                    reader.readAsDataURL(file[0]);
                } else {
                    dvPreview.removeAttr("style");
                    $(this).val('');
                    Notify.showMessage("Image must have an extension of .jpeg, .jpg, or .png", 'warning');
                    dvPreview.html("");
                    return false;
                }
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    });

    $('body').on('focus', ".datepicker", function () {
        $(this).datepicker();
    });

    $(document).on("change", ".videotypetxt", function (event) {
        var ext = $(this).val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['mpeg', 'mp4', 'mov', 'wmv']) == -1) {
            Notify.showMessage("Please select a valid video type, mp4,mov,wmv", 'warning');
            $(this).val("");
            //return false;
        }
    });

    $("#submitFrm").submit(function (event) {
        var thisFormObj = $(this);

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
        $('.videotypetxt').each(function (index, value) {
            
//            if (parseInt($(this).attr('is_required')) == 1) {
                var attr_id_v = $(this).attr('attr_id_v');
                var oldVideoVal = $('.oldVideoAttr_'+attr_id_v).val();
            if ((parseInt($(this).attr('is_required')) == 1) && ($(this).val() == '') && (oldVideoVal == '')) {
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
                url: $(thisFormObj).attr('action'),
                type: "POST", // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (data)   // A function to be called if request succeeds
                {

                    if (data.status) {
                        window.location.href = root_url + data.url;
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
</script>
@stop
