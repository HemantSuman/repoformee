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
        Add {{ $modelTitle}}
    </h1>
    <ol class="breadcrumb">
        <li>
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#UploadFileModel">Upload CSV</button>
        </li>
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

                {!! Form::open(array("url" => "admin/$viewName/create", "role" => "form", 'files' => true, "id"=>"submitFrm")) !!}	
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>                  
                        {!! Form::input('text', 'name', null, ['class' => 'form-control textRequired', 'id'=>'name', 'placeholder'=>'Product Name', 'is_required'=>1]) !!}
                        <div id="name_error" class="error-message">{{$errors->first('name')}}</div>
                    </div>
                    <input type="hidden" value="{{$categories->id}}" id="category_id" name="category_id" />
                    <div class="form-group">
                        <label for="exampleInputEmail1">Attributes</label>         

                        <div id="attrName" class="attr_value_single">
                            No attribute selected

                        </div>

                    </div>

                    <div class="row upload-img-row">
                        <div class="col-md-4 text-center">
                            <label for="exampleInputFile">Product Image</label>
                            <div class="form-group">
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

                    <?php
                    $ingredient = array(
                        '1' => '1',
                        '2' => '2',
                    );
                    ?>
                    <div class="form-group com_info">
                        <label>Ingredient </label>         
                        {!! Form::textarea('ingredient', null, ['id' => 'ingredient','class' => 'form-control textRequired','placeholder'=>'Ingredient','rows'=>7,'is_required'=>'1']) !!}
                        <!--                        {!! Form::select('ingredient', $ingredient, null, ['placeholder' => '-Select-', 'class' => 'form-control comm_details']) !!}-->
                        <div id="ingredient_error" class="error-message">{{$errors->first('ingredient')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Bar Code</label>                  
                        {!! Form::text('bar_code', null, ['class' => 'form-control textRequired', 'id'=>'bar_code', 'placeholder'=>'Bar Code','is_required'=>'1']) !!}
                        <div id="bar_code_error" class="error-message">{{$errors->first('bar_code')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nutrition</label>     
                        {!! Form::textarea('nutrition', null, ['id' => 'nutrition','class' => 'form-control textRequired','placeholder'=>'Nutrition','rows'=>7,'is_required'=>'1']) !!}
                        <!--{!! Form::text('nutrition', null, ['class' => 'form-control','placeholder'=>'Nutrition']) !!}-->
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
<div id="UploadFileModel" class="modal fade" role="dialog">
    <div class="modal-dialog" style="height:200px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload CSV File</h4>
            </div>
            {!! Form::open(array("url" => "admin/attributes/import_csv_food", "role" => "form", 'files' => true, 'id'=>'submitFrmImport')) !!}
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
                <span class="">Date format in CSV should be MM-DD-YYYY</span></br>
                <span class="">Multiple value should be separated by semicolon(;) </span>
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
<script>
    $(function () {

        var category_id = $('#category_id').val();
        attributeListing(category_id, 'forSubCat', true);
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
            url: root_url + '/admin/attributes/import_csv_food',
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                if (data.status) {
//                console.log('Suc');
                    window.location.href = root_url + '/admin/food_products';
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

        if (stepFirstRequired) {
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
                    console.log(dataObj);
                    $.each(dataObj, function (index, value) {

//                        if (index == 'image.0') {
//                            index = 'classifiedInputFile'
//                            value = "Image required minimum 3 MB."
//                        }
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
