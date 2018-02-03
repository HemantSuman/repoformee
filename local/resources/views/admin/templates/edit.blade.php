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
                        <label for="exampleInputEmail1">Template Name</label>                  
                        {!! Form::input('text', 'template_name', null, ['class' => 'form-control','placeholder'=>'Template Name ']) !!}
                        <div id="template_name_error" class="error-message">{{$errors->first('template_name')}}</div>
                    </div> 
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Category</label>
                    </div>
                    
                    <div id="attrName" class="attr_value_single">
                        @foreach ($categories as $key => $val)
                        
                        <?php if(in_array($key, $selectedCat->toArray())){ ?>
                            <input name="category_id[]" class="inputCheckBox" value="<?php echo $key; ?>" checked='checked' type="checkbox" >  <label> {{$val}} </label> <br />
                        <?php } else if(in_array($key, $usedCat->toArray())){ ?>
                            <input name="category_id[]" class="inputCheckBox" value="<?php echo $key; ?>" type="checkbox" disabled="disabled" >  <label> {{$val}} </label> <br />
                        <?php } else { ?>
                            <input name="category_id[]" class="inputCheckBox" value="<?php echo $key; ?>" type="checkbox" >  <label> {{$val}} </label> <br />
                        <?php } ?>
                        @endforeach

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
