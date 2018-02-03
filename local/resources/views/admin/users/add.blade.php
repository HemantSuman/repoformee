<style>
    .error-message{color:#dd4b39;}
    #newsletterInputFile {
        margin-top: 6px;
    }
    .thumbnail{

        height: 100px;
        margin: 10px; 
        float: left;
    }
    #clear{
       display:none;
    }
    #result {
        border: 4px dotted #cccccc;
        display: none;
        float: left;
        margin:0 auto;
        margin-top: 5px;
        width: 100%;
    }
</style>
@extends('admin/layout/common')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Admin User
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Add Admin User</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>              
                </div>

                @if( Session::has( 'success' ))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> {{ Session::get( 'success' ) }}
                </div>
                @elseif( Session::has( 'danger' ))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Oops!</strong> {{ Session::get( 'danger' ) }}
                </div>
                @endif

                {!! Form::open(array("url" => "admin/users/create_user", "role" => "form", 'class' => 'form-horizontal', 'novalidate')) !!} 
                    <div class="box-body">
                       
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                {!! Form::input('text', 'name', null, ['class' => 'form-control','placeholder'=>'Name']) !!}
                                <div class="error-message">{{$errors->first('name')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                 {!! Form::input('text', 'email', null, ['class' => 'form-control','placeholder'=>'Email']) !!}
                                <div class="error-message">{{$errors->first('email')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mobile No.</label>
                            <div class="col-sm-10">
                                {!! Form::input('text', 'mobile_no', null, ['class' => 'form-control','placeholder'=>'mobile no','min'=>'0']) !!}
                                <div class="error-message">{{$errors->first('mobile_no')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" placeholder="password">
                                <div class="error-message">{{$errors->first('password')}}</div>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Select Role</label>
                            <div class="col-sm-10">
                               
                                {!! Form::select('role_id', $role, null, array('class' => 'form-control', 'placeholder' => 'Select Role') ) !!}
                                <div class="error-message">{{$errors->first('role_id')}}</div>
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                {!! Form::checkbox('status', null, null, array('class' => 'minimal')) !!}
                            </div>
                        </div>-->
                      
                    </div>
                
                    <div class="box-footer col-sm-offset-2"> 
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-default btn-close" href="{!! url('admin/admin_user'); !!}">Cancel</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>

@stop

