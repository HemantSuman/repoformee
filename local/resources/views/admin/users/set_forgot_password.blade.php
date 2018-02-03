@extends('admin/layout/login')
@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="{!! url('admin/login'); !!}"><b>For</b>Mee</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Reset Your password</p>
@if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
              
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        
        @endif
        @if (Session::has('message')) 
            <p id="alertmsg" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        
        @endif
        
        {!! Form::open(
        array('url' => '/admin/verify',
        'class' => 'form',
        'files' => true,
        'id'=>'verify',
        ));
        !!}
        
        <div class="form-group has-feedback">
           {!!   Form::password('password', $attributes = ['class' => 'form-control', 'placeholder' => 'Password']); !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        
        <div class="form-group has-feedback">
           {!!   Form::password('confirm_password', $attributes = ['class' => 'form-control', 'placeholder' => 'Confirm Password']); !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        
        <div class="row">
           
            <!-- /.col -->
            <div class="col-xs-4">
                 {!!   Form::hidden('confirmation_code', $confirmation_code, $attributes = []); !!}
                {!! Form::submit('Submit', ['class' => "btn btn-primary btn-block btn-flat"]); !!}
            </div>
            <!-- /.col -->
        </div>
        {!! Form::close() !!}

    </div>
    <!-- /.login-box-body -->
</div>

@stop
