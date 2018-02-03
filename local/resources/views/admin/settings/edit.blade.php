@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Settings
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

                {!! Form::open(array("url" => "admin/settings/update/$result[0]", "role" => "form", 'files' => true, 'id' => 'submitFrm')) !!}	
                <input type="hidden" name="old_key" value="{{$result[0]}}">
                <div class="box-body">

                    <div class="form-group">
                        <label for="">Key</label>                  
                        {!! Form::input('text', 'key', $result[0], ['class' => 'form-control','placeholder'=>'Key', 'readonly' => 'readonly']) !!}
                        <div class="error-message">{{$errors->first('key')}}</div>
                    </div> 

                    <div class="form-group">
                        <label for="">Value</label>                  
                        {!! Form::textarea('value', $result[1], ['id' => '', 'class' => 'form-control','placeholder'=>'Value','rows'=>7]) !!}
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
