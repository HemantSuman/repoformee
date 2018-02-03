@extends('admin/layout/common')
 
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Show Role
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

                <div class="box-body">

                    <div class="form-group">
                    <strong>Name:</strong>
                {{ $role->display_name }}   
                    </div>
                    <div class="form-group">
                        <strong>Description:</strong>
                {{ $role->description }}
                    </div>

                    <div class="form-group">
                        
                        <strong>Permissions:</strong>
                @if(!empty($rolePermissions))
					@foreach($rolePermissions as $v)
						<label class="label label-success">{{ $v->display_name }}</label>
					@endforeach
				@endif
                    </div>
                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box -->
        </div>
        <!--/.col -->        
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->	

@stop




