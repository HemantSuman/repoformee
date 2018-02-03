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

                {!! Form::model($result, ["action" => ["admin\\$controllerName@admin_update", $result->id], 'files' => true, "id"=>"formSubmit"]) !!}	
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Package Name</label>                  
                        {!! Form::input('text', 'package_name', null, ['class' => 'form-control','placeholder'=>'Package Name']) !!}
                        <div id="package_name_error" class="error-message">{{$errors->first('package_name')}}</div>
                    </div> 

                    <div class="form-group">
                        <label for="exampleInputEmail1">Discription</label>                  
                        {!! Form::textarea('package_discription', null, ['class' => 'form-control','placeholder'=>'Discription']) !!}
                        <div id="package_discription_error" class="error-message">{{$errors->first('package_discription')}}</div>
                    </div> 
                   
                    <div class="form-group">
                        <label for="exampleInputEmail1">Plan Price($)</label>                  
                        {!! Form::input('text', 'package_price', null, ['class' => 'form-control','placeholder'=>'Plan Price']) !!}
                        <div id="package_price_error" class="error-message">{{$errors->first('package_price')}}</div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">No. of Image Upload Per Post</label>                  
                            {!! Form::input('text', 'number_image_upload', $result->number_image_upload , ['class' => 'form-control']) !!}
                            <div id="number_image_upload_error" class="error-message">{{$errors->first('number_image_upload')}}</div>
                        </div> 
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Duration (In Days)</label>                  
                            {!! Form::input('text', 'duration', $result->duration , ['class' => 'form-control']) !!}
                            <div id="duration_error" class="error-message">{{$errors->first('duration')}}</div>
                        </div> 
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Classified Type</label>   </br>       
                            <input type="radio" name="classified_type" <?php echo ($result->classified_type == 'featured')?'checked':''; ?> value="featured" > <label>Featured</label>
                            <input type="radio" name="classified_type" <?php echo ($result->classified_type == 'premium_parent')?'checked':''; ?> value="premium_parent" > <label>Premium for parent category</label>
                            <input type="radio" name="classified_type" <?php echo ($result->classified_type == 'premium_child')?'checked':''; ?> value="premium_child" > <label>Premium for child category</label>
                            <div id="classified_type_error" class="error-message">{{$errors->first('classified_type')}}</div>
                        </div> 
                    </div>

                    <div class="form-group">
                        <div class=" checkbox bike-category">
                            <label>
                                {!! Form::checkbox('status', '1', null) !!} Active
                            </label>
                        </div>
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
    $('body').on('focus', ".datepicker", function () {
        $(this).datepicker();
    });

</script>
@stop
