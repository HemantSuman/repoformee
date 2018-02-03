<style>
    .error-message{color:#dd4b39;}
    .message{color:rgb(60, 141, 188);}
</style>
@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add {{ $modelTitle}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url("/admin/$viewName") }}">{{$modelTitle}}</a></li>
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

                {!! Form::open(array("url" => "admin/$viewName/create", "role" => "form", 'files' => true, 'id' => 'submitFrm')) !!}	
                @if($attributesSelected)
                {!! Form::input('hidden', 'is_child_value', $attributesSelected->id) !!}
                @else
                {!! Form::input('hidden', 'is_child_value', 0) !!}
                @endif
                <div class="box-body">

                    <div class="form-group">
                        <label for="">Attribute Name</label>                  
                        {!! Form::input('text', 'name', null, ['class' => 'form-control textRequired','placeholder'=>'Attribute Name']) !!}
                        <div class="error-message">{{$errors->first('name')}}</div>
                    </div> 

                    <div class="form-group">
                        <label for="">Attribute Display Name</label>                  
                        {!! Form::input('text', 'display_name', null, ['class' => 'form-control textRequired','placeholder'=>'Attribute Display Name']) !!}
                        <div class="error-message">{{$errors->first('display_name')}}</div>
                    </div> 

                    <div class="form-group is_childSelect" style="display:{!! ($errors->first('p_attr_id') || $attributesSelected)?'block':'none' !!};">
                        <label>Select Parent Attribute</label>         
                        {!! Form::select('p_attr_id', $attributes, ($attributesSelected)?$attributesSelected->id:'', ['placeholder' => 'Select Attribute', 'class' => 'form-control parrentAttr']) !!}
                        <div class="error-message">{{$errors->first('p_attr_id')}}</div>
                    </div>


                    <div class="form-group" >
                        <label for="">Select Attribute Type</label>         
                        {!! Form::select('attributetype_id', $attribut_type, '', ['placeholder' => 'Select Attribute Type', 'class' => 'form-control attribute_type']) !!}
                        <div class="error-message">{{$errors->first('attributetype_id')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="">Select Category</label>        
                        {!! Form::input('hidden', 'category_id', null, ['id' => 'category_id']) !!}
                        <div class="easyui-panel defaultCatList" style="padding:5px; border: none;">
                            <!--<ul id="tt" class="easyui-tree" data-options="url:'categories_json',method:'get',animate:true,checkbox:true"></ul>-->
                            <ul id="tt" class="easyui-tree" ></ul>
                        </div>
                        <div class="easyui-panel parentCatList" style="padding:5px; border: none;">
                            <!--<ul id="tt" class="easyui-tree" data-options="url:'categories_json',method:'get',animate:true,checkbox:true"></ul>-->
                            <ul id="tt1" class="easyui-tree" ></ul>
                        </div>

                        <div class="error-message">{{$errors->first('category_id')}}</div>
                    </div> 

                    <div class="form-group">
                        <label for="">Description</label>                  
                        {!! Form::textarea('description', null, ['id' => 'editor1', 'class' => 'form-control','placeholder'=>'Description','rows'=>7]) !!}
                        <div class="error-message">{{$errors->first('description')}}</div>
                    </div>   

                    <div class="form-group sizemeasure hide">
                        <label for="">Attribute Size</label>                  
                        {!! Form::input('text', 'size', null, ['class' => 'form-control','placeholder'=>'Attribute Size']) !!}
                        <div class="error-message">{{$errors->first('size')}}</div>
                    </div> 

                    <div class="form-group sizemeasure hide">
                        <label for="">Attribute Unit Measure</label>                  
                        {!! Form::input('text', 'measure_unit', null, ['class' => 'form-control','placeholder'=>'Attribute Unit Measure']) !!}
                        <div class="error-message">{{$errors->first('measure_unit')}}</div>
                    </div> 

                    <div class="checkbox bike-category">
                        <label>
                            {!! Form::checkbox('show_list', '1', null, ['class' => 'show_list']) !!} Show on listing page
                        </label>
                    </div>

                    <div class="form-group icon">
                        <label class="col-sm-2 control-label">Upload Icon</label>


                        <div class="browse-this">
                            {!!Form::file('icon')!!}

                        </div>

<!--<p class="help-block">Example block-level help text here.</p>-->
                        <div class="error-message">{{$errors->first('icon')}}</div>
                        <span class="message"> Icon Height should be of 70px.</span>
                    </div>

                    <div class="checkbox bike-category">
                        <label>
                            {!! Form::checkbox('required', '1', null) !!} Is Attribute Required
                        </label>
                    </div>

                    <div class="checkbox bike-category issearchable">
                        <label>
                            {!! Form::checkbox('searchable', '1', null ,['class' => 'issearchable1']) !!} Is Attribute Searchable
                        </label>
                    </div>

                    <div class="checkbox bike-category">
                        <label>
                            {!! Form::checkbox('status', '1', null) !!} Active
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Tags</label>                  
                        {!! Form::text('metatitle', null, ['class' => 'form-control','placeholder'=>'Meta Tags']) !!}
                        <div class="error-message">{{$errors->first('metatitle')}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Description</label>                  
                        {!! Form::textarea('metadescription', null, ['class' => 'form-control','placeholder'=>'Meta Description','rows'=>7]) !!}
                        <div class="error-message">{{$errors->first('metadescription')}}</div>
                    </div>

                </div>
                <!-- /.box-body -->


                <div class="box-footer">

                    <button type="submit" class="btn btn-primary">Submit</button> 
                    @if($attributesSelected)
                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href='{!! url("admin/attributes/$attributesSelected->id"); !!}'>Cancel</a>
                    @else
                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href="{!! url('admin/attributes'); !!}">Cancel</a>
                    @endif
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
    $(function ()
    {
        if ($('.show_list').is(":checked")) {
            $('.icon').css('display', 'block');
        } else {
            $('.icon').css('display', 'none');
        }
        $('.issearchable').css('display', 'none');
    });
    $(document).on('click', '.show_list', function () {
        //alert("hello");
        // $('.attribute_type').val('').trigger('change');
        if ($(this).is(":checked")) {
            $('.icon').css('display', 'block');
        } else {
            $('.icon').css('display', 'none');
        }
    })
    //Click checkbox to show hide category drop down  

//    $(document).on('click', '#is_childCheck', function () {
//        var thisObj = $(this);
//        $('#category_id').val('');
//        if ($(this).is(":checked")) {
//
//            $('.attribute_value').remove();
//            $('.defaultCatList').css('display', 'block');
//            $('#tt1').html('');
//
//            $.ajax({
//                url: root_url + '/admin/attributes/attr_list',
//                type: "POST", // Type of request to be send, called as method
//                data: {
//                    "_token": $('meta[name="csrf-token"]').attr('content'),
//                    "id": 0,
//                },
//                //dataType: "html",
//                cache: true,
//                //processData: false,
//                success: function (response) {
//                    if (response.status) {
//                        $('.is_childSelect').remove();
//                        var options = '';
//                        $.each(response.results, function (index, value) {
//                            options += "<option value='" + index + "'>" + value + "</option>";
//                        });
//
//                        var is_childSelect = "<div class='form-group is_childSelect'><label>Select Parent Attribute</label><select class='form-control parrentAttr' name='p_attr_id'><option value=''>Select Attribute</option>" + options + "</select><div class='error-message'></div></div>";
//                        $('.isChildDiv').after(is_childSelect);
//                    }
//                }
//            });
//        } else {
//
//            $('.is_childSelect, .attr_value_child').remove();
//            $('.defaultCatList').css('display', 'block');
//            $('#tt1').html('');
//            var attributeValue = "<div class='form-group attribute_value'><label for=''>Attribute Value</label><textarea class='form-control' placeholder='Enter comma seperated values' rows='7' name='attribute_value' cols='50'></textarea><div class='error-message'></div></div>";
//            $(thisObj).parent().parent().after(attributeValue);
////            $('.attribute_type').val('').trigger('change');
//        }
//    })
$(document).on('click', '#is_childCheck', function () {
        var thisObj = $(this);
        $('#category_id').val('');
        if ($(this).is(":checked")) {

            $('.attribute_value').remove();
            $('.defaultCatList').css('display', 'block');
            $('#tt1').html('');

            $.ajax({
                url: root_url + '/admin/classifieds/attr_list',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "id": 0,
                },
                //dataType: "html",
                method: "POST",
                cache: true,
                success: function (response) {
                    
                    if (response.status) {
                        $('.is_childSelect').remove();
                        var options = '';
                        $.each(response.results, function (index, value) {
                            options += "<option value='" + index + "'>" + value + "</option>";
                        });

                        var is_childSelect = "<div class='form-group is_childSelect'><label>Select Parent Attribute</label><select class='form-control parrentAttr' name='p_attr_id'><option value=''>Select Attribute</option>" + options + "</select><div class='error-message'></div></div>";
                        $('.isChildDiv').after(is_childSelect);
                    }
                }
            });
        } else {

            $('.is_childSelect, .attr_value_child').remove();
            $('.defaultCatList').css('display', 'block');
            $('#tt1').html('');
            var attributeValue = "<div class='form-group attribute_value'><label for=''>Attribute Value</label><textarea class='form-control' placeholder='Enter comma seperated values' rows='7' name='attribute_value' cols='50'></textarea><div class='error-message'></div></div>";
            $(thisObj).parent().parent().after(attributeValue);
//            $('.attribute_type').val('').trigger('change');
        }
    })
    $(document).on('change', '.parrentAttr', function () {
        var thisObj = $(this);
        $('#category_id').val('');
        var attribute_id = thisObj.val();
        $.ajax({
            url: root_url + '/admin/classifieds/allparrentattributevalues',
            //url: root_url + '/admin/attributes/allparrentattributevalues',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "attribute_id": attribute_id,
            },
            //dataType: "html",
            method: "POST",
            cache: true,
            success: function (response) {
                if (response.status) {
                    $('.attr_value_child').remove();
                    var attr_value_child = '';
                    var attr_value_child_div = "<div class='form-group attr_value_child'></div>";
                    $(thisObj).parent().after(attr_value_child_div);
                    $.each(response.attribute_values, function (i, v) {
                        attr_value_child = '<div class="form-group"><label for="">' + v + '</label><input value="' + i + '" name="child_attr_name[]" type="hidden"><input class="form-control attrChildValue" placeholder="Enter comma seperated values" name="child_attr_val[' + i + '][]" type="text"><div class="error-message"></div></div>';
                        $('.attr_value_child').append(attr_value_child);
                    });
                }
            }
        });
        var flag = true;
        $('#tt1').tree({
            url: root_url + '/admin/attributes/categories_json/' + attribute_id,
            data: [{
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'attr_id': attribute_id
                }],
            method: 'get',
            animate: true,
            checkbox: true,
            disabled: true,
            onBeforeCheck: function (node, checked) {
                return false;
            },
            loadFilter: function (data) {
                if (typeof data.tree1 != 'undefined') {
                    $('.defaultCatList').css('display', 'none');
                    $('#category_id').val(data.ids);
                    return data.tree1;
                } else {
                    return data;
                }
            }
        });
    });
    //Click checkbox to show hide category drop down  
    $(document).on('change', '.attribute_type', function () {
        $('.sizemeasure').addClass('hide');
        var thisObj = $(this);
        if ($(this).val() == 5 || $(this).val() == 7) {
            removeOtherDiv();
            $('.defaultCatList').css('display', 'block');
            $('#tt1').html('');
            var attributeValue = "<div class='form-group attribute_value'><label for=''>Attribute Value</label><textarea class='form-control textRequired' placeholder='Enter comma seperated values' rows='7' name='attribute_value' cols='50'></textarea><div class='error-message'></div></div>"
            $(thisObj).parent().after(attributeValue);
        } else if ($(this).val() == 4) {
            removeOtherDiv();
            $('.defaultCatList').css('display', 'block');
            $('#tt1').html('');
            var attributeValue = "<div class='form-group attribute_value'><label for=''>Attribute Value</label><textarea class='form-control textRequired' placeholder='Enter comma seperated values' rows='7' name='attribute_value' cols='50'></textarea><div class='error-message'></div></div>"
            var isCheckedHtml = "<div class='checkbox isChildDiv'><label><input id='is_childCheck' name='is_child' type='checkbox' value='1'> Is Child Attribute</label></div>";
            $(thisObj).parent().after(isCheckedHtml + attributeValue);
        } else if ($(this).val() == 18) {
            removeOtherDiv();
            $('.defaultCatList').css('display', 'block');
            $('#tt1').html('');
            var attribute_value_numeric_check = "<div class='form-group attribute_value_numeric_check'><label for=''>Is Range ?</label><input id='is_range_checkbox' type='checkbox' name='is_range'></div>";
            $(thisObj).parent().after(attribute_value_numeric_check);
        } else if ($(this).val() == 8) {
            removeOtherDiv();
            $('.defaultCatList').css('display', 'block');
            $('#tt1').html('');
            var attribute_value_calendar_check = "<div class='form-group attribute_value_calendar_check'><label for=''>Is Range ?</label><input id='is_range_calendar_checkbox' type='checkbox' name='is_range'></div>";
            $(thisObj).parent().after(attribute_value_calendar_check);
        } else if ($(this).val() == 19) {
            removeOtherDiv();
            $('.defaultCatList').css('display', 'block');
            $('#tt1').html('');
            var attribute_value_date_check = "<div class='form-group attribute_value_date_check'><label for=''>Is Range ?</label><input id='is_range_date_checkbox' type='checkbox' name='is_range'></div>";
            $(thisObj).parent().after(attribute_value_date_check);
        } else if ($(this).val() == 13) {
            removeOtherDiv();
            $('.defaultCatList').css('display', 'block');
            $('#tt1').html('');
            var attribute_value_time_check = "<div class='form-group attribute_value_time_check'><label for=''>Is Range ?</label><input id='is_range_time_checkbox' type='checkbox' name='is_range'></div>";
            $(thisObj).parent().after(attribute_value_time_check);
        } else {
            removeOtherDiv();
            $('.defaultCatList').css('display', 'block');
            $('#tt1').html('');
        }

        var attributetype = ['4', '5', '7', '8', '13', '18'];
        if (jQuery.inArray($(this).val(), attributetype) !== -1) {

            $('.issearchable').css('display', 'block');
        } else {
            $('.issearchable').css('display', 'none');
        }

        if ($(this).val() == 1 || $(this).val() == 2 || $(this).val() == 18) {

            $('.sizemeasure').removeClass('hide');
        }

    });
    function removeOtherDiv() {
        $('.isChildDiv, .attribute_value, .is_childSelect, .attr_value_child, .attribute_value_numeric_check, .attribute_value_calendar_check, .attribute_value_date_check, .attribute_value_time_check, .attribute_value_numeric, .attribute_value_calendar').remove();
        $('#category_id').val('');
    }

    $(document).on('change', '#is_range_checkbox', function () {
        var thisObj = $(this);
        if ($(this).is(':checked')) {
            var attribute_value_numeric = "<div class='form-group attribute_value_numeric'><label for=''>Attribute Value</label><input type='number' name='min' min='0' id='min' placeholder='Minimum'> <input type='number' id='max' min='0' name='max' placeholder='Maximum'></div>";
            $(thisObj).parent().after(attribute_value_numeric);
        } else {
            $('.attribute_value_numeric').remove();
        }
    });

    $(document).on('change', '#is_range_calendar_checkbox', function () {
        var thisObj = $(this);
        if ($(this).is(':checked')) {
            var attribute_value_calendar = "<div class='form-group attribute_value_calendar'><label for=''>Attribute Value</label><input type='number' name='min' min='0' id='min' placeholder='Minimum'> <input type='number' id='max' min='0' name='max' placeholder='Maximum'></div>";
            $(thisObj).parent().after(attribute_value_calendar);
        } else {
            $('.attribute_value_calendar').remove();
        }
    });
    //retuen to validation error -: if check show display block
//    $(function () {
//        if ($('#is_childCheck').is(":checked")) {
//            $('.is_childSelect').css('display', 'block');
//        } else {
//            $('.is_childSelect').css('display', 'none');
//        }
//
//        if ($('.attribute_type option:selected').val() == 5 || $('.attribute_type option:selected').val() == 7) {
//            $('.attribute_value').css('display', 'block');
//        } else if ($('.attribute_type option:selected').val() == 4) {
//
//            if ($('#is_childCheck').is(':checked')) {
//                $('.attr_value_child').css('display', 'block');
//            } else {
//                $('.attribute_value').css('display', 'block');
//            }
//
//        } else {
//            $('.attribute_value').css('display', 'none');
//        }
//
//        if ($('.attribute_type option:selected').val() == 18) {
//            $('.attribute_value_numeric_check').css('display', 'block');
//            $('#is_range_checkbox').prop('checked', false);
//        } else {
//            $('.attribute_value_numeric_check').css('display', 'none');
//        }
//
//        if ($('#is_range_checkbox').is(':checked')) {
//            $('.attribute_value_numeric').css('display', 'block');
//        } else {
//            $('.attribute_value_numeric').css('display', 'none');
//        }
//
//    });
    $('#tt').tree({
        //url:'categories_json',
//        "_token": $('meta[name="csrf-token"]').attr('content'),
        url: 'categories_json',
        data: [{
                _token: $('meta[name="csrf-token"]').attr('content'),
            }],
        method: 'get',
        animate: true,
        checkbox: true,
        onCheck: function (node) {
            var nodes = $('#tt').tree('getChecked');
            var checkedNodes = [];
            for (var i = 0; i < nodes.length; i++) {
                node = nodes[i];
                if (node.checked) {
                    checkedNodes.push(node.id);
                }
            }
            $('#category_id').val(checkedNodes);
//            console.log(checkedNodes);
        }
    });
    $("#submitFrm").submit(function (event) {

        event.preventDefault();
        var readyToSubmit = true;
        var readyToSubmit1 = true;
        $('.box-body .attrChildValue').each(function (index, value) {

            if ($(value).val() == '') {
                Notify.showMessage('Child attributr value is required', 'warning');
                readyToSubmit = false;
                return false;
            }
        });

        var desvalue = CKEDITOR.instances['editor1'].getData();
        
        if (desvalue == '')
        {
            Notify.showMessage('description is required', 'warning');
            readyToSubmit1 = false;
        }
        if (readyToSubmit) {
            if ($('#is_range_calendar_checkbox').prop('checked')) {
                if (parseInt($('#min').val()) > parseInt($('#max').val())) {
                    Notify.showMessage('Max value should be greater than min value', 'warning');
                    readyToSubmit1 = false;
                } else {
                    if ($('.attribute_type option:selected').val() == 8) {

                        if (parseInt($('#min').val().length) != 4 || parseInt($('#max').val().length) != 4) {
                            Notify.showMessage('Invalid year', 'warning');
                            readyToSubmit1 = false;
                            return false;
                        }
                    } else {
                        readyToSubmit1 = true;
                    }
                }
            }

        } else {
            readyToSubmit1 = false;
        }
        if (readyToSubmit1) {
            $.ajax({
                url: root_url + '/admin/attributes/create',
                type: "POST", // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (data)   // A function to be called if request succeeds
                {

                    if (data.status) {
                        window.location.href = root_url + '/admin/' + data.url;
                    }
                    console.log('Suc', data);
                },
                error: function (data) {

                    var dataObj = JSON.parse(data.responseText);
                    $.each(dataObj, function (index, value) {

                        Notify.showMessage(value, 'warning');
                        return false;
                    });
                }
            });
        } else {
            //$("#submitFrm").submit();
        }
    });
</script>
@stop
