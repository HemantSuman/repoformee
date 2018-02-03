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
        Edit Registered User
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
               {!! Form::model($user, array('action' => ["admin\UsersController@adminregister_update", $user->id],'class' => 'form-horizontal')) !!}
            
                    <div class="box-body">
                       
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                {!! Form::text('name', $user->name ? $user->name : null, array('class' => 'form-control', 'placeholder' => 'name')) !!}
                               
                                <div class="error-message">{{$errors->first('name')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                
                                  {!! Form::text('email', $user->email ? $user->email : null, array('class' => 'form-control', 'placeholder' => 'Email')) !!}
                                <div class="error-message">{{$errors->first('email')}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mobile No.</label>
                            <div class="col-sm-10">
                               
                                  {!! Form::number('mobile_no', $user->mobile_no ? $user->mobile_no : null, array('class' => 'form-control', 'placeholder' => 'mobile_no','min'=>'0')) !!}
                                <div class="error-message">{{$errors->first('mobile_no')}}</div>
                            </div>
                        </div>
                        <?php 
                       //dd(count($user->login_type));
                        ?>
                        @if(count($user->login_type)==0)
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                            
                            <div class="col-sm-10">
                                 <input type="password" name="password" value="<?php echo $user->password ? $user->password : null?>" class="form-control" placeholder="password"/>
                                <div class="error-message">{{$errors->first('password')}}</div>
                            </div>
                        </div>
                      @endif
                        
<!--                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                  {!! Form::checkbox('status', '1', $user->status ? true : false, array('class' => 'minimal')) !!}
                              
                            </div>
                        </div>-->
                      
                    </div>
                
                    <div class="box-footer col-sm-offset-2"> 
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-default btn-close" href="{!! url('admin/register_user'); !!}">Cancel</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>

@stop

