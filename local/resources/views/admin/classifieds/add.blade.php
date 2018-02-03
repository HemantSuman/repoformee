<style>
    #classifiedInputFile {
        margin-top: 6px;
    }
    .thumbnail{

        height: 100px;
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
        Add Classified
    </h1>
    <ol class="breadcrumb">
        <li>
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#UploadFileModel">Upload CSV</button>
        </li>
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

                {!! Form::open(array("url" => "admin/$viewName/create", "role" => "form", 'files' => true, 'id'=>'submitFrm')) !!}  
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>                  
                        {!! Form::input('text', 'title', null, ['id' => 'title','class' => 'form-control title textRequired', 'is_required'=>1, 'placeholder'=>'Title Name']) !!}
                        <div class="error-message">{{$errors->first('title')}}</div>
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Category</label>    

                        {!! Form::select('parent_categoryid', $categories, '', ['placeholder' => 'Select Category', 'class' => 'form-control parent_categoryid textRequired addClassified', 'is_required'=>1, 'id' => 'parent_categoryid']) !!}
                        <div class="error-message">{{$errors->first('parent_categoryid')}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select SubCategory</label>
                        {!! Form::select('category_id', [], '', ['placeholder' => 'Select Sub Category', 'class' => 'form-control sub_categories textRequired', 'is_required'=>1, 'id'=>'sub_categories']) !!}

                        <div class="error-message subcategoryerror">{{$errors->first('category_id')}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Attributes</label>         

                        <div id="attrName" class="attr_value_single">
                            No attribute selected

                        </div>

                    </div>

                    <div class="form-group pricehide sttcAttrbts">
                        <label for="exampleInputEmail1">Price ($)</label>                  
                        {!! Form::input('number', 'price', null, ['id'=>'price','class' => 'form-control','min' => 0,'placeholder'=>'Price']) !!}
                        <div class="error-message">{{$errors->first('website')}}</div>
                    </div>

                    <div class="form-group product_code hide" id="editproductcode">
                        <label for="exampleInputEmail1">Product code</label>                  
                        {!! Form::input('text', 'product_code', null, ['id' => 'product_code','class' => 'form-control product_code ', 'placeholder'=>'Product Code']) !!}
                        <div class="error-message">{{$errors->first('product_code')}}</div>
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>                  
                        {!! Form::textarea('description', null, ['id' => 'editor1','class' => 'form-control','placeholder'=>'Description','rows'=>7]) !!}
                        <div class="error-message">{{$errors->first('description')}}</div>
                    </div> 

                    <?php /*priceClassDiv sttcAttrbts
                      <div class="form-group">
                      <label class="col-sm-2 control-label">Image Upload</label>
                      <div class="col-sm-10" >
                      <input type="file" name="image[]" multiple id="classifiedInputFile">
                      <?php
                      for ($i = 0; $i <= 10; $i++) {
                      if (!empty($errors->first('image.' . $i)))

                      ?>
                      <div class="error-message">{{$errors->first('image.'.$i)}}</div>
                      <?php
                      }
                      ?>

                      <output id="result"></output>
                      </div>
                      </div>
                     */ ?>

                    <!-- new -->
                    <div class="form-group">                         
                        <label class="col-sm-2 control-label">Upload Images</label>
                        <div class="col-sm-10">
                            <div class="input-append">
                                <div class="more-images" id="more_images">
                                    <!-- <div id="image_0">
                                        <input type="file" onchange="select_img(0)" id="img_id_0" value="" class="addedInput blue image_field" name="image[0]">
                                        <input type="text" name="image_0_url" placeholder="URl for image" class="advertisement_image_url">
                                    </div> -->
                                </div>
                                <div id="classifiedInputFile"></div>
                                <span class="more-images-button btn btn-default"><a href="javascript:void(0)" onclick="add_more()">Add more image</a></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">Location</label>          
                        <input type="hidden" value="0" id="withCommunty" name="withCommunty" />
                        <input type="hidden" value="0" id="withinformation" name="withinformation" />
                        <input type="hidden" id="lat" name="lat" />
                        <input type="hidden" id="lng" name="lng" />
                        {!! Form::input('text', 'location', null, ['class' => 'form-control staticattribute ','placeholder'=>'Location Name','id'=>'address']) !!}
                        <div class="error-message">{{$errors->first('location')}}</div>
                    </div> 

                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">State</label> 
                        {!! Form::input('text', '', null, ['id'=>'statevalue','class' => 'form-control statevalue','placeholder'=>'State','readonly' => 'true']) !!}
                        {!! Form::select('state_id', $state, '0', ['id' => 'stateid','placeholder' => 'State', 'class' => 'form-control staticattribute stateid ']) !!}
                        <div class="error-message">{{$errors->first('state_id')}}</div>
                    </div>
                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">City</label>         
                        <?php /* {!! Form::select('subregions_id', [], '', ['id' => 'subregion_id','class' => 'form-control subregion_id']) !!} */ ?>
                        {!! Form::input('text', 'subregions_id', null, ['id'=>'subregion_id','class' => 'form-control subregion_id staticattribute','placeholder'=>'Suburb','readonly' => 'true']) !!}
                        <div class="error-message">{{$errors->first('subregions_id')}}</div>
                    </div>
                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">PinCode</label>                  
                        {!! Form::input('text', 'pincode', null, ['id'=>'pincode','class' => 'form-control pincode staticattribute','placeholder'=>'PinCode','readonly' => 'true']) !!}
                        <div class="error-message">{{$errors->first('pincode')}}</div>
                    </div> 
                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">Contact Name</label>                  
                        {!! Form::input('text', 'contact_name', null, ['id'=>'contact_name','class' => 'form-control contact_name staticattribute ','placeholder'=>'Contact Name']) !!}
                        <div class="error-message">{{$errors->first('contact_name')}}</div>
                    </div> 
                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">Contact Email</label>                  
                        {!! Form::input('text', 'contact_email', null, ['id'=>'contact_email','class' => 'form-control contact_email emailValidation staticattribute','placeholder'=>'Contact Email']) !!}
                        <div class="error-message">{{$errors->first('contact_email')}}</div>
                    </div> 
                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">Contact Mobile</label>                  
                        {!! Form::input('number', 'contact_mobile', null, ['id'=>'contact_mobile','class' => 'form-control contact_mobile singleNumbernumeric staticattribute','placeholder'=>'Contact Mobile','min'=>'0']) !!}
                        <div class="error-message">{{$errors->first('contact_mobile')}}</div>
                    </div>  
                    <div class="form-group sttcAttrbts">
                        <label for="exampleInputEmail1">Website</label>                  
                        {!! Form::input('text', 'website', null, ['id'=>'website','class' => 'form-control website staticattribute','placeholder'=>'Website']) !!}
                        <div class="error-message">{{$errors->first('website')}}</div>
                    </div> 

                    <div class=" form-group classifiedIsFeatured sttcAttrbts isFeaturedCheckboxDiv">
                        <div class="checkbox1">
                            <label>
                                {!! Form::checkbox('featured_classified', '1', true, ['class' => 'featured_classified']) !!} Is Featured Classified
                            </label>
                        </div>
                    </div>

                    <div class=" form-group">
                        <div class="checkbox1">
                            <label>
                                {!! Form::checkbox('status', '1', true, ['class' => 'status']) !!} Status
                            </label>
                        </div>
                    </div>

                    <div class="form-group classified-s-e-date sttcAttrbts dattributes">

                        <label class="pull-left"> Select Date:</label>
                        <div class="col-sm-5">
                            <div class="input-group date" id="start_date1">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="start_date" name="start_date" placeholder="Start Date"  class="form-control datepicker pull-right">
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="input-group date" id="end_date1">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="end_date" name="end_date" placeholder="End Date" class="form-control datepicker pull-right" readonly="readonly" >
                            </div>
                        </div>


                        <!-- /.input group -->

                    </div>
                </div>
                <!-- /.box-body -->


                <div class="box-footer">

                    <button type="submit" class="btn btn-primary">Submit</button> 

                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href="{!! url('admin/classifieds'); !!}">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.box -->

        </div>
        <!--/.col -->        
    </div>
    <!-- /.row -->



    <!-- /.input group -->
</section>
<!-- /.content -->  

<div id="UploadFileModel" class="modal fade" role="dialog">
    <div class="modal-dialog" style="height:200px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload CSV File</h4>
            </div>
            {!! Form::open(array("url" => "admin/attributes/import_csv", "role" => "form", 'files' => true, 'id'=>'submitFrmImport')) !!}
            <div class="modal-body">

                <div class="form-group">
                    <label for="recipient-name" class="control-label">CSV File:</label>
                    <input type="file" class="csvField" name="csv_upload" >
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="control-label">ZIP File:</label>
                    <input type="file" class="zipField" name="zip_upload" >
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button> 
                </div>
                <span class="">Date format in CSV should be MM-DD-YYYY</span>
                <div class="form-group">
                    <label style="color: #DA3838;max-height: 100px;overflow-y: scroll;width: 100%;" class="error_import"></label>

                </div>


            </div>
            {!! Form::close() !!}

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU"></script>
<!--<script type="text/javascript" src="http://192.168.100.242/sagar/formee/plugins/admin/plugins/jquery-validator/jquery.validate.min.js"></script>-->
<script type="text/javascript" src="{{ URL::asset('plugins/admin/plugins/jquery-validator/jquery.validate.min.js') }}"></script>

<link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css">
<script type="text/javascript" src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js"></script>
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/colorpicker/bootstrap-colorpicker.min.css') }}">
<script src="{{ URL::asset('plugins/admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('plugins/admin/plugins/timepicker/bootstrap-timepicker.min.css') }}">
<script src="{{ URL::asset('plugins/admin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<?php //dd(json_encode($stateCode)) ; ?>
<script>
                                    //$(function () {
                                    stateCode = [$.parseJSON('<?php echo json_encode($stateCode); ?>')];
                                    stateCode[0][''] = '';
                                    //});
                                    console.log(stateCode);
                                    var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {
                                        types: [],
                                        componentRestrictions: {country: "au"}});
//                                    var componentForm = {
//                                        //street_number: 'short_name',
//                                        //route: 'long_name',
//                                        locality: 'long_name',
//                                        administrative_area_level_1: 'short_name',
////                                        country: 'long_name',
//                                        postal_code: 'short_name'
//                                    };
                                    google.maps.event.addListener(autocomplete, 'place_changed', function () {
                                        var place = autocomplete.getPlace();

                                        document.getElementById('lat').value = place.geometry.location.lat();
                                        document.getElementById('lng').value = place.geometry.location.lng();
                                        //console.log(place.address_components);

                                        var place = autocomplete.getPlace();
                                        for (var i = 0; i < place.address_components.length; i++) {
                                            var addressType = place.address_components[i].types[0];
                                            // console.log(addressType);
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
                                                $('#subregion_id').val(gCityCode);
                                            }
                                            if (addressType == 'postal_code') {
                                                var gPostalCode = place.address_components[i]['short_name'];
                                                $('#pincode').val(gPostalCode);
                                            }
                                        }
                                        //console.log(place.address_components);
                                    });


                                    $('#UploadFileModel').on('shown.bs.modal', function () {
                                        $('.error_import').text('');
                                    });

                                    $(document).on('submit', '#submitFrmImport', function (e) {
                                        e.preventDefault();
                                        if ($('.csvField').val() == '') {
                                            Notify.showMessage("Please select a csv file.", 'warning');
                                            return false;
                                        }
                                        if ($('.zipField').val() == '') {
                                            Notify.showMessage("Please select a zip file.", 'warning');
                                            return false;
                                        }
                                        $.ajax({
                                            url: root_url + '/admin/attributes/import_csv',
                                            type: "POST", // Type of request to be send, called as method
                                            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                            contentType: false, // The content type used when sending data to the server.
                                            cache: false, // To unable request pages to be cached
                                            processData: false, // To send DOMDocument or non processed data file it is set to false
                                            success: function (data)   // A function to be called if request succeeds
                                            {
                                                if (data.status) {
//                console.log('Suc');
                                                    window.location.href = root_url + '/admin/classifieds';
                                                } else {
                                                    $('.error_import').html('');
                                                    $('.error_import').html(data.message);
                                                    console.log(data.message);
                                                }
                                            },
                                            error: function (data) {
                                                console.log('Err');
                                            }
                                        });

                                    });


                                    $("#submitFrm").submit(function (event) {

                                        $("#editor1").val($(".cke_wysiwyg_frame").contents().find("body p").html());
                                        event.preventDefault();
                                        var stepFirstRequired = true;

                                        $('.errorMsg').each(function () {
                                            $(this).remove();
                                        });


                                        $('.textRequired').each(function (index, value) {

                                            if ((parseInt($(this).attr('is_required')) == 1) && ($(this).val() == '')) {
                                                stepFirstRequired = false;
                                                $($(this)).after("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");
//                                                Notify.showMessageForClass(index, 'value');
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

                                            if ((thisObj.val() == '') && (parseInt($(thisObj).attr('is_required')) == 1)) {
                                                stepFirstRequired = false;
                                                $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
                                            } else if (($('.to_time_' + attrId).val() == '') && (parseInt($(thisObj).attr('is_required')) == 1)) {
                                                stepFirstRequired = false;
                                                $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
                                            } else if ((thisObj.val() != '') && ($('.to_time_' + attrId).val() == '')) {
                                                stepFirstRequired = false;
                                                $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
                                            } else if ((thisObj.val() == '') && ($('.to_time_' + attrId).val() != '')) {
                                                stepFirstRequired = false;
                                                $($(this)).parent().after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
                                            } else if (parseInt(fromTime) >= parseInt(toTime)) {
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
                                                $(thisObj).parent().after("<p class='error-message errorMsg '>" + 'From value should not be greater or equal to To value' + "</p>");
                                            }
                                        });
                                        var f=0;
                                        $('.singleNumber').each(function (index, value) {
                                            if ((parseInt($(this).attr('is_required')) == 1) && ($(this).val() == '') || ($(this).val() < 0)) {
                                                $($(this)).after("<p class='error-message errorMsg '>" + 'This field is required' + "</p>");
                                                stepFirstRequired = false;
                                                //return false;
                                                f=1;
                                                
                                            }
                                            
                                           if ($(this).attr('is_numlength') > 0)
                                            {
                                                //console.log('yes');
                                             if ($(this).val().length > parseInt($(this).attr('is_numlength'))) {
                                               $($(this)).after("<p class='error-message errorMsg '>" + 'Maximum '+ parseInt($(this).attr('is_numlength')) +' Characters are allowed' + "</p>");
                                                stepFirstRequired = false;
                                                 f=1;
                                               // return false;
                                            }   
                                            }
                                            

                                        });
                                        
                                        $('.textsize').each(function (index, value) {
                                          //  var fillchar=$(this).attr('is_numlength');
                                           //alert($(this).attr('is_numlength'));
                                            if ($(this).attr('is_numlength') > 0)
                                            {
                                                //console.log($(this).attr('is_numlength'));
                                             if ($(this).val().length > parseInt($(this).attr('is_numlength'))) {
                                               $($(this)).after("<p class='error-message errorMsg '>" + 'Maximum '+ parseInt($(this).attr('is_numlength')) +' Characters are allowed' + "</p>");
                                                stepFirstRequired = false;
                                                 f=1;
                                               // return false;
                                            }   
                                            }
                                            

                                        });
                                        
                                        if(f)
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

//                                        if ((parseInt($('.singlecalendar').attr('is_required')) == 1) && ($('.singlecalendar').val() == '')) {
//                                            $('.singlecalendar').after("<p class='error-message errorMsg '>" + 'This Field is required' + "</p>");
//                                            return false;
//                                        } else if (($('.singlecalendar').val().length != 0) && (parseInt($('.singlecalendar').val().length) != 4)) {
//                                            
//                                            $('.singlecalendar').after("<p class='error-message errorMsg '>" + 'Invalid year' + "</p>");
//                                            return false;
//                                        }
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
                                            if ($('.urlValidation').length) {
                                                var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
                                                $('.urlValidation').each(function (index, value) {
                                                    if (!urlregex.test($(this).val())) {
                                                        stepthirdRequired = false;
                                                        $($(this)).after("<p class='error-message errorMsg '>" + 'Invalid Url!' + "</p>");
                                                    }
                                                });
                                            }
                                        } else {
                                            stepthirdRequired = false;
                                        }
//                                        stepthirdRequired = false;
                                        if (stepthirdRequired) {
                                            $.ajax({
                                                url: root_url + '/admin/classifieds/create',
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

//                                                    dataObj["attrName"] = Array();
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
                                    $(document).on("change", "#classifiedInputFile", function (event) {

                                        files = event.target.files; //FileList object

                                        var output = document.getElementById("result");
                                        console.log($(this));
                                        for (var i = 0; i < files.length; i++)
                                        {
                                            file = {};
                                            file = files[i];
                                            //Only pics
                                            // if(!file.type.match('image'))
                                            if (!file.type.match('image.*')) {


                                                var control = $(this);
                                                control.replaceWith(control = control.clone(true));
                                                $('#result').html('');
                                                alert("Invalid file type.");
                                                return false;
                                            }
                                            if (this.files[0].size > 2097152) {
                                                var control = $(this);
                                                control.replaceWith(control = control.clone(true));
                                                $('#result').html('');
                                                alert("Image Size is too big. Minimum size is 2MB.");
                                                //$(this).val("");
                                                return false;
                                            }


                                        }


                                        for (var i = 0; i < files.length; i++)
                                        {
                                            file = {};
                                            file = files[i];
                                            // continue;
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
                                        }
                                    });
                                    $('body').on('focus', ".datepicker", function () {
                                        $(this).datepicker();
                                    });
                                    jQuery(document).ready(function () {
                                        var html = '<div style="margin-top: 5px;" id="image_0"><div class="img_id_0"></div><input type="file" id="img_id_0" value="" class="addedInput blue image_field textRequired" is_required=1, name="image[0]"></div>';
                                        jQuery('#more_images').append(html);
                                    });
                                    var count = 1;
                                    function add_more(str) {
                                        var html = '<div style="margin-top: 5px;" id="image_' + count + '"><div class="img_id_' + count + '"></div><input type="file" id="img_id_' + count + '" value="" class="addedInput blue image_field textRequired" is_required=1 name="image[' + count + ']"><a href="javascript:void(0)" onclick="remove_image(' + count + ')" class="remove-img">X</a></div>';
                                        jQuery('#more_images').append(html);
                                        count++;
                                    }
                                    function remove_image(strrm) {
                                        if (count > 1) {
                                            jQuery('#image_' + strrm + '').remove();
                                            count--;
                                        }
                                    }

                                    function add_imageGallery(thisObj) {
                                        var cloneId = $(thisObj).attr('forclonelink');
                                        var html = '<div class="input_repeat"><input type="file" value="" class="attr_value textRequired image_field cloneId_' + cloneId + '" is_required=1 style="width: 24%;margin-bottom:5px;" name="attr_value_image[' + cloneId + '][]"><i class="fa fa-close"></i></div>';
                                        $(thisObj).parent().before(html);
                                    }

                                    // $(document).on("change", ".image_field", function (event) {
                                    //     var ext = $(this).val().split('.').pop().toLowerCase();
                                    //     if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                                    //         Notify.showMessage("Please select a valid image.", 'warning');
                                    //         $(this).val("");
                                    //         //return false;
                                    //     }
                                    // });

                                    $(document).on("change", ".videotypetxt", function (event) {
                                        var ext = $(this).val().split('.').pop().toLowerCase();
                                        if ($.inArray(ext, ['mpeg', 'mp4', 'mov', 'wmv']) == -1) {
                                            Notify.showMessage("Please select a valid video type, mp4,mov,wmv", 'warning');
                                            $(this).val("");
                                            //return false;
                                        }
                                    });


                                    $(document).on("change", ".image_field", function (event) {
                                        if (typeof (FileReader) != "undefined") {
                                            //console.log($(this).attr('id'));
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



//                                    $('body').on('focus', ".datepicker", function () {
//                                        $(this).datepicker();
//                                    });

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

                                    $(function () {

                                        BelongsToCommunities = [$.parseJSON('<?php echo json_encode($BelongsToCommunities); ?>')];
                                        var BelongsToCommunities1;
                                        showStaticAttributes = [$.parseJSON('<?php echo json_encode($showStaticAttributes); ?>')];
                                        communities_informationarr = [$.parseJSON('<?php echo json_encode($communities_informationarr); ?>')];
                                        //console.log(communities_informationarr);
                                    });

                                    /* For hide Start Date picker */

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
                                        console.log(flags);
                                        if (flags == 1)
                                        {
                                            $(".classified-s-e-date").hide();
                                            $(".classified-s-e-date").css({"display": "none"});
                                           $(".pricehide").hide();
                                           $(".pricehide").removeClass('sttcAttrbts');
                                            $(".pricehide").css({"display": "none" });
                                        } else if (flags == 0)
                                        {
                                            $(".classified-s-e-date").show();
                                            $(".classified-s-e-date").css({"display": "block"});
                                            $(".pricehide").show();
                                            $(".pricehide").css({"display": "block"});
                                        }

                                        var p_category_name = $('#parent_categoryid').text();

                                    })

                                    /* Hide Start Date picker */


                                    $("#stateid").css("display", "none");


</script>
@stop