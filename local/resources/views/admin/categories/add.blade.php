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
        Add {{ ($categoriesSelected) ? 'Sub ': '' }} {{ $modelTitle}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/admin/categories') }}">{{$modelTitle}}</a></li>
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

                {!! Form::open(array("url" => "admin/$viewName/create", "role" => "form", 'files' => true)) !!}	
                @if($categoriesSelected)
                {!! Form::input('hidden', 'is_child_value', $categoriesSelected->id) !!}
                @else
                {!! Form::input('hidden', 'is_child_value', 0) !!}
                @endif
                <div class="box-body">
                   
                    <?php
                    
                    if ($categoriesSelected)
                        $disable1 = 'readonly';
                    else
                        $disable1 = '';
                    ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name</label>                  
                        {!! Form::input('text', 'name', null, ['class' => 'form-control','placeholder'=>'Category Name']) !!}
                        <div class="error-message">{{$errors->first('name')}}</div>
                    </div> 
                    <div class="checkbox bike-category">
                        <label>
                            {!! Form::checkbox('is_child', '1', ($categoriesSelected)?true:null,['id' => 'is_childCheck',$disable1]) !!} Is Child Category
                        </label>
                    </div>

                    
                    <div class="form-group is_childSelect" style="display:{!! ($errors->first('pid') || $categoriesSelected)?'block':'none' !!};">
                        <label for="exampleInputEmail1">Select Parent Category</label>         
                        {!! Form::select('pid', $categories, ($categoriesSelected)?$categoriesSelected->id:'',['placeholder' => 'Select Category', 'class' => 'form-control',$disable1]) !!}
                        <div class="error-message">{{$errors->first('pid')}}</div>
                    </div>

                    <div class="row upload-img-row">
                        <div class="col-md-4 text-center">
                            <label for="exampleInputFile">Icon</label>
                            <div class="form-group">
                                <div class="browse-this">
                                    <div id="catIconPreview"></div>
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
                                <div class="browse-this">
                                    <div id="catImagePreview"></div>
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
                        {!! Form::textarea('description', null, ['id' => 'editor1','class' => 'form-control','placeholder'=>'Description','rows'=>7]) !!}
                        <div class="error-message">{{$errors->first('description')}}</div>
                    </div> 
                    
<!--                    <div class="form-group ">
                        <label for="exampleInputEmail1">Overlay Colour</label>   


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
                        
                        ?>
                        
                         {!! Form::select('overlay_colour', $options, null, array('class' => 'form-control overlay_colour', 'placeholder' => 'Select overlay Position') ) !!} 
                        <div class="sel-box">
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
                        <input type="hidden" id="overlay_id" value="" name="overlay_colour">

                        <div class="error-message">{{$errors->first('overlay_colour')}}</div>

                    </div>--> 
                    <?php
                    $com_info=array(
                            'Is belong to community'=>'Is belong to community',
                            'Show On Information Area'=>'Show On Information Area',
                        );
                    ?>
<!--                    <div class="form-group com_info">
                        <label>Select Commounity & Information </label>         
                        {!! Form::select('com_info', $com_info, ($categoriesSelected)?$categoriesSelected->id:'',['placeholder' => '-Select-', 
                        'class' => 'form-control comm_details']) !!}
                        <div class="error-message">{{$errors->first('com_info')}}</div>
                    </div>-->
<!--                    <div class="checkbox bike-category">
                        <label>
                            {!! Form::checkbox('belong_to_community', '1', null) !!} Is belong to community
                        </label>
                    </div>-->
                    <div class="checkbox bike-category access-user">
                        <label>
                            {!! Form::checkbox('accessible_to_users', '1', 1,['id' => 'accessible_to_users']) !!} Is accessible to users
                        </label>
                    </div>
                     <div class="checkbox bike-category is_staticattribute">
                        <label>
                            {!! Form::checkbox('show_static_attributes', '1', null) !!} Show Static Attributes
                        </label>
                    </div>
                    <div class="checkbox bike-category">
                        <label>
                            {!! Form::checkbox('status', '1', null) !!} Active
                        </label>
                    </div>
                    @if(empty($categoriesSelected))
                    <div class="checkbox bike-category is_feactured">
                        <label>
                            {!! Form::checkbox('feactured', '1', null) !!} Featured
                        </label>
                    </div>
                    @endif
                    
                    <div class="checkbox bike-category is_sellable" categoriesSelected="@if(empty($categoriesSelected)){{'0'}}@else{{'1'}}@endif">
                        
                    </div>
<!--                    <div class="checkbox bike-category">
                        <label>
                            {!! Form::checkbox('show_on_info_area', '1', null) !!} Show On Information Area
                        </label>
                    </div>-->
                   
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


                </div>
                <!-- /.box-body -->


                <div class="box-footer">

                    <button type="submit" class="btn btn-primary">Submit</button> 
                    @if($categoriesSelected)
                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href='{!! url("admin/categories/$categoriesSelected->id"); !!}'>Cancel</a>
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
    $( document ).ready(function() {
      var child = $("#is_childCheck").is(':checked');
    //console.log(child);
    if(child)
    {
        $('.is_childSelect').css('display', 'block');
        $('.is_feactured').css('display', 'none');
        $('.is_staticattribute').css('display', 'none');
        $('.com_info').css('display', 'none');
        $('.is_sellable').html('<label><input name="is_sellable" type="checkbox" value="1"> Is Sellable</label>');
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
            $('.is_sellable').html('<label><input name="is_sellable" type="checkbox" value="1"> Is Sellable</label>');
        } else {
            $('.is_childSelect').css('display', 'none');
            $('.is_feactured').css('display', 'block');
            $('.is_staticattribute').css('display', 'block');
            $('.com_info').css('display', 'block');
            $('.is_sellable').html('');
        }
    });

    $(function(){
        $('#myselect').click(function(){$('#sel-option').show(); }); $('#sel-option a').click(function(e){$('#myselect').text($(this).text()); $('#sel-option').hide(); $('#sel-option li').removeClass('current'); $(this).parent().addClass('current'); e.preventDefault(); }); $(document).click(function(e) {if( e.target.id != 'myselect') {$("#sel-option").hide(); } }); 
    });

    $(document).on("change", ".category_icon", function() {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = $("#catIconPreview");
            dvPreview.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                if (regex.test(file[0].name.toLowerCase())) {
                    dvPreview.css({
                        'height' : '80px',
                        'width' : '80px',
                        'border' : '1px solid black',
                        'padding' : '4px',
                        'margin-bottom' : '3px'
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

    $(document).on("change", ".category_image", function() {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = $("#catImagePreview");
            dvPreview.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                if (regex.test(file[0].name.toLowerCase())) {
                    dvPreview.css({
                        'height' : '80px',
                        'width' : '80px',
                        'border' : '1px solid black',
                        'padding' : '4px',
                        'margin-bottom' : '3px'
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
	
	 $(document).on("change", ".comm_details", function() {
		 var cval = $("option:selected", '.comm_details').val();
		 if(cval=="Is belong to community" || cval=="Show On Information Area")
		 {
			 $('#accessible_to_users').attr('checked', false);
			 $(".access-user").hide();
			 $(".access-user").css({"display":"none"});
		 }
		 else
		 {
			 $(".access-user").show();
			 $(".access-user").css({"display":"block"}); 
		 }
	 });
	
</script>
@stop
