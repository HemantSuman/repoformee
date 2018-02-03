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
    .thumb {
        height: 75px;
        border: 1px solid #000;
        margin: 10px 35px 0 0;
    }
    .img-prvw-rmv-icn {
        /*float: left;
        margin-right: 2px;
        margin-top: 5px;*/
        display: block;
    }
    #list span {
        float: left;
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
        <li><a href="{{ url('/admin/newsletters') }}">{{$modelTitle}}</a></li>
        <li><a href="{{ url('/admin/faqs') }}">Add {{$modelTitle}}</a></li>
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
                {!! Form::open(array("url" => "admin/$viewName/create", "role" => "form", 'files' => true, 'class' => 'form-horizontal')) !!} 
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Newsletter Title</label>
                            <div class="col-sm-10">
                                <input type="text" value="{!! old('title') !!}" name="title" class="form-control" placeholder="Newsletter Title">
                                <div class="error-message">{{$errors->first('title')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Is Default Newsletter</label>
                            <div class="col-sm-10">
                                {!! Form::checkbox('is_default_template', null, null, array('class' => 'minimal is-dflt-nwsltr-chkbx')) !!}
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
                                {!! Form::select('newsletter_template_id', $options, (!empty($data->newsletter_template_id)) ? $data->newsletter_template_id : null, array('class' => 'form-control newsletterTemplate', 'placeholder' => 'Select Newsletter Template') ) !!}
                                <div class="error-message">{{$errors->first('newsletter_template_id')}}</div>
                            </div>
                        </div>
                        */ ?>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Content Field</label>
                            <div class="col-sm-10">
                                {!! Form::textarea('body', '', ['size' => '80x10', 'id' => 'editor1']) !!}
                                <div class="error-message">{{$errors->first('body')}}</div>
                            </div>
                        </div>
                        <div class="form-group nwsltr-img-div">                         
                            <label class="col-sm-2 control-label">Image Upload</label>
                            <div class="col-sm-10">
                                <div class="input-append">
                                    <div class="more-images" id="more_images">
                                    </div>
                                    <span class="more-images-button btn btn-default"><a href="javascript:void(0)" onclick="add_more()">Add more image</a></span>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group">                         
                            <label class="col-sm-2 control-label">Image Upload</label>
                            <div class="col-sm-10">
                                <input type="file" id="files" name="files[]" multiple />
                                <output id="list"></output>
                            </div>
                        </div> -->

                        
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Set Timer</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="timer" value="{!! old('timer') !!}" class="form-control pull-right" id="datepicker" placeholder="Click here to select">
                                </div>
                                <div class="error-message">{{$errors->first('timer')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Select Recipients</label>
                            <div class="col-sm-10"> 

                                {!! Form::select('recipients[]', $all_subscribers, (!empty($selected)) ? $selected : null, ['class' => 'form-control select2', 'data-placeholder' => 'Select Recipients', 'multiple' => 'multiple']) !!}

                                
                                <div class="error-message">{{$errors->first('recipients')}}</div>
                            </div>
                        </div>
                    </div>
                
                    <div class="box-footer col-sm-offset-2"> 
                        <button type="submit" class="btn btn-primary">Submit</button>
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
    
        $('#datepicker').datepicker({
            startDate: '-0d',
            autoclose: true
        });

        jQuery(document).ready(function () {
            var html = '<div id="image_0"><div class="img_id_0"></div><input type="file" id="img_id_0" value="" class="addedInput blue image_field" name="images[0]"><a href="javascript:void(0)" onclick="remove_image(0)" class="remove-img">X</a></div>';
            jQuery('#more_images').append(html);
        });
        var count = 1;
        function add_more(str) {
             var html = '<div id="image_'+ count +'"><div class="img_id_'+ count +'"></div><input type="file" id="img_id_'+ count +'" value="" class="addedInput blue image_field" name="images['+ count +']"><a href="javascript:void(0)" onclick="remove_image('+ count +')" class="remove-img">X</a></div>';
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

        $('.is-dflt-nwsltr-chkbx').on('ifChecked', function(event){
            $(".nwsltr-img-div").addClass("hide");
        }).on('ifUnchecked', function(event){ 
            $(".nwsltr-img-div").removeClass("hide");
        });


        // $('.img-prvw-rmv-icn').live( "change", function(){
        //     event.preventDefault();
        //     $(this).parent().remove();
        // } );

        // $('body').on('click', 'a.img-prvw-rmv-icn', function(event) {
        //     event.preventDefault();
        //     $(this).parent().remove();
        // })


        // function handleFileSelect(evt) {
        //     var files = evt.target.files; // FileList object

        //     // Loop through the FileList and render image files as thumbnails.
        //     for (var i = 0, f; f = files[i]; i++) {

        //         // Only process image files.
        //         if (!f.type.match('image.*')) {
        //             continue;
        //         }

        //         var reader = new FileReader();

        //         // Closure to capture the file information.
        //         reader.onload = (function(theFile) {
        //             return function(e) {
        //                 // Render thumbnail.
        //                 var span = document.createElement('span');
        //                 span.innerHTML = ['<img class="thumb" src="', e.target.result,
        //                                 '" title="', escape(theFile.name), '"/><a href="javascript:void(0)" class="img-prvw-rmv-icn" title="Remove">X</a>'].join('');
        //                 document.getElementById('list').insertBefore(span, null);
        //             };
        //         })(f);

        //         // Read in the image file as a data URL.
        //         reader.readAsDataURL(f);
        //     }
        // }

        // document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>
@stop
