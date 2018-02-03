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
        Edit {{ ($result->categoriesSelected) ? 'Sub ': '' }} {{ $modelTitle}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/admin/categories') }}">{{$modelTitle}}</a></li>
        <li class="active"></li>
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

                {!! Form::model($result, array('action' => ["admin\\$controllerName@admin_update", $result->id], 'files' => true)) !!}

                @if($result->categoriesSelected)
                {!! Form::input('hidden', 'is_child_value', $result->pid) !!}
                @else
                {!! Form::input('hidden', 'is_child_value', 0) !!}
                @endif

                <div class="box-body">
                    <?php
                    if ($result->categoriesSelected) {
                        $disable1 = 'readonly';
                        $accessible_user = 'disabled="disabled"';
                    } else {
                        $disable1 = '';
                        $accessible_user = '';
                    }
                    if (($result->belong_to_community) || ($result->show_on_info_area)) {
                        $disablecominfo = 'disabled="disabled"';
                        $hide = 'hide';
                    } else {
                        $disablecominfo = '';
                        $hide = '';
                    }
                    ?>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name</label>                  
                        {!! Form::input('text', 'name', ($result)?$result->name:null, ['class' => 'form-control','placeholder'=>'Category Name']) !!}
                        <div class="error-message">{{$errors->first('name')}}</div>
                    </div> 
                    <div class="checkbox bike-category <?php echo $hide ?>">
                        <label>
                            {!! Form::checkbox('is_child', '1', ($result->categoriesSelected)?true:null, ['id' => 'is_childCheck',$disable1,$disablecominfo,$hide]) !!} Is Child category
                        </label>
                    </div>
                    <div class="form-group is_childSelect" style="display:{!! ($errors->first('pid') || $result->categoriesSelected)?'block':'none' !!};">
                        <label for="exampleInputEmail1">Select Parent Category</label> 
                        <?php if ($result->pid > 0) { ?>        
                            {!! Form::select('pid', $categories, $result->pid, ['placeholder' => 'Select Category', 'class' => 'form-control','disabled'=>'true']) !!}

                            {!! Form::input('hidden', 'pid', $result->pid?$result->pid:null) !!}

                        <?php } else { ?>
                            {!! Form::select('pid', $categories, $result->pid, ['placeholder' => 'Select Category', 'class' => 'form-control',$disable1]) !!}
                        <?php } ?>


                        <div class="error-message">{{$errors->first('pid')}}</div>
                    </div>

                    <div class="row upload-img-row">
                        <div class="col-md-4 text-center">
                            <label for="exampleInputFile">Icon</label>
                            <div class="form-group">
                                <div class="img-holder text-center" id="catIconPreview">

                                    @if(isset($result->icon))

                                    {{ Html::image(asset('/upload_images/categories/icon/'.$result->id.'/'.$result->icon), 'alt', array( 'width' => 70, 'height' => 70, 'class' => 'img-responsive cat_icon' )) }}

                                </div>

                                <div class="browse-this">
                                    @endif
                                    {!!Form::file('icon', ['class' => 'category_icon'])!!}

                                </div>

<!--<p class="help-block">Example block-level help text here.</p>-->
                                <div class="error-message">{{$errors->first('icon')}}</div>
                                <span class="message"> Icon Height should be of 70px.</span>
                            </div> 
                        </div>
                        <div class="col-md-4 text-center">
                            <label for="exampleInputFile">BG Image</label>
                            <div class="form-group">
                                <div class="img-holder text-center" id="catImagePreview">
                                    @if(isset($result->image))
                                    {{ Html::image(asset('/upload_images/categories/backgroundimage/30px/'.$result->id.'/'.$result->image), 'alt', array( 'width' => 70, 'height' => 70, 'class' => 'img-responsive cat_img' )) }}
                                </div>

                                <div class="browse-this">
                                    @endif
                                    {!!Form::file('image', ['class' => 'category_image'])!!}

                                </div>
                                  <!--<p class="help-block">Example block-level help text here.</p>-->
                                <div class="error-message">{{$errors->first('image')}}</div>
                                <span class="message">  Image size should be of 360x235px.</span>
                            </div> 
                        </div>
                    </div> <!--/row-->

                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>                  
                        {!! Form::textarea('description', ($result)?$result->description:null, ['id' => 'editor1','class' => 'form-control','placeholder'=>'Description','rows'=>7]) !!}
                        <div class="error-message">{{$errors->first('description')}}</div>
                    </div> 

                    <div class="form-group ">
                        <!--                        <label for="exampleInputEmail1">Overlay Colour</label>   -->


                        <?php
                        $options = array(
                            'pink' => 'Pink',
                            'blue' => 'Blue',
                            'light-yellow' => 'Light-yellow',
                            'light-grey' => 'Light-grey',
                            'shaded-green' => 'Shaded-green',
                            'light-orange' => 'light-orange',
                            'light-skin' => 'Light-skin',
                            'light-blue' => 'Light-blue',
                            'light-navy' => 'Light-navy',
                            'fade-green' => 'Fade-green',
                            'light-brown' => 'Light-brown',
                        );
                        $com_info = array(
                            'Is belong to community' => 'Is belong to community',
                            'Show On Information Area' => 'Show On Information Area',
                        );
//dd($result);

                        if ($result->belong_to_community != 0) {
                            $com_infoSelected = 'Is belong to community';
                        } elseif ($result->show_on_info_area != 0) {
                            $com_infoSelected = 'Show On Information Area';
                        } else {
                            $com_infoSelected = '';
                        }
//dd($com_infoSelected);
                        ?>
                        <!--                           {!! Form::select('overlay_colour', $options, (!empty($result->overlay_colour)) ?$result->overlay_colour : null, array('class' => 'form-control', 'placeholder' => 'Select overlay Colour') ) !!}-->
                        <!--                      <div class="sel-box">
                                                    <span id='myselect'>Select Overlay Colour</span>
                                                    <ul class='toc-odd level-1' id="sel-option">
                                                        <li value="pink"><a href="javascript:void(0)">pink <span style="background: #e75d5d;"></span></a></li>
                                                      <li value="blue"><a href="javascript:void(0)">Blue <span style="background: #006495;"></span></a></li>
                                                      <li value="green"><a href="javascript:void(0)">Green <span style="background: #8bb028;"></span></a></li>
                                                      <li value="light-yellow"><a href="javascript:void(0)">Light-yellow <span style="background: #c4be5d;"></span></a></li>
                                                      <li value="light-grey"><a href="javascript:void(0)">Light-grey <span style="background: #9997a4;"></span></a></li>
                                                      <li value="shaded-green"><a href="javascript:void(0)">Shaded-green <span style="background: #359c3f;"></span></a></li>
                                                      <li value="light-orange"><a href="javascript:void(0)">Light-orange <span style="background: #c98a51;"></span></a></li>
                                                      <li value="light-skin"><a href="javascript:void(0)">Light-skin <span style="background: #e7915d;"></span></a></li>
                                                      <li value="light-blue"><a href="javascript:void(0)">Light-blue <span style="background: #5d94e7;"></span></a></li>
                                                      <li value="fade-green"><a href="javascript:void(0)">Fade-green <span style="background: #89bd45;"></span></a></li>
                                                      <li value="light-brown"><a href="javascript:void(0)">Light-brown <span style="background: #b28e6a;"></span></a></li>
                                                    </ul>
                                                </div>
                                                <input type="hidden" id="overlay_id" value="{{(!empty($result->overlay_colour)) ?$result->overlay_colour : null}}" name="overlay_colour">                    
                                                <div class="error-message">{{$errors->first('overlay_colour')}}</div>-->

                    </div>
<!--                    <div class="form-group com_info">
                        <label>Select Commounity & Information </label>         
                        {!! Form::select('com_info', $com_info, ($com_infoSelected)?$com_infoSelected:'',['placeholder' => '-Select-', 'class' => 'form-control com_infoval']) !!}
                        <div class="error-message">{{$errors->first('com_info')}}</div>
                    </div>-->
                    <!--                    <div class="checkbox bike-category">
                                            <label>
                                                {!! Form::checkbox('belong_to_community', '1', ($result  && $result->belong_to_community != 0)? true:null) !!} Is belongs to community
                                            </label>
                                        </div>-->
                    <div class="checkbox bike-category access-user <?php //echo $hide  ?>">
                        <label>
                            {!! Form::checkbox('accessible_to_users', '1', ($result  && $result->accessible_to_users != 0)? true:null,['id' => 'accessible_to_users',$accessible_user]) !!} Is accessible to users
                        </label>
                    </div>
                    <?php $disable2 = 'readonly'; ?>
                    <div class="checkbox bike-category is_staticattribute">
                        <label>
                            {!! Form::checkbox('show_static_attributes', '1', ($result  && $result->show_static_attributes != 0)? true:null, ['id' => 'is_showstaticattr',$disable2]) !!} Show Static Attributes
                        </label>  
                    </div>
                    <div class="checkbox bike-category">
                        <label>
                            {!! Form::checkbox('status', '1', ($result  && $result->status != 0)? true:null) !!} Active
                        </label>
                    </div>
                    @if($result->pid == 0)
                    <div class="checkbox bike-category is_feactured">
                        <label>
                            {!! Form::checkbox('feactured', '1', ($result  && $result->feactured != 0)? true:null) !!} Featured
                        </label>
                    </div>
                    @endif

                    <div class="checkbox bike-category is_sellable" is_sellable="@if($result->is_sellable == 0){{'0'}}@else{{'1'}}@endif">

                    </div>

                    <!--                    <div class="checkbox bike-category">
                                            <label>
                                                {!! Form::checkbox('show_on_info_area', '1', ($result  && $result->show_on_info_area != 0)? true:null) !!} Show On Information Area
                                            </label>
                                        </div>-->


                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Tags</label>                  
                        {!! Form::text('metakeyword', ($result)?$result->metakeyword:null, ['class' => 'form-control','placeholder'=>'Meta Tags']) !!}
                        <div class="error-message">{{$errors->first('metakeyword')}}</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Description</label>                  
                        {!! Form::textarea('metadescription', ($result)?$result->metadescription:null, ['class' => 'form-control','placeholder'=>'Meta Description','rows'=>7]) !!}
                        <div class="error-message">{{$errors->first('metadescription')}}</div>
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    {{ Form::hidden('id', $result->id) }}
                    <button type="submit" class="btn btn-primary">Submit</button>
                    @if($result->categoriesSelected)
                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href='{!! url("admin/categories/$result->pid"); !!}'>Cancel</a>
                    @else
                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href="{!! url('admin/categories'); !!}">Cancel</a>
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
    var sellableChecked = '';
    $(document).ready(function () {
        var child = $("#is_childCheck").is(':checked');
        var cominfovalue = $(".com_infoval option:selected").val();
        var is_sellableValue = $('.is_sellable').attr('is_sellable');
        if (is_sellableValue == 1) {
            sellableChecked = 'checked';
        }
        //console.log(cominfovalue);
        if (child)
        {
            $('.is_childSelect').css('display', 'block');
            $('.is_feactured').css('display', 'none');
            $('.is_staticattribute').css('display', 'none');
            $('.com_info').css('display', 'none');
            $('.is_sellable').html('<label><input ' + sellableChecked + ' name="is_sellable" type="checkbox" value="1"> Is Sellable</label>');
        }
        if (cominfovalue == false)
        {

            $('.com_info').css('display', 'none');
        }
        if (cominfovalue)
        {
            $(".access-user").hide();
            $(".access-user").css({"display": "none"});
        }

    });
    $(document).on('click', '#sel-option li', function () {

        $("#overlay_id").val($(this).text());
        //$("#cat_id").val($(this).find("img").attr("idee"));
    });
    //Click checkbox to show hide category drop down  
    $(document).on('click', '#is_childCheck', function () {
        if ($(this).is(":checked")) {
            $('.is_childSelect').css('display', 'block');
            $('.is_feactured').css('display', 'none');
            $('.is_staticattribute').css('display', 'none');
            $('.com_info').css('display', 'none');
            $('.is_sellable').html('<label><input ' + sellableChecked + ' name="is_sellable" type="checkbox" value="1"> Is Sellable</label>');
        } else {
            $('.is_childSelect').css('display', 'none');
            $('.is_feactured').css('display', 'block');
            $('.is_staticattribute').css('display', 'block');
            $('.com_info').css('display', 'block');
            $('.is_sellable').html('');
        }
    });

    $(function () {
        $overlayvalue = $("#overlay_id").val();
        if ($("#overlay_id").val()) {
            $("#myselect").html($("#overlay_id").val());
        }


        $('#myselect').click(function () {
            $('#sel-option').show();
        });
        $('#sel-option a').click(function (e) {
            $('#myselect').text($(this).text());
            $('#sel-option').hide();
            $('#sel-option li').removeClass('current');
            $(this).parent().addClass('current');
            e.preventDefault();
        });
        $(document).click(function (e) {
            if (e.target.id != 'myselect') {
                $("#sel-option").hide();
            }
        });
    });


    $(document).on("change", ".category_icon", function () {
        if (typeof (FileReader) != "undefined") {
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                if (regex.test(file[0].name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = $(".cat_icon");
                        img.attr("style", "height:70px;width: 70px");
                        img.attr("src", e.target.result);
                    }
                    reader.readAsDataURL(file[0]);
                } else {
                    dvPreview.removeAttr("style");
                    $(this).val('');
                    Notify.showMessage("Image must have an extension of .jpeg, .jpg, or .png", 'warning');
                    return false;
                }
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    });

    $(document).on("change", ".category_image", function () {
        if (typeof (FileReader) != "undefined") {
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                if (regex.test(file[0].name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = $(".cat_img");
                        img.attr("style", "height:70px;width: 70px");
                        img.attr("src", e.target.result);
                    }
                    reader.readAsDataURL(file[0]);
                } else {
                    dvPreview.removeAttr("style");
                    $(this).val('');
                    Notify.showMessage("Image must have an extension of .jpeg, .jpg, or .png", 'warning');
                    return false;
                }
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    });



    $(document).on("change", ".com_infoval", function () {
        var cval = $("option:selected", '.com_infoval').val();
        if (cval == "Is belong to community" || cval == "Show On Information Area")
        {
            $('#accessible_to_users').attr('checked', false);
            $(".access-user").hide();
            $(".access-user").css({"display": "none"});
        } else
        {
            $(".access-user").show();
            $(".access-user").css({"display": "block"});
        }
    });
</script>
@stop
