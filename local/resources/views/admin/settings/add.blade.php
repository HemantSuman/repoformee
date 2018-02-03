@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Settings
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url("/admin/settings") }}">Settings</a></li>
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

                {!! Form::open(array("url" => "admin/settings/create", "role" => "form", 'files' => true, 'id' => 'submitFrm')) !!}	
                <div class="box-body">

                    <div class="form-group">
                        <label for="">Key</label>                  
                        {!! Form::input('text', 'key', null, ['class' => 'form-control textRequired','placeholder'=>'Key']) !!}
                        <div class="error-message">{{$errors->first('key')}}</div>
                    </div> 

                    <div class="form-group">
                        <label for="">Value</label>                  
                        {!! Form::textarea('value', null, ['id' => '', 'class' => 'form-control','placeholder'=>'Value','rows'=>7]) !!}
                        <div class="error-message">{{$errors->first('value')}}</div>
                    </div>   

                    
                </div>
                <!-- /.box-body -->


                <div class="box-footer">

                    <button type="submit" class="btn btn-primary">Submit</button> 
                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href="{!! url('admin/settings'); !!}">Cancel</a>
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
    
</script>
@stop
