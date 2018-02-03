@extends('admin/layout/common')
@section('content')
<section class="content-header">
    <h1>
        Corporate User Management
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">Role Managment</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                {!! Form::open(array("url" => "admin/corporates", 'method'=>'post', "role" => "form", 'id' => 'FeedFilterByTitle')) !!}          
                {!! Form::hidden('form_search', 'form_search') !!}
                <div class="col-sm-6">
                    <div class="input-group input-group-sm form-group">
                        {!! Form::text('name', '', array('placeholder' => 'Search by Role ...', 'class' => 'form-control')) !!}
                        <span class="input-group-btn">
                            {!! Form::submit('Go!', ['class' => 'btn btn-info btn-flat']) !!}
                        </span>
                        <span class="input-group-btn" style="margin-left: 5px;float: left;">
                            <a class="btn btn-info" href="{{ url('/admin/corporates') }}">Clear Search</a>
                        </span>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">

                        <a class="btn btn-block btn-primary" href="{{ url('/admin/roles/add_corporate') }}"> Create New Corporate </a>
                    </h3>


                </div>
                @if (Session::has('message')) 
                <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">


                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Role Name</th>
                            <th>Is Merchant</th>
                            <th>Add Date</th>
                            <th >Action</th>                
                        </tr>


                        @foreach($roles as $key => $role)

                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{@date('d-M-Y',strtotime($role->add_date))}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ url("/admin/roles/edit_corporate",$role->id) }}">Edit</a>

                            </td>
                        </tr>   

                        @endforeach    

                        @if(sizeof($roles)==0)
                        <tr><td colspan="9" style="text-align:center">no record found</td></tr>
                        @endif


                    </table>

                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {!! $roles->render() !!}
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</section>

<!--	@if ($message = Session::get('success'))
                <div class="alert alert-success">
                        <p>{{ $message }}</p>
                </div>
        @endif-->

@endsection
