<style>
    .error-message{color:#dd4b39;}
</style>
@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Role
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Role Edit</li>
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
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ url('/admin/roles') }}"> Back</a>
                    </div>
                </div>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- /.box-header -->
                <!-- form start -->    

                {!! Form::model($role, array('action' => ["RoleController@update", $role->id])) !!}
                <div class="box-body">

                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                    
                    <div class="form-group">
                        <strong>Permission:</strong>
                        <br/>

                        @foreach($permission as $value)
                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions->toarray()) ? true : false, array('class' => 'name')) }}
                            {{ $value->display_name }}</label>
                        <br/>
                        @endforeach
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">

                    <button type="submit" class="btn btn-primary">Submit</button>

                    <a style="margin-left: 5px;" class="btn btn-default btn-close" href="">Cancel</a>

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
