<style>
    .error-message{color:#dd4b39;}
    #newsletterInputFile {
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
        Add {{ $modelTitle }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/admin/advertisements') }}">{{$modelTitle}}</a></li>
        <li class="active">Add {{$modelTitle}}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>              
                </div>
                @if( Session::has( 'success' ))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> {{ Session::get( 'success' ) }}
                </div>
                @elseif( Session::has( 'danger' ))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Oops!</strong> {{ Session::get( 'danger' ) }}
                </div>
                @endif

                
                <input type="hidden" class="old_banner_pos" value="{{ (old('banner_position')) }}">
                <input type="hidden" class="old_subcategory_idd" value="{{ (old('subcategory_id')) }}">
                {!! Form::open(array("url" => "admin/$viewName/add", "role" => "form", 'class' => 'form-horizontal', 'files' => true, 'id' => 'AddAdvertisementForm')) !!} 
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" value="{!! old('title') !!}" name="title" class="form-control" placeholder="Advertisement Title">
                                <div class="error-message">{{$errors->first('title')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Page</label>
                            <div class="col-sm-10">
                                {!! Form::select('page_id', $all_ad_positions, null, array('class' => 'form-control ad_page_drpdwn', 'placeholder' => 'Select Page') ) !!}
                                <div class="error-message">{{$errors->first('page_id')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Banner Position</label>
                            <div class="col-sm-10" ddddddd="{{ old('banner_position') }}">
                                {!! Form::select('banner_position', (Session::has('adPosData')) ? Session::get('adPosData') : array(), (old('banner_position')) ? old('banner_position') : null, array('class' => 'form-control banner_position', 'placeholder' => 'Select Banner Position') ) !!}
                                <div class="error-message">{{$errors->first('banner_position')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Is Default</label>
                            <div class="col-sm-10">
                                {!! Form::checkbox('is_default', null, null, array('class' => 'minimal', 'id' => 'is-ftr-chk')) !!}
                            </div>
                        </div>
                        <div class="form-group ad_category_blk dflt_pge_selctn_hide">
                            <label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                {!! Form::select('category_id', $categories, null, array('class' => 'form-control', 'placeholder' => 'Select Category', 'id' => 'category_id') ) !!}
                                <div class="error-message">{{$errors->first('category_id')}}</div>
                            </div>
                        </div>
                        <div class="form-group ad_subcategory_blk dflt_pge_selctn_hide">
                            <label class="col-sm-2 control-label">Sub Category</label>
                            <div class="col-sm-10">
                                {!! Form::select('subcategory_id', [], '', ['class' => 'form-control sub_categories', 'id' => 'sub_categories']) !!}
                                <div class="error-message">{{$errors->first('subcategory_id')}}</div>
                            </div>
                        </div>
                        <div class="form-group dflt_pge_selctn_hide is_def_sel">
                            <label class="col-sm-2 control-label">Start Date</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="start_date" value="{!! old('start_date') ? old('start_date') : date('m/d/Y') !!}" class="form-control pull-right" id="advertisement_start_date" placeholder="Click here to select">
                                </div>
                                <div class="error-message">{{$errors->first('start_date')}}</div>
                            </div>
                        </div>
                        <div class="form-group dflt_pge_selctn_hide is_def_sel">
                            <label class="col-sm-2 control-label">End Date</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="end_date" value="{!! old('end_date') ? old('end_date') : date('m/d/Y') !!}" class="form-control pull-right" id="advertisement_end_date" placeholder="Click here to select">
                                </div>
                                <div class="error-message">{{$errors->first('end_date')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Contact Email</label>
                            <div class="col-sm-10">
                                <input type="text" value="{!! old('contact_email') !!}" name="contact_email" class="form-control" placeholder="Contact Email">
                                <div class="error-message">{{$errors->first('contact_email')}}</div>
                            </div>
                        </div>
                        <?php /*
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Contact Number</label>
                            <div class="col-sm-10">
                                <input type="text" value="{!! old('contact_number') !!}" name="contact_number" class="form-control" placeholder="Contact Number">
                                <div class="error-message">{{$errors->first('contact_number')}}</div>
                            </div>
                        </div>
                        */ ?>
                        <div class="form-group">                         
                            <label class="col-sm-2 control-label">Upload Image</label>
                            <div class="col-sm-10">
                                <div class="input-append">
                                    <div class="more-images" id="more_images">
                                        <div id="image">
                                            <div id="dvPreview"></div>
                                            <input type="file" value="" class="addedInput blue image_field" name="image" id="dddd">
                                            <input type="text" name="image_url" placeholder="URL for image" class="advertisement_image_url" value="{!! old('image_url') !!}">
                                            <span class="error-message">{{$errors->first('image_url')}}</span>
                                        </div>
                                    </div>
                                    <div class="info-msg"><span class="text-info img-size-info"></span></div>
                                    <div class="error-message img-srv-errr">{{$errors->first('image')}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                {!! Form::checkbox('status', null, null, array('class' => 'minimal')) !!}
                            </div>
                        </div>

                    </div>
                
                    <div class="box-footer col-sm-offset-2"> 
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-default btn-close" href="{!! url('admin/advertisements'); !!}">Cancel</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>

@stop

@section('scripts')
<script type="text/javascript">
        var communities_informationarr = [$.parseJSON('<?php echo json_encode($communities_informationarr); ?>')];
        var ad_page_val = $(".ad_page_drpdwn").val();
        var banner_position_valu = $(".old_banner_pos").val();
        var old_subcat_valu = $(".old_subcategory_idd").val();
        // console.log(banner_position_valu)
        

        $('.ad_category_blk, .ad_subcategory_blk').addClass("hide");
        if(ad_page_val == 1 || ad_page_val == 4) {
            $(".ad_category_blk").addClass("hide");
            $(".ad_subcategory_blk").addClass("hide");
        }
        if($('#is-ftr-chk').prop('checked')) {
            $(".dflt_pge_selctn_hide").addClass("hide");
        }

        $("#advertisement_start_date").datepicker({
            startDate: '-0d',
            autoclose: true,
            //todayHighlight: true
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            console.log(minDate)
            $('#advertisement_end_date').datepicker('setStartDate', minDate);
            $('#advertisement_end_date').val('');
        });

        $("#advertisement_end_date").datepicker({
            autoclose: true,
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#advertisement_start_date').datepicker('setEndDate', minDate);
        });
        
        $("#AddAdvertisementForm").validate({
            rules: {
                title: "required",
                page_id: "required",
                category_id: "required",
                banner_position: "required",
                image: "required",
                image_url: "required",
                start_date: "required",
                end_date: "required",
                contact_email: {
                    required: true,
                    email: true
                },
                // contact_number: {
                //     required: true,
                //     digits: true,
                //     minlength: 10,
                //     maxlength: 12
                // }
            },
            errorPlacement: function(error, element){
                if (element.attr("name") == "start_date" || element.attr("name") == "end_date") {
                    error.appendTo( element.parent().next());
                } else if(element.attr("name") == "image") {
                    console.log("invalid");
                    error.appendTo( element.parent().parent().next());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                return true;
            }
        });

        $(document).on('change', '#category_id', function () {
            var p_category_id = $(this).val();
            
//            $(communities_informationarr[0]).each(function(ind, val) {
//                if(p_category_id == val.id) {
//                    $('#sub_categories').rules('remove', "required");
//                    return false;
//                } else {
//                    $("#sub_categories").rules("add", { required: true })
//                }
//            })

            categoryListing(p_category_id, 'noAttr');
        });

        function categoryListing(pcat_id, forAttr) {

            //Ajax for sub category list
            $.ajax({
                url: root_url + '/admin/categories/allcategories',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "id": pcat_id
                },
                //dataType: "html",
                method: "GET",
                cache: false,
                success: function (response) {
                    if (response.status) {

                        $("#sub_categories").html('');
                        $("#sub_categories").append($('<option></option>').val('').html('Select Subcategory'));
                        $.each(response.categories, function (key, value) {
                            if(key == old_subcat_valu) {
                                $("#sub_categories").append($('<option></option>').val(key).html(value).prop('selected', 'selected'));    
                            } else {
                                $("#sub_categories").append($('<option></option>').val(key).html(value));    
                            }
                            
                        });
                    }
                }

            });
        }

        $(document).on("change", ".ad_page_drpdwn", function(event) {
            var page = $(this).val();
            if(page == '') {
                $('.ad_category_blk, .ad_subcategory_blk').addClass("hide");
            } else if(page == 1 || page == 4) {
                $('.dflt_pge_selctn_hide').removeClass("hide");
                if($('#is-ftr-chk').prop('checked')) {
                    $(".is_def_sel").addClass("hide");
                }
                $('.ad_category_blk, .ad_subcategory_blk').addClass("hide");
            } else {
                $('.ad_category_blk, .ad_subcategory_blk, .dflt_pge_selctn_hide').removeClass("hide");
                if($('#is-ftr-chk').prop('checked')) {
                    $(".is_def_sel").addClass("hide");
                }
            }

            //Ajax for active positions on the selected page
            $.ajax({
                url: root_url + '/admin/advertisements/get-positions',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "page": page
                },
                //dataType: "html",
                method: "POST",
                cache: false,
                success: function (response) {
                    $(".banner_position").html('');
                    $(".banner_position").append($('<option></option>').val('').html('Select Banner Position'));
                    $.each(response.all_positions, function (key, value) {
                        if(value != 0) {
                            if(key == banner_position_valu) {
                                $(".banner_position").append($('<option></option>').val(key).html(key).prop('selected', 'selected'));    
                            } else {
                                $(".banner_position").append($('<option></option>').val(key).html(key));
                            }
                            
                        }
                    });
                }

            });                                
        });

        $('#is-ftr-chk').on('ifChecked', function(event){
            if($('.ad_page_drpdwn').val() == 1 || $('.ad_page_drpdwn').val() == 4) {
                $('.dflt_pge_selctn_hide').addClass("hide");   
            } else {
                $('.is_def_sel').addClass('hide');
            }
        }).on('ifUnchecked', function(event){ 
            if($(".ad_page_drpdwn").val() == 1 || $(".ad_page_drpdwn").val() == 4) {
                $('.ad_category_blk, .ad_subcategory_blk').addClass("hide");
                $('.is_def_sel').removeClass('hide');
            } else {
                $('.is_def_sel').removeClass('hide');
            }
        });

        $(document).on("change", ".banner_position", function(event) {
            var b_pos = $(this).val();
            $(".img-size-info").text("");
            $(".img-srv-errr").text("");
            if(b_pos == "top") {
                $(".img-size-info").text("Image size should be of 1920x730px.");
            }
            if(b_pos == "right") {
                $(".img-size-info").text("Image size should be of 400x303px.");
            }
            if(b_pos == "bottom") {
                $(".img-size-info").text("Image size should be of 1400x299px.");
            }   
        });

        $("#dddd").change(function () {
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#dvPreview");
                dvPreview.html("");
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                $($(this)[0].files).each(function () {
                    var file = $(this);
                    if (regex.test(file[0].name.toLowerCase())) {
                        dvPreview.css({
                            'height' : '110px',
                            'width' : '110px',
                            'border' : '1px solid black',
                            'padding' : '4px',
                            'margin-bottom' : '3px'
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

        
        $(".ad_page_drpdwn").trigger("change")
        $("#category_id").trigger("change")

</script>
@stop
