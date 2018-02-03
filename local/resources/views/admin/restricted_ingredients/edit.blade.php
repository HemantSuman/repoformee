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
        <li><a href="{{ url('/admin/restricted_ingredients') }}">{{$modelTitle}}</a></li>
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

                {!! Form::model($result, ["action" => ["admin\\$controllerName@admin_update", $result->id], 'files' => true, "id"=>"formSubmit"]) !!}	
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>                  
                        {!! Form::input('text', 'name', null, ['class' => 'form-control','placeholder'=>'Name']) !!}
                        <div id="name_error" class="error-message">{{$errors->first('name')}}</div>
                    </div> 

                    <?php
                     $certification = array(
                        'Halal' => 'Halal',
                        'Kosher' => 'Kosher',
						'Vegan' => 'Vegan'
                    );
                    ?>
                    <div class="form-group com_info">
                        <label>Select Certification </label>         
                        {!! Form::select('certification', $certification, null, ['placeholder' => '-Select-', 'class' => 'form-control comm_details']) !!}
                        <div id="certification_error" class="error-message">{{$errors->first('certification')}}</div>
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

</script>
@stop
