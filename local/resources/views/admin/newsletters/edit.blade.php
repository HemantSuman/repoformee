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
        Edit {{ $modelTitle }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/admin/newsletters') }}">{{$modelTitle}}</a></li>
        <li><a href="{{ url('/admin/faqs') }}">Edit {{$modelTitle}}</a></li>
        <li class="active"></li>
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

                {!! Form::model($data, array('action' => ["admin\\$controllerName@admin_edit", $data->id], 'files' => true, 'class' => 'form-horizontal')) !!}
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Newsletter Title</label>
                            <div class="col-sm-10">
                                {!! Form::text('title', $data->title ? $data->title : null, array('class' => 'form-control', 'placeholder' => 'Newsletter Title')) !!}
                                <div class="error-message">{{$errors->first('title')}}</div>
                            </div>
                        </div>
                        <?php /*
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Newsletter Template</label>
                            <div class="col-sm-10">
                                <?php
                                $options = array(
                                    'demoNewsletterTemplate' => 'demoNewsletterTemplate'
                                ); ?>
                                {!! Form::select('newsletter_template_id', $options, (!empty($data->newsletter_template_id)) ? $data->newsletter_template_id : null, array('class' => 'form-control', 'placeholder' => 'Select Newsletter Template') ) !!}
                                <div class="error-message">{{$errors->first('newsletter_template_id')}}</div>
                            </div>
                        </div>
                        */ ?>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Is Default Newsletter</label>
                            <div class="col-sm-10">
                                {!! Form::checkbox('is_default_template', '1', $data->is_default_template ? true : false, array('class' => 'minimal is-dflt-nwsltr-chkbx')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Content Field</label>
                            <div class="col-sm-10">
                                {!! Form::textarea('body', $data->body ? $data->body : null, ['size' => '80x10', 'id' => 'editor1']) !!}
                                <div class="error-message">{{$errors->first('body')}}</div>
                            </div>
                        </div>

                        <div class="form-group nwsltr-img-div">                         
                            <label class="col-sm-2 control-label">Image Upload</label>
                            <div class="col-sm-10">
                                <div class="input-append">
                                    @foreach ($data->newsletter_attachments as $attachment => $single) 
                                        <div class="advertisement_image" id="advertisement_image_<?php echo $single->id; ?>">
                                            <div class="default-delete">
                                                <a class="btn btn-default btn-close delete_image" href="{!! url('admin/newsletters/delete-attachment'); !!}" data-id="{!! $single->id !!}" data-img="{!! $single->image !!}" title="Delete"><i class="fa fa-remove"></i></a>
                                            </div>
                                            <img src="{!! asset('/upload_images/newsletters/'.$single['image']) !!}" title="preview image" class="thumbnail" />
                                        </div>
                                    @endforeach
                                    <br/>
                                    <span class="more-images-button btn btn-default"><a href="javascript:void(0)" onclick="add_more()">Add more image</a></span>
                                    <div class="more-images" id="more_images"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Set Timer</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="timer" value="{!! ($data->timer != null) ? date('m/d/Y', strtotime($data->timer)) : null !!}" class="form-control pull-right" id="datepicker" placeholder="Click here to select">
                                </div>
                                <div class="error-message">{{$errors->first('timer')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Select Recipients</label>
                            <div class="col-sm-10">
                                <?php $selected = explode(",", $data->recipients); ?>
                                {!! Form::select('recipients[]', $all_subscribers, (!empty($selected)) ? $selected : null, ['class' => 'form-control select2', 'data-placeholder' => 'Select Recipients', 'multiple' => 'multiple']) !!}

                                <div class="error-message">{{$errors->first('recipients')}}</div>
                            </div>
                        </div>
                    </div>
                
                    <div class="box-footer col-sm-offset-2"> 
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-default btn-close" href="{!! url('admin/newsletters'); !!}">Cancel</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>

@stop

@section('scripts')
<script type="text/javascript">
        var count = 0;
        function add_more(str) {
             var html = '<div id="image_'+ count +'"><div class="img_id_'+ count +'"></div><input type="file" onchange="select_img('+ count +')" id="img_id_'+ count +'" value="" class="addedInput blue image_field" name="images['+ count +']"><a href="javascript:void(0)" onclick="remove_image('+ count +')" class="remove-img">X</a></div>';
            jQuery('#more_images').append(html);
            count++;
        }
        function remove_image(strrm) {
            if (count > 0) {
                jQuery('#image_' + strrm + '').remove();
            }
        }

        $(document).on("change", ".image_field", function (event) {
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("."+$(this).attr('id'));
                dvPreview.html("");
                dvPreview.removeAttr("");
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
                        Notify.showMessage("Image must have an extension of .jpeg, .jpg, or .png", 'warning');
                        dvPreview.html("");
                        return false;
                    }
                });
            } else {
                alert("This browser does not support HTML5 FileReader.");
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
                    if(response.status) {
                        $('#advertisement_image_' + id).fadeOut(100);
                        $('#advertisement_image_' + id).remove();    
                    } else {
                        Notify.showMessage("Image could not be deleted.", 'warning');
                    }
                    
                }
            })
            return false;
        });

        $('.is-dflt-nwsltr-chkbx').on('ifChecked', function(event){
            $(".nwsltr-img-div").addClass("hide");
        }).on('ifUnchecked', function(event){ 
            $(".nwsltr-img-div").removeClass("hide");
        });

        <?php
        if($data->is_default_template == 1) { ?>
            $(".nwsltr-img-div").addClass("hide"); <?php
        }
        ?>
        
</script>
@stop
